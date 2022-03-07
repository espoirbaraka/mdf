<?php
session_start();
require '../class/app.php';
$app=new App('mdf');
$event=$_POST['event'];
$headers = "From: esbarakabigega@gmail.com";
$lien = "http://192.168.43.222:81/mdf/dist//list_projet.php";

 if($event=='CREATE_USER'){
    $data=[$_POST['username'],$_POST['email'],sha1($_POST['password']),$_POST['fonction']];
    $sql="INSERT INTO t_user(Username,MailUser,PasswordUser,CodeFonction) VALUES(?,?,?,?)";
    if($app->prepare($sql,$data,1)){
      $mail = $_POST['email'];
      $username = $_POST['username'];
      $sujet = "Compte cree";
      $corp = "Bonjour $username, votre compte a été bien crée: connectez-vous sur $lien";
      if (mail($mail, $sujet, $corp, $headers)) {
         echo "Email envoyé avec succès à $dest ...";
       }
     $_SESSION['success'] = 'Utilisateur enregistré';
    }
    header("Location: ../user.php");
 }


 if($event=='AFFECTATION'){
   $agent = $_SESSION['CodeUser'];
   $data=[$_POST['id'],$agent,$agent,$_POST['eventAffectation'],$_POST['id_affectation']];
   $sql="CALL proc_insertAffectation(?,?,?,?,?)";
   if($app->prepare($sql,$data,1)){
      if($_POST['eventAffectation']=='ACCEPT_AFFECTATION')
      {
         $affectation = $_POST['id_affectation'];
         $sql2 = "SELECT * FROM tbl_affectation 
                  INNER JOIN tbl_user
                  ON tbl_affectation.code_user=tbl_user.id_user
                  INNER JOIN tbl_etape
                  ON tbl_affectation.code_etape=tbl_etape.id_etape
                  INNER JOIN tbl_projet
                  ON tbl_etape.code_projet=tbl_projet.id_projet
                  WHERE id_affectation = $affectation";
         if($mail = $app->fetch($sql2)){
            $nom = $mail['username'];
            $mailto = $mail['email'];
            $titre = $mail['titre'];
            $idprojet = $mail['id_projet'];
            $sujet = "Demande accepté";
            $id2 = $mail['id_projet'];
            $lien = "http://192.168.43.222:81/mdf/dist/profileprojet.php?id=$id2";
            $corp = "Bonjour $nom, Votre demande de participation dans le projet $titre a été accepté. Vous pouvez interagir en cliquant sur $lien";
            if (mail($mailto, $sujet, $corp, $headers)) {
               echo "Email envoyé avec succès à $mail ...";
            $_SESSION['success'] = 'Demande acceptée';
            }
         }
         header("Location: ../profileprojet.php?id=$idprojet");
      }else{
         $_SESSION['success'] = 'Votre demande a été bien envoyé';
         header("Location: ../list_projet.php");
      }
    
   }
   
}



if($event=='AFFECTATION_AGENT'){
   if($_POST['eventAffectation']=='CREATE_AFFECTATION'){
      $user = $_POST['user'];
      $idprojet = $_POST['projet'];
      $etape = $_POST['etape'];
      $agent = $_SESSION['CodeUser'];
      $today = date('Y-m-d');
      $statut = "CREATE_AFFECTATION";
      $data = [$etape, $user,1,$agent,$today,$statut];
      $sql = "INSERT INTO tbl_affectation (code_etape, code_user, statut_affectation, addBy, dateAdd, statutAffectationEvent) VALUES (?,?,?,?,?,?)";
      if($app->prepare($sql,$data,1)){
         $sql2 = "SELECT * FROM tbl_user
                  INNER JOIN tbl_agent
                  ON tbl_user.code_agent=tbl_agent.id_agent
                  WHERE id_user=$agent";
         if($rep = $app->fetch($sql2)){
            $nom = $rep['nom_agent'].' '.$rep['postnom_agent'].' '.$rep['prenom_agent'];
            $mail = $rep['email_agent'];
            $sujet = "Affectation au projet";
            $corp = "Bonjour $nom, Vous avez été selectionné à participer à un projet MDF. Consultez ce lien $lien ";
            if (mail($mail, $sujet, $corp, $headers)) {
               echo "Email envoyé avec succès à $mail ...";
            }
         }
         $_SESSION['success'] = 'Agent affecté au projet';
      }else{
         $_SESSION['error'] = 'Pas affecte';
      }
      
   }
   header("Location: ../profileprojet.php?id=$idprojet");
}



