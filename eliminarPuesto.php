<?php
session_start();
if(!isset($_SESSION)){
	header("location:inicio.php");
} else {

include_once("configs/conexion.php");

/* Datos del formulario */
$id=$_GET['id'];


/* Realizo la modificacion de estado a 0 (Activo = 1 ; Inactivo = 0)) - Eliminacion Logica */
$eliminar="UPDATE mrbs_datosgenerales SET 
visible = 0
WHERE idLocal = $id
LIMIT 1 ;";

$eliminarQuery=mysql_query($eliminar);

header("Location:inicio.php");


}
?>