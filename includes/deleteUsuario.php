<?php
include('./dbc.php');

$id = $_POST['id'];

$query = $dbc->prepare("DELETE FROM usuarios WHERE id = :id");

$query->execute([':id' => $id]);

header('Location: ../createUsuario.php');
