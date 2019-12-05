<?php
include('./dbc.php');

$id = $_POST['id'];

$query = $dbc->prepare("DELETE FROM produtos WHERE id = :id");

$query->execute([':id' => $id]);

header('Location: ../indexProdutos.php');

