<?php
	// Rotina de conexão 
	function conectaBD($banco) {
		$servidor = "localhost"; 
		$usuario  = "root";
		$senha = "usbw";
		$banco = $banco;
		$conexao = mysqli_connect($servidor, $usuario, $senha, $banco); 
		return $conexao; 
	}	
	

?>