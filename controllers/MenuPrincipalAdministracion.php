<?php
//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Medico.php';
require '../models/Turno.php';
require '../views/MenuPrincipalAdministracion.php';

if ($_SESSION['tipoUsuario']!=0)
{
	header('Location:./IngresoAlSistema.php');
	exit();
}

$v= new MenuPrincipalAdministracion();
$v->render();