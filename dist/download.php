<?php
session_start();
require 'class/app.php';
$app=new App('mdf');
$event=$_GET['event'];

if($event == 'DOWNLOAD_PROJECT'){
    $id = $_GET['id'];
    if(isset($id)){
    $sql="SELECT * FROM tbl_projet WHERE id_projet = $id";
    $file=$app->fetch($sql);
    $fichier = 'fichier/'.$file['file'];
    // if(file_exists($fichier)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($fichier));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fichier));
        ob_clean();
        flush();
        readfile($fichier);
        exit;
    //}
        
}
}


if($event == 'DOWNLOAD_FILE'){
    $id = $_GET['id'];
    if(isset($id)){
    $sql="SELECT * FROM tbl_fichier WHERE id_fichier = $id";
    $file=$app->fetch($sql);
    $fichier = 'fichier/'.$file['fichier'];
    // if(file_exists($fichier)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($fichier));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fichier));
        ob_clean();
        flush();
        readfile($fichier);
        exit;
    //}
        
}
}


?>



