<?php
// Configurações do banco
$host = "localhost";
$user = "root";
$password = "";
$dbname = "biblioteca";  // nome do banco conforme seu print

// Criar conexão
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_de_nascimento'];
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
        echo "As senhas não coincidem. Tente novamente.";
        exit;
    }

    // Criptografar a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Preparar a query
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, cpf, data_nascimento, sexo, endereco, bairro, cidade, cep, email, telefone, usuario, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Assumindo que a estrutura da tabela está correta com todas essas colunas
    $stmt->bind_param("ssssssssssss", $nome, $cpf, $data_nascimento, $sexo, $endereco, $bairro, $cidade, $cep, $email, $telefone, $usuario, $senha_hash);

    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Formulário não enviado corretamente.";
}

$conn->close();
?>
