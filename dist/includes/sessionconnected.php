<?php
	include './class/app.php';
	session_start();

	if(!isset($_SESSION['CodeUser']) || trim($_SESSION['CodeUser']) == ''){
		header('location: ./index.php');
		exit();
	}

	$conn = $app->getPDO();
	$id = $_SESSION['CodeUser'];
	$statut = $_SESSION['statut'];
	if($statut==1){
		$sql = "SELECT * FROM tbl_user
			INNER JOIN tbl_agent
			ON tbl_user.code_agent=tbl_agent.id_agent
			INNER JOIN tbl_fonction
			ON tbl_agent.code_fonction=tbl_fonction.id_fonction
			WHERE id_user=$id";
		$req = $app->fetch($sql);
		$localisation = $req['adresse_agent'];
		$fonction = $req['code_fonction'];
	}elseif($statut==2){
		$sql = "SELECT * FROM tbl_user
			INNER JOIN tbl_partenaire
			ON tbl_user.code_partenaire=tbl_partenaire.id_partenaire
			WHERE id_user=$id";
		$req = $app->fetch($sql);
		$localisation = $req['adresse_partenaire'];
		$statutuser = $req['statutUser'];
	}
	
	
    

?>