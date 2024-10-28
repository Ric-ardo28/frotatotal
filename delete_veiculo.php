<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM veiculo WHERE id_veiculo = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Veículo excluído com sucesso!'); window.location.href='veiculos.php';</script>";
    } else {
        echo "Erro ao excluir veículo: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Excluir Veículo</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Excluir Veículo</h1>
        <a href="veiculos.php" class="btn btn-secondary mb-3">Voltar</a>

        <p>Veículo excluído com sucesso.</p>
    </div>
</body>
</html>

<?php
$conn->close();
?>
