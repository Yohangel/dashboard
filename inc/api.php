<?php
include("config.php");
$dashboard = new dashboard;
if (isset($_GET['method']))
	{
		$method = $_GET['method']; 
	}
if (isset($_GET['id'])) 
	{
		$id = $_GET['id'];
	}
if (isset($_GET['text'])) 
	{
		$text = $_GET['text'];
	}
if (!empty($method))
{
	if ($method=='addChronometer')
	{
		$dashboard->addChronometer($id);
	}
	elseif ($method=='totalTime')
	{
		$dashboard->totalTime($id);
	}
	elseif ($method=='pauseChronometer')
	{
		$dashboard->pauseChronometer($id);
	}
	elseif ($method=='startnowChronometer')
	{
		$dashboard->startnowChronometer($id);
	}
	elseif ($method=='stopChronometer')
	{
		$dashboard->stopChronometer($id);
	}
	elseif ($method=='hasActChronometer')
	{
		$dashboard->hasActChronometer($id);
	}
	elseif ($method=='hasPausedChronometer')
	{
		$dashboard->hasPausedChronometer($id);
	}
	elseif ($method=='saveReport')
	{
		$dashboard->saveReport($id,$text);
	}
	elseif ($method=='comprobarMaquina')
	{
		$dashboard->comprobarMaquina($id);
	}
	elseif ($method=='guardar_proyecto')
	{
		if (isset($_GET['nombre'])) {  $nombre = $_GET['nombre'];}
		if (isset($_GET['descripcion'])) {  $descripcion = $_GET['descripcion'];}
		if (isset($_GET['fecha'])) {  $fecha = $_GET['fecha'];}
		if (isset($_GET['fecha_entrega'])) {  $fecha_entrega = $_GET['fecha_entrega'];}
		if (isset($_GET['asignado'])) { $asignado = $_GET['asignado'];}
		if (isset($_GET['departament_id'])) { $departament_id = $_GET['departament_id'];}
		$dashboard->guardar_proyecto($nombre,$descripcion,$fecha,$fecha_entrega,$asignado,$departament_id);
	}
	elseif ($method=='guardar_tarea')
	{
		if (isset($_GET['nombre'])) {  $nombre = $_GET['nombre'];}
		if (isset($_GET['fecha'])) {  $fecha = $_GET['fecha'];}
		if (isset($_GET['fecha_entrega'])) {  $fecha_entrega = $_GET['fecha_entrega'];}
		if (isset($_GET['asignado'])) { $asignado = $_GET['asignado'];}
		if (isset($_GET['project'])) { $project = $_GET['project'];}
		$dashboard->guardar_tarea($nombre,$fecha,$fecha_entrega,$asignado,$project);
	}
}
?>