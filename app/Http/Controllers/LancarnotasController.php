<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matricula;
use App\Matdisciplina;
use App\Aluno;
use App\Nota;
use App\Disciplina;
use Illuminate\Support\Facades\DB;

class LancarnotasController extends Controller
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
        return view('lancarnotas.index', compact('qDisciplinas', 'semestres', 'turmas', 'disciplinas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Matricula $model, Request $request)
    {   
        if ((auth()->user()->permissao) != 2) return abort(404);
        return view('lancarnotas.index', ['matriculas' => DB::table('matdisciplina')
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

        $qAvaliacoes = DB::table('nota')->select('REFERENCIA', 'nota.created_at')
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
                                  ->orderBy('nota.created_at', 'ASC')
                                  ->get('REFERENCIA', 'NOTA');




        foreach ($alunos as $key => $value) {
            $alunos[$key]->notas = DB::table('nota')->select('NOTA', 'nota.created_at')
                                  ->join('matdisciplina', 'nota.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->where('matdisciplina.CDMATDISCIPLINA', '=', $value->CDMATDISCIPLINA)
                                  ->distinct()
                                  ->orderBy('nota.created_at')
                                  ->get('REFERENCIA', 'NOTA');
        }


        return view('lancarnotas.notas', compact('alunos', 'qAvaliacoes', 'nomeSemestre', 'nomeTurma', 'nomeDisciplina', 'request'));

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
        return view('lancarnotas.create', compact('cursos','alunos'));
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
                                  ->where('nota.REFERENCIA', 'like', $request->REFERENCIA)
                                  ->distinct()
                                  ->get('REFERENCIA', 'NOTA');

        if (sizeof($nameExist) > 0) {
           $error = 1;
            return redirect()->route('lancarnotas.nota', ['CDSEMESTRE' =>$request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA, 'error' => $error])->withStatus(__('Já existe uma avaliação de mesmo nome.'));
        }

        foreach ($request->NOTA as $key => $value) {
          $nota = new Nota;
          $nota->CDMATDISCIPLINA = $key;
          $nota->NOTA = $value[0];
          $nota->REFERENCIA = $request->REFERENCIA;

          $nota->save();
        }

        return redirect()->route('lancarnotas.nota', ['CDSEMESTRE' => $request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA, 'error' => $error])->withStatus(__('Avaliação e notas lançadas com sucesso!.'));
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

        $alunos = DB::table('aluno')->select('NOME', 'matdisciplina.CDMATDISCIPLINA', 'NOTA', 'REFERENCIA', 'CDNOTA')
                                  ->join('matricula', 'aluno.CDALUNO', 'matricula.CDALUNO')
                                  ->join('matdisciplina', 'matdisciplina.CDMATRICULA', 'matricula.CDMATRICULA')
                                  ->join('disciplina', 'matdisciplina.CDDISCIPLINA', 'disciplina.CDDISCIPLINA')
                                  ->join('turma', 'turma.CDTURMA', 'matricula.CDTURMA')
                                  ->join('semestre', 'semestre.CDSEMESTRE', 'matricula.CDSEMESTRE')
                                  ->join('nota', 'nota.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->where('semestre.CDSEMESTRE', '=', $request->CDSEMESTRE)
                                  ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                  ->where('turma.CDTURMA', '=', $request->CDTURMA)
                                  ->where('nota.REFERENCIA', 'like', $request->REFERENCIA)
                                  ->orderBy('NOME')
                                  ->get();



        foreach ($alunos as $key => $value) {
            $alunos[$key]->notas = DB::table('nota')->select('NOTA')
                                  ->join('matdisciplina', 'nota.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->where('matdisciplina.CDMATDISCIPLINA', '=', $value->CDMATDISCIPLINA)
                                  ->distinct()
                                  ->get('REFERENCIA', 'NOTA');
        }


        return view('lancarnotas.edit', compact('alunos', 'nomeSemestre', 'nomeTurma', 'nomeDisciplina', 'request'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ((auth()->user()->permissao) != 2) return abort(404);
        $error = '';

        $CDNOTA = new Nota;
        if ($request->REFERENCIA_ANT != $request->REFERENCIA) {

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
                                    ->where('nota.REFERENCIA', 'like', $request->REFERENCIA)
                                    ->distinct()
                                    ->get('REFERENCIA', 'NOTA');

          if (sizeof($nameExist) > 0) {
             $error = 1;
              return redirect()->route('lancarnotas.nota', ['CDSEMESTRE' =>$request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA, 'error' => $error])->withStatus(__('Já existe uma avaliação de mesmo nome.'));
          }
        }

        foreach ($request->NOTA as $key => $value) {
          $nota =  Nota::findOrFail($key);
          $nota->NOTA = $value[0];
          $nota->REFERENCIA = $request->REFERENCIA;
          $nota->save();
        }
       
        return redirect()->route('lancarnotas.nota', ['CDSEMESTRE' => $request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA, 'error' => $error])->withStatus(__('Avaliação e notas editadas com sucesso!.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

        $alunos = DB::table('aluno')->select('NOME', 'matdisciplina.CDMATDISCIPLINA', 'NOTA', 'REFERENCIA', 'CDNOTA')
                                  ->join('matricula', 'aluno.CDALUNO', 'matricula.CDALUNO')
                                  ->join('matdisciplina', 'matdisciplina.CDMATRICULA', 'matricula.CDMATRICULA')
                                  ->join('disciplina', 'matdisciplina.CDDISCIPLINA', 'disciplina.CDDISCIPLINA')
                                  ->join('turma', 'turma.CDTURMA', 'matricula.CDTURMA')
                                  ->join('semestre', 'semestre.CDSEMESTRE', 'matricula.CDSEMESTRE')
                                  ->join('nota', 'nota.CDMATDISCIPLINA', 'matdisciplina.CDMATDISCIPLINA')
                                  ->where('semestre.CDSEMESTRE', '=', $request->CDSEMESTRE)
                                  ->where('disciplina.CDDISCIPLINA', '=', $request->CDDISCIPLINA)
                                  ->where('turma.CDTURMA', '=', $request->CDTURMA)
                                  ->where('nota.REFERENCIA', 'like', $request->REFERENCIA)
                                  ->orderBy('NOME')
                                  ->get();


        foreach ($alunos as $key => $value) {
          $nota =  Nota::findOrFail($value->CDNOTA);
          $nota->delete();
        }

         return redirect()->route('lancarnotas.nota', ['CDSEMESTRE' => $request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA, 'error' => $error])->withStatus(__('Avaliação e notas excluidas com sucesso!.'));

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


        return view('lancarnotas.lancarnotas', compact('alunos', 'qAvaliacoes', 'nomeSemestre', 'nomeTurma', 'nomeDisciplina', 'request'));

    }

    public function checkNomeAvali(Request $request){

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
