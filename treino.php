<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<?php
// No mysql
//CREATE TABLE contatos (
//idagenda INT AUTO_INCREMENT PRIMARY KEY,
//nome VARCHAR(100) NOT NULL,
//telefone VARCHAR(20),
//email VARCHAR(100),
//obs TEXT
//);
    $servidor = "localhost";
    $usuario = "root";
    $senha = "usbw";
    $banco = "treino";

    // Comando essencial, conecta o banco de dados
    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (isset ($_REQUEST["nome"]) ) {
        $nomes = $_REQUEST["nome"];
        $telef = $_REQUEST["tel"];
        $email = $_REQUEST["email"];

        $sql = "INSERT INTO contatos (nome, tel, email)
        VALUES ('$nomes', '$telef','$email')";

        if (mysqli_query($conexao, $sql)) { // query é usado para inserção e projeção de dados
            echo "Contato inserido com sucesso!";
        } else {
            echo "Erro: " . mysqli_error ($conexao);
        }
    }

    // Listando dados da tabela contatos
    $sql = "SELECT * FROM contatos";
    $resultado = mysqli_query($conexao, $sql);
    while ($linha = mysqli_fetch_assoc($resultado)) {
        echo "<br> ID: " . $linha["id"] . "<br>" .
        " - Nome: " . $linha["nome"] . "<br>" .
        " - Telefone: " . $linha["tel"] . "<br>" .
        " - Email: " . $linha["email"] . "<br>";
    }

?>
    <body>
        <form action="treino.php" method="post">
            Nome: <br>
            <input type="text" name="nome"> <br>
            Telefone: <br>
            <input type="text" name="tel"> <br>
            Email: <br>
            <input type="text" name="email"> <br>
            <input type="submit" value="Incluir"> <br>
        </form>
    </body>
</html>