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
    // Captura os dados do formulário
    $id = $_POST['id_motorista'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $habilitacao = $_POST['habilitacao'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $data_nascimento = $_POST['data_nascimento'];
    $categoria_habilitacao = $_POST['categoria_habilitacao'];

    // Atualiza no banco de dados
    $sql = "UPDATE motorista SET nome='$nome', cpf='$cpf', habilitacao='$habilitacao', telefone='$telefone', endereco='$endereco', data_nascimento='$data_nascimento', categoria_habilitacao='$categoria_habilitacao' WHERE id_motorista=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Motorista atualizado com sucesso!'); window.location.href='motoristas.php';</script>";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
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
    <title>Editar Motorista</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Motorista</h1>
        <a href="motoristas.php" class="btn btn-secondary mb-3">Voltar</a>

        <form action="" method="POST">
            <input type="hidden" name="id_motorista" value="<?php echo $motorista['id_motorista']; ?>">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" value="<?php echo $motorista['nome']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" name="cpf" value="<?php echo $motorista['cpf']; ?>" required>
            </div>
            <div class="form-group">
                <label for="habilitacao">Habilitação:</label>
                <input type="text" class="form-control" name="habilitacao" value="<?php echo $motorista['habilitacao']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" name="telefone" value="<?php echo $motorista['telefone']; ?>" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <textarea class="form-control" name="endereco" required><?php echo $motorista['endereco']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" name="data_nascimento" value="<?php echo $motorista['data_nascimento']; ?>" required>
            </div>
            <div class="form-group">
                <label for="categoria_habilitacao">Categoria da Habilitação:</label>
                <input type="text" class="form-control" name="categoria_habilitacao" value="<?php echo $motorista['categoria_habilitacao']; ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Atualizar Motorista</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
