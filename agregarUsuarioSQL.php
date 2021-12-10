<?php
session_start();
if(!isset($_SESSION)){
	header("location:index.php");
} else {
require_once("configs/conexion.php");

$tipoUSA=$_POST['tipoUSA'];
$nombreUSA= strtolower($_POST['nombre']);
$apellidoUSA= strtolower($_POST['apellido']);
$dniUSA=$_POST['dni'];
$emailUSA=strtolower($_POST['email']);
$usuarioUSA= strtolower($_POST['usuario']);
$passUSA=md5($_POST['password']);

/* (1) Verifico que el usuario no exista por DNI */
$verificacionUno="SELECT idUsa FROM mrbs_users_usa WHERE dniUsa='$dniUSA'";
$verificacionUnoQuery=mysql_query($verificacionUno);
$siExisteUno=mysql_num_rows($verificacionUnoQuery);

if($siExisteUno){
	
}

// Agrego al nuevo usuario en la tabla mrbs_users_usa
$cargarUsuario="INSERT INTO siop_usuarios(idUsa, nomUsa, apeUsa, dniUsa, emailUsa, nomLoginUsa, passUsa, tipoUsa, estado)
VALUES (NULL , '$nombreUSA', '$apellidoUSA', '$dniUSA', '$emailUSA', '$usuarioUSA', '$passUSA', '$tipoUSA', '1');";
$cargarUsuarioQuery=mysql_query($cargarUsuario);

}

// ------------- Variables de session -------------------------
//$smarty->assign('idUsa',$_SESSION["idUsa"]);
//$smarty->assign('usuarioUsa',$_SESSION["usuarioUsa"]);
//$smarty->assign('tipoUsa',$_SESSION["tipoUsa"]);

header("location:agregarUsuario.php");

?>