<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Curso - Exemplo de Aula</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<?php
// Variáveis para armazenar a mensagem de feedback
 $msg = "";
 $tipo_alerta = "";

if(isset($_POST["curso"])){
    $servidor = "localhost";
    $usuario = "aluno";
    $senha = "aluno.etec";
    $banco = "teste";

    // Criar conexão
    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (!$conexao) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    // Recomendado: Usar mysqli_real_escape_string para evitar erros com aspas e SQL Injection
    $curso_escapado = mysqli_real_escape_string($conexao, $_POST["curso"]);
    $periodo_escapado = mysqli_real_escape_string($conexao, $_POST["periodo"]);
    $vagas = (int) $_POST["vagas"]; // Forçar a ser número inteiro

    $sql = "INSERT INTO cursos(curso, vagas, periodo) VALUES ('$curso_escapado', $vagas, '$periodo_escapado')";

    $retorno = mysqli_query($conexao, $sql);
    
    if($retorno == true){
        $msg = "Curso cadastrado com sucesso!";
        $tipo_alerta = "success";
    }
    else{
        $msg = "Erro ao cadastrar o curso! Erro: " . mysqli_error($conexao);
        $tipo_alerta = "danger";
    }
    mysqli_close($conexao);
}
?>
<body class="bg-light">

    <!-- Cabeçalho (Idêntico ao da listagem) -->
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="display-5 text-primary fw-bold">
                    <i class="bi bi-mortarboard-fill"></i> Catálogo de Cursos
                </h1>
                <p class="text-muted">Exemplo de conexão PHP + MySQL com Bootstrap</p>
            </div>
        </div>

        <!-- Formulário de Busca (Apontando de volta para a página inicial) -->
        <!-- ATENÇÃO: Mude o "action" abaixo para o nome do seu arquivo de listagem (ex: index.php) -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form action="banco.php" method="POST" class="d-flex shadow-sm">
                    <input type="text" name="busca" class="form-control form-control-lg" 
                           placeholder="Buscar por nome do curso..." 
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

        <!-- Alerta de Sucesso ou Erro -->
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

        <!-- Formulário de Cadastro dentro de um Card -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title text-success fw-bold mb-4">
                            <i class="bi bi-plus-circle-fill"></i> Cadastrar Novo Curso
                        </h5>
                        
                        <form action="" method="POST">
                            <!-- Campo Curso -->
                            <div class="mb-3">
                                <label for="curso" class="form-label fw-bold">
                                    <i class="bi bi-bookmark-star-fill text-success"></i> Nome do Curso
                                </label>
                                <input type="text" name="curso" class="form-control form-control-lg" 
                                       placeholder="Ex: Desenvolvimento de Sistemas" required>
                            </div>
                            
                            <!-- Campo Vagas -->
                            <div class="mb-3">
                                <label for="vagas" class="form-label fw-bold">
                                    <i class="bi bi-people-fill text-primary"></i> Quantidade de Vagas
                                </label>
                                <input type="number" name="vagas" class="form-control form-control-lg" 
                                       placeholder="Ex: 40" min="1" required>
                            </div>
                            
                            <!-- Campo Período -->
                            <div class="mb-4">
                                <label for="periodo" class="form-label fw-bold">
                                    <i class="bi bi-clock-fill text-warning"></i> Período
                                </label>
                                <input type="text" name="periodo" class="form-control form-control-lg" 
                                       placeholder="Ex: Matutino, Noturno..." required>
                            </div>
                            
                            <!-- Botão Cadastrar -->
                            <div class="d-grid">
                                <button class="btn btn-success btn-lg" type="submit">
                                    <i class="bi bi-save-fill"></i> Salvar Curso
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>