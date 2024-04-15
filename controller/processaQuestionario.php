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
    $q1=$_POST["questao1"];
    $q2=$_POST["questao2"];
    $q3=$_POST["questao3"];
    $q4=$_POST["questao4"];
    $q5=$_POST["questao5"];
    $q6=$_POST["questao6"];
    $q7=$_POST["questao7"];
    $q8=$_POST["questao8"];
    $q9=$_POST["questao9"];
    $gen=$_POST['comboCadastro'];
    include 'QuestionarioController.php';
    $contr=new QuestionarioController();
    $contr->cadastrarQuestionario($q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$gen);
}

function alterar(){
    $q1=$_POST["questao1"];
    $q2=$_POST["questao2"];
    $q3=$_POST["questao3"];
    $q4=$_POST["questao4"];
    $q5=$_POST["questao5"];
    $q6=$_POST["questao6"];
    $q7=$_POST["questao7"];
    $q8=$_POST["questao8"];
    $q9=$_POST["questao9"];
    $id=$_POST["idquestionario"];
    $idGen=$_POST["comboCadastro"];

    //include_once "../controller/CadastroController.php";
    //$resGen=CadastroController::resgataPorIDSub($row->cadastro_idcadastro);
    //$resGen=$resGen->fetch(PDO::FETCH_OBJ);

    include 'QuestionarioController.php';
    $contr=new QuestionarioController();
    $contr->alterarQuestionario($id,$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$idGen);
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