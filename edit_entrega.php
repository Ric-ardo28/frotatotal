if ($conn->query($sql) === TRUE) {
        header("Location: entregas.php");
        exit();
    } else {
        echo "Erro ao atualizar entrega: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Editar Entrega</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Entrega</h1>
        <form method="POST">
            <div class="form-group">
                <label>Data/Hora:</label>
                <input type="datetime-local" name="data_hora" class="form-control" value="<?php echo $row['data_hora']; ?>" required>
            </div>
            <div class="form-group">
                <label>ID Cliente:</label>
                <input type="number" name="id_cliente" class="form-control" value="<?php echo $row['id_cliente']; ?>" required>
            </div>
            <div class="form-group">
                <label>Produto:</label>
                <input type="text" name="produto" class="form-control" value="<?php echo $row['produto']; ?>" required>
            </div>
            <div class="form-group">
                <label>Status:</label>
                <select name="status" class="form-control" required>
                    <option value="PENDENTE" <?php echo ($row['status'] == 'PENDENTE') ? 'selected' : ''; ?>>PENDENTE</option>
                    <option value="EM_TRANSITO" <?php echo ($row['status'] == 'EM_TRANSITO') ? 'selected' : ''; ?>>EM TRANSITO</option>
                    <option value="ENTREGUE" <?php echo ($row['status'] == 'ENTREGUE') ? 'selected' : ''; ?>>ENTREGUE</option>
                    <option value="CANCELADA" <?php echo ($row['status'] == 'CANCELADA') ? 'selected' : ''; ?>>CANCELADA</option>
                </select>
            </div>
            <div class="form-group">
                <label>Peso Carga:</label>
                <input type="number" name="peso_carga" step="0.01" class="form-control" value="<?php echo $row['peso_carga']; ?>" required>
            </div>
            <div class="form-group">
                <label>Tipo Carga:</label>
                <input type="text" name="tipo_carga" class="form-control" value="<?php echo $row['tipo_carga']; ?>" required>
            </div>
            <div class="form-group">
                <label>Observações:</label>
                <textarea name="observacoes" class="form-control"><?php echo $row['observacoes']; ?></textarea>
            </div>
            <div class="form-group">
                <label>ID Motorista:</label>
                <input type="number" name="id_motorista" class="form-control" value="<?php echo $row['id_motorista']; ?>" required>
            </div>
            <div class="form-group">
                <label>ID Rota:</label>
                <input type="number" name="id_rota" class="form-control" value="<?php echo $row['id_rota']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Entrega</button>
            <a href="entregas.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
