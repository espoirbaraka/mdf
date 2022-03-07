<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Liste des employés</h2>
                            
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
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addEmployee">Add New</button>
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
                                            <th></th>
                                            <th>Identite</th>
                                            <th>Phone</th>
                                            <th>Fonction</th>
                                            <th>Creer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql='SELECT * FROM tbl_agent
                                                INNER JOIN tbl_fonction as e 
                                                ON code_fonction=e.id_fonction
                                                LEFT JOIN tbl_user
                                                ON tbl_agent.id_agent=tbl_user.code_agent Where statutAgent = "EDIT_AGENT" or statutAgent = "CREATE_AGENT"';
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
                                                    <img src="<?php echo (!empty($row['photo'])) ? 'fichier/'.$row['photo'] : 'fichier/user.png'; ?>"
                                                        class="rounded-circle avatar" alt="">
                                                </td>
                                                <td>
                                                    <h6 class="mb-0"><?php echo $row['nom_agent'].' '.$row['postnom_agent'].' '.$row['prenom_agent'];?></h6>
                                                    <span><?php echo $row['email_agent'];?></span>
                                                </td>
                                                
                                                <td>
                                                    
                                                    <?php
                                                    $id = $row['id_agent'];
                                                    $sql="SELECT * FROM tbl_telephone WHERE code_agent=$id ORDER BY id_telephone LIMIT 1";
                                                    $telephone=$app->fetchPrepared($sql);
                                                    foreach($telephone as $row2)
                                                    {
                                                        echo $row2['num_telephone']; 
                                                    }
                                                    ?>
                                                    
                                                    <span class='btn btn-sm btn-outline-primary telephone pull-right' data-id="<?php echo $row['id_agent'] ?>"><i class='fa fa-plus'></i></span>
                                                </td>
                                                <td><?php echo $row['designation_fonction'];?></td>
                                                <td><?php echo $row['addBy'];?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm edit btn-outline-secondary"
                                                        title="Edit" data-id="<?php echo $row['id_agent'] ?>"><i class="fa fa-edit"></i></button>
                                                    <button type="button"
                                                        class="btn btn-sm delete btn-outline-danger js-sweetalert"
                                                        title="Delete" data-type="confirm" data-id="<?php echo $row['id_agent'] ?>"><i
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

    