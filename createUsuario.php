<?php 

session_start();

   
include('./includes/dbc.php');
include('./includes/header.php');

$erro_nome = false;
$erro_email = false;
$erro_senha = false;
$erro_senhaConf = false;

$query = $dbc->prepare("SELECT * from usuarios");

$query->execute();
// Recuperando os dados
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);


if($_POST) {
 
    $erro_nome = (empty($_POST['nome']));
    $erro_email = (empty($_POST['email']));
    $erro_senha = (strlen($_POST['senha']) < 6);
    $erro_senhaConf = ($_POST['senha'] != $_POST['confirmarSenha']);



    if(!$erro_nome && !$erro_email && !$erro_senha) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $hashSenha = trim(password_hash($_POST['senha'], PASSWORD_DEFAULT));

       

        $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome','$email', '$hashSenha')";
        $insert = $dbc->prepare($query);

            
        $insert->execute();

        header('Location: login.php');

     
}
      
 
}  

  
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>


</head>
<body>

<div class="container mt-5">
        <div class="row">
        <div class="col-4">
             
            <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-group mt-2">
            <h2>Crie sua conta</h2><br>
            <h3>É rápido e fácil</h3>
                <label for="nomeInput">Nome</label>
                <input id="nomeInput" name="nome" type="text" class="form-control <?= $erro_nome ? 'is-invalid' : '' ?>" />
                <div class="invalid-feedback">
                O campo nome é de preenchimento obrigatório.
                </div>
            </div>
            <div class="form-group">
                <label for="emailInput">E-mail</label>
                <input id="emailInput" name="email" type="email" class="form-control <?= $erro_email ? 'is-invalid' : '' ?>" />
                <div class="invalid-feedback">
                O campo email é de preenchimento obrigatório.
                </div>
            </div>
            <div class="form-group">
                <label for="senhaInput">Senha <br> <small class="text-muted">Mínimo 6 caracteres</small></label>
                <input id="senhaInput" name="senha" type="password" class="form-control <?= $erro_senha ? 'is-invalid' : '' ?>" />
                <div class="invalid-feedback">
                A senha deve conter mais de 6 caracteres.
                </div>
            </div>
            <div class="form-group">
                <label for="confirmarSenhaInput">Confirmar Senha</label>
                <input id="confirmarSenhaInput" name="confirmarSenha" type="password" class="form-control <?= $erro_senhaConf ? 'is-invalid' : '' ?>" />
                <div class="invalid-feedback">
                As senhas inseridas não coincidem.
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary w-25">Cadastrar</button>
            <a href="login.php">Já sou cadastrado</a>
            

                        
            
            </form>
        </div>
        </div>
</div>
    
<div class="container mt-5">
    <div class="row">
        <div class="table">
          
            <table>
                <thead>
                    <tr>
                    
                        <td>Nome</td>
                        <td>Ações</td>
                       
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($usuarios as $usuario) : ?>
                        
                        <tr>
                        
                        <td ><?= $usuario['nome'] ?> </td>

                        <td>  
                        <a href="editUsuario.php?id=<?=$usuario['id'] ?>" class="btn btn-info w-10">Editar</a> 
                        <a href="showUsuario.php?id=<?= $usuario['id'] ?>" class="btn btn-danger w-10">Excluir</a> 
                                       
                        </td>
                        
                                                
                        </tr>

                    
                    </div>               
                                
                    <?php endforeach; ?>
            
                    
                </tbody>
            </table>
                       
        </div>       
    </div>    
</div>            
        

</main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
        
</body>
</html>