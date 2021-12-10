<script LANGUAGE="JavaScript">

   function confirmDel(url){
//var agree = confirm("¿Realmente desea eliminar el registro?");
if (confirm("¿DESEA ELIMINARLO?"))
    window.location.href = url;
else
    return false ;
}
</script>
<?php

require_once("configs/conexion.php");

$pues=$_GET['id'];
 
//consulta todos los empleados
$sql=mysql_query("SELECT * FROM siop_actualizaciones WHERE idPuesto='$pues' AND estado=1"); ?>
<table class="table">
	<tr style="background:#ddd;">
		<td>Fecha</td>
    <td>Proveedor</td>
		<td>Descripción</td>
    <td>Ejecución</td>
		<td>Importe</td>
    <td>Estado</td>
    <td>Observaciones</td>
    <td>Próxima Actualización</td>
    <td></td>
    <td></td>
	</tr>
<?php
  while($row = mysql_fetch_array($sql)){
  echo "<tr>";
  	echo "<td>".date("d/m/Y",strtotime($row['fecha']))."</td>";
    echo "<td>".$row['proveedor']."</td>";
  	echo "<td>".$row['descripcion']."</td>";
    //PREGUNTO A QUE AREA CORRESPONDE LA EJECUCIÓN
    if($row['ejecucion']==1){
      echo "<td>Mismo Proveedor</td>";
    }else if($row['ejecucion']==2){
      echo "<td>Mantenimiento</td>";
    }else if($row['ejecucion']==3){
      echo "<td>Intendencia</td>";
    }else {
      echo "<td>Informática</td>";
    } //END IF

  	echo "<td>$ ".$row['importe']."</td>";

    //PREGUNTO EN QUE ESTADO SE ENCUENTRA LA EJECUCION
    if ($row['estado_ejecucion']==1){
    echo "<td>ENVIADO</td>";
    }else if($row['estado_ejecucion']==2){
    echo "<td>ACEPTADO</td>";
    }else{
    echo "<td>FINALIZADO</td>";
    }

    //PREGUNTO SI HAY OBSERVACIONES
    if ($row['observaciones']==""){
    echo "<td>NINGUNA</td>";
    }else{
    echo "<td>".$row['observaciones']."</td>";
    }

    echo "<td>".date("d/m/Y",strtotime($row['proxima']))."</td>";
    echo '<td><a href="editarActualizacion.php?var='.$row['id'].'"><span class="glyphicon glyphicon-pencil"></span></a></td>';
    echo '<td><a onclick=confirmDel("eliminarActualizacion.php?id='.$pues.'&var='.$row['id'].'")><span class="glyphicon glyphicon-trash"></span></a></td>';
  	echo "</tr>";
  }
?>
</table>