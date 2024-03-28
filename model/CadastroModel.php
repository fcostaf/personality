<?php
class CadastroModel{
    protected $nome;
    protected $idade;
    protected $genero;
    protected $id;

    public function __construct($id,$nome,$idade,$genero){
        $this->id=$id;
        $this->nome=$nome;
        $this->idade=$idade;
        $this->genero=$genero;
    }

    public function getID(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getIdade(){
        return $this->idade;
    }

    public function getGenero(){
        return $this->genero;
    }

    public function setNome($nome){
        $this->nome=$nome;
    }

    public function setIdade($idade){
        $this->idade=$idade;
    }

    public function setGenero($genero){
        $this->genero=$genero;
    }

    public function cadastrarCadastro(CadastroModel $cadastro){
        include_once '../dao/CadastroDAO.php';
        $cadastro=new CadastroDAO();
        $cadastro->cadastrarCadastro($this);
    }

    public function listarCadastros(){
        include_once '../dao/CadastroDAO.php';
        $dao=new CadastroDAO(null);
        return $dao->listarCadastros();
    }

    public function resgataPorID($idCadastro){
        include '../dao/CadastroDAO.php';
        $model=new CadastroDAO(null);
        return $model->resgataPorID($idCadastro);
    }

    public function resgataPorIDSub($idCadastro){
        include_once '../dao/CadastroDAO.php';
        $model=new CadastroDAO(null);
        return $model->resgataPorID($idCadastro);
    }

    public function alterarCadastro(CadastroModel $cadastro){
        include_once '../dao/CadastroDAO.php';
        $cadastro=new CadastroDAO();
        $cadastro->alterarCadastro($this);
    }

    public function excluirCadastro($idCadastro){
        include_once '../dao/CadastroDAO.php';
        $cadastro=new CadastroDAO();
        $cadastro->excluirCadastro($idCadastro);
    }
}
?>