<?php

//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Usuario.php';
require '../models/Medico.php';
require '../models/Turno.php';
require '../views/AgendarTurnoMedico.php';

if(($_SESSION['tipoUsuario']!=2)and($_SESSION['tipoUsuario']!=0)){
	header('Location:./IngresoAlSistema.php');
	exit();
}
$mensaje="";
$m=new Medico();
$u=new Usuario();
$t=new Turno();

if ($_SESSION['tipoUsuario']==2){
	if(!isset($_GET['dia'])){
		header('Location:./MenuPrincipalMedico.php');
		exit();
	}
	if(!isset($_GET['hora'])){
		header('Location:./MenuPrincipalMedico.php');
		exit();
	}
	$dni_medico=$_SESSION['idUsuario'];
}

if ($_SESSION['tipoUsuario']==0){
	if(!isset($_GET['dia'])){
		header('Location:./MenuPrincipalAdministracion.php');
		exit();
	}
	if(!isset($_GET['hora'])){
		header('Location:./MenuPrincipalAdministracion.php');
		exit();
	}
	if(!isset($_GET['dnimedico'])){
		header('Location:./MenuPrincipalAdministracion.php');
		exit();
	}
	$dni_medico=$_GET['dnimedico'];	
	if(!($m->existeMedico($dni_medico))){
		header('Location:./MenuPrincipalAdministracion.php');
		exit();
	}
}
//verifico que la fecha sea valida. Sino vuelvo al menu principal
$fecha=date("Y-m-d", strtotime($_GET['dia']));
$hoy=date("Y-m-d");
if($fecha<$hoy) {
	header('Location:./VolverAlMenuPrincipal.php');
	exit();
} 
$enDosSemanas=date("Y-m-d", strtotime($hoy.'+ 15 days')); 
if($fecha>$enDosSemanas) {
	header('Location:./VolverAlMenuPrincipal.php');
	exit();
}		
$diaDeLaSemana=date('N',strtotime($fecha));
if($diaDeLaSemana>5) {
	header('Location:./VolverAlMenuPrincipal.php');
	exit();
} 
//verifico que la hora sea valida. Sino vuelvo al menu principal
$hora=date("H:i", strtotime($_GET['hora']));
if (!($m->verificarHora($dni_medico,$hora))){
	header('Location:./VolverAlMenuPrincipal.php');
	exit();
}

//try
if (isset($_POST['dni_paciente'])){
	$dni_paciente=$_POST['dni_paciente'];
	if($u->usuarioExistente($dni_paciente)){
		if($dni_paciente==$dni_medico){
			$mensaje="El medico y el paciente no pueden ser la misma persona";
		}
		else{
			if ($t->esTurnoLibre($dni_medico,$fecha,$hora)) $t->agendarTurno($dni_medico,$dni_paciente,$fecha,$hora);
			if ($_SESSION['tipoUsuario']==2){
				header('Location:./VolverAlMenuPrincipal.php');
				exit();
			}
			if ($_SESSION['tipoUsuario']==0){
				header('Location:./ConsultarAgendaMedico.php?id=' . $dni_medico);
				exit();
			}
		}
	}
}
//catch

$posiblesPacientes=[];
if (isset($_POST['busq'])){
	$busqueda=$_POST['busq'];
	if (strlen($busqueda)>1) $posiblesPacientes= $u->buscarPorNombreApellido($busqueda);
}

$v=new AgendarTurnoMedico();
$v->pacientes=$posiblesPacientes;
$v->dia=$fecha;
$v->hora=$hora;
$v->mensaje=$mensaje;
$v->render();
	












