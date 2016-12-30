<?php

//Linea superimportante, copiar y pegar en todas las paginas
//hasta que se me encuentra la forma de no tener que hacerlo
require "/Config/autoload.php";
Config\autoload::run();

$usuarioMySQL = new \Models\Database\UsuarioMySQL();
$usuario = new \Models\Usuario("Nicolas Estefan", "Paz", "123456", "123456", "nicolaspaz95@gmail.com", $usuarioMySQL);
var_dump($usuario->valido);

