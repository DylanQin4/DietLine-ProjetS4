

<?php 
    $this->load->view('admin/layouts/header');
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column justify-conten-between align-items-baseline">
        <div class="card w-100 p-4">
        
        
        <div class="d-flex">
            <div >
                <h5 class="card-header">Liste des codes</h5>
            </div>
            <div class="mx-2">
                <button type="submit" class="btn btn-primary  d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#basicModal">
                    <span class="ml-2">Ajouter un code</span>
                </button>

                <!-- Modal Modification -->
            <form action="<?= base_url('code/add_code')?>" method="POST">
                <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Ajout de code</h5>
                        <button type="button" class="btn btn-primary">
                            <a href="<?= base_url("code/generer_code")?>" style="color: inherit; text-decoration: none;">Generer un nouveau</a>
                        </button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <?php if (isset($_SESSION['code_genere'])) { ?>
                                <h5 class="modal-title" id="exampleModalLabel1">Nouveau code: <?php echo $_SESSION['code_genere']?> </h5>
                                <?php } ?>
                                <label for="nameBasic" class="form-label">Valeur</label>
                                <input type="text" name="valeur" class="form-control" placeholder="Entrer la valeur du code en Ariary">
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
        </form>
        </div>
            <table class="table">
                    <thead>
                    <tr>
                        <th>Codes</th>
                        <th>Valeur</th>
                        <th>Statut</th>
                        <th>Action</th>
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
                            <?php } ?>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="<?php echo base_url('code/delete_code'); ?>?id=<?php echo $list_codes['id_code'][$i]; ?>"><i class="bx bx-edit-alt me-1"></i> Delete</a>
                              <a class="dropdown-item" href="<?php echo base_url('code/update_code'); ?>?id=<?php echo $list_codes['id_code'][$i]; ?>"><i class="bx bx-trash me-1"></i> Edit</a>
                            </div>
                          </div>
                        </td>
                      </tr>  
                      <?php } ?>   
                    </tbody>
                  </table>
                 </div>    
        </div>
    </div>
        <?php 
$this->load->view('admin/layouts/footer');
?>