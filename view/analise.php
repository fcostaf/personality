<?php


echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>';




include_once "../controller/QuestionarioController.php";
    $res=QuestionarioController::listarQuestionarios();
    $qtd=$res->rowCount();
    if($qtd>0){
        $sum1=0;
        echo '<table>
                <tr>
                <th>Questão1</th>
                <th>Questão2</th>
                <th>Questão3</th>
                <th>Questão4</th>
                <th>Questão5</th>
                <th>Questão6</th>
                <th>Questão7</th>
                <th>Questão8</th>
                <th>Questão9</th>
                <th>Nome</th>
                <th></th><th></th>
                </tr>';
        while($row=$res->fetch(PDO::FETCH_OBJ)){
            //include_once "../controller/CadastroController.php";
            //$resGen=CadastroController::resgataPorIDSub($row->cadastro_idcadastro);
            //$resGen=$resGen->fetch(PDO::FETCH_OBJ);
            $sum1+=$row->questao1;
        }
        $med1=$sum1/$qtd;
        echo "<tr>
            <td>$med1</td>;
            <td></td>";
        print "</tr>";
        print "</table>";

    }else{
        echo "<p>Nenhum registro encontrado!</p>";
    }

  echo '<br><a href="../index.html">Voltar</a>';


echo '</body>
</html>'


?>