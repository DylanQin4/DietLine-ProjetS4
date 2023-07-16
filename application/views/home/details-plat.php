<?php require 'layouts/header.php'; ?>               
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class=" container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column justify-content-start align-items-baseline h-100">
                <div class="d-flex flex-column w-100 justify-content-start">
                    <div class="d-flex justify-content-between w-100 mb-4">
                        <h4 class="fw-bold mb-0">
                        <div>
                            <a onclick="history.back()" style="cursor:pointer">
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
                <div class="d-flex w-100">
                    <div class="card w-100">
                        <div class="d-flex align-items-center">
                            <h5 class="card-header">Montant a paye: <strong><?php echo "100" ?> Ar</strong></h5>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="bold"></th>
                                    <th colspan="3" class="text-center border">Pourcentage</th>
                                    <th></th>
                                    <th class="bold"></th>
                                    <th class="bold"></th>
                                </tr>
                                <tr>
                                    <td class="text-center fw-bold border">Plat</td>
                                    <td class="text-center fw-bold border">Viande</td>
                                    <td class="text-center fw-bold border">Poulet</td>
                                    <td class="text-center fw-bold border">Volaille</td>
                                    <td class="text-center fw-bold border">Ingredients</td>
                                    <td class="text-center fw-bold border">Montant</td>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php
                                        $sum = 0.00;
                                        for ($i=0; $i < count($regimes['details_aliments']); $i++) { 
                                            $sum = $sum + $regimes['details_aliments'][$i]->prix;
                                    ?>
                                        <tr>
                                            <td><strong><?php echo $regimes['details_aliments'][$i]->nom ?></strong></td>
                                            <?php for ($j=0; $j < 3; $j++) {
                                            ?>
                                                <td><?php echo $regimes['details_viandes'][$i][$j]->pourcentage?>%</td>
                                            <?php } ?>
                                            <td><?php echo $regimes['details_aliments'][$i]->ingredients ?></td>
                                            <td  class="text-end"><?php echo $regimes['details_aliments'][$i]->prix ?>Ar</td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-end">Total</td>
                                        <td class="text-end"><strong><?php echo $sum ?>Ar</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Content Wrapper -->
<?php require 'layouts/footer.php'; ?>

