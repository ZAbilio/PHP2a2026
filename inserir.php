<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<?php
$msg = "";
$tipo_alerta = "";

if(isset($_POST["aluno"])){
    $servidor = "localhost";
    $usuario = "aluno";
    $senha = "aluno.etec";
    $banco = "teste";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (!$conexao) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    $aluno_escapado = mysqli_real_escape_string($conexao, $_POST["aluno"]);
    $email_escapado = mysqli_real_escape_string($conexao, $_POST["email"]);
    $senha_escapada = mysqli_real_escape_string($conexao, $_POST["senha"]);

    $sql = "INSERT INTO alunos(aluno, email, senha) VALUES ('$aluno_escapado', '$email_escapado', '$senha_escapada')";

    $retorno = mysqli_query($conexao, $sql);

    if($retorno == true){
        $msg = "Aluno cadastrado com sucesso!";
        $tipo_alerta = "success";
    }
    else{
        $msg = "Erro ao cadastrar o aluno! Erro: " . mysqli_error($conexao);
        $tipo_alerta = "danger";
    }
    mysqli_close($conexao);
}
?>
<body class="bg-light">

    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="display-5 text-primary fw-bold">
                    <i class="bi bi-people-fill"></i> Gerenciamento de Alunos
                </h1>
                <p class="text-muted">CRUD de Alunos - PHP + MySQL com Bootstrap</p>
            </div>
        </div>

        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form action="banco.php" method="POST" class="d-flex shadow-sm">
                    <input type="text" name="busca" class="form-control form-control-lg"
                           placeholder="Buscar por nome do aluno..."
                           value="">
                    <button class="btn btn-primary btn-lg" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                    <a class="btn btn-outline-secondary btn-lg" href="banco.php">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                </form>
            </div>
        </div>

        <?php if ($msg != ""): ?>
            <div class="row justify-content-center mb-4">
                <div class="col-md-6">
                    <div class="alert alert-<?= $tipo_alerta ?> text-center shadow-sm" role="alert">
                        <i class="bi bi-<?= $tipo_alerta == 'success' ? 'check-circle-fill' : 'exclamation-triangle-fill' ?>"></i>
                        <?= $msg ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title text-success fw-bold mb-4">
                            <i class="bi bi-plus-circle-fill"></i> Cadastrar Novo Aluno
                        </h5>

                        <form action="" method="POST">
                         
                            <div class="mb-3">
                                <label for="aluno" class="form-label fw-bold">
                                    <i class="bi bi-person-fill text-success"></i> Nome do Aluno
                                </label>
                                <input type="text" name="aluno" class="form-control form-control-lg"
                                       placeholder="Ex: João da Silva" required>
                            </div>

                   
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">
                                    <i class="bi bi-envelope-fill text-primary"></i> E-mail
                                </label>
                                <input type="email" name="email" class="form-control form-control-lg"
                                       placeholder="Ex: joao@email.com" required>
                            </div>

                            <div class="mb-4">
                                <label for="senha" class="form-label fw-bold">
                                    <i class="bi bi-lock-fill text-warning"></i> Senha
                                </label>
                                <input type="password" name="senha" class="form-control form-control-lg"
                                       placeholder="Máximo 12 caracteres" maxlength="12" required>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-success btn-lg" type="submit">
                                    <i class="bi bi-save-fill"></i> Salvar Aluno
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
