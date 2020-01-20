@extends('layouts.app', ['class' => 'bg-transp'])

@section('content')
    <div class="header py-8 py-lg-8" style="background-color: rgba();">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-8">
                        <img class="img-fluid" src="{{asset('argon')}}/img/theme/logo.png">
                        <img class="img-fluid" src="{{asset('argon')}}/img/theme/logo2.png">
                        <br>
                        <a href="{{ route('login') }}">
                            <img class="img-fluid" style="width: 15em" src="{{asset('argon')}}/img/theme/btn.gif">
                        </a>
                        <p><a href="{{ route('about') }}">Sobre</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt--6"></div>


@endsection
