<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Liste des projets</h2>
                            
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

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="project_list" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Project</th>
                                            <th>Deadline</th>
                                            <th>Prograss</th>
                                            <th>Lead</th>
                                            <th>Team</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        $sql='SELECT * FROM tbl_etape 
                                        INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                                        INNER JOIN tbl_projet ON tbl_etape.code_projet = tbl_projet.id_projet
                                        WHERE tbl_projet.validation = 1 and tbl_etape.statut_projet = 1 and (tbl_projet.statut_reussite = 0 or  tbl_projet.statut_reussite =1 or tbl_projet.statut_reussite = 3)';
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            $deadline = $row['deadline'];
                                            $createdate = $row['dateAdd'];
                                            $newDate1 = date("d/m/Y", strtotime($deadline));
                                            $newDate2 = date("d/m/Y", strtotime($createdate));
                                            $code2 = $row['statut_reussite'];
                                            $projet = $row['id_projet'];
                                            ?>

                                        <tr>
                                            <td>
                                                <img src="assets/images/projet.jpg"
                                                        class="rounded-circle avatar" alt="">
                                            </td>
                                            <td class="project-title">
                                                <h6 class="fs-6 mb-0"><?php echo $row['titre'];?></h6>
                                                <small>Crée le <?php echo $newDate2;?></small>
                                            </td>
                                            <td><?php echo $newDate1;?></td>
                                            <td>
                                                <div class="progress" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100" style="width: 18%;">
                                                    </div>
                                                </div>
                                                <small>Completion with:18%</small>
                                            </td>
                                            <td>
                                            <?php
                                                $sql3 = "SELECT * FROM tbl_privilege
                                                        INNER JOIN tbl_user
                                                        ON tbl_privilege.code_user=tbl_user.id_user
                                                        INNER join tbl_agent
                                                        ON tbl_user.code_agent=tbl_agent.id_agent
                                                        WHERE code_projet=$id AND statutPrivilege=1";
                                                $projectmanager=$app->fetch($sql3);
                                            
                                            //foreach($projectmanager as $row){
                                            ?>
                                                <img class="avatar rounded" src="<?php echo (!empty($projectmanager['photo'])) ? 'fichier/'.$projectmanager['photo'] : 'fichier/user.png'; ?>" data-bs-toggle="tooltip" data-bs-placement="left" title="Team Lead" alt="Avatar" style="width: 30px; height: 30px;">
                                            <?php
                                            ?>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled team-info mb-0 d-flex">
                                                    <?php
                                                    $id = $row['id_projet'];
                                                    $sql="SELECT * FROM tbl_privilege INNER JOIN tbl_projet 
                                                    ON tbl_privilege.code_projet = tbl_projet.id_projet
                                                    INNER JOIN tbl_etape ON tbl_projet.id_projet = tbl_etape.code_projet
                                                    INNER JOIN tbl_affectation ON tbl_etape.id_etape = tbl_affectation.code_etape
                                                    INNER JOIN tbl_user ON tbl_affectation.code_user = tbl_user.id_user
                                                    INNER JOIN tbl_agent ON tbl_user.code_agent = tbl_agent.id_agent 
                                                    WHERE tbl_projet.id_projet=$projet AND tbl_affectation.statut_affectation = 1";
                                                    $telephone=$app->fetchPrepared($sql);
                                                    foreach($telephone as $row2){
                                                        ?>
                                                        <li><img src="<?php echo (!empty($row2['photo'])) ? 'fichier/'.$row2['photo'] : 'fichier/user.png'; ?>" style="width: 30px; height: 30px;" alt="avatar"></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </td>
                                            
                                            <?php 
                                                if($code2 == 0)
                                                {
                                                ?>
                                                    <td><span class="badge bg-success">En cours</span></td>
                                                    <td class="project-actions">
                                                        <a data-id="<?php echo $row['id_etape'] ?>"  class="btn btn-sm delete btn-outline-secondary"><i class="fa fa-users"></i></a>
                                                        <a data-id="<?php echo $row['id_etape'] ?>"  class="btn btn-sm btn-outline-success"><i class="fa fa-pencil"></i></a>
                                                    </td>
                                                <?php
                                                $id_ = $row['designation_phase'];
                                                }elseif($code2 == 1){
                                                ?>
                                                    <td><span class="badge bg-warning"><?php echo $id_ ?></span></td>
                                                    <td class="project-actions">
                                                        <a data-id="<?php echo $row['id_etape'] ?>"  class="btn btn-sm delete btn-outline-secondary"><i class="fa fa-users"></i></a>
                                                        <a data-id="<?php echo $row['id_etape'] ?>"  class="btn btn-sm btn-outline-success"><i class="fa fa-pencil"></i></a>
                                                    </td>
                                                    <?php
                                                }elseif($code2 == 3){
                                                    ?>
                                                <td><span class="badge bg-danger">Achevé</span></td>
                                                <td class="project-actions">
                                                    <a href="profileprojet.php?id=<?php echo $row['id_projet']; ?>" class="btn btn-sm btn-outline-success"><i class="fa fa-eye"></i></a>
                                                </td>
                                                    <?php
                                                }
                                            ?>
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

            </div>
        </div>