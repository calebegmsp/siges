@extends('layouts.app', ['title' => __('User Management'), "current" => "turmas"])

@section('content')
    @include('users.partials.header', ['title' => __('Cadastro de turma')])   

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
                                <a href="{{ route('turma.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar a lista') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('turma.update', $turma) }}" autocomplete="off" id="form" enctype="multipart/form-data">
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
                                                                <input type="text" name="NOMETURMA" id="input-nome" class="form-control" placeholder="{{ __('Digite o nome') }}" value="{{$turma->NOMETURMA}}">
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

