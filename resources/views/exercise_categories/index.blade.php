<!DOCTYPE html>
<html lang="pt-BR">
<!--begin::Head-->
<head>
    <title>Categorias de Exercício | GameFlow</title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Gerencie categorias de exercício por grupo muscular no GameFlow." />
    <meta name="keywords" content="gameflow, treino, exercício, categoria, grupo muscular" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Categorias de Exercício | GameFlow" />
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
                                        <li class="breadcrumb-item text-muted">Categorias de exercício</li>
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

                            <!--begin::Post-->
                            <div id="kt_post" class="post d-flex flex-column-fluid">
                                <!--begin::Container-->
                                <div id="kt_content_container" class="container-fluid">
                                    <!--begin::Tabela-->
                                    <div class="card mb-5 mb-xl-8">
                                        <!--begin::Header-->
                                        <div class="card-header border-0 pt-5">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="card-label fw-bolder fs-3 mb-1">Categorias de exercício</span>
                                                <span class="text-muted mt-1 fw-bold fs-7">Cadastro por grupo muscular</span>
                                            </h3>
                                            <div class="card-toolbar">
                                                <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#modal_cadastro">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->Nova categoria
                                                </a>
                                            </div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body py-3">
                                            <!--begin::Table container-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table id="tabela" class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <tr class="fw-bolder text-muted bg-secondary">
                                                            <th class="ps-4 min-w-100px rounded-start">Imagem</th>
                                                            <th class="min-w-200px">Categoria</th>
                                                            <th class="min-w-200px">Grupo muscular</th>
                                                            <th class="min-w-250px">Descrição</th>
                                                            <th class="min-w-200px text-end rounded-end">Ações</th>
                                                        </tr>
                                                    </thead>
                                                    <!--end::Table head-->
                                                    <!--begin::Table body-->
                                                    <tbody>
                                                        @foreach ($exerciseCategories as $category)
                                                        <tr id="tr_{{ $category->id }}">
                                                            <td id="celula_imagem_{{ $category->id }}">
                                                                @if ($category->imagem)
                                                                    <img src="{{ $category->imagem_url }}" class="rounded" width="46" height="46" style="object-fit: cover;" alt="{{ $category->nome }}">
                                                                @else
                                                                    <span class="badge badge-light">Sem imagem</span>
                                                                @endif
                                                            </td>
                                                            <td id="celula_nome_{{ $category->id }}" class="fw-bold text-dark">{{ $category->nome }}</td>
                                                            <td id="celula_grupo_{{ $category->id }}">{{ data_get($category, 'muscleGroup.nome', '-') }}</td>
                                                            <td id="celula_descricao_{{ $category->id }}">{{ $category->descricao ?: '-' }}</td>
                                                            <td class="text-end">
                                                                <button type="button" class="btn btn-sm btn-light-primary me-2" onClick="return abrirModalEditar('{{ $category->id }}');" data-bs-toggle="modal" data-bs-target="#modal_editar">Editar</button>
                                                                <button type="button" class="btn btn-sm btn-light-danger" onClick="return excluir('{{ $category->id }}');">Excluir</button>
                                                            </td>
                                                            <input type="hidden" id="celula_muscle_group_id_{{ $category->id }}" value="{{ $category->muscle_group_id }}">
                                                            <input type="hidden" id="celula_imagem_url_{{ $category->id }}" value="{{ $category->imagem_url ?: '' }}">
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Table container-->
                                        </div>
                                        <!--begin::Body-->
                                    </div>
                                    <!--end::Tabela-->
                                    @include('exercise_categories.criar')
                                    @include('exercise_categories.editar')
                                    @include('exercise_categories.js')
                                </div>
                            </div>

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


    <!--begin::Javascript-->
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

</body>
<!--end::Body-->
</html>
