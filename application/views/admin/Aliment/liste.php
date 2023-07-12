<?php 
    $this->load->view('admin/layouts/header');
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column justify-conten-between align-items-baseline">
        <div class="card">
        <h5 class="card-header">Liste Utilisateur</h5>
            <table class="table">
                    <thead>
                    <tr>
                            <th>numero</th>
                            <th>Nom</th>
                            <th>ingredients</th>
                            <th>prix</th>
                            <th>type_regime</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($data as $datas) { ?>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $datas['id_plat']; ?></strong></td>
                        <td><?php echo $datas['nom']; ?></td>
                        <td><?php echo $datas['ingredients']; ?></td>
                        <td><?php echo $datas['prix']; ?></td>
                        <td><span class="badge bg-label-primary me-1"><td><?php echo $datas['type_regime']; ?></td></span></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="<?php echo base_url('Aliment/delete'); ?>?id=<?php echo $datas['id_plat']; ?>"><i class="bx bx-edit-alt me-1"></i> Delete</a>
                              <a class="dropdown-item" href="<?php echo base_url('Aliment/update'); ?>?id=<?php echo $datas['id_plat']; ?>"><i class="bx bx-trash me-1"></i> Edit</a>
                            </div>
                          </div>
                        </td>
                      </tr>  
                      <?php } ?>   
                    </tbody>
                  </table>
                  <div class="row justify-content-end">
                    <div class="col-sm-12">
                        <a href="<?php echo base_url('Aliment/Ajout_Aliment'); ?>"><button type="submit" class="btn btn-primary">Ajout Régime</button></a>
                        
                    </div>
                 </div>    
            </div>
        </div>
    </div>
        <?php 
$this->load->view('admin/layouts/footer');
?>