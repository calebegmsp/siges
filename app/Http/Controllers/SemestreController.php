<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semestre;
use Illuminate\Support\Facades\DB;

class SemestreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Semestre $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('semestres.index', ['semestres' => $model
                                                    ->orderBy('ANO', 'DESC')
                                                    ->paginate(5)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Semestre $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('semestres.index', ['semestres' => $model
                                                ->where('ANO','like',$request->nomeMatricula.'%')
                                                ->orderBy('ANO', 'DESC')
                                                ->paginate(5)], compact('request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('semestres.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ((auth()->user()->permissao) == 2) return abort(404);
        $error = 0;
        $semestreValidate = DB::table('semestre')->select('id')
                                                ->where('ANO', 'like' , $request->ANO)
                                                ->count();
        if($semestreValidate > 0){
            $error = 1;
            return redirect()->route('semestre.index', compact('error'))->withStatus(__('Não foi possível realizar o cadastro pois o mesmo já existe!'));
        }


        $semestre = new Semestre;
        $semestre->create($request->all());
        return redirect()->route('semestre.index', compact('error'))->withStatus(__('Cadastro realizado com sucesso!.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ((auth()->user()->permissao) == 2) return abort(404);    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        $semestre = Semestre::findOrFail($id);
        return view('semestres.edit', compact('semestre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ((auth()->user()->permissao) == 2) return abort(404);
        $error = 0;
        $semestre = Semestre::findOrFail($id);
        $semestre->update($request->all());
        return redirect()->route('semestre.index', compact('error'))->withStatus(__('Semestre atualizado com sucesso.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ((auth()->user()->permissao) == 2) return abort(404);
        $semestre = Semestre::findOrFail($id);
        $semestre->delete();
        $error = 0;
        return redirect()->route('semestre.index', compact('error'))->withStatus(__('Semestre deletado com sucesso.'));
    }
}
