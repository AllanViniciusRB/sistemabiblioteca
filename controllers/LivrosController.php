<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/Livro.php";

Class LivroController{

    private $livroModel;

    public function __construct(){
        $this->livroModel = new Livro();
    }

    public function listarLivros(){
        return $this->livroModel->listarLivro();
    }

}