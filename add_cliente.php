<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];

    $sql = "INSERT INTO cliente (nome, endereco) VALUES ('$nome', '$endereco')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: clientes.php");
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
    <title>Adicionar Cliente</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Adicionar Cliente</h1>
        <form action="add_cliente.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <textarea class="form-control" id="endereco" name="endereco" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
            <a href="clientes.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
