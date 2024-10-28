<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT * FROM manutencao";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Gerenciar Manutenção</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Manutenção</h1>
        
        <!-- Botão para Adicionar Manutenção -->
        <a href="add_manutencao.php" class="btn btn-success mb-3">Adicionar Manutenção</a>
        
        <!-- Botão Voltar -->
        <a href="index.php" class="btn btn-secondary mb-3">Voltar</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Veículo</th>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Custo</th>
                    <th>Oficina Responsável</th>
                    <th>Peças Trocadas</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_manutencao']}</td>
                                <td>{$row['id_veiculo']}</td>
                                <td>{$row['tipo']}</td>
                                <td>{$row['data']}</td>
                                <td>{$row['custo']}</td>
                                <td>{$row['oficina_responsavel']}</td>
                                <td>{$row['pecas_trocadas']}</td>
                                <td>{$row['descricao']}</td>
                                <td>
                                    <a href='edit_manutencao.php?id={$row['id_manutencao']}' class='btn btn-warning'>Editar</a>
                                    <form action='delete_manutencao.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='id' value='{$row['id_manutencao']}'>
                                        <button type='submit' class='btn btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir esta manutenção?\");'>Excluir</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Nenhuma manutenção encontrada.</td></tr>";
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
