<div id="left-sidebar" class="sidebar">
            <div class="user-account p-3 mb-3">
                <div class="d-flex mb-3 pb-3 border-bottom align-items-center">
                    <img src="<?php echo (!empty($req['photo'])) ? 'fichier/'.$req['photo'] : 'fichier/user.png'; ?>" class="avatar lg rounded me-3" alt="User Profile Picture">
                    <div class="dropdown flex-grow-1">
                        <span class="d-block">Welcome,</span>
                        <a href="#" class="dropdown-toggle user-name" data-bs-toggle="dropdown"><strong><?php echo $req['username']; ?></strong></a>
                        
                        <ul class="dropdown-menu p-2 shadow-sm">
                            <li><a href="profile.php"><i class="fa fa-user me-2"></i>Mon Profile</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <?php
                             $iduser=$_SESSION['CodeUser'];
                             $request="SELECT COUNT(code_user) as nbre FROM tbl_privilege WHERE statutPrivilege=1 AND code_user='$iduser'";
                            $manager=$app->fetch($request);

                        ?>
                        <h6 class="mb-0"><?php echo $manager['nbre']; ?><?php ?> fois</h6>
                        <small class="text-muted">Project manager</small>
                        <?php
                             $iduser=$_SESSION['CodeUser'];
                             $request="SELECT COUNT(code_user) as nbre FROM tbl_affectation WHERE statut_affectation=1 AND code_user='$iduser'";
                            $consultant=$app->fetch($request);

                        ?>
                    </div>
                    <div class="col">
                        <h6 class="mb-0"><?php echo $consultant['nbre'];?> fois</h6>
                        <small class="text-muted">Project consult</small>
                    </div>
                    <!-- <div class="col">
                        <h6 class="mb-0">80+</h6>
                        <small class="text-muted">Clients</small>
                    </div> -->
                </div>
            </div>
            <!-- nav tab: menu list -->
            <ul class="nav nav-tabs text-center mb-2" role="tablist">
                <?php 
                $active = 'active';
                if(isset($fonction) && $fonction==2){
                    ?>
                    <li class="nav-item flex-fill"><a class="nav-link" data-bs-toggle="tab" href="#hr_menu" role="tab">Admin</a></li>
                    <li class="nav-item flex-fill"><a class="nav-link" data-bs-toggle="tab" href="#project_menu" role="tab">Projet</a></li>
                    <li class="nav-item flex-fill"><a class="nav-link" data-bs-toggle="tab" href="#setting_menu" role="tab"><i class="fa fa-cog"></i></a></li>
                <?php
                }elseif(isset($fonction) && $fonction==3){
                    ?>
                    <li class="nav-item flex-fill"><a class="nav-link <?php echo $active; ?>" data-bs-toggle="tab" href="#project_menu" role="tab">Projet</a></li>
                    <li class="nav-item flex-fill"><a class="nav-link" data-bs-toggle="tab" href="#setting_menu" role="tab"><i class="fa fa-cog"></i></a></li>
                    <?php
                }
                ?>
                
                
            </ul>
            <!-- nav tab: content -->
            <div class="tab-content px-0">
                <?php
                $active = 'active';
                if(isset($fonction) && $fonction==2){
                    ?>
                    <div class="tab-pane fade show active" id="hr_menu" role="tabpanel" >
                    <nav class="sidebar-nav">
                        <ul class="metismenu list-unstyled">
                            <li class=""><a href="home.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                            <li><a href="list_projet-submit.php"><i class="fa fa-envelope-o"></i>Projets soumis</a></li>
                            <li>
                                <a href="#Employees" class="has-arrow"><i class="fa fa-user"></i><span>Employés</span></a>
                                <ul class="list-unstyled" class="active">
                                    <li class="active"><a href="employe.php">Listes des employes</a></li>
                                    <li><a href="list_employee_mission.php">Employes en mission</a></li>
                                    <li><a href="list_employe_conge.php">Employes en conge</a></li>
                                </ul>
                            </li>
                            <li class=""><a href="partenaire.php"><i class="fa fa-tachometer"></i><span>Partenaires</span></a></li>
                            
                            

                            <li>
                                <a href="#Parametres" class="has-arrow"><i class="fa fa-cogs"></i><span>Parametres</span></a>
                                <ul class="list-unstyled">
                                    <li><a href="fonction.php">Fonctions</a></li>
                                    <li><a href="phase.php">Phase du projet</a></li>
                                    <li><a href="affectation.php">Affectations Employés</a></li>
                                    <li><a href="fonction.php">Privileges</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#Archivages" class="has-arrow"><i class="fa fa-archive"></i><span>Archivages</span></a>
                                <ul class="list-unstyled">
                                    <li><a href="project_archive.php">Projets Archivés</a></li>
                                    <li><a href="project_denied.php">Projets refusés</a></li>
                                </ul>
                            </li>
                            
                        </ul>
                    </nav>
                </div>


                <div class="tab-pane fade show" id="project_menu" role="tabpanel" >
                        <nav class="sidebar-nav">
                            <ul class="metismenu list-unstyled">
                                <li><a href="home.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                                <li><a href="new_projet.php"><i class="fa fa-envelope-o"></i>Creer un projet</a></li>
                                <li><a href="list_projet.php"><i class="fa fa-envelope-o"></i>Listes des projets</a></li>
                                <li>
                                    <a href="#Cannaux" class="has-arrow"><i class="fa fa-users"></i><span>Mes projets</span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="mescanaux.php">Projets crées </a></li>
                                        <li><a href="mescanneaux_affect.php">Projets affectés</a></li>
                                        
                                    </ul>
                                </li>
                                <li>
                                    <a href="#Archivages" class="has-arrow"><i class="fa fa-archive"></i><span>Archivages</span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="project_archive.php">Projets Archivés</a></li>
                                        <li><a href="project_denied.php">Projets refusés</a></li>
                                    </ul>
                                </li>
                                
                                
                            </ul>
                        </nav>
                    </div>



                
                
                <div class="tab-pane fade" id="setting_menu" role="tabpanel" >
                    <div class="px-3">
                        <h6>Choose Skin</h6>
                        <ul class="choose-skin list-unstyled">
                            <li data-theme="purple" class="mb-2"><div class="purple"></div><span>Purple</span></li>
                            <li data-theme="blue" class="mb-2"><div class="blue"></div><span>Blue</span></li>
                            <li data-theme="cyan" class="mb-2"><div class="cyan"></div><span>Cyan</span></li>
                            <li data-theme="green" class="mb-2"><div class="green"></div><span>Green</span></li>
                            <li data-theme="orange" class="active mb-2"><div class="orange"></div><span>Orange</span></li>
                            <li data-theme="blush" class="mb-2"><div class="blush"></div><span>Blush</span></li>
                        </ul>
                        <hr>
                        <h6>Theme Option</h6>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-1">
                                <div class="form-check form-switch theme-switch">
                                    <input class="form-check-input" type="checkbox" id="theme-switch">
                                    <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-1">
                                <div class="form-check form-switch theme-high-contrast">
                                    <input class="form-check-input" type="checkbox" id="theme-high-contrast">
                                    <label class="form-check-label" for="theme-high-contrast">Enable High Contrast</label>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-1">
                                <div class="form-check form-switch theme-rtl">
                                    <input class="form-check-input" type="checkbox" id="theme-rtl">
                                    <label class="form-check-label" for="theme-rtl">Enable RTL Mode!</label>
                                </div>
                            </li>
                        </ul>
                        <hr>
                        <h6>General Settings</h6>
                        <ul class="setting-list list-unstyled">
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Default checkbox</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                    <label class="form-check-label" for="flexCheckDefault1">Email Redirect</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2" checked>
                                    <label class="form-check-label" for="flexCheckDefault2">Notifications</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                    <label class="form-check-label" for="flexCheckDefault3">Auto Updates</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
                                    <label class="form-check-label" for="flexCheckDefault4">Offline</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                                    <label class="form-check-label" for="flexCheckDefault5">Location Permission</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                    <?php
                }elseif(isset($fonction) && $fonction==3){
                    ?>
                    <div class="tab-pane fade show active" id="project_menu" role="tabpanel" >
                        <nav class="sidebar-nav">
                            <ul class="metismenu list-unstyled">
                                <li><a href="home.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                                <li><a href="new_projet.php"><i class="fa fa-envelope-o"></i>Creer un projet</a></li>
                                <li><a href="list_projet.php"><i class="fa fa-tasks"></i>Listes des projets</a></li>
                                <li>
                                    <a href="#Cannaux" class="has-arrow"><i class="fa fa-users"></i><span>Mes projets</span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="mescanaux.php">Projets crées </a></li>
                                        <li><a href="mescanneaux_affect.php">Projets affectés</a></li>
                                        
                                    </ul>
                                </li>
                                <li>
                                    <a href="#Archivages_User" class="has-arrow"><i class="fa fa-archive"></i><span>Archivages</span></a>
                                    <ul class="list-unstyled">
                                        <li><a href="project_archive.php">Projets Archivés</a></li>
                                        <li><a href="project_denied.php">Projets refusés</a></li>
                                    </ul>
                                </li>
                                
                                
                            </ul>
                        </nav>
                    </div>



                
                
                <div class="tab-pane fade" id="setting_menu" role="tabpanel" >
                    <div class="px-3">
                        <h6>Choose Skin</h6>
                        <ul class="choose-skin list-unstyled">
                            <li data-theme="purple" class="mb-2"><div class="purple"></div><span>Purple</span></li>
                            <li data-theme="blue" class="mb-2"><div class="blue"></div><span>Blue</span></li>
                            <li data-theme="cyan" class="mb-2"><div class="cyan"></div><span>Cyan</span></li>
                            <li data-theme="green" class="mb-2"><div class="green"></div><span>Green</span></li>
                            <li data-theme="orange" class="active mb-2"><div class="orange"></div><span>Orange</span></li>
                            <li data-theme="blush" class="mb-2"><div class="blush"></div><span>Blush</span></li>
                        </ul>
                        <hr>
                        <h6>Theme Option</h6>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-1">
                                <div class="form-check form-switch theme-switch">
                                    <input class="form-check-input" type="checkbox" id="theme-switch">
                                    <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-1">
                                <div class="form-check form-switch theme-high-contrast">
                                    <input class="form-check-input" type="checkbox" id="theme-high-contrast">
                                    <label class="form-check-label" for="theme-high-contrast">Enable High Contrast</label>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-1">
                                <div class="form-check form-switch theme-rtl">
                                    <input class="form-check-input" type="checkbox" id="theme-rtl">
                                    <label class="form-check-label" for="theme-rtl">Enable RTL Mode!</label>
                                </div>
                            </li>
                        </ul>
                        <hr>
                        <h6>General Settings</h6>
                        <ul class="setting-list list-unstyled">
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Default checkbox</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                    <label class="form-check-label" for="flexCheckDefault1">Email Redirect</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2" checked>
                                    <label class="form-check-label" for="flexCheckDefault2">Notifications</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                    <label class="form-check-label" for="flexCheckDefault3">Auto Updates</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
                                    <label class="form-check-label" for="flexCheckDefault4">Offline</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                                    <label class="form-check-label" for="flexCheckDefault5">Location Permission</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                    <?php
                }elseif(!isset($fonction)){
                    ?>
                    <div class="tab-pane fade show active" id="project_menu" role="tabpanel" >
                        <nav class="sidebar-nav">
                            <ul class="metismenu list-unstyled">
                                <li><a href="home.php"><i class="fa fa-tachometer"></i><span>User dashboard</span></a></li>
                                <li><a href="list_projet_partenaire.php"><i class="fa fa-envelope-o"></i>Listes des projets</a></li>
                                <li><a href="mescanneaux_affect.php"><i class="fa fa-envelope-o"></i>Mes projets</a></li>
                                
                                
                                
                            </ul>
                        </nav>
                    </div>



                
                
                <div class="tab-pane fade" id="setting_menu" role="tabpanel" >
                    <div class="px-3">
                        <h6>Choose Skin</h6>
                        <ul class="choose-skin list-unstyled">
                            <li data-theme="purple" class="mb-2"><div class="purple"></div><span>Purple</span></li>
                            <li data-theme="blue" class="mb-2"><div class="blue"></div><span>Blue</span></li>
                            <li data-theme="cyan" class="mb-2"><div class="cyan"></div><span>Cyan</span></li>
                            <li data-theme="green" class="mb-2"><div class="green"></div><span>Green</span></li>
                            <li data-theme="orange" class="active mb-2"><div class="orange"></div><span>Orange</span></li>
                            <li data-theme="blush" class="mb-2"><div class="blush"></div><span>Blush</span></li>
                        </ul>
                        <hr>
                        <h6>Theme Option</h6>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center mb-1">
                                <div class="form-check form-switch theme-switch">
                                    <input class="form-check-input" type="checkbox" id="theme-switch">
                                    <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-1">
                                <div class="form-check form-switch theme-high-contrast">
                                    <input class="form-check-input" type="checkbox" id="theme-high-contrast">
                                    <label class="form-check-label" for="theme-high-contrast">Enable High Contrast</label>
                                </div>
                            </li>
                            <li class="d-flex align-items-center mb-1">
                                <div class="form-check form-switch theme-rtl">
                                    <input class="form-check-input" type="checkbox" id="theme-rtl">
                                    <label class="form-check-label" for="theme-rtl">Enable RTL Mode!</label>
                                </div>
                            </li>
                        </ul>
                        <hr>
                        <h6>General Settings</h6>
                        <ul class="setting-list list-unstyled">
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">Default checkbox</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault1">
                                    <label class="form-check-label" for="flexCheckDefault1">Email Redirect</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2" checked>
                                    <label class="form-check-label" for="flexCheckDefault2">Notifications</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                    <label class="form-check-label" for="flexCheckDefault3">Auto Updates</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">
                                    <label class="form-check-label" for="flexCheckDefault4">Offline</label>
                                </div>
                            </li>
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault5">
                                    <label class="form-check-label" for="flexCheckDefault5">Location Permission</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                    <?php
                }
                ?>
                
                
            </div>
        </div>