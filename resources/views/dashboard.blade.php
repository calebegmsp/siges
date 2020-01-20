@extends('layouts.app', ['title' => __('Edição de cadastro'), "current" => "painel"])

@section('content')
    @include('layouts.headers.header')

@if(auth()->user()->permissao == 1)

    <div class="container-fluid mt--9">
    	<div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                        	<div class="col-8">
                        		<h1 style="margin: 0;">Olá, {{auth()->user()->name}}.</h1>
                        		<h3>No quadro abaixo você encontra algumas estatística do sistema.</h3>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center" style="margin-bottom: 1em;">
                        	<div class="col">
	                        	<div class="card" style="width: 18rem;">
	                        		<div style="width: 100%; text-align: center; margin-top: 0.5em">
	                        			<i class="fas fa-graduation-cap text-blue" style="font-size: 30pt"></i>
	                        		</div>
								  <div class="card-body" style="padding-top: 0.5em">
								  	<h1 class="card-title" style="width: 100%; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">{{$qCursos}}</h1>
								  	<h2 class="card-title" style="width: 100%; text-align: center; margin-bottom: 0.5em; margin-top: 0.1em">Cursos</h2>
								    <a href="{{ route('curso.index') }}" class="btn btn-primary" style="width: 100%">Listar cursos</a>
								  </div>
								</div>	
                        	</div>
                        	
                        	<div class="col">
	                        	<div class="card" style="width: 18rem;">
	                        		<div style="width: 100%; text-align: center; margin-top: 0.5em">
	                        			<i class="fas fa-book text-green" style="font-size: 30pt"></i>
	                        		</div>
								  <div class="card-body" style="padding-top: 0.5em">
								  	<h1 class="card-title" style="width: 100%; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">{{$qDisciplinas}}</h1>
								  	<h2 class="card-title" style="width: 100%; text-align: center; margin-bottom: 0.5em; margin-top: 0.1em">Disciplinas</h2>
								    <a href="{{ route('disciplina.index') }}" class="btn btn-primary" style="width: 100%">Listar disciplinas</a>
								  </div>
								</div>	
                        	</div>
							
                        	<div class="col">
	                        	<div class="card" style="width: 18rem;">
	                        		<div style="width: 100%; text-align: center; margin-top: 0.5em">
	                        			<i class="fas fa-calendar-alt text-blue" style="font-size: 30pt"></i>
	                        		</div>
								  <div class="card-body" style="padding-top: 0.5em">
								  	<h1 class="card-title" style="width: 100%; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">{{$qSemestres}}</h1>
								  	<h2 class="card-title" style="width: 100%; text-align: center; margin-bottom: 0.5em; margin-top: 0.1em">Semestres</h2>
								    <a href="{{ route('semestre.index') }}" class="btn btn-primary" style="width: 100%">Listar semestres</a>
								  </div>
								</div>	
                        	</div>
						
                        </div>

                        <div class="row align-items-center" style="margin-bottom: 1em;">
                        	<div class="col">
	                        	<div class="card" style="width: 18rem;">
	                        		<div style="width: 100%; text-align: center; margin-top: 0.5em">
	                        			<i class="fas fa-users text-green" style="font-size: 30pt"></i>
	                        		</div>
								  <div class="card-body" style="padding-top: 0.5em">
								  	<h1 class="card-title" style="width: 100%; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">{{$qTurmas}}</h1>
								  	<h2 class="card-title" style="width: 100%; text-align: center; margin-bottom: 0.5em; margin-top: 0.1em">Turmas</h2>
								    <a href="{{ route('turma.index') }}" class="btn btn-primary" style="width: 100%">Listar turmas</a>
								  </div>
								</div>	
                        	</div>
                        	
                        	<div class="col">
	                        	<div class="card" style="width: 18rem;">
	                        		<div style="width: 100%; text-align: center; margin-top: 0.5em">
	                        			<i class="fas fa-user-graduate text-blue" style="font-size: 30pt"></i>
	                        		</div>
								  <div class="card-body" style="padding-top: 0.5em">
								  	<h1 class="card-title" style="width: 100%; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">{{$qAlunos}}</h1>
								  	<h2 class="card-title" style="width: 100%; text-align: center; margin-bottom: 0.5em; margin-top: 0.1em">Alunos</h2>
								    <a href="{{ route('aluno.index') }}" class="btn btn-primary" style="width: 100%">Listar alunos</a>
								  </div>
								</div>	
                        	</div>
							
                        	<div class="col">
	                        	<div class="card" style="width: 18rem;">
	                        		<div style="width: 100%; text-align: center; margin-top: 0.5em">
	                        			<i class="fas fa-chalkboard-teacher text-green" style="font-size: 30pt"></i>
	                        		</div>
								  <div class="card-body" style="padding-top: 0.5em">
								  	<h1 class="card-title" style="width: 100%; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">{{$qProfessores}}</h1>
								  	<h2 class="card-title" style="width: 100%; text-align: center; margin-bottom: 0.5em; margin-top: 0.1em">Professores</h2>
								    <a href="{{ route('professor.index') }}" class="btn btn-primary" style="width: 100%">Listar professores</a>
								  </div>
								</div>	
                        	</div>
						
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@else

    <div class="container-fluid mt--9">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center" style="margin-bottom: 1em; margin-left: 1em;">
                        	<div class="col-m3">
	                        	<h1>Olá, {{auth()->user()->name}}.</h1>
	                        	<h3>Seja bem-vindo, professor! Essa área foi feita especialmente para você gerenciar suas disciplinas.</h3>
                        	</div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endif

@endsection