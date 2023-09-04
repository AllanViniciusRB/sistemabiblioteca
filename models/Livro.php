<?php

class Aluno{

   protected $db;
   protected $table = "livros";

   public function __construct()
   {
        $this->db= DBConexão::getConexao();
   }

   /**
   * Busca registro unico
   * @param int $id
   * @return Usuario
   */
   public function buscarLivro($id, $dados){

      
      try{
         //Montagem Temporária.
         $sql = "SELECT * FROM {$this->table} WHERE id_usuario = :id;";
         $stmt = $this->db->prepare($sql);
         $usuario=$stmt->fetch(PDO::FETCH_ASSOC);
         $stmt->execute();
         $usuarioID= "id_usuario";
         $stmt->blindParam(':id', $id, PDO::PARAM_INT);
         
         if($usuario){
            echo "ID_livro: ". $dados['id_livro']. "<br>";
            echo "Titulo: ". $dados['titulo']. "<br>";
            echo "Autor do Livro: ". $dados['autor']. "<br>";
            echo "Numero de Páginas: ". $dados['numero_pagina']. "<br>";
            echo "Valor: ". $dados['preco'];
            echo "Ano de publicação". $dados['ano_publicacao'];
            echo "ISBN: ". $dados['isbn'];
            
         }
      }catch (PDOException $e){

      echo "Erro na busca do Livro" .$e->getMessage();
   }
}

   /**
    *Listar todos os registros da tabela do usuário
    */
   public function listarLivro($id, $dados){
      try{
      $sql = "SELECT * FROM {$this->table} WHERE id_usuario = :id;";
      $stmt = $this->db->prepare($sql);
      $usuario=$stmt->fetch(PDO::FETCH_ASSOC);
      $stmt->execute();
      $stmt->BlindParam(':id', $id, PDO::PARAM_INT);

      if($usuario){
         echo "ID_livro: ". $dados['id_livro']. "<br>";
            echo "Titulo: ". $dados['titulo']. "<br>";
            echo "Autor do Livro: ". $dados['autor']. "<br>";
            echo "Numero de Páginas: ". $dados['numero_pagina']. "<br>";
            echo "Valor: ". $dados['preco'];
            echo "Ano de publicação". $dados['ano_publicacao'];
            echo "ISBN: ". $dados['isbn'];

         
      }
      }catch(PDOException $e){
         echo "Erro na listagem do Livro" .$e->getMessage();
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
      }catch(PDOException $e){
         echo "Erro na preparação da consulta" .$e->getMessage();
      }
      $stmt = $this->db->prepare($sql);
      
      $stmt ->bindParam('titulo', $dados['titulo']);
      $stmt ->bindParam('autor', $dados['autor']);
      $stmt ->bindParam('numero_pagina', $dados['numero_pagina']);
      $stmt ->bindParam('preco', $dados['preco']);
      $stmt ->bindParam('ano_publicacao', $dados['ano_publicacao']);
      $stmt ->bindParam('isbn', $dados ['isbn']);

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
   public function editarLivro($isbn, $dados){

      try{
         $sql= ("UPDATE {$this->table} livros SET titulo = :titulo, autor = :autor, numero_pagina = :numero_pagina, preco = :preco, ano_publicacao = :ano_publicacao, isbn = :isbn;
         WHERE isbn = :$isbn");

         $stmt = $this->db->prepare($sql);

      }catch(PDOException $e){
         echo "Erro na atualização dos dados: " . $e->getMessage();
      }

      $stmt ->bindParam('titulo', $dados['titulo']);
      $stmt ->bindParam('autor', $dados['autor']);
      $stmt ->bindParam('numero_pagina', $dados['numero_pagina']);
      $stmt ->bindParam('preco', $dados['preco']);
      $stmt ->bindParam('ano_publicacao', $dados['ano_publicacao']);
      $stmt ->bindParam('isbn', $dados ['isbn']);

   try{

      $stmt->execute();

      echo "Seus dados foram atualizados com Sucesso!!";

  } catch (PDOException $e) {

      echo "erro na inserção: " . $e->getMessage();
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