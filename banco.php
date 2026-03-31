<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cursos - Exemplo de Aula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<?php
$servidor = "localhost";
$usuario = "aluno";
$senha = "aluno.etec";
$banco = "teste";

// Criar conexão
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
  die("Conexão falhou: " . mysqli_connect_error());
}

// Capturar busca
$busca = "";
if (isset($_POST['busca'])) {
  $busca = $_POST['busca'];
}

// Query com filtro
if ($busca != "") {
  $sql = "SELECT * FROM cursos WHERE curso LIKE '%$busca%'";
} else {
  $sql = "SELECT * FROM cursos";
}

$retorno = mysqli_query($conexao, $sql);
?>
<body class="bg-light">

    <!-- Cabeçalho -->
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="display-5 text-primary fw-bold">
                    <i class="bi bi-mortarboard-fill"></i> Catálogo de Cursos
                </h1>
                <p class="text-muted">Exemplo de conexão PHP + MySQL com Bootstrap</p>
            </div>
        </div>

        <!-- Formulário de Busca -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form action="" method="POST" class="d-flex shadow-sm">
                    <input type="text" name="busca" class="form-control form-control-lg" 
                           placeholder="Buscar por nome do curso..." 
                           value="<?php echo htmlspecialchars($busca); ?>">
                    <button class="btn btn-primary btn-lg" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                     
                    <a class="btn btn-success btn-lg" href="inserir.php">
                        <i class="bi bi-save"></i> Cadastrar
                    </a>
                </form>
            </div>
        </div>

        <!-- Resultados -->
        <div class="row">
            <?php
            // Verifica se retornou resultados
            if (mysqli_num_rows($retorno) > 0) {
                
                // Laço de repetição para criar um Card para cada curso
                while($linha = mysqli_fetch_assoc($retorno)) {
                    ?>
                    <!-- Card do Curso -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-success fw-bold">
                                    <i class="bi bi-bookmark-star-fill"></i> 
                                    <?php echo htmlspecialchars($linha["curso"]); ?>
                                </h5>
                                <hr>
                                <p class="card-text">
                                    <span class="badge bg-secondary">Código: <?php echo $linha["cod"]; ?></span>
                                </p>
                                <p class="card-text mb-1">
                                    <i class="bi bi-people-fill text-primary"></i> 
                                    <strong>Vagas:</strong> <?php echo $linha["vagas"]; ?>
                                </p>
                                <p class="card-text">
                                    <i class="bi bi-clock-fill text-warning"></i> 
                                    <strong>Período:</strong> <?php echo htmlspecialchars($linha["periodo"]); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                
            } else {
                // Mensagem caso não encontre nada
                echo "
                <div class='col-12'>
                    <div class='alert alert-warning text-center' role='alert'>
                        <i class='bi bi-exclamation-triangle-fill'></i>
                        Nenhum resultado encontrado para a busca: <strong>'" . htmlspecialchars($busca) . "'</strong>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap 5 JS via CDN (Opcional para este exemplo, mas recomendado) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Fechar a conexão
mysqli_close($conexao);
?>