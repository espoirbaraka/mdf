<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Creer un nouveau canal</h2>
                            
                        </div>
                        
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="manager/create.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="event" value="CREATE_PROJECT">
                                    <div class="row g-3 clearfix">
                                            <div class="col-sm-12">
                                                <label for="projet">Nom du projet</label>
                                                <input type="text" class="form-control" name="projet" placeholder="">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label for="bailleur">Bailleur de fond</label>
                                                <input type="text" class="form-control" name="bailleur" placeholder="">
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="">
                                                    <label for="deadline">Deadline</label>
                                                    <input type="date" name="deadline" data-date-autoclose="true" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="">
                                                    <label for="budget">Budget</label>
                                                    <input type="number" class="form-control" name="budget">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="">
                                                    <label for="localisation">Localisation</label>
                                                    <input type="text" class="form-control" name="localisation">
                                                </div>
                                            </div>                            
                                            <div class="col-12">
                                                <label for="fichier">Fichier explicatif</label>
                                                <input type="file" id="fichier" name="fichier" class="dropify">
                                                <div class="mt-3"></div>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="file">Objectif</label>
                                                <textarea name="objectif" id="" cols="50" rows="40" class="summernote"></textarea>
                                            </div>
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary">Create</button>
                                                <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                                            </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>