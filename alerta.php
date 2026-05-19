<?php
$horario = isset($_GET['horario']) ? htmlspecialchars($_GET['horario']) : "";
$descricao = isset($_GET['descricao']) ? htmlspecialchars($_GET['descricao']) : "Compromisso";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Alerta de Compromisso</title>

    <style>
        body {
            background-color: #111;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 100px;
        }

        .alerta {
            background-color: red;
            color: white;
            padding: 40px;
            margin: auto;
            width: 70%;
            border-radius: 20px;
            font-size: 32px;
            font-weight: bold;
            animation: piscar 0.8s infinite;
        }

        @keyframes piscar {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.2;
            }

            100% {
                opacity: 1;
            }
        }

        .descricao {
            font-size: 24px;
            margin-top: 30px;
        }

        a {
            display: inline-block;
            margin-top: 40px;
            color: white;
            background-color: #333;
            padding: 15px 25px;
            text-decoration: none;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="alerta">
        Atenção! Seu compromisso está prestes a começar!
    </div>

    <div class="descricao">
        <p><strong>Horário:</strong> <?php echo $horario; ?></p>
        <p><strong>Descrição:</strong> <?php echo $descricao; ?></p>
    </div>

    <a href="agenda.php">Voltar para a agenda</a>

</body>
</html>