if($event=='AFFECTATION_PARTENAIRE'){
   if($_POST['eventAffectation']=='CREATE_AFFECTATION'){
      $partenaire = $_POST['partenaire'];
      $idprojet = $_POST['projet'];
      $etape = $_POST['etape'];
      $agent = $_SESSION['CodeUser'];
      $today = date('Y-m-d');
      $statut = "CREATE_AFFECTATION";
      $data = [$etape, $partenaire,1,$agent,$today,$statut];
      $sql = "INSERT INTO tbl_affectation (code_etape, code_user, statut_affectation, addBy, dateAdd, statutAffectationEvent) VALUES (?,?,?,?,?,?)";
      if($app->prepare($sql,$data,1)){
         $sql2 = "SELECT * FROM tbl_user
                  INNER JOIN tbl_partenaire
                  ON tbl_user.code_partenaire=tbl_partenaire.id_partenaire
                  WHERE id_user=$partenaire";
         if($rep = $app->fetch($sql2)){
            $nom = $rep['partenaire'];
            $mail = $rep['email_partenaire'];
            $sujet = "Affectation au projet";
            $corp = "Bonjour $nom, Nous venons vers vous pour vous informez que vous etes selectionné comme partenaire dans un nouveau projet. Consultez ce lien $lien ";
            if (mail($mail, $sujet, $corp, $headers)) {
               echo "Email envoyé avec succès à $mail ...";
            }
         }
         $_SESSION['success'] = 'Partenaire affecté au projet';
      }else{
         $_SESSION['error'] = 'Pas affecte';
      }
      
   }
   header("Location: ../profileprojet.php?id=$idprojet");  
}

if($event=='CHANGE_PHASE'){
   $code = $$_SESSION['CodeUser'];
   $data2=[0,$_POST['id']];
   $id=$_POST['id'];
   $sql2="UPDATE tbl_etape SET statut_projet=? WHERE code_projet=?";
   if($app->prepare($sql2,$data2,1)){
      $today = date('Y-m-d');
      $data=[$_POST['id'],$_POST['phase'],1];
      $sql="INSERT INTO tbl_etape(code_projet,code_phase,statut_projet) VALUES(?,?,?)";
      if($app->prepare($sql,$data,1)){
         $_SESSION['success'] = 'Vous avez changé l\'etape du projet';
      }
   }
   header("Location: ../profileprojet.php?id=$id");
   $sql1 = "SELECT * FROM tbl_affectation
                  INNER JOIN tbl_etape 
                  ON tbl_affectation.code_etape=tbl_etape.id_etape
                  INNER JOIN tbl_phase
                  ON tbl_etape.code_phase=tbl_phase.id_phase
                  INNER JOIN tbl_projet
                  ON tbl_etape.code_projet=tbl_projet.id_projet
                  INNER JOIN tbl_user
                  ON tbl_affectation.code_user=tbl_user.id_user
                  WHERE id_projet=$id";
            if($mails = $app->fetchPrepared($sql1)){
               foreach($mails as $mail){
                  $nom = $mail['username'];
                  $mailto = $mail['email'];
                  $titre = $mail['titre'];
                  $phase = $mail['designation_phase'];
                  $sujet = "La phase terminé";
                  $corp = "Bonjour $nom, nous vous remercions d'avoir participé dans la phase $phase du projet $titre. Vous pouvez passer encore votre demande pour la phase suivante ici $lien";
                  if (mail($mailto, $sujet, $corp, $headers)) {
                     echo "Email envoyé avec succès à $mail ...";
                     
                  }
               }
               
         }
}
// if($event=='CHANGE_PHASE'){
//    $code = $$_SESSION['CodeUser'];
//    $data2=[0,$_POST['id']];
//    $id=$_POST['id'];
//    $sql2="UPDATE tbl_etape SET statut_projet=? WHERE code_projet=?";
//    if($app->prepare($sql2,$data2,1)){
//       $today = date('Y-m-d');
//       $data=[$_POST['id'],$_POST['phase'],1];
//       $sql="INSERT INTO tbl_etape(code_projet,code_phase,statut_projet) VALUES(?,?,?)";
//       if($app->prepare($sql,$data,1)){
//          $sql1 = "SELECT * FROM tbl_affectation
//                   INNER JOIN tbl_etape 
//                   ON tbl_affectation.code_etape=tbl_etape.id_etape
//                   INNER JOIN tbl_phase
//                   ON tbl_etape.code_phase=tbl_phase.id_phase
//                   INNER JOIN tbl_projet
//                   ON tbl_etape.code_projet=tbl_projet.id_projet
//                   INNER JOIN tbl_user
//                   ON tbl_affectation.code_user=tbl_user.id_user
//                   WHERE id_projet=$id";
//             if($mails = $app->fetchPrepared($sql1)){
//                foreach($mails as $mail){
//                   $nom = $mail['username'];
//                   $mailto = $mail['email'];
//                   $titre = $mail['titre'];
//                   $phase = $mail['designation_phase'];
//                   $sujet = "La phase terminé";
//                   $corp = "Bonjour $nom, nous vous remercions d'avoir participé dans la phase $phase du projet $titre. Vous pouvez passer encore votre demande pour la phase suivante ici $lien";
//                   if (mail($mailto, $sujet, $corp, $headers)) {
//                      echo "Email envoyé avec succès à $mail ...";
//                      $_SESSION['success'] = 'Vous avez changé l\'etape du projet';
//                   }
//                }
               
