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
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
 
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
    $smarty->display('menu.tpl');?>
    <table class="table">
             <?php              
                $resultado = mysql_query('SELECT idEdificio, idSector, idPuesto, idLocal, nombre, dwg, superficie, uso, capacidad, capacidad_tablero, estado, aluminio, chapa, madera, vidrios, cielorrasos, pintura, pisos, mobiliario, cortinas, pizarrones, electricidad, gas, aire, alarma, audio_video, luz_emergencia, matafuegos, sanitarios from mrbs_datosgenerales where visible=1');
                $numero_columnas = mysql_num_fields($resultado);
                if (!$resultado) {
                  die('Falló la consulta: ' . mysql_error());
                }
                /*MUESTRO LOS EDIFICIOS*/
                $sql=mysql_query('select * from mrbs_edificios');
                $row=mysql_fetch_row($sql);
                while($row){          
                
                  echo '<tr class="edificios"><td class="success" colspan="25">'.$row[0].' '.$row[1].'</td></tr>';
                  
                  /*MUESTRO LOCALES*/
                      $locales=mysql_query("select idEdificio, idSector, idPuesto, idLocal, nombre, dwg, superficie, uso, capacidad, capacidad_tablero, estado, aluminio, chapa, madera, vidrios, cielorrasos, pintura, pisos, mobiliario, cortinas, pizarrones, electricidad, gas, aire, alarma, audio_video, luz_emergencia, matafuegos, sanitarios from mrbs_datosgenerales where idEdificio='$row[0]' and idSector='$sec[0]' and idPuesto='$pue[0]' and visible=1");
                      $cant=mysql_num_fields($locales);
                      $s=1;
                      while ($fila = mysql_fetch_array($locales, MYSQL_NUM)) {

                        echo '<tr class="locales"><td><a href=datos_generales.php?id='.$fila[3].'>'.$fila[4].'</a></td>';
                        echo '<td><a href=archivos/'.$fila[5].'>'.$fila[5].'</a></td>';
                          for ($z=6; $z < $cant; $z++) { 
                            if($fila[$z]==""){echo "<td>".'--'."</td>";} //si esta vacio
              
                            else{echo "<td>".$fila[$z]."</td>";}

                          }           
                          echo '</tr>';
                         
                          $s++;
                         
                      }
              
                  /*MUESTRO SECTORES*/
                  $sectores=mysql_query("select * from mrbs_sectores where idEdificio='$row[0]'");
                  $sec=mysql_fetch_row($sectores);
                  while($sec){
                    echo '<tr class="sectores">';
                    echo '<td class="warning" colspan="25">'.$sec[2].'.'.$sec[0].' '.$sec[1].'</td>';
                    echo "</tr>";
                  
                  /*MUESTRO LOCALES*/
                      $locales=mysql_query("select idEdificio, idSector, idPuesto, idLocal, nombre, dwg, superficie, uso, capacidad, capacidad_tablero, estado, aluminio, chapa, madera, vidrios, cielorrasos, pintura, pisos, mobiliario, cortinas, pizarrones, electricidad, gas, aire, alarma, audio_video, luz_emergencia, matafuegos, sanitarios from mrbs_datosgenerales where idEdificio='$row[0]' and idSector='$sec[0]' and idPuesto='$pue[0]' and visible=1");
                      $cant=mysql_num_fields($locales);
                      
                      while ($fila = mysql_fetch_array($locales, MYSQL_NUM)) {

                        echo '<tr class="locales"><td><a href=datos_generales.php?id='.$fila[3].'>'.$fila[4].'</a></td>';
                        echo '<td><a href=archivos/'.$fila[5].'>'.$fila[5].'</a></td>';
                          for ($z=6; $z < $cant; $z++) { 
                            if($fila[$z]==""){echo "<td>".'--'."</td>";} //si esta vacio
              
                          else{echo "<td>".$fila[$z]."</td>";}

                          
                          }           
                          echo '</tr>';
                         
                      }

                    /*MUESTRO PUESTOS*/
                    
                    $puestos=mysql_query("select * from mrbs_puestos where idSector='$sec[0]'");
                    $pue=mysql_fetch_row($puestos);
                    while($pue){
                      echo '<tr class="puestos">';
                      echo '<td class="danger" colspan="25">'.$pue[2].'.'.$pue[3].'.'.$pue[0].' '.$pue[1].'</td>';
                      echo "</tr>";
                      
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
                      /*MUESTRO LOCALES*/
                      $locales=mysql_query("select idEdificio, idSector, idPuesto, idLocal, nombre, dwg, superficie, uso, capacidad, capacidad_tablero, estado, aluminio, chapa, madera, vidrios, cielorrasos, pintura, pisos, mobiliario, cortinas, pizarrones, electricidad, gas, aire, alarma, audio_video, luz_emergencia, matafuegos, sanitarios from mrbs_datosgenerales where idEdificio='$row[0]' and idSector='$sec[0]' and idPuesto='$pue[0]' and visible=1");
                      $cant=mysql_num_fields($locales);
                      $s=1;
                      while ($fila = mysql_fetch_array($locales, MYSQL_NUM)) {

                        echo '<tr class="locales"><td><a href=datos_generales.php?id='.$fila[3].'>'.$fila[4].'</a></td>';
                        echo '<td><a href=archivos/'.$fila[5].'>'.$fila[5].'</a></td>';
                          for ($z=6; $z < $cant; $z++) { 
                            if($fila[$z]==""){echo "<td>".'--'."</td>";} //si esta vacio
              
                            else{echo "<td>".$fila[$z]."</td>";}
                          
                          }           
                          echo '</tr>';
                          
                          $s++;
                         
                      }

                      $pue=mysql_fetch_row($puestos);
                    }
                    $i++;
                    $sec=mysql_fetch_row($sectores);//SECTORES
                  
                  }
                  $row=mysql_fetch_row($sql);//EDIFICIOS
                }
              ?>
    </table><?php
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
      echo '<td>'.$row[10].'</td>';
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


    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php } ?>