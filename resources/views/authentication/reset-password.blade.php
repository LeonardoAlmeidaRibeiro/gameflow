<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Recuperar Senha | Gameflow</title>
    <meta charset="utf-8" />
    <meta name="description" content="Recupere sua senha do Gameflow." />
    <meta name="keywords" content="gameflow, login, autenticação, acesso, conta, recuperar senha" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Recuperar Senha | Gameflow" />
    <meta property="og:site_name" content="Gameflow" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <script>var defaultThemeMode = "light"; var themeMode; if (document.documentElement) { if (document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { themeMode = localStorage.getItem("data-theme") !== null ? localStorage.getItem("data-theme") : defaultThemeMode; } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url('{{ asset('assets/media/auth/bg4.jpg') }}');
            }

            [data-theme="dark"] body {
                background-image: url('{{ asset('assets/media/auth/bg4-dark.jpg') }}');
            }
        </style>
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <a href="{{ url('/') }}" class="mb-7">
                        <img alt="Logotipo" src="{{ asset('assets/media/logos/custom-3.svg') }}" />
                    </a>
                    <h2 class="text-white fw-normal m-0">Ferramentas criadas para o seu negócio</h2>
                </div>
            </div>
            <div class="d-flex flex-center w-lg-50 p-10">
                <div class="card rounded-3 w-md-550px">
                    <div class="card-body p-10 p-lg-20">
                        <form class="form w-100" id="kt_password_reset_form" action="{{ route('reset-password.check') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger mb-8">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                            <div class="text-center mb-10">
                                <h1 class="text-dark fw-bolder mb-3">Esqueceu sua senha?</h1>
                                <div class="text-gray-500 fw-semibold fs-6">Informe seu e-mail para redefinir sua senha.</div>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="email" placeholder="E-mail" name="email" value="{{ old('email') }}" autocomplete="off" class="form-control bg-transparent" required />
                            </div>
                            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">
                                    <span class="indicator-label">Continuar</span>
                                    <span class="indicator-progress">Aguarde...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <a href="{{ route('login') }}" class="btn btn-light">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var hostUrl = "{{ asset('assets') }}/";

        document.addEventListener("DOMContentLoaded", function () {
            var form = document.querySelector("#kt_password_reset_form");
            var submitButton = document.querySelector("#kt_password_reset_submit");

            if (!form || !submitButton) {
                return;
            }

            form.addEventListener("submit", function () {
                submitButton.setAttribute("data-kt-indicator", "on");
                submitButton.disabled = true;
            });
        });
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>
</html>
