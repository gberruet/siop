<?php
 
//Configuracion de la conexion a base de datos
  require_once("configs/conexion.php");
 
//variables POST
  $pues=$_POST['id'];
  $date=date("Y-m-d");
  $prov=$_POST['proveedor'];
  $desc=$_POST['descripcion'];
  $ejec=$_POST['ejecucion'];
  $peso=$_POST['importe'];
  $refr=$_POST['proxima'];
 
//registra los datos del empleados
  $sql=mysql_query("INSERT INTO siop_actualizaciones (id, idPuesto, fecha, proveedor, descripcion, ejecucion, importe, proxima, estado_ejecucion, estado)
  VALUES ('', '$pues', '$date', '$prov', '$desc', '$ejec', '$peso', '$refr', 1, 1)");

 
header("Location:datos_generales.php?id=$pues");
?>