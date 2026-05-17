<style>
    #kt_app_main {
        display: flex;
        flex-direction: column;
        padding-bottom: 56px;
    }

    #kt_app_wrapper {
        min-height: 100vh;
    }

    #kt_app_main > .d-flex.flex-column.flex-column-fluid {
        flex: 1 0 auto;
    }

    #kt_app_footer {
        background: #ffffff;
        border-top: 1px solid #eff2f5;
        bottom: 0;
        left: 0;
        position: fixed;
        right: 0;
        z-index: 99;
    }

    @media (min-width: 992px) {
        #kt_app_footer {
            left: var(--gf-sidebar-width, 265px);
        }
    }
</style>

<div id="kt_app_footer" class="app-footer bg-white">
    <!--begin::Footer container-->
    <div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-semibold me-1">2022&copy;</span>
            <a href="https://keenthemes.com" target="_blank" class="text-gray-800 text-hover-primary">Leonardo</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
            <li class="menu-item">
                <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">About</a>
            </li>
            <li class="menu-item">
                <a href="https://devs.keenthemes.com" target="_blank" class="menu-link px-2">Support</a>
            </li>
            <li class="menu-item">
                <a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
            </li>
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Footer container-->
</div>
