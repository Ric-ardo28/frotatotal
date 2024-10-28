<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sql = "DELETE FROM motorista WHERE id_motorista = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Motorista excluído com sucesso!'); window.location.href='motoristas.php';</script>";
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM motorista WHERE id_motorista = $id";
    $result = $conn->query($sql);
    $motorista = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Excluir Motorista</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Excluir Motorista</h1>
        <a href="motoristas.php" class="btn btn-secondary mb-3">Voltar</a>

        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $motorista['id_motorista']; ?>">
            <div class="alert alert-danger" role="alert">
                Tem certeza que deseja excluir o motorista <strong><?php echo $motorista['nome']; ?></strong>?
            </div>
            <button type="submit" class="btn btn-danger">Excluir Motorista</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
