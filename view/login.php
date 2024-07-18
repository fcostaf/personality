<?php
// Inicia uma nova sessão ou resume a sessão existente
session_start();

// Inclui o arquivo 'Conexao.php' que contém a definição da classe Conexao
include_once '../DAO/Conexao.php';
// Cria uma nova instância da classe Conexao
$conex = new Conexao();

// Estabelece uma conexão com o banco de dados utlizando o método faz Conexao da classe Conexao
$conex->fazConexao();

// Verifica se o método de requisição é POST, ou seja, soe o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o nome de usuário e a senha enviados pelo formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepara uma consulta SQL para verificiar se o usuário existe no banco de dados
    $stmt = $conex->conn->prepare("SELECT * FROM users WHERE username = ?");
    // Executa a consulta com o nome de usuário fornecido
    $stmt->execute([$username]);
    // Busca a primeira linha do resultado da consulta
    $user = $stmt->fetch();

    // Verifica se o usuário foi encontrado e se a senha fornecida corresponde à senha armazenada
    if ($user && password_verify($password, $user['password'])) {
        // Se a autenticação for bem-sucedida, armazena o ID do usuário e o nome de usuário na sessão
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        // Redireciona o usuário para a página 'itens.php'
        header('Location: ../index.php');
        exit();
    } else {
        // Se a autenticação falhar, define uma mensagem de erro
        $error = 'Nome de usuário ou senha inválidos';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="../index.php"><img src="mascaras.jpg" width=120px height=120px></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Cadastro
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="formCadastro.php?op=Incluir">Incluir</a></li>
                  <li><a class="dropdown-item" href="formListarCadastro.php?op=Listar">Listar</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Questionário
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="formQuestionario.php?op=Incluir">Incluir</a></li>
                  <li><a class="dropdown-item" href="formListarQuestionario.php?op=Listar">Listar</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="analise.php">Análise</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <div class="container">
        <div class="col-md-12 d-flex justify-content-center">
            <h2>Login</h2>
        </div>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <div class="col-md-12 d-flex justify-content-center">
        <form method="POST">
            <table>
                <tr>
                    <td><label>Nome de usuário:</label></td><td><input type="text" name="username" required></td>
                </tr>
                <tr>
                    <td><label>Senha:</label></td><td><input type="password" name="password" required></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Entrar</button></td>
                </tr>
            </table>
        </form>
    </div>
    </div>

    <section class="futer">
        <!-- Footer -->
        <footer class="text-center text-white bg-dark">
          <!-- Grid container -->
          <div class="container p-4 pb-0">
            <!-- Section: CTA -->
            <section class="">
              <p class="d-flex justify-content-center align-items-center">
                Agora você pode cadastrar novos participantes, responder ao questionário ou visualizar a análise dos resultados.
              </p>
            </section>
            <!-- Section: CTA -->
          </div>
          <!-- Grid container -->

          <!-- Copyright -->
          <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2024 Copyright:
            <a class="text-white" href="#">PQI - Personality Q Institute</a>
          </div>
          <!-- Copyright -->
        </footer>
        <!-- Footer -->
      </section>
</body>
</html>