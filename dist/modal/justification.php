<div class="modal fade" id="justification">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">La justification</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="./manager/create.php" enctype="multipart/form-data">
                    <div class="row g-2">
                            <input type="hidden" name="event" value="JUSTIFICATION">
                            <input type="hidden" class="justification" name="id">
                            
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="justification" placeholder="Entrer la justification de refus de projet">
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



