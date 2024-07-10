<?php
// Inicia uma nova sessão ou retoma a sessão existente
session_start();

// Inclui o arquivo 'Conexao.php' que contém a definição da classe Conexao
include_once '../DAO/Conexao.php';

// Cria uma nova instância da classe Conexao
$conex = new Conexao();

//Estabelece uma conexão com o banco de dados utilizando o método fazConexao da classe Conexao
$conex->fazConexao();

// Verifica se o método de requisição é POST, ou seja, se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém o nome de usuário, a senha e a confirmação de senha enviados pelo formulário
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Verifica se as senhas coincidem
    if ($password !== $password_confirm) {
        // Define uma mensagem de erro se as senhas não coincidirem
        $error = 'As senhas não coincidem.';
    } else {
        // Prepara uma consulta SQL para verificar se o nome de usuário já existe no banco de dados
        $stmt = $conex->conn->prepare("SELECT * FROM users WHERE username = ?");
        // Executa a consulta com o nome de usuário fornecido
        $stmt->execute([$username]);
        // Verifica se o nome de usuário já foi registrado
        if ($stmt->fetch()) {
            // Define uma mensagem de erro se o nome de usuário já existir
            $error = 'Nome de usuário já existe.';
        } else {
            // Cria um hash da senha utilizando o algoritmo bcrypt
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            // Prerpara uma consulta SQL para inserir o novo usuário no banco de dados
            $stmt = $conex->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            // Executa a consulta para inserir o novo usuário
            if ($stmt->execute([$username, $hashed_password])) {
                // Define uma mensagem de sucesso se o usuário for registrado com sucesso
                $success = 'Usuário registrado com sucesso. Você pode fazer login agora.';
            } else {
                // Define uma mensagem de erro se houver um problema ao registrar o usuário
                $error = 'Erro ao registrar o usuário. Tente novamente.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro de Novo Usuário</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="../index.php">Personality Q</a>
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
              <?php
              if (!isset($_SESSION['user_id'])) { echo 
              '<li class="nav-item">
                <a class="nav-link" aria-current="page" href="login.php">Login</a>
              </li>';
              } else { echo
                '<li class="nav-item">
                <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
              </li>';
              };
              ?>
            </ul>
          </div>
        </div>
    </nav>
    <div class="col-md-12 d-flex justify-content-center">
        <h2>Registro de Novo Usuário</h2>
    </div>
    <div class="col-md-12 d-flex justify-content-center">
        <?php if (isset($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p style="color:green;"><?php echo $success; ?></p>
        <?php endif; ?>
        <form method="POST">
        <table>
                <tr>
                    <td><label>Nome de usuário:</label></td><td><input type="text" name="username" required></td>
                </tr>
                <tr>
                    <td><label>Senha:</label></td><td><input type="password" name="password" required></td>
                </tr>
                <tr>
                    <td><label>Confirme a senha:</label></td><td><input type="password" name="password_confirm" required><br></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Entrar</button></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="col-md-12 d-flex justify-content-center">
        <a href="login.php">Já tem uma conta? Faça login</a>
    </div>
    </body>
</html>