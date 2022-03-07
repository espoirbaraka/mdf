<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_projet
        LEFT JOIN tbl_privilege
        ON tbl_projet.id_projet=tbl_privilege.code_projet
        LEFT JOIN tbl_user
        ON tbl_privilege.code_user=tbl_user.id_user
        LEFT JOIN tbl_agent
        ON tbl_user.code_agent=tbl_agent.id_agent
        WHERE id_projet=$id";
$projet = $app->fetch($sql);
$statut5 = $projet['statut_reussite'];
$code2 = $projet['id_projet'];
$privilege = $projet['id_user'];
$deadline = $projet['deadline'];
$createdate = $projet['dateAdd'];
$newDate1 = date("d/m/Y", strtotime($deadline));
$newDate2 = date("d/m/Y", strtotime($createdate));
$moi = $_SESSION['CodeUser'];
?>
<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Projet <?php echo $projet['titre']; ?></h2>
                            
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
                <?php 
                                        if($statut5 == 0){
                                            ?>
                <div class="row g-2">
                    <div class="col-lg-4 col-md-12">
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6 class="card-title mb-4">Objectif du projet</h6>
                                <?php
                                echo $projet['objectif'];
                                $sql7="SELECT * FROM tbl_etape 
                                    INNER JOIN tbl_phase
                                    ON tbl_etape.code_phase=tbl_phase.id_phase
                                    WHERE code_projet=$id AND statut_projet=1";
                                $phase = $app->fetch($sql7);
                                if($phase['code_phase']==1){
                                    ?>
                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Phase: PROPOSITION</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;">
                                                <span class="progress-value">33%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }elseif($phase['code_phase']==2)
                                {
                                    ?>
                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Phase: PREPARATION</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                                                <span class="progress-value">66%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php

                                }elseif($phase['code_phase']==3){
                                    ?>
                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Phase: EXECUTION</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                <span class="progress-value">100%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-body">
                                <ul class="list-unstyled basic-list mb-0">
                                    <li class="d-flex justify-content-between mb-3">Cout :<span class="badge bg-primary"><?php echo $projet['budget'] ?></span></li>
                                    <li class="d-flex justify-content-between mb-3">Creation:<span class="bg-success badge">le <?php echo $newDate2 ?></span></li>
                                    <li class="d-flex justify-content-between mb-3">Deadline:<span class="bg-info badge">le <?php echo $newDate1 ?></span></li>
                                    <li class="d-flex justify-content-between">Budget<span class="bg-info badge"><?php echo $projet['budget'] ?></span> </li>
                                    <hr>
                                            <span class="btn btn-success btn-sm fa fa-check continue" data-id="<?php  echo $_GET['id']; ?>"></span>
                                            <span class="btn btn-danger btn-sm fa fa-warning justification" data-id="<?php echo $_GET['id']; ?>"></span>
                                            
                                    
                                    
                                </ul>
                                <br>
                                
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                <h6 class="card-title">Participants</h6>
                            </div>
                            <div class="card-body">
                                <div class="w_user d-flex align-items-start">
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
                                    <img class="rounded-circle" style="height: 70px; width:70px;" src="<?php echo (!empty($projectmanager['photo'])) ? 'fichier/'.$projectmanager['photo'] : 'fichier/user.png'; ?>" width="72" alt="">
                                    <div class="wid-u-info ms-3">
                                        
                                            <h5 class="mb-0"><?php echo $projectmanager['nom_agent'].' '.$projectmanager['postnom_agent'].' '.$projectmanager['prenom_agent'] ?></h5>
                                            <span><?php echo $projectmanager['email'] ?></span>
                                            <p class="text-muted mb-0">Role: Project manager</p>
                                            <?php
                                            //}
                                            
                                        
                                        
                                        ?>
                                        
                                    </div>
                                </div>
                                <hr>
                                <?php
                                        
                                        $code = $_SESSION['CodeUser'];
                                        $id = $_GET['id'];
                                        $sql="SELECT * FROM tbl_phase";
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            ?>
                                <div class="card-header">
                                        <h6 class="card-title"><?php echo $row['designation_phase']?></h6>
                                </div>
                                <ul class="right_chat list-unstyled mb-0">
                                <?php
                                        $id_phase = $row['id_phase'];
                                        $code = $_SESSION['CodeUser'];
                                        $id = $_GET['id'];
                                        $sql="SELECT * FROM tbl_agent INNER JOIN tbl_user ON id_agent = tbl_user.code_agent
                                        INNER JOIN tbl_affectation ON tbl_user.id_user = tbl_affectation.code_user
                                        INNER JOIN tbl_etape ON tbl_affectation.code_etape = tbl_etape.id_etape
                                        INNER JOIN tbl_projet ON tbl_etape.code_projet=tbl_projet.id_projet
                                        INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                                        WHERE tbl_affectation.statut_affectation = 1  AND tbl_projet.id_projet = $id AND tbl_phase.id_phase = $id_phase";
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            $dateAdd = $row['dateAdd'];
                                            $debut = date("d/m/Y", strtotime($dateAdd));
                                            ?>
                                    <li class="offline">
                                        <a class="d-flex mb-3" href="javascript:void(0);">
                                            <img class="rounded-circle" src="<?php echo (!empty($row['photo'])) ? 'fichier/'.$row['photo'] : 'fichier/user.png'; ?>" width="45" height="45" alt="">
                                            <div class="ms-3 w-100 text-muted">
                                                <span class="name d-block"><?php echo $row['nom_agent'].' '.$row['postnom_agent'].' '.$row['prenom_agent'];?><small class="float-end"></small></span>
                                                <p class="text-muted mb-0">Role: Consultant</p>
                                                <p class="text-muted mb-0">Depuis le <?php echo $debut ?></p>
                                                <span class="status"></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                        }
                                        ?>
                                </ul>
                                <?php
                                        }
                                        ?>
                            </div>
                        </div>
                        <!-- <div class="card mb-2">
                            <div class="card-header">
                                <h6 class="card-title">About Clients</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="profile-image mb-3"> <img src="assets/images/user.png" class="rounded-circle" alt=""> </div>
                                <div>
                                    <h4><strong>Jessica</strong> Doe</h4>
                                    <span>Washington, d.c.</span>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary">Profile</button>
                                    <button class="btn btn-outline-secondary">Message</button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <?php
                        $code = $_SESSION['CodeUser'];
                        $id = $_GET['id'];
                        $sql="SELECT * FROM tbl_agent INNER JOIN tbl_user ON id_agent = tbl_user.code_agent
                        INNER JOIN tbl_affectation ON tbl_user.id_user = tbl_affectation.code_user
                        INNER JOIN tbl_etape ON tbl_affectation.code_etape = tbl_etape.id_etape
                        INNER JOIN tbl_projet ON tbl_etape.code_projet=tbl_projet.id_projet
                        INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                        WHERE tbl_affectation.statut_affectation = 1 AND tbl_projet.id_projet = $id AND tbl_affectation.code_user = $code";
                        $projet = $app->fetch($sql);
                        $affectation = $projet['id_affectation'];
                    ?>
                    <div class="col-lg-8 col-md-12">
                        <div class="card mb-2">
                            <form action="manager/create.php" method="POST" enctype="multipart/form-data">
                                <div class="card-header">
                                    <h6 class="card-title">Participer à cette etape</h6>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="event" value="RAPPORT">
                                    <input type="hidden" name="projetid" value="<?php echo $_GET['id'] ?>">
                                    <input type="hidden" name="affectation" value="<?php echo $affectation ?>">
                                    <div class="mb-3">
                                        <textarea rows="2" class="summernote" placeholder="Please type what you want..." name="text"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <input type="file" class="form-control" name="fichier">
                                    </div>
                                    <div>
                                        <button class="btn btn-warning"><i class="fa fa-paperclip text-light"></i></button>
                                        <button class="btn btn-warning"><i class="fa fa-camera text-light"></i></button>
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                    
                                 </div>
                            </form>
                        </div>
                        <?php
                        if($moi == $privilege){
                            ?>
                        <div class="card mb-2">
                            <div class="card-header">
                                <h6 class="card-title">Ajouter un participant interne</h6>
                            </div>
                            <form action="./manager/create.php" method="POST">
                                <div class="card-body">
                                    <div class="mb-3">
                                    <input type="hidden" name="projet" value="<?php echo $_GET['id']; ?>">
                                    <input type="hidden" name="event" value="AFFECTATION_AGENT">
                                    <input type="hidden" name="id_affectation" value="">
                                    <input type="hidden" name="eventAffectation" value="CREATE_AFFECTATION">
                                    <?php
                                    $id = $_GET['id'];
                                    $sql13 = "SELECT * from tbl_etape
                                                INNER JOIN tbl_projet
                                                ON tbl_etape.code_projet=tbl_projet.id_projet
                                                WHERE code_projet=$id AND statut_projet=1";
                                    $reponse4 = $app->fetch($sql13);
                                    ?>
                                        <input type="hidden" class="" name="etape" value="<?php echo $reponse4['id_etape'] ?>">
                                        <select class="form-control" name="user">
                                            <?php
                                            $listeagent = "SELECT * FROM tbl_user 
                                                            INNER JOIN tbl_agent 
                                                            ON tbl_user.code_agent=tbl_agent.id_agent";
                                            $reponse = $app->fetchPrepared($listeagent);
                                            foreach($reponse as $row)
                                            {
                                                ?>
                                                <option value="<?php echo $row['id_user'] ?>"><?php echo $row['nom_agent'].' '.$row['postnom_agent'].' '.$row['prenom_agent'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <button class="btn btn-success">Ajouter</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                <h6 class="card-title">Inviter un partenaire à rejoundre le canal</h6>
                            </div>
                            <form action="./manager/create.php" method="POST">
                                <div class="card-body">
                                    <div class="mb-3">
                                    <input type="hidden" name="projet" value="<?php echo $_GET['id']; ?>">
                                    <input type="hidden" name="event" value="AFFECTATION_PARTENAIRE">
                                    <input type="hidden" name="id_affectation" value="">
                                    <input type="hidden" name="eventAffectation" value="CREATE_AFFECTATION">
                                    <?php
                                    $id = $_GET['id'];
                                    $sql13 = "SELECT * from tbl_etape
                                                INNER JOIN tbl_projet
                                                ON tbl_etape.code_projet=tbl_projet.id_projet
                                                WHERE code_projet=$id AND statut_projet=1";
                                    $reponse4 = $app->fetch($sql13);
                                    ?>
                                    <input type="hidden" class="" name="etape" value="<?php echo $reponse4['id_etape'] ?>">
                                        <select class="form-control" name="partenaire" >
                                            
                                            
                                            <?php
                                            $listepartenaire = "SELECT * FROM tbl_user
                                                                INNER JOIN tbl_partenaire 
                                                                ON tbl_user.code_partenaire=tbl_partenaire.id_partenaire";
                                            $reponse = $app->fetchPrepared($listepartenaire);
                                            foreach($reponse as $row)
                                            {
                                                ?>
                                                <option value="<?php echo $row['id_user'] ?>"><?php echo $row['partenaire'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <button class="btn btn-secondary">Inviter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                            <?php
                        }
                        ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="timeline-item warning">
                                    <span class="date">Fichier envoyer par les Participants</span>
                                    <span class='btn btn-sm btn-outline-success addfile pull-right' data-id="<?php echo $_GET['id']; ?>"><i class='fa fa-plus'></i></span>
                                    <h6>Fichiers</h6>
                                    <?php 
                                    $code = $_SESSION['CodeUser'];
                                        $id = $_GET['id'];
                                        $sql="SELECT * FROM tbl_phase";
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            ?>
                                <div class="card-header">
                                        <h6 class="card-title"><?php echo $row['designation_phase']?></h6>
                                </div>
                                    <div class="msg">
                                        <!-- <ul class="list-unstyled team-info d-flex">
                                            <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title="Chris Fox" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar5.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar2.jpg" data-toggle="tooltip" data-placement="top" title="Folisise Chosielie" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                        </ul> -->
                                        <?php
                                        $code = $row['id_phase'];
                                        $sql6 = "SELECT * FROM tbl_rapport INNER JOIN tbl_affectation 
                                        ON tbl_rapport.code_affectation = tbl_affectation.id_affectation
                                        INNER JOIN tbl_etape ON tbl_affectation.code_etape = tbl_etape.id_etape
                                        INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                                        INNER JOIN tbl_projet ON tbl_etape.code_projet = tbl_projet.id_projet
                                        INNER JOIN tbl_user ON tbl_rapport.addBy = tbl_user.id_user
                                         WHERE tbl_projet.id_projet = $id AND tbl_phase.id_phase = $code";
                                        $fichier = $app->fetchPrepared($sql6);
                                        
                                        foreach($fichier as $file){
                                            $dateadd = $file['dateAdd'];
                                            $newDate = date("d/m/Y H:m", strtotime($dateadd));
                                            ?>
                                            <div class="top_counter d-flex">
                                                <div class="icon text-center"><i class="fa fa-file-word-o"></i> </div>
                                                <div class="content ms-3">
                                                    <p class="mb-1"><?php echo $file['username'] ?></p>
                                                    <span><?php echo $newDate; ?></span>
                                                </div>
                                                <div>
                                                    <a href="rapport_part.php?id=<?php echo $file['id_rapport']?>" style="float: right;"><span class='btn btn-sm btn-outline-primary pull-right'><i class='fa fa-book'></i> </span></a>
                                                    
                                                    
                                                </div> 
                                            </div>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        
                                        <!-- <div class="top_counter d-flex">
                                            <div class="icon text-center"><i class="fa fa-file-word-o"></i> </div>
                                            <div class="content ms-3">
                                                <p class="mb-1">iNext project documentation.doc</p>
                                                <span>Size: 2.3Mb</span>
                                            </div>
                                        </div> -->
                                    </div>
                                        <?php 
                                    } 
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        if($moi == $privilege){
                            ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="timeline-item warning">
                                    <span class="date">Download</span>
                                    <span class='btn btn-sm btn-outline-success addfile pull-right' data-id="<?php echo $_GET['id']; ?>"><i class='fa fa-plus'></i></span>
                                    <h6>Fichiers</h6>
                                    <div class="msg">
                                        <!-- <ul class="list-unstyled team-info d-flex">
                                            <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title="Chris Fox" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar5.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar2.jpg" data-toggle="tooltip" data-placement="top" title="Folisise Chosielie" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                        </ul> -->
                                        <?php
                                        $sql6 = "SELECT * FROM tbl_fichier WHERE code_projet=$id";
                                        $fichier = $app->fetchPrepared($sql6);
                                        foreach($fichier as $file){
                                            ?>
                                            <div class="top_counter d-flex">
                                                <div class="icon text-center"><i class="fa fa-file-word-o"></i> </div>
                                                <div class="content ms-3">
                                                    <p class="mb-1"><?php echo $file['detail_fichier']; ?></p>
                                                    <span>Size: 2.3Mb</span>
                                                </div>
                                                <a href="download.php?id=<?php echo $file['id_fichier'] ?>&event=DOWNLOAD_FILE" style="float: right;"><span class='btn btn-sm btn-outline-primary pull-right'><i class='fa fa-download'></i> </span></a>
                                            </div>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        
                                        <!-- <div class="top_counter d-flex">
                                            <div class="icon text-center"><i class="fa fa-file-word-o"></i> </div>
                                            <div class="content ms-3">
                                                <p class="mb-1">iNext project documentation.doc</p>
                                                <span>Size: 2.3Mb</span>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <?php
                        if($moi == $privilege){
                            ?>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <h6 class="card-title">Les demandes de participation</h6>
                                </div>
                                <div class="card-body">
                                <table id="employee_List" class="table table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>
                                                    <div class="form-check d-inline-flex mt-1">
                                                        <input class="form-check-input select-all" type="checkbox">
                                                    </div>
                                                </th>
                                                <th>Demande</th>
                                                <th>Projet</th>
                                                <th>Agent</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $code = $_SESSION['CodeUser'];
                                            $id = $_GET['id'];
                                            $sql="SELECT * FROM tbl_agent INNER JOIN tbl_user ON id_agent = tbl_user.code_agent
                                            INNER JOIN tbl_affectation ON tbl_user.id_user = tbl_affectation.code_user
                                            INNER JOIN tbl_etape ON tbl_affectation.code_etape = tbl_etape.id_etape
                                            INNER JOIN tbl_projet ON tbl_etape.code_projet=tbl_projet.id_projet
                                            INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                                            WHERE tbl_affectation.statut_affectation = 0 AND tbl_projet.addBy = $code AND tbl_projet.id_projet = $id";
                                            $agent=$app->fetchPrepared($sql);
                                            foreach($agent as $row)
                                            {
                                                ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check d-inline-flex mt-1">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0"><?php echo $row['designation_phase'];?></h6>
                                                    <span></span>
                                                </td>
                                                <td><span><?php echo $row['titre'];?></span></td>
                                                <td><?php echo $row['nom_agent'].' '.$row['postnom_agent'].' '.$row['prenom_agent'];?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary edit"
                                                        title="Edit" data-id="<?php echo $row['id_affectation'];?>"><i class="fa fa-check"></i></button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <?php
                        }
                        ?>
                        
                    </div>
                </div>
                                            <?php
                                        }elseif($statut5 == 1){
                                            
                                        ?>
                <div class="row g-2">
                    <div class="col-lg-4 col-md-12">
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6 class="card-title mb-4">Objectif du projet</h6>
                                <?php
                                echo $projet['objectif'];
                                $sql7="SELECT * FROM tbl_etape 
                                    INNER JOIN tbl_phase
                                    ON tbl_etape.code_phase=tbl_phase.id_phase
                                    WHERE code_projet=$id AND statut_projet=1";
                                $phase = $app->fetch($sql7);
                                if($phase['code_phase']==1){
                                    ?>
                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Phase: PROPOSITION</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;">
                                                <span class="progress-value">33%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }elseif($phase['code_phase']==2)
                                {
                                    ?>
                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Phase: PREPARATION</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                                                <span class="progress-value">66%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php

                                }elseif($phase['code_phase']==3){
                                    ?>
                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Phase: EXECUTION</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                <span class="progress-value">100%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-body">
                                <ul class="list-unstyled basic-list mb-0">
                                    <li class="d-flex justify-content-between mb-3">Cout :<span class="badge bg-primary"><?php echo $projet['budget'] ?></span></li>
                                    <li class="d-flex justify-content-between mb-3">Creation:<span class="bg-success badge">le <?php echo $newDate2 ?></span></li>
                                    <li class="d-flex justify-content-between mb-3">Deadline:<span class="bg-info badge">le <?php echo $newDate1 ?></span></li>
                                    <li class="d-flex justify-content-between">Budget<span class="bg-info badge"><?php echo $projet['budget'] ?></span> </li>
                                    <hr>
                                    <?php
                                            
                                            if($moi == $privilege){
                                                ?>
                                                <span class="btn btn-primary btn-sm fa fa-edit phase" data-id="<?php echo $_GET['id']; ?>"></span>
                                                <span class="btn btn-primary btn-sm fa fa-edit archive" data-id="<?php echo $_GET['id']; ?>"></span>
                                                <?php
                                            }

                                        
                                    ?>
                                    
                                    
                                </ul>
                                <br>
                                
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                <h6 class="card-title">Participants</h6>
                            </div>
                            <div class="card-body">
                                <div class="w_user d-flex align-items-start">
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
                                    <img class="rounded-circle" style="height: 70px; width:70px;" src="<?php echo (!empty($projectmanager['photo'])) ? 'fichier/'.$projectmanager['photo'] : 'fichier/user.png'; ?>" width="72" alt="">
                                    <div class="wid-u-info ms-3">
                                        
                                            <h5 class="mb-0"><?php echo $projectmanager['nom_agent'].' '.$projectmanager['postnom_agent'].' '.$projectmanager['prenom_agent'] ?></h5>
                                            <span><?php echo $projectmanager['email'] ?></span>
                                            <p class="text-muted mb-0">Role: Project manager</p>
                                            <?php
                                            //}
                                            
                                        
                                        
                                        ?>
                                        
                                    </div>
                                </div>
                                <hr>
                                <?php
                                        
                                        $code = $_SESSION['CodeUser'];
                                        $id = $_GET['id'];
                                        $sql="SELECT * FROM tbl_phase";
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            ?>
                                <div class="card-header">
                                        <h6 class="card-title"><?php echo $row['designation_phase']?></h6>
                                </div>
                                <ul class="right_chat list-unstyled mb-0">
                                <?php
                                        $id_phase = $row['id_phase'];
                                        $code = $_SESSION['CodeUser'];
                                        $id = $_GET['id'];
                                        $sql="SELECT * FROM tbl_agent INNER JOIN tbl_user ON id_agent = tbl_user.code_agent
                                        INNER JOIN tbl_affectation ON tbl_user.id_user = tbl_affectation.code_user
                                        INNER JOIN tbl_etape ON tbl_affectation.code_etape = tbl_etape.id_etape
                                        INNER JOIN tbl_projet ON tbl_etape.code_projet=tbl_projet.id_projet
                                        INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                                        WHERE tbl_affectation.statut_affectation = 1  AND tbl_projet.id_projet = $id AND tbl_phase.id_phase = $id_phase";
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            $dateAdd = $row['dateAdd'];
                                            $debut = date("d/m/Y", strtotime($dateAdd));
                                            ?>
                                    <li class="offline">
                                        <a class="d-flex mb-3" href="javascript:void(0);">
                                            <img class="rounded-circle" src="<?php echo (!empty($row['photo'])) ? 'fichier/'.$row['photo'] : 'fichier/user.png'; ?>" width="45" height="45" alt="">
                                            <div class="ms-3 w-100 text-muted">
                                                <span class="name d-block"><?php echo $row['nom_agent'].' '.$row['postnom_agent'].' '.$row['prenom_agent'];?><small class="float-end"></small></span>
                                                <p class="text-muted mb-0">Role: Consultant</p>
                                                <p class="text-muted mb-0">Depuis le <?php echo $debut ?></p>
                                                <span class="status"></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                        }
                                        ?>
                                </ul>
                                <?php
                                        }
                                        ?>
                            </div>
                        </div>
                        <!-- <div class="card mb-2">
                            <div class="card-header">
                                <h6 class="card-title">About Clients</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="profile-image mb-3"> <img src="assets/images/user.png" class="rounded-circle" alt=""> </div>
                                <div>
                                    <h4><strong>Jessica</strong> Doe</h4>
                                    <span>Washington, d.c.</span>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary">Profile</button>
                                    <button class="btn btn-outline-secondary">Message</button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <?php
                        $code = $_SESSION['CodeUser'];
                        $id = $_GET['id'];
                        $sql="SELECT * FROM tbl_agent INNER JOIN tbl_user ON id_agent = tbl_user.code_agent
                        INNER JOIN tbl_affectation ON tbl_user.id_user = tbl_affectation.code_user
                        INNER JOIN tbl_etape ON tbl_affectation.code_etape = tbl_etape.id_etape
                        INNER JOIN tbl_projet ON tbl_etape.code_projet=tbl_projet.id_projet
                        INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                        WHERE tbl_affectation.statut_affectation = 1 AND tbl_projet.id_projet = $id AND tbl_affectation.code_user = $code";
                        $projet = $app->fetch($sql);
                        $affectation = $projet['id_affectation'];
                    ?>
                    <div class="col-lg-8 col-md-12">
                        <div class="card mb-2">
                            <form action="manager/create.php" method="POST" enctype="multipart/form-data">
                                <div class="card-header">
                                    <h6 class="card-title">Participer à cette etape</h6>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="event" value="RAPPORT">
                                    <input type="hidden" name="projetid" value="<?php echo $_GET['id'] ?>">
                                    <input type="hidden" name="affectation" value="<?php echo $affectation ?>">
                                    <div class="mb-3">
                                        <textarea rows="2" class="summernote" placeholder="Please type what you want..." name="text"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <input type="file" class="form-control" name="fichier">
                                    </div>
                                    <div>
                                        <button class="btn btn-warning"><i class="fa fa-paperclip text-light"></i></button>
                                        <button class="btn btn-warning"><i class="fa fa-camera text-light"></i></button>
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                    
                                 </div>
                            </form>
                        </div>
                        <?php
                        if($moi == $privilege){
                            ?>
                        <div class="card mb-2">
                            <div class="card-header">
                                <h6 class="card-title">Ajouter un participant interne</h6>
                            </div>
                            <form action="./manager/create.php" method="POST">
                                <div class="card-body">
                                    <div class="mb-3">
                                    <input type="hidden" name="projet" value="<?php echo $_GET['id']; ?>">
                                    <input type="hidden" name="event" value="AFFECTATION_AGENT">
                                    <input type="hidden" name="id_affectation" value="">
                                    <input type="hidden" name="eventAffectation" value="CREATE_AFFECTATION">
                                    <?php
                                    $id = $_GET['id'];
                                    $sql13 = "SELECT * from tbl_etape
                                                INNER JOIN tbl_projet
                                                ON tbl_etape.code_projet=tbl_projet.id_projet
                                                WHERE code_projet=$id AND statut_projet=1";
                                    $reponse4 = $app->fetch($sql13);
                                    ?>
                                        <input type="hidden" class="" name="etape" value="<?php echo $reponse4['id_etape'] ?>">
                                        <select class="form-control" name="user">
                                            <?php
                                            $listeagent = "SELECT * FROM tbl_user 
                                                            INNER JOIN tbl_agent 
                                                            ON tbl_user.code_agent=tbl_agent.id_agent";
                                            $reponse = $app->fetchPrepared($listeagent);
                                            foreach($reponse as $row)
                                            {
                                                ?>
                                                <option value="<?php echo $row['id_user'] ?>"><?php echo $row['nom_agent'].' '.$row['postnom_agent'].' '.$row['prenom_agent'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <button class="btn btn-success">Ajouter</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                <h6 class="card-title">Inviter un partenaire à rejoundre le canal</h6>
                            </div>
                            <form action="./manager/create.php" method="POST">
                                <div class="card-body">
                                    <div class="mb-3">
                                    <input type="hidden" name="projet" value="<?php echo $_GET['id']; ?>">
                                    <input type="hidden" name="event" value="AFFECTATION_PARTENAIRE">
                                    <input type="hidden" name="id_affectation" value="">
                                    <input type="hidden" name="eventAffectation" value="CREATE_AFFECTATION">
                                    <?php
                                    $id = $_GET['id'];
                                    $sql13 = "SELECT * from tbl_etape
                                                INNER JOIN tbl_projet
                                                ON tbl_etape.code_projet=tbl_projet.id_projet
                                                WHERE code_projet=$id AND statut_projet=1";
                                    $reponse4 = $app->fetch($sql13);
                                    ?>
                                    <input type="hidden" class="" name="etape" value="<?php echo $reponse4['id_etape'] ?>">
                                        <select class="form-control" name="partenaire" >
                                            
                                            
                                            <?php
                                            $listepartenaire = "SELECT * FROM tbl_user
                                                                INNER JOIN tbl_partenaire 
                                                                ON tbl_user.code_partenaire=tbl_partenaire.id_partenaire";
                                            $reponse = $app->fetchPrepared($listepartenaire);
                                            foreach($reponse as $row)
                                            {
                                                ?>
                                                <option value="<?php echo $row['id_user'] ?>"><?php echo $row['partenaire'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <button class="btn btn-secondary">Inviter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                            <?php
                        }
                        ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="timeline-item warning">
                                    <span class="date">Fichier envoyer par les Participants</span>
                                    <span class='btn btn-sm btn-outline-success addfile pull-right' data-id="<?php echo $_GET['id']; ?>"><i class='fa fa-plus'></i></span>
                                    <h6>Fichiers</h6>
                                    <?php 
                                    $code = $_SESSION['CodeUser'];
                                        $id = $_GET['id'];
                                        $sql="SELECT * FROM tbl_phase";
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            ?>
                                <div class="card-header">
                                        <h6 class="card-title"><?php echo $row['designation_phase']?></h6>
                                </div>
                                    <div class="msg">
                                        <!-- <ul class="list-unstyled team-info d-flex">
                                            <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title="Chris Fox" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar5.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar2.jpg" data-toggle="tooltip" data-placement="top" title="Folisise Chosielie" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                        </ul> -->
                                        <?php
                                        $code = $row['id_phase'];
                                        $sql6 = "SELECT * FROM tbl_rapport INNER JOIN tbl_affectation 
                                        ON tbl_rapport.code_affectation = tbl_affectation.id_affectation
                                        INNER JOIN tbl_etape ON tbl_affectation.code_etape = tbl_etape.id_etape
                                        INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                                        INNER JOIN tbl_projet ON tbl_etape.code_projet = tbl_projet.id_projet
                                        INNER JOIN tbl_user ON tbl_rapport.addBy = tbl_user.id_user
                                         WHERE tbl_projet.id_projet = $id AND tbl_phase.id_phase = $code";
                                        $fichier = $app->fetchPrepared($sql6);
                                        
                                        foreach($fichier as $file){
                                            $dateadd = $file['dateAdd'];
                                            $newDate = date("d/m/Y H:m", strtotime($dateadd));
                                            ?>
                                            <div class="top_counter d-flex">
                                                <div class="icon text-center"><i class="fa fa-file-word-o"></i> </div>
                                                <div class="content ms-3">
                                                    <p class="mb-1"><?php echo $file['username'] ?></p>
                                                    <span><?php echo $newDate; ?></span>
                                                </div>
                                                <div>
                                                    <a href="rapport_part.php?id=<?php echo $file['id_rapport']?>" style="float: right;"><span class='btn btn-sm btn-outline-primary pull-right'><i class='fa fa-book'></i> </span></a>
                                                    
                                                    
                                                </div> 
                                            </div>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        
                                        <!-- <div class="top_counter d-flex">
                                            <div class="icon text-center"><i class="fa fa-file-word-o"></i> </div>
                                            <div class="content ms-3">
                                                <p class="mb-1">iNext project documentation.doc</p>
                                                <span>Size: 2.3Mb</span>
                                            </div>
                                        </div> -->
                                    </div>
                                        <?php 
                                    } 
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        if($moi == $privilege){
                            ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="timeline-item warning">
                                    <span class="date">Download</span>
                                    <span class='btn btn-sm btn-outline-success addfile pull-right' data-id="<?php echo $_GET['id']; ?>"><i class='fa fa-plus'></i></span>
                                    <h6>Fichiers</h6>
                                    <div class="msg">
                                        <!-- <ul class="list-unstyled team-info d-flex">
                                            <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title="Chris Fox" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar5.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar2.jpg" data-toggle="tooltip" data-placement="top" title="Folisise Chosielie" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                        </ul> -->
                                        <?php
                                        $sql6 = "SELECT * FROM tbl_fichier WHERE code_projet=$id";
                                        $fichier = $app->fetchPrepared($sql6);
                                        foreach($fichier as $file){
                                            ?>
                                            <div class="top_counter d-flex">
                                                <div class="icon text-center"><i class="fa fa-file-word-o"></i> </div>
                                                <div class="content ms-3">
                                                    <p class="mb-1"><?php echo $file['detail_fichier']; ?></p>
                                                    <span>Size: 2.3Mb</span>
                                                </div>
                                                <a href="download.php?id=<?php echo $file['id_fichier'] ?>&event=DOWNLOAD_FILE" style="float: right;"><span class='btn btn-sm btn-outline-primary pull-right'><i class='fa fa-download'></i> </span></a>
                                            </div>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        
                                        <!-- <div class="top_counter d-flex">
                                            <div class="icon text-center"><i class="fa fa-file-word-o"></i> </div>
                                            <div class="content ms-3">
                                                <p class="mb-1">iNext project documentation.doc</p>
                                                <span>Size: 2.3Mb</span>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <?php
                        if($moi == $privilege){
                            ?>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <h6 class="card-title">Les demandes de participation</h6>
                                </div>
                                <div class="card-body">
                                <table id="employee_List" class="table table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>
                                                    <div class="form-check d-inline-flex mt-1">
                                                        <input class="form-check-input select-all" type="checkbox">
                                                    </div>
                                                </th>
                                                <th>Demande</th>
                                                <th>Projet</th>
                                                <th>Agent</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $code = $_SESSION['CodeUser'];
                                            $id = $_GET['id'];
                                            $sql="SELECT * FROM tbl_agent INNER JOIN tbl_user ON id_agent = tbl_user.code_agent
                                            INNER JOIN tbl_affectation ON tbl_user.id_user = tbl_affectation.code_user
                                            INNER JOIN tbl_etape ON tbl_affectation.code_etape = tbl_etape.id_etape
                                            INNER JOIN tbl_projet ON tbl_etape.code_projet=tbl_projet.id_projet
                                            INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                                            WHERE tbl_affectation.statut_affectation = 0 AND tbl_projet.addBy = $code AND tbl_projet.id_projet = $id";
                                            $agent=$app->fetchPrepared($sql);
                                            foreach($agent as $row)
                                            {
                                                ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check d-inline-flex mt-1">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mb-0"><?php echo $row['designation_phase'];?></h6>
                                                    <span></span>
                                                </td>
                                                <td><span><?php echo $row['titre'];?></span></td>
                                                <td><?php echo $row['nom_agent'].' '.$row['postnom_agent'].' '.$row['prenom_agent'];?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary edit"
                                                        title="Edit" data-id="<?php echo $row['id_affectation'];?>"><i class="fa fa-check"></i></button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <?php
                        }
                        ?>
                        
                    </div>
                </div>
                                        <?php
                                        
                                        }elseif($statut5 == 2){
                                            ?>
                <div class="row g-2">
                    <div class="col-lg-4 col-md-12">
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6 class="card-title mb-4">Objectif du projet</h6>
                                <?php
                                echo $projet['objectif'];
                                $sql7="SELECT * FROM tbl_etape 
                                    INNER JOIN tbl_phase
                                    ON tbl_etape.code_phase=tbl_phase.id_phase
                                    WHERE code_projet=$id AND statut_projet=1";
                                $phase = $app->fetch($sql7);
                                if($phase['code_phase']==1){
                                    ?>
                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Phase: PROPOSITION</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;">
                                                <span class="progress-value">33%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }elseif($phase['code_phase']==2)
                                {
                                    ?>
                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Phase: PREPARATION</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                                                <span class="progress-value">66%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php

                                }elseif($phase['code_phase']==3){
                                    ?>
                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Phase: EXECUTION</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                <span class="progress-value">100%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-body">
                                <ul class="list-unstyled basic-list mb-0">
                                    <li class="d-flex justify-content-between mb-3">Cout :<span class="badge bg-primary"><?php echo $projet['budget'] ?></span></li>
                                    <li class="d-flex justify-content-between mb-3">Creation:<span class="bg-success badge">le <?php echo $newDate2 ?></span></li>
                                    <li class="d-flex justify-content-between mb-3">Deadline:<span class="bg-info badge">le <?php echo $newDate1 ?></span></li>
                                    <li class="d-flex justify-content-between">Budget<span class="bg-info badge"><?php echo $projet['budget'] ?></span> </li>
                                    <hr>
                                    
                                    
                                </ul>
                                <br>
                                
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                <h6 class="card-title">Participants</h6>
                            </div>
                            <div class="card-body">
                                <div class="w_user d-flex align-items-start">
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
                                    <img class="rounded-circle" style="height: 70px; width:70px;" src="<?php echo (!empty($projectmanager['photo'])) ? 'fichier/'.$projectmanager['photo'] : 'fichier/user.png'; ?>" width="72" alt="">
                                    <div class="wid-u-info ms-3">
                                        
                                            <h5 class="mb-0"><?php echo $projectmanager['nom_agent'].' '.$projectmanager['postnom_agent'].' '.$projectmanager['prenom_agent'] ?></h5>
                                            <span><?php echo $projectmanager['email'] ?></span>
                                            <p class="text-muted mb-0">Role: Project manager</p>
                                            <?php
                                            //}
                                            
                                        
                                        
                                        ?>
                                        
                                    </div>
                                </div>
                                <hr>
                                <?php
                                        
                                        $code = $_SESSION['CodeUser'];
                                        $id = $_GET['id'];
                                        $sql="SELECT * FROM tbl_phase";
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            ?>
                                <div class="card-header">
                                        <h6 class="card-title"><?php echo $row['designation_phase']?></h6>
                                </div>
                                <ul class="right_chat list-unstyled mb-0">
                                <?php
                                        $id_phase = $row['id_phase'];
                                        $code = $_SESSION['CodeUser'];
                                        $id = $_GET['id'];
                                        $sql="SELECT * FROM tbl_agent INNER JOIN tbl_user ON id_agent = tbl_user.code_agent
                                        INNER JOIN tbl_affectation ON tbl_user.id_user = tbl_affectation.code_user
                                        INNER JOIN tbl_etape ON tbl_affectation.code_etape = tbl_etape.id_etape
                                        INNER JOIN tbl_projet ON tbl_etape.code_projet=tbl_projet.id_projet
                                        INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                                        WHERE tbl_affectation.statut_affectation = 1  AND tbl_projet.id_projet = $id AND tbl_phase.id_phase = $id_phase";
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            $dateAdd = $row['dateAdd'];
                                            $debut = date("d/m/Y", strtotime($dateAdd));
                                            ?>
                                    <li class="offline">
                                        <a class="d-flex mb-3" href="javascript:void(0);">
                                            <img class="rounded-circle" src="<?php echo (!empty($row['photo'])) ? 'fichier/'.$row['photo'] : 'fichier/user.png'; ?>" width="45" height="45" alt="">
                                            <div class="ms-3 w-100 text-muted">
                                                <span class="name d-block"><?php echo $row['nom_agent'].' '.$row['postnom_agent'].' '.$row['prenom_agent'];?><small class="float-end"></small></span>
                                                <p class="text-muted mb-0">Role: Consultant</p>
                                                <p class="text-muted mb-0">Depuis le <?php echo $debut ?></p>
                                                <span class="status"></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                        }
                                        ?>
                                </ul>
                                <?php
                                        }
                                        ?>
                            </div>
                        </div>
                        <!-- <div class="card mb-2">
                            <div class="card-header">
                                <h6 class="card-title">About Clients</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="profile-image mb-3"> <img src="assets/images/user.png" class="rounded-circle" alt=""> </div>
                                <div>
                                    <h4><strong>Jessica</strong> Doe</h4>
                                    <span>Washington, d.c.</span>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary">Profile</button>
                                    <button class="btn btn-outline-secondary">Message</button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                                            <?php
                                        }elseif($statut5 == 3){
                                            ?>
                <div class="row g-2">
                    <div class="col-lg-4 col-md-12">
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6 class="card-title mb-4">Objectif du projet</h6>
                                <?php
                                echo $projet['objectif'];
                                $sql7="SELECT * FROM tbl_etape 
                                    INNER JOIN tbl_phase
                                    ON tbl_etape.code_phase=tbl_phase.id_phase
                                    WHERE code_projet=$id AND statut_projet=1";
                                $phase = $app->fetch($sql7);
                                if($phase['code_phase']==1){
                                    ?>
                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Phase: PROPOSITION</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;">
                                                <span class="progress-value">33%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }elseif($phase['code_phase']==2)
                                {
                                    ?>
                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Phase: PREPARATION</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
                                                <span class="progress-value">66%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php

                                }elseif($phase['code_phase']==3){
                                    ?>
                                    <div class="progress-container progress-info">
                                        <span class="progress-badge">Phase: EXECUTION</span>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                <span class="progress-value">100%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-body">
                                <ul class="list-unstyled basic-list mb-0">
                                    <li class="d-flex justify-content-between mb-3">Cout :<span class="badge bg-primary"><?php echo $projet['budget'] ?></span></li>
                                    <li class="d-flex justify-content-between mb-3">Creation:<span class="bg-success badge">le <?php echo $newDate2 ?></span></li>
                                    <li class="d-flex justify-content-between mb-3">Deadline:<span class="bg-info badge">le <?php echo $newDate1 ?></span></li>
                                    <li class="d-flex justify-content-between">Budget<span class="bg-info badge"><?php echo $projet['budget'] ?></span> </li>
                                    <hr>
                                </ul>
                                <br>
                                
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header">
                                <h6 class="card-title">Participants</h6>
                            </div>
                            <div class="card-body">
                                <div class="w_user d-flex align-items-start">
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
                                    <img class="rounded-circle" style="height: 70px; width:70px;" src="<?php echo (!empty($projectmanager['photo'])) ? 'fichier/'.$projectmanager['photo'] : 'fichier/user.png'; ?>" width="72" alt="">
                                    <div class="wid-u-info ms-3">
                                        
                                            <h5 class="mb-0"><?php echo $projectmanager['nom_agent'].' '.$projectmanager['postnom_agent'].' '.$projectmanager['prenom_agent'] ?></h5>
                                            <span><?php echo $projectmanager['email'] ?></span>
                                            <p class="text-muted mb-0">Role: Project manager</p>
                                            <?php
                                            //}
                                            
                                        
                                        
                                        ?>
                                        
                                    </div>
                                </div>
                                <hr>
                                <?php
                                        
                                        $code = $_SESSION['CodeUser'];
                                        $id = $_GET['id'];
                                        $sql="SELECT * FROM tbl_phase";
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            ?>
                                <div class="card-header">
                                        <h6 class="card-title"><?php echo $row['designation_phase']?></h6>
                                </div>
                                <ul class="right_chat list-unstyled mb-0">
                                <?php
                                        $id_phase = $row['id_phase'];
                                        $code = $_SESSION['CodeUser'];
                                        $id = $_GET['id'];
                                        $sql="SELECT * FROM tbl_agent INNER JOIN tbl_user ON id_agent = tbl_user.code_agent
                                        INNER JOIN tbl_affectation ON tbl_user.id_user = tbl_affectation.code_user
                                        INNER JOIN tbl_etape ON tbl_affectation.code_etape = tbl_etape.id_etape
                                        INNER JOIN tbl_projet ON tbl_etape.code_projet=tbl_projet.id_projet
                                        INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                                        WHERE tbl_affectation.statut_affectation = 1  AND tbl_projet.id_projet = $id AND tbl_phase.id_phase = $id_phase";
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            $dateAdd = $row['dateAdd'];
                                            $debut = date("d/m/Y", strtotime($dateAdd));
                                            ?>
                                    <li class="offline">
                                        <a class="d-flex mb-3" href="javascript:void(0);">
                                            <img class="rounded-circle" src="<?php echo (!empty($row['photo'])) ? 'fichier/'.$row['photo'] : 'fichier/user.png'; ?>" width="45" height="45" alt="">
                                            <div class="ms-3 w-100 text-muted">
                                                <span class="name d-block"><?php echo $row['nom_agent'].' '.$row['postnom_agent'].' '.$row['prenom_agent'];?><small class="float-end"></small></span>
                                                <p class="text-muted mb-0">Role: Consultant</p>
                                                <p class="text-muted mb-0">Depuis le <?php echo $debut ?></p>
                                                <span class="status"></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                        }
                                        ?>
                                </ul>
                                <?php
                                        }
                                        ?>
                            </div>
                        </div>
                        <!-- <div class="card mb-2">
                            <div class="card-header">
                                <h6 class="card-title">About Clients</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="profile-image mb-3"> <img src="assets/images/user.png" class="rounded-circle" alt=""> </div>
                                <div>
                                    <h4><strong>Jessica</strong> Doe</h4>
                                    <span>Washington, d.c.</span>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary">Profile</button>
                                    <button class="btn btn-outline-secondary">Message</button>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <?php
                        $code = $_SESSION['CodeUser'];
                        $id = $_GET['id'];
                        $sql="SELECT * FROM tbl_agent INNER JOIN tbl_user ON id_agent = tbl_user.code_agent
                        INNER JOIN tbl_affectation ON tbl_user.id_user = tbl_affectation.code_user
                        INNER JOIN tbl_etape ON tbl_affectation.code_etape = tbl_etape.id_etape
                        INNER JOIN tbl_projet ON tbl_etape.code_projet=tbl_projet.id_projet
                        INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                        WHERE tbl_affectation.statut_affectation = 1 AND tbl_projet.id_projet = $id AND tbl_affectation.code_user = $code";
                        $projet = $app->fetch($sql);
                        $affectation = $projet['id_affectation'];
                    ?>
                    <div class="col-lg-8 col-md-12">
                        
                        <?php
                        if($moi == $privilege){
                            ?>
                            <div class="card mb-2">
                            
                        </div>
                            <?php
                        }
                        ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="timeline-item warning">
                                    <span class="date">Fichier envoyer par les Participants</span>
                                    <span class='btn btn-sm btn-outline-success addfile pull-right' data-id="<?php echo $_GET['id']; ?>"><i class='fa fa-plus'></i></span>
                                    <h6>Fichiers</h6>
                                    <?php 
                                    $code = $_SESSION['CodeUser'];
                                        $id = $_GET['id'];
                                        $sql="SELECT * FROM tbl_phase";
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            ?>
                                <div class="card-header">
                                        <h6 class="card-title"><?php echo $row['designation_phase']?></h6>
                                </div>
                                    <div class="msg">
                                        <!-- <ul class="list-unstyled team-info d-flex">
                                            <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title="Chris Fox" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar5.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar2.jpg" data-toggle="tooltip" data-placement="top" title="Folisise Chosielie" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                        </ul> -->
                                        <?php
                                        $code = $row['id_phase'];
                                        $sql6 = "SELECT * FROM tbl_rapport INNER JOIN tbl_affectation 
                                        ON tbl_rapport.code_affectation = tbl_affectation.id_affectation
                                        INNER JOIN tbl_etape ON tbl_affectation.code_etape = tbl_etape.id_etape
                                        INNER JOIN tbl_phase ON tbl_etape.code_phase = tbl_phase.id_phase
                                        INNER JOIN tbl_projet ON tbl_etape.code_projet = tbl_projet.id_projet
                                        INNER JOIN tbl_user ON tbl_rapport.addBy = tbl_user.id_user
                                         WHERE tbl_projet.id_projet = $id AND tbl_phase.id_phase = $code";
                                        $fichier = $app->fetchPrepared($sql6);
                                        
                                        foreach($fichier as $file){
                                            $dateadd = $file['dateAdd'];
                                            $newDate = date("d/m/Y H:m", strtotime($dateadd));
                                            ?>
                                            <div class="top_counter d-flex">
                                                <div class="icon text-center"><i class="fa fa-file-word-o"></i> </div>
                                                <div class="content ms-3">
                                                    <p class="mb-1"><?php echo $file['username'] ?></p>
                                                    <span><?php echo $newDate; ?></span>
                                                </div>
                                                <div>
                                                    <a href="rapport_part.php?id=<?php echo $file['id_rapport']?>" style="float: right;"><span class='btn btn-sm btn-outline-primary pull-right'><i class='fa fa-book'></i> </span></a>
                                                    
                                                    
                                                </div> 
                                            </div>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        
                                        <!-- <div class="top_counter d-flex">
                                            <div class="icon text-center"><i class="fa fa-file-word-o"></i> </div>
                                            <div class="content ms-3">
                                                <p class="mb-1">iNext project documentation.doc</p>
                                                <span>Size: 2.3Mb</span>
                                            </div>
                                        </div> -->
                                    </div>
                                        <?php 
                                    } 
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        if($moi == $privilege){
                            ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="timeline-item warning">
                                    <span class="date">Download</span>
                                    <span class='btn btn-sm btn-outline-success addfile pull-right' data-id="<?php echo $_GET['id']; ?>"><i class='fa fa-plus'></i></span>
                                    <h6>Fichiers</h6>
                                    <div class="msg">
                                        <!-- <ul class="list-unstyled team-info d-flex">
                                            <li><img src="assets/images/xs/avatar4.jpg" data-toggle="tooltip" data-placement="top" title="Chris Fox" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar5.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar2.jpg" data-toggle="tooltip" data-placement="top" title="Folisise Chosielie" alt="Avatar"></li>
                                            <li><img src="assets/images/xs/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                        </ul> -->
                                        <?php
                                        $sql6 = "SELECT * FROM tbl_fichier WHERE code_projet=$id";
                                        $fichier = $app->fetchPrepared($sql6);
                                        foreach($fichier as $file){
                                            ?>
                                            <div class="top_counter d-flex">
                                                <div class="icon text-center"><i class="fa fa-file-word-o"></i> </div>
                                                <div class="content ms-3">
                                                    <p class="mb-1"><?php echo $file['detail_fichier']; ?></p>
                                                    <span>Size: 2.3Mb</span>
                                                </div>
                                                <a href="download.php?id=<?php echo $file['id_fichier'] ?>&event=DOWNLOAD_FILE" style="float: right;"><span class='btn btn-sm btn-outline-primary pull-right'><i class='fa fa-download'></i> </span></a>
                                            </div>
                                            <br>
                                            <?php
                                        }
                                        ?>
                                        
                                        <!-- <div class="top_counter d-flex">
                                            <div class="icon text-center"><i class="fa fa-file-word-o"></i> </div>
                                            <div class="content ms-3">
                                                <p class="mb-1">iNext project documentation.doc</p>
                                                <span>Size: 2.3Mb</span>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        
                    </div>
                </div>
                                            <?php
                                        }
                                    ?>
                
                

            </div>
        </div>