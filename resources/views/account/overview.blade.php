<!DOCTYPE html>
<html lang="pt-BR">
<!--begin::Head-->
<head>
    <title>Perfil | Gameflow</title>
    <meta charset="utf-8" />
    <meta name="description" content="Acesse sua conta Gameflow." />
    <meta name="keywords" content="gameflow, login, autenticação, acesso, conta" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Perfil | Gameflow" />
    <meta property="og:site_name" content="Gameflow" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style>
        .gameflow-brand {
            align-items: center;
            display: inline-flex;
            gap: 0.75rem;
            text-decoration: none;
        }

        .gameflow-brand-mark {
            align-items: center;
            background: linear-gradient(135deg, #f1416c 0%, #009ef7 100%);
            border-radius: 0.65rem;
            color: #ffffff;
            display: inline-flex;
            flex: 0 0 42px;
            font-size: 1.25rem;
            font-weight: 800;
            height: 42px;
            justify-content: center;
            letter-spacing: 0;
            width: 42px;
        }

        .gameflow-brand-name {
            color: #ffffff;
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: 0;
            line-height: 1;
        }

        .gameflow-mobile-brand .gameflow-brand-mark {
            flex-basis: 34px;
            font-size: 1rem;
            height: 34px;
            width: 34px;
        }

        .gameflow-mobile-brand .gameflow-brand-name {
            color: #181c32;
            font-size: 1.1rem;
        }

        .gameflow-brand .app-sidebar-logo-minimize {
            display: none;
        }

        @media (min-width: 992px) {
            :root {
                --gf-sidebar-width: 265px;
                --gf-header-height: 70px;
            }

            body.app-default {
                background: #f5f8fa;
            }

            #kt_app_page {
                min-height: 100vh;
            }

            #kt_app_sidebar {
                background: #1e1e2d;
                bottom: 0;
                display: flex !important;
                flex-direction: column;
                left: 0;
                position: fixed;
                top: 0;
                width: var(--gf-sidebar-width);
                z-index: 105;
            }

            #kt_app_sidebar_logo {
                align-items: center;
                border-bottom: 1px dashed rgba(255, 255, 255, 0.12);
                display: flex;
                height: var(--gf-header-height);
            }

            #kt_app_sidebar .menu-heading {
                color: #646477;
            }

            #kt_app_sidebar .menu-link {
                border-radius: 0.475rem;
            }

            #kt_app_sidebar .menu-link .menu-title,
            #kt_app_sidebar .menu-link .menu-arrow,
            #kt_app_sidebar .menu-link .menu-bullet,
            #kt_app_sidebar .menu-link .menu-icon {
                color: #a2a3b7;
            }

            #kt_app_sidebar .menu-link.active,
            #kt_app_sidebar .menu-link:hover,
            #kt_app_sidebar .menu-item.here>.menu-link,
            #kt_app_sidebar .menu-item.show>.menu-link {
                background: #2a2a3c;
            }

            #kt_app_sidebar .menu-link.active .menu-title,
            #kt_app_sidebar .menu-link:hover .menu-title,
            #kt_app_sidebar .menu-item.here>.menu-link .menu-title,
            #kt_app_sidebar .menu-item.show>.menu-link .menu-title {
                color: #ffffff;
            }

            #kt_app_sidebar_footer {
                margin-top: auto;
            }

            #kt_app_header {
                background: #ffffff;
                box-shadow: 0 1px 0 rgba(0, 0, 0, 0.06);
                height: var(--gf-header-height);
                left: var(--gf-sidebar-width);
                position: fixed;
                right: 0;
                top: 0;
                z-index: 100;
            }

            #kt_app_header_container {
                height: 100%;
                max-width: none;
                padding-left: 2rem;
                padding-right: 2rem;
            }

            #kt_app_header_wrapper {
                align-items: stretch;
                display: flex !important;
                justify-content: space-between;
                min-width: 0;
                width: 100%;
            }

            #kt_app_header .app-header-menu {
                align-items: stretch;
                display: flex !important;
                flex: 1 1 auto;
                min-width: 0;
            }

            #kt_app_header_menu {
                align-items: stretch !important;
                display: flex !important;
                flex-direction: row !important;
            }

            #kt_app_header_menu>.menu-item>.menu-link {
                align-items: center;
                display: flex;
                height: 100%;
                padding-left: 1rem;
                padding-right: 1rem;
            }

            #kt_app_header .app-navbar {
                align-items: center !important;
                display: flex !important;
                flex-direction: row !important;
                gap: 0.35rem;
                justify-content: flex-end;
                margin-left: auto;
                white-space: nowrap;
            }

            #kt_app_wrapper {
                display: flex;
                margin-left: var(--gf-sidebar-width);
                min-height: 100vh;
                padding-top: var(--gf-header-height);
            }

            #kt_app_main {
                min-width: 0;
                width: 100%;
            }

            #kt_app_toolbar,
            #kt_app_content,
            #kt_app_footer {
                width: 100%;
            }

            #kt_app_toolbar_container,
            #kt_app_content_container,
            #kt_app_footer .app-container {
                max-width: none;
                padding-left: 2rem;
                padding-right: 2rem;
            }
        }

    </style>
