<?php

$servidor='localhost';
$usuariooo='sacap';
$pass='sacconpos';
$base='aulas';

$conectar=mysql_connect($servidor,$usuariooo,$pass)or die('Fallo en la conexion');

$basededatos=mysql_select_db($base,$conectar)or die('Fallo en la conexion con la base de datos');

?>