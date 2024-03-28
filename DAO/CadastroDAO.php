<?php
class CadastroDAO{
    public function cadastrarCadastro(CadastroModel $cadastro){
        include_once 'Conexao.php';
        $conex=new Conexao();
        $conex->fazConexao();
        $sql="INSERT INTO cadastro (nome,idade,genero) VALUES (:nome,:idade,:genero)";
        $stmt=$conex->conn->prepare($sql);
        $stmt->bindValue(':nome',$cadastro->getNome());
        $stmt->bindValue(':idade',$cadastro->getIdade());
        $stmt->bindValue(':genero',$cadastro->getGenero());
        $res=$stmt->execute();
        if($res){
            echo "<script>alert('Cadastro Realizado com sucesso');</script>";
        }
        else{
            echo "<script>alert('Erro: Não foi possível realizar o cadastro');</script>";
        }
        echo "<script>location.href='../controller/processaCadastro.php?op=Listar';</script>";
    }

    public function listarCadastros(){
        include_once 'Conexao.php';
        $conex=new Conexao();
        $conex->fazConexao();
        $sql="SELECT * FROM cadastro ORDER BY nome";
        return $conex->conn->query($sql);
    }

    public function resgataPorID($idCadastro){
        include_once 'Conexao.php';
        $conex=new Conexao();
        $conex->fazConexao();
        $sql="SELECT * FROM cadastro WHERE idcadastro='$idCadastro'";
        return $conex->conn->query($sql);
    }

    public function alterarCadastro(CadastroModel $cadastro){
        include_once 'Conexao.php';
        $conex=new Conexao();
        $conex->fazConexao();
        $sql="UPDATE cadastro SET nome=:nome,idade=:idade,genero=:genero WHERE idcadastro=:id";
        $stmt=$conex->conn->prepare($sql);
        $stmt->bindValue(':id',$cadastro->getID());
        $stmt->bindValue(':nome',$cadastro->getNome());
        $stmt->bindValue(':idade',$cadastro->getIdade());
        $stmt->bindValue(':genero',$cadastro->getGenero());
        $res=$stmt->execute();
        if($res){
            echo "<script>alert('Registro Alterado com sucesso');</script>";
        }
        else{
            echo "<script>alert('Erro: Não foi possível alterar o cadastro');</script>";
        }
        echo "<script>location.href='../controller/processaCadastro.php?op=Listar';</script>";
    }

    public function excluirCadastro($idCadastro){
        include_once 'Conexao.php';
        $conex=new Conexao();
        $conex->fazConexao();
        $sql="DELETE FROM cadastro WHERE idcadastro='$idCadastro'";
        $res=$conex->conn->query($sql);
        if($res){
            echo "<script>alert('Exclusão realizada com sucesso!');</script>";
        }
        else{
            echo "<script>alert('Não foi possível excluir o usuário!');</script>";
        }
        echo "<script>location.href='../controller/processaCadastro.php?op=Listar';</script>";
    }
}
?>