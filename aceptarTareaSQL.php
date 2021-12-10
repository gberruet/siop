<?php
session_start();
if(!isset($_SESSION)){
	header("location:index.php");
} else {
require_once("configs/conexion.php");

$id=$_GET['id'];

// Agrego al nuevo usuario en la tabla mrbs_users_usa
$modificoTarea="UPDATE siop_actualizaciones SET estado_ejecucion=2 WHERE id=$id LIMIT 1";
$modificoTareaQuery=mysql_query($modificoTarea);

}

// ------------- Variables de session -------------------------
//$smarty->assign('idUsa',$_SESSION["idUsa"]);
//$smarty->assign('usuarioUsa',$_SESSION["usuarioUsa"]);
//$smarty->assign('tipoUsa',$_SESSION["tipoUsa"]);

header("location:inicio.php");

?>