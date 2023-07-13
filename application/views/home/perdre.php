<?php require 'layouts/header.php'; ?>               
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class=" container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column justify-content-between align-items-baseline h-100">
                <div class="d-flex justify-content-between w-100 mb-4">
                    <h4 class="fw-bold">Accueil</h4>
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

                <div class=" w-100 h-100 d-flex justify-content-center align-items-center">
                    <div class="d-flex">
                        <div class="modal-dialog">
                            <form class="modal-content" method="POST" action="<?php echo base_url('regime/generated') ?>">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTopTitle">Perdre du poids</h5>
                                </div>
                                <div class="modal-body">
                                <p for="nameSlideTop" class="">Poids actuel: <strong><?php echo isset($_SESSION['poids'])? $_SESSION['poids']: ''?>Kg</strong></p>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <input type="hidden" name="type_regime" value=1>
                                            <label for="nameSlideTop" class="form-label">Poids a atteindre</label>
                                            <input type="text" id="nameSlideTop" class="form-control" name="poids_atteindre" placeholder="Entrer votre futur poids">
                                            <small class="text-danger" ><?php echo isset($error) ? $error: '' ?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Generer un regime</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper -->
<?php require 'layouts/footer.php'; ?>
