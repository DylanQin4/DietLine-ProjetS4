<nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar"
    >
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="d-flex align-items-center justify-content-between w-100" id="navbar-collapse">
        <!-- Logo -->
        <div class="app-brand demo py-2">
            
        </div>

        <ul class="navbar-nav flex-row align-items-center">

            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                    />
                </div>
            </div>
            <!-- /Search -->
            
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar">
                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="<?= base_url('/') ?>">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                                <img src="" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                            </div>
                            <div class="flex-grow-1">
                            <span class="fw-semibold d-block text-uppercase"><</span>
                        </div>
                    </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="<?= base_url('') ?>">
                    <i class="bx bx-user me-2"></i>
                    <span class="align-middle">Profile</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                    <i class="bx bx-cog me-2"></i>
                    <span class="align-middle">Parametres</span>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle">Se deconnecter</span>
                    </a>
                </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>