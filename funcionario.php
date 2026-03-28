<html>
<head>
<title>Cadastro de Funcionários</title>

<?php include ('config.php'); // Inclui o arquivo de conexão com o banco de dados ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css"> <!-- Importa o arquivo de estilos -->

</head>

<body>
<!-- Formulário de cadastro — ao clicar em "Gravar", envia os dados para esta mesma página (action="funcionario.php") via POST -->
<form action="funcionario.php" method="post" name="funcionario">
<table width="300" border="1">
  <tr>
    <td colspan="2">Cadastro de Funcionários</td>
  </tr>
  <tr>
    <!-- A matrícula é gerada automaticamente pelo banco (AUTO_INCREMENT), por isso aparece em branco -->
    <td width="100">Matrícula</td>
    <td width="200">&nbsp;</td>
  </tr>
  <tr>
    <td>Nome:</td>
    <td><input type="text" name="nome"></td>
  </tr>
  <tr>
    <td>CPF:</td>
    <td><input type="text" name="cpf"></td>
  </tr>
  <tr>
    <td>Data de Nascimento:</td>
    <td><input type="date" name="data_ncto"></td>
  </tr>
  <tr>
    <td>Salário:</td>
    <td><input type="text" name="salario"></td>
  </tr>
  <tr>
    <!-- Botão de envio do formulário -->
    <td colspan="2" align="right"><input type="submit" value="Gravar" name="botao"></td>
  </tr>
</table>
</form>

<?php
// Verifica se o botão "Gravar" foi clicado (ou seja, se o formulário foi enviado)
// O @ antes de $_POST suprime avisos caso a variável não exista ainda
if (@$_POST['botao'] == "Gravar") {

    // Captura os valores enviados pelo formulário via POST
    $nome      = $_POST['nome'];
    $cpf       = $_POST['cpf'];
    $data_ncto = $_POST['data_ncto'];
    $salario   = $_POST['salario'];

    // Monta a query SQL de inserção (a matrícula não é informada pois é AUTO_INCREMENT)
    $insere = "INSERT INTO funcionario (nome, cpf, data_ncto, salario)
               VALUES ('$nome', '$cpf', '$data_ncto', '$salario')";

    // Executa a query no banco; caso falhe, exibe mensagem de erro e encerra
    mysqli_query($mysqli, $insere) or die("Não foi possível inserir os dados");

    // Mensagem de sucesso exibida ao usuário
    echo "Funcionário cadastrado com sucesso!";
}
?>

<a href="index.html">Home</a>
</body>
</html>