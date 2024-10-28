<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT * FROM rota";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Gerenciar Rotas</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Rotas</h1>
        
        <!-- Botão para Adicionar Rota -->
        <a href="add_rota.php" class="btn btn-success mb-3">Adicionar Rota</a>
        
        <!-- Botão Voltar -->
        <a href="index.php" class="btn btn-secondary mb-3">Voltar</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Origem</th>
                    <th>Destino</th>
                    <th>Distância</th>
                    <th>Tempo Estimado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_rota']}</td>
                                <td>{$row['origem']}</td>
                                <td>{$row['destino']}</td>
                                <td>{$row['distancia']}</td>
                                <td>{$row['tempo_estimado']}</td>
                                <td>
                                    <a href='edit_rota.php?id={$row['id_rota']}' class='btn btn-warning'>Editar</a>
                                    <form action='delete_rota.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='id' value='{$row['id_rota']}'>
                                        <button type='submit' class='btn btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir esta rota?\");'>Excluir</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhuma rota encontrada.</td></tr>";
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
