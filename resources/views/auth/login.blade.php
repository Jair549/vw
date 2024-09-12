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
                            <img src="{{ asset('img/logoEmbraVW.svg') }}" alt="">
                        </a>
                        <span class="subLogoDescription">Login Paniel Administrativo</span>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="headerCardLogin">
                                <span class="titleCardLogin">Bem Vindo!</span>
                                <span class="descriptionTitle">Faça o login para acessar painel administrativo.</span>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <div class="boxGroupInput">
                                        <label for="email" class="col-form-label text-md-end">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="boxGroupInput">
                                        <label for="password" class="col-form-label text-md-end">{{ __('Senha') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Lembre-me') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link p-0" href="{{ route('password.request') }}">
                                                {{ __('Esqueceu a senha?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-0">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Entrar') }}
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
