<html>
<head>
<title>Alteração de Funcionários</title>
<?php include ('config.php'); // Inclui a conexão com o banco de dados ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css">
</head>

<body>
<!-- Formulário de alteração — o usuário informa a matrícula do funcionário que deseja editar
     e preenche os novos dados nos campos abaixo -->
<form action="funcionarioup.php" method="post" name="form1">
<table width="95%" border="1" align="center">
  <tr>
    <td colspan="6" align="center">Alteração de Funcionários</td>
  </tr>
  <tr>
    <!-- A matrícula é usada como chave para localizar o registro no banco -->
    <td align="right">Matrícula:</td>
    <td><input type="number" name="matricula" /></td>
    <td align="right">Nome:</td>
    <td><input type="text" name="nome" /></td>
    <td align="right">CPF:</td>
    <td><input type="text" name="cpf" /></td>
  </tr>
  <tr>
    <td align="right">Data de Nascimento:</td>
    <td><input type="date" name="data_ncto" /></td>
    <td align="right">Salário:</td>
    <td><input type="text" name="salario" /></td>
    <td colspan="2"><input type="submit" name="botao" value="Alterar" /></td>
  </tr>
</table>
</form>

<?php
// Verifica se o botão "Alterar" foi clicado
if (@$_POST['botao'] == "Alterar") {

    // Captura todos os valores enviados pelo formulário
    $matricula = $_POST['matricula'];
    $nome      = $_POST['nome'];
    $cpf       = $_POST['cpf'];
    $data_ncto = $_POST['data_ncto'];
    $salario   = $_POST['salario'];

    // Monta a query SQL de atualização:
    // atualiza nome, cpf, data de nascimento e salário do funcionário cuja matrícula foi informada
    $altera = "UPDATE funcionario 
               SET nome='$nome', cpf='$cpf', data_ncto='$data_ncto', salario='$salario'
               WHERE matricula='$matricula'";

    // Executa a query; caso falhe, exibe mensagem de erro e encerra
    mysqli_query($mysqli, $altera) or die("Não foi possível alterar os dados");

    // Fecha a conexão com o banco após a operação
    mysqli_close($mysqli);

    // Mensagem de sucesso ao usuário
    echo "Funcionário alterado com sucesso!";
}
?>

<a href="index.html">Home</a>
</body>
</html>