@extends('layouts.app', ['title' => __('User Management'), "current" => "disciplinas"])

@section('content')
    @include('users.partials.header', ['title' => __('Cadastro de disciplina')])   

    <div class="container-fluid mt--8">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Dados do cadastro') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('professor.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar a lista') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('disciplina.update', $disciplina) }}" autocomplete="off" id="form" enctype="multipart/form-data">
                            @csrf
                            <h6 class="pl-lg-4 text-muted mb-3 h5">{{ __('* preenchemento obrigatório.') }}</h6>
                                    <div class="row">
                                        <fieldset class="col-12" style="margin-top: 0.5em;">
                                            <div class="pl-lg-4">
                                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Nome *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <input type="text" name="NOMEDISCIPLINA" id="input-nome" class="form-control" placeholder="{{ __('Digite o nome') }}" value="{{$disciplina->NOMEDISCIPLINA}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Professor *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <select class="form-control" name="CDPROFESSOR" required>
                                                                    <option class="">
                                                                        SELECIONE
                                                                    </option>
                                                                    @foreach($professores as $professor)
                                                                    <option value="{{$professor->CDPROFESSOR}}" @if($disciplina->CDPROFESSOR == $professor->CDPROFESSOR)Selected @endif>
                                                                        {{$professor->NOME}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Curso *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <select class="form-control" name="CDCURSO" required>
                                                                    <option value="">
                                                                        SELECIONE
                                                                    </option>
                                                                    @foreach($cursos as $curso)
                                                                    <option value="{{$curso->CDCURSO}}" @if($disciplina->CDCURSO == $curso->CDCURSO)Selected @endif>
                                                                        {{$curso->NOMECURSO}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div cl
                                                        <div class="col-md-4">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Valor *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <input type="number" name="VALOR" id="input-nome" class="form-control" placeholder="{{ __('Digite o valor') }}" value="{{$disciplina->VALOR}}" min="0" step="0.01">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                            </div> 
                                <div class="row justify-content-end" style="margin-right: 0.5em; margin-bottom: 1em;">   
                                    <div class="col-6" style="text-align: right;">
                                        <button type="reset" class="btn btn-warning mt-4" onClick="clearFuction();">Restaurar</button> 
                                        <button type="submit" class="btn btn-success mt-4">{{ __('Salvar') }}</button>
                                    </div>             
                                </div>  
                            </div>            
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>

@endsection
