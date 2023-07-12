
<?php 
    $this->load->view('admin/layouts/header');
?>
 <div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column justify-conten-between align-items-baseline">
        <div class = "card w-100 p-4">
                      <h5 class="mb-0">Updates Aliment</h5>
                      <small class="text-muted float-end"></small>
                    
                    <div class="card-body">
                    <form class="form-contact comment_form" method="POST" action="<?php echo site_url('User/traitement_update/?id='.$data[0]['id'] ); ?>" id="commentForm">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Nom</label>
                          <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" id="basic-default-name" value='<?php echo $data[0]['username']; ?>'>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-company">Email</label>
                          <div class="col-sm-10">
                            <input type="text" name="email" class="form-control" id="basic-default-company" value='<?php echo $data[0]['email']; ?>'>
                          </div>
                        </div>
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">Taille</label>
                          <div class="col-sm-10">
                            <input type="number" name="taille" id="basic-default-company" class="form-control" value='<?php echo $data[0]['taille']; ?>'>
                          </div>
                        </div>
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">Poids</label>
                          <div class="col-sm-10">
                            <input type="number" name="poids" id="basic-default-company" class="form-control" value='<?php echo $data[0]['poids']; ?>'>
                          </div>
                        </div>
                        </div>
                        <div class="row justify-content-left">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                </div>
        </div>
    </div>
                        <?php 
    $this->load->view('admin/layouts/footer');
?>