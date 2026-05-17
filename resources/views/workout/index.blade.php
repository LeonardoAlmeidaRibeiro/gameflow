<!DOCTYPE html>
<html lang="pt-BR">
<!--begin::Head-->
<head>
    <title>Treinos | Gameflow</title>
    <meta charset="utf-8" />
    <meta name="description" content="Acompanhe seus treinos, divisões, exercícios, rotina e progresso físico." />
    <meta name="keywords" content="gameflow, treinos, exercícios, rotina, progresso" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Treinos | Gameflow" />
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
    $profilePhotoVersion = optional(data_get($profileUser, 'updated_at'))->timestamp ?? time();
    $profilePhoto = $profilePhotoPath
    ? route('account.photo', ['v' => $profilePhotoVersion])
    : asset('assets/media/avatars/300-1.jpg');
    $gameLevel = 8;
    $currentXp = 3420;
    $nextLevelXp = 4000;
    $xpPercent = min(100, (int) (($currentXp / $nextLevelXp) * 100));
    $streakDays = 12;
    $completedMissions = 148;
    $activeCampaign = 'Construir minha rotina ideal';
    $workouts = $workouts ?? collect();
    $workoutProgress = $workoutProgress ?? collect();
    $trainingDivisions = $trainingDivisions ?? collect();
    $exercises = $exercises ?? collect();
    $workoutRoutines = $workoutRoutines ?? collect();
    $latestProgress = $latestProgress ?? null;
    $totalSeries = $exercises->sum(function ($exercise) {
    return (int) ($exercise->series ?? 0);
    });
    $weekDays = ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado', 'Domingo'];
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
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Treinos</h1>
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
                                        <li class="breadcrumb-item text-muted">Treinos</li>
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
                                        @include('assets.header')
                                        <!--begin::Navs-->
                                        @include('assets.nav')
                                        <!--begin::Navs-->
                                    </div>
                                </div>
                                <!--end::Navbar-->
                                <div class="row g-5 g-xl-8 mb-5 mb-xl-10">
                                    <div class="col-md-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <span class="text-gray-500 fw-semibold d-block mb-2">Treinos</span>
                                                <span class="text-dark fw-bold fs-2">{{ $workouts->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <span class="text-gray-500 fw-semibold d-block mb-2">Divisões</span>
                                                <span class="text-dark fw-bold fs-2">{{ $trainingDivisions->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <span class="text-gray-500 fw-semibold d-block mb-2">Exercícios</span>
                                                <span class="text-dark fw-bold fs-2">{{ $exercises->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card h-100">
                                            <div class="card-body">
                                                <span class="text-gray-500 fw-semibold d-block mb-2">Séries planejadas</span>
                                                <span class="text-dark fw-bold fs-2">{{ $totalSeries }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-5 g-xl-8 mb-5 mb-xl-10">
                                    <div class="col-xl-4">
                                        <div class="card h-100">
                                            <div class="card-header border-0">
                                                <h3 class="card-title fw-bold text-dark">Progresso atual</h3>
                                                <div class="card-toolbar">
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_adicionar_progress">Adicionar</button>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                @if ($latestProgress)
                                                <div class="d-flex justify-content-between border-bottom border-gray-200 py-3">
                                                    <span class="text-gray-600">Data</span>
                                                    <span class="fw-bold">{{ \Carbon\Carbon::parse($latestProgress->data_registro)->format('d/m/Y') }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between border-bottom border-gray-200 py-3">
                                                    <span class="text-gray-600">Peso</span>
                                                    <span class="fw-bold">{{ $latestProgress->peso ? number_format($latestProgress->peso, 2, ',', '.') . ' kg' : '-' }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between border-bottom border-gray-200 py-3">
                                                    <span class="text-gray-600">Altura</span>
                                                    <span class="fw-bold">{{ $latestProgress->altura ? number_format($latestProgress->altura, 2, ',', '.') . ' m' : '-' }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between border-bottom border-gray-200 py-3">
                                                    <span class="text-gray-600">Meta kcal</span>
                                                    <span class="fw-bold">{{ $latestProgress->meta_kcal ?? '-' }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between py-3">
                                                    <span class="text-gray-600">Macros</span>
                                                    <span class="fw-bold text-end">
                                                        C {{ $latestProgress->carboidrato ?? '-' }} /
                                                        P {{ $latestProgress->proteina ?? '-' }} /
                                                        G {{ $latestProgress->gordura ?? '-' }}
                                                    </span>
                                                </div>
                                                @else
                                                <div class="text-gray-500 fw-semibold">Nenhum progresso cadastrado.</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-8">
                                        <div class="card h-100">
                                            <div class="card-header border-0">
                                                <h3 class="card-title fw-bold text-dark">Rotina semanal</h3>
                                                <div class="card-toolbar">
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_adicionar_routine">Adicionar</button>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="table-responsive">
                                                    <table class="table align-middle table-row-dashed gy-4">
                                                        <thead>
                                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                                <th>Dia</th>
                                                                <th>Divisão</th>
                                                                <th>Treino</th>
                                                                <th class="text-end">Ações</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="fw-semibold text-gray-700">
                                                            @forelse ($workoutRoutines as $routine)
                                                            <tr>
                                                                <td>{{ $routine->dia_semana }}</td>
                                                                <td>{{ data_get($routine, 'trainingDivision.nome', '-') }}</td>
                                                                <td>{{ data_get($routine, 'trainingDivision.workout.nome', '-') }}</td>
                                                                <td class="text-end">
                                                                    <button type="button" class="btn btn-sm btn-light-primary me-2 js-edit-routine" data-routine='@json($routine)'>Editar</button>
                                                                    <form action="{{ route('workouts.routines.destroy', $routine) }}" method="POST" class="d-inline js-delete-form" data-message="Excluir esta rotina?">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-light-danger">
                                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                                            <span class="svg-icon svg-icon-2">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                                                                </svg>
                                                                            </span>
                                                                            <!--end::Svg Icon-->Excluir</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="4" class="text-center text-gray-500 py-10">Nenhuma rotina cadastrada.</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-5 mb-xl-10">
                                    <div class="card-header border-0">
                                        <h3 class="card-title fw-bold text-dark">Treinos e divisões</h3>
                                        <div class="card-toolbar">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_adicionar_workout">Adicionar</button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5">
                                                <thead>
                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                        <th>Treino</th>
                                                        <th>Objetivo</th>
                                                        <th>Divisões</th>
                                                        <th>Exercícios</th>
                                                        <th>Criado em</th>
                                                        <th class="text-end">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-semibold text-gray-700">
                                                    @forelse ($workouts as $workout)
                                                    <tr>
                                                        <td class="fw-bold text-dark">{{ $workout->nome }}</td>
                                                        <td>{{ $workout->objetivo ?? '-' }}</td>
                                                        <td>
                                                            @forelse ($workout->trainingDivisions as $division)
                                                            <span class="badge badge-light-primary me-1 mb-1">{{ $division->nome }}</span>
                                                            @empty
                                                            -
                                                            @endforelse
                                                        </td>
                                                        <td>{{ $workout->trainingDivisions->sum(fn ($division) => $division->exercises->count()) }}</td>
                                                        <td>{{ optional($workout->created_at)->format('d/m/Y') }}</td>
                                                        <td class="text-end">
                                                            <button type="button" class="btn btn-sm btn-light-primary me-2 js-edit-workout" data-workout='@json($workout)'>Editar</button>
                                                            <form action="{{ route('workouts.destroy', $workout) }}" method="POST" class="d-inline js-delete-form" data-message="Excluir este treino e seus vínculos?">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-light-danger">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->Excluir</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center text-gray-500 py-10">Nenhum treino cadastrado.</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-5 mb-xl-10">
                                    <div class="card-header border-0">
                                        <h3 class="card-title fw-bold text-dark">Exercícios</h3>
                                        <div class="card-toolbar">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_adicionar_exercise">Adicionar</button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5">
                                                <thead>
                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                        <th>Exercício</th>
                                                        <th>Treino</th>
                                                        <th>Divisão</th>
                                                        <th>Séries</th>
                                                        <th>Repetições</th>
                                                        <th>Carga</th>
                                                        <th>Descanso</th>
                                                        <th>Observação</th>
                                                        <th class="text-end">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-semibold text-gray-700">
                                                    @forelse ($exercises as $exercise)
                                                    <tr>
                                                        <td class="fw-bold text-dark">{{ $exercise->nome }}</td>
                                                        <td>{{ data_get($exercise, 'trainingDivision.workout.nome', '-') }}</td>
                                                        <td>{{ data_get($exercise, 'trainingDivision.nome', '-') }}</td>
                                                        <td>{{ $exercise->series ?? '-' }}</td>
                                                        <td>{{ $exercise->repeticoes ?? '-' }}</td>
                                                        <td>{{ $exercise->carga ? number_format($exercise->carga, 2, ',', '.') . ' kg' : '-' }}</td>
                                                        <td>{{ $exercise->tempo_descanso ? $exercise->tempo_descanso . 's' : '-' }}</td>
                                                        <td>{{ $exercise->observacao ?? '-' }}</td>
                                                        <td class="text-end">
                                                            <button type="button" class="btn btn-sm btn-light-primary me-2 js-edit-exercise" data-exercise='@json($exercise)'>Editar</button>
                                                            <form action="{{ route('workouts.exercises.destroy', $exercise) }}" method="POST" class="d-inline js-delete-form" data-message="Excluir este exercício?">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-light-danger">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->Excluir</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="9" class="text-center text-gray-500 py-10">Nenhum exercício cadastrado.</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-5 mb-xl-10">
                                    <div class="card-header border-0">
                                        <h3 class="card-title fw-bold text-dark">Divisões de treino</h3>
                                        <div class="card-toolbar">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_adicionar_division">Adicionar</button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5">
                                                <thead>
                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                        <th>Divisão</th>
                                                        <th>Treino</th>
                                                        <th>Exercícios</th>
                                                        <th>Rotina</th>
                                                        <th>Criada em</th>
                                                        <th class="text-end">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-semibold text-gray-700">
                                                    @forelse ($trainingDivisions as $division)
                                                    <tr>
                                                        <td class="fw-bold text-dark">{{ $division->nome }}</td>
                                                        <td>{{ data_get($division, 'workout.nome', '-') }}</td>
                                                        <td>{{ $division->exercises->count() }}</td>
                                                        <td>
                                                            @forelse ($division->workoutRoutines as $routine)
                                                            <span class="badge badge-light-info me-1 mb-1">{{ $routine->dia_semana }}</span>
                                                            @empty
                                                            -
                                                            @endforelse
                                                        </td>
                                                        <td>{{ optional($division->created_at)->format('d/m/Y') }}</td>
                                                        <td class="text-end">
                                                            <button type="button" class="btn btn-sm btn-light-primary me-2 js-edit-division" data-division='@json($division)'>Editar</button>
                                                            <form action="{{ route('workouts.divisions.destroy', $division) }}" method="POST" class="d-inline js-delete-form" data-message="Excluir esta divisão e seus vínculos?">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-light-danger">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->Excluir</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="6" class="text-center text-gray-500 py-10">Nenhuma divisão cadastrada.</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-5 mb-xl-10">
                                    <div class="card-header border-0">
                                        <h3 class="card-title fw-bold text-dark">Histórico de progresso</h3>
                                        <div class="card-toolbar">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_adicionar_progress">Adicionar</button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5">
                                                <thead>
                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                        <th>Data</th>
                                                        <th>Idade</th>
                                                        <th>Peso</th>
                                                        <th>Altura</th>
                                                        <th>Meta kcal</th>
                                                        <th>Necessária</th>
                                                        <th>Carboidrato</th>
                                                        <th>Proteína</th>
                                                        <th>Gordura</th>
                                                        <th class="text-end">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-semibold text-gray-700">
                                                    @forelse ($workoutProgress as $progress)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($progress->data_registro)->format('d/m/Y') }}</td>
                                                        <td>{{ $progress->idade ?? '-' }}</td>
                                                        <td>{{ $progress->peso ? number_format($progress->peso, 2, ',', '.') . ' kg' : '-' }}</td>
                                                        <td>{{ $progress->altura ? number_format($progress->altura, 2, ',', '.') . ' m' : '-' }}</td>
                                                        <td>{{ $progress->meta_kcal ?? '-' }}</td>
                                                        <td>{{ $progress->meta_necessaria ?? '-' }}</td>
                                                        <td>{{ $progress->carboidrato ?? '-' }}</td>
                                                        <td>{{ $progress->proteina ?? '-' }}</td>
                                                        <td>{{ $progress->gordura ?? '-' }}</td>
                                                        <td class="text-end">
                                                            <button type="button" class="btn btn-sm btn-light-primary me-2 js-edit-progress" data-progress='@json($progress)'>Editar</button>
                                                            <form action="{{ route('workouts.progress.destroy', $progress) }}" method="POST" class="d-inline js-delete-form" data-message="Excluir este progresso?">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-light-danger">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->Excluir</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="10" class="text-center text-gray-500 py-10">Nenhum histórico cadastrado.</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    {{-- @include('assets.footer')--}}
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
    @include('workout.modals')


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

    <script>
        function workoutAlert(icon, title, text) {
            Swal.fire({
                icon: icon
                , title: title
                , text: text
            });
        }

        function setWorkoutFormValues(form, data) {
            Object.keys(data || {}).forEach(function(key) {
                var field = form.querySelector('[name="' + key + '"]');

                if (!field) {
                    return;
                }

                var value = data[key] ? ? '';

                if (field.type === 'date' && String(value).indexOf('T') !== -1) {
                    value = String(value).split('T')[0];
                }

                field.value = value;
            });
        }

        function openWorkoutEditModal(formId, modalId, id, data) {
            var form = document.getElementById(formId);
            var modalElement = document.getElementById(modalId);

            if (!form || !modalElement) {
                return;
            }

            form.action = form.getAttribute('data-action-template').replace('__ID__', id);
            setWorkoutFormValues(form, data);

            if (window.bootstrap) {
                new bootstrap.Modal(modalElement).show();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.js-workout-form').forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    var requiredField = Array.from(form.querySelectorAll('[data-label]')).find(function(field) {
                        return String(field.value || '').trim() === '';
                    });

                    if (!requiredField) {
                        return;
                    }

                    event.preventDefault();
                    requiredField.focus();
                    workoutAlert('warning', 'Campo obrigatório', 'Preencha o campo ' + requiredField.getAttribute('data-label') + '.');
                });
            });

            document.querySelectorAll('.js-delete-form').forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: 'Tem certeza que deseja excluir?'
                        , text: form.getAttribute('data-message') || 'Não será possível reverter essa ação.'
                        , icon: 'warning'
                        , showCancelButton: true
                        , confirmButtonColor: '#f1416c'
                        , cancelButtonColor: '#7e8299'
                        , confirmButtonText: 'Sim, excluir'
                        , cancelButtonText: 'Cancelar'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            document.querySelectorAll('.js-edit-workout').forEach(function(button) {
                button.addEventListener('click', function() {
                    var data = JSON.parse(button.getAttribute('data-workout'));
                    openWorkoutEditModal('form_editar_workout', 'modal_editar_workout', data.id, data);
                });
            });

            document.querySelectorAll('.js-edit-division').forEach(function(button) {
                button.addEventListener('click', function() {
                    var data = JSON.parse(button.getAttribute('data-division'));
                    openWorkoutEditModal('form_editar_division', 'modal_editar_division', data.id, data);
                });
            });

            document.querySelectorAll('.js-edit-exercise').forEach(function(button) {
                button.addEventListener('click', function() {
                    var data = JSON.parse(button.getAttribute('data-exercise'));
                    openWorkoutEditModal('form_editar_exercise', 'modal_editar_exercise', data.id, data);
                });
            });

            document.querySelectorAll('.js-edit-routine').forEach(function(button) {
                button.addEventListener('click', function() {
                    var data = JSON.parse(button.getAttribute('data-routine'));
                    openWorkoutEditModal('form_editar_routine', 'modal_editar_routine', data.id, data);
                });
            });

            document.querySelectorAll('.js-edit-progress').forEach(function(button) {
                button.addEventListener('click', function() {
                    var data = JSON.parse(button.getAttribute('data-progress'));
                    openWorkoutEditModal('form_editar_progress', 'modal_editar_progress', data.id, data);
                });
            });
        });

    </script>

    @if (session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            workoutAlert('success', 'Sucesso!', @json(session('status')));
        });

    </script>
    @endif

    @if (session('workout_modal') || $errors->workout->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modalElement = document.getElementById(@json(session('workout_modal', 'modal_adicionar_workout')));
            var firstError = @json($errors->workout->first());

            if (modalElement && window.bootstrap) {
                new bootstrap.Modal(modalElement).show();
            }

            workoutAlert('warning', 'Verifique os campos', firstError || 'Preencha os campos obrigatórios para continuar.');
        });

    </script>
    @endif

    @include('account.settings')

</body>
<!--end::Body-->
</html>
