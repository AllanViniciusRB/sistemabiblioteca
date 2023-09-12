<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/cabecalho.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/UsuarioController.php";

    $usuarioControler = new UsuarioController();

    $usuarioControler->cadastrarUsuario();
?>

<main class="container mt-3 mb-3">
    <h1>Cadastrar Usuário</h1>

    <form action="cadastrar.php" method="post" class = "row g-3">

        <div class="col-md-12">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome" required>
        </div>
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="col-md-6">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" name="senha" id="senha" required>
        </div>
        <div class="col-md-8">
        <label for="Perfil" class="form-label">Perfil</label>
        <select name="perfil" class="form-select" id="perfil" required>
            <option>Selecione o Perfil</option>
            <option value="usuario">Usuario</option>
            <option value="administrador">Administrador</option>
        </select>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>

    </form>

  
</main>  
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/rodape.php";?> 