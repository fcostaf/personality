<?php
class QuestionarioModel{
    protected $q1;
    protected $q2;
    protected $q3;
    protected $q4;
    protected $q5;
    protected $q6;
    protected $q7;
    protected $q8;
    protected $q9;
    protected $gen;
    protected $id;

    public function __construct($id,$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$gen){
        $this->id=$id;
        $this->q1=$q1;
        $this->q2=$q2;
        $this->q3=$q3;
        $this->q4=$q4;
        $this->q5=$q5;
        $this->q6=$q6;
        $this->q7=$q7;
        $this->q8=$q8;
        $this->q9=$q9;
        $this->gen=$gen;
    }

    public function getID(){
        return $this->id;
    }

    public function getQ1(){
        return $this->q1;
    }

    public function getQ2(){
        return $this->q2;
    }

    public function getQ3(){
        return $this->q3;
    }

    public function getQ4(){
        return $this->q4;
    }

    public function getQ5(){
        return $this->q5;
    }

    public function getQ6(){
        return $this->q6;
    }

    public function getQ7(){
        return $this->q7;
    }

    public function getQ8(){
        return $this->q8;
    }

    public function getQ9(){
        return $this->q9;
    }

    public function getGen(){
        return $this->gen;
    }

    public function setQ1($q1){
        $this->q1=$q1;
    }

    public function setQ2($q2){
        $this->q2=$q2;
    }

    public function setQ3($q3){
        $this->q3=$q3;
    }

    public function setQ4($q4){
        $this->q4=$q4;
    }

    public function setQ5($q5){
        $this->q5=$q5;
    }

    public function setQ6($q6){
        $this->q6=$q6;
    }

    public function setQ7($q7){
        $this->q7=$q7;
    }

    public function setQ8($q8){
        $this->q8=$q8;
    }

    public function setQ9($q9){
        $this->q9=$q9;
    }

    public function setGen($gen){
        $this->gen=$gen;
    }

    public function cadastrarQuestionario(QuestionarioModel $questionario){
        include_once '../dao/QuestionarioDAO.php';
        $questionario=new QuestionarioDAO();
        $questionario->cadastrarQuestionario($this);
    }

    public function listarQuestionarios(){
        include '../dao/QuestionarioDAO.php';
        $dao=new QuestionarioDAO(null);
        return $dao->listarQuestionarios();
    }

    public function resgataPorID($idquestionario){
        include '../dao/QuestionarioDAO.php';
        $model=new QuestionarioDAO(null);
        return $model->resgataPorID($idquestionario);
    }

    public function alterarQuestionario(QuestionarioModel $questionario){
        include_once '../dao/QuestionarioDAO.php';
        $questionario=new QuestionarioDAO();
        $questionario->alterarQuestionario($this);
    }

    public function excluirQuestionario($idquestionario){
        include_once '../dao/QuestionarioDAO.php';
        $questionario=new QuestionarioDAO();
        $questionario->excluirQuestionario($idquestionario);
    }
}
?>