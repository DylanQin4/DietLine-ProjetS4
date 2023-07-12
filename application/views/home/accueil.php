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
                                <button type="submit" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                                    <i class='bx bx-refresh mx-2'></i>Mon poids
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

                    

                </div>
            </div>
        </div>
    </div>
    <!-- Content Wrapper -->
<?php require 'layouts/footer.php'; ?>
