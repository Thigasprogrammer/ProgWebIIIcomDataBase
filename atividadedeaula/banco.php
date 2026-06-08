<html> 
	<head>
		<title> Cadastro </title>   
		<meta charset="utf-8" > 
	</head> 
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
	
	// Rotina para inclusão 
	function incluirReg($nome, $tel, $email) {
		$con = conectaBD("Agendaaula");
		$sql = "INSERT INTO contatos (nome, tel, email) 
		VALUES ('$nome', '$tel', '$email')"; 
		if (mysqli_query($con, $sql) ) { 
			echo "Contato inserido com sucesso!"; 			
		} else { 
			echo "Erro: " . mysqli_error($con); 
			$flag = false;
		} 
					
	}	
	
	// Listando os dados da tabela 
	function listar() {	
		$con = conectaBD("Agendaaula");
		// Listando dados da tabela contatos 
		$sql = "SELECT * FROM contatos "; 
		$resultado = mysqli_query($con, $sql); 
		while ($linha = mysqli_fetch_assoc($resultado)) { 
				echo "ID: " . $linha['idcont'] . "<br>"; 
				echo "Nome: " . $linha['nome'] . "<br>"; 
				echo "Telefone: " . $linha['tel'] . "<br>"; 
				echo "Email: " . $linha['email']; 
				echo " <input type='button' value='Deletar' onclick=\"window.location.href='./deletar.php?id=" . $linha['idcont'] . "'\">";
				echo " <input type='button' value='Alterar' onclick=\"window.location.href='alterar.php?id=" . $linha['idcont'] . "&flag=1'\"> <br><hr>";
				
		}		
		
	
	}	
	
		
?>
	<body>
		<br>
		<hr>
		<?php 
			listar();		
		?>
		<br>
		<input type="button" value="Cadastrar" onclick="window.location.href='pad.php'"> <br>
	</body>
</html> 	

 
