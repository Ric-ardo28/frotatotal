<?php
$servername = "localhost:3307";
$username = "root"; 
$password = "";
$dbname = "frotatotal3";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM entrega WHERE id_entrega = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: entregas.php");
        exit();
    } else {
        echo "Erro ao excluir entrega: " . $conn->error;
    }
}

$conn->close();
?>
