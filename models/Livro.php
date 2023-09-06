<?php
require_once $_SERVER ['DOCUMENT_ROOT'] . "/database/DBConexao.php";
class Livro{

   protected $db;
   protected $table = "livros";

   public function __construct()
   {
        $this->db= DBConexao::getConexao();
   }

   /**
   * Busca registro unico
   * @param int $id
   * @return Usuario
   */
   public function buscarLivro($id, $dados){

      
      try{
         $query = "SELECT * FROM {$this->table} WHERE titulo = :titulo";
         $stmt = $this->db->prepare($query);  
         $stmt->bindParam(":id", $id, PDO::PARAM_INT); 
         $stmt->execute();
        
         return $stmt->fetch(PDO::FETCH_OBJ); 

     }catch(PDOException $e ){
         echo 'Erro na inserção: ' . $e->getMessage(); 
         return null; 
     }
}

   /**
    *Listar todos os registros da tabela do usuário
    */
   public function listarLivro(){
      try{
         
         $query = "SELECT * FROM {$this->table}"; 
         $stmt = $this->db->query($query); 
         return $stmt->fetchAll(PDO::FETCH_OBJ);
         
     }catch(PDOException $e){
         echo 'Erro na inserção: ' . $e->getMessage(); 
         return null; 
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
         $sql = "INSERT INTO {$this->table}(titulo, autor, numero_pagina, preco, ano_publicacao, isbn)
         VALUES(:titulo, :autor, :numero_pagina, :preco, :ano_publicacao, :isbn)";
         $stmt = $this->db->prepare($sql);

         $stmt ->bindParam('titulo', $dados['titulo']);
         $stmt ->bindParam('autor', $dados['autor']);
         $stmt ->bindParam('numero_pagina', $dados['numero_pagina']);
         $stmt ->bindParam('preco', $dados['preco']);
         $stmt ->bindParam('ano_publicacao', $dados['ano_publicacao']);
         $stmt ->bindParam('isbn', $dados ['isbn']);
         return true;

      }catch(PDOException $e){
         echo "Erro na preparação da consulta" .$e->getMessage();
         return false;
      }
   }
   /**
    *Editar Usuários.
    *
    *@param int $id
    *@param array $dados
    *@return bool
    */
   public function editarLivro($isbn, $dados){

      try{
         $sql= ("UPDATE {$this->table} livros SET titulo = :titulo, autor = :autor, numero_pagina = :numero_pagina, preco = :preco, ano_publicacao = :ano_publicacao, isbn = :isbn;
         WHERE isbn = :$isbn");

      $stmt = $this->db->prepare($sql);
      $stmt ->bindParam('titulo', $dados['titulo']);
      $stmt ->bindParam('autor', $dados['autor']);
      $stmt ->bindParam('numero_pagina', $dados['numero_pagina']);
      $stmt ->bindParam('preco', $dados['preco']);
      $stmt ->bindParam('ano_publicacao', $dados['ano_publicacao']);
      $stmt ->bindParam('isbn', $dados ['isbn']);
      return true; 
      
      }catch(PDOException $e){
         echo "Erro na atualização dos dados: " . $e->getMessage();
      return false;
      }   
   }
   //Excluir dados do usuário.
   public function excluir($id, $isbn){

      
      try{

         //Montagem e preparação do SQL
         $sql= "DELETE FROM {$this->table} WHERE isbn = isbn";
         $stmt= $this->db->prepare($sql);

         //Passagem de parametros
         $stmt->blindParam(':isbn', $isbn, PDO::PARAM_INT);
         $stmt->execute();
      }
      catch(PDOException $e){
         echo "Erro na preparação da consulta do Livro:" . $e->getMessage();
      }
      
      
   }

}