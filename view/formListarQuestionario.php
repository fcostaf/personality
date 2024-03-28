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
            include_once "../controller/CadastroController.php";
            $resGen=CadastroController::resgataPorIDSub($row->cadastro_idcadastro);
            $resGen=$resGen->fetch(PDO::FETCH_OBJ);
            echo "<tr>
                    <td>$row->idquestionario</td>
                    <td>$row->questao1</td>;
                    <td>$row->questao2</td>;
                    <td>$row->questao3</td>;
                    <td>$row->questao4</td>;
                    <td>$row->questao5</td>;
                    <td>$row->questao6</td>;
                    <td>$row->questao7</td>;
                    <td>$row->questao8</td>;
                    <td>$row->questao9</td>;
                    "
            echo "<td style='background-color:pink'>$resGen->nome</td>";
                    echo "<td>
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