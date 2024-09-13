<?php

$hostname = "localhost";
$database = "pessoas";
$usuario = "root";
$senha = "";

// Faz a conexão com o MySQL
$link = mysqli_connect('localhost', 'root', '');

if (!$link) {
    die('Não foi possível conectar: ' . mysql_error());
}

// Cria o banco de dados 'pessoas'
$sql = "CREATE DATABASE IF NOT EXISTS pessoas";

mysqli_query($link, $sql);

// Conecta com o banco de dados 'pessoas'
$mysqli = new mysqli($hostname, $usuario, $senha, $database);

if ($mysqli->connect_errno) {

    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$tabela = 'pessoa';

$result = mysqli_query($mysqli, "SHOW TABLES Like '$tabela'");

// Checa se o número de tables é igual a 0, se for a table 'pessoa' é criada
if (mysqli_num_rows($result) == 0) {

    $create = "CREATE TABLE pessoa (id INTEGER PRIMARY KEY AUTO_INCREMENT, nome VARCHAR(60), dataNasc DATE, idade INT, diasAniver INT)";
    $mysqli->query($create);
}