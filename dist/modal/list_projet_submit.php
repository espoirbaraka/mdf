<div class="modal fade" id="valider">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Validation du projet ...</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/update.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="CONFIRM_PROJET">
                            <input type="hidden" name="eventAgent" value="CONFIRM_PROJET">
                            <input type="hidden" class="validation" name="id">
                            <div class="text-center">
                                <p>Voulez-vous valide le projet</p>
                                <h3 class="bold fullname"> ?</h3>
                            </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Valider</button>
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
                    <h5 class="modal-title" id="defaultModalLabel">Annulation du projet ...</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="VALIDATION">
                            <input type="hidden" name="eventAgent" value="CONFIRM_PROJET">
                            <input type="hidden" class="validation" name="id">
                            <div class="text-center">
                                <p>Voulez-vous valide ce projet ?</p>
                                <h3 class="bold fullname"></h3>
                            </div>
                            <div class="col-mb-4">
                                    <textarea rows="2" class="form-control no-resize" placeholder="Entrer les causes..." name=""></textarea>
                            </div>  
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Valider</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                    </form>
                </div>
               
            </div>
        </div>
</div>