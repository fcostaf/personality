<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Questionário</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>
    <h2>Questionário genial de personalidade</h2>
    <p>Marque de 1 a 3 o quanto a frase se aplica a você. Não minta.</p>';
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
        <label for="questao1">Sou ansioso.</label>
        <input type="number" name="questao1" value='.$q1.'><br><br>
        <label for="questao2">Sou infeliz.</label>
        <input type="number" name="questao2" value='.$q2.'><br><br>
        <label for="questao3">Sou raivoso.</label>
        <input type="number" name="questao3" value='.$q3.'><br><br>
        <label for="questao4">Sou sociável.</label>
        <input type="number" name="questao4" value='.$q4.'><br><br>
        <label for="questao5">Sou falante.</label>
        <input type="number" name="questao5" value='.$q5.'><br><br>
        <label for="questao6">Sou participativo.</label>
        <input type="number" name="questao6" value='.$q6.'><br><br>
        <label for="questao7">Sou inteligente.</label>
        <input type="number" name="questao7" value='.$q7.'><br><br>
        <label for="questao8">Sou perfeccionista.</label>
        <input type="number" name="questao8" value='.$q8.'><br><br>
        <label for="questao9">Sou curioso.</label>
        <input type="number" name="questao9" value='.$q9.'><br><br>';
        include "../controller/CadastroController.php";
        $res=CadastroController::listarCadastros();
        $qtd=$res->rowCount();
        if($qtd>0){
            echo '<label for="comboCadastro">Selecione o nome: </label>
            <select name="comboCadastro" id="comboCadstro">
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
        echo '<input type="hidden" name="idquestionario" value='.$id.'>
        <input type="hidden" name="op" value='.$operacao.'><br>
        <input type="submit" value='.$operacao.'>
        </form><br>
        <a href="../index.html">Voltar</a>
        </body>
        </html>'
?>