//          }
         
//       }
//    }
//    header("Location: ../profileprojet.php?id=$id");
// }

if($event=='CREATE_FONCTION'){
   $data=[$_POST['designation_fonction']];
   $sql="CALL proc_insertFonction(?)";
   if($app->prepare($sql,$data,1)){
    $_SESSION['success'] = 'Ca enregistré';
   }
   header("Location: ../cas.php");
}

if($event=='ADD_FILE'){
   $filename = $_FILES['fichier']['name'];
   $data=[$_POST['detail'],$filename,$_POST['id']];
   $id = $_POST['id'];
   $sql="INSERT INTO tbl_fichier(detail_fichier,fichier,code_projet) VALUES(?,?,?)";
   if($app->prepare($sql,$data,1)){
      if(!empty($filename)){
         move_uploaded_file($_FILES['fichier']['tmp_name'], '../fichier/'.$filename);	
         $_SESSION['success'] = 'Fichier ajouté';
      }
   }
   header("Location: ../profileprojet.php?id=$id");
}


if($event=='CREATE_PROJECT'){
   $id = $_SESSION['CodeUser'];
   $filename = $_FILES['fichier']['name'];
   $data=[$_POST['projet'],$_POST['bailleur'],$_POST['objectif'],$_POST['budget'],$_POST['localisation'], $id,$_POST['event'], $_POST['deadline'],$filename];
   $sql="CALL proc_InsertProject(?,?,?,?,?,?,?,?,?)";
   if($app->prepare($sql,$data,1)){
      if(!empty($filename)){
         move_uploaded_file($_FILES['fichier']['tmp_name'], '../fichier/'.$filename);	
      }
    $_SESSION['success'] = 'Ca enregistré';
   }
   header("Location: ../list_projet.php");
}

if($event=='JUSTIFICATION'){
   $id=$_POST['id'];
   $data=[$_POST['id'],$_POST['justification']];
   $sql="CALL proc_updateProjet(?,?)";
   if($app->prepare($sql,$data,1)){
    $_SESSION['success'] = 'Ca enregistré';
   }else{
      $_SESSION['error'] = 'Error d\'insertion';
   }
   header("Location: ../profileprojet.php?id=$id");
}
if($event=='ACCEPTATION'){
   $id=$_POST['id'];
   $data=[$_POST['id']];
   $sql="CALL proc_accepterProjet(?)";
   if($app->prepare($sql,$data,1)){
    $_SESSION['success'] = 'Ca enregistré';
   }else{
      $_SESSION['error'] = 'Error d\'insertion';
   }
   header("Location: ../profileprojet.php?id=$id");
}
if($event=='ARCHIVER'){
   $id=$_POST['id'];
   $data=[$_POST['id']];
   $sql="CALL proc_archiveProjet(?)";
   if($app->prepare($sql,$data,1)){
    $_SESSION['success'] = 'Ca enregistré';
   }else{
      $_SESSION['error'] = 'Error d\'insertion';
   }
   header("Location: ../profileprojet.php?id=$id");
}

if($event=='UPDATE_RAPPORT'){
   $id=$_POST['id'];
   $data=[$_POST['id'],$_POST['text']];
   $sql="CALL proc_updateRapport(?,?)";
   if($app->prepare($sql,$data,1)){
    $_SESSION['success'] = 'Ca enregistré';
   }else{
      $_SESSION['error'] = 'Error d\'insertion';
   }
   header("Location: ../rapport_part.php?id=$id");
}

