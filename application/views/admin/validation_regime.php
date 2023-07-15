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

                            <?php for($i = 0; $i < 2; $i++){ ?>
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>jhgf</strong></td>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i><strong>kjhg</strong></td>
                                    <td>sdfgh</td>
                                    <td>
                                        <button type="button" class="btn btn-success">
                                        <a href="<?= base_url("user/validation_regime?id_periode_regime=1&id_user=2")?>" style="color: inherit; text-decoration: none;">Valider</a>
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                            <a href="<?= base_url("user/refus_regime?indice_valid_code=1")?>" style="color: inherit; text-decoration: none;" style="color: inherit; text-decoration: none;">Refuser</a>
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
