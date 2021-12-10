<?php
require 'libs/Smarty.class.php';
$smarty = new Smarty;

session_start();
if(!isset($_SESSION['idUsa'])){
  header("location:index.php");
} else {
  include_once("configs/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIOP</title>

    <script language="JavaScript" type="text/javascript" src="js/ajax.js"></script>
 
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <!-- CSS de EditInPlace -->
    <link href="css/editinplace.css" rel="stylesheet" media="screen">
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <?php
    // Vista Template 
    $smarty->display('menuDos.tpl');
    $var=$_GET['id'];
    $sql=mysql_query("SELECT siop_actualizaciones.*, mrbs_datosgenerales.idLocal, mrbs_datosgenerales.nombre
      FROM siop_actualizaciones INNER JOIN mrbs_datosgenerales
      ON siop_actualizaciones.id=$var LIMIT 1");
    $row=mysql_fetch_array($sql);
  ?>
<div class="container"> 
<h3>Finalizar Tarea</h3>

<form action="cargoTareaSQL.php" method="POST">

<div class="form-inline">
<label>Fecha:&nbsp;</label><?php echo $row[2];?>
<input type="hidden" name ="id" value="<?php echo $row[0];?>">
</div>

<br>

<div class="form-inline">
  <div class="input-group">
    <label>Puesto: &nbsp;</label><?php echo $row[11];?>
  </div>
</div>

<br>

<div class="form-inline">
  <div class="input-group">
    <label>Descripción: &nbsp;</label><?php echo $row[4];?>
  </div>
</div>

<br>

<div class="form-inline">
  <div class="input-group">
    <label>Observaciones: &nbsp;</label>
    <textarea name="observaciones" class="form-control" rows="4" placeholder="Ninguna"></textarea>
  </div>
</div>
<br>

<div class="botonSubmit">
  <button type="submit" class="btn btn-success">Finalizar Tarea</button>
  <a class="btn btn-default" href="inicio.php" role="button">Volver</a>
</div>

</form>

    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php } ?>