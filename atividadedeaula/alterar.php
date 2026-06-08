<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Alterar</title>

		<?php
		include "conexao.php";

		$id = $_REQUEST["id"];
		$flag = $_REQUEST["flag"];
		
		if ($flag == 1) {
			busca($id);
		} else {
			$nome = $_REQUEST["nome"];
			$tel = $_REQUEST["tel"];
			$email = $_REQUEST["email"];
			alterarReg($id, $nome, $tel, $email);
		}

		function busca() {
			GLOBAL $id;
			GLOBAL $nome;
			GLOBAL $tel;
			GLOBAL $email;	
			$con = conectaBD("Agendaaula");
			// Listando dados da tabela contatos 
			$sql = "SELECT * FROM contatos where idcont= $id"; 
			$resultado = mysqli_query($con, $sql); 
			$linha = mysqli_fetch_assoc($resultado);
			$id = $linha['idcont']; 
			$nome = $linha['nome']; 
			$tel = $linha['tel']; 
			$email = $linha['email']; 
					
		}	

		// Rotina para alteração  
		function alterarReg($id, $nome, $tel, $email) {
			$con = conectaBD("Agendaaula");
			$sql  = "update contatos set "; 
			$sql .= " nome = '$nome', ";   
			$sql .= " tel  = '$tel', ";   
			$sql .= " email = '$email' ";   
			$sql .= "where idcont=$id; " ;
			
			$resultado = mysqli_query($con, $sql);

			HEADER("Location: banco.php");				
		}	

		?>
	</head>
	<body>
		<form action="alterar.php" method="post">
			<input type="hidden" name="flag" value="0">
			<input type="hidden" name="id" value="<?php echo $id ?>" required> <br>			
			Nome: <br> 
			<input type="text" name="nome" value="<?php echo $nome ?>" required> <br>
			Telefone: <br> 
			<input type="text" name="tel" value="<?php echo $tel ?>" required> <br>
			Email: <br> 
			<input type="text" name="email" value="<?php echo $email ?>" required> <br> <br>
		
			<input type="submit" value="Alterar"> <br>			
		
	</body>
</html>

