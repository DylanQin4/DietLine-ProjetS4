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
                            <th>Type du regime</th>
                            <th>Montant total</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            <?php for($i = 0; $i < count($attente); $i++){ ?>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong><?php echo $username[$i]->username ?></strong></td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong><?php echo $type[$i] ?></strong></td>
                                    <td><?php echo $attente[$i]->montant_total ?></td>
                                    <td>
                                        <button type="button" class="btn btn-success">
                                        <a     href="<?= base_url("regime/validation_regime?id_periode_regime=".$attente[$i]->id."&id_user=".$attente[$i]->id_user."&date_debut=".$attente[$i]->date_debut."&date_fin=".$attente[$i]->date_fin."&montant=".$attente[$i]->montant_total)?>" style="color: inherit; text-decoration: none;">Valider</a>
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            <a href="<?= base_url("regime/refus_regime?id_periode_regime=".$attente[$i]->id."&id_user=".$attente[$i]->id_user."&montant=".$attente[$i]->montant_total)?>" style="color: inherit; text-decoration: none;" style="color: inherit; text-decoration: none;">Refuser</a>
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
