<?php
class QuestionarioDAO{
    public function cadastrarQuestionario(QuestionarioModel $questionario){
        include_once 'Conexao.php';
        $conex=new Conexao();
        $conex->fazConexao();
        
        $subGenString=$questionario->getGen();
        $sqlGen="SELECT idgenero FROM genero WHERE nome='$subGenString'";
        $res=$conex->conn->query($sqlGen);
        $idGen=$res->fetch(PDO::FETCH_OBJ);
        
        $sql="INSERT INTO questionario (nome,genero_idgenero) VALUES (:nome,:gen)";
        $stmt=$conex->conn->prepare($sql);
        $stmt->bindValue(':nome',$questionario->getNome());
        $stmt->bindValue(':gen',$idGen->idgenero);
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
        $sql="SELECT * FROM questionario ORDER BY genero_idgenero";
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
        $sqlGen="SELECT idgenero FROM genero WHERE nome='$subGenString'";
        $res=$conex->conn->query($sqlGen);
        $idGen=$res->fetch(PDO::FETCH_OBJ);

        $sql="UPDATE questionario SET nome=:nome,genero_idgenero=:idGen WHERE idquestionario=:id";
        $stmt=$conex->conn->prepare($sql);
        echo "SUB GENERO :".$questionario->getID()."<BR>";
        echo "NOME :".$questionario->getNome()."<BR>";
        echo "ID GENERO :".$idGen->idgenero."<BR>";

        $stmt->bindValue(':id',$questionario->getID());
        $stmt->bindValue(':nome',$questionario->getNome());
        $stmt->bindValue(':idGen',$idGen->idgenero);
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