<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.director.php");
	$obj = new director();
	if (isset($_POST['id_director']) && isset($_POST['nombre']) && isset($_POST['celular'])&& isset($_POST['id'])){
		$obj->id_director=$_POST['id_director'];
		$obj->nombre=$_POST['nombre'];
		$obj->celular=$_POST['celular'];
		$obj->id=$_POST['id'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
