<?php
ini_set('display_errors', 'off');
include_once("resources/class.database.php");

class director{
	var $id_director;
	var $nombre;
  var $celular;
	var $id;

function director(){
}

function select($id_director){
	$sql =  "SELECT * FROM pelicula.tbl_director WHERE id_director = '$id_director'";
	try {
		$row = pg::query($sql);
		$row=pg_fetch_array($row);
		$this->id_director = $row['id_director'];
		$this->nombre = $row['nombre'];
		$this->descripcion = $row['celular'];
		$this->id = $row['id'];
		return true;
	}
	catch (DependencyException $e) {
	}
}

function delete($id_director){
	$sql = "DELETE FROM pelicula.tbl_director WHERE id_director = '$id_director'";
	try {
		pg::query("begin");
		$row = pg::query($sql);
		pg::query("commit");
		return "1";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
		return "-1";
	}
}

function insert(){
	if ($this->validaP($this->id_director) == false){
		$sql = "INSERT INTO pelicula.tbl_director( id_director, nombre, celular, id) VALUES ( '$this->id_director', '$this->nombre', '$this->celular', '$this->id')";
		try {
			pg::query("begin");
			$row = pg::query($sql);
			pg::query("commit");
			echo "1";
		}
		catch (DependencyException $e) {
			echo "Error: " . $e;
			pg::query("rollback");
			echo $e;
		}
	}
	else{
		$sql="UPDATE pelicula.tbl_director set celular='" . $this->celular . "', nombre='" . $this->nombre . "',id='" . $this->id . "' WHERE id_director='" . $this->id_director . "'";
		pg::query("begin");
		$row = pg::query($sql);
		pg::query("commit");
		echo "2";
	}
}

function validaP ($id_director){
      $sql =  "SELECT * FROM pelicula.tbl_director WHERE id_director = '$id_director'";
      try {
		$row = pg::query($sql);
		if(pg_num_rows($row) == 0){
		        return false;
	        }
		else{
			return true;
		 }
		}
		catch (DependencyException $e) {
			//pg::query("rollback");
			return false;
		}
}

function getTabla(){

	$sql="SELECT * FROM pelicula.tbl_director";
	try {
		echo "<div class='container' style='margin-top: 10px'>";
		echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
		echo "<thead>";
		echo "<tr>";
		echo "	<th>Codigo</th>";
		echo "	<th>Nombre</th>";
		echo "	<th>Celular</th>";
		echo "	<th>Obra</th>";
		echo "	<th>.</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<tr class='gradeA'>";
			echo "	<th>" . $row['id_director'] . "</th>";
			echo "	<th>" . $row['nombre'] . "</th>";
			echo "	<th>" . $row['celular'] . "</th>";
			echo "	<th>" . $row['id'] . "</th>";
			echo "	<th><a href='#' class='btn btn-danger' onclick='elimina(\"" . $row['id_director'] . "\")'>X<i class='icon-white icon-trash'></i></a>.<a href='#' class='btn btn-primary' onclick='edit(\"" . $row['id_director'] . "\", \"" . $row['nombre'] . "\", \"" . $row['celular'] . "\", \"" . $row['id'] . "\")'>E<i class='icon-white icon-refresh'></i></a></th>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
}

function getTablaInicianPorA(){

	$sql="select * from pelicula.tbl_director where nombre like 'A%'";
	try {
		echo "<div class='container' style='margin-top: 10px'>";
		echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id='example'>";
		echo "<thead>";
		echo "<tr>";
		echo "	<th>Codigo</th>";
		echo "	<th>Nombre</th>";
		echo "	<th>Celular</th>";
		echo "	<th>Obra</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<tr class='gradeA'>";
			echo "	<th>" . $row['id_director'] . "</th>";
			echo "	<th>" . $row['nombre'] . "</th>";
			echo "	<th>" . $row['celular'] . "</th>";
			echo "	<th>" . $row['id'] . "</th>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
}

function getTablaPDF(){

	$sql="select * from pelicula.tbl_director";
	$tabla="";
	try {
		$tabla="<table>";
		$tabla=$tabla . "<tr>";
		$tabla=$tabla . "	<td>Codigo</td>";
		$tabla=$tabla . "	<td>Nombre</td>";
		$tabla=$tabla . "	<td>Celular</td>";
		$tabla=$tabla . "	<td>Obra</td>";
		$tabla=$tabla . "</tr>";

		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			$tabla=$tabla . "<tr>";
			$tabla=$tabla . "	<td>" . $row['id_director'] . "</td>";
			$tabla=$tabla . "	<td>" . $row['nombre'] . "</td>";
			$tabla=$tabla . "	<td>" . $row['celular'] . "</td>";
			$tabla=$tabla . "	<td>" . $row['id'] . "</td>";
			$tabla=$tabla . "</tr>";
		}
		$tabla=$tabla . "</table>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
	return $tabla;
}

function getLista(){

	$sql="SELECT * FROM pelicula.tbl_director";
	try {
		echo "<SELECT id_director='id_director'>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<OPTION value='".$row['id_director']."'> ".$row['nombre']." ".$row['celular']." ".$row['id']."</OPTION>";
		}
		echo "</SELECT>";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
	}
}

function getAutocomplete(){
	$res="";
	$sql="SELECT * FROM pelicula.tbl_director";
	try {
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			$res .= '"' . $row['id_director'] . ', ' . $row['nombre'] . ', ' . $row['celular'] . ', ' . $row['id'] . '"';
			$res .= ',';
		}
		$res = substr ($res, 0, -2);
		$res = substr ($res, 1);
	}
	catch (DependencyException $e) {
	}
	return $res;
}
  function lista_obra(){
	$sql="SELECT * FROM pelicula.tbl_obra";

	$result = pg::query($sql);
            if (!$result) {
                echo "Problema con la consulta " . $query . "<br/>";
                echo pg_last_error();
                exit();
            }
           $lista_obra = null;

            while($myrow = pg_fetch_assoc($result)) {
                $lista_obra .= "<option value=\"".$myrow['id']."\">".$myrow['nombre']."</option>";
            }
            echo $lista_obra;
}
}
?>
