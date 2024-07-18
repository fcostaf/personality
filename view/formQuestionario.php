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
    <title>Personality Q - Incluir questionário</title>
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
            <h1>Questionário</h1>
        </div>
    <div class="container">
    <div class="col-md-12 d-flex justify-content-center">
    <p>Marque de 1 a 4 o quanto a frase se aplica a você. Não minta.</p>
    </div>
    </div>
    <div class="container">
    <div class="col-md-12 d-flex justify-content-center">';
    $operacao=$_REQUEST["op"];
    if($operacao=="Alterar"){
        include("../controller/QuestionarioController.php");
        $res=QuestionarioController::resgataPorId($_REQUEST["idQuestionario"]);
        $qtd=$res->rowCount();
        $row=$res->fetch(PDO::FETCH_OBJ);
        $q1=$row->questao1;
        $q2=$row->questao2;
        $q3=$row->questao3;
        $q4=$row->questao4;
        $q5=$row->questao5;
        $q6=$row->questao6;
        $q7=$row->questao7;
        $q8=$row->questao8;
        $q9=$row->questao9;
        $idGen=$row->cadastro_idcadastro;
        $id=$row->idquestionario;
        $operacao="Alterar";
    }
    else{
        $nome="";
        $q1="";
        $q2="";
        $q3="";
        $q4="";
        $q5="";
        $q6="";
        $q7="";
        $q8="";
        $q9="";
        $idGen="";
        $id="";
        $operacao="Incluir";
    }

    echo '<form method="post" action="../controller/processaQuestionario.php">
            <table>
              <tr>';
              include "../controller/CadastroController.php";
              $res=CadastroController::listarCadastros();
              $qtd=$res->rowCount();
              if($qtd>0){
                  echo '
                  <td><label for="comboCadastro">Selecione o nome: </label>
                  <td><select name="comboCadastro" id="comboCadstro">
                  <option value=""></option>';
                  while($row=$res->fetch(PDO::FETCH_OBJ)){
                      if($row->idcadastro==$idGen){
                          echo "<option selected='selected' value=$row->nome>$row->nome</option>";
                      }else{
                      echo "<option value=$row->nome>$row->nome</option>";
                      }
                  }
                  print "</select>";
              }else{
                  echo "<p>Nenhum nome disponível!</p>";
              };
              echo '</td>
                </tr>
                <tr>
                  <td><label for="questao1">Sou ansioso.</label></td>
                  <td><input type="number" name="questao1" value='.$q1.'></td>
                </tr>
                <tr>
                  <td><label for="questao2">Sou infeliz.</label></td>
                  <td><input type="number" name="questao2" value='.$q2.'></td>
                </tr>
                <tr>
                  <td><label for="questao3">Sou raivoso.</label></td>
                  <td><input type="number" name="questao3" value='.$q3.'></td>
                </tr>
                <tr>
                  <td><label for="questao4">Sou sociável.</label></td>
                  <td><input type="number" name="questao4" value='.$q4.'></td>
                </tr>
                <tr>
                  <td><label for="questao5">Sou falante.</label></td>
                  <td><input type="number" name="questao5" value='.$q5.'></td>
                </tr>
                <tr>
                  <td><label for="questao6">Sou participativo.</label></td>
                  <td><input type="number" name="questao6" value='.$q6.'></td>
                </tr>
                <tr>
                  <td><label for="questao7">Sou inteligente.</label></td>
                  <td><input type="number" name="questao7" value='.$q7.'></td>
                </tr>
                <tr>
                  <td><label for="questao8">Sou perfeccionista.</label></td>
                  <td><input type="number" name="questao8" value='.$q8.'></td>
                </tr>
                <tr>
                  <td><label for="questao9">Sou curioso.</label></td>
                  <td><input type="number" name="questao9" value='.$q9.'></td>
                </tr>
                
                <tr>
                  <td><input type="hidden" name="idquestionario" value='.$id.'>
                  <input type="hidden" name="op" value='.$operacao.'><br>
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