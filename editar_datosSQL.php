<?php
session_start();
if(!isset($_SESSION)){
	header("location:index.php");
} else {
require_once("configs/conexion.php");
$var=$_GET['id'];
$edificio=$_POST['edificio'];
$sector=$_POST['sector'];
$puesto=$_POST['puesto'];
$nombre=$_POST['nombre'];
$superficie=$_POST['superficie'];
$uso=$_POST['uso'];
$capacidad=$_POST['capacidad'];
$capacidad_tablero=$_POST['capacidad_tablero'];
$estado=$_POST['estado'];
$aluminio=$_POST['aluminio'];
$chapa=$_POST['chapa'];
$madera=$_POST['madera'];
$vidrios=$_POST['vidrios'];
$cielorrasos=$_POST['cielorrasos'];
$pintura=$_POST['pintura'];
$pisos=$_POST['pisos'];
$mobiliario=$_POST['mobiliario'];
$cortinas=$_POST['cortinas'];
$pizarrones=$_POST['pizarrones'];
$electricidad=$_POST['electricidad'];
$gas=$_POST['gas'];
$aire=$_POST['aire'];
$alarma=$_POST['alarma'];
$audio_video=$_POST['audio_video'];
$luz_emergencia=$_POST['luz_emergencia'];
$matafuegos=$_POST['matafuegos'];
$sanitarios=$_POST['sanitarios'];

if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
  $archivo = $_FILES['archivo']['name'];
  $act_archivo="UPDATE mrbs_datosgenerales SET dwg = '$archivo' WHERE idLocal = $var LIMIT 1 ;";
  $act_archivoQuery=mysql_query($act_archivo);
  move_uploaded_file($_FILES['archivo']['tmp_name'], "archivos/$archivo");	
	}

$actualizarDatos="UPDATE mrbs_datosgenerales SET
idEdificio = '$edificio',
idSector = '$sector', 
idPuesto = '$puesto', 
nombre = '$nombre',
superficie = '$superficie', 
uso = '$uso', 
capacidad = '$capacidad', 
capacidad_tablero = '$capacidad_tablero', 
estado = '$estado', 
aluminio = '$aluminio', 
chapa = '$chapa', 
madera = '$madera', 
vidrios = '$vidrios', 
cielorrasos = '$cielorrasos', 
pintura = '$pintura', 
pisos = '$pisos', 
mobiliario = '$mobiliario', 
cortinas = '$cortinas', 
pizarrones = '$pizarrones', 
electricidad = '$electricidad', 
gas = '$gas', 
aire = '$aire', 
alarma = '$alarma', 
audio_video = '$audio_video', 
luz_emergencia = '$luz_emergencia', 
matafuegos = '$matafuegos',
sanitarios = '$sanitarios'
WHERE idLocal = $var
LIMIT 1 ;";

$actualizarDatosQuery=mysql_query($actualizarDatos);

}

// ------------- Variables de session -------------------------
//$smarty->assign('idUsa',$_SESSION["idUsa"]);
//$smarty->assign('usuarioUsa',$_SESSION["usuarioUsa"]);
//$smarty->assign('tipoUsa',$_SESSION["tipoUsa"]);

header("location:datos_generales.php?id=$var");

?>