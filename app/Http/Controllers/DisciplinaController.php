<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disciplina;
use Illuminate\Support\Facades\DB;

class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Disciplina $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('disciplinas.index', ['disciplinas' => DB::table('disciplina')
                                        ->join('professor', 'professor.CDPROFESSOR', '=', 'disciplina.CDPROFESSOR')
                                        ->join('curso', 'curso.CDCURSO', 'disciplina.CDCURSO')
                                        ->orderBy('NOMEDISCIPLINA', 'ASC')
                                        ->paginate(5)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Disciplina $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('disciplinas.index', ['disciplinas' => DB::table('disciplina')
                                        ->join('professor', 'professor.CDPROFESSOR', '=', 'disciplina.CDPROFESSOR')
                                        ->join('curso', 'curso.CDCURSO', 'disciplina.CDCURSO')
                                        ->where('NOMEDISCIPLINA','like',$request->nomeMatricula.'%')
                                        ->orWhere('NOMECURSO', 'like', $request->nomeMtricula.'%')
                                        ->orderBy('NOMEDISCIPLINA', 'ASC')
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
        $professores = DB::table('professor')->distinct()->get();
        $cursos = DB::table('curso')->distinct()->get();
        return view('disciplinas.create', compact('professores', 'cursos'));
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
        $disciplinaValidate = DB::table('disciplina')->select('id')
                                                     ->where('NOMEDISCIPLINA', 'like' , $request->NOMEDISCIPLINA)
                                                     ->where('CDPROFESSOR', '=', $request->CDPROFESSOR)
                                                     ->count();
        if($disciplinaValidate > 0){
            $error = 1;
            return redirect()->route('disciplina.index', compact('error'))->withStatus(__('Não foi possível realizar o cadastro pois o mesmo já existe!'));
        }


        $disciplina = new Disciplina;
        $disciplina->create($request->all());
        return redirect()->route('disciplina.index', compact('error'))->withStatus(__('Cadastro realizado com sucesso!.'));
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
        $professores = DB::table('professor')->distinct()->get();
        $disciplina = Disciplina::findOrFail($id);
        $cursos = DB::table('curso')->distinct()->get();
        return view('disciplinas.edit', compact('disciplina', 'professores', 'cursos'));
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
        $disciplina = Disciplina::findOrFail($id);
        $disciplina->update($request->all());
        return redirect()->route('disciplina.index', compact('error'))->withStatus(__('Disciplina atualizada com sucesso.'));
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
        $disciplina = Disciplina::findOrFail($id);
        $disciplina->delete();
        $error = 0;
        return redirect()->route('disciplina.index', compact('error'))->withStatus(__('Disciplina deletada com sucesso.'));
    }
}