</head>
<!--end::Head-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    @php
    $profileUser = isset($user) ? $user : auth()->user();
    $cpfDigits = preg_replace('/\D/', '', (string) data_get($profileUser, 'cpf', ''));
    $formattedCpf = strlen($cpfDigits) === 11
    ? preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpfDigits)
    : 'Não informado';
    $createdAt = data_get($profileUser, 'created_at');
    $profilePhotoPath = data_get($profileUser, 'photo');
    $profilePhoto = $profilePhotoPath
    ? route('account.photo')
    : asset('assets/media/avatars/300-1.jpg');
    $gameLevel = 8;
    $currentXp = 3420;
    $nextLevelXp = 4000;
    $xpPercent = min(100, (int) (($currentXp / $nextLevelXp) * 100));
    $streakDays = 12;
    $completedMissions = 148;
    $activeCampaign = 'Construir minha rotina ideal';
    @endphp
    <!--begin::Theme mode setup on page load-->
    <script>
        if (document.documentElement) {
            localStorage.removeItem("data-theme");
            document.documentElement.setAttribute("data-theme", "light");
            document.documentElement.removeAttribute("data-theme-mode");
            document.documentElement.removeAttribute("data-bs-theme");
        }

    </script>
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            @include('assets.toolbars')
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                @include('assets.menu')
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <!--begin::Title-->
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Visão geral da conta</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <a href="{{ route('index') }}" class="text-muted text-hover-primary">Início</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Conta</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                @if (session('status'))
                                    <div class="alert alert-success d-flex align-items-center p-5 mb-8">
                                        <div class="d-flex flex-column">
                                            <span>{{ session('status') }}</span>
                                        </div>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger d-flex align-items-center p-5 mb-8">
                                        <div class="d-flex flex-column">
                                            <span>Confira os campos destacados e tente novamente.</span>
                                        </div>
                                    </div>
                                @endif
                                <!--begin::Navbar-->
                                <div class="card mb-5 mb-xl-10">
                                    <div class="card-body pt-9 pb-0">
                                        <!--begin::Details-->
                                        <div class="d-flex flex-wrap flex-sm-nowrap mb-8">
                                            <!--begin: Pic-->
                                            <div class="me-7 mb-4">
                                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                                    <img src="{{ $profilePhoto }}" alt="Foto do perfil" />
                                                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                                </div>
                                            </div>
                                            <!--end::Pic-->
                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-4">
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center mb-2 flex-wrap">
                                                            <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-2">{{ data_get($profileUser, 'name', 'Usuário') }}</a>
                                                            <span class="badge badge-light-primary fw-bold fs-8 px-3 py-2 me-2">Nivel {{ $gameLevel }}</span>
                                                            <span class="badge badge-light-success fw-bold fs-8 px-3 py-2">Plano Pro</span>
                                                        </div>
                                                        <div class="fs-5 fw-semibold text-muted mb-3">Estrategista do Foco</div>
                                                        <div class="d-flex flex-wrap fw-semibold fs-6 pe-2">
                                                            <span class="d-flex align-items-center text-gray-600 me-5 mb-2">Campanha ativa: {{ $activeCampaign }}</span>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="btn btn-sm btn-light-primary align-self-center" data-bs-toggle="modal" data-bs-target="#modal_editar">Editar perfil</a>
                                                </div>

                                                <div class="mb-6">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <span class="fw-bold text-gray-800">XP para o proximo nivel</span>
                                                        <span class="fw-semibold text-muted">{{ number_format($currentXp, 0, ',', '.') }} / {{ number_format($nextLevelXp, 0, ',', '.') }} XP</span>
                                                    </div>
                                                    <div class="h-8px bg-light rounded">
                                                        <div class="bg-primary rounded h-8px" role="progressbar" style="width: {{ $xpPercent }}%;" aria-valuenow="{{ $xpPercent }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-wrap">
                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-4 mb-3">
                                                        <div class="fs-2 fw-bold text-gray-900">{{ $streakDays }}</div>
                                                        <div class="fw-semibold fs-6 text-muted">dias seguidos</div>
                                                    </div>
                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-4 mb-3">
                                                        <div class="fs-2 fw-bold text-gray-900">{{ $completedMissions }}</div>
                                                        <div class="fw-semibold fs-6 text-muted">missões concluídas</div>
                                                    </div>
                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-4 mb-3">
                                                        <div class="fs-2 fw-bold text-gray-900">72</div>
                                                        <div class="fw-semibold fs-6 text-muted">foco</div>
                                                    </div>
                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                                        <div class="fs-2 fw-bold text-gray-900">65</div>
                                                        <div class="fw-semibold fs-6 text-muted">disciplina</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Details-->
                                        <!--begin::Navs-->
                                        @include('assets.nav')
                                        <!--begin::Navs-->
                                    </div>
                                </div>
                                <!--end::Navbar-->
                                <!--begin::details View-->
                                <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                                    <!--begin::Card header-->
                                    <div class="card-header cursor-pointer">
                                        <!--begin::Card title-->
                                        <div class="card-title m-0">
                                            <h3 class="fw-bold m-0">Meus Dados</h3>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-primary align-self-center" data-bs-toggle="modal" data-bs-target="#modal_editar">Editar perfil</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--begin::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body p-9">
                                        <!--begin::Row-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-semibold text-muted">Nome completo</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800">{{ data_get($profileUser, 'name', 'Não informado') }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-semibold text-muted">CPF</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <span class="fw-semibold text-gray-800 fs-6">{{ $formattedCpf }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-semibold text-muted">E-mail
                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="E-mail usado para acessar sua conta"></i></label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 d-flex align-items-center">
                                                <span class="fw-bold fs-6 text-gray-800 me-2">{{ data_get($profileUser, 'email', 'Não informado') }}</span>
                                                <span class="badge badge-success">Ativo</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-semibold text-muted">Conta criada em</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-semibold fs-6 text-gray-800">{{ $createdAt ? $createdAt->format('d/m/Y H:i') : 'Não informado' }}</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-semibold text-muted">País
                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="País cadastrado na conta"></i></label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800">Brasil</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-7">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-semibold text-muted">Comunicação</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800">E-mail</span>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-10">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 fw-semibold text-muted">Permitir alterações</label>
                                            <!--begin::Label-->
                                            <!--begin::Label-->
                                            <div class="col-lg-8">
                                                <span class="fw-semibold fs-6 text-gray-800">Sim</span>
                                            </div>
                                            <!--begin::Label-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Notice-->
                                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                                            <!--begin::Icon-->
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                                            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                                                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <!--end::Icon-->
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-stack flex-grow-1">
                                                <!--begin::Content-->
                                                <div class="fw-semibold">
                                                    <h4 class="text-gray-900 fw-bold">Mantenha seus dados atualizados!</h4>
                                                    <div class="fs-6 text-gray-700">Confira se nome, CPF e e-mail estão corretos para manter sua conta Gameflow segura.</div>
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Notice-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::details View-->

                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    @include('assets.footer')
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Drawers-->


    <!--begin::Javascript-->
    <script>
        var hostUrl = "{{ asset('assets') }}/";

    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used by this page)-->
    <script src="{{ asset('assets/js/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used by this page)-->
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/chat.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

    @include('account.settings')
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var modalElement = document.getElementById('modal_editar');

                if (modalElement && window.bootstrap) {
                    new bootstrap.Modal(modalElement).show();
                }
            });
        </script>
    @endif

</body>
<!--end::Body-->
</html>
