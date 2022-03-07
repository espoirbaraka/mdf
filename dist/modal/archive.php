<div class="modal fade" id="archive">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">La fin du projet</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="ARCHIVER">
                            <input type="hidden" class="archive" name="id">
                             
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