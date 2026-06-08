<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Usuários</title>

    <?php 
        function conectaBD($banco) {
            $servidor = "localhost"; 
            $usuario  = "root";
            $senha = "usbw";

            $conexao = mysqli_connect($servidor, $usuario, $senha, $banco); 

            if (!$conexao) {
                die("Erro na conexão: " . mysqli_connect_error());
            }

            return $conexao; 
        }	
        
        function incluirReg($nome, $tel, $email) {
            $con = conectaBD("Agendaaula");

            $sql = "INSERT INTO contatos (nome, tel, email) 
                    VALUES ('$nome', '$tel', '$email')"; 

            if (mysqli_query($con, $sql)) { 
                echo "Contato inserido com sucesso!"; 			
            } else { 
                echo "Erro: " . mysqli_error($con); 
            } 
        }	
        
        function listarcombusca() {	
            $con = conectaBD("Agendaaula");

            $busca = isset($_GET['busca']) ? $_GET['busca'] : '';

            $sql = "SELECT * FROM contatos 
                    WHERE nome LIKE '%$busca%' 
                    OR email LIKE '%$busca%' 
                    OR tel LIKE '%$busca%' 
                    OR idcont LIKE '%$busca%'";

            $resultado = mysqli_query($con, $sql); 

            if (!$resultado) {
                echo "Erro na consulta: " . mysqli_error($con);
                return;
            }

            while ($linha = mysqli_fetch_assoc($resultado)) { 
                echo "ID: " . $linha['idcont'] . "<br>"; 
                echo "Nome: " . $linha['nome'] . "<br>"; 
                echo "Telefone: " . $linha['tel'] . "<br>"; 
                echo "Email: " . $linha['email']; 

                echo " <input type='button' value='Deletar' onclick=\"window.location.href='./deletar.php?id=" . $linha['idcont'] . "'\">";

                echo " <input type='button' value='Alterar' onclick=\"window.location.href='alterar.php?id=" . $linha['idcont'] . "&flag=1'\">";

                echo "<br><hr>";
            }		
        }	
    ?>
</head>

<body>  
    <h2>Aba de Consulta</h2>
    
    <form method="GET" action="">
        <input 
            type="text" 
            name="busca" 
            value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>"
        >

        <button type="submit">Consultar</button>
    </form>

    <hr>

    <?php
        if (isset($_GET['busca'])) {
            listarcombusca();
        }
    ?>

</body>
</html>