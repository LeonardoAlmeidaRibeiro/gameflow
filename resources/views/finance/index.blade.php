<!DOCTYPE html>
<html lang="pt-BR">
<!--begin::Head-->
<head>
    <title>Finanças | GameFlow</title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Gerencie seus lançamentos financeiros no GameFlow." />
    <meta name="keywords" content="gameflow, finanças, receitas, despesas, lançamentos financeiros" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Finanças | GameFlow" />
    <meta property="og:site_name" content="GameFlow" />
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
                                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Finanças</h1>
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
                                        <li class="breadcrumb-item text-muted">Finanças</li>
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
                                <!--begin::details View-->
                                <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                                    <!--begin::Card header-->
                                    <div class="card-header cursor-pointer">
                                        <!--begin::Card title-->
                                        <div class="card-title m-0">
                                            <h3 class="fw-bold m-0">Minhas Finanças</h3>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Action-->
                                        <div class="d-flex align-items-center gap-3">
                                            <form method="GET" action="{{ route('finance.index') }}" class="d-flex align-items-center gap-3">
                                                <select name="mes" class="form-select form-select-sm form-select-solid w-100px">
                                                    @for ($monthOption = 1; $monthOption <= 12; $monthOption++)
                                                        <option value="{{ $monthOption }}" @selected($financeMonth === $monthOption)>
                                                            {{ str_pad($monthOption, 2, '0', STR_PAD_LEFT) }}
                                                        </option>
                                                    @endfor
                                                </select>
                                                <input type="number" name="ano" class="form-control form-control-sm form-control-solid w-100px" value="{{ $financeYear }}" min="2000" max="2100" />
                                                <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
                                            </form>
                                        </div>
                                        <!--end::Action-->
                                    </div>
                                    <!--begin::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body p-9">
                                        <div class="row g-6 mb-8">
                                            <div class="col-md-3">
                                                <div class="border border-gray-300 border-dashed rounded py-4 px-5 h-100">
                                                    <div class="fs-6 fw-semibold text-muted mb-1">Receitas</div>
                                                    <div class="fs-2 fw-bold text-success">R$ {{ number_format($totalReceitas, 2, ',', '.') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="border border-gray-300 border-dashed rounded py-4 px-5 h-100">
                                                    <div class="fs-6 fw-semibold text-muted mb-1">Despesas</div>
                                                    <div class="fs-2 fw-bold text-danger">R$ {{ number_format($totalDespesas, 2, ',', '.') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="border border-gray-300 border-dashed rounded py-4 px-5 h-100">
                                                    <div class="fs-6 fw-semibold text-muted mb-1">Saldo</div>
                                                    <div class="fs-2 fw-bold {{ $saldoFinanceiro >= 0 ? 'text-primary' : 'text-danger' }}">R$ {{ number_format($saldoFinanceiro, 2, ',', '.') }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="border border-gray-300 border-dashed rounded py-4 px-5 h-100">
                                                    <div class="fs-6 fw-semibold text-muted mb-1">Pendente</div>
                                                    <div class="fs-2 fw-bold text-warning">R$ {{ number_format($totalPendente, 2, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::details View-->

                                <!--begin::details View-->
                                <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                                    <!--begin::Card header-->
                                    <div class="card-header cursor-pointer">
                                        <!--begin::Card title-->
                                        <div class="card-title m-0">
                                            <h3 class="fw-bold m-0">Lançamentos financeiros</h3>
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Action-->
                                        <div class="d-flex align-items-center gap-3">
                                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modal_adicionar_financeiro">
                                                <span class="svg-icon svg-icon-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                                    </svg>
                                                </span>
                                                Adicionar Lançamento
                                            </button>
                                        </div>
                                        <!--end::Action-->
                                    </div>
                                    <!--begin::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body p-9">

                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                <thead>
                                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="min-w-200px">Título</th>
                                                        <th class="text-center min-w-100px">Tipo</th>
                                                        <th class="min-w-140px">Categoria</th>
                                                        <th class="text-center min-w-110px">Status</th>
                                                        <th class="text-center min-w-120px">Vencimento</th>
                                                        <th class="text-end min-w-130px">Valor</th>
                                                        <th class="text-end min-w-170px">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="text-gray-700 fw-semibold">
                                                    @forelse ($finances as $finance)
                                                        <tr id="tr_{{ $finance->id }}">
                                                            <td class="align-middle">
                                                                <div class="fw-bold text-gray-900">{{ $finance->titulo }}</div>
                                                                @if ($finance->descricao)
                                                                    <div class="text-muted fs-7">{{ $finance->descricao }}</div>
                                                                @endif
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span class="badge {{ $finance->tipo === 'receita' ? 'badge-light-success' : 'badge-light-danger' }}">
                                                                    {{ ucfirst($finance->tipo) }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle">{{ optional($finance->categoria)->nome ?: 'Sem categoria' }}</td>
                                                            <td class="align-middle text-center">
                                                                <span class="badge {{ $finance->status === 'pago' ? 'badge-light-success' : ($finance->status === 'cancelado' ? 'badge-light-danger' : 'badge-light-warning') }}">
                                                                    {{ ucfirst($finance->status) }}
                                                                </span>
                                                            </td>
                                                            <td class="align-middle text-center">{{ $finance->data_vencimento ? $finance->data_vencimento->format('d/m/Y') : 'Não informado' }}</td>
                                                            <td class="align-middle text-end {{ $finance->tipo === 'receita' ? 'text-success' : 'text-danger' }}">
                                                                {{ $finance->tipo === 'receita' ? '+' : '-' }} R$ {{ number_format((float) $finance->valor, 2, ',', '.') }}
                                                            </td>
                                                            @php
                                                                $financePayload = [
                                                                    'updateUrl' => route('finance.update', $finance),
                                                                    'titulo' => $finance->titulo,
                                                                    'descricao' => $finance->descricao,
                                                                    'tipo' => $finance->tipo,
                                                                    'categoria_id' => $finance->categoria_id,
                                                                    'valor' => number_format((float) $finance->valor, 2, ',', '.'),
                                                                    'mes' => $finance->mes,
                                                                    'ano' => $finance->ano,
                                                                    'status' => $finance->status,
                                                                    'data_vencimento' => optional($finance->data_vencimento)->format('Y-m-d'),
                                                                    'data_pagamento' => optional($finance->data_pagamento)->format('Y-m-d'),
                                                                    'forma_pagamento' => $finance->forma_pagamento,
                                                                    'observacoes' => $finance->observacoes,
                                                                ];
                                                            @endphp
                                                            <td class="align-middle text-end text-nowrap">
                                                                <button type="button" class="btn btn-sm btn-light-primary me-2" onclick="editarFinanceiro(this)" data-finance='@json($financePayload)'>
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                                                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                                                        </svg>
                                                                    </span>
                                                                    Editar
                                                                </button>
                                                                <button type="button" class="btn btn-sm btn-light-danger" onclick="excluir({{ $finance->id }})">
                                                                    <span class="svg-icon svg-icon-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                                                        </svg>
                                                                    </span>
                                                                    Excluir
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center text-muted py-10">Nenhum lançamento financeiro encontrado para este período.</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
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
    @include('finance.criar')
    @include('finance.editar')
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
    <script>
        function preencherCampoFinanceiro(id, value) {
            var field = document.getElementById(id);

            if (field) {
                field.value = value || '';
            }
        }

        function editarFinanceiro(button) {
            var data = JSON.parse(button.getAttribute('data-finance'));
            var form = document.getElementById('form_editar_financeiro');
            var modalElement = document.getElementById('modal_editar_financeiro');

            if (!form || !modalElement) {
                return;
            }

            form.action = data.updateUrl;
            preencherCampoFinanceiro('editar_titulo', data.titulo);
            preencherCampoFinanceiro('editar_descricao', data.descricao);
            preencherCampoFinanceiro('editar_tipo', data.tipo);
            preencherCampoFinanceiro('editar_categoria_id', data.categoria_id);
            preencherCampoFinanceiro('editar_valor', data.valor);
            preencherCampoFinanceiro('editar_mes', data.mes);
            preencherCampoFinanceiro('editar_ano', data.ano);
            preencherCampoFinanceiro('editar_status', data.status);
            preencherCampoFinanceiro('editar_data_vencimento', data.data_vencimento);
            preencherCampoFinanceiro('editar_data_pagamento', data.data_pagamento);
            preencherCampoFinanceiro('editar_forma_pagamento', data.forma_pagamento);
            preencherCampoFinanceiro('editar_observacoes', data.observacoes);

            if (window.bootstrap) {
                new bootstrap.Modal(modalElement).show();
            }
        }

        function excluir(id) {
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

            Swal.fire({
                title: 'Tem certeza que deseja excluir?',
                text: 'Não será possível reverter essa ação.',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!'
            }).then((result) => {

                if (typeof(result.value) != 'undefined' && result.value == true) {

                    $.ajax({
                        url: "{{ url('/finance') }}/" + id,
                        type: 'DELETE',
                        headers: headers,
                        success: function(data) {

                            var message = '';
                            var success = '';

                            $.each(data, function(campo, conteudo) {
                                if (campo == 'success') {
                                    success = conteudo;
                                }
                                if (campo == 'message') {
                                    message = conteudo;
                                }
                            });

                            if (success == true) {
                                $('#tr_' + id).remove();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sucesso!',
                                    text: message
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: message
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Não foi possível excluir o lançamento.'
                            });
                        }
                    });
                }
            });
        }

    </script>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var modalElement = document.getElementById('modal_adicionar_financeiro');

                if (modalElement && window.bootstrap) {
                    new bootstrap.Modal(modalElement).show();
                }
            });

        </script>
    @endif
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

</body>
<!--end::Body-->
</html>
