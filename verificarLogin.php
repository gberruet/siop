<?php 
require 'libs/Smarty.class.php';
$smarty = new Smarty;

include_once("configs/conexion.php");

$usuarioUSA=$_POST['user'];
$passUSA=md5($_POST['password']);

// Verifico si coinciden el nombreLogin y la contrasenia y obtengo el idusuario
$sqlIdusuario="SELECT distinct idUsa, nomLoginUsa, passUsa, estado FROM siop_usuarios
WHERE nomLoginUsa='$usuarioUSA' AND passUsa='$passUSA' AND estado = 1 LIMIT 1";
$consultaIdusuarioQuery=mysql_query($sqlIdusuario);
$cantRegistros=mysql_num_rows($consultaIdusuarioQuery);
$rowId=mysql_fetch_row($consultaIdusuarioQuery);
$idUsuario=$rowId[0];

if($cantRegistros>0){ //(IF 1)
// Consulto los datos del usuario, ademas a que area pertenece y que privilegios tiene
$sql="SELECT distinct idUsa, nomUsa, apeUsa, emailUsa, nomLoginUsa, tipoUsa, estado FROM siop_usuarios 
WHERE idUsa=$idUsuario AND estado = 1 LIMIT 1";
$consulta=mysql_query($sql);
$row=mysql_fetch_array($consulta);

do{
	$idUsa=$row['idUsa'];  // Asigno el id a la variable
	$nomyapeUsa=$row['nomUsa']." ".$row['apeUsa'];  // Asigno el nombre y el apellido del usuario a la variable
	$tipoUsa=$row['tipoUsa'];
	
}while($row=mysql_fetch_array($consulta));

/* Variables de session */	
session_start();
$_SESSION["idUsa"]=$idUsa;
$_SESSION["usuarioUsa"]=ucwords($nomyapeUsa);
$_SESSION["tipoUsa"]=$tipoUsa;

header("location:inicio.php"); 	
			
}else{ //(FIN IF 1)	
	$smarty -> assign('msjError','<div class="alert alert-danger"><strong>Error: Verificar los datos ingresados!</strong></div>');
	$smarty -> display('index.tpl');
}
?>