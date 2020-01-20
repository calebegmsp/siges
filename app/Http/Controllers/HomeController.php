<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Finance;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $qCursos = DB::table('curso')->select('')->count();
        $qDisciplinas = DB::table('disciplina')->select('')->count();
        $qSemestres = DB::table('semestre')->select('')->count();
        $qTurmas = DB::table('turma')->select('')->count();
        $qAlunos = DB::table('aluno')->select('')->count();
        $qProfessores = DB::table('professor')->select('')->count();

        return view('dashboard', compact('qCursos', 'qDisciplinas', 'qSemestres', 'qTurmas', 'qAlunos', 'qProfessores'));
    }

}
