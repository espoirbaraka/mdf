<div class="modal fade" id="addPartenaire" tabindex="-1" aria-labelledby="addEmployee" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Ajouter un partenaire</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                             <input type="hidden" name="event" value="PARTENAIRE">
                            <input type="hidden" name="eventPartenaire" value="CREATE_PARTENAIRE">
                            <input type="hidden" name="id" value="0">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Nom partenaire" name="partenaire">
                            </div>
                            <div class="col-md-12">
                                <input type="email" class="form-control" placeholder="Email partaire" name="email_partenaire">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Adresse" name="adresse_partenaire">
                            </div>   
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                    </form>
                </div>
               
            </div>
        </div>
</div>

<div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Modifier un partenaire</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="PARTENAIRE">
                            <input type="hidden" name="eventPartenaire" value="EDIT_PARTENAIRE">
                            <input type="hidden" class="partenaire" name="id">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="edit_partenaire" name="partenaire">
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="edit_email" name="email_partenaire">
                            </div>   
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
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
                    <h5 class="modal-title" id="defaultModalLabel">Supprimmer partenaire ...</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="PARTENAIRE">
                            <input type="hidden" name="eventPartenaire" value="DELETE_PARTENAIRE">
                            <input type="hidden" class="partenaire" name="id">
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


