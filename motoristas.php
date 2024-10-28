<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$sql = "SELECT * FROM motorista";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Gerenciar Motoristas</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Motoristas</h1>
        
        <!-- Botão para Adicionar Motorista -->
        <a href="add_motorista.php" class="btn btn-success mb-3">Adicionar Motorista</a>
        
        <!-- Botão Voltar -->
        <a href="index.php" class="btn btn-secondary mb-3">Voltar</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Habilitação</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Data de Nascimento</th>
                    <th>Categoria Habilitação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id_motorista']}</td>
                                <td>{$row['nome']}</td>
                                <td>{$row['cpf']}</td>
                                <td>{$row['habilitacao']}</td>
                                <td>{$row['telefone']}</td>
                                <td>" . (isset($row['endereco']) ? $row['endereco'] : 'N/A') . "</td>
                                <td>" . (isset($row['data_nascimento']) ? $row['data_nascimento'] : 'N/A') . "</td>
                                <td>" . (isset($row['categoria_habilitacao']) ? $row['categoria_habilitacao'] : 'N/A') . "</td>
                                <td>
                                    <a href='edit_motorista.php?id={$row['id_motorista']}' class='btn btn-warning'>Editar</a>
                                    <form action='delete_motorista.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='id' value='{$row['id_motorista']}'>
                                        <button type='submit' class='btn btn-danger' onclick='return confirm(\"Tem certeza que deseja excluir este motorista?\");'>Excluir</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Nenhum motorista encontrado.</td></tr>";
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
