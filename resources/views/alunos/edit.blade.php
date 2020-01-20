@extends('layouts.app', ['title' => __('User Management'), "current" => "alunos"])

@section('content')
    @include('users.partials.header', ['title' => __('Cadastro de aluno')])   

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
                                <a href="{{ route('aluno.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar a lista') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('aluno.update', $aluno) }}" autocomplete="off" id="form">
                            @csrf
                            <h6 class="pl-lg-4 text-muted mb-3 h5">{{ __('* preenchemento obrigatório.') }}</h6>
                                    <div class="row">
                                        <fieldset class="col-12" style="margin-top: 0.5em;">
                                            <div class="pl-lg-4">
                                                <legend>Dados pessoais</legend>
                                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Nome *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <input type="text" name="NOME" id="input-nome" class="form-control" placeholder="{{ __('Digite o nome') }}" value="{{$aluno->NOME}}">
                                                            </div>
                                                        </div>   
                                                        <div class="col-md-3">
                                                            <label class="form-control-label" id="label-election_section">{{ __('Status *') }}</label>
                                                            <div id="div-input-election_section">
                                                                <select id="input-status" class="form-control" name="STATUS" size="1" required style="margin-top: 0.1em;">
                                                                    <option>Selecione o status</option>
                                                                    <option value="CD">Cadastrado</option>
                                                                    <option value="AT">Ativo</option>
                                                                    <option value="DE">Desativo</option>
                                                                    <option value="TR">Trancado</option>
                                                                </select>
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
                                        <button type="reset" class="btn btn-warning mt-4" onBlur="restaurar()">Restaurar</button> 
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


<script type="text/javascript">

    document.getElementById('input-status').value = '{{$aluno->STATUS}}';

    function restaurar(){
        $("#input-status").val('{{$aluno->STATUS}}');
    }

</script>


@endsection
