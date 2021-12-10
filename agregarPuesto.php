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
    <h3>Agregar Aula/Oficina/Espacio</h3>
     <form enctype="multipart/form-data" action="agregarPuestoSQL.php" method="POST" >  
        <table class="table">
               <?php
               
                  require_once("configs/conexion.php");

                  /*MUESTRO EL EDIFICIO*/
                  $edificios=mysql_query("select * from mrbs_edificios ORDER BY idEdificio");
                  echo '<tr><td class="success" colspan="23">
                    <select name="edificio" class="form-control" required>
                    <option value="">--SELECCIONAR EDIFICIO--</option>';
                    while ($row=mysql_fetch_array($edificios))
                      {   
                        echo "<option value='".$row['idEdificio']."'>".$row['idEdificio'].' '.$row['nombre']."</option>"; 
                      }  
                    '</select></td></tr>';

                    /*MUESTRO EL SECTOR*/
                    $sectores=mysql_query("select * from mrbs_sectores ORDER BY idSector");
                    echo '<tr><td class="warning" colspan="23">
                    <select name="sector" class="form-control">
                    <option value="0">--SELECCIONAR SECTOR--</option>';
                    while ($row_1=mysql_fetch_array($sectores))
                      {   
                        echo "<option value='".$row_1['idSector']."'>".$row_1['idSector'].' '.$row_1['nombre']."</option>"; 
                      }  
                    '</select></td></tr>';

                    /*MUESTRO EL PUESTO*/
                    $puestos=mysql_query("select * from mrbs_puestos ORDER BY idPuesto");
                    echo '<tr><td class="danger" colspan="23">
                    <select name="puesto" class="form-control">
  	                  <option value="0">--SELECCIONAR PUESTO--</option>';
  	                  while ($row_2=mysql_fetch_array($puestos))
  	                    {   
  	                      echo "<option value='".$row_2['idPuesto']."'>".$row_2['idPuesto'].' '.$row_2['nombre']."</option>"; 
  	                    }  
                    '</select></td></tr>';
              ?>
       </table>  
      
        <div class="col-md-4">
          <label>Nombre</label>
          <input type="text" class="form-control" name="nombre" required>
        </div>

        <div class="col-md-4">
          <label>Superficie (Ancho/Largo/Alto = Mts2)</label>
          <input type="text" class="form-control" name="superficie" placeholder="Ancho/Largo/Alto = Mts2">
        </div>

        <div class="col-md-4">
          <label>Uso</label>
          <input type="text" class="form-control" name="uso">
        </div>

        <div class="col-md-4">
          <label>Capacidad</label>
          <input type="number" class="form-control" name="capacidad">
        </div>

        <div class="col-md-4">
          <label>Capacidad Tablero</label>
          <input type="number" class="form-control" name="capacidad_tablero">
        </div>

       <div class="col-md-4">
          <label>Estado General</label>
          <select name="estado" class="form-control">
            <option value="NO CARGADO">--SELECCIONAR--</option>
            <option value="BUENO">BUENO</option>
            <option value="REGULAR">REGULAR</option>
            <option value="MALO">MALO</option>
          </select>
        </div>

        <div class="col-md-4">
          <label>Carpinterias Aluminio</label>
          <input type="text" class="form-control" name="aluminio">
        </div>

        <div class="col-md-4">
          <label>Carpinterias Chapa</label>
          <input type="text" class="form-control" name="chapa">
        </div>

       <div class="col-md-4">
          <label>Carpinterias Madera</label>
          <input type="text" class="form-control" name="madera">
        </div>

        <div class="col-md-4">
          <label>Vidrios</label>
          <input type="text" class="form-control" name="vidrios">
        </div>

        <div class="col-md-4">
          <label>Cielorrasos</label>
          <input type="text" class="form-control" name="cielorrasos">
        </div>

        <div class="col-md-4">
          <label>Pintura</label>
          <select name="pintura" class="form-control">
            <option value="NO CARGADO">--SELECCIONAR--</option>
            <option value="BUENO">BUENO</option>
            <option value="REGULAR">REGULAR</option>
            <option value="MALO">MALO</option>
          </select>
        </div>

        <div class="col-md-4">
          <label>Pisos</label>
          <input type="text" class="form-control" name="pisos">
        </div>

        <div class="col-md-4">
          <label>Mobiliario</label>
          <input type="text" class="form-control" name="mobiliario">
        </div>

        <div class="col-md-4">
          <label>Cortinas</label>
          <input type="text" class="form-control" name="cortinas">
        </div>

        <div class="col-md-4">
          <label>Pizarrones</label>
          <input type="text" class="form-control" name="pizarrones">
        </div>

        <div class="col-md-4">
          <label>Instalación Electrica</label>
          <input type="text" class="form-control" name="electricidad">
        </div>

        <div class="col-md-4">
          <label>Instalación Gas</label>
          <input type="text" class="form-control" name="gas">
        </div>

        <div class="col-md-4">
          <label>Instalación Aire Acondicionado</label>
          <input type="text" class="form-control" name="aire">
        </div>

       <div class="col-md-4">
          <label>Instalación Alarma</label>
          <input type="text" class="form-control" name="alarma">
        </div>

        <div class="col-md-4">
          <label>Equipamiento Informático</label>
          <input type="text" class="form-control" name="audio_video">
        </div>

        <div class="col-md-4">
          <label>Luz Emergencia</label>
          <input type="text" class="form-control" name="luz_emergencia">
        </div>

        <div class="col-md-4">
          <label>Instalación Matafuegos</label>
          <input type="number" class="form-control" name="matafuegos">
        </div>

        <div class="col-md-4">
          <label>Instalación Sanitarios</label>
          <input type="text" class="form-control" name="sanitarios">
        </div>

        <div class="col-md-4">
          <label>Adjuntar Archivo</label>
          <input type="file" name="archivo">
        </div>

        <div class="col-md-6">
          <button type="submit" class="btn btn-success">Aceptar</button>
          <a class="btn btn-default" href="inicio.php" role="button">Cancelar</a>
        </div>
      </form > 
  </div> <!--END CONTAINER-->
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
} ?>