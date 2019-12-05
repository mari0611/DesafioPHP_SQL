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
    // validar informações:
    $erro_nome = (strlen($_POST['nome']) < 3);
    $erro_preço = !(is_numeric($_POST['preço']) && $_POST['preço'] > 0);
    $erro_foto = !($_FILES['foto']);

    $produtos['nome'] = $_POST['nome'];
    $produtos['descrição'] = $_POST['descrição'];
    $produtos['preço'] = $_POST['preço'];
    $produtos['foto'] = $_FILES['foto']['name'];
    
    if ($_FILES['foto']['error'] == 0) {
        $nomeFoto = $_FILES['foto']['name'];
        $caminhoTmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file(
            $caminhoTmp, 
            './assets/img/' . $nomeFoto
        );
       
    }
    
if(!$erro_nome && !$erro_preço) {
    $query = $dbc->prepare("UPDATE produtos set 
                        nome= :nome,
                        descrição= :descricao,
                        preço= :preco,
                        foto= :foto
                        WHERE id= :id");

    $executou = $query->execute([
        ':id' => $_POST['id'],
        ':nome' => $_POST['nome'],
        ':descricao' => $_POST['descrição'],
        ':preco' => $_POST['preço'],
        ':foto' =>  './assets/img/' . $nomeFoto
        
        ]);

        if ($executou) {
            header('Location: ./indexProdutos.php');
        
        }   else {
            print_r($query->errorInfo());
            die();
        }

}

    
} else { 
    
    $id = $_GET['id'];

    $query = $dbc->prepare("SELECT * FROM produtos WHERE produtos.id=:id;");

    $query->execute([':id' => $id]);
    

    $produtos = $query->fetchAll(PDO::FETCH_ASSOC)[0];



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
    

    <main class="container mt-3">
        <div class="row">
            <div class="col-6 offset-3">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" value="<?=$produtos['nome'] ?>" class="form-control <?= $erro_nome ? 'is-invalid' : '' ?>" id="nome" aria-describedby="nome">
                        <div class="invalid-feedback">
                        O nome deve conter mais de 3 caracteres.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="descrição">Descrição</label>
                        <input type="text" name="descrição" value="<?=$produtos['descrição'] ?>" class="form-control" id="descrição" aria-describedby="descrição">
                    </div>

                    <div class="form-group">
                        <label for="nome">Preço cadastrado:</label>
                        <input type="number" name="preço" value="<?=$produtos['preço'] ?>" class="form-control <?= $erro_preço ? 'is-invalid' : '' ?>" id="preço" aria-describedby="preço">
                        <div class="invalid-feedback">
                        Digite um valor numérico.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto do produto:</label>
                        <img src="<?= $produtos['foto'] ?>">
                        <input type="file" name="foto" value="<?=$produtos['foto'] ?>" class="form-control mt-3 <?= $erro_foto ? 'is-invalid' : '' ?>" id="foto" aria-describedby="foto">
                        <div class="invalid-feedback">
                        A foto é obrigatória.
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