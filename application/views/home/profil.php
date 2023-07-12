<?php require 'layouts/header.php'; ?> 
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Profil</h4>

              <div class="row">
                <div class="col-md-12">
                 
                  <div class="card mb-4">
                    <h5 class="card-header">Details du profil</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <i class='bx bxs-user-circle' style='color:#5f61e6; font-size: 70px'></i>
                        <div class="button-wrapper">
                          <form action="<?= base_url('/user/wallet') ?>" >
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="bx bx-wallet"></i>&nbsp; Faire un depot
                            </button>
                        </form>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form action="<?= base_url('user/update_profil')?>" id="formAccountSettings" method="POST" >
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Nom</label>
                            <input
                              class="form-control"
                              type="text"
                              id="nom"
                              name="nom"
                              value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''?>"
                              autofocus
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''?>"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Genre</label>
                            <input
                              readonly = ""
                              type="text"
                              class="form-control"
                              id="genre"
                              name="genre"
                              value="<?php echo isset($_SESSION['genre']) ? $_SESSION['genre'] : ''?>"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="state" class="form-label">Solde de votre compte</label>
                            <input 
                              readonly = "" 
                              class="form-control" type="text"
                              value="<?php echo isset($_SESSION['wallet']) ? $_SESSION['wallet'].' Ar' : ''?>" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Taille</label>
                            <div class="input-group input-group-merge">
                              <input
                                type="text"
                                id="taille"
                                name="taille"
                                class="form-control"
                                value="<?php echo isset($_SESSION['taille']) ? $_SESSION['taille'] : ''?>"
                              />
                            </div>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Poids</label>
                            <input type="text" class="form-control" id="poids" name="poids" value="<?php echo isset($_SESSION['poids']) ? $_SESSION['poids'] : ''?>" />
                          </div>
                          
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
                          <a type="reset" href="<?php echo base_url('/')?>" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        
<?php require 'layouts/footer.php'; ?>