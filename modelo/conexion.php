<?php

$manejador = 'mysql';
$servidor = 'localhost';
$usuario = 'root';
$pass = '';
$base = 'dbtarea';

$cadena = "$manejador:host=$servidor;dbname=$base";

$cnx = new PDO($cadena, $usuario, $pass, array(PDO::ATTR_PERSISTENT => "true", PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

