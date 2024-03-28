<?php
class QuestionarioDAO{
    public function cadastrarQuestionario(QuestionarioModel $questionario){
        include_once 'Conexao.php';
        $conex=new Conexao();
        $conex->fazConexao();
        
        $subGenString=$questionario->getGen();
        $sqlGen="SELECT idcadastro FROM cadastro WHERE nome='$subGenString'";
        $res=$conex->conn->query($sqlGen);
        $idGen=$res->fetch(PDO::FETCH_OBJ);
        
        $sql="INSERT INTO questionario (questao1,questao2,questao3,questao4,questao5,questao6,questao7,questao8,questao9,cadastro_idcadastro) VALUES (:questao1,:questao2,:questao3,:questao4,:questao5,:questao6,:questao7,:questao8,:questao9,:gen)";
        $stmt=$conex->conn->prepare($sql);
        $stmt->bindValue(':questao1',$questionario->getQ1());
        $stmt->bindValue(':questao2',$questionario->getQ2());
        $stmt->bindValue(':questao3',$questionario->getQ3());
        $stmt->bindValue(':questao4',$questionario->getQ4());
        $stmt->bindValue(':questao5',$questionario->getQ5());
        $stmt->bindValue(':questao6',$questionario->getQ6());
        $stmt->bindValue(':questao7',$questionario->getQ7());
        $stmt->bindValue(':questao8',$questionario->getQ8());
        $stmt->bindValue(':questao9',$questionario->getQ9());
        $stmt->bindValue(':gen',$idGen->idcadastro);
        $res=$stmt->execute();
        if($res){
            echo "<script>alert('Cadastro Realizado com sucesso');</script>";
        }
        else{
            echo "<script>alert('Erro: Não foi possível realizar o cadastro');</script>";
        }
        echo "<script>location.href='../controller/processaQuestionario.php?op=Listar';</script>";
    }

    public function listarQuestionarios(){
        include_once 'Conexao.php';
        $conex=new Conexao();
        $conex->fazConexao();
        $sql="SELECT * FROM questionario ORDER BY cadastro_idcadastro";
        return $conex->conn->query($sql);
    }

    public function resgataPorID($idQuestionario){
        include_once 'Conexao.php';
        $conex=new Conexao();
        $conex->fazConexao();
        $sql="SELECT * FROM questionario WHERE idquestionario='$idQuestionario'";
        return $conex->conn->query($sql);
    }

    public function alterarQuestionario(QuestionarioModel $questionario){
        include_once 'Conexao.php';
        $conex=new Conexao();
        $conex->fazConexao();

        $subGenString=$questionario->getGen();
        $sqlGen="SELECT idcadastro FROM cadastro WHERE nome='$subGenString'";
        $res=$conex->conn->query($sqlGen);
        $idGen=$res->fetch(PDO::FETCH_OBJ);

        $sql="UPDATE questionario SET questao1=:questao1,questao2=:questao2,questao3=:questao3,questao4=:questao4,questao5=:questao5,questao6=:questao6,questao7=:questao7,questao8=:questao8,questao9=:questao9,cadastro_idcadastro=:gen WHERE idquestionario=:id";
        $stmt=$conex->conn->prepare($sql);
        // echo "SUB GENERO :".$questionario->getID()."<BR>";
        // echo "NOME :".$questionario->getNome()."<BR>";
        // echo "ID GENERO :".$idGen->idgenero."<BR>";

        $stmt->bindValue(':id',$questionario->getID());
        $stmt->bindValue(':questao1',$questionario->getQ1());
        $stmt->bindValue(':questao2',$questionario->getQ2());
        $stmt->bindValue(':questao3',$questionario->getQ3());
        $stmt->bindValue(':questao4',$questionario->getQ4());
        $stmt->bindValue(':questao5',$questionario->getQ5());
        $stmt->bindValue(':questao6',$questionario->getQ6());
        $stmt->bindValue(':questao7',$questionario->getQ7());
        $stmt->bindValue(':questao8',$questionario->getQ8());
        $stmt->bindValue(':questao9',$questionario->getQ9());
        $stmt->bindValue(':gen',$idGen->idcadastro);
        $res=$stmt->execute();
        if($res){
            echo "<script>alert('Registro Alterado com sucesso');</script>";
        }
        else{
            echo "<script>alert('Erro: Não foi possível alterar o cadastro');</script>";
        }
       echo "<script>location.href='../controller/processaQuestionario.php?op=Listar';</script>";
    }

    public function excluirQuestionario($idQuestionario){
        include_once 'Conexao.php';
        $conex=new Conexao();
        $conex->fazConexao();
        $sql="DELETE FROM questionario WHERE idquestionario='$idQuestionario'";
        $res=$conex->conn->query($sql);
        if($res){
            echo "<script>alert('Exclusão realizada com sucesso!');</script>";
        }
        else{
            echo "<script>alert('Não foi possível excluir o usuário!');</script>";
        }
        echo "<script>location.href='../controller/processaQuestionario.php?op=Listar';</script>";
    }
}
?>