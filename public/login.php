<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>criar novo usuário</title>
</head>
<?php

$mysqli = new mysqli("localhost", "root", "root", "tarefas_db");
if ($mysqli->connect_errno) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$msg = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = $_POST["nome"] ?? "";
    $pass = $_POST["senha"] ?? "";
    $email  = $_POST['email'] ?? "";

    $stmt = $mysqli->prepare("SELECT id, nome, senha, email FROM usuarios WHERE nome=? AND senha=? AND email=?");
    $stmt->bind_param("sss", $user, $pass, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $dados = $result->fetch_assoc();
    $stmt->close();

    if ($dados) {
        $_SESSION["user_id"] = $dados["id"];
        $_SESSION["nome"] = $dados["nome"];
        header("Location: index.php");
        exit;
    } else {
        $msg = "Usuário ou senha incorretos!";
    }
}
?>

<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Login Simples</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php if (!empty($_SESSION["user_pk"])): ?>
  <div class="card">
     <?= $_SESSION["nome"] ?>
    <p>Sua sessão foi encerrada! Clique aqui para logar novamente.</p>
    <p><a href="?logout=1">Sair</a></p>
  </div>

<?php else: ?>
  <div class="card">
    <h3>Login</h3>
    <?php if ($msg): ?><p class="msg"><?= $msg ?></p><?php endif; ?>
    <form method="post">
      <input type="text" name="nome" placeholder="Usuário" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <input type="email" name="email" placeholder="Email" required>
      <button type="submit">Entrar</button>
      <br>
      <br>
      <a href="cadastro.php">Clique aqui caso não tenha cadastro</a>
    </form>
  </div>
<?php endif; ?>

</body>
</html>