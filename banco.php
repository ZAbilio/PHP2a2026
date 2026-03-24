<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Banco de dados PHP</title>
</head>
<body>

<form method="POST">
  <label>Curso:</label>
  <input type="text" name="curso" placeholder="Digite o curso">
  <input type="submit" value="Pesquisar">
</form>

<?php
$servidor = "localhost";
$usuario = "aluno";
$senha = "aluno.etec";
$banco = "teste";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
  die("Erro: " . mysqli_connect_error());
}


$curso = isset($_POST['curso']) ? $_POST['curso'] : "";


if ($curso != "") {
  $sql = "SELECT * FROM cursos WHERE curso LIKE '%$curso%'";
} else {
  $sql = "SELECT * FROM cursos";
}

$retorno = mysqli_query($conexao, $sql);


if (mysqli_num_rows($retorno) > 0) {
  while($linha = mysqli_fetch_assoc($retorno)) {
    echo "Código: " . $linha["cod"] .
         " - Curso: " . $linha["curso"] .
         " - Vagas: " . $linha["vagas"] .
         " - Período: " . $linha["periodo"] . "<br>";
  }
} else {
  echo "Nenhum resultado encontrado!";
}

mysqli_close($conexao);
?>

</body>
</html>