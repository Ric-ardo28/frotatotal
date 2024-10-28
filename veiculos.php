<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT * FROM veiculo";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Veículos</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Veículos</h1>
        <a href="add_veiculo.php" class="btn btn-success mb-3">Adicionar Veículo</a>
        <a href="index.php" class="btn btn-secondary mb-3">Voltar</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Placa</th>
                    <th>Ano de Fabricação</th>
                    <th>Capacidade de Carga (kg)</th>
                    <th>Cor</th>
                    <th>Combustível</th>
                    <th>Quilometragem</th>
                    <th>Última Revisão</th>
                    <th>ID do Motorista</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_veiculo']; ?></td>
                            <td><?php echo $row['modelo']; ?></td>
                            <td><?php echo $row['placa']; ?></td>
                            <td><?php echo $row['ano_fabricacao']; ?></td>
                            <td><?php echo $row['capacidade_carga']; ?></td>
                            <td><?php echo $row['cor']; ?></td>
                            <td><?php echo $row['combustivel']; ?></td>
                            <td><?php echo $row['quilometragem']; ?></td>
                            <td><?php echo !empty($row['ultima_revisao']) ? date('d/m/Y', strtotime($row['ultima_revisao'])) : 'N/A'; ?></td>
                            <td><?php echo $row['id_motorista']; ?></td>
                            <td>
                                <a href="edit_veiculo.php?id=<?php echo $row['id_veiculo']; ?>" class="btn btn-warning">Editar</a>
                                <a href="delete_veiculo.php?id=<?php echo $row['id_veiculo']; ?>" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11">Nenhum veículo encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
