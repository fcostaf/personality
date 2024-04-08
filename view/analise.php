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
                <th>N = $qtd</th>
                <th>Questão1</th>
                <th>Questão2</th>
                <th>Questão3</th>
                <th>Questão4</th>
                <th>Questão5</th>
                <th>Questão6</th>
                <th>Questão7</th>
                <th>Questão8</th>
                <th>Questão9</th>
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