@extends('layouts.app', ['title' => __('User Management'), "current" => "matdisciplina"])

@section('content')
    @include('users.partials.header', ['title' => __('Cadastro de Mat. disciplina')])   

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
                                <a href="{{ route('matdisciplina.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar a lista') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('matdisciplina.store') }}" autocomplete="off" id="form" enctype="multipart/form-data">
                            @csrf
                            <h6 class="pl-lg-4 text-muted mb-3 h5">{{ __('* preenchemento obrigatório.') }}</h6>
                                    <div class="row">
                                        <fieldset class="col-12" style="margin-top: 0.5em;">
                                            <div class="pl-lg-4">
                                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Aluno *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <select class="form-control" name="CDMATRICULA" required>
                                                                    <option value="">
                                                                        SELECIONE
                                                                    </option>
                                                                    @foreach($alunos as $aluno)
                                                                    <option value="{{$aluno->CDMATRICULA}}">
                                                                        {{$aluno->NOME}} - {{$aluno->ANO}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Valor *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <input class="form-control" type="number" name="VALOR" placeholder="Valor" min="0" placeholder="Digite o valor" required>
                                                            </div>
                                                        </div>   
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('SELECIONE AS DISCIPLINA') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @csrf
                                @method('POST')
                                @foreach ($cursos as $key => $disciplina)

                                    <tr>
                                        <td class="col-md inputGroup" style="padding: 0 !important; margin: 0 !important; border-radius: 2px;">
                                            <input id="option{{$key}}" name="CDDISCIPLINA[]" value="{{$disciplina->CDDISCIPLINA}}" type="checkbox"/>
                                            <label for="option{{$key}}">{{ $disciplina->NOMEDISCIPLINA}}</label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                                        </fieldset>
                                    </div>
                            </div> 
                                <div class="row justify-content-end" style="margin-right: 0.5em; margin-bottom: 1em;">   
                                    <div class="col-6" style="text-align: right;">
                                        <button type="reset" class="btn btn-warning mt-4" onClick="clearFuction();">Limpar</button> 
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

