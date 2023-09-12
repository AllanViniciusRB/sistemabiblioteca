<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/Usuario.php";

Class UsuarioController{

    private $usuarioModel;

    public function __construct(){
        $this->usuarioModel = new Usuario();
    }

    public function listarUsuarios(){
        return $this->usuarioModel->listar();
    }

    public function cadastrarUsuario(){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $dados = [
                'nome'=>$_POST['nome'],
                'email'=>$_POST['email'],
                'senha'=>password_hash($_POST['senha'],PASSWORD_DEFAULT),
                'perfil'=>$_POST['perfil'],
            ];
           
            $this->usuarioModel->cadastrar($dados);

            header('location: index.php');
            exit;
        }
    }
    public function editarUsuario(){
        $id = $_GET['id'];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $dados = [
                'nome'=>$_POST['nome'],
                'email'=>$_POST['email'],
                'senha'=>password_hash($_POST['senha'],PASSWORD_DEFAULT),
                'perfil'=>$_POST['perfil'],
            ];
           
            $this->usuarioModel->editar($id, $dados);

            header('location: index.php');
            exit;
        }
        return $this->usuarioModel->buscarUsuario($id);
    }

}
