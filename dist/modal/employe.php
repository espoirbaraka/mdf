<!-- add employe -->
<div class="modal fade" id="addEmployee">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Nouvel Employé</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    

                    <div class="row g-2">
                            <input type="hidden" name="event" value="AGENT">
                            <input type="hidden" name="eventAgent" value="CREATE_AGENT">
                            <input type="hidden" name="id" value="0">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Nom employé" name="nom_agent">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Postnom employé" name="postnom_agent">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Prenom employé" name="prenom_agent">
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="sexe_agent">
                                    <option>Select Gender</option>
                                    <option value="Feminin">Féminin</option>
                                    <option value="Masculin">Masculin</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="code_fonction">
                                    <option>Select Fonction</option>
                                    <?php
                                        $sql='SELECT * FROM tbl_fonction';
                                        $agent=$app->fetchPrepared($sql);
                                        foreach($agent as $row)
                                        {
                                            ?>
                                    <option value="<?php echo $row['id_fonction'];?>"><?php echo $row['designation_fonction'];?></option>
                                    <?php
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Adresse mail" name="email_agent">
                            </div>
                            <div class="g-recaptcha" data-sitekey="6Lfn8nodAAAAACagvZf2vklnH8LCRzV12NxWcFU1"></div>

                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-sitekey="6Lcx6HodAAAAAFLlC4c6T6UenAnM1H7VXtAnGE5r" data-callback='onSubmit' data-action='submit'>Add</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
               
            </div>
        </div>
</div>

<!-- update employe -->
<div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Modifier Employé</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="AGENT">
                            <input type="hidden" name="eventAgent" value="EDIT_AGENT">
                            <input type="hidden" class="employe" name="id">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="edit_nom" name="nom_agent">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="edit_postnom" name="postnom_agent">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="edit_prenom" name="prenom_agent">
                            </div>
                            
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="sexe_agent">
                                    <option>Select Gender</option>
                                    <option value="Feminin">Féminin</option>
                                    <option value="Masculin">Masculin</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" name="code_fonction">
                                    <option>Select Fonction</option>
                                    <?php
                                        $sql='SELECT * FROM tbl_fonction';
                                        $agent=$app->fetchPrepared($sql); 
                                        foreach($agent as $row)
                                        {
                                            ?>
                                    <option value="<?php echo $row['id_fonction'];?>"><?php echo $row['designation_fonction'];?></option>
                                    <?php
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="edit_mail" name="email_agent">
                            </div>
                            
                        
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
               
            </div>
        </div>
</div>


<!-- delete employe -->
<div class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Supprimer Employé ...</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="AGENT">
                            <input type="hidden" name="eventAgent" value="DELETE_AGENT">
                            <input type="hidden" class="employe" name="id">
                            <div class="text-center">
                                <p>Voulez-vous vraiment</p>
                                <h2 class="bold fullname"></h2>
                            </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Supprimer</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                    </form>
                </div>
               
            </div>
        </div>
</div>



<!-- ajouter un numero de telephone -->
<div class="modal fade" id="telephone">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Ajouter un numero de telephone</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="CREATE_TELEPHONE">
                            <input type="hidden" class="employe" name="id">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Ex: +243 977 553 723" name="telephone">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Creer</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
               
            </div>
        </div>
</div>