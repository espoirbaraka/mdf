<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Liste des affectations au projet</h2>
                            
                        </div>
                       
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- <h6 class="card-title"></h6> -->
                                <br>
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
                                            <th>Project</th>
                                            <th>Bailleur de fond</th>
                                            <th>Deadline</th>
                                            <th>Author</th>
                                            <th>Project manager</th>
                                            <th>Fichier</th>
                                            <th>Phase</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql='SELECT * FROM tbl_projet INNER JOIN tbl_etape as e 
                                        ON id_projet = e.code_projet
                                        INNER JOIN tbl_phase as b ON e.code_phase = b.id_phase 
                                        WHERE designation_phase = "Proposition"';
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
                                                <h6 class="mb-0"><?php echo $row['username'];?></h6>
                                                <span><?php echo $row['titre'];?></span>
                                            </td>
                                            <td><span><?php echo $row['designation_phase'];?></span></td>
                                            <td><span><?php echo $row['addBy'];?></span></td>
                                            <td><?php echo $row['addBy'];?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-secondary edit"
                                                    title="Edit" data-id="<?php echo $row['id_affectation'] ?>"><i class="fa fa-edit"></i></button>
                                                <button type="button"
                                                    class="btn btn-sm delete btn-outline-danger js-sweetalert"
                                                    title="Delete" data-type="confirm" data-id="<?php echo $row['id_affectation'] ?>"><i
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

    