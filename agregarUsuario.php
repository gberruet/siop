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
    <meta charset="utf8_general_ci">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIOP</title>
    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="favicon/manifest.json">
    <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="SIOP">
    <meta name="application-name" content="SIOP">
    <meta name="theme-color" content="#ffffff">

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
  <h3>Agregar Usuario</h3>
  </br>

  <?php if ($msjBox==1){?>
  <div id="dialog-message" title="Mensaje del sistema">
    <p>
      <div class="alert alert-danger"><strong>¡Error! Ya existe un usuario con el DNI que desea ingresar</strong></div>
    </p>
  </div>
  <?php }else{?>

  <form action="agregarUsuarioSQL.php" method="POST">

  <div class="form-inline">
  <label>Tipo Usuario:</label></br>
  <select name="tipoUSA" class="form-control" required>
    <option value="">Seleccionar</option>
    <option value="1">Administrador</option>
    <option value="2">Mantenimiento</option>
    <option value="3">Intendencia</option>
    <option value="4">Informática</option>
  </select>
  </div>

  <br>

  <div class="form-inline">
    <div class="input-group">
      <label>Nombre</label></br>
      <input name="nombre" type="text" class="form-control"  placeholder="Ingresar nombre" required>
    </div>
    <div class="input-group">
      <label>Apellido</label>
      <input name="apellido" type="text" class="form-control"  placeholder="Ingresar Apellido" required>
    </div>
  </div>

  <br>

  <div class="form-inline">
    <div class="input-group">
      <label>DNI</label></br>
      <input name="dni" type="text" class="form-control" maxlength="8" size="14"  placeholder="Ingrese el numero" required>
    </div>
  </div>

  <br>

  <div class="form-inline">
    <div class="input-group">
      <label>Email</label></br>
      <input name="email" type="email" class="form-control"  placeholder="Ingrese correo electronico" size="55" required> <br>
      <span class="help-block">Si  desconoce el email del usuario cargue:  sin@mail.com</span>
    </div>
  </div>

  <br>

  <div class="form-inline">
    <div class="form-group">
      <label>Usuario</label></br>
      <input name="usuario" type="text" class="form-control"  placeholder="Ingresar Usuario" required>
    </div>
    <div class="form-group">
      <label>Contrase&ntilde;a</label></br>
      <input name="password" type="password" class="form-control"  placeholder="Ingresar Contrase&ntilde;a" required>
    </div>
  </div>
  <br>
  <div class="botonSubmit">
    <button type="submit" class="btn btn-success">Crear Usuario</button>
    <a class="btn btn-default" href="inicio.php" role="button">Volver</a>
  </div>

  </form>
  <br><br>
  <div>
  	<div class="contenedor">
      <div class="mensaje"></div>
      <table class="editinplace">
        <tr>
          <th>Apellido</th>
          <th>Nombre</th>
          <th>DNI</th>
          <th>Email</th>
          <th>Usuario</th>
          <th>Aréa</th>
        </tr>
      </table>
    </div>
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script>
    $(document).ready(function() 
    {
      /* OBTENEMOS TABLA */
      $.ajax({
        type: "GET",
        url: "editinplace.php?tabla=1"
      })
      .done(function(json) {
        json = $.parseJSON(json)
        for(var i=0;i<json.length;i++)
        {
          $('.editinplace').append(
            "<tr><td class='id' style='display:none'>"+json[i].id+"<td class='editable' data-campo='apeUsa'><span>"+json[i].apellidos+"</span></td><td class='editable' data-campo='nomUsa'><span>"+json[i].nombre+"</td><td class='editable' data-campo='dniUsa'><span>"+json[i].dni+"</span></td><td class='editable' data-campo='emailUsa'><span>"+json[i].email+"</span></td><td class='editable' data-campo='nomLoginUsa'><span>"+json[i].nomLoginUsa+"</span></td></span></td><td class='editable' data-campo='tipoUsa' ><span>"+json[i].tipo+"</span></td></tr>");
        }
      });
      
      var td,campo,valor,id;
      $(document).on("click","td.editable span",function(e)
      {
        e.preventDefault();
        $("td:not(.id)").removeClass("editable");
        td=$(this).closest("td");
        campo=$(this).closest("td").data("campo");
        valor=$(this).text();
        id=$(this).closest("tr").find(".id").text();
        td.text("").html("<input type='text' name='"+campo+"' value='"+valor+"'><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
      });
      
      $(document).on("click",".cancelar",function(e)
      {
        e.preventDefault();
        td.html("<span>"+valor+"</span>");
        $("td:not(.id)").addClass("editable");
      });
      
      $(document).on("click",".guardar",function(e)
      {
        $(".mensaje").html("<img src='images/loading.gif'>");
        e.preventDefault();
        nuevovalor=$(this).closest("td").find("input").val();
        if(nuevovalor.trim()!="")
        {
          $.ajax({
            type: "POST",
            url: "editinplace.php",
            data: { campo: campo, valor: nuevovalor, id:id }
          })
          .done(function( msg ) {
            $(".mensaje").html(msg);
            td.html("<span>"+nuevovalor+"</span>");
            $("td:not(.id)").addClass("editable");
            setTimeout(function() {$('.ok,.ko').fadeOut('fast');}, 3000);
          });
        }
        else $(".mensaje").html("<p class='ko'>Debes ingresar un valor</p>");
      });
    });
    
    </script>

  </div>
</div>
<?php } ?>
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