<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use Illuminate\Support\Facades\DB;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Curso $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('cursos.index', ['cursos' => $model
                                                ->orderBy('NOMECURSO', 'ASC')
                                                ->paginate(5)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Curso $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('cursos.index', ['cursos' => $model
                                                ->where('NOMECURSO','like',$request->nomeMatricula.'%')
                                                ->orderBy('NOMECURSO', 'ASC')
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
        return view('cursos.create');
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
        $cursoValidate = DB::table('curso')->select('id')->where('NOMECURSO', '=' , $request->NOMECURSO)->count();
        if($cursoValidate > 0){
            $error = 1;
            return redirect()->route('curso.index', compact('error'))->withStatus(__('Não foi possível realizar o cadastro pois já existe um curso de mesmo nome!'));
        }

        $curso = new Curso;   
        $curso->create($request->all());
        return redirect()->route('curso.index', compact('error'))->withStatus(__('Cadastro realizado com sucesso!.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ((auth()->user()->permissao) == 2) return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        $curso = Curso::findOrFail($id);
        return view('cursos.edit', compact('curso'));
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
        $curso = Curso::findOrFail($id);
        $curso->update($request->all());
        return redirect()->route('curso.index', compact('error'))->withStatus(__('Curso atualizado com sucesso.'));
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
        $curso = Curso::findOrFail($id);
        $curso->delete();
        $error = 0;
        return redirect()->route('curso.index', compact('error'))->withStatus(__('Curso deletado com sucesso.'));
    }
}
