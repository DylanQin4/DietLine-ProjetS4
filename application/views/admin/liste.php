<?php 
require 'layouts/header.php'
?>

        <table class="table">
        <thead>
            <tr>
                <th>numero</th>
                <th>Nom</th>
                <th>ingredients</th>
                <th>prix</th>
                <th>type_plat</th>
                <th>type_regime</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $datas) { ?>
            <tr>
                        <td><?php echo $datas['id_plat']; ?></td>
                        <td><?php echo $datas['nom']; ?></td>
                        <td><?php echo $datas['ingredients']; ?></td>
                        <td><?php echo $datas['prix']; ?></td>
                        <td><?php echo $datas['type_plat']; ?></td>
                        <td><?php echo $datas['type_regime']; ?></td>
                        <td><a href="<?php echo base_url('Aliment/delete'); ?>?id=<?php echo $datas['id_plat']; ?>"><button class="btn btn-primary">supprimer</button></a></td>
                        <td><a href="<?php echo base_url('Aliment/update'); ?>?id=<?php echo $datas['id_plat']; ?>"><button class="btn btn-primary">update</button></a></td>
                   
            </tr>
            <?php } ?>
        </tbody>
        </table>
        <a href="<?php echo base_url('Aliment/Ajout_Aliment'); ?>"><button>AJout</button></a>
        
        <?php 
require 'layouts/footer.php'
?>