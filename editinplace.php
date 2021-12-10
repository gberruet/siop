<?php
$dbhost="localhost";
$dbname="aulas";
$dbuser="sacap";
$dbpass="sacconpos";
$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

function nombreArea($tipo){
	$nombre=$tipo;
	if($nombre==1){
		return 'Administrador';
	}elseif($nombre==2){
		return 'Mantenimiento';
	}elseif($nombre==3){
		return 'Intendencia';
	}else{
		return 'Informática';
	}

}

if (isset($_POST) && count($_POST)>0)
{
	if ($db->connect_errno) 
	{
		die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
	}
	else
	{
		$query=$db->query("update siop_usuarios set ".$_POST["campo"]."='".$_POST["valor"]."' where idUsa='".intval($_POST["id"])."' limit 1");
		if ($query) echo "<span class='ok'>Valores modificados correctamente.</span>";
		else echo "<span class='ko'>".$db->error."</span>";
	}
}

if (isset($_GET) && count($_GET)>0)
{
	if ($db->connect_errno) 
	{
		die ("<span class='ko'>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</span>");
	}
	else
	{
		$query=$db->query("select * from siop_usuarios order by apeUsa asc");
		$datos=array();
		while ($usuarios=$query->fetch_array())
		{
			$datos[]=array(	"id"=>$usuarios["idUsa"],
							"nombre"=>$usuarios["nomUsa"],
							"apellidos"=>$usuarios["apeUsa"],
							"dni"=>$usuarios["dniUsa"],
							"email"=>$usuarios["emailUsa"],
							"nomLoginUsa"=>$usuarios["nomLoginUsa"],
							"tipo"=>nombreArea($usuarios["tipoUsa"])
			);
		}
		echo json_encode($datos);
	}
}
?>