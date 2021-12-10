<?php
require_once "config.inc.php";

function combo($db,$nombre,$valor,$tabla,$campos,$condicion,$orden,$modo,$espadre)
{
	$query = "SELECT ".$campos." from ".$tabla." order by ".$orden." ".$modo;
	$consulta=$db->query($query);
	if ($hayregistros=$consulta->fetch_array())
	{
		echo "<select name='".$nombre."' id='".$nombre."'>";
			if ($espadre==1)
			{
				echo "<option value=''>Seleccionar</option>";
				do
				{
					echo "<option value='".$hayregistros[0]."'";
					if ($hayregistros[0]==$valor) echo " selected";
					echo ">".$hayregistros[1]."</option>\r\n";
				}
				while ($hayregistros=$consulta->fetch_array());
			}
		echo "</select>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1" />
	<script type="text/javascript" src="jquery.js"></script>
	
	<script type="text/javascript">
	function llamada(combo,tabla,campos,referencia,valor,seleccionada)
	{
		$(combo).empty().append("<option value=''>Cargando...</option>");
		$.ajax({
			dataType: "json",
			type: "GET",
			url: "combobox.php",
			data: { tabla:tabla,campos:campos,referencia: referencia, valor: valor }
		})
		.done(function(json) {
			$(combo).empty().append("<option value=''>Seleccionar</option>");
			$.each(json, function (i, items) {
				if(items !== null) if (items["id"]==seleccionada) $("<option>").appendTo(combo).val(items["id"]).text(items["label"]).attr("selected","selected");
				else if(items !== null) $("<option>").appendTo(combo).val(items["id"]).text(items["label"]);
			});
		});
	}
	
	$(document).ready(function() 
	{
		/* COMBOBOX */
		$(".combobox select:not(#idnieto)").change(function()
		{
			var idpadre = $("#idpadre").find(':selected').val();
			var idhijo = $("#idhijo").find(':selected').val();
			
			if (idpadre!="")
			{
				/* combo al hijo */
				llamada("#idhijo","mrbs_sectores","idSector,nombre,idEdificio","idEdificio",idpadre,idhijo);
				llamada("#idnieto","mrbs_puestos","idPuesto,nombre,idSector","idSector",idhijo,"");
			}
		});
	});
	</script>
	
</head>
<body>

<div id="resultados">
<?php
if (isset($_POST)) print_r($_POST);
?>
</div>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="combobox">
	<fieldset>
		<p><label>Edificio:</label><?php combo($db,"idpadre","","mrbs_edificios","idEdificio,nombre",1,"idEdificio","asc",1); ?></p>
		<p id="combo_1"><label>Sector:</label><?php combo($db,"idhijo","","mrbs_sectores","idSector,nombre",1,"idSector","asc",0); ?></p>
		<p id="combo_2"><label>Puesto:</label><?php combo($db,"idnieto","","mrbs_puestos","idPuesto,nombre",1,"idPuesto","asc",0); ?></p>
		<input type="submit" name="submit" value="Mostrar resultados">
	</fieldset>
</form>

</body>
</html>