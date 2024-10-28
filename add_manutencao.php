<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_veiculo = $_POST['id_veiculo'];
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $custo = $_POST['custo'];
    $oficina_responsavel = $_POST['oficina_responsavel'];
    $pecas_trocadas = $_POST['pecas_trocadas'];
    $descricao = $_POST['descricao'];

    // Validação da data
    $dateTime = DateTime::createFromFormat('Y-m-d', $data);
    if ($dateTime && $dateTime->format('Y-m-d') === $data) {
        // A data está no formato correto, prossiga para a inserção
        $sql = "INSERT INTO manutencao (id_veiculo, tipo, data, custo, oficina_responsavel, pecas_trocadas, descricao) VALUES ('$id_veiculo', '$tipo', '$data', '$custo', '$oficina_responsavel', '$pecas_trocadas', '$descricao')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: manutencao.php");
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Caso contrário, lance um erro ou trate de acordo
        echo "Data inválida.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Adicionar Manutenção</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Adicionar Manutenção</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label>ID Veículo</label>
                <input type="number" name="id_veiculo" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tipo</label>
                <input type="text" name="tipo" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Data</label>
                <input type="date" name="data" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Custo</label>
                <input type="number" step="0.01" name="custo" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Oficina Responsável</label>
                <input type="text" name="oficina_responsavel" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Peças Trocadas</label>
                <input type="text" name="pecas_trocadas" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Descrição</label>
                <textarea name="descricao" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Adicionar</button>
            <a href="manutencao.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
