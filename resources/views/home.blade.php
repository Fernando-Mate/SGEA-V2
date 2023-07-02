@extends('layouts.app')

@section('content')
    <div class="dashboard-wrapper">
        <!-- Topbar -->
        <div class="topbar">
            <ul class="topbar-menu">
                @if (Gate::allows('agente'))
                    <li class="topbar-item">
                        <a class="topbar-link" href="{{ route('alocacao') }}">
                            <i class="bi bi-people-fill"></i>
                            <span>Alocação</span>
                        </a>
                    </li>
                    <li class="topbar-item">
                        <a class="topbar-link" href="{{ route('funcionario') }}">
                            <i class="bi bi-person-circle"></i>
                            <span>Agentes</span>
                        </a>
                    </li>
                    <!-- Topbar Item -->
                    <li class="topbar-item">
                        <a class="topbar-link" href="{{ route('escala') }}">
                            <i class="bi bi-list-ul"></i>
                            <span>Escalas</span>
                        </a>
                    </li>
                @endif

                @if (Gate::allows('admin'))
                    <li class="topbar-item">
                        <a class="topbar-link" href="{{ route('alocacao') }}">
                            <i class="bi bi-people-fill"></i>
                            <span>Alocação</span>
                        </a>
                    </li>
                    <li class="topbar-item">
                        <a class="topbar-link" href="{{ route('funcionario') }}">
                            <i class="bi bi-person-circle"></i>
                            <span>Agentes</span>
                        </a>
                    </li>
                    <!-- Topbar Item -->
                    <li class="topbar-item">
                        <a class="topbar-link" href="{{ route('escala') }}">
                            <i class="bi bi-list-ul"></i>
                            <span>Escalas</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- End of Topbar -->

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content">
                @if (session('mensagem'))
                    <div class="alert alert-success alert-dismissible fade show ml-4 me-4" role="alert">
                        {{ session('mensagem') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="content-inner">
                    @yield('conteudo')
                </div>
            </div>
        </div>
        <!-- End of Content Wrapper -->
    </div>
@endsection
