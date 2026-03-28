<?php
// ============================================================
// config.php — Configuração da conexão com o banco de dados
// Esse arquivo é incluído por todas as outras páginas PHP
// ============================================================

// Endereço do servidor de banco de dados (localhost = mesma máquina)
$hostName = "localhost";

// Nome do banco de dados que será utilizado
$dataBase = "ariane_pedro";

// Usuário do banco de dados
$user     = "root";

// Senha do banco de dados (vazia neste ambiente de desenvolvimento)
$password = "";

// Cria a conexão com o banco usando a classe mysqli (MySQL Improved)
$mysqli = new mysqli($hostName, $user, $password, $dataBase);

// Verifica se houve erro na conexão
// connect_errno retorna um número diferente de zero se houve falha
if ($mysqli->connect_errno) {
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>