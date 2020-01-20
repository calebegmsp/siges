<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turma;
use Illuminate\Support\Facades\DB;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Turma $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('turmas.index', ['turmas' => $model
                                                ->orderBy('NOMETURMA', 'DESC')
                                                ->paginate(5)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Turma $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('turmas.index', ['turmas' => $model
                                                ->where('NOMETURMA','like',$request->nomeMatricula.'%')
                                                ->orderBy('NOMETURMA', 'DESC')
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
        return view('turmas.create');
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
        $turmaValidate = DB::table('turma')->select('id')
                                                ->where('NOMETURMA', 'like' , $request->NOMETURMA)
                                                ->count();
        if($turmaValidate > 0){
            $error = 1;
            return redirect()->route('turma.index', compact('error'))->withStatus(__('Não foi possível realizar o cadastro pois o mesmo já existe!'));
        }
        DB::table('turma')->insert([
                'NOMETURMA' => $request->NOMETURMA,
            ]);
         return redirect()->route('turma.index', compact('error'))->withStatus(__('Cadastro realizado com sucesso!.'));
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
        $turma = Turma::findOrFail($id);
        return view('turmas.edit', compact('turma'));
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
        $turma = Turma::findOrFail($id);
        $turma->update($request->all());
        return redirect()->route('turma.index', 'error')->withStatus(__('Turma atualizada com sucesso.'));
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
        $turma = Turma::findOrFail($id);
        $turma->delete();
        $error = 0;
        return redirect()->route('turma.index', compact('error'))->withStatus(__('Turma deletada com sucesso.'));
    }
}
