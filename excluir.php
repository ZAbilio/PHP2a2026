<?php
$servidor = "localhost";
$usuario = "aluno";
$senha = "aluno.etec";
$banco = "teste";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
  die("Conexão falhou: " . mysqli_connect_error());
}

$codigo = 0;
if (isset($_GET['cod'])) {
    $codigo = $_GET['cod'];
}
else{
    header('Location: banco.php');
}

$sql = "DELETE FROM alunos WHERE cod = $codigo";

$retorno = mysqli_query($conexao, $sql);

if($retorno == true){
    header('Location: banco.php');
}
else{
    echo "Erro ao excluir o aluno! Erro: " . mysqli_error($conexao);
}

mysqli_close($conexao);

?>
