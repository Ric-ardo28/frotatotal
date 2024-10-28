<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT * FROM cliente";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Gerenciar Clientes</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Clientes</h1>
        
        <!-- Botão para Adicionar Cliente -->
        <a href="add_cliente.php" class="btn btn-success mb-3">Adicionar Cliente</a>
        
        <!-- Botão Voltar -->
        <a href="index.php" class="btn btn-secondary mb-3">Voltar</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_cliente']}</td>
                                <td>{$row['nome']}</td>
                                <td>{$row['endereco']}</td>
                                <td>
                                    <a href='edit_cliente.php?id={$row['id_cliente']}' class='btn btn-warning'>Editar</a>
                                    <form action='delete_cliente.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='id' value='{$row['id_cliente']}'>
                                        <button type='submit' class='btn btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir este cliente?\");'>Excluir</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhum cliente encontrado.</td></tr>";
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
