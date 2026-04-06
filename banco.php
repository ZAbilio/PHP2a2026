<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>

<?php
$servidor = "localhost";
$usuario  = "aluno";
$senha    = "aluno.etec";
$banco    = "teste";
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}
$buscaCurso = "";
if (isset($_POST['busca_curso'])) {
    $buscaCurso = $_POST['busca_curso'];
}

$stmtCurso = mysqli_prepare($conexao,
    $buscaCurso != ""
        ? "SELECT * FROM cursos WHERE curso LIKE ?"
        : "SELECT * FROM cursos"
);
if ($buscaCurso != "") {
    $paramCurso = "%" . $buscaCurso . "%";
    mysqli_stmt_bind_param($stmtCurso, "s", $paramCurso);
}
mysqli_stmt_execute($stmtCurso);
$retornoCursos = mysqli_stmt_get_result($stmtCurso);
$buscaAluno = "";
if (isset($_POST['busca_aluno'])) {
    $buscaAluno = $_POST['busca_aluno'];
}

$stmtAluno = mysqli_prepare($conexao,
    $buscaAluno != ""
        ? "SELECT * FROM alunos WHERE aluno LIKE ?"
        : "SELECT * FROM alunos"
);
if ($buscaAluno != "") {
    $paramAluno = "%" . $buscaAluno . "%";
    mysqli_stmt_bind_param($stmtAluno, "s", $paramAluno);
}
mysqli_stmt_execute($stmtAluno);
$retornoAlunos = mysqli_stmt_get_result($stmtAluno);
?>

<body class="bg-light">
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-5 text-primary fw-bold">
                <i class="bi bi-mortarboard-fill"></i> Catálogo de Cursos
            </h1>
            <p class="text-muted">Exemplo de conexão PHP + MySQL com Bootstrap</p>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="" method="POST" class="d-flex shadow-sm">
                <input type="text" name="busca_curso" class="form-control form-control-lg"
                       placeholder="Buscar por nome do curso..."
                       value="<?php echo htmlspecialchars($buscaCurso); ?>">
                <button class="btn btn-primary btn-lg" type="submit">
                    <i class="bi bi-search"></i> Buscar
                </button>
                <a class="btn btn-success btn-lg" href="inserir.php">
                    <i class="bi bi-save"></i> Cadastrar
                </a>
            </form>
        </div>
    </div>
    <div class="row mb-5">
        <?php if (mysqli_num_rows($retornoCursos) > 0): ?>
            <?php while ($linha = mysqli_fetch_assoc($retornoCursos)): ?>
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
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    Nenhum curso encontrado para: <strong>"<?php echo htmlspecialchars($buscaCurso); ?>"</strong>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <hr class="my-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-5 text-danger fw-bold">
                <i class="bi bi-person-fill"></i> Lista de Alunos
            </h1>
            <p class="text-muted">Alunos cadastrados no banco de dados</p>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <form action="" method="POST" class="d-flex shadow-sm">
                <input type="text" name="busca_aluno" class="form-control form-control-lg"
                       placeholder="Buscar por nome do aluno..."
                       value="<?php echo htmlspecialchars($buscaAluno); ?>">
                <button class="btn btn-danger btn-lg" type="submit">
                    <i class="bi bi-search"></i> Buscar
                </button>
                <a class="btn btn-success btn-lg" href="inserir_aluno.php">
                    <i class="bi bi-person-plus-fill"></i> Cadastrar
                </a>
            </form>
        </div>
    </div>
    <div class="row">
        <?php if (mysqli_num_rows($retornoAlunos) > 0): ?>
            <?php while ($aluno = mysqli_fetch_assoc($retornoAlunos)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-danger fw-bold">
                                <i class="bi bi-person-circle"></i>
                                <?php echo htmlspecialchars($aluno["aluno"]); ?>
                            </h5>
                            <hr>
                            <p class="card-text">
                                <span class="badge bg-secondary">Código: <?php echo $aluno["cod"]; ?></span>
                            </p>
                            <p class="card-text mb-1">
                                <i class="bi bi-envelope-fill text-primary"></i>
                                <strong>E-mail:</strong> <?php echo htmlspecialchars($aluno["email"]); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    Nenhum aluno encontrado para: <strong>"<?php echo htmlspecialchars($buscaAluno); ?>"</strong>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php mysqli_close($conexao); ?>