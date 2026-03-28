<html>
<head>
<title>Exclusão de Funcionários</title>
<?php include ('config.php'); // Inclui a conexão com o banco de dados ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css">

</head>

<body>
<!-- Formulário de exclusão — envia os dados para esta mesma página via POST -->
<form action="funcionariodel.php" method="post" name="form1">
<table width="95%" border="1" align="center">
  <tr>
    <td colspan="4" align="center">Exclusão de Funcionários</td>
  </tr>
  <tr>
    <!-- O usuário pode buscar e excluir por matrícula OU por nome -->
    <td width="18%" align="right">Matrícula:</td>
    <td width="26%"><input type="number" name="matricula" /></td>
    <td width="18%" align="right">Nome:</td>
    <td width="26%"><input type="text" name="nome" /></td>
    <td width="21%"><input type="submit" name="botao" value="Excluir" /></td>
  </tr>
</table>
</form>

<?php
// Verifica se o botão "Excluir" foi clicado
if (@$_POST['botao'] == "Excluir") {

    // Captura os valores enviados pelo formulário
    $matricula = $_POST['matricula'];
    $nome      = $_POST['nome'];

    // Executa a query de exclusão:
    // usa OR para excluir se a matrícula OU o nome corresponderem ao informado
    mysqli_query($mysqli, "DELETE FROM funcionario WHERE matricula='$matricula' OR nome='$nome'");

    // Fecha a conexão com o banco de dados após a operação
    mysqli_close($mysqli);

    // Mensagem de confirmação para o usuário
    echo "Funcionário excluído com sucesso!";
}
?>

<a href="index.html">Home</a>
</body>
</html>