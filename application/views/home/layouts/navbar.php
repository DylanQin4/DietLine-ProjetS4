<nav
    class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar"
    >
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="h-100 d-flex align-items-center justify-content-between w-100" id="navbar-collapse">
        <!-- Logo -->
        <a href="<?php echo base_url('') ?>" class="app-brand demo me-2 h-100">
            <img class="h-100" src="<?php echo base_url('assets/img/logo.png') ?>" alt="" srcset="">
        </a>

        <div class="navbar-nav me-auto">
            <a class="nav-item nav-link active">Accueil</a>
            <a class="nav-item nav-link">Evolution</a>
        </div>

        <ul class="navbar-nav flex-row align-items-center">

            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">

                    <form action="<?= base_url('/user/wallet') ?>" class="mx-4" >
                        <button type="submit" class="btn btn-outline-primary p-2">
                            <i class="bx bx-wallet"></i>
                        </button>
                    </form>
                </div>
            </div>
            <!-- /Search -->
            
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar d-flex align-items-center">
                    <i class='bx bxs-user-circle' style='color:#5f61e6; font-size: 32px'></i>
                </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="<?= base_url('/user/profil') ?>">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                                <i class='bx bxs-user-circle' style='color:#5f61e6; font-size: 38px'></i>
                            </div>
                            </div>
                            <div class="flex-grow-1">
                            <span class="fw-semibold d-block text-uppercase"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''?></span>
                        </div>
                    </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="<?= base_url('user/profil') ?>">
                    <i class="bx bx-user me-2"></i>
                    <span class="align-middle">Profile</span>
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
                    
                    