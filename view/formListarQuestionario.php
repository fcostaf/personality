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
    <title>Personality Q - Listar questionários</title>
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
            </ul>
          </div>
        </div>
        </nav>
    
    <div class="container">
        <div class="col-md-12 d-flex justify-content-center">
            <h1>Questionários</h1>
        </div>';
    include_once "../controller/QuestionarioController.php";
    $res=QuestionarioController::listarQuestionarios();
    $qtd=$res->rowCount();
    if($qtd>0){
        echo '<table class="table table-hover table-striped table-bordered">
                <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Sou ansioso</th>
                <th>Sou infeliz</th>
                <th>Sou raivoso</th>
                <th>Med1</th>
                <th>Sou sociável</th>
                <th>Sou falante</th>
                <th>Sou participativo</th>
                <th>Med2</th>
                <th>Sou inteligente</th>
                <th>Sou perfeccionista</th>
                <th>Sou curioso</th>
                <th>Med3</th>
                <th></th>
                </tr>';
        while($row=$res->fetch(PDO::FETCH_OBJ)){
            include_once "../controller/CadastroController.php";
            $resGen=CadastroController::resgataPorIDSub($row->cadastro_idcadastro);
            $resGen=$resGen->fetch(PDO::FETCH_OBJ);
            $medA=round(($row->questao1+$row->questao2+$row->questao3)/3,1);
            $medB=round(($row->questao4+$row->questao5+$row->questao6)/3,1);
            $medC=round(($row->questao7+$row->questao8+$row->questao9)/3,1);
            echo "<tr>
                    <td>$row->idquestionario</td>
                    <td>$resGen->nome</td>
                    <td>$row->questao1</td>
                    <td>$row->questao2</td>
                    <td>$row->questao3</td>
                    <td class='med1'>$medA</td>
                    <td>$row->questao4</td>
                    <td>$row->questao5</td>
                    <td>$row->questao6</td>
                    <td class='med2'>$medB</td>
                    <td>$row->questao7</td>
                    <td>$row->questao8</td>
                    <td>$row->questao9</td>
                    <td class='med3'>$medC</td>
                    <td>
                    <button onclick=\"location.href='../view/formQuestionario.php?op=Alterar&idQuestionario=".$row->idquestionario."';\">Alterar</button>
                    <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='../controller/processaQuestionario.php?op=Excluir&idQuestionario=".$row->idquestionario."';}
                    else{false;}\">Excluir</button>
                    </td>";
        }
        echo "</form>";
        print "</tr>";
        print "</table>";

    }else{
        echo "<p>Nenhum registro encontrado!</p>";
    }

  echo '
  </body>
</html>'
?>