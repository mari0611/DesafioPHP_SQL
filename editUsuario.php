<?php

session_start();

if (!$_SESSION['usuario']) header('Location: ./login.php');

include('./includes/dbc.php');
include('./includes/header.php');

$erro_nome = false;
$erro_email = false;
$erro_senha = false;
$erro_senhaConf = false;



if($_POST) {
    // validar informações:
    $erro_nome = (empty($_POST['nome']));
    $erro_email = (empty($_POST['email']));
    $erro_senha = (strlen($_POST['senha']) < 6);
    $erro_senhaConf = ($_POST['senha'] != $_POST['confirmarSenha']);

    $usuarios['nome'] = $_POST['nome'];
    $usuarios['email'] = $_POST['email'];
    $usuarios['senha'] = $hashSenha = trim(password_hash($_POST['senha'], PASSWORD_DEFAULT));

       
 
if(!$erro_nome && !$erro_email && !$erro_senha) {
    $query = $dbc->prepare("UPDATE usuarios set 
                        nome= :nome,
                        email= :email,
                        senha= :senha                        
                        WHERE id= :id");

    $executou = $query->execute([
        ':id' => $_POST['id'],
        ':nome' => $_POST['nome'],
        ':email' => $_POST['email'],
        ':senha' => $hashSenha 
        
        
        ]);

        if ($executou) {
            header('Location: ./login.php');
        
        }   else {
            print_r($query->errorInfo());
            die();
        }

}  

} else { 
    
    $id = $_GET['id'];

    $query = $dbc->prepare("SELECT * FROM usuarios WHERE usuarios.id=:id;");

    $query->execute([':id' => $id]);
    

    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC)[0];



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
    

    <main class="container mt-4">
        <div class="row">
            <div class="col-6 offset-3">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" value="<?=$usuarios['nome'] ?>" class="form-control <?= $erro_nome ? 'is-invalid' : '' ?>" id="nome" aria-describedby="nome">
                        <div class="invalid-feedback">
                        O campo nome é de preenchimento obrigatório.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email" value="<?=$usuarios['email'] ?>" class="form-control <?= $erro_email ? 'is-invalid' : '' ?>" id="email" aria-describedby="email">
                        <div class="invalid-feedback">
                        O campo email é de preenchimento obrigatório.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nome">Alterar senha:</label>
                        <input type="password" name="senha" value="<?=$usuarios['senha'] ?>" class="form-control <?= $erro_senha ? 'is-invalid' : '' ?>" id="senha" aria-describedby="senha">
                        <div class="invalid-feedback">
                        A senha deve conter mais de 6 caracteres.
                        </div>
                    </div>

                   

                    <input type="hidden" name="id" value="<?=$id ?>">
                    <button class="btn btn-primary float-right mb-3" type="submit">Salvar alterações</button>

                    
                </form>
            </div>
        </div>
    </main>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>