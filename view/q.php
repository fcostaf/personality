<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Listar Gêneros</title>
</head>
<body>';
    include "../controller/GeneroController.php";
    $res=GeneroController::listarGeneros();
    $qtd=$res->rowCount();
    if($qtd>0){
        echo '<label for="comboGenero">Selecione o gênero: </label>
        <select name="comboGenero" id="comboGenero">
        <option value=""></option>';
        while($row=$res->fetch(PDO::FETCH_OBJ)){
            echo "<option value=$row->nome>$row->nome</option>";
        }
        print "</select>";
    }else{
        echo "<p>Nenhum gênero disponível!</p>";
    }
  echo "</body>
</html>"
?>