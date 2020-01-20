<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Meu perfil') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Configurações') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Atividades') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Suporte') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Sair') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a @if($current == "painel") class="nav-link active" @else class="nav-link" @endif href="{{ route('home') }}">
                        <i class="fas fa-home text-primary"></i> {{ __('Página inicial') }}
                    </a>
                </li>
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Gestão</h6>
            <!-- Navigation -->

            @if(auth()->user()->permissao == 1)       
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a @if($current == "usuarios") class="nav-link text-dark active" @else class="nav-link" @endif href="{{ route('user.index') }}">
                        <i class="ni ni-circle-08 text-blue"></i> {{ __('Usuários') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a @if($current == "cursos") class="nav-link text-dark active" @else class="nav-link" @endif href="{{ route('curso.index') }}">
                        <i class="fas fa-graduation-cap text-blue"></i> {{ __('Cursos') }}
                    </a>
                </li>
               <li class="nav-item">
                    <a @if($current == "alunos") class="nav-link text-dark active" @else class="nav-link" @endif href="{{ route('aluno.index') }}">
                        <i class="fas fa-user-graduate text-blue"></i> {{ __('Alunos') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a @if($current == "professores") class="nav-link text-dark active" @else class="nav-link" @endif href="{{ route('professor.index') }}">
                        <i class="fas fa-chalkboard-teacher text-blue"></i> {{ __('Professores') }}
                    </a>
                </li>                
                <li class="nav-item">
                    <a @if($current == "disciplinas") class="nav-link text-dark active" @else class="nav-link" @endif href="{{ route('disciplina.index') }}">
                        <i class="fas fa-book text-blue"></i> {{ __('Disciplinas') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a @if($current == "semestres") class="nav-link text-dark active" @else class="nav-link" @endif href="{{ route('semestre.index') }}">
                        <i class="fas fa-calendar-alt text-blue"></i> {{ __('Semestres') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a @if($current == "turmas") class="nav-link text-dark active" @else class="nav-link" @endif href="{{ route('turma.index') }}">
                        <i class="fas fa-users text-blue"></i> {{ __('Turmas') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a @if($current == "matriculas") class="nav-link text-dark active" @else class="nav-link" @endif href="{{ route('matricula.index') }}">
                        <i class="ni ni-bullet-list-67 text-blue"></i> {{ __('Matricula') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a @if($current == "matdisciplina") class="nav-link text-dark active" @else class="nav-link" @endif href="{{ route('matdisciplina.index') }}">
                        <i class="fas fa-book-reader text-blue"></i> {{ __('Mat. Disciplina') }}
                    </a>
                </li>
            </ul>
            @else
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a @if($current == "nota") class="nav-link text-dark active" @else class="nav-link" @endif href="{{ route('lancarnotas.index') }}">
                        <i class="fas fa-file-alt text-blue"></i> {{ __('Lançar notas') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a @if($current == "frequencia") class="nav-link text-dark active" @else class="nav-link" @endif href="{{ route('frequencias.index') }}">
                        <i class="ni ni-book-bookmark text-blue"></i> {{ __('Lançar frequência') }}
                    </a>
                </li>
             
            </ul>
            @endif
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
        </div>
    </div>
</nav>