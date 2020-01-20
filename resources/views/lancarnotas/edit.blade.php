@extends('layouts.app', ['title' => __('Lançar notas'), "current" => "nota"])

@section('content')
    @include('users.partials.header', ['title' => __('Nova avaliação')])  
    @if(isset($error))
        <?php $error = 0; $media = 0; ?>
    @endif
    <?php $media = 0; $quant = 0; ?>
    <div class="container-fluid mt--8">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-10">
                                <ul id="breadcrumb" style="padding: 0; margin: 0">
                                  <li><a href="{{route('lancarnotas.index')}}"><span class="icon icon-home"> </span></a></li>
                                  <li><a href="#" style="pointer-events: none;"><i class="far fa-calendar-alt"></i> {{$nomeSemestre}}</a></li>
                                  <li><a href="#" style="pointer-events: none;"><i class="fas fa-users"></i> {{$nomeTurma}}</a></li>
                                  <li><a href="#" style="pointer-events: none;"><i class="fas fa-book"></i> {{$nomeDisciplina}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert 
                            @if($_GET['error'] == 1) alert-warning @else alert-success @endif
                            alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <form method="post" action="{{ route('lancarnotas.update') }}" autocomplete="off" id="form" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="CDSEMESTRE" value="{{$request->CDSEMESTRE}}">
                        <input type="hidden" name="CDTURMA" value="{{$request->CDTURMA}}">
                        <input type="hidden" name="CDDISCIPLINA" value="{{$request->CDDISCIPLINA}}">
                        <div class="row" style="padding-left: 1.6em; margin-bottom: 1em">
                            <div class="col-md-3">
                                <label class="form-control-label" for="" id="label-nome">{{ __('Nome da avaliação *') }} <span id="aler-exist" style="color: red; display: none;">Já existe!</span></label>
                                <input id="nameAvali" type="text" class="form-control" name="REFERENCIA" placeholder="Ex: Prova 1" onblur="javascript:checkNomeAvaliacao();" required min="3" value="{{$request->REFERENCIA}}" maxlength="10">
                                <input type="hidden" name="REFERENCIA_ANT" value="{{$request->REFERENCIA}}">
                            </div>
                        </div>

                        <div class="table-responsive" id="tbody">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 40%">{{ __('Aluno') }}</th>
                                        <th style="width: 2em">{{ __('Nota') }}</th>
                                        <th style="width: auto"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                   @foreach($alunos as $key => $aluno)
                                        <tr>
                                            <td  style="white-space: pre-wrap;">{{$aluno->NOME}}</td>

                                            <td style="border-left: 1px solid #e9ecef; text-align: center;">
                                                <input style="width: 8em; height: 3em" class="form-control inputNota" type="number" name="NOTA[{{$aluno->CDNOTA}}][]" value="{{number_format($aluno->NOTA, 1, '.', ' ')}}" min="0" max="10" step="0.1" required>
                                            </td>

                                            <td style="border-left: 1px solid #e9ecef; text-align: center;"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if(sizeof($alunos) == 0)
                            <div style="width: 100%; text-align: center;">
                                <span style="color: red;">Não foram encontrados resultados.</span>
                            </div>   
                            @endif
                            <div class="card-footer py-4">
                                <nav class="d-flex justify-content-end" aria-label="...">
                                    {{ false }}
                                </nav>
                            </div>
                        </div>
                        <div class="row justify-content-end" style="margin-right: 0.5em; margin-bottom: 1em;">   
                            <div class="col-6" style="text-align: right;">
                                <button type="reset" class="btn btn-warning mt-4" onClick="clearFuction();">Restaurar</button> 
                                <button type="submit" class="btn btn-success mt-4">{{ __('Salvar') }}</button>
                            </div>             
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>

@push('js')
<script>

    $(document).ready(function(){
        $('.inputNota').mask('00.0', {reverse:true});
    });



    function nameExiste(a) {
        if (a == 1) {
            document.getElementById('nameAvali').style.border = '1px solid #fb0000';
            document.getElementById('aler-exist').style.display = 'initial';

        } else {
            document.getElementById('nameAvali').style.border = '1px solid #cad1d7';
            document.getElementById('aler-exist').style.display = 'none';
        }
    }



    function checkNomeAvaliacao(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            data: {'NOME':document.getElementById('nameAvali').value, 'CDSEMESTRE': {{$request->CDSEMESTRE}}, 'CDTURMA': {{$request->CDTURMA}}, 'CDDISCIPLINA': {{$request->CDDISCIPLINA}} },
            url: "{{route('matricula.checkNomeAvali')}}",
            success: function (e)
            {   
                nameExiste(e);
            }
        });
    }

</script>
@endpush

@endsection