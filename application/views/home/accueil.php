<?php require 'layouts/header.php'; ?>               
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class=" container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column justify-content-start align-items-baseline h-100">
                <div class="d-flex flex-column w-100 justify-content-start">
                    <div class="d-flex justify-content-between w-100 mb-4">
                        <h4 class="fw-bold">Accueil</h4>

                        <div class="d-flex">
                            <div class="mx-2">
                                <button type="submit" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                                    <i class='bx bx-refresh mx-2'></i>Mon poids
                                </button>

                                <!-- Modal Modification -->
                            <form action="<?= base_url('user/updatePoids')?>" method="POST">
                                <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Mis a jour de mon poids</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <h5 class="modal-title" id="exampleModalLabel1">Votre poids: <?php echo (isset($_SESSION['poids'])) ? $_SESSION['poids'] : ""  ?> kg</h5>
                                                <label for="nameBasic" class="form-label">Nouveau poids</label>
                                                <input type="text" name="poids" class="form-control" placeholder="Entrer votre poids actuel">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Fermer
                                        </button>
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>        

                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Nouveau regime
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a class="dropdown-item" href="<?php echo base_url('regime/perdre') ?>">Perdre du poids</a>
                                    <a class="dropdown-item" href="<?php echo base_url('regime/avoir') ?>">Avoir du poids</a>
                                    <a class="dropdown-item" href="<?php echo base_url('regime/imcideal') ?>">Atteindre l'IMC ideal</a>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>

                <?php if (($regime_en_cours != null || $regime_en_attente != null)) { 
                    require "regime/liste.php";
                } else { 
                    require "regime/vide.php";
                } ?>

            </div>
        </div>
    </div>
    <!-- Content Wrapper -->
<?php require 'layouts/footer.php'; ?>
