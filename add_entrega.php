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
    $data_hora = $_POST['data_hora'];
    $id_cliente = $_POST['id_cliente'];
    $produto = $_POST['produto'];
    $status = $_POST['status'];
    $peso_carga = $_POST['peso_carga'];
    $tipo_carga = $_POST['tipo_carga'];
    $observacoes = $_POST['observacoes'];
    $id_motorista = $_POST['id_motorista'];
    $id_rota = $_POST['id_rota'];

    $sql = "INSERT INTO entrega (data_hora, id_cliente, produto, status, peso_carga, tipo_carga, observacoes, id_motorista, id_rota)
            VALUES ('$data_hora', $id_cliente, '$produto', '$status', $peso_carga, '$tipo_carga', '$observacoes', $id_motorista, $id_rota)";

    if ($conn->query($sql) === TRUE) {
        header("Location: entregas.php");
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
    <title>Adicionar Entrega</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Adicionar Entrega</h1>
        <form method="POST">
            <div class="form-group">
                <label>Data/Hora:</label>
                <input type="datetime-local" name="data_hora" class="form-control" required>
            </div>
            <div class="form-group">
                <label>ID Cliente:</label>
                <input type="number" name="id_cliente" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Produto:</label>
                <input type="text" name="produto" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Status:</label>
                <select name="status" class="form-control" required>
                    <option value="PENDENTE">PENDENTE</option>
                    <option value="EM_TRANSITO">EM TRANSITO</option>
                    <option value="ENTREGUE">ENTREGUE</option>
                    <option value="CANCELADA">CANCELADA</option>
                </select>
            </div>
            <div class="form-group">
                <label>Peso Carga:</label>
                <input type="number" name="peso_carga" step="0.01" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Tipo Carga:</label>
                <input type="text" name="tipo_carga" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Observações:</label>
                <textarea name="observacoes" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>ID Motorista:</label>
                <input type="number" name="id_motorista" class="form-control" required>
            </div>
            <div class="form-group">
                <label>ID Rota:</label>
                <input type="number" name="id_rota" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Entrega</button>
            <a href="entregas.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
