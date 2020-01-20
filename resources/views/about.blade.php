@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    <div class="header py-7 py-lg-7">
        <div class="container">
            <div class="header-body text-center mt-5 mb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-6" style="color: black;">
                        <h1  style="border-bottom: 1px solid black;">{{ __('Freinet - Gestão Escolar.') }}</h1>
                        <h2  style="padding-bottom: 1.5em;">Desenvolvido por <a style="color: #093991;" href="mailto:calebepereira.tec@gmail.com?subject=Sistema Freinet - Gestão Escolar" target="_Blank"> Calebe Gomes Pereira</a></h2>
                        <p>Projeto de sistema web apresentado a disciplina Laboratório de Programação Web II no Instituto Federal de Educação Ciência e Tecnologia Baiano - <i>Campus</i> Guanambi do curso superior em Tecnologia em Análise e Desenvolvimento de Sistemas como requisito parcial de avaliação.</p>

                        <p>Tecnologias: PHP, JavaScript, HTML5, Laravel e MySQL.</p>
                    </div>
                </div>
            </div>
        </div>
@endsection