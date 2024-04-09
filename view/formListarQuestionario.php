<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Listar Subgêneros</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>';
    include_once "../controller/QuestionarioController.php";
    $res=QuestionarioController::listarQuestionarios();
    $qtd=$res->rowCount();
    if($qtd>0){
        echo '<table>
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
                <th></th><th></th>
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

  echo '<br><a href="../index.html">Voltar</a>
  </body>
</html>'
?>