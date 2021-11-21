<?php

//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Especialidad.php';
require '../models/Usuario.php';
require '../models/Consultorio.php';
require '../models/Medico.php';
require '../views/NuevoMedico.php';

if ($_SESSION['tipoUsuario']!=0)
{
	header('Location:./IngresoAlSistema.php');
	exit();
}

$m=new Medico();
$e=new Especialidad();
$c=new Consultorio();
$mensaje="";

if(isset($_POST['dni'])){
	$dni=$_POST['dni'];
	
	if (!isset($_POST['nombre'])) die('Error al validar el nombre');
	$nombre=$_POST['nombre'];
	
	if (!isset($_POST['apellido'])) die('Error al validar el apellido');
	$apellido=$_POST['apellido'];
	
	if (!isset($_POST['contra'])) die('Error al validar la contraseña');
	$contra=$_POST['contra'];
	
	if (!isset($_POST['mail'])) die('Error al validar el correo electrónico');
	$mail=$_POST['mail'];
	
	if (!isset($_POST['especialidad'])) die('Error al validar la especialidad');
	$especialidad=$_POST['especialidad'];
	
	if (!isset($_POST['horario'])) die('Error al validar el horario');
	$horario=$_POST['horario'];
	if (($horario!='m') and ($horario!='t')) die('Error al validar el horario');

	
	if (!isset($_POST['consultorio'])) die('Error al validar el consultorio');
	$consultorio=$_POST['consultorio'];
	
	//try
	if (!($e->existeEspecialidad($especialidad))){
		die('Error al validar la especialidad');
	}
	if (!($c->existeConsultorio($consultorio))){
		die('Error al validar el consultorio');
	}
	if (!($c->esConsultorioLibre($consultorio))){
		die('Error al validar el consultorio');
	}
	if (!($m->existeMedico($dni))){
		if (!($m->usuarioExistente($dni))) $m->darDeAlta($dni, $nombre, $apellido, $contra, $mail, 2); //Si el medico ya existe como usuario no lo sobreescribo
		$m->darDeAltaMedico($dni, $nombre, $apellido, $especialidad, $horario, $consultorio);
		header('Location:./MenuPrincipalAdministracion.php');
		exit();
	}
	else{
		$mensaje="Ya existe un médico con ese número de DNI";
	}
	//catch
}


$todasLasEspecialidades=$e->getTodos();
$todosLosConsultorios=$c->getTodos();
$consultoriosLibres=[];
foreach ($todosLosConsultorios as $tc){
	if ($c->esConsultorioLibre($tc['numero'])) array_push($consultoriosLibres,$tc['numero']);
}


$v=new NuevoMedico();
$v->especialidades=$todasLasEspecialidades;
$v->consultorios=$consultoriosLibres;
$v->mensaje=$mensaje;
$v->render();
	












