<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM cliente WHERE id_cliente = $id";
$result = $conn->query($sql);
$cliente = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];

    $sql = "UPDATE cliente SET nome='$nome', endereco='$endereco' WHERE id_cliente = $id";
    
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
    <title>Editar Cliente</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Cliente</h1>
        <form action="edit_cliente.php?id=<?php echo $cliente['id_cliente']; ?>" method="POST">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <textarea class="form-control" id="endereco" name="endereco" required><?php echo $cliente['endereco']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="clientes.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
