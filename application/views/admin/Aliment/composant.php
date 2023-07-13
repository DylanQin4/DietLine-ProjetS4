<?php 
    $this->load->view('admin/layouts/header');
?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column justify-conten-between align-items-baseline">
        <div class="card">
        <h5 class="card-header">composant du plat</h5>
        <h5 class="text-center"><?php echo $data[0]['nom']; ?></h3>
            <table class="table">
                    <thead>
                    <tr>
                            <th>Type viande</th>
                            <th>Poucentage</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    <?php foreach ($data as $datas) { ?>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php echo $datas['type_viande']; ?></strong></td>
                        <td><?php echo $datas['poucentage']; ?></td>
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