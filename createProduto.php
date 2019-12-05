
<?php 

session_start();
if (!$_SESSION['usuario']) header('Location: ./login.php');

include('./includes/dbc.php');
include('./includes/header.php');


$erro_nome = false;
$erro_descricao = false;
$erro_preço = false;
$erro_foto = false;

  
if($_POST) {
 
    $erro_nome = (strlen($_POST['nome']) < 3);
    $erro_preço = !(is_numeric($_POST['preco']) && $_POST['preco'] > 0);
    $erro_foto = !($_FILES['foto']);
    
if(!$erro_nome && !$erro_preço && !$erro_foto) {
    $nome = $_POST['nome'];
    $descrição = $_POST['descricao'];
    $preço = $_POST['preco'];
    
    if ($_FILES['foto']['error'] == 0) {
        $nomeFoto = $_FILES['foto']['name'];
        $caminhoTmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file(
            $caminhoTmp, 
            './assets/img/' . $nomeFoto
        );
    }
    
         
    $query = "INSERT INTO produtos (nome, descrição, preço, foto) VALUES ('$nome','$descrição', '$preço', './assets/img/$nomeFoto')";
    $insert = $dbc->prepare($query);
        
    $insert->execute();

    header('Location: indexProdutos.php');

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

    <div class="container form-group" >
    
    <div class="col-6 offset-3 mt-5">

    <form action="" method="POST" enctype="multipart/form-data">
    <h4>Insira as informações do produto:</h4>
       <label for="nome">Nome</label>
       <input
               name="nome"
               type="text"
               id="nome"
               class="form-control mb-2 <?= $erro_nome ? 'is-invalid' : '' ?>"
               placeholder="Nome">
               <div class="invalid-feedback">
                O nome deve conter mais de 3 caracteres.
                </div>

        Descrição: <textarea name="descricao" id="" cols="20" rows="5"></textarea> <br>


        <label for="preco">Preço:</label>
        <input
               name="preco"
               type="text"
               id="preco"
               class="form-control <?= $erro_preço ? 'is-invalid' : '' ?>"
               >
               
                <div class="invalid-feedback">
                Digite um valor numérico.
               </div>

        <label for="foto">Selecione a foto:</label>
        <input
               name="foto"
               type="file"
               id="foto"
               class="form-control <?= $erro_foto ? 'is-invalid' : '' ?>"
               placeholder="foto">
               
                <div class="invalid-feedback">
                É necessário inserir a foto do produto.
               </div>

               <button type="submit" class="btn btn-primary float-right w-25 mt-3">CADASTRAR</button>

           
           
       </div>

       
        

    
   
    
    </form>
    
    
    </div>
    
</body>
</html>