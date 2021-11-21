<?php
//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Usuario.php';
require '../models/Medico.php';
require '../models/Turno.php';
require '../views/ConsultarAgendaMedico.php';


if ($_SESSION['tipoUsuario']==1){
	header('Location:./IngresoAlSistema.php');
	exit();
}

$dni=$_SESSION['idUsuario'];
$m=new Medico();

if ($_SESSION['tipoUsuario']==0){
	if(!(isset($_GET['id']))) header('Location:./MenuPrincipalAdministracion.php');
	$dni=$_GET['id'];
}

if (!($m->existeMedico($dni))){//si el medico no existe que vuelva
	header('Location:./IngresoAlSistema.php');
	exit();
}

$u = new usuario();
$datosDelUsuario=$u->getDatos($dni);
$t = new Turno();
$hoy=date("Y-m-d");
$fecha=$hoy;
if(isset($_GET['fecha'])) $fecha=$_GET['fecha'];
$fecha=date("Y-m-d",strtotime($fecha));
$turnosAgendados=$t->getTodosPorMedicoYFecha($dni, $fecha);
$modificarAgenda=true;
$fechavalida=true;
$mensaje="";

if($fecha<$hoy) {
	$modificarAgenda=false;
	$mensaje="No se puede visualizar la agenda para dias anteriores a la fecha de hoy";
} 
	
$enDosSemanas=date("Y-m-d", strtotime($hoy.'+ 15 days')); 
if($fecha>$enDosSemanas) {
	$fechavalida=false;
	$modificarAgenda=false;
	$mensaje="Sólo se puede visualizar la agenda para los próximos 15 dias";
}
		
$diaDeLaSemana=date('N',strtotime($fecha));
if($diaDeLaSemana>5) {
	$fechavalida=false;
	$modificarAgenda=false;
	$mensaje="No hay agenda para dias sábados o domingos";
} 

$todosLosTurnos=[];
//aca solo ingresa si la fecha es válida
if ($fechavalida==true){
	$posiblesTurnos=$m->generarHorariosDeAtencion($dni);

	$turno=[];	

	foreach ($posiblesTurnos as $pt){
		$libre=true;
		$turno['hora']=$pt;	
		$turno['paciente']="Libre";
		$turno['libre']=$libre;
		foreach ($turnosAgendados as $ta){
			$aux=date("H:i",strtotime($ta['hora']));
			if ($pt==$aux){
				$libre=false;
				$turno['paciente']=$ta['nombre'] . " " . $ta['apellido'];
				$turno['id']=$ta['turno_id'];			
			}
			$turno['libre']=$libre;
		}	
		array_push($todosLosTurnos,$turno);
	}
}

$v= new ConsultarAgendaMedico();
$v->fecha=$fecha;
$v->modificar=$modificarAgenda;
$v->verAgenda=$fechavalida;
$v->usuario=$datosDelUsuario;
$v->mensaje=$mensaje;
$v->turnos=$todosLosTurnos;
$v->render();