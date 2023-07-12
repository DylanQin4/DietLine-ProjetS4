

<?php 
    $this->load->view('admin/layouts/header');
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column justify-conten-between align-items-baseline">
        <div class="card w-100 p-4">
        <h5 class="card-header">Liste Sport</h5>
            <table class="table">
                    <thead>
                    <tr>
                        <th>numero</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($data as $datas) { ?>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $datas['id']; ?></strong></td>
                        <td><?php echo $datas['nom']; ?></td>
                        <td><?php echo $datas['type']; ?></td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="<?php echo base_url('Sport/delete'); ?>?id=<?php echo $datas['id']; ?>"><i class="bx bx-edit-alt me-1"></i> Delete</a>
                              <a class="dropdown-item" href="<?php echo base_url('Sport/update'); ?>?id=<?php echo $datas['id']; ?>"><i class="bx bx-trash me-1"></i> Edit</a>
                            </div>
                          </div>
                        </td>
                      </tr>  
                      <?php } ?>   
                    </tbody>
                  </table>
                  <br>
                  <div class="row justify-content-end">
                    <div class="col-sm-12">
                        <a href="<?php echo base_url('Sport/Ajout_Sport'); ?>"><button type="submit" class="btn btn-primary">Ajout sport</button></a>
                        
                    </div>
                 </div> 
                 </div>       
        </div>
    </div>
        <?php 
$this->load->view('admin/layouts/footer');
?>