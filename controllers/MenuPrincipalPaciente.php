<?php
//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Usuario.php';
require '../models/Estudio.php';
require '../models/Turno.php';
require '../views/MenuPrincipal.php';
require_once '../class_helper/seguridad.php';

if (($_SESSION['tipoUsuario']!=1) and ($_SESSION['tipoUsuario']!=2))
{
	header('Location:./IngresoAlSistema.php');
	exit();
}
$dni=$_SESSION['idUsuario'];
$u = new Usuario();
$t = new Turno();

$datos=$u->getDatos($dni);
$todosLosTurnos=$t->getTurnosPorUsuario($dni);
$todosLosEstudios=$t->getEstudiosPorUsuario($dni);

$v= new MenuPrincipal();
$v->usuario=$datos;
$v->turnos=$todosLosTurnos;
$v->estudios=$todosLosEstudios;
$v->render();