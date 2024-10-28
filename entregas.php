<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT * FROM entrega";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Gerenciar Entregas</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Entregas</h1>
        
        <!-- Botão para Adicionar Entrega -->
        <a href="add_entrega.php" class="btn btn-success mb-3">Adicionar Entrega</a>
        
        <!-- Botão Voltar -->
        <a href="index.php" class="btn btn-secondary mb-3">Voltar</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data/Hora</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Status</th>
                    <th>Peso Carga</th>
                    <th>Tipo Carga</th>
                    <th>Observações</th>
                    <th>Motorista</th>
                    <th>Rota</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_entrega']}</td>
                                <td>{$row['data_hora']}</td>
                                <td>{$row['id_cliente']}</td>
                                <td>{$row['produto']}</td>
                                <td>{$row['status']}</td>
                                <td>{$row['peso_carga']}</td>
                                <td>{$row['tipo_carga']}</td>
                                <td>{$row['observacoes']}</td>
                                <td>{$row['id_motorista']}</td>
                                <td>{$row['id_rota']}</td>
                                <td>
                                    <a href='edit_entrega.php?id={$row['id_entrega']}' class='btn btn-warning'>Editar</a>
                                    <form action='delete_entrega.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='id' value='{$row['id_entrega']}'>
                                        <button type='submit' class='btn btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir esta entrega?\");'>Excluir</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Nenhuma entrega encontrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
