<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifique se o ID da rota foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obter os dados da rota existente
    $sql = "SELECT * FROM rota WHERE id_rota = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rota = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Receber os dados do formulário
        $origem = $_POST['origem'];
        $destino = $_POST['destino'];
        $distancia = $_POST['distancia'];
        $tempo_estimado = $_POST['tempo_estimado'];

        // Validação do tempo estimado
        list($horas, $minutos, $segundos) = explode(':', $tempo_estimado);
        
        // Ajustar segundos se necessário
        if ($segundos >= 60) {
            $segundos = 59; // Ajustar para o valor máximo permitido
        }

        // Ajustar minutos se necessário
        if ($minutos >= 60) {
            $minutos = 59; // Ajustar para o valor máximo permitido
        }

        // Formatar corretamente
        $tempo_estimado_corrigido = sprintf('%02d:%02d:%02d', $horas, $minutos, $segundos);

        // Atualizar os dados da rota no banco de dados
        $sql = "UPDATE rota SET origem = ?, destino = ?, distancia = ?, tempo_estimado = ? WHERE id_rota = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $origem, $destino, $distancia, $tempo_estimado_corrigido, $id);
        
        if ($stmt->execute()) {
            echo "Rota atualizada com sucesso!";
            header("Location: rotas.php"); // Redirecionar após a atualização
            exit();
        } else {
            echo "Erro ao atualizar a rota: " . $conn->error;
        }
    }
} else {
    echo "ID da rota não especificado.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Editar Rota</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Rota</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="origem">Origem</label>
                <input type="text" class="form-control" name="origem" value="<?php echo $rota['origem']; ?>" required>
            </div>
            <div class="form-group">
                <label for="destino">Destino</label>
                <input type="text" class="form-control" name="destino" value="<?php echo $rota['destino']; ?>" required>
            </div>
            <div class="form-group">
                <label for="distancia">Distância</label>
                <input type="text" class="form-control" name="distancia" value="<?php echo $rota['distancia']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tempo_estimado">Tempo Estimado (HH:MM:SS)</label>
                <input type="text" class="form-control" name="tempo_estimado" value="<?php echo $rota['tempo_estimado']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="rotas.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>
