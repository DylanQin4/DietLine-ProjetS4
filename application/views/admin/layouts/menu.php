<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo py-2">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Logo</span>
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
            <a href="<?= base_url('/') ?>" class="menu-link">
            <div data-i18n="Analytics">Authentification</div>
            <a href="<?= base_url('/user/wallet_user') ?>" class="menu-link">
            <div data-i18n="Analytics">Validation en attente</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div data-i18n="Layouts">Getion des tâches</div>
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
            </ul>
        </li>

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
            <div data-i18n="Layouts">Code</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="<?= base_url('/code/general-accounting') ?>" class="menu-link">
                    <div data-i18n="Without menu">Liste</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('/code/chart-of-accounts') ?>" class="menu-link">
                    <div data-i18n="Without navbar">Plan Tiers</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="<?= base_url('/code/journal-code') ?>" class="menu-link">
                    <div data-i18n="Container">Codes Journaux</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<!-- / Menu --  