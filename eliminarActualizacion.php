<?php
session_start();
if(!isset($_SESSION)){
	header("location:inicio.php");
} else {

include_once("configs/conexion.php");

/* Datos del formulario */
$id=$_GET['id'];
$elimino=$_GET['var'];


/* Realizo la modificacion de estado a 0 (Activo = 1 ; Inactivo = 0)) - Eliminacion Logica */
$eliminar="UPDATE siop_actualizaciones SET 
estado = 0
WHERE id = $elimino
LIMIT 1 ;";

$eliminarQuery=mysql_query($eliminar);

header("Location:datos_generales.php?id=$id");


}
?>