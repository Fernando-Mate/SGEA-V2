@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-light text-primary">
                    <h4><i class="bi bi-envelope-fill me-2"></i>{{ __('Verifique o seu endereço de email') }}</h4>
                </div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Foi enviado um novo link de verificação para o seu endereço de email.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, verifique o seu email para obter um link de verificação.') }}
                    {{ __('Se não recebeu o email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clique aqui para solicitar outro') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
