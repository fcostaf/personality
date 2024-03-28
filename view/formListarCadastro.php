<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Listar Cadastros</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>';
    include "../controller/CadastroController.php";
    $res=CadastroController::listarCadastros();
    $qtd=$res->rowCount();
    if($qtd>0){
        echo '<table class="table table-hover table-striped table-bordered">
                <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Gênero</th>
                <th></th><th></th>
                </tr>';
        while($row=$res->fetch(PDO::FETCH_OBJ)){
            echo "<tr>
                    <td>$row->idcadastro</td>
                    <td>$row->nome</td>
                    <td>$row->idade</td>
                    <td>$row->genero</td>
                    <td>
                    <button onclick=\"location.href='../view/formCadastro.php?op=Alterar&idCadastro=".$row->idcadastro."';\">Alterar</button>
                    <button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='../controller/processaCadastro.php?op=Excluir&idCadastro=".$row->idcadastro."';}
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