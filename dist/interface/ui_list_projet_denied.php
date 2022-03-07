<div id="main-content">
            <div class="container-fluid">

                

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
                                            <th>Justification</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $sql='SELECT * FROM tbl_projet WHERE statut_reussite=2';
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            ?>
                                        <tr>
                                            <td class="project-title">
                                                <h6 class="fs-6 mb-0"><?php echo $row['titre'] ?></h6>
                                                <small>'Created/<?php echo $row['dateAdd'] ?></small>
                                            </td>
                                            <td><?php echo $row['bailleur'] ?></td>
                                            <td><?php echo $row['deadline'] ?></td>
                                            <td><?php echo $row['objectif'] ?></td>
                                            <td class="project-actions">
                                                <?php echo $row['bailleur'] ?>
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
</div>