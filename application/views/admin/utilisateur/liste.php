

<?php 
    $this->load->view('admin/layouts/header');
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column justify-conten-between align-items-baseline">
        <div class="card w-100 p-4">
        <h5 class="card-header">Liste Utilisateur</h5>
            <table class="table">
                    <thead>
                    <tr>
                        <th>numero</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>taille</th>
                        <th>Poids</th>
                        <th>Argent</th>
                        <th>Genre</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($data as $datas) { ?>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $datas['id_users']; ?></strong></td>
                        <td><?php echo $datas['username']; ?></td>
                        <td><?php echo $datas['email']; ?></td>
                        <td><?php echo $datas['taille']; ?></td>
                        <td><?php echo $datas['poids']; ?></td>
                        <td><?php echo $datas['wallet']; ?></td>
                        <td><?php echo $datas['genre']; ?></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="<?php echo base_url('User/delete_user'); ?>?id=<?php echo $datas['id_users']; ?>"><i class="bx bx-edit-alt me-1"></i> Delete</a>
                              <a class="dropdown-item" href="<?php echo base_url('User/updateUser'); ?>?id=<?php echo $datas['id_users']; ?>"><i class="bx bx-trash me-1"></i> Edit</a>
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