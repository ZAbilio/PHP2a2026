<?php 
 
header("Content-Type: application/json; charset=UTF-8"); 
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); 
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization"); 
 
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") { 
   http_response_code(204); 
   exit; 
} 
 
$serv  = "localhost"; 
$bd    = "escola"; 
$usuBd = "root"; 
$senBd = ""; 
 
try { 
   $conn = new PDO("mysql:host=$serv;dbname=$bd;charset=utf8mb4", $usuBd, $senBd); 
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
   $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); 
} catch (PDOException $e) { 
   http_response_code(500); 
   echo json_encode(["status" => "erro", "mensagem" => "Erro de conexão: " . $e->getMessage()]); 
   exit; 
} 
 
$method = $_SERVER["REQUEST_METHOD"]; 
$input  = file_get_contents("php://input"); 
$data   = json_decode($input, true); 
 
if (!is_array($data)) { 
   $data = []; 
} 
 
switch ($method) { 
 
   case "GET": 
       $cod = $_GET["cod"] ?? null; 
       if ($cod) { 
           $stmt = $conn->prepare("SELECT * FROM alunos WHERE cod = :cod"); 
           $stmt->bindValue(":cod", $cod, PDO::PARAM_INT); 
       } else { 
           $stmt = $conn->prepare("SELECT * FROM alunos"); 
       } 
       $stmt->execute(); 
       $result = $stmt->fetchAll(); 
       echo json_encode($result, JSON_UNESCAPED_UNICODE); 
       break; 
 
   case "POST": 
       $stmt = $conn->prepare("INSERT INTO alunos (nome, email, idade, turma) VALUES (:nome, :email, :idade, :turma)"); 
       $stmt->execute([ 
           ":nome"  => $data["nome"]  ?? null, 
           ":email" => $data["email"] ?? null, 
           ":idade" => $data["idade"] ?? null, 
           ":turma" => $data["turma"] ?? null, 
       ]); 
       http_response_code(201); 
       echo json_encode(["status" => "sucesso", "mensagem" => "Aluno cadastrado com sucesso!"]); 
       break; 
 
   case "PUT": 
       if (!isset($data["cod"])) { 
           http_response_code(400); 
           echo json_encode(["status" => "erro", "mensagem" => "Código não informado."]); 
           break; 
       } 
       $stmt = $conn->prepare("UPDATE alunos SET nome = :nome, email = :email, idade = :idade, turma = :turma WHERE cod = :cod"); 
       $stmt->execute([ 
           ":cod"   => $data["cod"], 
           ":nome"  => $data["nome"]  ?? null, 
           ":email" => $data["email"] ?? null, 
           ":idade" => $data["idade"] ?? null, 
           ":turma" => $data["turma"] ?? null, 
       ]); 
       echo json_encode(["status" => "sucesso", "mensagem" => "Aluno atualizado!"]); 
       break; 
 
   case "DELETE": 
       $cod = $_GET["cod"] ?? $data["cod"] ?? null; 
       if (!$cod) { 
           http_response_code(400); 
           echo json_encode(["status" => "erro", "mensagem" => "Código não informado."]); 
           break; 
       } 
       $stmt = $conn->prepare("DELETE FROM alunos WHERE cod = :cod"); 
       $stmt->bindValue(":cod", $cod, PDO::PARAM_INT); 
       $stmt->execute(); 
       echo json_encode(["status" => "sucesso", "mensagem" => "Aluno removido!"]); 
       break; 
 
   default: 
       http_response_code(405); 
       echo json_encode(["status" => "erro", "mensagem" => "Método não permitido."]); 
       break; 
} 
 
$conn = null; 
?> 