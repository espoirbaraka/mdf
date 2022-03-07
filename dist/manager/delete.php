<?php
session_start();
require '../class/app.php';
$app=new App('mdf');
$event=$_POST['event'];


 if($event=='DELETE_USER'){
    $data=[$_POST['id']];
    $sql="DELETE FROM t_user WHERE CodeUser=?";
    if($app->prepare($sql,$data,1)){
     $_SESSION['success'] = 'Utilisateur supprimé';
    }
    header("Location: ../user.php");
 }

 if($event=='DELETE_CAS'){
    $data=[$_POST['id']];
    $sql="DELETE FROM t_cas WHERE CodeCas=?";
    if($app->prepare($sql,$data,1)){
     $_SESSION['success'] = 'Province supprimé';
    }
    header("Location: ../cas.php");
 }


 if($event=='DELETE_PLEIGNANT'){
   $data=[$_POST['id']];
   $sql="DELETE FROM t_pleignant WHERE CodePleignant=?";
   if($app->prepare($sql,$data,1)){
    $_SESSION['success'] = 'Pleignant supprimé';
   }
   header("Location: ../pleignant.php");
}

if($event=='DELETE_ACCUSE'){
   $data=[$_POST['id']];
   $sql="DELETE FROM t_accuse WHERE CodeAccuse=?";
   if($app->prepare($sql,$data,1)){
    $_SESSION['success'] = 'Accuse supprimé';
   }
   header("Location: ../accuse.php");
}

if($event=='DELETE_PLEINTE'){
   $pleignant=$_POST['pleignant'];
   $data=[$_POST['id']];
   $sql="DELETE FROM t_pleinte WHERE CodePleinte=?";
   if($app->prepare($sql,$data,1)){
    $_SESSION['success'] = 'Pleinte supprimée';
   }
   header("Location: ../profile_pleignant.php?id=$pleignant");
}





 
 





?>