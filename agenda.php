<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>

</head>
<body>

    <?php
    date_default_timezone_set('America/Sao_Paulo');
    echo "<h1>Hora atual: " . date("H:i") . "</h1>";
    ?>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "usbw";
    $dbname = "agenda";

    $connection = mysqli_connect($servername, $username, $password, $dbname);

    if (!$connection) {
        die("Conexão falhou: " . mysqli_error($connection));
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $horacompromisso = $_POST['horario'];
        $descricao = $_POST['descricao'];

        $sql = "INSERT INTO compromissos (horario, descricao) 
                VALUES ('$horacompromisso', '$descricao')";

        if (mysqli_query($connection, $sql) === TRUE) {
            echo "<p>Compromisso cadastrado com sucesso!</p>";
        } else {
            echo "<p>Erro ao cadastrar: " . mysqli_error($connection) . "</p>";
        }
    }
    
    $compromissos = [];

    $resultado = mysqli_query($connection, "SELECT id, horario, descricao FROM compromissos");

    if ($resultado) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $compromissos[] = [
                "id" => $linha["id"],
                "horario" => substr($linha["horario"], 0, 5),
                "descricao" => $linha["descricao"]
            ];
        }
    }
    ?>

    <script>
        const compromissos = <?php echo json_encode($compromissos); ?>;

        function horarioParaSegundos(horario) {
            const partes = horario.split(":");
            const horas = parseInt(partes[0]);
            const minutos = parseInt(partes[1]);

            return (horas * 3600) + (minutos * 60);
        }

        function verificarCompromissos() {
            const agora = new Date();

            const segundosAgora = 
                (agora.getHours() * 3600) +
                (agora.getMinutes() * 60) +
                agora.getSeconds();

            const hoje = agora.getFullYear() + "-" + (agora.getMonth() + 1) + "-" + agora.getDate();

            compromissos.forEach(compromisso => {
                const segundosCompromisso = horarioParaSegundos(compromisso.horario);

                const diferenca = segundosCompromisso - segundosAgora;

                const chaveAviso = "aviso_" + hoje + "_" + compromisso.id;

                if (diferenca > 0 && diferenca <= 60 && !localStorage.getItem(chaveAviso)) {
                    localStorage.setItem(chaveAviso, "true");

                    window.location.href = "alerta.php?horario=" 
                        + encodeURIComponent(compromisso.horario) 
                        + "&descricao=" 
                        + encodeURIComponent(compromisso.descricao);
                }
            });
        }

        setInterval(verificarCompromissos, 5000);

        verificarCompromissos();
    </script>


    <form action="agenda.php" method="post">
        <label for="horario">Horário (HH:MM):</label>
        <input type="time" id="horario" name="horario" required>
        <br><br>
        <label for="descricao">Descrição do compromisso:</label>
        <input type="text" id="descricao" name="descricao" required>
        <br><br>
        <input type="submit" value="Cadastrar Compromisso">
    </form>
    
</body>
</html>