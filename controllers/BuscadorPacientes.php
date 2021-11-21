<?php

//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Usuario.php';
require '../views/BuscadorPacientes.php';

if($_SESSION['tipoUsuario']!=0){
	header('Location:./IngresoAlSistema.php');
	exit();
}
$posiblesPacientes=[];


if (isset($_POST['busq'])){
	if (strlen($_POST['busq'])>1){
		$busqueda=$_POST['busq'];
		$u=new Usuario();
		$posiblesPacientes= $u->buscarPorNombreApellido($busqueda);
	}
}

$v=new BuscadorPacientes();
$v->pacientes=$posiblesPacientes;
$v->render();
	












