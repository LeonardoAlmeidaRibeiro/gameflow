<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic | Bootstrap HTML, VueJS, React, Angular, Asp.Net Core, Blazor, Django, Flask & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="pt-BR">
<!--begin::Head-->
<head>
    <title>Criar Conta | Gameflow</title>
    <meta charset="utf-8" />
    <meta name="description" content="Crie sua conta Gameflow." />
    <meta name="keywords" content="gameflow, cadastro, autenticação, acesso, conta" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Criar Conta | Gameflow" />
    <meta property="og:site_name" content="Gameflow" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('{{ asset('assets/media/auth/bg4.jpg') }}');
            }

            [data-theme="dark"] body {
                background-image: url('{{ asset('assets/media/auth/bg4-dark.jpg') }}');
            }

            .social-auth-btn {
                border: 1px solid #e1e3ea !important;
            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <!--begin::Logo-->
                    <a href="{{ url('/') }}" class="mb-7">
                        <img alt="Logotipo" src="{{ asset('assets/media/logos/custom-3.svg') }}" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h2 class="text-white fw-normal m-0">Ferramentas inteligentes para impulsionar o seu negócio</h2>
                    <!--end::Title-->
                </div>
            </div>
            <!--end::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-center w-lg-50 p-10">
                <!--begin::Card-->
                <div class="card rounded-3 w-md-550px">
                    <!--begin::Card body-->
                    <div class="card-body p-10 p-lg-20">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" action="{{ route('signup.store') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger mb-8">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Criar conta</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">Comece sua jornada no Gameflow</div>
                                <!--end::Subtitle=-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Login options-->
                            <div class="row g-3 mb-9">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100 social-auth-btn">
                                        <img alt="Logotipo do Google" src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}" class="h-15px me-3" />Cadastrar com Google</a>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100 social-auth-btn">
                                        <img alt="Logotipo da Apple" src="{{ asset('assets/media/svg/brand-logos/apple-black.svg') }}" class="theme-light-show h-15px me-3" />
                                        <img alt="Logotipo da Apple" src="{{ asset('assets/media/svg/brand-logos/apple-black-dark.svg') }}" class="theme-dark-show h-15px me-3" />Cadastrar com Apple</a>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Login options-->
                            <!--begin::Separator-->
                            <div class="separator separator-content my-14">
                                <span class="w-125px text-gray-500 fw-semibold fs-7">Ou com e-mail</span>
                            </div>
                            <!--end::Separator-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Nome" name="name" value="{{ old('name') }}" autocomplete="off" class="form-control bg-transparent" />
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="CPF" name="cpf" value="{{ old('cpf') }}" inputmode="numeric" autocomplete="off" maxlength="14" class="form-control bg-transparent" />
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <input type="email" placeholder="E-mail" name="email" value="{{ old('email') }}" autocomplete="off" class="form-control bg-transparent" />
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control bg-transparent" type="password" placeholder="Senha" name="password" autocomplete="off" />
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                            <i class="bi bi-eye-slash fs-2"></i>
                                            <i class="bi bi-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                    <!--end::Input wrapper-->
                                    <!--begin::Meter-->
                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Hint-->
                                <div class="text-muted">Use 8 ou mais caracteres, combinando letras, números e símbolos.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <input placeholder="Repita a senha" name="confirm-password" type="password" autocomplete="off" class="form-control bg-transparent" />
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Accept-->
                            <div class="fv-row mb-8">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="toc" value="1" />
                                    <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">Eu aceito os
                                        <a href="#" class="ms-1 link-primary">Termos de uso</a></span>
                                </label>
                            </div>
                            <!--end::Accept-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Criar conta</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Aguarde...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign in-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">Já tem uma conta?
                                <a href="{{ route('login') }}" class="link-primary fw-semibold">Entrar</a></div>
                            <!--end::Sign in-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-up-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "{{ asset('assets') }}/";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/js/custom/authentication/sign-up/general.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->
</html>
