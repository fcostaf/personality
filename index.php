<?php
// Inicia uma nova sessão ou resume a sessão existente
session_start();

echo '
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personality Q</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="view/estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="index.php">Personality Q</a>
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
                  <li><a class="dropdown-item" href="view/formCadastro.php?op=Incluir">Incluir</a></li>
                  <li><a class="dropdown-item" href="view/formListarCadastro.php?op=Listar">Listar</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Questionário
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="view/formQuestionario.php?op=Incluir">Incluir</a></li>
                  <li><a class="dropdown-item" href="view/formListarQuestionario.php?op=Listar">Listar</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="view/analise.php">Análise</a>
              </li>';
              if (!isset($_SESSION['user_id'])) { echo 
              '<li class="nav-item">
                <a class="nav-link" aria-current="page" href="view/login.php">Login</a>
              </li>';
              } else { echo
                '<li class="nav-item">
                <a class="nav-link" aria-current="page" href="view/logout.php">Logout</a>
              </li>';
              };
              ?>
            </ul>
          </div>
        </div>
    </nav>
    
    <div class="container">
        <div class="col-md-12 d-flex justify-content-center">
            <h1>Personality Q</h1>
        </div>
        <div class="col-md-12 d-flex justify-content-center">
            <p>
                O Modelo dos Cinco Fatores da Personalidade (5F) deriva de um estudo que analisou os adjetivos presentes no vocabulário para descrever a personalidade das pessoas e chegou a cinco principais categorias ou fatores que agrupam esses termos: Neuroticismo (grau de instabilidade emocional, tendência a emoções negativas), Extroversão (nível de comunicabilidade, expressão de si mesmo em ambientes compartilhados), Socialização (quanto a pessoa se preocupa com os outros e com a boa convivência entre as pessoas), Realização (quanto a pessoa é dedicada em realizar seus objetivos com dedicação, planejamento e foco) e Abertura à Experiência (se a pessoa é mais ou menos disposta a mudar seus valores morais, a buscar atividades diferentes das que está acostumada, a ser curiosa e interessada em novidades).
            </p>
        </div>
        <?php if (!isset($_SESSION['user_id'])) { echo 
              '
        <div class="col-md-12 d-flex justify-content-center">
          <p>
            Não tem uma conta? <a href="view/register.php">Registre-se agora mesmo</a>
          </p>
        </div>
              ';};?>
    </div>
    <div class="container">
      <div class="col-md-12 d-flex justify-content-center">
        <div id='tree' class='arvore'>
          </div>
          </div>
      </div>
    <script type='module'>
      import * as Plot from 'https://cdn.jsdelivr.net/npm/@observablehq/plot@0.6/+esm';

      var fatores = [
        "Fatores/Neuroticismo/Sou ansioso",
        "Fatores/Neuroticismo/Sou infeliz",
        "Fatores/Neuroticismo/Sou raivoso",
        "Fatores/Extroversão - Socialização/Sou sociável",
        "Fatores/Extroversão - Socialização/Sou falante",
        "Fatores/Extroversão - Socialização/Sou participativo",
        "Fatores/Realização - Abertura à experiência/Sou inteligente",
        "Fatores/Realização - Abertura à experiência/Sou perfeccionista",
        "Fatores/Realização - Abertura à experiência/Sou curioso",
      ]
      document.querySelector('#tree').append(
      Plot.plot({style: {fontSize:'15pt'},
        axis: null,
        height: 500,
        width: 1000,
        margin: 10,
        marginLeft: 140,
        marginRight: 220,
        marks: [
          Plot.tree(fatores, {textStroke: "none"})
        ]
      }));
    </script>
</body>
</html>