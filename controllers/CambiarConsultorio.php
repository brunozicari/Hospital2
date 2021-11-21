<?php 

require '../fw/fw.php';
require './Sesion.php';
require '../models/Medico.php';
require '../models/Turno.php';
require '../models/Consultorio.php';
require '../views/CambiarConsultorio.php';
require_once '../class_helper/seguridad.php';

if ($_SESSION['tipoUsuario']!=0){
	header('Location:./IngresoAlSistema.php');
	exit();
}
if(!(isset($_GET['id']))) {
	header('Location:./IngresoAlSistema.php');
	exit();
}
$m = new medico ();
$dni=($_GET['id']);
if (!($m->existeMedico($dni))){//si el medico no existe que vuelva
	header('Location:./IngresoAlSistema.php');
	exit();
}
$nombreMedico=$m->nombreYApellido($dni);
$c=new Consultorio();
$todosLosConsultorios=$c->getTodos();
$consultoriosLibres=[];
foreach ($todosLosConsultorios as $tc){
	if ($c->esConsultorioLibre($tc['numero'])) array_push($consultoriosLibres,$tc['numero']);
}
if(isset($_POST['consultorio'])){
	$consultorio=$_POST['consultorio'];
	if ($c->existeConsultorio($consultorio)){
		if (!($c->esConsultorioLibre($consultorio))){
			die ('Error al validar el consultorio');
		}
		$m->cambiarConsultorio($dni,$consultorio);
		$t=new Turno();
		$t->cambiarConsultorioDeTurnos($dni,$consultorio);//deberia cambbiar el consultorio de todos los turnos del medico
		header('Location:./ListadoMedicos.php');
		exit();
	}
}

$v=new CambiarConsultorio();
$v->consultorios=$consultoriosLibres;
$v->medico=$nombreMedico;
$v->render();