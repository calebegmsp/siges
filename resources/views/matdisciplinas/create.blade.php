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
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Curso *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <select id="s-curso" class="form-control" name="CDCURSO" required onchange="javascript:AlunoCursoSemestre()">
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
                                                        <div class="col-md-4">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Semestre *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <select id="s-semestre" class="form-control" name="CDSEMESTRE" required onchange="javascript:AlunoCursoSemestre()">
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
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Aluno *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <select id="select-aluno" class="form-control" name="CDMATRICULA" required>
                                                                    <option value="">
                                                                        SELECIONE
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-control-label" for="input-nome" id="label-nome">{{ __('Valor *') }}</label>
                                                            <div id="div-input-election_title">
                                                                <input class="form-control" type="number" name="VALOR" placeholder="Valor" min="0" step="0.01" placeholder="Digite o valor" required>
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
                                @foreach ($disciplinas as $key => $disciplina)

                                    <tr>
                                        <td class="col-md inputGroup" style="padding: 0 !important; margin: 0 !important; border-radius: 2px;">
                                            <input id="option{{$key}}" name="CDDISCIPLINA[]" value="{{$disciplina->CDDISCIPLINA}}" type="checkbox"/>
                                            <label for="option{{$key}}" style="margin-bottom: 0;">{{ $disciplina->NOMEDISCIPLINA}}</label>
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

    function logArrayElements(element, index, array) {


        $("#select-aluno").html($("#select-aluno").html() + '<option value="'+ element.CDMATRICULA +'">' + element.NOME + '</option>');

    }

    function selectAlunos(alunos){
        $("#select-aluno").html('<option value=""> SELECIONE </option>');
        alunos.forEach(logArrayElements);
        document.getElementById('select-aluno').disabled = false;
    }


    function AlunoCursoSemestre(){
        if (document.getElementById('s-curso').value != '' && document.getElementById('s-semestre').value != '') {
            document.getElementById('select-aluno').setAttribute('disabled', true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                data: {'CDCURSO':document.getElementById('s-curso').value,'CDSEMESTRE':document.getElementById('s-semestre').value },
                url: "{{ route('matdisciplina.alunoCursoSemestre')}}",
                success: function (e)
                {   
                    selectAlunos(e);
                }
            });    
        }
        
    }
</script>


@endsection

