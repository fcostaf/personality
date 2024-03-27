<?php
//echo " OPCAO: ".$_REQUEST["op"];

switch($_REQUEST["op"]){
    case "Incluir":
        incluir();break;
    case "Alterar":
        alterar();break;
    case "Excluir":
        excluir();break;
    case "Listar":
        listar();break;
    default:
        echo "nao encontrou chave";
}

function incluir(){
    $nome=$_POST["nome"];
    include 'CadastroController.php';
    $contr=new CadastroController();
    $contr->cadastrarCadastro($nome);
}

function alterar(){
    $nome=$_POST["nome"];
    $id=$_POST["id"];
    include 'CadastroController.php';
    $contr=new CadastroController();
    $contr->alterarCadastro($id,$nome);
}

function excluir(){
    $id=$_REQUEST["idCadastro"];
    include 'CadastroController.php';
    $contr=new CadastroController();
    $contr->excluirCadastro($id);
}

function listar(){
    include_once '../view/formListarCadastro.php';
}
?>