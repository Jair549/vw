@extends('layouts.app')

@section('content')

    <div class="content-login">
        <div class="headerLogin">
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="headerLoginAdmin">
                        <a href="#">
                            <img src="{{ asset('img/Logotipo-04.png') }}" alt="Logo Vilavolks">
                        </a>
                        <span class="subLogoDescription">Criar Usuário - Painel Administrativo</span>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="headerCardLogin">
                                <span class="titleCardLogin">Bem Vindo!</span>
                                <span class="descriptionTitle">Crie um usuário para acessar painel administrativo.</span>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <div class="boxGroupInput">
                                        <label for="name" class="text-md-end">{{ __('Nome') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    </div>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="boxGroupInput">
                                        <label for="email" class="text-md-end">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="boxGroupInput">
                                        <label for="password" class="text-md-end">{{ __('Senha') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="boxGroupInput">
                                        <label for="password-confirm" class="text-md-end">{{ __('Confirmar senha') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrar') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footerLogin">© Volkswagen Financial Services 2024</div>
    </div>
@endsection
