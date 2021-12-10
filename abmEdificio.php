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
  <head>
    <meta charset="utf8_general_ci">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIOP</title> 
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="favicon/manifest.json">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="SIOP">
    <meta name="application-name" content="SIOP">
    <meta name="theme-color" content="#ffffff">
 
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
 <?php
    // Vista Menu
  if($_SESSION['tipoUsa']==1){
    $edificio=$_POST['edificio'];
    $sector=$_POST['sector'];
    $puesto=$_POST['puesto']; 
    $fecha=date("Y-m-d");

    /*SELECT MENÚ EDIFICIOS*/
    $sql=mysql_query('select * from mrbs_edificios');
    while($rowEnt=mysql_fetch_array($sql)){
      $smarty->append('datosEdificios',
        array(
          'idEdificio'=> $rowEnt['idEdificio'],
          'nombre'=> $rowEnt['nombre']
        ));
      };

    /*SELECT MENÚ SECTORES*/
    $sql=mysql_query('select * from mrbs_sectores');
    while($rowEnt=mysql_fetch_array($sql)){
      $smarty->append('datosSectores',
        array(
          'idSector'=> $rowEnt['idSector'],
          'nombre'=> $rowEnt['nombre']
        ));
      };

    /*SELECT MENÚ PUESTOS*/
    $sql=mysql_query('select * from mrbs_puestos');
    while($rowEnt=mysql_fetch_array($sql)){
      $smarty->append('datosPuestos',
        array(
          'idPuesto'=> $rowEnt['idPuesto'],
          'nombre'=> $rowEnt['nombre']
        ));
      };
    // Vista Template 
    $smarty->display('menuBuscar.tpl');
  ?> 
<div id="resultado">
  <div class="container"> 
  <h3>ABM - Edificios</h3>
    <?php
      require_once("configs/conexion.php");
      $sqlSectores=mysql_query("SELECT * FROM mrbs_edificios");
    ?>
    <table class="table">
      <td><strong>Nro.</strong></td>
      <td><strong>Nombre</strong></td>
      <td></td>
      <td></td>
      <?php while($row=mysql_fetch_array($sqlSectores)){
        echo '<tr><td>'.$row[0].'</td>';
        echo '<td>'.$row[1].'</td>';
        echo '<td>Editar</td>';
        echo '<td>Eliminar</td></tr>';
      }?>
    </table>
  </div>
</div>
    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
    <script src="js/bootstrap.min.js"></script>
    <?php $smarty->display('footer.tpl'); ?>
  </body>
</html>
<?php } 
}?>