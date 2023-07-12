<?php require 'layouts/header.php'; ?>               
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class=" container-xxl flex-grow-1 container-p-y">
            <div class="d-flex flex-column justify-content-start align-items-center h-100">
                <div class="d-flex justify-content-between w-100 mb-4">
                
                </div>
                <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nom d'utilisateurs</th>
                            <th>Codes</th>
                            <th>Valeur</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            <?php for($i = 0; $i < count($attente); $i++){ ?>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong><?php echo $username[$i]->username ?></strong></td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong><?php echo $attente[$i]->codes ?></strong></td>
                                    <td><?php echo $valeur[$i]?></td>
                                    <td>
                                        <button type="button" class="btn btn-success">
                                            <a href="<?= base_url("user/validation_admin?id_code=".$attente[$i]->id_code."&id_user=".$attente[$i]->id_user."&valeur=".$valeur[$i])?>" style="color: inherit; text-decoration: none;">Valider</a>
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            <a href="<?= base_url("user/refus_admin?indice_valid_code=".$attente[$i]->id_val)?>" style="color: inherit; text-decoration: none;" style="color: inherit; text-decoration: none;">Refuser</a>
                                        </button>
                                    </td>
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
