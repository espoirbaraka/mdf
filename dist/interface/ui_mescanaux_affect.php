<div id="main-content">
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Mes Affectations</h2>
                    
                </div>
                
            </div>
        </div>

        <div class="row g-2">
            <?php
            $id = $_SESSION['CodeUser'];
            $mesprojet = "SELECT * FROM  tbl_projet 
            INNER JOIN tbl_etape ON tbl_projet.id_projet = tbl_etape.code_projet
            INNER JOIN tbl_affectation ON tbl_etape.id_etape = tbl_affectation.code_etape
            INNER JOIN tbl_user ON tbl_affectation.code_user = tbl_user.id_user 
            WHERE tbl_affectation.statut_affectation = 1 AND tbl_affectation.code_user = $id";
            //if($req=$app->fetch($mesprojet)){
                if($nbre = $app->rowCount($mesprojet) >= 1){
                    foreach($req=$app->fetchPrepared($mesprojet) as $row){
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body text-start pro-img">
                                    <img class="d-block img-fluid mb-3 mx-auto" src="assets/images/projet.jpg" alt="">
                                    <h6 class="project-title text-primary mb-3"><a href="profileprojet.php?id=<?php echo $row['id_projet']; ?>"><?php echo $row['titre']; ?></a></h6>
                                    <!-- <p><strong>Lorem Ipsum is</strong> simply dummy text of the printing and typesetting industry.</p> -->
                                    
                                    <div class="progress mb-3" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="align-items-center d-flex">
                                        <h6 class="mb-0 me-2">Team:</h6>
                                        <ul class="list-unstyled team-info mb-0 d-flex">
                                        <?php
                                                        $id = $row['id_projet'];
                                                        $sql="SELECT * FROM tbl_privilege INNER JOIN tbl_projet 
                                                        ON tbl_privilege.code_projet = tbl_projet.id_projet
                                                        INNER JOIN tbl_etape ON tbl_projet.id_projet = tbl_etape.code_projet
                                                        INNER JOIN tbl_affectation ON tbl_etape.id_etape = tbl_affectation.code_etape
                                                        INNER JOIN tbl_user ON tbl_affectation.code_user = tbl_user.id_user
                                                        INNER JOIN tbl_agent ON tbl_user.code_agent = tbl_agent.id_agent 
                                                        WHERE tbl_projet.id_projet=$id AND tbl_affectation.statut_affectation = 1";
                                                        $telephone=$app->fetchPrepared($sql);
                                                        foreach($telephone as $row2)
                                                        { 
                                                            ?>
                                                            <li><img src="./fichier/<?php echo $row2['photo'];?>" style="width: 30px; height: 30px;" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $row2['nom_agent'].' '.$row2['postnom_agent'];?>" alt="Avatar"></li>
                                                            <?php
                                                        }
                                                        ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                    }
                }else{
                    ?>
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                        <i class='fa fa-times-circle'></i> Vous n'etez pas affecté dans aucun projet
                    </div>
                    <?php
                }
                
            //}
            
            ?>
            

            
        </div>

    </div>
</div>