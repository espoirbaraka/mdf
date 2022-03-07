<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="m-0 fs-5"><a href="home.php" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Dashboard <?php if($_SESSION['statut']==1){ echo "staff"; }else{echo "partenaire";} ?></h2>
                            
                        </div>
                        <?php
                                if(isset($_SESSION['success'])){
                                echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    <i class='fa fa-check-circle'></i> ".$_SESSION['success']."
                                </div>
                                ";
                                unset($_SESSION['success']);
                                }
                                if(isset($_SESSION['error'])){
                                echo "
                                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                        <i class='fa fa-times-circle'></i> ".$_SESSION['error']."
                                    </div>
                                ";
                                unset($_SESSION['error']);
                                }
                            ?>
                    </div>
                </div>

                <div class="row g-2 clearfix row-deck">
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="card top_counter">
                            <div class="list-group list-group-custom list-group-flush">
                                <div class="list-group-item d-flex align-items-center py-3">
                                    <div class="icon text-center me-3"><i class="fa fa-user"></i> </div>
                                    <?php
                                        $requette='SELECT COUNT(id_agent) as nbre FROM tbl_agent';
                                        $agent= $app->fetch($requette);
                                    ?>
                                    <div class="content">
                                        <div>Nos employes</div>
                                        <h5 class="mb-0"><?php echo $agent['nbre'];?></h5>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center py-3">
                                    <div class="icon text-center me-3"><i class="fa fa-users"></i> </div>
                                    <?php
                                        $requette='SELECT COUNT(id_partenaire) as nbre FROM tbl_partenaire';
                                        $partenaire= $app->fetch($requette);
                                    ?>
                                    <div class="content">
                                        <div>Nos partenaires</div>
                                        <h5 class="mb-0"><?php echo $partenaire['nbre']; ?></h5>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center py-3">
                                    <div class="icon text-center me-3"><i class="fa fa-university"></i> </div>
                                    <div class="content">
                                    <?php
                                        $requette='SELECT COUNT(id_projet) as nbre FROM tbl_projet';
                                        $projet= $app->fetch($requette);
                                    ?>
                                        <div>Nos projets</div>
                                        <h5 class="mb-0"><?php echo $projet['nbre']; ?></h5>
                                    </div>
                                </div>
                                <div class="list-group-item d-flex align-items-center py-3">
                                    <div class="icon text-center me-3"><i class="fa fa-share-alt-square"></i> </div>
                                    <div class="content">
                                    <?php
                                        $requette='SELECT COUNT(DISTINCT(id_affectation)) as nbre FROM tbl_affectation WHERE statut_affectation = 1';
                                        $agent_terrain= $app->fetch($requette);
                                    ?>
                                        <div>Nos agents sur terrain</div>
                                        <h5 class="mb-0"><?php echo $agent_terrain['nbre'];?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                    <?php
                        //les canal
                         $requette='SELECT COUNT(id_projet) as nbre from tbl_projet WHERE validation =0';
                         $requette1='SELECT COUNT(id_projet) as nbre from tbl_projet WHERE validation =1';
                        $pasvalide= $app->fetch($requette);
                        $valide= $app->fetch($requette1);
                    ?>
                        
                        <div class="card text-center">
                            <div class="card-body">
                                <h5>Les canals</h5>
                                <span class="text-muted">Déjà validé</span>
                                <div id="sparkline-pie" class="mt-3 d-flex justify-content-center"></div>
                                <div class="stats-report">
                                    <div class="stat-item d-inline-block px-2 mt-4">
                                        <h5 class="mb-0 fw-normal fs-6">Pas validé</h5>
                                        <strong><?php echo $pasvalide['nbre'];?></strong>
                                    </div>
                                    <div class="stat-item d-inline-block px-2 mt-4">
                                        <h5 class="mb-0 fw-normal fs-6">Valide</h5>
                                        <strong><?php echo $valide['nbre'];?></strong>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <h6 class="card-title">Statistique de nos 10 derniers projets</h6>
                                
                            </div>
                            <div class="card-body">
                                <div id="Salary_Statistics"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-8 col-lg-7 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title">Quelques employees sans mission</h6>
                            </div>
                          
                            <div class="card-body">
                             
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>Avatar</th>
                                                <th>Nom</th>
                                                <th>Fonction</th>
                                                <th>Statut</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 
                                                //tous les agents non affecte
                                                $request=' SELECT  DISTINCT(email_agent),tbl_user.photo, `nom_agent`, `postnom_agent`, `prenom_agent`,`id_agent`, designation_fonction FROM tbl_affectation
                                                INNER JOIN tbl_user ON tbl_user.id_user = tbl_affectation.code_user
                                                INNER JOIN tbl_agent ON tbl_agent.id_agent =tbl_user.code_agent
                                                INNER JOIN tbl_etape ON tbl_etape.id_etape = tbl_affectation.code_etape
                                                INNER JOIN tbl_fonction ON tbl_fonction.id_fonction = tbl_agent.code_fonction
        
                                                WHERE (statut_affectation = 1) AND (statutAgent = "EDIT_AGENT" or statutAgent = "CREATE_AGENT")';
                                                $agentlibre=$app->fetchPrepared($request);
                                                foreach($agentlibre as $row)
                                                {
                                        
                                            ?>
                                            <tr>
                                                <td>
                                                    <img src="<?php echo (!empty($row['photo'])) ? 'fichier/'.$row['photo'] : 'fichier/user.png'; ?>"
                                                        class="rounded-circle avatar" alt="">
                                                </td>
                                                <td><?php echo $row['nom_agent'].' '.$row['postnom_agent'].' '.$row['prenom_agent'];?></td>
                                                <td><?php echo $row['designation_fonction']; ?></td>
                                                <td><span class="badge bg-warning">Disponible</span></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-12">
                    <?php
                        //nombre des agents masculin
                        $requette="SELECT COUNT(id_agent) as nbre FROM tbl_agent WHERE sexe_agent='Masculin'";
                         $sexe_agent= $app->query_exec($requette);
                         
                     ?>

                    <?php
                        //nombre des agents feminin
                        $requette="SELECT COUNT(id_agent) as nbre FROM tbl_agent WHERE sexe_agent='Féminin'";
                         $sexe_agentF= $app->query_exec($requette);
                         
                     ?>
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title">Structure des employees</h6>
                            </div>
                            <div class="card-body text-center">
                                <div id="apex-TotalStudent"></div>
                                <div class="mb-3 mt-4">
                                    <?php foreach($sexe_agent as $row):?>
                                    <span class="text-muted small">Male</span>
                                    <h4 class="mb-0"><?= $row->nbre;?></h4>
                                    <?php endforeach; ?>
                                </div>
                                <div>
                                    <?php foreach($sexe_agentF as $ro):?>
                                    <span class="text-muted small">Female</span>
                                    <h4 class="mb-0"><?= $ro->nbre; ?></h4>
                                    <?php endforeach;?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>
