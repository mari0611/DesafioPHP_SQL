<?php
$user = 'root';
$senha = 'Komp#!Linux';
$porta = 3306;
$dbname = 'desafio';
$host = 'localhost';
$dsn = "mysql:host=$host:$porta;dbname=$dbname;charset=utf8mb4";
$dbc = new PDO($dsn, $user, $senha);