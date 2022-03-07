<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Liste des fonctions</h2>
                            
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <br>
                                <ul class="header-dropdown">
                                    <li>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addFonction">Ajouter </button>
                                    </li>
                                </ul>
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
                                            <th>Designation</th>
                                            <th>Created by</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql='SELECT * FROM tbl_fonction
                                                INNER JOIN tbl_user
                                                ON tbl_fonction.addBy=tbl_user.id_user';
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
                                                <h6 class="mb-0"><?php echo $row['designation_fonction'];?>
                                            </td>
                                            <td><?php echo $row['username'];?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-secondary edit"
                                                    title="Edit" data-id="<?php echo $row['id_fonction'] ?>"><i class="fa fa-edit"></i></button>
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger js-sweetalert delete"
                                                    title="Delete" data-type="confirm"><i
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

    