<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.obra.php");
	$obj = new obra();
	if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['descripcion'])){
		$obj->id=$_POST['id'];
		$obj->nombre=$_POST['nombre'];
		$obj->descripcion=$_POST['descripcion'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
