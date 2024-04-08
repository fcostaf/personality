<?php
class QuestionarioController{
    public static function cadastrarQuestionario($q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$gen){
        include '../model/QuestionarioModel.php';
        $questionario=new QuestionarioModel(null,$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$gen);
        $questionario->cadastrarQuestionario($questionario);
    }

    public static function listarQuestionarios(){
        include_once '../model/QuestionarioModel.php';
        $model=new QuestionarioModel(null,null,null,null,null,null,null,null,null,null,null);
        return $model->listarQuestionarios();
    }

    public static function resgataPorID($idQuestionario){
        include_once '../model/QuestionarioModel.php';
        $model=new QuestionarioModel(null,null,null,null,null,null,null,null,null,null,null);
        return $model->resgataPorID($idQuestionario);
    }

    public static function alterarQuestionario($id,$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$gen){
        include '../model/QuestionarioModel.php';
        $questionario=new QuestionarioModel($id,$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$gen);
        $questionario->alterarQuestionario($questionario);
    }

    public static function excluirQuestionario($id){
        include '../model/QuestionarioModel.php';
        $questionario=new QuestionarioModel(null,null,null,null,null,null,null,null,null,null,null);
        $questionario->excluirQuestionario($id);
    }
}
?>