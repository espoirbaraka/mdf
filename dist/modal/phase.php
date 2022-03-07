<div class="modal fade" id="addPhase" tabindex="-1" aria-labelledby="addPhase" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Ajouter une phase du projet</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                             <input type="hidden" name="event" value="PHASE">
                            <input type="hidden" name="eventPhase" value="CREATE_PHASE">
                            <input type="hidden" name="id" value="0">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Designation" name="designation">
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
                    <h5 class="modal-title" id="defaultModalLabel">Ajouter une phase du projet</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                             <input type="hidden" name="event" value="PHASE">
                            <input type="hidden" name="eventPhase" value="EDIT_PHASE">
                            <input type="hidden" name="id" class="phase">
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="designation" id="edit_phase">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                    </form>
                </div>
            </div>
               
        </div>
</div>

<div class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Ajouter une phase du projet</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                             <input type="hidden" name="event" value="PHASE">
                            <input type="hidden" name="eventPhase" value="DELETE_PHASE">
                            <input type="hidden" name="id" class="phase">
                            <div class="text-center">
                                <p>Voulez-vous vraiment</p>
                                <h2 class="bold fullname"></h2>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                    </form>
                </div>
            </div>
               
        </div>
</div>
