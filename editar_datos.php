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
 
    <!-- CSS de Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/estilos.css" rel="stylesheet" media="screen">
 
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <?php
    // Vista Template 
    $smarty->display('menuBuscar.tpl');
  ?>
<div class="container"> 
    <table class="table">
      <?php
        require_once("configs/conexion.php");
                $var=$_GET['id'];
                $reg = mysql_query("select * from mrbs_datosgenerales where idLocal='$var'");
                $número_filas = mysql_num_fields($reg);
                if (!$reg) {
                    die('Falló la consulta: ' . mysql_error());
                }

                $reg = mysql_fetch_array($reg, MYSQL_BOTH);//LA VARIABLE $REG GUARDA LOS REGISTROS DE LA CONSULTA REALIZADA      
      ?>
      <form enctype="multipart/form-data" action='editar_datosSQL.php?id=<?php echo $var;?>' method="POST" > 
             <?php                
                /*MUESTRO EL EDIFICIO*/
                if($reg[0]<>0){

                  $sql=mysql_query("select idEdificio, nombre from mrbs_edificios ORDER BY idEdificio");
                  
                  //$edificio=mysql_fetch_array($sql);

                  echo '<tr>
                          <td class="success" colspan="23">
                            <select name="edificio" class="form-control">';
                             while ($row_1=mysql_fetch_array($sql)) 
                    {   
                        if ($row_1['idEdificio'] == $reg[0]) 
                        {    echo "<option value='".$row_1['idEdificio']."' selected>".$row_1['idEdificio'].' '.$row_1['nombre']."</option>"; 
                        } 
                        else 
                        {    echo "<option value='".$row_1['idEdificio']."'>".$row_1['idEdificio'].' '.$row_1['nombre']."</option>"; 
                        } 
                    }  
                            '</select>
                          </td>
                        </tr>';

                  /*MUESTRO EL SECTOR*/
              //  if($reg[1]<>0){

                  $sql=mysql_query("select idSector, nombre from mrbs_sectores ORDER BY idSector");
                  
                  echo '<tr>
                          <td class="warning" colspan="23">
                            <select name="sector" class="form-control">';
                            echo "<option value=''>--SELECCIONAR SECTOR--</option>";
                             while ($row_1=mysql_fetch_array($sql)) 
                    {   
                        if ($row_1['idSector'] == $reg[1]) 
                        {    echo "<option value='".$row_1['idSector']."' selected>".$row_1['idSector'].' '.$row_1['nombre']."</option>"; 
                        } 
                        else 
                        {    echo "<option value='".$row_1['idSector']."'>".$row_1['idSector'].' '.$row_1['nombre']."</option>"; 
                        } 
                    }  
                            '</select>
                          </td>
                        </tr>';
               //   }

                  /*MUESTRO EL PUESTO*/
              //  if($reg[2]<>0){

                  $sql=mysql_query("select idPuesto, nombre from mrbs_puestos ORDER BY idPuesto");

                  echo '<tr>
                          <td class="danger" colspan="23">
                            <select name="puesto" class="form-control">';
                            echo "<option value=''>--SELECCIONAR PUESTO--</option>";
                             while ($row_1=mysql_fetch_array($sql)) 
                    {   
                        if ($row_1['idPuesto'] == $reg[2]) 
                        {    echo "<option value='".$row_1['idPuesto']."' selected>".$row_1['idPuesto'].' '.$row_1['nombre']."</option>"; 
                        } 
                        else 
                        {    echo "<option value='".$row_1['idPuesto']."'>".$row_1['idPuesto'].' '.$row_1['nombre']."</option>"; 
                        } 
                    }  
                            '</select>
                          </td>
                        </tr>';
               //   }
                
                }  

            ?>
            
    </table>
      
        <div class="col-md-4">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo $reg[4];?>">
        </div>

      <div class="col-md-4">
        <label>Superficie (ANCHO/LARGO/ALTO = MTS2)</label>
        <input type="text" class="form-control" name="superficie" value="<?php echo $reg[6];?>">
      </div>

      <div class="col-md-4">
        <label>Uso</label>
        <input type="text" class="form-control" name="uso" value="<?php echo $reg[7];?>">
      </div>

      <div class="col-md-4">
        <label>Capacidad</label>
        <input type="number" class="form-control" name="capacidad" value="<?php echo $reg[8];?>">
      </div>

      <div class="col-md-4">
        <label>Capacidad Tablero</label>
        <input type="number" class="form-control" name="capacidad_tablero" value="<?php echo $reg[9];?>">
      </div>

     <div class="col-md-4">
        <label>Estado General</label>
        <select name="estado" class="form-control">
        <?php
          if ($reg[10]=="BUENO"){
            echo "<option value='BUENO' selected>BUENO</option>"; 
            echo "<option value='REGULAR'>REGULAR</option>"; 
            echo "<option value='MALO'>MALO</option>";
          }else if ($reg[10]=="REGULAR"){
            echo "<option value='BUENO'>BUENO</option>"; 
            echo "<option value='REGULAR' selected>REGULAR</option>"; 
            echo "<option value='MALO'>MALO</option>";
          }else if ($reg[10]=="MALO"){
            echo "<option value='BUENO'>BUENO</option>"; 
            echo "<option value='REGULAR'>REGULAR</option>"; 
            echo "<option value='MALO' selected>MALO</option>";
          }else{
            echo "<option value='NO CARGADO' selected>--SELECCIONAR--</option>";
            echo "<option value='BUENO'>BUENO</option>"; 
            echo "<option value='REGULAR'>REGULAR</option>"; 
            echo "<option value='MALO'>MALO</option>";
          } 
        ?>
        </select>
      </div>

      <div class="col-md-4">
        <label>Carpinterias Aluminio</label>
        <input type="text" class="form-control" name="aluminio" value="<?php echo $reg[11];?>">
      </div>

      <div class="col-md-4">
        <label>Carpinterias Chapa</label>
        <input type="text" class="form-control" name="chapa" value="<?php echo $reg[12];?>">
      </div>

      <div class="col-md-4">
        <label>Carpinterias Madera</label>
        <input type="text" class="form-control" name="madera" value="<?php echo $reg[13];?>">
      </div>

      <div class="col-md-4">
        <label>Vidrios</label>
        <input type="text" class="form-control" name="vidrios" value="<?php echo $reg[14];?>">
      </div>

      <div class="col-md-4">
        <label>Cielorrasos</label>
        <input type="text" class="form-control" name="cielorrasos" value="<?php echo $reg[15];?>">
      </div>

      <div class="col-md-4">
        <label>Pintura</label>
        <select name="pintura" class="form-control">
        <?php
          if ($reg[16]=="BUENO"){
            echo "<option value='BUENO' selected>BUENO</option>"; 
            echo "<option value='REGULAR'>REGULAR</option>"; 
            echo "<option value='MALO'>MALO</option>";
          }else if ($reg[16]=="REGULAR"){
            echo "<option value='BUENO'>BUENO</option>"; 
            echo "<option value='REGULAR' selected>REGULAR</option>"; 
            echo "<option value='MALO'>MALO</option>";
          }else if ($reg[16]=="MALO"){
            echo "<option value='BUENO'>BUENO</option>"; 
            echo "<option value='REGULAR'>REGULAR</option>"; 
            echo "<option value='MALO' selected>MALO</option>";
          }else{
            echo "<option value='NO CARGADO' selected>--SELECCIONAR--</option>";
            echo "<option value='BUENO'>BUENO</option>"; 
            echo "<option value='REGULAR'>REGULAR</option>"; 
            echo "<option value='MALO'>MALO</option>";
          } 
        ?>
        </select>
      </div>

      <div class="col-md-4">
        <label>Pisos</label>
        <input type="text" class="form-control" name="pisos" value="<?php echo $reg[17];?>">
      </div>

      <div class="col-md-4">
        <label>Mobiliario</label>
        <input type="text" class="form-control" name="mobiliario" value="<?php echo $reg[18];?>">
      </div>

      <div class="col-md-4">
        <label>Cortinas</label>
        <input type="text" class="form-control" name="cortinas" value="<?php echo $reg[19];?>">
      </div>

      <div class="col-md-4">
        <label>Pizarrones</label>
        <input type="text" class="form-control" name="pizarrones" value="<?php echo $reg[20];?>">
      </div>

      <div class="col-md-4">
        <label>Instalación Electrica</label>
        <input type="text" class="form-control" name="electricidad" value="<?php echo $reg[21];?>">
      </div>

      <div class="col-md-4">
        <label>Instalación Gas</label>
        <input type="text" class="form-control" name="gas" value="<?php echo $reg[22];?>">
      </div>

      <div class="col-md-4">
        <label>Instalación Aire Acondicionado</label>
        <input type="text" class="form-control" name="aire" value="<?php echo $reg[23];?>">
      </div>

      <div class="col-md-4">
        <label>Instalación Alarma</label>
        <input type="text" class="form-control" name="alarma" value="<?php echo $reg[24];?>">
      </div>

      <div class="col-md-4">
        <label>Audio y Video</label>
        <input type="text" class="form-control" name="audio_video" value="<?php echo $reg[25];?>">
      </div>

      <div class="col-md-4">
        <label>Luz Emergencia</label>
        <input type="text" class="form-control" name="luz_emergencia" value="<?php echo $reg[26];?>">
      </div>

      <div class="col-md-4">
        <label>Instalación Matafuegos</label>
        <input type="number" class="form-control" name="matafuegos" value="<?php echo $reg[27];?>">
      </div>

      <div class="col-md-4">
        <label>Instalación Sanitarios</label>
        <input type="text" class="form-control" name="sanitarios" value="<?php echo $reg[28];?>">
      </div>

      <div class="col-md-4">
        <label>Adjuntar Archivo</label>
        <input type="file" name="archivo">
      </div>

      <div class="col-md-6">
        <button type="submit" class="btn btn-success">Actualizar</button>
      </div>

    </form >  

    <div class="col-md-1">
      <br><a class="btn btn-default" href="datos_generales.php?id=<?php echo $var;?>" role="button">Cancelar</a>
    </div>
</div> <!--END CONTAINER-->
    <!-- Librería jQuery requerida por los plugins de JavaScript -->
    <script src="http://code.jquery.com/jquery.js"></script>
 
    <!-- Todos los plugins JavaScript de Bootstrap (también puedes
         incluir archivos JavaScript individuales de los únicos
         plugins que utilices) -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php } ?>