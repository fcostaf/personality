<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Cadastro</title>
    <link rel="stylesheet" href="../estilo.css">
</head>
<body>';
    $operacao=$_REQUEST["op"];
    if($operacao=="Alterar"){
        include("../controller/CadastroController.php");
        $res=CadastroController::resgataPorId($_REQUEST["idCadastro"]);
        $qtd=$res->rowCount();
        $row=$res->fetch(PDO::FETCH_OBJ);
        $nome=$row->nome;
        $idade=$row->idade;
        $genero=$row->genero;
        $id=$row->idcadastro;
        $operacao="Alterar";
        echo "$nome";
    }
    else{
        $nome="";
        $idade="";
        $genero="";
        $id="";
        $operacao="Incluir";
    }

    echo '<form method="post" action="../controller/processaCadastro.php">
        <label for="nome">Nome</label>
        <input type="text" name="nome" value="'.$nome.'"><br>
        <label for="idade">Idade</label>
        <input type="text" name="idade" value="'.$idade.'"><br>
        <label for="genero">Gênero</label>
        <input type="text" name="genero" value="'.$genero.'"><br>
        <input type="hidden" name="id" value='.$id.'><br>
        <input type="hidden" name="op" value='.$operacao.'><br>
        <input type="submit" value='.$operacao.'>
        </form>
        <br>
        <a href="../index.html">Voltar</a>


</body>
</html>'
?>