<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo py-2">
        <a href="<?php echo base_url('/') ?>" class=" demo h-100">
            <img class="h-100" src="<?php echo base_url('assets/img/logo.png') ?>" alt="" srcset="">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="<?= base_url('/admin') ?>" class="menu-link">
            <div data-i18n="Analytics">Tableau de bord</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div data-i18n="Layouts">Validation en attente</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?php echo base_url('regime/regime_user'); ?>" class="menu-link">
                    <div data-i18n="Analytics">Validation de regime</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo base_url('user/wallet_user'); ?>" class="menu-link">
                    <div data-i18n="Analytics">Validation de depot</div>
                    </a>
                </li>
                
            </ul>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div data-i18n="Layouts">Gestion des tâches</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?php echo base_url('User/list_user'); ?>" class="menu-link">
                    <div data-i18n="Analytics">Utilisateur</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo base_url('Aliment/get_aliment'); ?>" class="menu-link">
                    <div data-i18n="Analytics">Régime</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo base_url('Sport/get_all'); ?>" class="menu-link">
                    <div data-i18n="Analytics">Sport</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?php echo base_url('code/get_all'); ?>" class="menu-link">
                    <div data-i18n="Analytics">Code</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<!-- / Menu --  