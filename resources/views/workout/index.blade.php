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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        .progress-board {
            background: #ffffff;
            border-radius: 0;
            box-shadow: none;
        }

        .progress-board-title {
            align-items: center;
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .progress-board-title h2 {
            background: #d8eafb;
            color: #1f1f29;
            display: inline;
            font-size: 1.85rem;
            font-weight: 700;
            line-height: 1.2;
            margin: 0;
            padding: 0 0.2rem;
        }

        .progress-board-view {
            align-items: center;
            background: #f3f4f6;
            border-radius: 999px;
            color: #1f1f29;
            display: inline-flex;
            font-weight: 700;
            gap: 0.45rem;
            margin-bottom: 0.65rem;
            padding: 0.45rem 0.75rem;
        }

        .progress-board-toolbar {
            align-items: center;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            margin-bottom: 0.5rem;
        }

        .progress-board-tools {
            color: #7e8299;
            display: flex;
            font-size: 1rem;
            gap: 0.75rem;
        }

        .progress-board-table {
            border-collapse: collapse;
            min-width: 1180px;
            width: 100%;
        }

        .progress-board-table th,
        .progress-board-table td {
            border-bottom: 1px solid #eef0f3;
            border-right: 1px solid #eef0f3;
            color: #5f6368;
            font-size: 0.9rem;
            font-weight: 500;
            height: 38px;
            padding: 0.45rem 0.65rem;
            vertical-align: middle;
            white-space: nowrap;
        }

        .progress-board-table th {
            background: #ffffff;
            color: #74777f;
            font-weight: 600;
        }

        .progress-board-table th:last-child,
        .progress-board-table td:last-child {
            border-right: 0;
        }

        .progress-board-icon {
            color: #8a8a8a;
            display: inline-block;
            font-weight: 700;
            margin-right: 0.35rem;
            min-width: 1rem;
            text-align: center;
        }

        .progress-board-empty td {
            color: #9aa0a6;
            height: 72px;
        }

        .routine-board {
            background: #ffffff;
            border-radius: 0;
            box-shadow: none;
        }

        .routine-board-title {
            align-items: center;
            display: flex;
            gap: 0.6rem;
            margin-bottom: 0.9rem;
        }

        .routine-board-title h2 {
            color: #1f1f29;
            font-size: 1.85rem;
            font-weight: 700;
            line-height: 1.2;
            margin: 0;
        }

        .routine-board-toolbar {
            align-items: center;
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
            margin-bottom: 0.7rem;
        }

        .routine-board-tools {
            color: #7e8299;
            display: flex;
            font-size: 1rem;
            gap: 0.75rem;
        }

        .routine-view-pill {
            align-items: center;
            background: #f3f4f6;
            border-radius: 999px;
            color: #1f1f29;
            display: inline-flex;
            font-weight: 700;
            gap: 0.45rem;
            margin-bottom: 1rem;
            padding: 0.45rem 0.75rem;
        }

        .routine-day-list {
            display: grid;
            gap: 0.45rem;
            margin-bottom: 2rem;
            max-width: 360px;
        }

        .routine-day-row {
            align-items: center;
            display: flex;
            gap: 0.55rem;
        }

        .routine-day-tag {
            border-radius: 0.25rem;
            color: #3f4254;
            font-size: 0.78rem;
            font-weight: 700;
            min-width: 4.35rem;
            padding: 0.15rem 0.45rem;
            text-align: center;
        }

        .routine-day-tag.day-0 {
            background: #ffdce8;
        }

        .routine-day-tag.day-1 {
            background: #ffe4d6;
        }

        .routine-day-tag.day-2 {
            background: #dff6e6;
        }

        .routine-day-tag.day-3 {
            background: #e9e4ff;
        }

        .routine-day-tag.day-4 {
            background: #fff1c8;
        }

        .routine-day-tag.day-5 {
            background: #d9efff;
        }

        .routine-day-tag.day-6 {
            background: #eeeeee;
        }

        .routine-day-division {
            color: #111827;
            font-weight: 700;
        }

        .routine-columns {
            display: grid;
            gap: 1.25rem;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        }

        .routine-column-title {
            color: #111827;
            font-weight: 700;
            margin-bottom: 0.55rem;
        }

        .routine-exercise-card {
            border: 1px solid #e5e7eb;
            border-radius: 0.6rem;
            margin-bottom: 0.5rem;
            min-height: 62px;
            padding: 0.65rem 0.75rem;
        }

        .routine-exercise-name {
            color: #111827;
            font-weight: 700;
            margin-bottom: 0.45rem;
        }

        .routine-exercise-meta {
            color: #111827;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .routine-new-page {
            border: 1px solid #e5e7eb;
            border-radius: 0.6rem;
            color: #9aa0a6;
            padding: 0.65rem 0.75rem;
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
    $exerciseCategories = $exerciseCategories ?? collect();
    $workoutRoutines = $workoutRoutines ?? collect();
    $workoutLogs = $workoutLogs ?? collect();
    $workoutChartData = $workoutChartData ?? [
    'divisionLabels' => [],
    'divisionSeries' => [],
    'muscleLabels' => [],
    'muscleSeries' => [],
    'progressLabels' => [],
    'weightSeries' => [],
    'kcalSeries' => [],
    ];
    $workoutChartJson = json_encode($workoutChartData, JSON_UNESCAPED_UNICODE) ?: '{}';
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
                                <div class="d-flex flex-wrap justify-content-end gap-3 mb-5">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_adicionar_division">
                                        Adicionar divisão
                                    </button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_registrar_treino">
                                        Registrar treino de hoje
                                    </button>
                                </div>
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
                                        <div class="routine-board h-100">
                                            <div class="routine-board-title">
                                                <span class="fs-2">♻</span>
                                                <h2>Rotinas de treino</h2>
                                            </div>
                                            <div class="routine-board-toolbar">
                                                <div class="routine-board-tools" aria-hidden="true">
                                                    <span>≡</span>
                                                    <span>↕</span>
                                                    <span>⚡</span>
                                                    <span>✦</span>
                                                    <span>⌕</span>
                                                    <span>↗</span>
                                                    <span>☰</span>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_adicionar_routine">Nova</button>
                                            </div>
                                            <div class="routine-view-pill">
                                                <span>▣</span>
                                                <span>Rotina semanal</span>
                                            </div>
                                            <div class="routine-day-list">
                                                @forelse ($workoutRoutines as $routine)
                                                <div class="routine-day-row">
                                                    <span class="routine-day-tag day-{{ $loop->index % 7 }}">{{ $routine->dia_semana }}</span>
                                                    <span class="text-danger fs-7">▤</span>
                                                    <span class="routine-day-division">{{ data_get($routine, 'trainingDivision.nome', '-') }}</span>
                                                    <button type="button" class="btn btn-sm btn-icon btn-light-primary js-edit-routine" data-routine='@json($routine)' title="Editar rotina">✎</button>
                                                </div>
                                                @empty
                                                <div class="text-gray-500">+ Nova página</div>
                                                @endforelse
                                            </div>
                                            <div class="routine-view-pill">
                                                <span>▥</span>
                                                <span>Divisão de treino</span>
                                            </div>
                                            <div class="routine-columns">
                                                @forelse ($trainingDivisions as $division)
                                                <div>
                                                    <div class="routine-column-title">
                                                        <span class="text-danger fs-7">▤</span>
                                                        {{ $division->nome }}
                                                    </div>
                                                    @forelse ($division->exercises as $exercise)
                                                    <div class="routine-exercise-card">
                                                        <div class="routine-exercise-name">{{ $exercise->nome }}</div>
                                                        <div class="routine-exercise-meta">✅ {{ $exercise->series ?? '-' }} x {{ $exercise->repeticoes ?? '-' }}{{ $exercise->carga ? ' - ' . number_format($exercise->carga, 0, ',', '.') . ' kg' : '' }}</div>
                                                    </div>
                                                    @empty
                                                    <div class="routine-new-page">+ Nova página</div>
                                                    @endforelse
                                                    <div class="routine-new-page">+ Nova página</div>
                                                </div>
                                                @empty
                                                <div class="routine-new-page">+ Novo grupo</div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-8 d-none">
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
                                                                    <button type="button" class="btn btn-sm btn-light-primary me-2 js-edit-routine" data-routine='@json($routine)'>
                                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                                        <span class="svg-icon svg-icon-2">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                        <!--end::Svg Icon-->Editar</button>
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

                                <div class="row g-5 g-xl-8 mb-5 mb-xl-10">
                                    <div class="col-xl-4">
                                        <div class="card h-100">
                                            <div class="card-header border-0">
                                                <h3 class="card-title fw-bold text-dark">Exercícios por divisão</h3>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div id="workout_division_chart" style="min-height: 280px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="card h-100">
                                            <div class="card-header border-0">
                                                <h3 class="card-title fw-bold text-dark">Volume por grupo muscular</h3>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div id="workout_muscle_chart" style="min-height: 280px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="card h-100">
                                            <div class="card-header border-0">
                                                <h3 class="card-title fw-bold text-dark">Evolução corporal</h3>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div id="workout_progress_chart" style="min-height: 280px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-5 mb-xl-10">
                                    <div class="card-header border-0">
                                        <h3 class="card-title fw-bold text-dark">Check-ins recentes</h3>
                                        <div class="card-toolbar">
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal_registrar_treino">Registrar treino de hoje</button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5">
                                                <thead>
                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                        <th>Data</th>
                                                        <th>Treino feito</th>
                                                        <th>Sensação/esforço</th>
                                                        <th>Exercícios</th>
                                                        <th>Observação</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-semibold text-gray-700">
                                                    @forelse ($workoutLogs as $log)
                                                    <tr>
                                                        <td class="fw-bold text-dark">{{ optional($log->data_treino)->format('d/m/Y') }}</td>
                                                        <td>
                                                            <div class="fw-bold text-dark">{{ $log->nome_treino }}</div>
                                                            <div class="text-gray-500 fs-7">{{ $log->dia_semana ?? '-' }}</div>
                                                        </td>
                                                        <td>
                                                            @if ($log->sensacao_esforco)
                                                            <span class="badge badge-light-info">{{ $log->sensacao_esforco }}/10</span>
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        <td>{{ $log->exercises->count() }}</td>
                                                        <td>{{ $log->observacao ?? '-' }}</td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center text-gray-500 py-10">Nenhum treino registrado ainda.</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-5 mb-xl-10">
                                    <div class="card-header border-0">
                                        <h3 class="card-title fw-bold text-dark">Treinos e divisões</h3>
                                        <div class="card-toolbar d-flex gap-3">
                                            <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#modal_adicionar_division">Adicionar divisão</button>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_adicionar_workout">Adicionar treino</button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5">
                                                <thead>
                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase">
                                                        <th>Treino</th>
                                                        <th>Objetivo</th>
                                                        <th>Status</th>
                                                        <th>Divisões</th>
                                                        <th>Exercícios</th>
                                                        <th>Criado em</th>
                                                        <th class="text-end">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-semibold text-gray-700">
                                                    @forelse ($workouts as $workout)
                                                    @php
                                                    $workoutStatus = $workout->status ?? 'ativo';
                                                    $statusClasses = [
                                                    'ativo' => 'badge-light-success',
                                                    'pausado' => 'badge-light-warning',
                                                    'finalizado' => 'badge-light-secondary',
                                                    ];
                                                    $statusLabels = [
                                                    'ativo' => 'Ativo',
                                                    'pausado' => 'Pausado',
                                                    'finalizado' => 'Finalizado',
                                                    ];
                                                    @endphp
                                                    <tr>
                                                        <td class="fw-bold text-dark">{{ $workout->nome }}</td>
                                                        <td>{{ $workout->objetivo ?? '-' }}</td>
                                                        <td>
                                                            <span class="badge {{ $statusClasses[$workoutStatus] ?? 'badge-light-primary' }}">
                                                                {{ $statusLabels[$workoutStatus] ?? ucfirst($workoutStatus) }}
                                                            </span>
                                                        </td>
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
                                                            <button type="button" class="btn btn-sm btn-light-primary me-2 js-edit-workout" data-workout='@json($workout)'>
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                                <span class="svg-icon svg-icon-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->Editar</button>
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
                                                        <td colspan="7" class="text-center text-gray-500 py-10">Nenhum treino cadastrado.</td>
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
                                                        <td>
                                                            @if ($exercise->exerciseCategory)
                                                            <div class="d-flex align-items-center gap-2">
                                                                @if ($exercise->exerciseCategory->imagem)
                                                                <img src="{{ asset('storage/' . $exercise->exerciseCategory->imagem) }}" class="rounded" width="34" height="34" style="object-fit: cover;" alt="{{ $exercise->exerciseCategory->nome }}">
                                                                @endif
                                                                <div>
                                                                    <div class="fw-bold text-dark">{{ $exercise->exerciseCategory->nome }}</div>
                                                                    <div class="text-gray-500 fs-7">{{ data_get($exercise, 'exerciseCategory.muscleGroup.nome', '-') }}</div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        <td>{{ data_get($exercise, 'trainingDivision.workout.nome', '-') }}</td>
                                                        <td>{{ data_get($exercise, 'trainingDivision.nome', '-') }}</td>
                                                        <td>{{ $exercise->series ?? '-' }}</td>
                                                        <td>{{ $exercise->repeticoes ?? '-' }}</td>
                                                        <td>{{ $exercise->carga ? number_format($exercise->carga, 2, ',', '.') . ' kg' : '-' }}</td>
                                                        <td>{{ $exercise->tempo_descanso ? $exercise->tempo_descanso . 's' : '-' }}</td>
                                                        <td>{{ $exercise->observacao ?? '-' }}</td>
                                                        <td class="text-end">
                                                            <button type="button" class="btn btn-sm btn-light-primary me-2 js-edit-exercise" data-exercise='@json($exercise)'>
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                                <span class="svg-icon svg-icon-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->Editar</button>
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
                                                        <td colspan="10" class="text-center text-gray-500 py-10">Nenhum exercício cadastrado.</td>
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
                                                            <button type="button" class="btn btn-sm btn-light-primary me-2 js-edit-division" data-division='@json($division)'>
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                                <span class="svg-icon svg-icon-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->Editar</button>
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
                                        <h3 class="card-title fw-bold text-dark"><span class="card-label fw-bolder fs-3 mb-1">Progresso</span></h3>
                                        <div class="card-toolbar">
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_cadastro_progresso">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->Adicionar Progresso</button>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5">
                                                <thead>
                                                    <tr class="fw-bolder text-muted bg-secondary">
                                                        <th class="rounded-start"><span class="progress-board-icon">☑</span>Registro</th>
                                                        <th><span class="progress-board-icon">▣</span>Data</th>
                                                        <th><span class="progress-board-icon">#</span>Idade</th>
                                                        <th><span class="progress-board-icon">#</span>Peso(kg)</th>
                                                        <th><span class="progress-board-icon">#</span>Altura(cm)</th>
                                                        <th><span class="progress-board-icon">#</span>Meta Kcal</th>
                                                        <th><span class="progress-board-icon">Σ</span>Kcal Necessária</th>
                                                        <th><span class="progress-board-icon">Σ</span>Carboidrato(g/kg)</th>
                                                        <th><span class="progress-board-icon">Σ</span>Proteína(g/kg)</th>
                                                        <th><span class="progress-board-icon">Σ</span>Gordura(g/kg)</th>
                                                        <th class="rounded-end"></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @forelse ($workoutProgress as $progress)
                                                    <tr>
                                                        <td class="fw-semibold text-dark"> <a href="#" onClick="return abrirModalEditar({{ $progress->id }});" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6" data-bs-toggle="modal" data-bs-target="#modal_editar"> Registro {{ $loop->iteration }}</a></td>
                                                        <td> <a href="#" onClick="return abrirModalEditar({{ $progress->id }});" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6" data-bs-toggle="modal" data-bs-target="#modal_editar">{{ \Carbon\Carbon::parse($progress->data_registro)->format('d/m/Y') }} </a></td>
                                                        <td> <a href="#" onClick="return abrirModalEditar({{ $progress->id }});" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6" data-bs-toggle="modal" data-bs-target="#modal_editar">{{ $progress->idade ?? '-' }}</a></td>
                                                        <td> <a href="#" onClick="return abrirModalEditar({{ $progress->id }});" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6" data-bs-toggle="modal" data-bs-target="#modal_editar">{{ $progress->peso ? number_format($progress->peso, 2, ',', '.') : '-' }} Kg</a></td>
                                                        <td> <a href="#" onClick="return abrirModalEditar({{ $progress->id }});" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6" data-bs-toggle="modal" data-bs-target="#modal_editar">{{ $progress->altura ? number_format($progress->altura * 100, 0, ',', '.') : '-' }} cm</a></td>
                                                        <td> <a href="#" onClick="return abrirModalEditar({{ $progress->id }});" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6" data-bs-toggle="modal" data-bs-target="#modal_editar">{{ $progress->meta_kcal ?? '-' }}</a></td>
                                                        <td> <a href="#" onClick="return abrirModalEditar({{ $progress->id }});" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6" data-bs-toggle="modal" data-bs-target="#modal_editar">{{ $progress->meta_necessaria ?? '-' }}</a></td>
                                                        <td> <a href="#" onClick="return abrirModalEditar({{ $progress->id }});" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6" data-bs-toggle="modal" data-bs-target="#modal_editar">{{ $progress->carboidrato ?? '-' }}</a></td>
                                                        <td> <a href="#" onClick="return abrirModalEditar({{ $progress->id }});" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6" data-bs-toggle="modal" data-bs-target="#modal_editar">{{ $progress->proteina ?? '-' }}</a></td>
                                                        <td> <a href="#" onClick="return abrirModalEditar({{ $progress->id }});" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6" data-bs-toggle="modal" data-bs-target="#modal_editar">{{ $progress->gordura ?? '-' }}</a></td>
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-light-primary me-2 js-edit-progress" data-progress='@json($progress)'>
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                                <span class="svg-icon svg-icon-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->Editar</button>

                                                            <button type="button" class="btn btn-sm btn-light-danger" onClick="return excluir('{{ $progress->id }}');">
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                                <span class="svg-icon svg-icon-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->Excluir</button>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr class="progress-board-empty">
                                                        <td><span class="progress-board-icon">+</span>Nova página</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>

                                            </table>
                                        </div>
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
    @include('workout.progresso.criar')
    @include('workout.progresso.js')
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


    @include('workout.js')
    @include('account.settings')

</body>
<!--end::Body-->
</html>
