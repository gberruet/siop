<?php
$dbhost="localhost";
$dbname="aulas";
$dbuser="root";
$dbpass="lclcynpc";

$db = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if ($db->connect_errno) {
	die ("<h1>Fallo al conectar a MySQL: (" . $db->connect_errno . ") " . $db->connect_error."</h1>");
}
?>