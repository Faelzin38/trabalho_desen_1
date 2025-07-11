<?php
// Configurações do banco
$host = "localhost";
$user = "root";
$password = "";
$dbname = "biblioteca";

// Criar conexão
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    header("Location: usuario.html?status=erro&message=" . urlencode("Falha na conexão com o banco de dados."));
    exit;
}

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_de_nascimento']; // Esta variável está correta, é do HTML
    $sexo = $_POST['sexo'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    if ($senha !== $confirmar_senha) {
        header("Location: usuario.html?status=erro&message=" . urlencode("As senhas não coincidem. Tente novamente."));
        exit;
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Preparar a query - AQUI ESTÁ A MUDANÇA
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, cpf, data_de_nascimento, sexo, endereco, bairro, cidade, cep, email, telefone, usuario, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    //                             ^^^ Adicionei "_de_" aqui para corresponder ao seu banco de dados

    $stmt->bind_param("ssssssssssss", $nome, $cpf, $data_nascimento, $sexo, $endereco, $bairro, $cidade, $cep, $email, $telefone, $usuario, $senha_hash);

    if ($stmt->execute()) {
        header("Location: usuario.html?status=sucesso");
        exit;
    } else {
        header("Location: usuario.html?status=erro&message=" . urlencode("Erro ao cadastrar usuário: " . $stmt->error));
        exit;
    }

    $stmt->close();
} else {
    header("Location: usuario.html?status=erro&message=" . urlencode("Formulário não enviado corretamente."));
    exit;
}

$conn->close();
?>