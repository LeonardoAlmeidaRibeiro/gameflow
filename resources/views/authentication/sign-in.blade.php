<!DOCTYPE html>
<html lang="pt-BR">
	<!--begin::Head-->
	<head>
		<title>Entrar | Gameflow</title>
		<meta charset="utf-8" />
		<meta name="description" content="Acesse sua conta Gameflow." />
		<meta name="keywords" content="gameflow, login, autenticação, acesso, conta" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="pt_BR" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="Entrar | Gameflow" />
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
			.social-auth-btn {
				border: 1px solid #e1e3ea !important;
			}
		</style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
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
			</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Sign-in -->
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
						<h2 class="text-white fw-normal m-0">Ferramentas criadas para o seu negócio</h2>
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
							<form class="form w-100" id="kt_sign_in_form" data-kt-redirect-url="{{ url('/') }}" action="{{ route('login.submit') }}" method="POST">
								@csrf
								@if (session('success'))
									<div class="alert alert-success mb-6">
										{{ session('success') }}
									</div>
								@endif
								@if ($errors->any())
									<div class="alert alert-danger mb-6">
										{{ $errors->first() }}
									</div>
								@endif
								<!--begin::Heading-->
								<div class="text-center mb-11">
									<!--begin::Title-->
									<h1 class="text-dark fw-bolder mb-3">Entrar</h1>
									<!--end::Title-->
									<!--begin::Subtitle-->
									<div class="text-gray-500 fw-semibold fs-6">Acesse sua conta</div>
									<!--end::Subtitle=-->
								</div>
								<!--end::Heading-->
								<!--begin::Login options-->
								<div class="row g-3 mb-9">
									<!--begin::Col-->
									<div class="col-md-6">
										<a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100 social-auth-btn">
											<img alt="Logotipo do Google" src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}" class="h-15px me-3" />Entrar com Google
										</a>
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6">
										<a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100 social-auth-btn">
											<img alt="Logotipo da Apple" src="{{ asset('assets/media/svg/brand-logos/apple-black.svg') }}" class="theme-light-show h-15px me-3" />
											<img alt="Logotipo da Apple" src="{{ asset('assets/media/svg/brand-logos/apple-black-dark.svg') }}" class="theme-dark-show h-15px me-3" />Entrar com Apple
										</a>
									</div>
									<!--end::Col-->
								</div>
								<!--end::Login options-->
								<!--begin::Input group=-->
								<div class="fv-row mb-8">
									<input type="email" placeholder="E-mail" name="email" autocomplete="off" value="{{ old('email') }}" class="form-control bg-transparent" required />
								</div>
								<!--end::Input group=-->
								<!--begin::Input group=-->
								<div class="fv-row mb-3">
									<input type="password" placeholder="Senha" name="password" autocomplete="off" class="form-control bg-transparent" required />
								</div>
								<!--end::Input group=-->
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<div></div>
									<a href="{{ route('reset-password') }}" class="link-primary">Esqueceu a senha?</a>
								</div>
								<!--end::Wrapper-->
								<!--begin::Submit button-->
								<div class="d-grid mb-10">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
										<span class="indicator-label">Entrar</span>
										<span class="indicator-progress">Aguarde...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
								<!--end::Submit button-->
								<!--begin::Sign up-->
								<div class="text-gray-500 text-center fw-semibold fs-6">
									Ainda não é membro?
									<a href="{{ route('signUp') }}" class="link-primary">Cadastrar-se</a>
								</div>
								<!--end::Sign up-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Card body-->
					</div>
					<!--end::Card-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "{{ asset('assets') }}/";</script>
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
