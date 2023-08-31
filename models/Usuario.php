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
   public function buscar($id){

   }

   /**
    *Listar todos os registros da tabela do usuário
    */
   public function listar(){

   }

   /**
    *Cadastrar Usuários.
    *
    *@param array $dados
    *@return bool
    */

   public function cadastrar($dados){

   }

   /**
    *Editar Usuários.
    *
    *@param int $id
    *@param array $dados
    *@return bool
    */
   public function editar($id, $dados){

   }

   //Excluir dados do usuário.
   public function excluir($id){

   }

}