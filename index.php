<?php
require 'libs/Smarty.class.php';
$smarty = new Smarty;

session_start();
if(isset($SESSION)){
  	header("location:inicio.php"); 
} else { 
	$smarty->display('index.tpl');
} 
?>