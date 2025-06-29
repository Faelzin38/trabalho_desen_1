<?php
// Inclui o arquivo de conexão com o banco de dados
include_once 'conexao.php'; // Garanta que o caminho para 'conexao.php' está correto

// Verifica se a requisição foi feita via método POST (envio do formulário)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Coleta os dados do formulário e sanitiza (escapa caracteres especiais para evitar SQL Injection)
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
    $data_de_nascimento = mysqli_real_escape_string($conexao, $_POST['data_de_nascimento']);
    $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
    $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
    $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
    $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
    $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $telefone = mysqli_real_escape_string($conexao, $_POST['telefone']);
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    $confirmar_senha = mysqli_real_escape_string($conexao, $_POST['confirmar_senha']);

    // Validação de senha (exemplo simples: verifica se as senhas coincidem)
    if ($senha !== $confirmar_senha) {
        die("As senhas não coincidem. Por favor, volte e tente novamente.");
    }

    // Opcional: Criptografar a senha antes de salvar no banco de dados é uma boa prática de segurança
    // Use password_hash() para armazenar senhas de forma segura
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // SQL para inserir os dados na tabela
    // **ATENÇÃO**: Substitua 'usuarios' pelo nome real da sua tabela de usuários
    // E certifique-se de que os nomes das colunas (ex: nome_completo, cpf, data_nasc)
    // correspondem EXATAMENTE aos nomes das colunas no seu banco de dados.
    $sql = "INSERT INTO usuarios (nome_completo, cpf, data_nasc, sexo, endereco, bairro, cidade, cep, email, telefone, nome_usuario, senha_hash)
            VALUES ('$nome', '$cpf', '$data_de_nascimento', '$sexo', '$endereco', '$bairro', '$cidade', '$cep', '$email', '$telefone', '$usuario', '$senha_hash')";

    // Executa a consulta
    if (mysqli_query($conexao, $sql)) {
        // Redireciona para a página de sucesso ou login após o cadastro
        // Esta é a forma mais comum de lidar com sucesso após o envio de formulário
        header("Location: index.html?cadastro=sucesso"); // Redireciona para a página inicial com um parâmetro de sucesso
        exit(); // Garante que o script seja encerrado após o redirecionamento
    } else {
        // Se houver erro na inserção
        echo "Erro ao cadastrar usuário: " . mysqli_error($conexao);
        // Opcional: Redirecionar para uma página de erro ou exibir uma mensagem mais amigável
        // header("Location: erro.html?msg=" . urlencode(mysqli_error($conexao)));
        // exit();
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);

} else {
    // Se alguém tentar acessar processa_cadastro.php diretamente sem enviar o formulário
    echo "Acesso inválido. Por favor, preencha o formulário de cadastro.";
}
?>