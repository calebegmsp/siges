@extends('layouts.app', ['title' => __('User Profile'), "current" => "alunos"])

@section('content')
    @include('users.partials.header', [
        'title' => __('Ficha de informações'),
        'class' => 'col-lg'
    ])   


    <div class="container-fluid mt--8">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow" style="height: 100%;">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{asset('storage/peoples/'.$people->photo)}}" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    <!--
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4">{{ __('E-mail') }}</a>
                            <a href="#" class="btn btn-sm btn-default float-right">{{ __('Telefone') }}</a>
                        </div>
                    -->
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    <div>
                                        @if ($people->type_person == 'A' && $people->sex == 'M')
                                            <span class="heading">Associado</span>
                                        @endif
                                        @if ($people->type_person == 'A' && $people->sex == 'F')
                                            <span class="heading">Associada</span>
                                        @endif
                                        @if ($people->type_person == 'D' && $people->sex == 'M')
                                            <span class="heading">Doador</span>
                                        @endif
                                        @if ($people->type_person == 'D' && $people->sex == 'F')
                                            <span class="heading">Doadora</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5>
                                {{ $people->name }} - <span id="age">Idade: </span>
                                <input type="hidden" id="age_" value="{{$people->birth_date}}">
                            </h5>
                            <hr class="my-4" />
                            <h4>
                                {{ __('Atividades desenvolvidas')}}
                            </h4>
                            <p>
                                @if($people->c_confined == 1)Criação de confinadas <br>
                                @endif
                                @if($people->c_s_confined == 1)Criação de semi-confinadas  <br>
                                @endif
                                @if($people->livestock == 1)Pecuária  <br>
                                @endif
                                @if($people->dry_agriculture == 1)Agricultura de sequeiro  <br>
                                @endif
                                @if($people->irr_agriculture == 1)Agricultura irrigada
                                @endif
                            </p>
                            <hr class="my-4" />
                            <h4>
                                @if ($people->legal_aspect == 'P')
                                    @if ($people->sex == 'M')
                                     Proprietáro
                                    @else
                                     Proprietária
                                    @endif
                                @else
                                    @if ($people->sex == 'M')
                                     Comodatário
                                    @else
                                     Comodatária
                                    @endif
                                @endif
                            </h4>
                            <p>{{ __('Aréa de atividade:') }} {{ $people->activity_area }} {{ __('ha')}}</p>
                            <hr class="my-4" />
                            <h5>{{ __('Imprimir documentos') }}</h5>
                            <div class="row">
                                <div class="col-md">
                                    <a target="_blanck" href="{{ route('peoples.print', $people) }}" class="btn btn-outline-default" style="width: 100%;">{{ __('ficha') }}</a>
                                </div>
                                <div class="col-md">
                                    <a href="#" class="btn btn-outline-default" style="width: 100%;">{{ __('carteirinha') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Informações do cadastro')}}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="personal_data">

                            <h6 class="heading-small text-muted mb-4">{{ __('Identificação do sócio') }}</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">

                                <div class="row">
                                    <div class="col-6">
                                        <label>
                                            <span class="form-control-label">{{__('Nome:')}}</span>
                                            {{$people->name}}
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Data de nascimento:')}}</label>
                                        <label>{{date("d/m/Y", strtotime($people->birth_date))}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('CPF:')}}</label>
                                        <label class="">{{$people->cpf}}</label>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('RG:')}}</label>
                                        <label>{{$people->rg}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Estado cívil:')}}</label>
                                        <label>
                                        @if($people->sex == 'M') {{$people->marital_status}}O @endif @if($people->sex == 'F') {{$people->marital_status}}A @endif
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Sexo:')}}</label>
                                        <label>@if ($people->sex == "M") MASCULINO
                                            @else FEMININO
                                            @endif</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Naturalidade:')}}</label>
                                        <label>{{$people->naturalness}}</label>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Telefone fixo:')}}</label>
                                        <label>{{$people->phone}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Nacionalidade:')}}</label>
                                        <label>{{$people->nationality}}</label>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Telefone celular:')}}</label>
                                        <label>{{$people->tel}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label>
                                            <span class="form-control-label">{{__('Nome da mãe:')}}</span>
                                            {{$people->mother_name}}
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label>
                                            <span class="form-control-label">{{__('Nome do pai:')}}</span>
                                            {{$people->dad_name}}
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Data de filiação:')}}</label>
                                        <label>{{date("d/m/Y", strtotime($people->affiliation_date))}}</label>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('E-mail:')}}</label>
                                        <label><a href="mailto:{{ old('email', $people->email) }}">{{ $people->email}}</a></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($people->marital_status == 'CASAD' || $people->marital_status == 'AMASIAD')
 
                        <hr class="my-4" />
                        <div id="spouse_data">

                            <h6 class="heading-small text-muted mb-4">{{ __('Identificação do cônjugue') }}</h6>

                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-6">
                                        <label>
                                            <span class="form-control-label">{{__('Nome:')}}</span>
                                            {{$people->spouse}}
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('CPF:')}}</label>
                                        <label>{{$people->cpf_spouse}}</label>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Data de nascimento:')}}</label>
                                        <label>{{date("d/m/Y", strtotime($people->birth_date_spouse))}}</label>
                                    </div>
                                    <div class="col-6">
                                        <label>
                                            <span class="form-control-label">{{__('Nome da mãe:')}}</span>
                                            {{$people->spouse_mother_name}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <hr class="my-4" />
                        <div id="personal_address">

                            <h6 class="heading-small text-muted mb-4">{{ __('Endereço do sócio') }}</h6>

                            <div class="pl-lg-4">

                                <div class="row">
                                    <div class="col-6">
                                        <label>
                                            <span class="form-control-label">{{__('Logradouro:')}}</span>
                                            {{$address->public_place}}
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Número:')}}</label>
                                        <label>{{ $address->number_home}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label>
                                            <span class="form-control-label">{{__('Bairro ou distrito:')}}</span>
                                            {{$address->district}}
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <label>
                                            <span class="form-control-label">{{__('Complemento:')}}</span>
                                            {{$address->complement}}
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('CEP:')}}</label>
                                        <label class="">{{$address->cep}}</label>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Cidade:')}}</label>
                                        <label>{{$address->city}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Unidade federativa:')}}</label>
                                        <label class="">{{$address->uf}}</label>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('País:')}}</label>
                                        <label>{{$address->country}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4" />
                        <div id="electoral_data">

                            <h6 class="heading-small text-muted mb-4">{{ __('Dados eleitorais do sócio') }}</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">

                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Número de inscrição:')}}</label>
                                        <label>{{$people->election_title}}</label>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control-label">{{__('Zona eleitoral:')}}</label>
                                        <label class="">{{$people->electoral_zone}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label class="form-control-label">{{__('Seção eleitoral:')}}</label>
                                        <label>{{$people->election_section}}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')

<script src="{{ asset('argon') }}/vendor/validators/dist/scriptValidators.js"></script>

<script type="text/javascript">
  
  returnAge(); 

</script>

@endpush