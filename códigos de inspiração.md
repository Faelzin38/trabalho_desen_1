✅ Objetivo agora:
Criar o banco de dados + tabela de usuários no phpMyAdmin, e depois conectar com PHP ao banco usando seu formulário de cadastro/login.

🧩 Etapa 1 – Iniciar o XAMPP
Abra o XAMPP Control Panel

Inicie os módulos:

✅ Apache

✅ MySQL

🛠 Etapa 2 – Criar o banco de dados no phpMyAdmin
No navegador, acesse:

arduino
Copiar
Editar
http://localhost/phpmyadmin
Clique em "Novo" no menu esquerdo.

Nomeie o banco como:

nginx
Copiar
Editar
biblioteca
Clique em "Criar"

Agora, com o banco selecionado, crie uma tabela chamada usuarios com os seguintes campos:

Nome do Campo	Tipo	Comprimento	Extra
id	INT	11	AUTO_INCREMENT, PRIMARY KEY
nome	VARCHAR	100	
email	VARCHAR	100	UNIQUE
senha	VARCHAR	255	

Clique em Salvar.

📌 Pronto! Banco e tabela criados.

🔗 Etapa 3 – Conectar o site com o banco (arquivo PHP)
Crie um arquivo chamado conexao.php:

php
Copiar
Editar
<?php
$host = "localhost";
$user = "root";
$senha = ""; // senha em branco no XAMPP por padrão
$banco = "biblioteca";

// cria conexão
$conexao = new mysqli($host, $user, $senha, $banco);

// verifica conexão
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
?>
🧾 Etapa 4 – Exemplo de cadastro (arquivo cadastrar.php)
php
Copiar
Editar
<?php
include("conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

if ($conexao->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro: " . $conexao->error;
}

$conexao->close();
?>
🖼 Etapa 5 – Seu formulário HTML (exemplo)
html
Copiar
Editar
<form action="cadastrar.php" method="POST">
  <input type="text" name="nome" placeholder="Seu nome" required>
  <input type="email" name="email" placeholder="Seu email" required>
  <input type="password" name="senha" placeholder="Sua senha" required>
  <button type="submit">Cadastrar</button>
</form>
📁 Salve tudo na pasta:

makefile
Copiar
Editar
C:\xampp\htdocs\nome_do_seu_projeto
Depois acesse:

arduino
Copiar
Editar
http://localhost/nome_do_seu_projeto
