<!-- add modal -->
<div class="modal fade" id="addFonction" tabindex="-1" aria-labelledby="addEmployee" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Ajouter une fonction</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="FONCTION">
                            <input type="hidden" name="eventFonction" value="CREATE_FONCTION">
                            <input type="hidden" name="id" value="0">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Designation" name="designation">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
               
            </div>
        </div>
</div>        

<!-- edit modal -->
<div class="modal fade" id="edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Modifier une fonction</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="FONCTION">
                            <input type="hidden" name="eventFonction" value="EDIT_FONCTION">
                            <input type="hidden" name="id" class="fonction">

                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder="Designation" name="designation" id="edit_fonction">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                    </form>
                </div>
               
    </div>
</div></div>