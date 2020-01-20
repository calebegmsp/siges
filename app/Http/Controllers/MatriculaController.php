<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matricula;
use App\Aluno;
use Illuminate\Support\Facades\DB;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Matricula $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('matriculas.index', ['matriculas' => DB::table('matricula')
                                        ->select('NMATRICULA', 'NOME', 'ANO', 'NOMECURSO', 'NOMETURMA', 'VALOR', 'CDMATRICULA')
                                        ->join('aluno', 'aluno.CDALUNO', '=', 'matricula.CDALUNO')
                                        ->join('curso', 'curso.CDCURSO', '=', 'matricula.CDCURSO')
                                        ->join('semestre', 'semestre.CDSEMESTRE', '=', 'matricula.CDSEMESTRE')
                                        ->join('turma', 'turma.CDTURMA', '=', 'matricula.CDTURMA')
                                        ->orderBy('NMATRICULA', 'desc')
                                        ->paginate(5)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Matricula $model, Request $request)
    {   
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('matriculas.index', ['matriculas' => DB::table('matricula')
                                        ->join('aluno', 'aluno.CDALUNO', '=', 'matricula.CDALUNO')
                                        ->join('curso', 'curso.CDCURSO', '=', 'matricula.CDCURSO')
                                        ->join('semestre', 'semestre.CDSEMESTRE', '=', 'matricula.CDSEMESTRE')
                                        ->join('turma', 'turma.CDTURMA', '=', 'matricula.CDTURMA')
                                        ->where('NMATRICULA','like','%'.$request->nomeMatricula.'%')
                                        ->orWhere('NOME','like', $request->nomeMatricula.'%')
                                        ->orWhere('NOMECURSO', 'like', $request->nomeMatricula.'%')
                                        ->orWhere('NOMETURMA', 'like', $request->nomeMatricula.'%')
                                        ->orderBy('NMATRICULA', 'desc')
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
        $cursos = DB::table('curso')->distinct()->orderBy('NOMECURSO', 'asc')->get();

        $alunos = DB::table('aluno')->distinct()
                                    ->orderBy('NOME', 'asc')
                                    ->get();
        /*$alunos = DB::table('aluno')->distinct()
                                    ->orderBy('NOME', 'desc')
                                    ->whereNotIn('aluno.CDALUNO',
                                        DB::table('aluno')->select('aluno.CDALUNO')
                                                          ->join('matricula', 'matricula.CDALUNO', 'aluno.CDALUNO')
                                    )
                                    ->get();*/


        $semestres = DB::table('semestre')->orderBy('ANO', 'desc')->distinct()->get();
        $turmas = DB::table('turma')->distinct()->orderBy('NOMETURMA', 'desc')->get();
        return view('matriculas.create', compact('cursos','alunos','semestres','turmas'));
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
        $mat = DB::table('matricula')->where('CDALUNO', '=', $request->CDALUNO)
                                     ->where('CDSEMESTRE', '=', $request->CDSEMESTRE)
                                     ->get();
        if (sizeof($mat) > 0){
            $error = 1;
            return redirect()->route('matricula.index', compact('error'))->withStatus(__('Cadastro não realizado! Já existe um cadastro dessa matrícula nesse semestre.'));
        }
        $mat = DB::table('matricula')->where('CDALUNO', '=', $request->CDALUNO)
                                     ->where('CDTURMA', '=', $request->CDTURMA)
                                     ->get();
        if (sizeof($mat) > 0){
            $error = 1;
            return redirect()->route('matricula.index', compact('error'))->withStatus(__('Cadastro não realizado! Já existe um cadastro dessa matrícula nessa turma.'));
        }

        $matricula = new Matricula;
        $matricula->create($request->all());
        return redirect()->route('matricula.index', compact('error'))->withStatus(__('Cadastro realizado com sucesso!.'));
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
        $matricula = Matricula::findOrFail($id);
        $alunos = DB::table('aluno')->orderBy('NOME', 'asc')->distinct()->get();
        $semestres = DB::table('semestre')->orderBy('ANO', 'desc')->distinct()->get();
        $turmas = DB::table('turma')->orderBy('NOMETURMA', 'desc')->distinct()->get();
        return view('matriculas.edit', compact('matricula','alunos','semestres','turmas'));
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
        $matricula = Matricula::findOrFail($id);
        $matricula->update($request->all());
        return redirect()->route('matricula.index', compact('error'))->withStatus(__('Matricula(a) atualizado(a) com sucesso.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $error = 0;
        if ((auth()->user()->permissao) == 2) return abort(404);
        $matricula = Matricula::findOrFail($id);
        $matricula->delete();
        return redirect()->route('matricula.index', compact('error'))->withStatus(__('Matricula deletada com sucesso.'));
    }


    public function checkMatricula(Request $request)
    {
        $matricula = DB::table('matricula')->where('CDALUNO', '=', $request->CDALUNO)->get();

        if (sizeof($matricula) > 0) {
            return $matricula[0]->CDCURSO;
        } else {
            return 0;
        }
    }

}