if($event=='RAPPORT'){
   $idprojet = $_POST['projetid'];
   $id = $_SESSION['CodeUser'];
   $filename = $_FILES['fichier']['name'];
   $data=[$_POST['text'],$filename,$_POST['affectation'], $id];
   $sql="CALL proc_InsertRapport(?,?,?,?)";
   if($app->prepare($sql,$data,1)){
      if(!empty($filename)){
         move_uploaded_file($_FILES['fichier']['tmp_name'], '../fichier/'.$filename);	
      }
    $_SESSION['success'] = 'Ca enregistré';
   }
   header("Location: ../profileprojet.php?id=$idprojet");
}

if($event=='AGENT'){
   $agent = $_SESSION['CodeUser'];
   $data=[$_POST['id'],$_POST['nom_agent'],$_POST['postnom_agent'],$_POST['prenom_agent'],$_POST['sexe_agent'],$_POST['email_agent'],$_POST['code_fonction'],$agent,$_POST['eventAgent']];
   $sql="CALL proc_insertAgent(?,?,?,?,?,?,?,?,?)";
   if($app->prepare($sql,$data,1)){
      $nom = $_POST['nom_agent'].' '.$_POST['postnom_agent'].' '.$_POST['prenom_agent'];
      $mail = $_POST['email_agent'];
      $sujet = "Confirmation d'enregistrement";
      $corp = "Bonjour $nom, Vous etes bien enregistre chez MDF comme agent interne. Utilisez votre compte mail $mail pour creer un compte dans la plateforme MDF";
      if (mail($mail, $sujet, $corp, $headers)) {
         echo "Email envoyé avec succès à $mail ...";
       }
    $_SESSION['success'] = 'Personnel enregistré';
   }else{
      $_SESSION['error'] = 'Error d\'insertion: veuillez verifier si la personne ou le mail que vous inserez n\'existe pas';
   }
   header("Location: ../employe.php");
}
if($event=='PARTENAIRE'){
   $agent = $_SESSION['CodeUser'];
   $data=[$_POST['id'],$_POST['partenaire'],$_POST['email_partenaire'],$agent,$_POST['eventPartenaire'],$_POST['adresse_partenaire']];
   $sql="CALL proc_insertPartenaire(?,?,?,?,?,?)";
   if($app->prepare($sql,$data,1)){
      $nom = $_POST['partenaire'];
      $mail = $_POST['email_partenaire'];
      $adresse = $_POST['adresse_partenaire'];
      $sujet = "Confirmation d'enregistrement";
      $corp = "Bonjour $nom, Vous etes bien enregistre comme partenaire externe de MDF depuis $adresse. Utilisez votre compte mail $mail pour creer un compte sur $lien";
      if (mail($mail, $sujet, $corp, $headers)) {
         echo "Email envoyé avec succès à $mail ...";
       } 
    $_SESSION['success'] = 'Partenaire enregistré';
   }else{
      $_SESSION['error'] = 'Error d\'insertion';
   }
   header("Location: ../partenaire.php");
}


//Enregistrement de la fonction

if($event=='FONCTION'){
   $agent = $_SESSION['CodeUser'];
   $data=[$_POST['id'],$_POST['designation'],$agent,$_POST['eventFonction']];
   $sql="CALL proc_insertFonction(?,?,?,?)";
   if($app->prepare($sql,$data,1)){
    $_SESSION['success'] = 'Ca enregistré';
   }else{
      $_SESSION['error'] = 'Error d\'insertion';
   }
   header("Location: ../fonction.php");
}

if($event=='PHASE'){
   $agent = $_SESSION['CodeUser'];
   $data=[$_POST['id'],$_POST['designation'],$agent,$_POST['eventPhase']];
   $sql="CALL proc_insertPhase(?,?,?,?)";
   if($app->prepare($sql,$data,1)){
    $_SESSION['success'] = 'Ca enregistré';
   }else{
      $_SESSION['error'] = 'Error d\'insertion';
   }
   header("Location: ../phase.php");
}

if($event=='CREATE_TELEPHONE'){
   $data=[$_POST['telephone'],$_SESSION['CodeUser'], $_POST['id']];
   $sql="INSERT INTO tbl_telephone(num_telephone, created_by, code_agent) VALUES(?,?,?)";
   if($app->prepare($sql,$data,1)){
    $_SESSION['success'] = 'Numero de telephone ajouté';
   }
   header("Location: ../employe.php");
}




 





?>



