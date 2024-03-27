<?php
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
    $gen=$_POST['comboCadastro'];
    include 'QuestionarioController.php';
    $contr=new QuestionarioController();
    $contr->cadastrarQuestionario($nome,$gen);
}

function alterar(){
    $nome=$_POST["nome"];
    $id=$_POST["idSubGen"];
    $idGen=$_POST["comboCadastro"];

    //include_once "../controller/CadastroController.php";
    //$resGen=CadastroController::resgataPorIDSub($row->cadastro_idcadastro);
    //$resGen=$resGen->fetch(PDO::FETCH_OBJ);

    include 'QuestionarioController.php';
    $contr=new QuestionarioController();
    $contr->alterarQuestionario($id,$nome,$idGen);
}

function excluir(){
    $id=$_REQUEST["idQuestionario"];
    include 'QuestionarioController.php';
    $contr=new QuestionarioController();
    $contr->excluirQuestionario($id);
}

function listar(){
    include_once '../view/formListarQuestionario.php';
}
?>