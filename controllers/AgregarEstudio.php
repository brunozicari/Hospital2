<?php

//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Estudio.php';
require '../views/AgregarEstudio.php';
require_once '../class_helper/seguridad.php';

if ($_SESSION['tipoUsuario']!=0)
{
	header('Location:./IngresoAlSistema.php');
	exit();
}

$e=new Estudio();

if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
	if (!isset($_POST['descripcion'])) die ('Error al validar la descripción');
	$descripcion=$_POST['descripcion'];
	
	if (!isset($_POST['precio'])) die ('Error al validar la descripción');
	$precio=$_POST['precio'];	
	
	if (!isset($_POST['horario'])) die ('Error al validar el horario');
	if (($_POST['horario']!='m') and ($_POST['horario']!='t')) die ('Error al validar el horario');
	$horario=$_POST['horario'];
	//try
	$e->DarDeAlta($nombre,$descripcion,$precio,$horario);
	//catch
}

$lista=$e->getTodos();

$v=new AgregarEstudio();
$v->estudios=$lista;
$v->render();
	












