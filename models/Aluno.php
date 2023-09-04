<?php

class Aluno{

   protected $db;
   protected $table = "alunos";

   public function __construct()
   {
        $this->db= DBConexão::getConexao();
   }

   /**
   * Busca registro unico
   * @param int $id
   * @return Usuario
   */
   public function buscarAluno($id, $dados){

      
      try{
         //Montagem Temporária.
         $sql = "SELECT * FROM {$this->table} WHERE id_usuario = :id;";
         $stmt = $this->db->prepare($sql);
         $usuario=$stmt->fetch(PDO::FETCH_ASSOC);
         $stmt->execute();
         $usuarioID= "id_usuario";
         $stmt->blindParam(':id', $id, PDO::PARAM_INT);
         
         if($usuario){
            echo "ID: ". $dados['id_usuario']. "<br>";
            echo "Nome: ". $dados['nome']. "<br>";
            echo "cpf: ". $dados['email']. "<br>";
            echo "email: ". $dados['email']. "<br>";
            echo "telefone". $dados['telefone'];
            echo "celular". $dados['celular'];
            echo "data_nascimento". $dados['data_nascimento'];
            
         }
      }catch (PDOException $e){

      echo "Erro na busca do Aluno" .$e->getMessage();
   }
}

   /**
    *Listar todos os registros da tabela do usuário
    */
   public function listarAluno($id, $dados){
      try{
      $sql = "SELECT * FROM {$this->table} WHERE id_usuario = :id;";
      $stmt = $this->db->prepare($sql);
      $usuario=$stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->execute();
      $stmt->BlindParam(':id', $id, PDO::PARAM_INT);

      if($usuario){
         echo "ID: ". $dados['id_usuario']. "<br>";
         echo "Nome: ". $dados['nome']. "<br>";
         echo "cpf: ". $dados['email']. "<br>";
         echo "email: ". $dados['email']. "<br>";
         echo "telefone". $dados['telefone'];
         echo "celular". $dados['celular'];
         echo "data_nascimento". $dados['data_nascimento'];

         
      }
      }catch(PDOException $e){
         echo "Erro na listagem do Aluno" .$e->getMessage();
      }
   }

   /**
    *Cadastrar Usuários.
    *
    *@param array $dados
    *@return bool
    */

   public function cadastrarAluno($dados){

      try{
         $sql = "INSERT INTO {$this->table}(nome, cpf, email, telefone, celular, data_nascimento)
         VALUES(:nome, :cpf, :email, :telefone, :celular, :data_nascimento)";


         $stmt = $this->db->prepare($sql);
      }catch(PDOException $e){
         echo "Erro na preparação da consulta" .$e->getMessage();
      }
      $stmt = $this->db->prepare($sql);
      
      $stmt ->bindParam('nome', $dados['nome']);
      $stmt ->bindParam('cpf', $dados['cpf']);
      $stmt ->bindParam('email', $dados['email']);
      $stmt ->bindParam('telefone', $dados['telefone']);
      $stmt ->bindParam('celular', $dados['celular']);
      $stmt ->bindParam('data_nascimento', $dados ['data_nascimento']);

      try{
         $stmt->execute();
         echo "Execução bem sucedida!";

      }catch(PDOException $e){
         echo "Erro na inserção do aluno" .$e->getMessage();
      }
     
   
   }
   /**
    *Editar Usuários.
    *
    *@param int $id
    *@param array $dados
    *@return bool
    */
   public function editarAluno($id, $dados){

      try{
         $sql= ("UPDATE {$this->table} usuarios SET nome = :nome, :cpf, :email, :telefone, :celular, :data_nascimento 
         WHERE id_usuario = :$id");

         $stmt = $this->db->prepare($sql);

      }catch(PDOException $e){
         echo "Erro na atualização dos dados: " . $e->getMessage();
      }

      $stmt ->bindParam('nome', $dados['nome']);
      $stmt ->bindParam('cpf', $dados['cpf']);
      $stmt ->bindParam('email', $dados['email']);
      $stmt ->bindParam('telefone', $dados['telefone']);
      $stmt ->bindParam('celular', $dados['celular']);
      $stmt ->bindParam('data_nascimento', $dados ['data_nascimento']);

   try{

      $stmt->execute();

      echo "Seus dados foram atualizados com Sucesso!!";

  } catch (PDOException $e) {

      echo "erro na inserção: " . $e->getMessage();
  }    
   }
   //Excluir dados do usuário.
   public function excluir($id){

      
      try{

         //Montagem e preparação do SQL
         $sql= "DELETE FROM {$this->table} WHERE id = id_usuario";
         $stmt= $this->db->prepare($sql);

         //Passagem de parametros
         $stmt->blindParam(':id', $id, PDO::PARAM_INT);
         $stmt->execute();
      }
      catch(PDOException $e){
         echo "Erro na preparação da consulta do aluno:" . $e->getMessage();
      }
      
      
   }

}