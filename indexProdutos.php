

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

<?php

session_start();

if (!$_SESSION['usuario']) header('Location: ./login.php');

include('./includes/dbc.php');
include('./includes/header.php');

$query = $dbc->prepare("SELECT * from produtos");

$query->execute();
// Recuperando os dados
$produtos = $query->fetchAll(PDO::FETCH_ASSOC);


?>
<main class="container mt-4">
    <div class="table">
        <div class="col-6 offset-3">
            <table>
                <thead>
                    <tr>
                    
                        <td>Nome</td>
                        <td>Descrição</td>
                        <td>Preço</td>
                        <td>Ações</td>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($produtos as $produto) : ?>
                        
                        <tr>
                        
                        <td ><?= $produto['nome'] ?> </td>
                        <td><?= $produto['descrição'] ?> </td>
                        <td>R$ <?= $produto['preço'] ?> </td>
                        <td> 
                        
                        <a style="width:120px; text-align: center" href="editProduto.php?id=<?=$produto['id'] ?>" class="btn btn-info w-20">Editar</a> 
                        <a style="width:120px; text-align: center" href="showProduto.php?id=<?= $produto['id'] ?>" class="btn btn-danger mt-1 w-20">Excluir</a> 
                            
                            
                        </td>
                        
                                                
                        </tr>               
                    
                    <?php endforeach; ?>
            
                    
                </tbody>
            </table>
</main>  
    
</body>
</html>