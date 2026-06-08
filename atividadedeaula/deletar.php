<?php 
    include "conexao.php";

    $id = $_REQUEST["id"];
	// Rotina para deleção 
	function deletarReg($id) {
		$con = conectaBD("Agendaaula");
		$sql = "Delete from contatos where idcont=$id" ; 
		mysqli_query($con, $sql);
        header("location: banco.php");
	}	
    deletarReg($id);
?>