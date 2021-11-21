<?php

//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Medico.php';
require '../models/Turno.php';
require '../views/SacarTurnoConMedico.php';

if(!isset($_GET['id'])){
	header('Location:./IngresoAlSistema.php'); //si no tiene el valor de id que vuelva
	exit();
}
if(!ctype_digit($_GET['id'])){
	header('Location:./IngresoAlSistema.php'); // si el id no es un numero que vuelva
	exit();
}

$m=new Medico();
if(!($m->existeMedico($_GET['id']))){
	header('Location:./IngresoAlSistema.php'); // si el id no corresponde a un medico que vuelva
	exit();
}

$dni_medico=$_GET['id'];
$dni_usuario=$_SESSION['idUsuario'];
if($dni_medico==$dni_usuario){
	header('Location:../html/Error.php'); //verifico que el medico y el paciente no sean la misma persona
}

$t=new Turno();
$turnosDisponibles=[];
$fecha=date("Y-m-d");;
$mensaje="";

if(isset($_POST['fecha'])){
	$fecha=$_POST['fecha'];
	$fecha=date("Y-m-d", strtotime($fecha));	
	$fechavalida=true;
	$hoy=date("Y-m-d");
	//verifico que la fecha sea válida
	if($fecha<=$hoy) {
		$fechavalida=false;
		$mensaje="No se puede sacar turno para una fecha anterior al dia de hoy";
	}
	
	$enDosSemanas=date("Y-m-d", strtotime($hoy.'+ 15 days')); 
	if($fecha>$enDosSemanas) {
		$fechavalida=false;
		$mensaje="Se puede sacar turno para dentro de 15 dias como máximo";
	}
		
	$diaDeLaSemana=date('N',strtotime($fecha));
	if($diaDeLaSemana>5) {
		$fechavalida=false;
		$mensaje="No se puede sacar turno para dias sábados ni domingos";
	} 
	
	if ($fechavalida==true){
		$turnosPosibles=$m->generarHorariosDeAtencion($dni_medico);		
		$turnosAgendados=$t->getTurnosAgendados($dni_medico,$fecha);
		foreach($turnosPosibles as $tp){
			$libre=true;
			foreach($turnosAgendados as $ta){
				$aux=date("H:i",strtotime ($ta['hora']));
				if($tp==$aux) $libre=false;
			}
			if ($libre==true) array_push($turnosDisponibles,$tp);
		}
		if(count($turnosDisponibles)==0) $mensaje="No hay turnos disponibles para la fecha seleccionada";		
		if(isset($_POST['hora'])){ //aca entra cuando selecciona la fecha y la hora
			$hora=$_POST['hora'];
			//verifico que la hora sea valida con una consulta a la base
			if ($m->verificarHora($dni_medico,$hora)){
				//por las dudas consulto si el turno esta libre antes de agendarlo por si el usuario
				//tarda mucho en seleccionar la hora y el turno se ocupa por otro usuario antes	
				if ($t->esTurnoLibre($dni_medico,$fecha,$hora)) $t->agendarTurno($dni_medico,$dni_usuario,$fecha,$hora);			
				header('Location:./menuPrincipalPaciente.php');
				exit();
			}
		}
	}
}

$v=new SacarTurnoConMedico();
$v->opciones=$turnosDisponibles;
$v->dia=$fecha;
$v->mensaje=$mensaje;
$v->render();









