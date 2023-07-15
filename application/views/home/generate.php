<?php require 'layouts/header.php'; ?>               
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class=" container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column justify-content-between align-items-baseline h-100">
                <div class="d-flex flex-column w-100 justify-content-start">
                    <div class="d-flex justify-content-between w-100 mb-4">
                        <h4 class="fw-bold">Accueil</h4>

                        <div class="d-flex">
                            <div class="mx-2">
                                <button type="submit" class="btn btn-outline-primary  d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#basicModal">
                                    <i class='bx bx-refresh'></i><span class="ml-2">Mon poids</span>
                                </button>

                                <!-- Modal Modification -->
                                <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="nameBasic" class="form-label">Name</label>
                                                <input type="text" id="nameBasic" class="form-control" placeholder="Enter Name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
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
                        </div>
                    </div>

                    <p><?php echo isset($_SESSION['regime_generated']) ? var_dump($_SESSION['regime_generated']): 'tsisy' ?></p>

                    <div class="card">
                        <div class="d-flex align-items-center">
                            <h5 class="card-header">Montant a paye: <strong><?php echo $regime_generated['sum_prix'] ?> Ar</strong></h5>
                            <form class="mx-4 d-flex" action="insert">
                                <?php if ($_SESSION['wallet'] >= $regime_generated['sum_prix']) { ?>
                                    <button type="submit" class="btn btn-primary mx-1">Valider</button>
                                <?php } else { ?>
                                    <div class="mx-1">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalToggle">
                                            Valider
                                        </button>

                                        <!-- Modal 1-->
                                        <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalToggleLabel"></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">Désolé, vous n'avez pas assez d'argent dans votre portefeuille pour effectuer ce montant.</div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-primary" href="<?php echo base_url('user/wallet')?>">Ajouter</a>
                                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                
                                <a class="btn btn-outline-danger" href="<?php echo base_url('regime/cancel')?>">Annuler</a>
                            </form>
                        </div>
                        <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="bold"></th>
                                <th colspan="3" class="text-center border">Plats</th>
                                <th></th>
                                <th class="bold"></th>
                                <th class="bold"></th>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold border">Jour</td>
                                <td class="text-center fw-bold border">Matin</td>
                                <td class="text-center fw-bold border">Midi</td>
                                <td class="text-center fw-bold border">Soir</td>
                                <td class="text-center fw-bold border">Sport</td>
                                <td class="text-center fw-bold border">Montant</td>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php
                                    for ($i=0; $i < count($regime_generated['details_plats']); $i++) { 
                                    $sum = 0;
                                ?>
                                    <tr>
                                        <td><strong><?php echo $i+1 ?></strong></td>
                                        <?php for ($j=0; $j < count($regime_generated['details_plats'][$i]); $j++) {
                                            $sum = $sum + $regime_generated['details_plats'][$i][$j]['prix'];
                                        ?>
                                            <td><?php echo $regime_generated['details_plats'][$i][$j]['nom']    ?></td>
                                        <?php } ?>
                                        <td><?php echo $regime_generated['details_sports'][$i]    ?></td>
                                        <td  class="text-end"><?php echo $sum ?></td>
                                    </tr>
                                <?php } ?>
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
