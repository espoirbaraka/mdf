<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Liste des partenaires</h2>
                            
                        </div>
                       
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- <h6 class="card-title"></h6> -->
                                <br>
                                <ul class="header-dropdown">
                                    <li>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addPartenaire">Add New</button>
                                    </li>
                                </ul>
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
                            <div class="card-body">
                                <table id="employee_List" class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>
                                                <div class="form-check d-inline-flex mt-1">
                                                    <input class="form-check-input select-all" type="checkbox">
                                                </div>
                                            </th>
                                            <th>Partenaire</th>
                                            <th>Email</th>
                                            <th>Adresse</th>
                                            <th>Created by</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql='SELECT * FROM tbl_partenaire
                                        INNER JOIN tbl_user
                                        ON tbl_partenaire.addBy=tbl_user.id_user 
                                        WHERE statutPartenaire = "EDIT_PARTENAIRE" or statutPartenaire = "CREATE_PARTENAIRE"';
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
                                                <h6 class="mb-0"><?php echo $row['partenaire'];?></h6>
                                                <span><?php echo $row['email_partenaire'];?></span>
                                            </td>
                                            <td><?php echo $row['email_partenaire'];?></td>
                                            <td><?php echo $row['adresse_partenaire'];?></td>
                                            <td><?php echo $row['username'];?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-secondary edit"
                                                    title="Edit" data-id="<?php echo $row['id_partenaire'] ?>"><i class="fa fa-edit"></i></button>
                                                <button type="button"
                                                    class="btn btn-sm delete btn-outline-danger js-sweetalert"
                                                    title="Delete" data-type="confirm" data-id="<?php echo $row['id_partenaire'] ?>"><i
                                                        class="fa fa-trash-o"></i></button>
                                            </td>
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

    