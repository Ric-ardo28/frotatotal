<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$id = $_GET['id']; // Pega o ID da manutenção a ser editada
$sql = "SELECT * FROM manutencao WHERE id_manutencao = '$id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Nenhuma manutenção encontrada.";
    exit();
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Editar Manutenção</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Manutenção</h1>
        <form action="update_manutencao.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id_manutencao']; ?>">
            <div class="form-group">
                <label>ID Veículo</label>
                <input type="number" name="id_veiculo" class="form-control" value="<?php echo $row['id_veiculo']; ?>" required>
            </div>
            <div class="form-group">
                <label>Tipo</label>
                <input type="text" name="tipo" class="form-control" value="<?php echo $row['tipo']; ?>" required>
            </div>
            <div class="form-group">
                <label>Data</label>
                <input type="date" name="data" class="form-control" value="<?php echo $row['data']; ?>" required>
            </div>
            <div class="form-group">
                <label>Custo</label>
                <input type="number" step="0.01" name="custo" class="form-control" value="<?php echo $row['custo']; ?>" required>
            </div>
            <div class="form-group">
                <label>Oficina Responsável</label>
                <input type="text" name="oficina_responsavel" class="form-control" value="<?php echo $row['oficina_responsavel']; ?>" required>
            </div>
            <div class="form-group">
                <label>Peças Trocadas</label>
                <input type="text" name="pecas_trocadas" class="form-control" value="<?php echo $row['pecas_trocadas']; ?>" required>
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control" required><?php echo $row['descricao']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-warning">Atualizar</button>
            <a href="manutencao.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
