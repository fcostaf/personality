<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
  }

echo '<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personality Q - Incluir cadastro</title>
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
            <h1>Cadastrar</h1>
        </div>';
    $operacao=$_REQUEST["op"];
    if($operacao=="Alterar"){
        include("../controller/CadastroController.php");
        $res=CadastroController::resgataPorId($_REQUEST["idCadastro"]);
        $qtd=$res->rowCount();
        $row=$res->fetch(PDO::FETCH_OBJ);
        $nome=$row->nome;
        $idade=$row->idade;
        $genero=$row->genero;
        $id=$row->idcadastro;
        $operacao="Alterar";
        echo "$nome";
    }
    else{
        $nome="";
        $idade="";
        $genero="";
        $id="";
        $operacao="Incluir";
    }

    echo '<div class="container">
          <div class="col-md-12 d-flex justify-content-center">
          <form method="post" action="../controller/processaCadastro.php">
          <table>
            <tr>
              <td><label for="nome">Nome</label></td>
              <td><input type="text" name="nome" value="'.$nome.'"></td>
            </tr>
            <tr>
              <td><label for="idade">Idade</label></td>
              <td><input type="text" name="idade" value="'.$idade.'"></td>
            </tr>
              <td><label for="genero">Gênero</label></td>
              <td><input type="text" name="genero" value="'.$genero.'"></td>
            </tr>
            <tr>
              <td colspan=2><input type="hidden" name="id" value='.$id.'>
              <input type="hidden" name="op" value='.$operacao.'>
              <input type="submit" value='.$operacao.'></td>
            </tr>
          </table>
        </form>
        </div>
        </div></div>
    
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
</html>'
?>