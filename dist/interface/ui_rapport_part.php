<?php
$id = $_GET['id'];
$sql2 = " SELECT * FROM tbl_rapport WHERE id_rapport = $id ";
$fichier = $app->fetch($sql2);
$moi = $fichier['addBy'];
?>
<div id="main-content">
            <div class="container-fluid">

                <div class="block-header py-lg-4 py-3">
                    <div class="row g-3">
                       
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <form method="post" action="manager/create.php">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title">Nom de l'etape</h6>
                                <br>
                            </div>
                            <div class="card-body">
                                <div>
                                <input type="hidden" name="event" value="UPDATE_RAPPORT">
                                <input type="hidden" value="<?php echo $_GET['id']?>" name="id">
                                <div class="col-sm-12">
                                                    <label for="file">Objectif</label>
                                                    <textarea name="text" id="" cols="50" rows="100" class="summernote">
                                                        <?php
                                                            $id = $_GET['id'];
                                                            $sql = " SELECT * FROM tbl_rapport WHERE id_rapport = $id ";
                                                            $fichier = $app->fetch($sql);
                                                            $affiche = $fichier['textInfo'];

                                                            echo $affiche;
                                                        ?>


                                                    </textarea>
                                                </div>
                                                
                                    
                                </div>
                                <?php
                                    $code = $_SESSION['CodeUser'];
                                    if($moi == $code){
                                        ?>
                                            <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                </div>
                                        <?php
                                    }
                                ?>
                                <?php
                                $id = $_GET['id'];
                                 $sql = "SELECT * FROM tbl_rapport INNER JOIN tbl_affectation 
                                 ON tbl_rapport.code_affectation = tbl_affectation.id_affectation
                                 inner join tbl_etape on tbl_affectation.code_etape = tbl_etape.id_etape inner join tbl_projet on tbl_etape.code_projet = tbl_projet.id_projet 
                                 inner join tbl_privilege on tbl_projet.id_projet = tbl_privilege.code_projet
                                 inner join tbl_user on tbl_privilege.code_user = tbl_user.id_user
                                 WHERE tbl_rapport.id_rapport  = $id ";
                                $fichier = $app->fetch($sql);
                                $person = $fichier['id_user'];
                                ?>
                                <?php
                                    $code = $_SESSION['CodeUser'];
                                    if($person == $code){
                                        ?>
                                        <div class="col-sm-12">
                                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                                </div>
                                        <?php
                                    }
                                ?>

                                
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>

    <?php
    ?>