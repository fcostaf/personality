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
    <title>Personality Q - Análise</title>
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
            <h1>Análise</h1>
        </div>';

include "../controller/CadastroController.php";
    $res=CadastroController::listarCadastros();
    $qtd=$res->rowCount();
    if($qtd>0){
        $sum_idade=0;
        $masc=0;
        $fem=0;
        echo '<table class="table table-hover table-striped table-bordered">
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

        echo "<table class='table table-hover table-striped table-bordered'>
                <tr><td></td><td colspan=3><h3 class='neu'>NEUROTICISMO</h3></td><td colspan=3><h3 class='exso'>EXTROVERSÃO / SOCIALIZAÇÃO</h3></td><td colspan=3><h3 class='reab'>REALIZAÇÃO / ABERTURA</h3></td></tr>
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


echo '
<div class="container">
  <div class="row">
    <div class="col-md-6 d-flex justify-content-center">
      <div id="genero" class="plot1"></div>
    </div>
    <div class="col-md-6 d-flex justify-content-center">
      <div id="n" class="plot2"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 d-flex justify-content-center">
      <div id="es" class="plot3"></div>
    </div>
    <div class="col-md-6 d-flex justify-content-center">
      <div id="ra" class="plot4"></div>
    </div>
  </div>
</div>

<div class="container">
  <div class="col-md-12 d-flex justify-content-center">
      <h2>Interpretação</h2>
  </div>
  <div class="row">
    <div class="col-md-2 d-flex">
      <h3 class="neu">NEUROTICISMO</h3>
    </div>
    <div class="col-md-10 d-flex justify-content-center">';
        if ($medA < 2) {
          echo 'O grupo apresenta baixos índices de Neuroticismo, o que sugere maior facilidade de foco nas tarefas e consequentemente a possibilidade de realizar atividades mais exigentes, pois isto não tenderia a causar estresse emocional significativo.';
        }
        else if ($medA < 3) {
          echo 'O grupo apresenta índices médios de Neuroticismo, o que sugere capacidade de foco nas tarefas, mas possibilidade de aumento do estresse emocional em atividades mais exigentes. Uma intervenção voltada para o manejo do estresse pode ajudar o grupo a realizar tarefas complexas sem que as emoções interfiram negativamente no processo.';
        }
        else {
          echo 'O grupo apresenta altos índices de Neuroticismo, o que sugere dificuldade com o foco nas tarefas por causa da interferência do estresse emocional. É importante uma intervenção constante para abordar os aspectos emocionais do processo a fim de diminuir esta interferência. Tarefas complexas e mais exigentes devem ser feitas junto com um monitoramento das reações emocionais do grupo.';
        };
echo '
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-2 d-flex">
      <h3 class="exso">EXTROVERSÃO /SOCIALIZAÇÃO</h3>
    </div>
    <div class="col-md-10 d-flex justify-content-center">';
        if ($medB < 2) {
          echo 'O grupo é introvertido e composto por indivíduos autocentrados. Trabalhos em grupo podem precisar de uma estruturação considerável para que os integrantes se coordenem entre si. A participação deve ser incentivada explicitamente, pois há pouca iniciativa do grupo neste sentido.';
        }
        else if ($medB < 3) {
          echo 'O grupo apresenta um equilíbrio entre introversão e extroversão. Desta forma, as atividades podem ser estruturadas de forma flexível, tanto no nível individual quanto coletivo.';
        }
        else {
          echo 'O grupo é predominantemente extrovertido e sociável. As atividades em grupo serão preferíveis, mas é necessária uma intervenção constante para retomar o foco na tarefa, pois haverá uma tendência ao desvio da atividade em favor de interações de tipo pessoal.';
        };
echo '
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-2 d-flex">
      <h3 class="reab">REALIZAÇÃO /ABERTURA</h3>
    </div>
    <div class="col-md-10 d-flex justify-content-center">';
        if ($medC < 2) {
          echo 'O grupo apresenta baixos índices de realização e abertura à experiência. Isto constitui um desafio para qualquer tipo de atividade, já que há pouco envolvimento e dedicação às tarefas, pouca curiosidade em aprender coisas novas e pouco sentimento de capacidade para realizar as atividades. Uma intervenção incentivadora ao longo de todo o processo é necessária.';
        }
        else if ($medC < 3) {
          echo 'O grupo apresenta índices médios de realização e abertura à experiência, sugerindo um fluxo regular da execução das atividades. É recomendado acrescentar leves desafios a cada tarefa a fim de aumentar a percepção de capacidade dos integrantes.';
        }
        else {
          echo 'O grupo apresenta altos índices de realização e abertura à experiência. Portanto, as atividades propostas devem ser exigentes e desafiadoras para manter um senso de propósito e sentido, já que tarefas muito fáceis poderão ser vistas como pouco motivadoras.';
        };
echo "
    </div>
  </div>

<script type='module'>

import * as Plot from 'https://cdn.jsdelivr.net/npm/@observablehq/plot@0.6/+esm';
const genero = [
                {Gênero: 'Masculino', Qtd: $masc},
                {Gênero: 'Feminino', Qtd: $fem}
              ];

const n = [
  {Questao: 'Sou ansioso', med: $med1},
  {Questao: 'Sou infeliz', med: $med2},
  {Questao: 'Sou raivoso', med: $med3}
];

const es = [
  {Questao: 'Sou sociável', med: $med4},
  {Questao: 'Sou falante', med: $med5},
  {Questao: 'Sou participativo', med: $med6}
];

const ra = [
  {Questao: 'Sou inteligente', med: $med7},
  {Questao: 'Sou perfeccionista', med: $med8},
  {Questao: 'Sou curioso', med: $med9}
];

document.querySelector('#genero').append(
  Plot.plot({
      marks: [
      Plot.barY(genero, {x: 'Gênero', y: 'Qtd'}),
          Plot.frame(),
      ]
      }));

document.querySelector('#n').append(
  Plot.plot({y: {domain: [0, 4]},
      marks: [
      Plot.barY(n, {x: 'Questao', y: 'med'}),
          Plot.frame(),
      ]
      }));

document.querySelector('#es').append(
  Plot.plot({y: {domain: [0, 4]},
      marks: [
      Plot.barY(es, {x: 'Questao', y: 'med'}),
          Plot.frame(),
      ]
      }));
    
document.querySelector('#ra').append(
  Plot.plot({y: {domain: [0, 4]},
      marks: [
      Plot.barY(ra, {x: 'Questao', y: 'med'}),
          Plot.frame(),
      ]
      }))

</script>
</body>
</html>"?>