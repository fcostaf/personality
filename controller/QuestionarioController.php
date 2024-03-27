<?php
class QuestionarioController{
    public static function cadastrarQuestionario($nome,$gen){
        include '../model/QuestionarioModel.php';
        $questionario=new QuestionarioModel(null,$nome,$gen);
        $questionario->cadastrarQuestionario($questionario);
    }

    public static function listarQuestionarios(){
        include_once '../model/QuestionarioModel.php';
        $model=new QuestionarioModel(null,null,null);
        return $model->listarQuestionarios();
    }

    public static function resgataPorID($idQuestionario){
        include_once '../model/QuestionarioModel.php';
        $model=new QuestionarioModel(null,null,null);
        return $model->resgataPorID($idQuestionario);
    }

    public static function alterarQuestionario($id,$nome,$gen){
        include '../model/QuestionarioModel.php';
        $questionario=new QuestionarioModel($id,$nome,$gen);
        $questionario->alterarQuestionario($questionario);
    }

    public static function excluirQuestionario($id){
        include '../model/QuestionarioModel.php';
        $questionario=new QuestionarioModel(null,null,null);
        $questionario->excluirQuestionario($id);
    }
}
?>