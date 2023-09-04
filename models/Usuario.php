<?php

class Usuario{

   protected $db;
   protected $table = "usuarios";

   public function __construct()
   {
        $this->db= DBConexão::getConexao();
   }

   /**
   * Busca registro unico
   * @param int $id
   * @return Usuario
   */
   public function buscar($id, $dados){

      
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
            echo "Email: ". $dados['email']. "<br>";
            
         }
      }catch (PDOException $e){

      echo "Erro na busca dos dados" .$e->getMessage();
   }
}

   /**
    *Listar todos os registros da tabela do usuário
    */
   public function listar($id, $dados){
      try{
      $sql = "SELECT * FROM {$this->table} WHERE id_usuario = :id;";
      $stmt = $this->db->prepare($sql);
      $usuario=$stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->execute();
      $stmt->BlindParam(':id', $id, PDO::PARAM_INT);

      if($usuario){
         echo "ID: ". $dados['id_usuario']. "<br>";
         echo "Nome: ". $dados['nome']. "<br>";
         echo "Email: ". $dados['email']. "<br>";
         
      }

      }catch(PDOException $e){
         echo "Erro na busca dos dados" .$e->getMessage();
      }
   }

   /**
    *Cadastrar Usuários.
    *
    *@param array $dados
    *@return bool
    */

   public function cadastrar($dados){

      try{
         $sql = "INSERT INTO {$this->table}(nome, email, senha, perfil)
         VALUES(:nome, :email, :senha, :perfil)";


         $stmt = $this->db->prepare($sql);
      }catch(PDOException $e){
         echo "Erro na preparação da consulta" .$e->getMessage();
      }
      $stmt = $this->db->prepare($sql);
      
      $stmt ->bindParam('nome', $dados['nome']);
      $stmt ->bindParam('email', $dados['email']);
      $stmt ->bindParam('senha', $dados['senha']);
      $stmt ->bindParam('perfil', $dados['perfil']);

      try{
         $stmt->execute();
         echo "Execução bem sucedida!";

      }catch(PDOException $e){
         echo "Erro na inserção dos dados" .$e->getMessage();
      }
     
   
   }

   /**
    *Editar Usuários.
    *
    *@param int $id
    *@param array $dados
    *@return bool
    */
   public function editar($id, $dados){

      try{
         $sql= ("UPDATE {$this->table} usuarios SET nome = :nome, email = :email, senha = :senha 
         WHERE id_usuario = :$id");

         $stmt = $this->db->prepare($sql);

      }catch(PDOException $e){
         echo "Erro na atualização dos dados: " . $e->getMessage();
      }

      $stmt ->bindParam('nome', $dados['nome']);
      $stmt ->bindParam('email', $dados['email']);
      $stmt ->bindParam('senha', $dados['senha']);
      $stmt ->bindParam('perfil', $dados['perfil']);

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
         echo "Erro na preparação da consulta:" . $e->getMessage();
      }
      
      
   }

}