<?php

Class UsuarioController{

    private $usuarioModel;

    public function __construct(){
        $this->usuarioModel = new Usuario();
    }

    
}