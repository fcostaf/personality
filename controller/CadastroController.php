<?php
class CadastroController{
    public static function cadastrarCadastro($nome){
        include '../model/CadastroModel.php';
        $cadastro=new CadastroModel(null,$nome);
        $cadastro->cadastrarCadastro($cadastro);
    }

    public static function listarCadastros(){
        include_once '../model/CadastroModel.php';
        $model=new CadastroModel(null,null);
        return $model->listarCadastros();
    }

    public static function resgataPorID($idCadastro){
        include '../model/CadastroModel.php';
        $model=new CadastroModel(null,null);
        return $model->resgataPorID($idCadastro);
    }

    public static function resgataPorIDSub($idCadastro){
        include_once '../model/CadastroModel.php';
        $model=new CadastroModel(null,null);
        return $model->resgataPorIDSub($idCadastro);
    }

    public static function alterarCadastro($id,$nome){
        include '../model/CadastroModel.php';
        $cadastro=new CadastroModel($id,$nome);
        $cadastro->alterarCadastro($cadastro);
    }

    public static function excluirCadastro($id){
        include '../model/CadastroModel.php';
        $cadastro=new CadastroModel(null,null);
        $cadastro->excluirCadastro($id);
    }
}
?>