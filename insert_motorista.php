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
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $habilitacao = $_POST['habilitacao'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $data_nascimento = $_POST['data_nascimento'];
    $categoria_habilitacao = $_POST['categoria_habilitacao'];

    $sql = "INSERT INTO motorista (nome, cpf, habilitacao, telefone, endereco, data_nascimento, categoria_habilitacao) 
            VALUES ('$nome', '$cpf', '$habilitacao', '$telefone', '$endereco', '$data_nascimento', '$categoria_habilitacao')";

    if ($conn->query($sql) === TRUE) {
        echo "Motorista adicionado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<a href="add_motorista.php">Adicionar outro motorista</a>
<a href="index.php">Voltar para a página inicial</a>
