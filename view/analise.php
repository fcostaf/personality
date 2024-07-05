<?php


echo '<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personality Q - Análise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="../index.html">Personality Q</a>
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
            <h1>Análise</h1>
        </div>';

include "../controller/CadastroController.php";
    $res=CadastroController::listarCadastros();
    $qtd=$res->rowCount();
    if($qtd>0){
        $sum_idade=0;
        $masc=0;
        $fem=0;
        echo '<table>
                <tr>
                <th>N</th>
                <th>Média idade</th>
                <th>Masculino</th>
                <th>Feminino</th>
                </tr>';
        while($row=$res->fetch(PDO::FETCH_OBJ)){

            $sum_idade+=$row->idade;
            if($row->genero=='M'){
                $masc+=1;
            }else{
                $fem+=1;}
        }
        $medI=round($sum_idade/$qtd,1);

        echo "<tr>
                <td>$qtd</td>
                <td>$medI</td>
                <td>$masc</td>
                <td>$fem</td>
                </tr>
                </table>";

    }else{
        echo "<p>Nenhum registro encontrado!</p>";
    }

include_once "../controller/QuestionarioController.php";
    $res=QuestionarioController::listarQuestionarios();
    $qtd=$res->rowCount();
    if($qtd>0){
        $sum1=0;
        $sum2=0;
        $sum3=0;
        $sum4=0;
        $sum5=0;
        $sum6=0;
        $sum7=0;
        $sum8=0;
        $sum9=0;

        echo "<table>
                <tr>
                <th></th>
                <th>Sou ansioso</th>
                <th>Sou infeliz</th>
                <th>Sou raivoso</th>
                <th>Sou sociável</th>
                <th>Sou falante</th>
                <th>Sou participativo</th>
                <th>Sou inteligente</th>
                <th>Sou perfeccionista</th>
                <th>Sou curioso</th>
                </tr>";
        while($row=$res->fetch(PDO::FETCH_OBJ)){
            //include_once "../controller/CadastroController.php";
            //$resGen=CadastroController::resgataPorIDSub($row->cadastro_idcadastro);
            //$resGen=$resGen->fetch(PDO::FETCH_OBJ);
            $sum1+=$row->questao1;
            $sum2+=$row->questao2;
            $sum3+=$row->questao3;
            $sum4+=$row->questao4;
            $sum5+=$row->questao5;
            $sum6+=$row->questao6;
            $sum7+=$row->questao7;
            $sum8+=$row->questao8;
            $sum9+=$row->questao9;
        }
        $med1=round($sum1/$qtd,1);
        $med2=round($sum2/$qtd,1);
        $med3=round($sum3/$qtd,1);
        $med4=round($sum4/$qtd,1);
        $med5=round($sum5/$qtd,1);
        $med6=round($sum6/$qtd,1);
        $med7=round($sum7/$qtd,1);
        $med8=round($sum8/$qtd,1);
        $med9=round($sum9/$qtd,1);

        $medA=round(($med1+$med2+$med3)/3,1);
        $medB=round(($med4+$med5+$med6)/3,1);
        $medC=round(($med7+$med8+$med9)/3,1);
        echo "
                <tr>
                <td>Média</td>
                <td>$med1</td>
                <td>$med2</td>
                <td>$med3</td>
                <td>$med4</td>
                <td>$med5</td>
                <td>$med6</td>
                <td>$med7</td>
                <td>$med8</td>
                <td>$med9</td>
            </tr>
            <tr>
                <td></td>
                <td colspan=3 class='med1'>$medA</td>
                <td colspan=3 class='med2'>$medB</td>
                <td colspan=3 class='med3'>$medC</td>
            </tr>
            </table>";

    }else{
        echo "<p>Nenhum registro encontrado!</p>";
    }

  echo '<br><a href="../index.html">Voltar</a>';


echo '</body>
</html>'


?>