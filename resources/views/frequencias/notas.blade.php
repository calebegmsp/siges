@extends('layouts.app', ['title' => __('Lançar notas'), "current" => "frequencia"])

@section('content')
    @include('users.partials.header', ['title' => __('Frequência')])  
    @if(isset($error))
        <?php $error = 0; $media = 0; ?>
    @endif
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
                            <div class="col-2 text-right">
                                <a href="{{route('frequencia.lancarnotas', ['CDSEMESTRE' =>$request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA])}}" class="btn btn-sm btn-primary">{{ __('Novo lançamento') }}</a>
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

                    <div class="table-responsive" id="tableFreque">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 50%;">{{ __('Aluno') }}</th>
                                    @foreach($qAvaliacoes as $key => $value)
                                    <th style="width: auto; padding: 0;">
                                        <div class="row" style="text-align: center;">
                                            <nav id="colorNav" style="width: 100%">
                                            <ul style="width: 100%;">
                                                <li class="green">
                                                    <a href="#">{{ date('d/m',strtotime($value->DATA))}}</a>
                                                    <ul>
                                                        <li><a href="{{route('frequencia.edit', ['CDSEMESTRE' =>$request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA, 'REFERENCIA' => $value->DATA])}}" style="color: #07177d">Editar</a></li>
                                                        <li><a href="{{route('frequencia.destroy', ['CDSEMESTRE' =>$request->CDSEMESTRE, 'CDTURMA' => $request->CDTURMA, 'CDDISCIPLINA' => $request->CDDISCIPLINA, 'REFERENCIA' => $value->DATA])}}" style="color: #960808">Excluir</a></li>
                                                        <!-- More dropdown options -->
                                                    </ul>
                                                </li>

                                            </ul>
                                            </nav>    
                                        </div>
                                    </th>
                                    @endforeach
                                    <th style="padding-left: 1em; padding-right: 1em; text-align: center; width: 2em">{{ __('Total') }}</th>
                                    <th style="width: auto"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @csrf
                                @method('put')
                               @foreach($alunos as $key => $aluno)
                               <?php $media = 0; $quant = 0; ?>
                                    <tr>
                                        <td style="white-space: pre-wrap;">{{$aluno->NOME}}</td>

                                        @foreach($aluno->notas as $keyan => $alunonota)
                                            <td class="noPading" style="border-left: 1px solid #e9ecef; text-align: center; @if($alunonota->FALTAS > 0) color: red; @else color: blue;@endif">{{number_format($alunonota->FALTAS, 0, ',', ' ')}}</td>

                                             <?php $media += $alunonota->FALTAS; $quant++; ?>

                                        @endforeach
                                        
                                        @if($quant > 0)
                                        <td class="noPading" style="border-left: 1px solid #e9ecef; text-align: center;">
                                            <?php  ?>
                                            <span style="font-weight: bold;">{{ number_format($media, 0, ',', ' ')}}</span>
                                        </td>
                                        @else
                                        <td style="border-left: 1px solid #e9ecef; text-align: center;">

                                        </td>
                                        @endif

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
                </div>
            </div>
        </div>
    </div>



@endsection