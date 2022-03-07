
<!-- demande d'adhesion -->
<div class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Demande d'adhesion</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="AFFECTATION">
                            <input type="hidden" name="eventAffectation" value="DEMAND_AFFECTATION">
                            <input type="hidden" class="affectation" name="id">
                            <div class="text-center">
                                <p>Confirme votre demande d'adhesion</p>
                                <h3 class="bold fullname"> ?</h3>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Valider</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
               
            </div>
        </div>
</div>



<!-- add file -->
<div class="modal fade" id="addfile">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Ajouter un fichier au projet <span class="fullname"></span></h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                    <input type="hidden" name="event" value="ADD_FILE">
                    <input type="hidden" class="projet" name="id">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Detail sur le fichier" id="edit_detail" name="detail">
                            </div>
                            <div class="col-md-12">
                                <input type="file" class="form-control" name="fichier">
                            </div>
                            
                            
                        
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
               
            </div>
        </div>
</div>


<!-- chacge phase -->
<div class="modal fade" id="phase">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Changer la phase du projet <span class="fullname"></span></h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                    <input type="hidden" name="event" value="CHANGE_PHASE">
                    <input type="hidden" class="projet" name="id">

                            <div class="col-md-12">
                                <select name="phase" id="" class="form-control">
                                    <?php
                                    $sql = "SELECT * FROM tbl_phase";
                                    $phase = $app->fetchPrepared($sql);
                                    foreach($phase as $row)
                                    {
                                        ?>
                                        <option value="<?php echo $row['id_phase'] ?>"><?php echo $row['designation_phase'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                
                            </div>
                            <div class="col-md-12">
                                <input type="date" class="form-control" name="deadline">
                            </div>
                            
                            
                        
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
               
            </div>
        </div>
</div>

<!-- delete employe -->
<div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Validation demande d'adhesion</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="AFFECTATION">
                            <input type="hidden" name="eventAffectation" value="ACCEPT_AFFECTATION">
                            <input type="hidden" class="confirme" name="id_affectation">
                            <div class="text-center">
                                <p>Confirmez votre operation...</p>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Valider</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
               
            </div>
        </div>
</div>


