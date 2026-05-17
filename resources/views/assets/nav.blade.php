@php
    $navItems = [
        [
            'label' => 'Meus Dados',
            'route' => 'account.show',
            'active' => ['account.*'],
        ],
        [
            'label' => 'Finanças',
            'route' => 'finance.index',
            'active' => ['finance.*'],
        ],
        [
            'label' => 'Treinos',
            'route' => 'workouts.index',
            'active' => ['workouts.*'],
        ],
    ];
@endphp

<ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
    @foreach ($navItems as $item)
        <li class="nav-item mt-2">
            <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->routeIs($item['active']) ? 'active' : '' }}" href="{{ route($item['route']) }}">{{ $item['label'] }}</a>
        </li>
    @endforeach

    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5" href="../../demo1/dist/account/security.html">Segurança</a>
    </li>

    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5" href="../../demo1/dist/account/billing.html">Cobrança</a>
    </li>

    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5" href="../../demo1/dist/account/statements.html">Extratos</a>
    </li>

    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5" href="../../demo1/dist/account/referrals.html">Indicações</a>
    </li>

    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5" href="../../demo1/dist/account/api-keys.html">Chaves de API</a>
    </li>

    <li class="nav-item mt-2">
        <a class="nav-link text-active-primary ms-0 me-10 py-5" href="../../demo1/dist/account/logs.html">Logs</a>
    </li>
</ul>
