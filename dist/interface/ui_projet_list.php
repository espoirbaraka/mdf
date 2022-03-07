<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Projects List</h2>
                            <ul class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="index.html">Lucid</a></li>
                                <li class="breadcrumb-item">Projects</li>
                                <li class="breadcrumb-item active">Projects List</li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-sm-12 text-md-end">
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
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="project_list" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Project</th>
                                            <th>Bailleur de fond</th>
                                            <th>Deadline</th>
                                            <th>Objectif</th>
                                            <th>Localisation</th>
                                            <th>Lead</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql='SELECT * FROM tbl_projet
                                                INNER JOIN tbl_etape
                                                ON id_projet = tbl_etape.code_projet
                                                INNER JOIN tbl_phase 
                                                ON tbl_etape.code_phase = tbl_phase.id_phase
                                                WHERE tbl_phase.designation_phase = "Proposition"';
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            ?>
                                        <tr>
                                            <td class="project-title">
                                                <h6 class="fs-6 mb-0">InfiniO 4.1</h6>
                                                <small>Created 14 July, 2021</small>
                                            </td>
                                            <td>8 Aug, 2021</td>
                                            <td>8 Aug, 2021</td>
                                            <td>
                                                <div class="progress" style="height: 5px;">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100" style="width: 18%;">
                                                    </div>
                                                </div>
                                                <small>Completion with:18%</small>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td class="project-actions">
                                                <a data-id="<?php echo $row['id_projet'] ?>" class="btn btn-sm delete btn-outline-secondary"><i class="fa fa-eye"></i></a>
                                                <a data-id="<?php echo $row['id_projet'] ?>" class="btn btn-sm delete btn-outline-success"><i class="fa fa-pencil"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
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
