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
    $idade=$_POST["idade"];
    $genero=$_POST["genero"];
    include 'CadastroController.php';
    $contr=new CadastroController();
    $contr->cadastrarCadastro($nome,$idade,$genero);
}

function alterar(){
    $nome=$_POST["nome"];
    $idade=$_POST["idade"];
    $genero=$_POST["genero"];
    $id=$_POST["id"];
    include 'CadastroController.php';
    $contr=new CadastroController();
    $contr->alterarCadastro($id,$nome,$idade,$genero);
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