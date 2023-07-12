<?php 
    $this->load->view('admin/layouts/header');
?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column justify-conten-between align-items-baseline">
        <div class = "card w-100 p-4">
                      <h5 class="mb-0">Ajout Aliment</h5>
                      <small class="text-muted float-end"></small>
                    
                    <div class="card-body">
                    <form class="form-contact comment_form" method="POST" action="<?php echo base_url('Sport/traitement_ajout') ?>" id="commentForm">
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name">Nom</label>
                          <div class="col-sm-10">
                            <input type="text" name="nom" class="form-control" id="basic-default-name" placeholder="Nom">
                          </div>
                        </div>
                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Type Regime</label>
                            <div class="col-sm-10">
                                <select  name="type" id="defaultSelect" class="form-select">
                                <?php foreach ($data as $datas) { ?>
                                    <option  value="<?php echo $datas['id']; ?>"><?php echo $datas['type']; ?></option>
                                <?php } ?> 
                                </select>
                            </div>
                        </div>
                        
                        </div>
                        <div class="row justify-content-left">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
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