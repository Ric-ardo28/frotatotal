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
    $id_motorista = $_POST['id_motorista'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $habilitacao = $_POST['habilitacao'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $data_nascimento = $_POST['data_nascimento'];
    $categoria_habilitacao = $_POST['categoria_habilitacao'];

    $sql = "UPDATE motorista SET 
            nome='$nome', 
            cpf='$cpf', 
            habilitacao='$habilitacao', 
            telefone='$telefone', 
            endereco='$endereco', 
            data_nascimento='$data_nascimento', 
            categoria_habilitacao='$categoria_habilitacao' 
            WHERE id_motorista=$id_motorista";

    if ($conn->query($sql) === TRUE) {
        echo "Motorista atualizado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<a href="index.php">Voltar para a página inicial</a>
