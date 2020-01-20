@extends('layouts.app', ['title' => __('Edição de cadastro'), "current" => "frequencia"])

@section('content')
    @include('layouts.headers.header')

    <div class="container-fluid mt--9">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center" style="margin-bottom: 1em;">
                            <div class="col-md-6">
                                <div class="card">
                                    <div style="width: 100%; text-align: center; margin-top: 0.5em">
                                        <i class="fas fa-chalkboard-teacher text-blue" style="font-size: 30pt"></i>
                                    </div>
                                  <div class="card-body" style="padding-top: 0.5em">
                                    <h1 class="card-title" style="width: 100%; text-align: center; margin-top: 0.1em; margin-bottom: 0.1em;">{{$qDisciplinas}}</h1>
                                    <h2 class="card-title" style="width: 100%; text-align: center; margin-bottom: 0.5em; margin-top: 0.1em">Disciplinas ministradas</h2>
                                  </div>
                                </div>  
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
                            <div class="col-md-12">
                                <h4>Clique no semestre, na turma e na disciplina que deseja lançar a frequência.</h4>

                                @foreach($semestres as $keysem => $semestre)
                                <ul style="list-style-type: none; padding: 0">
                                    <li class="nav-item">
                                        <a class="nav-link" style="background-color: #fbfcfc; border: 1px solid #a5a3a3d4; border-radius:  5px; width: 87%;" href="#navbar-S{{$keysem}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                                            <span class="nav-link-text">{{$semestre->ANO}}</span>
                                        </a>
                                        <div class="collapse" id="navbar-S{{$keysem}}">

                                            @foreach($turmas as $keytur => $turma)
                                            <ul class="nav nav-sm flex-column" style="flex-wrap: nowrap;">
                                                <li class="nav-item">
                                                    <a class="nav-link" style="background-color: #f3f7f7; border: 1px solid #a5a3a3d4; border-radius: 5px; margin-top: 0.2em; margin-left: 0.5em; width: 92%;" href="#navbarT-{{$keysem}}{{$keytur}}" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                                                        <span class="nav-link-text">{{ $turma->NOMETURMA }}</span>
                                                    </a>
                                                    <div class="collapse" id="navbarT-{{$keysem}}{{$keytur}}">

                                                        @foreach($disciplinas as $keydis => $disciplina)
                                                        <ul class="nav nav-sm flex-column" style="flex-wrap: nowrap;">
                                                            <li class="nav-item">
                                                                <a class="nav-link" style="background-color: #e7f7f7; border: 1px solid #a5a3a3d4; border-radius: 5px; margin-top: 0.2em; margin-left: 1em; width: 97%;" href="{{route('frequencia.nota', ['CDSEMESTRE' =>$semestre->CDSEMESTRE, 'CDTURMA' => $turma->CDTURMA, 'CDDISCIPLINA' => $disciplina->CDDISCIPLINA])}}">
                                                                    <span class="nav-link-text">{{ $disciplina->NOMEDISCIPLINA }}</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                            @endforeach


                                        </div>
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection