<?php
session_start(); // serve para guardar valores, conexão com o servidor, contato com o servidor
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se os campos foram preenchidos
    if (!$email || !$senha) {
        echo "<div class='alert alert-danger'>Digite um email e senha.</div>";
    }

    // Prepara e executa a consulta na tabela de usuários
    $stmt = $conn->prepare("SELECT nome FROM usuarios WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $stmt->store_result(); // toda vez que for conectar um select executar essa ação.

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nome);
        $stmt->fetch();
        
        // Registra o usuário na sessão
        $_SESSION['email'] = $email;
        $_SESSION['nome'] = $nome;

        header("Location: principal.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Login ou senha inválidos. Tente novamente.</div>";
    }
    $stmt->close();
}
$conn->close();
?>

