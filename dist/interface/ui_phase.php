<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Liste des employés</h2>
                            
                        </div>
                        <!-- <div class="col-md-6 col-sm-12 text-md-end">
                            <div class="d-inline-flex text-start">
                                <div class="me-2">
                                    <h6 class="mb-0"><i class="fa fa-user"></i> 1,784</h6>
                                    <small>Visitors</small>
                                </div>
                                <span id="bh_visitors"></span>
                            </div>
                            <div class="d-inline-flex text-start ms-lg-3 me-lg-3 ms-1 me-1">
                                <div class="me-2">
                                    <h6 class="mb-0"><i class="fa fa-globe"></i> 325</h6>
                                    <small>Visits</small>
                                </div>
                                <span id="bh_visits"></span>
                            </div>
                            <div class="d-inline-flex text-start">
                                <div class="me-2">
                                    <h6 class="mb-0"><i class="fa fa-comments"></i> 13</h6>
                                    <small>Chats</small>
                                </div>
                                <span id="bh_chats"></span>
                            </div>
                        </div> -->
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
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addPhase">Add New</button>
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
                                            <th>Phase</th>
                                            <th>Creer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql='SELECT * FROM tbl_phase';
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
                                                <td><?php echo $row['designation_phase'];?></td>
                                                <td><?php echo $row['addBy'];?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm edit btn-outline-secondary"
                                                        title="Edit" data-id="<?php echo $row['id_phase'] ?>"><i class="fa fa-edit"></i></button>
                                                    <button type="button"
                                                        class="btn btn-sm delete btn-outline-danger js-sweetalert"
                                                        title="Delete" data-type="confirm" data-id="<?php echo $row['id_phase'] ?>"><i
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

    