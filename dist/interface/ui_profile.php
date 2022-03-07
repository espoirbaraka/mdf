
     <div id="main-content" class="profilepage_2 blog-page">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <!-- <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> User Profile v2</h2> -->
                            <!-- <ul class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="index.html">Lucid</a></li>
                                <li class="breadcrumb-item">Pages</li>
                                <li class="breadcrumb-item active">User Profile v2</li>
                            </ul> -->
                        </div>
                        
                    </div>
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
                <div class="row g-3">
                    <div class="col-lg-4 col-md-12">
                        <div class="card mb-3 profile-header">
                            <div class="card-body text-center">
                                <div class="profile-image mb-3"><img style="height: 150px; width: 150px;" src="<?php echo (!empty($req['photo'])) ? 'fichier/'.$req['photo'] : 'fichier/user.png'; ?>" class="rounded-circle" alt=""> </div>
                                <div>
                                <h4 class=""><strong><?php echo $req['nom_agent'].' '.$req['postnom_agent'].' '.$req['prenom_agent'] ?></strong></h4>
                                    <span><?php if($localisation!=''){ echo $localisation; }else{ echo "Completez l'adresse"; } ?></span>
                                </div>
                               
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6 class="card-title">Info</h6>
                                <ul class="header-dropdown">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Another Action</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Something else</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <small class="text-muted">Addresse: </small>
                                <p><?php echo $req['adresse_agent']; ?></p>
                                
                                <hr>
                                <small class="text-muted">Adresse Email: </small>
                                <p><?php echo $req['email_agent']; ?></p>
                                <hr>
                                <small class="text-muted">Sexe: </small>
                                <p><?php  echo $req['sexe_agent'];?></p>
                                <hr>
                                <?php  
                                    // $code=$req['code_fonction'];
                                    // $requette="SELECT designation_fonction  FROM tbl_fonction WHERE id_fonction='$code'";
                                    // $designation= $app->fetch($requette);
                                 ?>
                                <small class="text-muted">Code Fonction: </small>
                                <p class=""><?php  echo $req['designation_fonction'];?></p>
                                <hr>
            
                            </div>
                        </div>
    
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation"><a class="nav-link active" id="Overview-tab" data-bs-toggle="tab" href="#Overview" role="tab">Mes Projets</a></li>
                                    <li class="nav-item" role="presentation"><a class="nav-link" id="Settings-tab" data-bs-toggle="tab" href="#Settings" role="tab">Parametres</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content p-0" id="myTabContent">
                            <div class="tab-pane fade show active" id="Overview">
                                <div class="card mb-12">
                                    <div class="card-body">
                                        <div class="mb-12">
                                            <div class="col-lg-12 col-md-6 col-sm-12">
                                                <?php
                                                        $id = $_SESSION['CodeUser'];
                                                        $mesprojet = "SELECT * FROM tbl_projet 
                                                                        INNER JOIN tbl_privilege 
                                                                        ON tbl_projet.id_projet=tbl_privilege.code_projet
                                                                        WHERE tbl_privilege.code_user=$id";
                                                        //if($req=$app->fetch($mesprojet)){
                                                            foreach($req2=$app->fetchPrepared($mesprojet) as $row){
                                                                ?>
                                                                <div class="col-lg-12 col-md-6 col-sm-12">
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
                                                                                        <li><img src="assets/images/projet.jpg" data-bs-toggle="tooltip" data-bs-placement="top" title="Chris Fox" alt="Avatar"></li>
                                                                                        <li><img src="assets/images/xs/avatar5.jpg" data-bs-toggle="tooltip" data-bs-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                                                                        <li><img src="assets/images/xs/avatar2.jpg" data-bs-toggle="tooltip" data-bs-placement="top" title="Folisise Chosielie" alt="Avatar"> </li>
                                                                                        <li><img src="assets/images/xs/avatar1.jpg" data-bs-toggle="tooltip" data-bs-placement="top" title="Joge Lucky" alt="Avatar"></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                            }
                                                ?>
                                                
                                                
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                               
                            </div>
                            <div class="tab-pane fade" id="Settings">
                                <div class="card mb-3">
                                    <form action="manager/update.php" method="POST" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <input type="hidden" name="event" value="UPDATE_AGENT">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="mb-3">
                                                    <label for="">Nom</label>
                                                    <input type="text" class="form-control" name="nom" value="<?php echo $req['nom_agent'] ?>" disabled="on">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="postnom" value="<?php echo $req['postnom_agent'] ?>" disabled="on">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" class="form-control" name="prenom" value="<?php echo $req['prenom_agent'] ?>" disabled="on">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="file">Photo de profil</label>
                                                    <input type="file" class="form-control" name="photo">
                                                </div>
                                                
                                                
                                            </div>
                                            
                                        </div>
                                        <button type="submit" class="btn btn-success">Modifier</button> &nbsp;&nbsp;
                                        <button type="button" class="btn btn-secondary">Cancel</button>
                                        </div>
                                    </form>
                                    
                                </div>
                                <div class="card mb-3">
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="card mb-3">
                            <ul class="row text-center list-unstyled mb-0">
                                <li class="col-lg-6 col-6">
                                    <div class="card-body">
                                    <?php
                                            $id = $_SESSION['CodeUser'];
                                            $mesprojet = "SELECT COUNT(id_projet) AS nbre FROM tbl_projet 
                                                                INNER JOIN tbl_privilege 
                                                                ON tbl_projet.id_projet=tbl_privilege.code_projet
                                                                WHERE tbl_privilege.code_user=$id";
                                            $nbreProjet= $app->fetch($mesprojet);
                                                                ?>
                                        <i class="fa fa-camera fa-2x"></i>
                                        <h5 class="mb-0"><?php  echo $nbreProjet['nbre'];?></h5>
                                       
                                        <small>Mes Projets</small>
                                    </div>
                                </li>
                                <li class="col-lg-6 col-6">
                                    <div class="card-body">
                                        <i class="fa fa-thumbs-o-up fa-2x"></i>
                                        
                                        <h5 class="mb-0">120</h5>
                                        <small>Likes</small>
                                    </div>
                                </li>
                                <li class="col-lg-6 col-6">
                                    <div class="card-body">
                                        <i class="fa fa-comments-o fa-2x"></i>
                                        <h5 class="mb-0">324</h5>
                                        <small>Commentaires sur les Projets</small>
                                    </div>
                                </li>
                                <li class="col-lg-6 col-6">
                                    <div class="card-body">
                                        <i class="fa fa-user fa-2x"></i>
                                        <h5 class="mb-0">19</h5>
                                        <small>Profil Employe</small>
                                    </div>
                                </li>
                                
                                <li class="col-lg-6 col-6">
                                    <div class="card-body">
                                    <?php
                                            $id = $_SESSION['CodeUser'];
                                            $mesprojet = "SELECT COUNT(validation) AS nbre FROM tbl_projet 
                                                                INNER JOIN tbl_privilege 
                                                                ON tbl_projet.id_projet=tbl_privilege.code_projet
                                                                WHERE tbl_privilege.code_user=$id AND validation=1";
                                            $nbreProjetEnCours= $app->fetch($mesprojet);
                                                                ?>
                                        <i class="fa fa-desktop fa-2x"></i>
                                        <h5 class="mb-0"><?php echo $nbreProjetEnCours['nbre'];  ?></h5>
                                        <small>Projets en Cours</small>
                                    </div>
                                </li>
                                <li class="col-lg-6 col-6">
                                    <div class="card-body">
                                    <?php
                                            $id = $_SESSION['CodeUser'];
                                            $mesprojet = "SELECT COUNT(file) AS nbre FROM tbl_projet 
                                                                INNER JOIN tbl_privilege 
                                                                ON tbl_projet.id_projet=tbl_privilege.code_projet
                                                                WHERE tbl_privilege.code_user=$id";
                                            $nbreFile= $app->fetch($mesprojet);
                                                                ?>
                                        <i class="fa fa-file-text text-warning fa-2x"></i>
                                        <h5 class="mb-0"><?php echo $nbreFile['nbre']; ?></h5>
                                       
                                        <small>Documents</small>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="row g-3 text-center">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-center" id="Events"></div>
                                        <h6>Projet en Cours</h6>
                                        <span>Realisé à 80%</span>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
