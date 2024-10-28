<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origem = $_POST['origem'];
    $destino = $_POST['destino'];
    $distancia = $_POST['distancia'];
    $tempo_estimado = $_POST['tempo_estimado'];

    $sql = "INSERT INTO rota (origem, destino, distancia, tempo_estimado) VALUES ('$origem', '$destino', '$distancia', '$tempo_estimado')";

    if ($conn->query($sql) === TRUE) {
        header("Location: rotas.php");
        exit();
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Adicionar Rota</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Adicionar Rota</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="origem">Origem:</label>
                <input type="text" class="form-control" id="origem" name="origem" required>
            </div>
            <div class="form-group">
                <label for="destino">Destino:</label>
                <input type="text" class="form-control" id="destino" name="destino" required>
            </div>
            <div class="form-group">
                <label for="distancia">Distância:</label>
                <input type="text" class="form-control" id="distancia" name="distancia" required>
            </div>
            <div class="form-group">
                <label for="tempo_estimado">Tempo Estimado:</label>
                <input type="text" class="form-control" id="tempo_estimado" name="tempo_estimado" required>
            </div>
            <button type="submit" class="btn btn-success">Adicionar Rota</button>
            <a href="rotas.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
