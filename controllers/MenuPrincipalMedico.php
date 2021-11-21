<?php
//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Usuario.php';
require '../models/Medico.php';
require '../models/Turno.php';
require '../views/MenuPrincipalMedico.php';


if ($_SESSION['tipoUsuario']!=2)
{
	header('Location:./IngresoAlSistema.php');
	exit();
}
$dni=$_SESSION['idUsuario'];
$m=new Medico();

if (!($m->existeMedico($dni)))
{
	header('Location:./IngresoAlSistema.php');
	exit();
}

$u = new usuario();
$datosDelUsuario=$u->getDatos($dni);
$consultorio=$m->getConsultorio($dni);
$t = new Turno();
$hoy=date("Y-m-d");
$fecha=$hoy;
if(isset($_GET['fecha'])) $fecha=$_GET['fecha'];
$fecha=date("Y-m-d",strtotime($fecha));
$turnosAgendados=$t->getTodosPorMedicoYFecha($dni, $fecha);
$fechavalida=true;
$modificarAgenda=true;
$mensaje="";

if($fecha<$hoy) {
	$modificarAgenda=false;
	$mensaje="No se puede modificar la agenda para dias anteriores a la fecha de hoy";
} 
	
$enDosSemanas=date("Y-m-d", strtotime($hoy.'+ 15 days')); 
if($fecha>$enDosSemanas) {
	$modificarAgenda=false;
	$fechavalida=false;
	$mensaje="Sólo se puede visualizar la agenda para los próximos 15 dias";
}
		
$diaDeLaSemana=date('N',strtotime($fecha));
if($diaDeLaSemana>5) {
	$modificarAgenda=false;
	$fechavalida=false;
	$mensaje="No hay agenda para dias sábados o domingos";
} 

$todosLosTurnos=[];
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

$v= new MenuPrincipalMedico();
$v->consultorio=$consultorio;
$v->fecha=$fecha;
$v->modificar=$modificarAgenda;
$v->verAgenda=$fechavalida;
$v->usuario=$datosDelUsuario;
$v->mensaje=$mensaje;
$v->turnos=$todosLosTurnos;
$v->render();