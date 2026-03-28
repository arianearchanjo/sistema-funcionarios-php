<html>
<head>
<title>Relatório de Funcionários</title>
<?php include ('config.php'); // Inclui a conexão com o banco de dados ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css">
</head>

<body>
<!-- Formulário de pesquisa — filtra o relatório por nome e/ou CPF -->
<form action="funcionariolst.php" method="post" name="form1">
<table width="95%" border="1" align="center">
  <tr>
    <td colspan="5" align="center">Relatório de Funcionários</td>
  </tr>
  <tr>
    <!-- Campos opcionais de filtro: deixar em branco lista todos os funcionários -->
    <td width="18%" align="right">Nome:</td>
    <td width="26%"><input type="text" name="nome" /></td>
    <td width="17%" align="right">CPF:</td>
    <td width="18%"><input type="text" name="cpf" size="15" /></td>
    <td width="21%"><input type="submit" name="botao" value="Gerar" /></td>
  </tr>
</table>
</form>

<?php
// Só executa o relatório se o botão "Gerar" foi clicado
if (@$_POST['botao'] == "Gerar") {

    // Captura os filtros digitados pelo usuário
    $nome = $_POST['nome'];
    $cpf  = $_POST['cpf'];

    // Obtém o número do mês atual (ex: "03" para março)
    // Usado para identificar aniversariantes do mês
    $mes_atual = date("m");
?>

<!-- Tabela de resultados do relatório -->
<table width="95%" border="1" align="center">
  <tr bgcolor="#9999FF">
    <!-- Cabeçalho das colunas -->
    <th>Matrícula</th>
    <th>Nome</th>
    <th>CPF</th>
    <th>Data Nasc.</th>
    <th>Salário R$</th>
    <th>Bônus R$</th>
    <th>Total R$</th>
  </tr>

<?php
    // Monta a query base — traz todos os funcionários com matrícula válida
    $query = "SELECT * FROM funcionario WHERE matricula > 0 ";

    // Se um nome foi informado, adiciona filtro com LIKE (busca parcial, sem distinção de maiúsculas)
    $query .= ($nome ? " AND nome LIKE '%$nome%' " : "");

    // Se um CPF foi informado, adiciona filtro com igualdade exata
    $query .= ($cpf  ? " AND cpf = '$cpf' "        : "");

    // Ordena o resultado alfabeticamente pelo nome
    $query .= " ORDER BY nome";

    // Executa a query e armazena o resultado
    $result = mysqli_query($mysqli, $query);

    // Percorre linha a linha o resultado retornado pelo banco
    while ($coluna = mysqli_fetch_array($result)) {

        // Extrai apenas o número do mês da data de nascimento do funcionário
        $mes_nascimento = date("m", strtotime($coluna['data_ncto']));

        // Regra de negócio: funcionários que fazem aniversário no mês atual
        // recebem um bônus de 10% sobre o salário
        if ($mes_nascimento == $mes_atual) {
            $bonus = $coluna['salario'] * 0.10;
        } else {
            $bonus = 0; // Sem bônus para os demais
        }

        // Calcula o total (salário + bônus)
        $total = $coluna['salario'] + $bonus;
?>
    <!-- Linha de dados de cada funcionário -->
    <tr>
      <td><?php echo $coluna['matricula']; ?></td>
      <td><?php echo $coluna['nome']; ?></td>
      <td><?php echo $coluna['cpf']; ?></td>
      <!-- Formata a data de nascimento para o padrão brasileiro DD/MM/AAAA -->
      <td><?php echo date("d/m/Y", strtotime($coluna['data_ncto'])); ?></td>
      <!-- Formata o salário com 2 casas decimais, vírgula como separador decimal e ponto como milhar -->
      <td>R$ <?php echo number_format($coluna['salario'], 2, ',', '.'); ?></td>
      <!-- Exibe o bônus formatado, ou um traço "-" se não houver bônus -->
      <td><?php echo ($bonus > 0 ? "R$ " . number_format($bonus, 2, ',', '.') : "-"); ?></td>
      <!-- Exibe o total (salário + bônus) formatado -->
      <td>R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
    </tr>
<?php
    } // fim do while — todos os funcionários foram listados
?>
</table>

<?php
} // fim do if — só exibe a tabela quando o formulário foi enviado
?>

<a href="index.html">Home</a>
</body>
</html>