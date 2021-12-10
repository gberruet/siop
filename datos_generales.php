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
    <script language="JavaScript">
      function aviso(url){
        if (!confirm("¿Realmente desea eliminarlo?")) {
          return false;
          } else {
            document.location = url;
            return true;
          }
        }
    </script>
  </head>
  <body>
  <?php
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

    /*CONSULTO SI TIENE ACTUALIZACIONES*/
    $sql_actualizar=mysql_query("select siop_actualizaciones.id, siop_actualizaciones.idPuesto, siop_actualizaciones.fecha, siop_actualizaciones.descripcion, mrbs_datosgenerales.nombre from siop_actualizaciones inner join mrbs_datosgenerales where siop_actualizaciones.idPuesto=mrbs_datosgenerales.idLocal AND siop_actualizaciones.fecha='$fecha' AND siop_actualizaciones.estado=1 order by siop_actualizaciones.id");
    // Vista Template 
    $smarty->display('menuBuscar.tpl');
  ?>
  <div id="resultado">
    <table class="table table-bordered table-condensed">
             <?php
                require_once("configs/conexion.php");
                $var=$_GET['id'];
                $resultado = mysql_query("SELECT idEdificio, idSector, idPuesto, idLocal, nombre, dwg, superficie, uso, capacidad, capacidad_tablero, estado, aluminio, chapa, madera, vidrios, cielorrasos, pintura, pisos, mobiliario, cortinas, pizarrones, electricidad, gas, aire, alarma, audio_video, luz_emergencia, matafuegos, sanitarios from mrbs_datosgenerales where idLocal='$var'");
                $número_filas = mysql_num_fields($resultado);
                if (!$resultado) {
                    die('Falló la consulta: ' . mysql_error());
                }

                $reg = mysql_fetch_array($resultado, MYSQL_BOTH);//LA VARIABLE $REG GUARDA LOS REGISTROS DE LA CONSULTA REALIZADA               
                
                /*MUESTRO EL EDIFICIO*/
                if($reg[0]<>0){

                  $sql=mysql_query("select * from mrbs_edificios where idEdificio='$reg[0]'");
                  
                  $edificio=mysql_fetch_array($sql);

                  echo '<tr><td class="success" colspan="25">'.$edificio[0].' '.$edificio[1].'</td></tr>';

                  /*MUESTRO EL SECTOR*/
                if($reg[1]<>0){

                  $sql=mysql_query("select * from mrbs_sectores where idSector='$reg[1]'");
                  
                  $sector=mysql_fetch_array($sql);

                  echo '<tr><td class="warning" colspan="25">'.$reg[0].'.'.$sector[0].' '.$sector[1].'</td></tr>';
                  }

                  /*MUESTRO EL PUESTO*/
                if($reg[2]<>0){

                  $sql=mysql_query("select * from mrbs_puestos where idPuesto='$reg[2]'");
                  
                  $puesto=mysql_fetch_array($sql);

                  echo '<tr><td class="danger" colspan="25">'.$reg[0].'.'.$reg[1].'.'.$puesto[0].' '.$puesto[1].'</td></tr>';
                  }
                
                }
                ?>
                <tr> 
              <?php /* obtener los metadatos de la columna */
                $x = 4;
                while ($x < mysql_num_fields($resultado)) {
                  $metadatos = mysql_fetch_field($resultado, $x);
                  if (!$metadatos) {
                      echo "No hay información disponible<br />\n";
                  }
                  echo "<th class='active'>".ucwords(strtolower($metadatos->name))."</th>";
                $x++;
                }
                
              ?>
            </tr>
            <?php
                echo "<tr>";
                //echo "<th>".$reg[1]."</th>";
                for ($i = 4; $i < $número_filas; $i++) {
                  
                  if($reg[$i]==""){echo "<td>".'No posee'."</td>";}//EN CADA CELDA SE COLOCA EL CONTENIDO DE REG
                  
                  else{echo "<td>".$reg[$i]."</td>";}

                }               
                echo "</tr>";      
            ?>           
    </table>

    <div>
      <a href="inicio.php" class="btn btn-default">Volver</a>
      <a href='editar_datos.php?id=<?php echo $var;?>' class="btn btn-primary">Editar Datos</a>
      <a href="javascript:;" class="btn btn-danger" onclick="aviso('eliminarPuesto.php?id=<?php echo $var;?>'); return false;">Eliminar</a>
    </div>

    <h3>CARGAR ACTUALIZACIÓN</h3>
    <form class="form-inline" name="nueva_actualizacion" action="registro.php" method="POST">
      <input type="hidden" name="id" value=<?php echo $var;?>>
      <!-- DIV INGRESAR FECHA
      <div class="form-group">
        <label>Fecha</label><br>
        <input type="date" class="form-control" name="fecha" placeholder="dd/mm/aaaa" required>
      </div>
      -->
      <div class="form-group">
        <label>Proveedor</label><br>
        <input type="text" class="form-control" name="proveedor" placeholder="Proveedor" required></textarea>
      </div>
      <div class="form-group">
        <label>Descripción</label><br>
        <input type="text" class="form-control" name="descripcion" placeholder="Máx. 200 carácteres" maxlength="200" required></textarea>
      </div>
      <div class="form-group">
        <label>Importe</label><br>
        <input type="text" class="form-control" name="importe" placeholder="$ 100.00" required>
      </div>
      <div class="form-group">
        <label>Ejecución</label><br>
        <select name="ejecucion" class="form-control" required>
          <option value="">Seleccionar</option>
          <option value="1">Obras y Proyectos</option>
          <option value="2">Mantenimiento</option>
          <option value="3">Intendencia</option>
          <option value="4">Informática</option>
        </select>
      </div>
      <div class="form-group">
        <label>Próxima Actualización</label><br>
        <input type="date" class="form-control" name="proxima" placeholder="dd/mm/aaaa">
      </div>
      <div class="form-group">
        <label></label><br>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></button>
      </div>
    </form>

    <center><h3>ÚLTIMAS ACTUALIZACIONES</h3></center>

    <div id="resultado"><?php include('consulta.php');?></div>
  </div>
     <?php $smarty->display('footer.tpl'); ?>

<?php } ?>