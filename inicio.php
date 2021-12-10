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

    /*CONSULTO SI TIENE ACTUALIZACIONES*/
    $sql_actualizar=mysql_query("select siop_actualizaciones.id, siop_actualizaciones.idPuesto, siop_actualizaciones.fecha, siop_actualizaciones.descripcion, mrbs_datosgenerales.nombre from siop_actualizaciones inner join mrbs_datosgenerales where siop_actualizaciones.idPuesto=mrbs_datosgenerales.idLocal AND siop_actualizaciones.fecha='$fecha' AND siop_actualizaciones.estado=1 order by siop_actualizaciones.id");

    $smarty->display('menuBuscar.tpl');?>

  <div id="resultado">
    <table class="table table-bordered table-hover table-condensed">
      <!-- MENSAJES DE ALERTA DE ACTUALIZACIÓN -->      
        <?php
          if($sql_actualizar){
            while($update=mysql_fetch_array($sql_actualizar)){
              ?>
              <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Actualizar!</strong> <?php echo date("d/m/Y",strtotime($update['fecha'])). ' ' .$update['descripcion']. ' en <a class="alert-link" href=datos_generales.php?id='.$update[1].'>'.$update[4].'</a>'; ?>
              </div>
              <?php
            }
          }
        ?>   
      <!-- FIN MENSAJES DE ALERTA DE ACTUALIZACIÓN --> 
      
             <?php              
                $resultado = mysql_query('SELECT idEdificio, idSector, idPuesto, idLocal, nombre, dwg, superficie, uso, capacidad, capacidad_tablero, estado, aluminio, chapa, madera, vidrios, cielorrasos, pintura, pisos, mobiliario, cortinas, pizarrones, electricidad, gas, aire, alarma, audio_video, luz_emergencia, matafuegos, sanitarios from mrbs_datosgenerales where visible=1 order by idEdificio, idSector, idPuesto');
                $cant = mysql_num_fields($resultado);
                
                if (!$resultado) {
                  die('Falló la consulta: ' . mysql_error());
                }
                /*MUESTRO LOS EDIFICIOS*/
                $sql=mysql_query('select * from mrbs_edificios');
                $row=mysql_fetch_row($sql);
                while($row){
                  
                  /*MUESTRO LOCALES*/
                      $locales=mysql_query("select idEdificio, idSector, idPuesto, idLocal, nombre, dwg, superficie, uso, capacidad, capacidad_tablero, estado, aluminio, chapa, madera, vidrios, cielorrasos, pintura, pisos, mobiliario, cortinas, pizarrones, electricidad, gas, aire, alarma, audio_video, luz_emergencia, matafuegos, sanitarios from mrbs_datosgenerales where idEdificio='$row[0]' and idSector='$sec[0]' and idPuesto='$pue[0]' and visible=1 order by nombre");
                      $total_registros=mysql_num_rows($locales);

                      if($total_registros != 0){ ?>
                        
                      <?php	echo '<tr class="edificios"><td class="success" colspan="25">'.$row[0].' '.$row[1].'</td></tr>';
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
                      }else{echo '<tr class="edificios"><td class="success" colspan="25">'.$row[0].' '.$row[1].'</td></tr>';}

                      while ($fila = mysql_fetch_array($locales, MYSQL_NUM)) {
                        
                        echo '<tr class="locales"><td><a href=datos_generales.php?id='.$fila[3].'>'.$fila[4].'</a></td>';
                        
                        echo '<td><a href=archivos/'.$fila[5].'>'.$fila[5].'</a></td>';
                          for ($z=6; $z < $cant; $z++) { 
                            if($fila[$z]==""){echo "<td>".'--'."</td>";} //si esta vacio
              
                            else{echo "<td>".$fila[$z]."</td>";}

                          }           
                          echo '</tr>';
                         
                      }


                  /*MUESTRO SECTORES*/
                  $sectores=mysql_query("select * from mrbs_sectores");
                  $sec=mysql_fetch_row($sectores);
                  while($sec){
                    
                  
                  /*MUESTRO LOCALES*/
                      $locales=mysql_query("select idEdificio, idSector, idPuesto, idLocal, nombre, dwg, superficie, uso, capacidad, capacidad_tablero, estado, aluminio, chapa, madera, vidrios, cielorrasos, pintura, pisos, mobiliario, cortinas, pizarrones, electricidad, gas, aire, alarma, audio_video, luz_emergencia, matafuegos, sanitarios from mrbs_datosgenerales where idEdificio='$row[0]' and idSector='$sec[0]' and idPuesto='$pue[0]' and visible=1 order by nombre");
                      $total_registros=mysql_num_rows($locales);
                      if($total_registros != 0){
                      	echo '<tr class="sectores"><td class="warning" colspan="25">'.$row[0].'.'.$sec[0].' '.$sec[1].'</td></tr>';
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
                  		}
                      while ($fila = mysql_fetch_array($locales, MYSQL_NUM)) {
                        if($fila[1] =! 0){
                          
                          echo '<tr class="locales"><td><a href=datos_generales.php?id='.$fila[3].'>'.$fila[4].'</a></td>';
                            echo '<td><a href=archivos/'.$fila[5].'>'.$fila[5].'</a></td>';
                              for ($z=6; $z < $cant; $z++) { 
                                if($fila[$z]==""){echo "<td>".'--'."</td>";} //si esta vacio                  
                                  else{echo "<td>".$fila[$z]."</td>";}                              
                              }           
                          echo '</tr>';
                        }                         
                      }

                    /*MUESTRO PUESTOS*/                    
                    $puestos=mysql_query("select * from mrbs_puestos");
                    $pue=mysql_fetch_row($puestos);

                    while($pue){
                      /*MUESTRO LOCALES*/
                      $locales=mysql_query("select idEdificio, idSector, idPuesto, idLocal, nombre, dwg, superficie, uso, capacidad, capacidad_tablero, estado, aluminio, chapa, madera, vidrios, cielorrasos, pintura, pisos, mobiliario, cortinas, pizarrones, electricidad, gas, aire, alarma, audio_video, luz_emergencia, matafuegos, sanitarios from mrbs_datosgenerales where idEdificio='$row[0]' and idSector='$sec[0]' and idPuesto='$pue[0]' and visible=1 order by nombre");
                      $total_registros=mysql_num_rows($locales);
                      if($total_registros != 0){
	                      echo '<tr class="sectores"><td class="warning" colspan="25">'.$row[0].'.'.$sec[0].' '.$sec[1].'</td></tr>';
	                      echo '<tr class="puestos"><td class="danger" colspan="25">'.$row[0].'.'.$sec[0].'.'.$pue[0].' '.$pue[1].'</td></tr>';
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
                  		}
                      while ($fila = mysql_fetch_array($locales, MYSQL_NUM)) {
                        
                          
                          echo '<tr class="locales"><td><a href=datos_generales.php?id='.$fila[3].'>'.$fila[4].'</a></td>';
                            echo '<td><a href=archivos/'.$fila[5].'>'.$fila[5].'</a></td>';
                              for ($z=6; $z < $cant; $z++) { 
                                if($fila[$z]==""){echo "<td>".'--'."</td>";} //si esta vacio                
                                  else{echo "<td>".$fila[$z]."</td>";}                            
                              }           
                          echo '</tr>';
                        
                         
                      } 
                      
                      $pue=mysql_fetch_row($puestos);

                    } //END WHILE PUESTOS
                    
                    $sec=mysql_fetch_row($sectores); 
                  
                  } //END WHILE SECTORES

                  $row=mysql_fetch_row($sql); 
                } //END WHILE EDIFICIOS
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