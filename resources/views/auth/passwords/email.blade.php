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
                        <span class="subLogoDescription">Resetar senha - Paniel Administrativo</span>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="headerCardLogin">
                                <span class="titleCardLogin">Alterar senha!</span>
                                <span class="descriptionTitle">Informe seu e-mail para redefinir a senha.</span>
                            </div>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="mb-3">
                                    <div class="boxGroupInput">
                                        <label for="email" class="text-md-end">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-0">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Enviar link de redefinição de senha') }}
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
