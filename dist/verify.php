<?php
	include 'includes/sessionoutconnected.php';
	$conn = $app->getPDO();

	if(isset($_POST['login'])){
		$mail = $_POST['email'];
		$password = sha1($_POST['password']);
		try{
			$stmt = $conn->prepare("SELECT * FROM tbl_user WHERE email = ? AND password = ?");
            $stmt->execute(array($mail,$password));
			$nbre = $stmt->rowCount();
			if($nbre == 1){
				$row = $stmt->fetch();
				$_SESSION['CodeUser'] = $row['id_user'];
				$_SESSION['statut'] = $row['statutUser'];
			}
			else{
				$_SESSION['success'] = 'Utilisateur inexistant';
			}
		}
		catch(PDOException $e){
			echo "Erreur de connexion: " . $e->getMessage();
		}
	}elseif(isset($_POST['create'])){
		try{
			$mail = $_POST['email'];
			$stmt = $conn->prepare("SELECT * FROM tbl_agent WHERE email_agent = ?");
            $stmt->execute(array($mail));
			$nbre1 = $stmt->rowCount();
			if($nbre1 == 1){
				$row = $stmt->fetch();
				$agent = $row['id_agent'];
				$data2=[$_POST['username'],$_POST['email'],sha1($_POST['password']),1,$agent];
				$sql2="INSERT INTO tbl_user(username,email,password,statutUser,code_agent) VALUES(?,?,?,?,?)";
				if($app->prepare($sql2,$data2,1)){
					$_SESSION['error'] = 'Utilisateur enregistré';
				}else{
					$_SESSION['success'] = 'Un autre utilisateur utilise ce email';
				}				
			}else{
				$stmt2 = $conn->prepare("SELECT * FROM tbl_partenaire WHERE email_partenaire = ?");
				$stmt2->execute(array($mail));
				$nbre2 = $stmt2->rowCount();
				if($nbre2 == 1){
					$row = $stmt2->fetch();
					$partenaire = $row['id_partenaire'];
					$data2=[$_POST['username'],$_POST['email'],sha1($_POST['password']),2,$partenaire];
					$sql2="INSERT INTO tbl_user(username,email,password,statutUser,code_partenaire) VALUES(?,?,?,?,?)";
					if($app->prepare($sql2,$data2,1)){
						$_SESSION['error'] = 'Utilisateur enregistré';
					}else{
						$_SESSION['success'] = 'Un autre utilisateur utilise ce email';
					}				
				}else{
					$_SESSION['success'] = 'Ce mail n\'est pas reconnu';
				}
			}
		}
		catch(PDOException $e){
			echo "Erreur de connexion: " . $e->getMessage();
		}
	}
	else{
		$_SESSION['error'] = 'Entrez vos identifiants de connexion d\'abord';
	}
	header('location: index.php');

?>
