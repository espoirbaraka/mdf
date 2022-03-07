<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Dashboard user</h2>
                            
                        </div>
                    </div>
                </div>

                <div class="row g-2 row-deck mb-2">
                    <div class="col-lg-3 col-md-6 col-sm-6 text-center">
                        <div class="card chart-color1">
                            <div class="card-body p-lg-4 text-light">
                                    <?php
                                        $addBy = $_SESSION['CodeUser'];
                                        $requette="SELECT COUNT(id_projet) as nbre FROM tbl_projet WHERE addBy = $addBy";
                                        $projet= $app->fetch($requette);
                                    ?>
                                <h3><?php echo $projet['nbre']; ?></h3>
                                <span>Projets crées</span>
                            </div>
                        </div>
                        <?php
                        //      $addBy = $_SESSION['CodeUser'];
                        //      $idProjet="SELECT id_projet as code_projet  FROM tbl_projet as p INNER JOIN tbl_etape as e 
                        //      ON p.id_projet = e.code_projet
                        //      INNER JOIN tbl_phase as b ON e.code_phase = b.id_phase 
                        //      WHERE e.addBy='$addBy'";
                        //     $id="SELECT id_projet From "
                        //      $projet=$app->fetch($idProjet);
                        //      $codeProjet= $projet['code_projet'];
                            ?>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 text-center">
                    <?php

                                        $requette="SELECT DISTINCT(COUNT(a.code_user)) as nbre FROM tbl_affectation AS a
                                        INNER JOIN tbl_etape AS e on e.id_etape=a.code_etape
                                        INNER JOIN tbl_projet AS p on p.id_projet=e.code_projet WHERE a.code_user='$addBy'";
                                        $projetrejoins= $app->fetch($requette);
                                    ?>
                        <div class="card chart-color2">
                            <div class="card-body p-lg-4 text-light">
                                <h3><?php echo $projetrejoins['nbre']; ?></h3>
                                <span>Projets rejoins</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 text-center">
                        <div class="card chart-color3">
                            <div class="card-body p-lg-4">
                                <?php
                                    $addBy = $_SESSION['CodeUser'];
                                    $requette="SELECT COUNT(id_projet) as nbre FROM tbl_projet WHERE statut_reussite=1";
                                    $projet= $app->fetch($requette);
                                    ?>
                                <h3><?php echo $projet['nbre'] ?></h3>
                                <span>Projets en cours</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 text-center">
                        <div class="card chart-color4">
                            <div class="card-body p-lg-4 text-light">
                                <?php
                                    $addBy = $_SESSION['CodeUser'];
                                    $requette="SELECT COUNT(id_projet) as nbre FROM tbl_projet WHERE statut_reussite=0";
                                    $projet= $app->fetch($requette);
                                    ?>
                                <h3><?php echo $projet['nbre'] ?></h3>
                                <span>Projets en attentes du clients</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title">Rapport de travail</h6>
                                <ul class="header-dropdown">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                                        <ul class="dropdown-menu dropstart list-unstyled">
                                            <li><a class="dropdown-item" href="javascript:void(0);">Action</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Another Action</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Something else</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div id="user_dashboard" style="height: 200px;"></div>
                            </div>
                        </div>
                    </div>

                    
                </div>

                <!-- <div class="row g-2">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-end">
                        <div class="mt-3">
                            <h5 class="mb-0">Lucid Team</h5>
                            <span class="text-muted">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card text-center">
                            <div class="card-header">
                                <h6 class="card-title">Web Development Team</h6>
                            </div>
                            <div class="card-body">
                                <img class="rounded-circle img-thumbnail mx-auto d-block mb-2" src="assets/images/sm/avatar5.jpg" alt="">
                                <h6 class="text-primary mb-0">Susie Willis</h6>
                                <span>Team Lead</span>
                            </div>
                            <div class="card-body pt-0">
                                <span class="badge bg-secondary">ReactJs</span>
                                <span class="badge bg-secondary">Angular</span>
                                <span class="badge bg-secondary">VueJs</span>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled team-info mb-3 d-flex justify-content-center">
                                    <li><h6 class="mb-0 me-3">Employees:</h6></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar1.jpg" alt="Avatar"></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar2.jpg" alt="Avatar"></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar3.jpg" alt="Avatar"></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar4.jpg" alt="Avatar"></li>
                                </ul>
                                <p class="mb-0 fs-6">1 Lead, 3 Employees</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card text-center">
                            <div class="card-header">
                                <h6 class="card-title">Marketing Team</h6>
                            </div>
                            <div class="card-body">
                                <img class="rounded-circle img-thumbnail mx-auto d-block mb-2" src="assets/images/sm/avatar3.jpg" alt="">
                                <h6 class="text-primary mb-0">Debra Stewart</h6>
                                <span>Team Lead</span>
                            </div>
                            <div class="card-body pt-0">
                                <span class="badge bg-secondary">Social</span>
                                <span class="badge bg-secondary">HTML/CSS</span>
                                <span class="badge bg-secondary">Twitter</span>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled team-info mb-3 d-flex justify-content-center">
                                    <li><h6 class="mb-0 me-3">Employees:</h6></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar3.jpg" alt="Avatar"></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar2.jpg" alt="Avatar"></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar6.jpg" alt="Avatar"></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar8.jpg" alt="Avatar"></li>
                                </ul>
                                <p class="mb-0 fs-6">1 Lead, 3 Employees</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card text-center">
                            <div class="card-header">
                                <h6 class="card-title">Sales Team</h6>
                            </div>
                            <div class="card-body">
                                <img class="rounded-circle img-thumbnail mx-auto d-block mb-2" src="assets/images/sm/avatar2.jpg" alt="">
                                <h6 class="text-primary mb-0">Erin Gonzales</h6>
                                <span>Team Lead</span>
                            </div>
                            <div class="card-body pt-0">
                                <span class="badge bg-secondary">Photoshop</span>
                                <span class="badge bg-secondary">HTML/CSS</span>
                                <span class="badge bg-secondary">Javascript</span>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled team-info mb-3 d-flex justify-content-center">
                                    <li><h6 class="mb-0 me-3">Employees:</h6></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar4.jpg" alt="Avatar"></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar1.jpg" alt="Avatar"></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar6.jpg" alt="Avatar"></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar3.jpg" alt="Avatar"></li>
                                </ul>
                                <p class="mb-0 fs-6">1 Lead, 3 Employees</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card text-center">
                            <div class="card-header">
                                <h6 class="card-title">Web Designing Team</h6>
                            </div>
                            <div class="card-body">
                                <img class="rounded-circle img-thumbnail mx-auto d-block mb-2" src="assets/images/sm/avatar1.jpg" alt="">
                                <h6 class="text-primary mb-0">Marshall Nichols</h6>
                                <span>Team Lead</span>
                            </div>
                            <div class="card-body pt-0">
                                <span class="badge bg-secondary">Photoshop</span>
                                <span class="badge bg-secondary">HTML/CSS</span>
                                <span class="badge bg-secondary">Javascript</span>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled team-info mb-3 d-flex justify-content-center">
                                    <li><h6 class="mb-0 me-3">Employees:</h6></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar1.jpg" alt="Avatar"></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar2.jpg" alt="Avatar"></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar3.jpg" alt="Avatar"></li>
                                    <li><img class="rounded-circle avatar sm" src="assets/images/xs/avatar4.jpg" alt="Avatar"></li>
                                </ul>
                                <p class="mb-0 fs-6">1 Lead, 3 Employees</p>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>