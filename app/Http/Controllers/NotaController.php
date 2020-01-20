<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matricula;
use App\Matdisciplina;
use App\Aluno;
use App\Disciplina;
use Illuminate\Support\Facades\DB;

class MatdisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Matricula $model, Request $request)
    {   

        return view('matdisciplinas.index', ['matriculas' => DB::table('matdisciplina')
                                        ->join('matricula', 'matricula.CDMATRICULA', '=', 'matdisciplina.CDMATRICULA')
                                        ->join('aluno', 'aluno.CDALUNO', '=', 'matricula.CDALUNO')
                                        ->join('curso', 'curso.CDCURSO', '=', 'matricula.CDCURSO')
                                        ->join('semestre', 'semestre.CDSEMESTRE', '=', 'matricula.CDSEMESTRE')
                                        ->join('turma', 'turma.CDTURMA', '=', 'matricula.CDTURMA')
                                        ->join('disciplina', 'matdisciplina.CDDISCIPLINA', '=', 'disciplina.CDDISCIPLINA')
                                        ->orderBy('NMATRICULA', 'desc')
                                        ->paginate(15)]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Matricula $model, Request $request)
    {   
        return view('matdisciplinas.index', ['matriculas' => DB::table('matdisciplina')
                                        ->join('matricula', 'matdisciplina.CDMATRICULA', '=', 'matricula.CDMATRICULA')
                                        ->join('disciplina', 'matdisciplina.CDDISCIPLINA', '=', 'disciplina.CDDISCIPLINA')
                                        ->join('aluno', 'aluno.CDALUNO', '=', 'matricula.CDALUNO')
                                        ->join('curso', 'curso.CDCURSO', '=', 'matricula.CDCURSO')
                                        ->join('semestre', 'semestre.CDSEMESTRE', '=', 'matricula.CDSEMESTRE')
                                        ->join('turma', 'turma.CDTURMA', '=', 'matricula.CDTURMA')
                                        ->where('NOMEDISCIPLINA','like','%'.$request->nomeMatricula.'%')
                                        ->orWhere('NOME','like','%'.$request->nomeMatricula.'%')
                                        ->paginate(15)], compact('request'));
                                                
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = DB::table('disciplina')->distinct()->orderBy('NOMEDISCIPLINA', 'desc')->get();
        $alunos = DB::table('aluno')->join('matricula', 'matricula.CDALUNO', '=', 'aluno.CDALUNO')
                                    ->orderBy('NOME', 'desc')
                                    ->distinct()
                                    ->get();
        return view('matdisciplinas.create', compact('cursos','alunos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $matricula = DB::table('matricula')->distinct()->where('CDALUNO', '=', $request->CDALUNO)->get();
        $disciplina = Disciplina::findOrFail($request->CDDISCIPLINA);
        /*$mat = DB::table('matricula')->where('CDALUNO', '=', $request->CDALUNO)
                                     ->join('disciplina', 'CDDISCIPLINA', '=', 'matricula.CDDISCIPLINA')
                                     ->where('CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                     ->get();
        if (sizeof($mat) > 0){
            return redirect()->route('matdisciplina.index')->withStatus(__('Cadastro já existente!.'));
        }*/
        $matdisciplina = new Matdisciplina;
        $request->request->add(['CDMATRICULA' => $matricula[0]->CDMATRICULA]);
        $request->request->add(['MEDIA' => 0]);
        $request->request->add(['STATUS' => 'MT']);
        $request->request->add(['CDPROFESSOR' => $disciplina->CDPROFESSOR]);
        $matdisciplina->create($request->all());
        return redirect()->route('matdisciplina.index')->withStatus(__('Cadastro realizado com sucesso!.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $matdisciplina = Matricula::findOrFail($id);
        $cursos = DB::table('disciplina')->distinct()->orderBy('NOMEDISCIPLINA', 'desc')->get();
        $alunos = DB::table('aluno')->join('matricula', 'matricula.CDALUNO', '=', 'aluno.CDALUNO')
                                    ->orderBy('NOME', 'desc')
                                    ->distinct()
                                    ->get();
        return view('matdisciplinas.edit', compact('cursos','alunos', 'matdisciplina'));
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
        $matricula = Matricula::findOrFail($id);
        $matricula->update($request->all());
        return redirect()->route('matdisciplinas.index')->withStatus(__('Matricula(a) atualizado(a) com sucesso.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matricula = Matricula::findOrFail($id);
        $matricula->delete();
        return redirect()->route('matdisciplinas.index')->withStatus(__('Matricula(a) deletado(a) com sucesso.'));
    }
}
