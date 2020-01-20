<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matricula;
use App\Matdisciplina;
use App\Aluno;
USE App\Frequencia;
use App\Nota;
use App\Disciplina;
use Illuminate\Support\Facades\DB;

class FrequenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Matricula $model, Request $request)
    {   
        if ((auth()->user()->permissao) != 2) return abort(404);

        $semestres = DB::table('semestre')->orderBy('ANO','desc')->get();

        $turmas = DB::table('turma')->orderBy('NOMETURMA', 'desc')->get();

        $disciplinas = DB::table('disciplina')
                                            ->join('professor', 'professor.CDPROFESSOR', 'disciplina.CDPROFESSOR')
                                            ->where('professor.IDUSER', '=', auth()->user()->id)
                                            ->orderBy('NOMEDISCIPLINA', 'asc')
                                            ->get();



        $qDisciplinas = DB::table('disciplina')->select('')
                                            ->join('professor','professor.CDPROFESSOR','disciplina.CDPROFESSOR')
                                            ->where('professor.IDUSER','=', auth()->user()->id)->count();
        return view('frequencias.index', compact('qDisciplinas', 'semestres', 'turmas', 'disciplinas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Matricula $model, Request $request)
    {   
        if ((auth()->user()->permissao) != 2) return abort(404);
        return view('frequencias.index', ['matriculas' => DB::table('matdisciplina')
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
                                        ->paginate(15)], compact('request'));
                                                
    }


    public function nota(Request $request)
    {   
        function resume( $var, $limite ){
            if (strlen($var) > $limite){       
                $var = substr($var, 0, $limite);        
                $var = trim($var) . "...";  
            }
            return $var;
        }
        if ((auth()->user()->permissao) != 2) return abort(404);

        $disciplinas = DB::table('disciplina')
                                            ->join('professor', 'professor.CDPROFESSOR', 'disciplina.CDPROFESSOR')
                                            ->where('professor.IDUSER', '=', auth()->user()->id)
                                            ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                            ->count();

        if ($disciplinas == 0) {
            return abort(404);
        }

        $nomeSemestre = DB::table('semestre')->select('ANO')->where('CDSEMESTRE', '=', $request->CDSEMESTRE)->get();
        $nomeTurma = DB::table('turma')->select('NOMETURMA')->where('CDTURMA', '=', $request->CDTURMA)->get();
        $nomeDisciplina = DB::table('disciplina')->select('NOMEDISCIPLINA')->where('CDDISCIPLINA', '=', $request->CDDISCIPLINA)->get();
        $nomeSemestre = resume($nomeSemestre[0]->ANO, 6);
        $nomeTurma = resume($nomeTurma[0]->NOMETURMA, 10);
        $nomeDisciplina = resume($nomeDisciplina[0]->NOMEDISCIPLINA, 40);

        $alunos = DB::table('aluno')->select('NOME', 'CDMATDISCIPLINA')
                                  ->join('matricula', 'aluno.CDALUNO', 'matricula.CDALUNO')
                                  ->join('matdisciplina', 'matdisciplina.CDMATRICULA', 'matricula.CDMATRICULA')
                                  ->join('disciplina', 'matdisciplina.CDDISCIPLINA', 'disciplina.CDDISCIPLINA')
                                  ->join('turma', 'turma.CDTURMA', 'matricula.CDTURMA')
                                  ->join('semestre', 'semestre.CDSEMESTRE', 'matricula.CDSEMESTRE')
                                  ->where('semestre.CDSEMESTRE', '=', $request->CDSEMESTRE)
                                  ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                  ->where('turma.CDTURMA', '=', $request->CDTURMA)
                                  ->orderBy('NOME')
                                  ->get();

        $qAvaliacoes = DB::table('frequencia')->select('DATA', 'frequencia.created_at')
                                  ->join('matdisciplina', 'frequencia.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->join('matricula', 'matdisciplina.CDMATRICULA', 'matricula.CDMATRICULA')
                                  ->join('aluno', 'aluno.CDALUNO', 'matricula.CDALUNO')
                                  ->join('disciplina', 'matdisciplina.CDDISCIPLINA', 'disciplina.CDDISCIPLINA')
                                  ->join('turma', 'turma.CDTURMA', 'matricula.CDTURMA')
                                  ->join('semestre', 'semestre.CDSEMESTRE', 'matricula.CDSEMESTRE')
                                  ->where('semestre.CDSEMESTRE', '=', $request->CDSEMESTRE)
                                  ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                  ->where('turma.CDTURMA', '=', $request->CDTURMA)
                                  ->distinct()
                                  ->orderBy('frequencia.created_at', 'ASC')
                                  ->get('DATA', 'FALTAS');




        foreach ($alunos as $key => $value) {
            $alunos[$key]->notas = DB::table('frequencia')->select('FALTAS', 'frequencia.created_at')
                                  ->join('matdisciplina', 'frequencia.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->where('matdisciplina.CDMATDISCIPLINA', '=', $value->CDMATDISCIPLINA)
                                  ->distinct()
                                  ->orderBy('frequencia.created_at')
                                  ->get('DATA', 'FALTAS');
        }


        return view('frequencias.notas', compact('alunos', 'qAvaliacoes', 'nomeSemestre', 'nomeTurma', 'nomeDisciplina', 'request'));

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ((auth()->user()->permissao) != 2) return abort(404);
        $cursos = DB::table('disciplina')->distinct()->orderBy('NOMEDISCIPLINA', 'desc')->get();
        $alunos = DB::table('aluno')->select('NOME','CDMATRICULA','ANO')
                                    ->join('matricula', 'matricula.CDALUNO', '=', 'aluno.CDALUNO')
                                    ->join('semestre', 'matricula.CDSEMESTRE', '=', 'semestre.CDSEMESTRE')
                                    ->orderBy('NOME', 'desc')
                                    ->distinct()
                                    ->get();
        return view('frequencias.create', compact('cursos','alunos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ((auth()->user()->permissao) != 2) return abort(404);
        $error = '';

        $nameExist = DB::table('frequencia')->select('DATA')
                                  ->join('matdisciplina', 'frequencia.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->join('matricula', 'matdisciplina.CDMATRICULA', 'matricula.CDMATRICULA')
                                  ->join('aluno', 'aluno.CDALUNO', 'matricula.CDALUNO')
                                  ->join('disciplina', 'matdisciplina.CDDISCIPLINA', 'disciplina.CDDISCIPLINA')
                                  ->join('turma', 'turma.CDTURMA', 'matricula.CDTURMA')
                                  ->join('semestre', 'semestre.CDSEMESTRE', 'matricula.CDSEMESTRE')
                                  ->where('semestre.CDSEMESTRE', '=', $request->CDSEMESTRE)
                                  ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                  ->where('turma.CDTURMA', '=', $request->CDTURMA)
                                  ->where('frequencia.DATA', 'like', $request->DATA)
                                  ->distinct()
                                  ->get('DATA', 'FALTAS');

        if (sizeof($nameExist) > 0) {
           $error = 1;
            return redirect()->route('frequencia.nota', ['CDSEMESTRE' =>$request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA, 'error' => $error])->withStatus(__('As frequências dessa data já foram lançadas.'));
        }

        foreach ($request->NOTA as $key => $value) {
          $nota = new Frequencia;
          $nota->CDMATDISCIPLINA = $key;
          $nota->FALTAS = $value[0];
          $nota->DATA = $request->DATA;

          $nota->save();
        }

        return redirect()->route('frequencia.nota', ['CDSEMESTRE' => $request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA, 'error' => $error])->withStatus(__('Frequências lançadas com sucesso!.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ((auth()->user()->permissao) != 2) return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   
        function resume( $var, $limite ){
            if (strlen($var) > $limite){       
                $var = substr($var, 0, $limite);        
                $var = trim($var) . "...";  
            }
            return $var;
        }
        if ((auth()->user()->permissao) != 2) return abort(404);

        $disciplinas = DB::table('disciplina')
                                            ->join('professor', 'professor.CDPROFESSOR', 'disciplina.CDPROFESSOR')
                                            ->where('professor.IDUSER', '=', auth()->user()->id)
                                            ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                            ->count();

        if ($disciplinas == 0) {
            return abort(404);
        }

        $nomeSemestre = DB::table('semestre')->select('ANO')->where('CDSEMESTRE', '=', $request->CDSEMESTRE)->get();
        $nomeTurma = DB::table('turma')->select('NOMETURMA')->where('CDTURMA', '=', $request->CDTURMA)->get();
        $nomeDisciplina = DB::table('disciplina')->select('NOMEDISCIPLINA')->where('CDDISCIPLINA', '=', $request->CDDISCIPLINA)->get();
        $nomeSemestre = resume($nomeSemestre[0]->ANO, 6);
        $nomeTurma = resume($nomeTurma[0]->NOMETURMA, 10);
        $nomeDisciplina = resume($nomeDisciplina[0]->NOMEDISCIPLINA, 40);

        $alunos = DB::table('aluno')->select('NOME', 'matdisciplina.CDMATDISCIPLINA', 'FALTAS', 'DATA', 'CDFREQUENCIA')
                                  ->join('matricula', 'aluno.CDALUNO', 'matricula.CDALUNO')
                                  ->join('matdisciplina', 'matdisciplina.CDMATRICULA', 'matricula.CDMATRICULA')
                                  ->join('disciplina', 'matdisciplina.CDDISCIPLINA', 'disciplina.CDDISCIPLINA')
                                  ->join('turma', 'turma.CDTURMA', 'matricula.CDTURMA')
                                  ->join('semestre', 'semestre.CDSEMESTRE', 'matricula.CDSEMESTRE')
                                  ->join('frequencia', 'frequencia.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->where('semestre.CDSEMESTRE', '=', $request->CDSEMESTRE)
                                  ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                  ->where('turma.CDTURMA', '=', $request->CDTURMA)
                                  ->where('frequencia.DATA', 'like', $request->REFERENCIA)
                                  ->orderBy('NOME')
                                  ->get();



        foreach ($alunos as $key => $value) {
            $alunos[$key]->notas = DB::table('frequencia')->select('DATA')
                                  ->join('matdisciplina', 'frequencia.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->where('matdisciplina.CDMATDISCIPLINA', '=', $value->CDMATDISCIPLINA)
                                  ->distinct()
                                  ->get('FALTAS', 'DATA');
        }


        return view('frequencias.edit', compact('alunos', 'nomeSemestre', 'nomeTurma', 'nomeDisciplina', 'request'));
    }







    public function update(Request $request)
    {
        if ((auth()->user()->permissao) != 2) return abort(404);
        $error = '';

        $CDNOTA = new Nota;
        if ($request->REFERENCIA_ANT != $request->REFERENCIA) {

          $nameExist = DB::table('frequencia')->select('DATA')
                                    ->join('matdisciplina', 'frequencia.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                    ->join('matricula', 'matdisciplina.CDMATRICULA', 'matricula.CDMATRICULA')
                                    ->join('aluno', 'aluno.CDALUNO', 'matricula.CDALUNO')
                                    ->join('disciplina', 'matdisciplina.CDDISCIPLINA', 'disciplina.CDDISCIPLINA')
                                    ->join('turma', 'turma.CDTURMA', 'matricula.CDTURMA')
                                    ->join('semestre', 'semestre.CDSEMESTRE', 'matricula.CDSEMESTRE')
                                    ->where('semestre.CDSEMESTRE', '=', $request->CDSEMESTRE)
                                    ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                    ->where('turma.CDTURMA', '=', $request->CDTURMA)
                                    ->where('frequencia.DATA', 'like', $request->REFERENCIA)
                                    ->distinct()
                                    ->get('DATA', 'FALTAS');

          if (sizeof($nameExist) > 0) {
             $error = 1;
              return redirect()->route('frequencia.nota', ['CDSEMESTRE' =>$request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA, 'error' => $error])->withStatus(__('Já existe frequencias lançada na mesma data.'));
          }
        }

        foreach ($request->NOTA as $key => $value) {
          $nota =  Frequencia::findOrFail($key);
          $nota->FALTAS = $value[0];
          $nota->DATA = $request->REFERENCIA;
          $nota->save();
        }
       
        return redirect()->route('frequencia.nota', ['CDSEMESTRE' => $request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA, 'error' => $error])->withStatus(__('Frequencias editadas com sucesso!.'));
    }






    public function destroy(Request $request)
    {
        if ((auth()->user()->permissao) != 2) return abort(404);
        $error = 0;
        function resume( $var, $limite ){
            if (strlen($var) > $limite){       
                $var = substr($var, 0, $limite);        
                $var = trim($var) . "...";  
            }
            return $var;
        }
        $disciplinas = DB::table('disciplina')
                                            ->join('professor', 'professor.CDPROFESSOR', 'disciplina.CDPROFESSOR')
                                            ->where('professor.IDUSER', '=', auth()->user()->id)
                                            ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                            ->count();

        if ($disciplinas == 0) {
            return abort(404);
        }

        $nomeSemestre = DB::table('semestre')->select('ANO')->where('CDSEMESTRE', '=', $request->CDSEMESTRE)->get();
        $nomeTurma = DB::table('turma')->select('NOMETURMA')->where('CDTURMA', '=', $request->CDTURMA)->get();
        $nomeDisciplina = DB::table('disciplina')->select('NOMEDISCIPLINA')->where('CDDISCIPLINA', '=', $request->CDDISCIPLINA)->get();
        $nomeSemestre = resume($nomeSemestre[0]->ANO, 6);
        $nomeTurma = resume($nomeTurma[0]->NOMETURMA, 10);
        $nomeDisciplina = resume($nomeDisciplina[0]->NOMEDISCIPLINA, 40);

        $alunos = DB::table('aluno')->select('NOME', 'matdisciplina.CDMATDISCIPLINA', 'FALTAS', 'DATA', 'CDFREQUENCIA')
                                  ->join('matricula', 'aluno.CDALUNO', 'matricula.CDALUNO')
                                  ->join('matdisciplina', 'matdisciplina.CDMATRICULA', 'matricula.CDMATRICULA')
                                  ->join('disciplina', 'matdisciplina.CDDISCIPLINA', 'disciplina.CDDISCIPLINA')
                                  ->join('turma', 'turma.CDTURMA', 'matricula.CDTURMA')
                                  ->join('semestre', 'semestre.CDSEMESTRE', 'matricula.CDSEMESTRE')
                                  ->join('frequencia', 'frequencia.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->where('semestre.CDSEMESTRE', '=', $request->CDSEMESTRE)
                                  ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                  ->where('turma.CDTURMA', '=', $request->CDTURMA)
                                  ->where('frequencia.DATA', 'like', $request->REFERENCIA)
                                  ->orderBy('NOME')
                                  ->get();


        foreach ($alunos as $key => $value) {
          $nota =  Frequencia::findOrFail($value->CDFREQUENCIA);
          $nota->delete();
        }

         return redirect()->route('frequencia.nota', ['CDSEMESTRE' => $request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA, 'error' => $error])->withStatus(__('Frequencias excluidas com sucesso!.'));

    }



 public function lancarnotas(Request $request)
    {   
        function resume( $var, $limite ){
            if (strlen($var) > $limite){       
                $var = substr($var, 0, $limite);        
                $var = trim($var) . "...";  
            }
            return $var;
        }
        if ((auth()->user()->permissao) != 2) return abort(404);

        $disciplinas = DB::table('disciplina')
                                            ->join('professor', 'professor.CDPROFESSOR', 'disciplina.CDPROFESSOR')
                                            ->where('professor.IDUSER', '=', auth()->user()->id)
                                            ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                            ->count();

        if ($disciplinas == 0) {
            return abort(404);
        }

        $nomeSemestre = DB::table('semestre')->select('ANO')->where('CDSEMESTRE', '=', $request->CDSEMESTRE)->get();
        $nomeTurma = DB::table('turma')->select('NOMETURMA')->where('CDTURMA', '=', $request->CDTURMA)->get();
        $nomeDisciplina = DB::table('disciplina')->select('NOMEDISCIPLINA')->where('CDDISCIPLINA', '=', $request->CDDISCIPLINA)->get();
        $nomeSemestre = resume($nomeSemestre[0]->ANO, 6);
        $nomeTurma = resume($nomeTurma[0]->NOMETURMA, 10);
        $nomeDisciplina = resume($nomeDisciplina[0]->NOMEDISCIPLINA, 40);

        $alunos = DB::table('aluno')->select('NOME', 'CDMATDISCIPLINA')
                                  ->join('matricula', 'aluno.CDALUNO', 'matricula.CDALUNO')
                                  ->join('matdisciplina', 'matdisciplina.CDMATRICULA', 'matricula.CDMATRICULA')
                                  ->join('disciplina', 'matdisciplina.CDDISCIPLINA', 'disciplina.CDDISCIPLINA')
                                  ->join('turma', 'turma.CDTURMA', 'matricula.CDTURMA')
                                  ->join('semestre', 'semestre.CDSEMESTRE', 'matricula.CDSEMESTRE')
                                  ->where('semestre.CDSEMESTRE', '=', $request->CDSEMESTRE)
                                  ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                  ->where('turma.CDTURMA', '=', $request->CDTURMA)
                                  ->orderBy('NOME')
                                  ->get();

        $qAvaliacoes = DB::table('nota')->select('REFERENCIA')
                                  ->join('matdisciplina', 'nota.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->join('matricula', 'matdisciplina.CDMATRICULA', 'matricula.CDMATRICULA')
                                  ->join('aluno', 'aluno.CDALUNO', 'matricula.CDALUNO')
                                  ->join('disciplina', 'matdisciplina.CDDISCIPLINA', 'disciplina.CDDISCIPLINA')
                                  ->join('turma', 'turma.CDTURMA', 'matricula.CDTURMA')
                                  ->join('semestre', 'semestre.CDSEMESTRE', 'matricula.CDSEMESTRE')
                                  ->where('semestre.CDSEMESTRE', '=', $request->CDSEMESTRE)
                                  ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                  ->where('turma.CDTURMA', '=', $request->CDTURMA)
                                  ->distinct()
                                  ->get('REFERENCIA', 'NOTA');




        foreach ($alunos as $key => $value) {
            $alunos[$key]->notas = DB::table('nota')->select('NOTA')
                                  ->join('matdisciplina', 'nota.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->where('matdisciplina.CDMATDISCIPLINA', '=', $value->CDMATDISCIPLINA)
                                  ->distinct()
                                  ->get('REFERENCIA', 'NOTA');
        }


        return view('frequencias.lancarnotas', compact('alunos', 'qAvaliacoes', 'nomeSemestre', 'nomeTurma', 'nomeDisciplina', 'request'));

    }


    public function checkDataAvali(Request $request){

        $nameExist = DB::table('nota')->select('REFERENCIA')
                                  ->join('matdisciplina', 'nota.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->join('matricula', 'matdisciplina.CDMATRICULA', 'matricula.CDMATRICULA')
                                  ->join('aluno', 'aluno.CDALUNO', 'matricula.CDALUNO')
                                  ->join('disciplina', 'matdisciplina.CDDISCIPLINA', 'disciplina.CDDISCIPLINA')
                                  ->join('turma', 'turma.CDTURMA', 'matricula.CDTURMA')
                                  ->join('semestre', 'semestre.CDSEMESTRE', 'matricula.CDSEMESTRE')
                                  ->where('semestre.CDSEMESTRE', '=', $request->CDSEMESTRE)
                                  ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                  ->where('turma.CDTURMA', '=', $request->CDTURMA)
                                  ->where('nota.REFERENCIA', 'like', $request->NOME)
                                  ->distinct()
                                  ->get('REFERENCIA', 'NOTA');

        if (sizeof($nameExist) > 0) {
          return 1;
        } else{
          return 0;
        }

    }

    
}
