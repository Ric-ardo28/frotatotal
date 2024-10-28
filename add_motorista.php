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
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $habilitacao = $_POST['habilitacao'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $data_nascimento = $_POST['data_nascimento'];
    $categoria_habilitacao = $_POST['categoria_habilitacao'];

    // Insere no banco de dados
    $sql = "INSERT INTO motorista (nome, cpf, habilitacao, telefone, endereco, data_nascimento, categoria_habilitacao) 
            VALUES ('$nome', '$cpf', '$habilitacao', '$telefone', '$endereco', '$data_nascimento', '$categoria_habilitacao')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Motorista adicionado com sucesso!'); window.location.href='motoristas.php';</script>";
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
    <title>Adicionar Motorista</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Adicionar Motorista</h1>
        <a href="motoristas.php" class="btn btn-secondary mb-3">Voltar</a>

        <form action="" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" name="cpf" required>
            </div>
            <div class="form-group">
                <label for="habilitacao">Habilitação:</label>
                <input type="text" class="form-control" name="habilitacao" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" class="form-control" name="telefone" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <textarea class="form-control" name="endereco" required></textarea>
            </div>
            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" class="form-control" name="data_nascimento" required>
            </div>
            <div class="form-group">
                <label for="categoria_habilitacao">Categoria da Habilitação:</label>
                <input type="text" class="form-control" name="categoria_habilitacao" required>
            </div>
            <button type="submit" class="btn btn-success">Adicionar Motorista</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
