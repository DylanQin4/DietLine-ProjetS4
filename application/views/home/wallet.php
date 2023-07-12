<?php require 'layouts/header.php'; ?>               
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class=" container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column justify-content-start align-items-center h-100">
                <div class="d-flex justify-content-between w-100 mb-4">
                    <h4 class="fw-bold">Votre solde: <?php echo $_SESSION['wallet'].' Ar'?></h4>
                </div>

                <div class="card w-50 d-flex justify-content-center align-items-center mb-4">
                    <div class="table-responsive text-nowrap d-flex flex-column"><div class="card-body">
                        <form action="<?= base_url('/user/validation_user')?>" method="POST">
                            <div class="d-flex flex-column align-items-center">
                                <label for="defaultFormControlInput" class="form-label">Code</label>
                                <input type="text" class="form-control mb-2" name="code" placeholder="Entrer un code valide" autocomplete="off" value=<?= (isset($value)) ? $value : "" ?>>
                                <small class="mb-2" style="color:#ff3e1d"><?= (isset($error)) ? $error : "" ?></small>
                                <button type="submit" class="btn btn-primary w-75">
                                    <span class="tf-icons bx bx-pie-chart-alt"></span>&nbsp; Valider
                                </button>
                            </div>
                        </form>
                      
                    </div>
                    </div>
                </div>
                <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Codes</th>
                            <th>Valeur</th>
                            <th>Statut</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php for($i = 0; $i < count($list_codes['code']); $i++){ ?>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong><?= $list_codes['code'][$i]?></strong></td>
                                    <td><?= $list_codes['valeur'][$i] ?></td>
                                    <td><?php 
                                    if($list_codes['status'][$i] == 1){ ?>
                                        <span class="badge bg-label-success">valide</span>
                                    <?php } else if($list_codes['status'][$i] == 2){?>
                                        <span class="badge bg-label-info">en attente</span>
                                    <?php } else {?>
                                        <span class="badge bg-label-danger">non valide</span>
                                    <?php } ?></td>
                                
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require 'layouts/footer.php'; ?>
