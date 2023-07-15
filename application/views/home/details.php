<?php require 'layouts/header.php'; ?>               
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class=" container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column justify-content-start align-items-baseline h-100">
                <div class="d-flex flex-column w-100 justify-content-start">
                    <div class="d-flex justify-content-between w-100 mb-4">
                        <h4 class="fw-bold mb-0">
                        <div>
                            <a href="<?php echo base_url('') ?>">
                                <i class="ml-1 bx bxs-left-arrow-circle" style="color:#5f61e6; font-size: 36px"></i>Retour
                            </a>
                        </div>
                        </h4>

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

                <h5 class="mt-2 text-muted">Regime du <?php echo formatFrenchDate($periode_regime->date_debut)?> a <?php echo formatFrenchDate($periode_regime->date_fin)?></h5>
                    <div class="row mb-5 w-100">
                    <?php
                    for ($i=0; $i < count($regimes['details_aliments']); $i++) { ?>
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="card h-100" style="opacity:1">
                                <div class="card-body"> 
                                    <h4 class="card-title">Jour <?php echo $i+1 ?></h4>
                                    <div class="card-subtitle text-muted">Plats</div>
                                    <div class="card-text">
                                        <?php 
                                        $sum = 0;
                                        for ($j=0; $j < count($regimes['details_aliments'][$i]); $j++) { ?>
                                            <div class="d-flex justify-content-between"><strong><?php echo $regimes['details_aliments'][$i][$j]->nom ?></strong>
                                            <div><strong><?php echo $regimes['details_aliments'][$i][$j]->prix ?> Ar</strong></div></div>
                                        <?php 
                                        $sum = $sum + $regimes['details_aliments'][$i][$j]->prix;
                                        } ?>
                                    </div>

                                    <div class="card-subtitle text-muted mt-2">Sports</div>
                                    <div class="card-text">
                                        <div class="d-flex justify-content-between"><div><strong><?php echo $regimes['details_sportif'][$i]->nom ?> </strong></div><div><strong>0Ar</strong></div></div>
                                    </div>

                                    <div class="d-flex flex-column justify-content-end align-items-end">
                                        <p>Total: <strong><?php echo $sum?> Ar</strong></p>
                                        <a type="button" class="btn btn-primary" style="outline:none;color:#fff" href="<?php echo base_url('regime/detail/'.$id_periode_regime.'/'.$i+1.) ?>">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
    <!-- Content Wrapper -->
<?php require 'layouts/footer.php'; ?>

