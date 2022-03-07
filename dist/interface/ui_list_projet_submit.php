<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                        <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Les canals soumis</h2>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
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
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="project_list" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Project</th>
                                            <th>Bailleur de fond</th>
                                            <th>Deadline</th>
                                            <th>Author</th>
                                            <th>Project manager</th>
                                            <th>Fichier</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql='SELECT * FROM tbl_projet 
                                                inner join tbl_user
                                                ON tbl_projet.addBy=tbl_user.id_user
                                                INNER JOIN tbl_agent
                                                on tbl_user.code_agent=tbl_agent.id_agent
                                                ORDER BY deadline';
                                        $canal=$app->fetchPrepared($sql);
                                        foreach($canal as $row)
                                        {
                                            $deadline = $row['deadline'];
                                            $createdate = $row['dateAdd'];
                                            $newDate1 = date("d/m/Y", strtotime($deadline));
                                            $newDate2 = date("d/m/Y", strtotime($createdate));
                                            $validation = $row['validation'];
                                            if($validation==0){
                                                ?>
                                                <tr>
                                                    <td class="project-title">
                                                        <h6 class="fs-6 mb-0"><?php echo $row['titre'] ?></h6>
                                                        <small>Crée le <?php echo $newDate2 .' par '.$row['nom_agent'].' '.$row['postnom_agent'];; ?></small>
                                                    </td>
                                                    <td><?php echo $row['bailleur'] ?></td>
                                                    <td><?php echo $newDate1; ?></td>
                                                    <td><?php echo $row['username'] ?></td>
                                                    <td><?php echo $row['nom_agent'].' '.$row['postnom_agent']; ?></td>
                                                    <td>
                                                        <?php //echo $row['file'] ?>
                                                        <a href="download.php?id=<?php echo $row['id_projet'] ?>&event=DOWNLOAD_PROJECT"><span class='btn btn-sm btn-outline-primary pull-right'><i class='fa fa-download'></i> </span></a>
                                                    </td>
                                                    <td><span class="badge bg-danger">Non valide</span></td>
                                                    <td class="project-actions">
                                                        <a data-id="<?php echo $row['id_projet'] ?>" class="btn btn-sm valider btn-success"><i class="fa fa-check"></i></a>
                                                        <a data-id="<?php echo $row['id_projet'] ?>" class="btn btn-sm edit btn-outline-danger"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }elseif($validation==1){
                                                ?>
                                                <tr>
                                                    <td class="project-title">
                                                        <h6 class="fs-6 mb-0"><?php echo $row['titre'] ?></h6>
                                                        <small>Crée le <?php echo $newDate2.' par '.$row['nom_agent'].' '.$row['postnom_agent']; ?></small>
                                                    </td>
                                                    <td><?php echo $row['bailleur'] ?></td>
                                                    <td><?php echo $newDate1; ?></td>
                                                    <td><?php echo $row['username'] ?></td>
                                                    <td><?php echo $row['nom_agent'].' '.$row['postnom_agent']; ?></td>
                                                    <td>
                                                        <?php //echo $row['file'] ?>
                                                        <a href="download.php?id=<?php echo $row['id_projet'] ?>&event=DOWNLOAD_PROJECT"><span class='btn btn-sm btn-outline-primary pull-right'><i class='fa fa-download'></i> </span></a>
                                                    </td>
                                                    <td><span class="badge bg-success">Valide</span></td>
                                                    <td class="project-actions">
                                                        <a data-id="<?php echo $row['id_projet'] ?>" class="btn btn-sm valider btn-outline-danger"><i class="fa fa-trash-o"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
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
</div>