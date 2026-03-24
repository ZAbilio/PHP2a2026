<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> banco de dados Php</title>
  <form action="/enviar" method="post">
  <label for="nome">Nome:</label>
  <input type="text" id="curso" name="curso" placeholder="Digite o curso: ">
  
  <input type="submit" value="Enviar">
</form>

</head>
<body>
  
</body>
</html>

<?php
$servidor = "localhost";
$usuario = "aluno";
$senha = "aluno.etec";
$banco = "teste";
$curso = "curso;"

// Criar a minha conexão
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco,$curso);

if ($conexao == false) {
  die("Conexão falhou: " . mysqli_connect_error());
}


$sql = "SELECT * FROM cursos";

$retorno = mysqli_query($conexao, $sql);


if (mysqli_num_rows($retorno) > 0) {
  
  while($linha = mysqli_fetch_assoc($retorno)) {
    echo "Codigo: " . $linha["cod"]. " - Curso: " . $linha["curso"]. " Vagas " . $linha["vagas"]. " Periodo " . $linha["periodo"] . "<br>";
  }

} else {
  echo "Nenhum resultado encontrado!";
}

mysqli_close($conexao);

?>