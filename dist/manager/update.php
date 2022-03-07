<?php
session_start();
require '../class/app.php';
$app=new App('mdf');
$event=$_POST['event'];
$lien = "http://192.168.43.222:81/mdf/dist//list_projet.php";


if($event=='CONFIRM_PROJET'){
   $data=[$_POST['id']];
   $id = $_POST['id'];
   $sql="UPDATE tbl_projet SET validation = 1 WHERE id_projet=?";
   $sql3 = "SELECT * FROM tbl_projet WHERE id_projet=$id";
   if($req1 = $app->fetch($sql3)){
      $idprojet = $req1['id_projet'];
      $projetmanager = $req1['addBy'];
      $addBy = $_SESSION['CodeUser'];
      $data2 = [$projetmanager,$idprojet,$addBy,1];
      $sql4 = "INSERT INTO tbl_privilege(code_user,code_projet,addBy,statutPrivilege) VALUES(?,?,?,?)";
      if($app->prepare($sql4,$data2,1)){
         $sql5 = "INSERT INTO tbl_etape(code_projet,code_phase,statut_projet,addBy) VALUES(?,?,?,?)";
         $data3 = [$idprojet,1,1,$addBy];
         if($app->prepare($sql5,$data3,1)){
            if($app->prepare($sql,$data,1)){
               $id = $_POST['id'];
               $sql2 = "SELECT * FROM tbl_projet INNER JOIN tbl_user ON tbl_projet.addBy=tbl_user.id_user WHERE tbl_projet.id_projet=$id group by tbl_projet.addBy";
               if($rep = $app->fetch($sql2)){
                  $headers2 = "From: esbarakabigega@gmail.com";
                  $mail = $rep['email'];
                  $username = $rep['username'];
                  $projet = $rep['titre'];
                  $bailleur = $rep['bailleur'];
                  $sujet = "Canal validé";
                  $corp = "Bonjour $username, Votre canal concernant le projet $projet de $bailleur a été bien validé. Pensez maintenant à ajouter les collaborateurs";
                  if(mail($mail, $sujet, $corp, $headers2)) {
                     $_SESSION['success'] = 'Vous avez valider un projet';
                  }else{
                     $_SESSION['error'] = 'Vous avez valider un projet mais le mail n\'a pas été envoyé au destinataire';
                  }
                 
               }
            
            }
         }
         
      }
      
   }
   
   header("Location: ../list_projet-submit.php");
}




if($event=='UPDATE_AGENT'){
   $id = $_SESSION['CodeUser'];
   $filename = $_FILES['photo']['name'];
   $data=[$filename,$id];
   $sql="UPDATE tbl_user SET photo=? WHERE id_user=?";
   $sql2="UPDATE tbl_agent SET adresse_agent=?, photo=? WHERE id_agent=?";
   if($app->prepare($sql,$data,1)){
      if(!empty($filename)){
         move_uploaded_file($_FILES['photo']['tmp_name'], '../fichier/'.$filename);	
      }
    $_SESSION['success'] = 'Profile modifié';
   }else{
      $_SESSION['error'] = 'Profile non modifié';
   }
   header("Location: ../profile.php");
}


?>