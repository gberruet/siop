<?php
session_start();
if(!isset($_SESSION)){
	header("location:index.php");
} else {
require_once("configs/conexion.php");

$edificio=$_POST['edificio'];
$sector=$_POST['sector'];
$puesto=$_POST['puesto'];
$nombre=$_POST['nombre'];
$archivo = $_FILES['archivo']['name'];
	if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {
		move_uploaded_file($_FILES['archivo']['tmp_name'], "archivos/$archivo");	
	}
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

$cargarDatos="INSERT INTO mrbs_datosgenerales(idEdificio, idSector, idPuesto, idLocal, nombre, dwg, superficie, uso, capacidad, capacidad_tablero, estado, aluminio, chapa, madera, vidrios, cielorrasos, pintura, pisos, mobiliario, cortinas, pizarrones, electricidad, gas, aire, alarma, audio_video, luz_emergencia, matafuegos, sanitarios, visible)
VALUES ('$edificio', '$sector', '$puesto', NULL, '$nombre', '$archivo', '$superficie', '$uso', '$capacidad', '$capacidad_tablero', '$estado', '$aluminio', '$chapa', '$madera', '$vidrios', '$cielorrasos', '$pintura', '$pisos', '$mobiliario', '$cortinas', '$pizarrones', '$electricidad', '$gas', '$aire', '$alarma', '$audio_video', '$luz_emergencia', '$matafuegos', '$sanitarios', 1);";
$cargarDatosQuery=mysql_query($cargarDatos);

}


// ------------- Variables de session -------------------------
//$smarty->assign('idUsa',$_SESSION["idUsa"]);
//$smarty->assign('usuarioUsa',$_SESSION["usuarioUsa"]);
//$smarty->assign('tipoUsa',$_SESSION["tipoUsa"]);

header("location:inicio.php");

?>