<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Subgênero</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>';
    $operacao=$_REQUEST["op"];
    if($operacao=="Alterar"){
        include("../controller/SubGeneroController.php");
        $res=SubGeneroController::resgataPorId($_REQUEST["idSubGenero"]);
        $qtd=$res->rowCount();
        $row=$res->fetch(PDO::FETCH_OBJ);
        $nome=$row->nome;
        $idGen=$row->genero_idgenero;
        $id=$row->idsubgenero;
        $operacao="Alterar";
    }
    else{
        $nome="";
        $idGen="";
        $id="";
        $operacao="Incluir";
    }

    echo '<form method="post" action="../controller/processaSubGenero.php">
        <label for="nome">Nome</label>
        <input type="text" name="nome" value='.$nome.'><br><br>';
        include "../controller/GeneroController.php";
        $res=GeneroController::listarGeneros();
        $qtd=$res->rowCount();
        if($qtd>0){
            echo '<label for="comboGenero">Selecione o gênero: </label>
            <select name="comboGenero" id="comboGenero">
            <option value=""></option>';
            while($row=$res->fetch(PDO::FETCH_OBJ)){
                if($row->idgenero==$idGen){
                    echo "<option selected='selected' value=$row->nome>$row->nome</option>";
                }else{
                echo "<option value=$row->nome>$row->nome</option>";
                }
            }
            print "</select>";
        }else{
            echo "<p>Nenhum gênero disponível!</p>";
        };
        echo '<input type="hidden" name="idSubGen" value='.$id.'>
        <input type="hidden" name="op" value='.$operacao.'><br>
        <input type="submit" value='.$operacao.'>
        </form><br>
        <a href="../index.html">Voltar</a>
        </body>
        </html>'
?>