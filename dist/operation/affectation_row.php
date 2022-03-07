<?php 
	include '../class/app.php';
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$conn = $app->getPDO();
		
		$sql = "SELECT * FROM tbl_projet INNER JOIN tbl_etape as e ON id_projet = e.code_projet
        INNER JOIN tbl_phase as d ON e.code_phase = d.id_phase WHERE id_etape = $id";
        $req = $app->fetch($sql);
        

		echo json_encode($req);
	}
?>