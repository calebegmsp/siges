@extends('layouts.app', ['title' => __('Edição de cadastro'), "current" => "turmas"])

@section('content')
    @include('layouts.headers.header')
    @if(isset($error))
        <?php $error = 0; ?>
    @endif
    <div class="container-fluid mt--9">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Turmas cadastrados')}}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('turma.create') }}" class="btn btn-sm btn-primary">{{ __('Cadastrar turma') }}</a>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('turma.indexSearch') }}" method="post">
                        @csrf
                        @method('post')
                        <div class="row" style="margin-left: 0.5em;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        </div>
                                        <input id="input_nameOrCpf" class="form-control" name="nomeMatricula" placeholder="Procurar por nome" type="text" 
                                        value="@if(isset($request)){{$request->nomeMatricula}}@endif">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-icon btn-3 btn-secondary" type="submit">
                                    <span class="btn-inner--icon"><i class="fas fa-search" style="top: 0px;"></i></span>
                                    <span class="btn-inner--text">Buscar</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    
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

                    <div class="table-responsive" id="tbody">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col-md">{{ __('Nome') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @csrf
                                @method('put')
                                @foreach ($turmas as $turma)

                                    <tr>
                                        <td class="col-md">{{ $turma->NOMETURMA}}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"> 

                                                    <a class="dropdown-item" href="{{ route('turma.edit', $turma) }}">{{ __('Editar') }}
                                                    </a>

                                                    <a style="color: red;" class="dropdown-item" href="{{ route('turma.destroy', $turma) }}">{{ __('Deletar') }}
                                                    </a>
                                                                      
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(sizeof($turmas) == 0)
                        <div style="width: 100%; text-align: center;">
                            <span style="color: red;">Não foram encontrados resultados.</span>
                        </div>   
                        @endif
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">
                                {{ $turmas->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection