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
        if ((auth()->user()->permissao) == 2) return abort(404);
        return view('matdisciplinas.index', ['matriculas' => DB::table('matdisciplina')
                                        ->select('aluno.NOME', 'disciplina.NOMEDISCIPLINA', 'matdisciplina.MEDIA', 'matdisciplina.STATUS', 'matdisciplina.VALOR', 'matdisciplina.CDMATDISCIPLINA', 'semestre.ANO')
                                        ->join('matricula', 'matricula.CDMATRICULA', '=', 'matdisciplina.CDMATRICULA')
                                        ->join('aluno', 'aluno.CDALUNO', '=', 'matricula.CDALUNO')
                                        ->join('curso', 'curso.CDCURSO', '=', 'matricula.CDCURSO')
                                        ->join('semestre', 'semestre.CDSEMESTRE', '=', 'matricula.CDSEMESTRE')
                                        ->join('turma', 'turma.CDTURMA', '=', 'matricula.CDTURMA')
                                        ->join('disciplina', 'matdisciplina.CDDISCIPLINA', '=', 'disciplina.CDDISCIPLINA')
                                        ->orderBy('aluno.NOME', 'asc')
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
        return view('matdisciplinas.index', ['matriculas' => DB::table('matdisciplina')
                                        ->select('aluno.NOME', 'disciplina.NOMEDISCIPLINA', 'matdisciplina.MEDIA', 'matdisciplina.STATUS', 'matdisciplina.VALOR', 'matdisciplina.CDMATDISCIPLINA', 'semestre.ANO')
                                        ->join('matricula', 'matdisciplina.CDMATRICULA', '=', 'matricula.CDMATRICULA')
                                        ->join('disciplina', 'matdisciplina.CDDISCIPLINA', '=', 'disciplina.CDDISCIPLINA')
                                        ->join('aluno', 'aluno.CDALUNO', '=', 'matricula.CDALUNO')
                                        ->join('curso', 'curso.CDCURSO', '=', 'matricula.CDCURSO')
                                        ->join('semestre', 'semestre.CDSEMESTRE', '=', 'matricula.CDSEMESTRE')
                                        ->join('turma', 'turma.CDTURMA', '=', 'matricula.CDTURMA')
                                        ->where('NOMEDISCIPLINA','like',$request->nomeMatricula.'%')
                                        ->orWhere('NOME','like', $request->nomeMatricula.'%')
                                        ->orWhere('ANO','like', $request->nomeMatricula.'%')
                                        ->orderBy('aluno.NOME', 'asc')
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
        $semestres = DB::table('semestre')->distinct()->orderBy('ANO', 'desc')->get();
        $disciplinas = DB::table('disciplina')->distinct()->orderBy('NOMEDISCIPLINA', 'asc')->get();
        $alunos = DB::table('aluno')->select('NOME','CDMATRICULA','ANO')
                                    ->join('matricula', 'matricula.CDALUNO', '=', 'aluno.CDALUNO')
                                    ->join('semestre', 'matricula.CDSEMESTRE', '=', 'semestre.CDSEMESTRE')
                                    ->orderBy('NOME', 'desc')
                                    ->distinct()
                                    ->get();
        return view('matdisciplinas.create', compact('disciplinas','cursos','alunos','semestres'));
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
        $error = '';
        foreach ($request->CDDISCIPLINA as $key => $value) {
            $matDisciplina = DB::table('matdisciplina')->select('NOMEDISCIPLINA')
                                                    ->join('matricula', 'matricula.CDMATRICULA', 'matdisciplina.CDMATRICULA')
                                                    ->join('disciplina', 'disciplina.CDDISCIPLINA', 'matdisciplina.CDDISCIPLINA')
                                                    ->where('matricula.CDMATRICULA', '=' , $request->CDMATRICULA)
                                                    ->where('disciplina.CDDISCIPLINA', '=', $value)
                                                    ->get();
            $matDisciplinaValidate = DB::table('matdisciplina')->select('id', 'NOMEDISCIPLINA')
                                                               ->join('matricula', 'matricula.CDMATRICULA', 'matdisciplina.CDMATRICULA')
                                                               ->join('disciplina', 'disciplina.CDDISCIPLINA', 'matdisciplina.CDDISCIPLINA')
                                                               ->where('matricula.CDMATRICULA', '=' , $request->CDMATRICULA)
                                                               ->where('disciplina.CDDISCIPLINA', '=', $value)
                                                               ->count();
            if($matDisciplinaValidate > 0){
                $error = $error.$matDisciplina[0]->NOMEDISCIPLINA.', ';
            } else {
                $disciplina = Disciplina::findOrFail($value);
                $matdisciplina = new Matdisciplina;
                $matdisciplina->CDMATRICULA = $request->CDMATRICULA;
                $matdisciplina->MEDIA = 0;
                $matdisciplina->STATUS = 'MT';
                $matdisciplina->CDPROFESSOR = $disciplina->CDPROFESSOR;
                $matdisciplina->CDDISCIPLINA = $value;
                $matdisciplina->VALOR = $request->VALOR;
                $matdisciplina->save();    
            }

           
        }

        return redirect()->route('matdisciplina.index', compact('error'))->withStatus(__('Cadastro realizado com sucesso!.'));
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
        $mat = Matdisciplina::findOrFail($id);
        $matdisciplina = Disciplina::findOrFail($mat->CDDISCIPLINA);
        $matricula = Matricula::findOrFail($mat->CDMATRICULA);

        $cursos = DB::table('disciplina')->distinct()->orderBy('NOMEDISCIPLINA', 'desc')->get();
        $alunos = DB::table('aluno')->join('matricula', 'matricula.CDALUNO', '=', 'aluno.CDALUNO')
                                    ->join('semestre', 'matricula.CDSEMESTRE', '=', 'semestre.CDSEMESTRE')
                                    ->orderBy('NOME', 'desc')
                                    ->distinct()
                                    ->get();
        return view('matdisciplinas.edit', compact('cursos', 'alunos', 'matdisciplina', 'matricula', 'mat'));
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
        $matDisciplinaValidate = DB::table('matdisciplina')->select()
                                                           ->join('matricula', 'matdisciplina.CDMATRICULA', 'matricula.CDMATRICULA')
                                                           ->where('CDALUNO', '=' , $request->CDALUNO)
                                                           ->where('CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                                           ->where('CDSEMESTRE', '=', $request->CDSEMESTRE)
                                                           ->count();


        $matMesmaDisciplina = DB::table('matdisciplina')->select()
                                                        ->where('CDMATDISCIPLINA', '=' , $request->CDMATDISCIPLINA)
                                                        ->where('CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                                        ->where('CDMATRICULA', '=', $request->CDMATRICULA)
                                                        ->count();      
                                        
        if($matDisciplinaValidate > 0 && $matMesmaDisciplina == 0){
            $error = 1;
            return redirect()->route('matdisciplina.index', compact('error'))->withStatus(__('Não foi possível realizar o cadastro pois o mesmo já existe!'));
        }

        $matricula = Matdisciplina::findOrFail($id);
        $matricula->update($request->all());
        return redirect()->route('matdisciplina.index', compact('error'))->withStatus(__('Matricula na disciplina atualizada com sucesso.'));
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
        $error = 0;
        $matricula = Matdisciplina::findOrFail($id);
        $matricula->delete();
        return redirect()->route('matdisciplina.index', compact('error'))->withStatus(__('Matricula na disciplina deletada com sucesso.'));
    }


    public function alunoCursoSemestre(Request $request)
    {


        $alunos = DB::table('aluno')->select()
                                     ->join('matricula', 'matricula.CDALUNO', 'aluno.CDALUNO')
                                     ->join('semestre', 'matricula.CDSEMESTRE', 'semestre.CDSEMESTRE')
                                     ->join('curso','matricula.CDCURSO', 'curso.CDCURSO')
                                     ->where('curso.CDCURSO', '=', $request->CDCURSO)
                                     ->where('semestre.CDSEMESTRE', '=', $request->CDSEMESTRE)
                                     ->orderBy('NOME', 'asc')
                                     ->get();


        return $alunos;
    }


}
