<?php 
  session_start();

  include('./includes/dbc.php');
  include('./includes/headerlogin.php');
  
 

  if ($_POST) {

    $query = $dbc->prepare("SELECT * from usuarios");

    $query->execute();
    
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);


    foreach($usuarios as $usuario) {
        if($_POST['email'] == $usuario['email'] && password_verify($_POST['senha'], $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario;
            
            return header('Location: indexProdutos.php');
        }
    }

    $erro = 'Usuário e senha não coincidem';
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

<div class="container">
    <div class="col-6 mt-5 offset-3">

    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <p><h3>Insira os dados de acesso:</h3></p>
            <label for="email">Email cadastrado</label>
            <input  type="email" 
                    name="email"
                    id="email" 
                    class="form-control">     
            
        </div>
        <div class="form-group">
            <label  for="senha">Password</label>
            <input  type="password"
                    id="senha"
                    name="senha" class="form-control">
        </div>
        <div class="form-group">
        <a href="createUsuario.php"><small>Ainda não tenho cadastro</small></a>
        </div>
        <button type="submit" class="btn btn-primary">Acessar</button>
    </form>
</div>

</div>

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


</body>
</html>