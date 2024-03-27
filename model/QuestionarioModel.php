<?php
class SubGeneroModel{
    protected $nome;
    protected $gen;
    protected $id;

    public function __construct($id,$nome,$gen){
        $this->id=$id;
        $this->nome=$nome;
        $this->gen=$gen;
    }

    public function getID(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getGen(){
        return $this->gen;
    }

    public function setNome($nome){
        $this->nome=$nome;
    }

    public function setGen($gen){
        $this->gen=$gen;
    }

    public function cadastrarSubGenero(SubGeneroModel $subgenero){
        include_once '../dao/SubGeneroDAO.php';
        $subgenero=new SubGeneroDAO();
        $subgenero->cadastrarSubGenero($this);
    }

    public function listarSubGeneros(){
        include '../dao/SubGeneroDAO.php';
        $dao=new SubGeneroDAO(null);
        return $dao->listarSubGeneros();
    }

    public function resgataPorID($idSubGenero){
        include '../dao/SubGeneroDAO.php';
        $model=new SubGeneroDAO(null);
        return $model->resgataPorID($idSubGenero);
    }

    public function alterarSubGenero(SubGeneroModel $subgenero){
        include_once '../dao/SubGeneroDAO.php';
        $cadastro=new SubGeneroDAO();
        $cadastro->alterarSubGenero($this);
    }

    public function excluirSubGenero($idSubGenero){
        include_once '../dao/SubGeneroDAO.php';
        $cadastro=new SubGeneroDAO();
        $cadastro->excluirSubGenero($idSubGenero);
    }
}
?>