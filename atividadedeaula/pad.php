<html> 
	<head>
		<title> Cadastro </title>   
		<meta charset="utf-8" > 
	</head> 
<?php 
	include "conexao.php";
// Pagina 1: botão NOVO 
// Pagina 2: Botão pra gravar Nome e Tel
// Página 1.2: botão NOVO, listar o nome e tel das pessoas e botões ALTerar, EXCluir no lado dos nomes 
// Página 3: botão ALTERAR leva pra página nova que tem os textos colocados em caixinhas, pra poder editar la e clicar em ALTERAR, confirmando


	// Rotina para inclusão 
	function incluirReg($nome, $tel, $email) {
		$con = conectaBD("Agendaaula");
		$sql = "INSERT INTO contatos (nome, tel, email) 
		VALUES ('$nome', '$tel', '$email')"; 
		if (mysqli_query($con, $sql) ) { 
			echo "Contato inserido com sucesso!"; 			
		} else { 
			echo "Erro: " . mysqli_error($con); 
		}
        mysqli_close($con); 
					
	}	

	
	if (isset($_REQUEST["nome"]) && !empty($_REQUEST["nome"])) { 
		
		// Dados do form 
		$nomes = $_REQUEST["nome"];  
		$telef = $_REQUEST["tel"];  
		$email = $_REQUEST["email"];  			
		
		// Incluir registros
		incluirReg ($nomes, $telef, $email);

        header("Location: banco.php");
        exit(); // Para o código (garante que vai redirecionar)
    }
	
		
?>
<body>
        <form action="pad.php" method="post"> 
            <br> 		
            Nome: <br> 
            <input type="text" name="nome" required> <br>
            Telefone: <br> 
            <input type="text" name="tel" required> <br>
            Email: <br> 
            <input type="text" name="email" required> <br>
            <br> <input type="submit" value="Incluir">            
        </form>
</body>
</html>