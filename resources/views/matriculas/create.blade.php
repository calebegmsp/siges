@extends('layouts.app', ['title' => __('User Management'), "current" => "matriculas"])

@section('content')
    @include('users.partials.header', ['title' => __('Cadastro de matricula')])   

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
                                <a href="{{ route('matricula.index') }}" class="btn btn-sm btn-primary">{{ __('Voltar a lista') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('matricula.store') }}" autocomplete="off" id="form" enctype="multipart/form-data">
                            @csrf
                            <div id="div-cdcurso"></div>
                            <h6 class="pl-lg-4 text-muted mb-3 h5">{{ __('* preenchemento obrigatório.') }}</h6>
                                    <div class="row">
                                        <fieldset class="col-12" style="margin-top: 0.5em;">
                                            <div class="pl-lg-4">
                                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Aluno *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <select id="input-aluno" class="form-control" name="CDALUNO" required onchange="javascript: checkMatricula();">
                                                                    <option value="">
                                                                        SELECIONE
                                                                    </option>
                                                                    @foreach($alunos as $aluno)
                                                                    <option value="{{$aluno->CDALUNO}}">
                                                                        {{$aluno->NOME}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Curso *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <select id="input-curso" class="form-control" name="CDCURSO" required>
                                                                    <option value="">
                                                                        SELECIONE
                                                                    </option>
                                                                    @foreach($cursos as $curso)
                                                                    <option value="{{$curso->CDCURSO}}">
                                                                        {{$curso->NOMECURSO}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>   
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Semestre *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <select class="form-control" name="CDSEMESTRE" required>
                                                                    <option value="">
                                                                        SELECIONE
                                                                    </option>
                                                                    @foreach($semestres as $semestre)
                                                                    <option value="{{$semestre->CDSEMESTRE}}">
                                                                        {{$semestre->ANO}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Turma *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <select class="form-control" name="CDTURMA" required>
                                                                    <option value="">
                                                                        SELECIONE
                                                                    </option>
                                                                    @foreach($turmas as $turma)
                                                                    <option value="{{$turma->CDTURMA}}">
                                                                        {{$turma->NOMETURMA}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Valor *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <input class="form-control" type="number" name="VALOR" required min="0" placeholder="Digite o valor" step="0.01">
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
                                        <button type="reset" class="btn btn-warning mt-4">Limpar</button> 
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

    function selectCurso(curso){
        if (curso == 0) {
            document.getElementById('input-curso').value = '';
            document.getElementById('input-curso').removeAttribute('disabled');
            document.getElementById('div-cdcurso').innerHTML = ""
        } else {
            document.getElementById('input-curso').value = curso;
            document.getElementById('input-curso').setAttribute('disabled', true);
            document.getElementById('div-cdcurso').innerHTML = "<input type='hidden' name='CDCURSO' value='" +curso+ "'> "
        }
    }


    function checkMatricula(){
        document.getElementById('input-aluno').disabled = true;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            data: {'CDALUNO':document.getElementById('input-aluno').value},
            url: "{{ route('matricula.checkMatricula')}}",
            success: function (e)
            {   
                selectCurso(e);
                document.getElementById('input-aluno').disabled = false;
            }
        });
    }
</script>

@endsection

