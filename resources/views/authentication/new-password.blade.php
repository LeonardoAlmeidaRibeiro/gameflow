<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Nova Senha | Gameflow</title>
    <meta charset="utf-8" />
    <meta name="description" content="Defina uma nova senha para sua conta Gameflow." />
    <meta name="keywords" content="gameflow, senha, nova senha, recuperar senha" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Nova Senha | Gameflow" />
    <meta property="og:site_name" content="Gameflow" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <script>if (document.documentElement) { localStorage.removeItem("data-theme"); document.documentElement.setAttribute("data-theme", "light"); document.documentElement.removeAttribute("data-theme-mode"); }</script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url('{{ asset('assets/media/auth/bg4.jpg') }}');
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
                        <form class="form w-100" id="kt_new_password_form" action="{{ route('new-password.update') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger mb-8">
                                    {{ $errors->first() }}
                                </div>
                            @endif
                            <div class="text-center mb-10">
                                <h1 class="text-dark fw-bolder mb-3">Definir nova senha</h1>
                                <div class="text-gray-500 fw-semibold fs-6">
                                    Atualizando a senha de <strong>{{ $email }}</strong>.
                                    <a href="{{ route('login') }}" class="link-primary fw-bold">Voltar ao login</a>
                                </div>
                            </div>
                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                <div class="mb-1">
                                    <div class="position-relative mb-3">
                                        <input class="form-control bg-transparent" type="password" placeholder="Nova senha" name="password" autocomplete="off" required />
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                            <i class="bi bi-eye-slash fs-2"></i>
                                            <i class="bi bi-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                </div>
                                <div class="text-muted">Use 8 ou mais caracteres.</div>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="password" placeholder="Repita a nova senha" name="confirm-password" autocomplete="off" class="form-control bg-transparent" required />
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_new_password_submit" class="btn btn-primary">
                                    <span class="indicator-label">Atualizar senha</span>
                                    <span class="indicator-progress">Aguarde...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
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
            var form = document.querySelector("#kt_new_password_form");
            var submitButton = document.querySelector("#kt_new_password_submit");

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
