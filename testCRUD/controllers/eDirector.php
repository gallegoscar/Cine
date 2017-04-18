<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.director.php");
	$obj = new director();
	if (isset($_POST['id_director'])){
		echo $obj->delete($_POST['id_director']);
	}
	else{
		echo "-2";
	}
?>
