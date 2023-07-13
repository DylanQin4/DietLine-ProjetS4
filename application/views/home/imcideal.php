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

                <div class=" w-100 h-100 d-flex flex-column justify-content-start align-items-center">
                    <div class="d-flex justify-content-around w-75">
                        <div class="w-25 text-center py-2 rounded-start btn-info">
                            Maigre <br>
                            < 18,5
                        </div>
                        <div class="w-25 text-center py-2 btn-success">
                            Normal <br>
                            18,5 a 25
                        </div>
                        <div class="w-25 text-center py-2 btn-warning">
                            Surpoids <br>
                            25 a 30
                        </div>
                        <div class="w-25 text-center py-2 btn-danger">
                            Obésité modérée <br>
                            30 a 40
                        </div>
                        <div class="w-25 text-center py-2 rounded-end btn-dark">
                            Obésité sévère <br>
                            > 40
                        </div>
                    </div>
                    <div class="d-flex justify-content-around w-75">
                        <div class="w-25 text-center">
                            <?php                   
                                if ($my_imc < 18.5) {
                                    echo "<i class='bx bx-up-arrow-alt'></i><br>";
                                    echo "Votre IMC actuel : ".$my_imc;
                                }
                            ?>
                        </div>
                        <div class="w-25 text-center">
                            <?php                            
                                if ($my_imc > 18.5 && $my_imc < 25) {
                                    echo "<i class='bx bx-up-arrow-alt'></i><br>";
                                    echo "Votre IMC actuel : ".$my_imc;
                                }
                            ?>
                        </div>
                        <div class="w-25 text-center">
                            <?php                            
                                if ($my_imc > 25 && $my_imc < 30) {
                                    echo "<i class='bx bx-up-arrow-alt'></i><br>";
                                    echo "Votre IMC actuel : ".$my_imc;
                                }
                            ?>
                        </div>
                        <div class="w-25 text-center">
                            <?php                            
                                if ($my_imc > 30 && $my_imc < 40) {
                                    echo "<i class='bx bx-up-arrow-alt'></i><br>";
                                    echo "Votre IMC actuel : ".$my_imc;
                                }
                            ?>
                        </div>
                        <div class="w-25 text-center">
                            <?php                            
                                if ($my_imc > 40) {
                                    echo "<i class='bx bx-up-arrow-alt'></i><br>";
                                    echo "Votre IMC actuel : ".$my_imc;
                                }
                            ?>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="modal-dialog">
                            <form class="modal-content" method="POST" action="<?php echo base_url('regime/imc') ?>" >
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTopTitle">Indice de masse corporelle (IMC)</h5>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameSlideTop" class="form-label">Mon IMC: </label>
                                        <input type="text" id="nameSlideTop" class="form-control" placeholder="" value="<?php echo $my_imc?>" readonly="on">
                                    </div>
                                    <div class="col mb-3">
                                        <label for="nameSlideTop" class="form-label">IMC a atteindre</label>
                                        <input type="text" id="nameSlideTop" class="form-control" placeholder="" name="futur_imc" value="<?php echo isset($error_value) ? $error_value: '' ?>">
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
