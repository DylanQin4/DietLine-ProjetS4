<h5 class="pb-1 mb-2">Mes regimes</h5>
<?php if ($regime_en_cours != null) { ?>
    <h6 class="mt-2 text-muted">En cours</h6>
    <?php foreach ($regime_en_cours as $regime) { ?>
        <div class="mb-1 d-flex w-100">
            <div class="card mb-3 w-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div>
                            De: <strong><?php echo $regime->date_debut ?></strong>
                        </div>
                        <div>
                            jusqu'a: <strong><?php echo $regime->date_fin ?></strong>
                        </div>
                    </div>
                    <div>
                        Objectif: <strong class="" style="font-size:18px"><?php echo $regime->poids_objectif ?>kg</strong>
                    </div>
                    <div>jours restant: <strong class="" style="font-size:18px"><?php 
                        $datetime1 = new DateTime();
                        $datetime2 = new DateTime($regime->date_fin);
                        $interval = $datetime1->diff($datetime2);
                        echo $interval->days ?>j</strong>
                    </div>
                    <!-- <div>poids perdu: <strong class="" style="font-size:18px">10kg</strong></div> -->
                    <div>
                        <a href="<?php echo base_url('regime/details/'.$regime->id) ?>">
                        <i class='ml-1 bx bxs-right-arrow-circle' style="color:#5f61e6; font-size: 36px" ></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>

<?php if ($regime_en_attente != null) { ?>
    <h6 class="mt-2 text-muted">En attente</h6>
    <?php foreach ($regime_en_attente as $regime) { ?>
        <div class="mb-1 d-flex w-100">
            <div class="card mb-3 w-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div>
                            De: <strong><?php echo $regime->date_debut ?></strong>
                        </div>
                        <div>
                            jusqu'a: <strong>...</strong>
                        </div>
                    </div>
                    <div>
                        Objectif: <strong class="" style="font-size:18px"><?php echo $regime->poids_objectif ?>kg</strong>
                    </div>
                    <div>jours restant: <strong class="" style="font-size:18px">0j</strong>
                    </div>
                    <!-- <div>poids perdu: <strong class="" style="font-size:18px">10kg</strong></div> -->
                    <div>
                        <a href="<?php echo base_url('regime/details/'.$regime->id) ?>">
                        <i class='ml-1 bx bxs-right-arrow-circle' style="color:#5f61e6; font-size: 36px" ></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
