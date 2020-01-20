@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div>
        <!-- Table -->
        <div class="row justify-content-center" style="width: 98%">
            <div class="col-lg-6 col-md-8">
                <div class="card bg-warning shadow border-5">
                    <div class="card-header bg-transparent pb-3">
                        <div class="text-center text-muted mb-1">
                            <h3>Isso não funciona para você.</h3>
                            <span style="font-size:2em; color: white;">{{ __('Somente administradores podem cadastrar novos usuários') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
