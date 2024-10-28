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
    $id = $_POST['id'];

    $sql = "DELETE FROM cliente WHERE id_cliente = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: clientes.php");
        exit();
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }
}
?>

