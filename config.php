<?php

$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'biblioteca';

$conexao = new mysqli ($dbHost, $dbUser, $dbPass, $dbName);

if ($mysqli_connect_errno) {
    echo 'Erro : ( ' .$mysqli->connect_errno . ') ' . $mysqli->connect_error;
}
 
else {
    echo 'Conexão realizada com sucesso';
}

?>