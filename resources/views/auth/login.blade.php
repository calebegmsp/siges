@extends('layouts.app', ['class' => 'bg-transp'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-8">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-7">
                <div class="card bg-secondary shadow border-8">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-2">
                            <small>
                                <h2>{{ __('Entrar no sistema') }}</h2>
                            </small>
                            <br>
                        </div>
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf                  

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" value="" required autofocus style="padding-left: 0.7em">
                                </div> 
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input id="input-password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Senha') }}" type="password" value="" required style="padding-left: 0.7em">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Entrar') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

<script type="text/javascript">
    
    function ViewPassword() {
        if (document.getElementById("customCheckLogin").checked){
            document.getElementById("input-password").type = "text";
        } else {
            document.getElementById("input-password").type = "password";
        }
    }

</script>

@endpush