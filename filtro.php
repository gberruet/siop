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

    include_once("functions_sql.php");

    $smarty->display('menuBuscar.tpl');

    ?>

    <div id="resultado">
    <table class="table">
    <?php           
      $resultado = mysql_query('SELECT idEdificio, idSector, idPuesto, idLocal, nombre, dwg, superficie, uso, capacidad, capacidad_tablero, estado, aluminio, chapa, madera, vidrios, cielorrasos, pintura, pisos, mobiliario, cortinas, pizarrones, electricidad, gas, aire, alarma, audio_video, luz_emergencia, matafuegos, sanitarios
        from mrbs_datosgenerales
        where visible=1
        order by idEdificio, idSector, idPuesto');
      $cant = mysql_num_fields($resultado); //Nro de campos
                
      if (!$resultado) {
        die('Falló la consulta: ' . mysql_error());
      }

      /*BUSCO DATOS SEGUN FILTRO*/
      $locales=mysql_query("SELECT mrbs_datosgenerales.idEdificio, idSector, idPuesto, idLocal, mrbs_datosgenerales.nombre, dwg, superficie, uso, capacidad, capacidad_tablero, estado, aluminio, chapa, madera, vidrios, cielorrasos, pintura, pisos, mobiliario, cortinas, pizarrones, electricidad, gas, aire, alarma, audio_video, luz_emergencia, matafuegos, sanitarios, mrbs_edificios.nombre
        FROM mrbs_datosgenerales
        INNER JOIN mrbs_edificios ON mrbs_datosgenerales.idEdificio=mrbs_edificios.idEdificio
        WHERE mrbs_datosgenerales.idEdificio='$edificio' AND idSector='$sector' AND idPuesto='$puesto' AND visible=1
        ORDER BY mrbs_datosgenerales.nombre");
      
      $total_registros=mysql_num_rows($locales); //Número de filas

      if($total_registros != 0){
        if($edificio!=0){
          $idEdificio=mysql_query("SELECT * FROM mrbs_edificios WHERE idEdificio='$edificio'");
          $row=mysql_fetch_array($idEdificio);
          echo '<tr class="edificios"><td class="success" colspan="25">'.$row[0].' '.$row[1].'</td></tr>';
        }
        if($sector!=0){
          $idSector=mysql_query("SELECT * FROM mrbs_sectores WHERE idSector='$sector'");
          $row=mysql_fetch_array($idSector);
          echo '<tr class="sectores"><td class="warning" colspan="25">'.$edificio.'.'.$row[0].' '.$row[1].'</td></tr>';
        }
        if($puesto!=0){
          $idPuesto=mysql_query("SELECT * FROM mrbs_puestos WHERE idPuesto='$puesto'");
          $row=mysql_fetch_array($idPuesto);
          echo '<tr class="puestos"><td class="danger" colspan="25">'.$edificio.'.'.$sector.'.'.$row[0].' '.$row[1].'</td></tr>';
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
        while ($fila = mysql_fetch_array($locales, MYSQL_NUM)) {
          echo '<tr class="locales"><td><a href=datos_generales.php?id='.$fila[3].'>'.$fila[4].'</a></td>';
          echo '<td><a href=archivos/'.$fila[5].'>'.$fila[5].'</a></td>';
          for ($z=6; $z < $cant; $z++) { 
            if($fila[$z]==""){
              echo "<td>".'--'."</td>";} //si esta vacio
            else{
              echo "<td>".$fila[$z]."</td>";}
            }           
          echo '</tr>';
        }

        //SI NO HAY REGISTROS
        }else{
          echo '<div class="alert alert-info" role="alert"><strong>No se encontraron resultados</strong></div>';
        }

    ?>
    </table>
    </div>
    <?php
  }else{
    $smarty->display('menuDos.tpl');?>
    <div class="container"> 
    <h3>Tareas del d&iacute;a</h3>
  <?php
    require_once("configs/conexion.php");
    $tipoUsa=$_SESSION['tipoUsa'];
    $sqlSectores=mysql_query("SELECT siop_actualizaciones.*, mrbs_datosgenerales.nombre
    from siop_actualizaciones
    inner join mrbs_datosgenerales
    on siop_actualizaciones.idPuesto=mrbs_datosgenerales.idLocal
    where siop_actualizaciones.ejecucion=$tipoUsa AND siop_actualizaciones.estado_ejecucion != 3
    order by siop_actualizaciones.estado_ejecucion DESC");
  ?>
  <table class="table">
    <td><strong>Fecha</strong></td>
    <td><strong>Puesto</strong></td>
    <td><strong>Descripci&oacute;n</strong></td>
    <td><strong>Estado</strong></td>
    <td></td>
    <td></td>
    <?php while($row=mysql_fetch_array($sqlSectores)){
      echo '<tr><td>'.$row[2].'</td>';
      echo '<td>'.$row[11].'</td>';
      echo '<td>'.$row[4].'</td>';
      //PREGUNTO EN QUE ESTADO SE ENCUENTRA LA EJECUCION
      if ($row[8]==1){
      echo "<td>EN ESPERA</td>";
      echo "<td><a href='aceptarTareaSQL.php?id=$row[0]' class='btn btn-primary'>Aceptar</a></td>";
      }else{
      echo "<td>ACEPTADO</td>";
      echo "<td><a href='cargoTarea.php?id=$row[0]' class='btn btn-success'>Finalizar</a></td>";
      }
    }?>
  </table>
</div><?php
  }
  
 ?>
   <?php $smarty->display('footer.tpl'); ?>

   <?php } ?>