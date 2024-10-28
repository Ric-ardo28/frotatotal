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
    $id = $_POST['id'];
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];
    $ano_fabricacao = $_POST['ano_fabricacao'];
    $capacidade_carga = $_POST['capacidade_carga'];
    $cor = $_POST['cor'];
    $combustivel = $_POST['combustivel'];
    $quilometragem = $_POST['quilometragem'];
    $ultima_revisao = $_POST['ultima_revisao'];
    $id_motorista = $_POST['id_motorista'];

    $sql = "UPDATE veiculo SET modelo='$modelo', placa='$placa', ano_fabricacao=$ano_fabricacao, capacidade_carga=$capacidade_carga, cor='$cor', combustivel='$combustivel', quilometragem=$quilometragem, ultima_revisao='$ultima_revisao', id_motorista=$id_motorista WHERE id_veiculo=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Veículo atualizado com sucesso!'); window.location.href='veiculos.php';</script>";
    } else {
        echo "Erro ao atualizar veículo: " . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM veiculo WHERE id_veiculo = $id";
    $result = $conn->query($sql);
    $veiculo = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Editar Veículo</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Veículo</h1>
        <a href="veiculos.php" class="btn btn-secondary mb-3">Voltar</a>

        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo $veiculo['id_veiculo']; ?>">
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" name="modelo" value="<?php echo $veiculo['modelo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="placa">Placa</label>
                <input type="text" class="form-control" name="placa" value="<?php echo $veiculo['placa']; ?>" required>
            </div>
            <div class="form-group">
                <label for="ano_fabricacao">Ano de Fabricação</label>
                <input type="number" class="form-control" name="ano_fabricacao" value="<?php echo $veiculo['ano_fabricacao']; ?>" required>
            </div>
            <div class="form-group">
                <label for="capacidade_carga">Capacidade de Carga (kg)</label>
                <input type="number" class="form-control" name="capacidade_carga" value="<?php echo $veiculo['capacidade_carga']; ?>" required>
            </div>
            <div class="form-group">
                <label for="cor">Cor</label>
                <input type="text" class="form-control" name="cor" value="<?php echo $veiculo['cor']; ?>" required>
            </div>
            <div class="form-group">
                <label for="combustivel">Combustível</label>
                <input type="text" class="form-control" name="combustivel" value="<?php echo $veiculo['combustivel']; ?>" required>
            </div>
            <div class="form-group">
                <label for="quilometragem">Quilometragem</label>
                <input type="number" class="form-control" name="quilometragem" value="<?php echo $veiculo['quilometragem']; ?>" required>
            </div>
            <div class="form-group">
                <label for="ultima_revisao">Última Revisão</label>
                <input type="date" class="form-control" name="ultima_revisao" value="<?php echo $veiculo['ultima_revisao']; ?>" required>
            </div>
            <div class="form-group">
                <label for="id_motorista">ID do Motorista</label>
                <input type="number" class="form-control" name="id_motorista" value="<?php echo $veiculo['id_motorista']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Veículo</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
