<?php

//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Medico.php';
require '../models/Especialidad.php';
require '../views/ListadoMedicos.php';
require '../views/ListadoMedicosAdministracion.php';

$m=new Medico();
$lista=$m->getTodos();

if ($_SESSION['tipoUsuario']==0){
	$v=new ListadoMedicosAdministracion();
	$v->medicos=$lista;
	$v->render();
	exit();
}

if (($_SESSION['tipoUsuario']==1)or($_SESSION['tipoUsuario']==2)){
	if(isset($_GET['especialidad_id'])){
		$id=$_GET['especialidad_id'];
		$e=new Especialidad();
		if($e->existeEspecialidad($id)) $lista=$m->getTodosPorEspecialidad($id);//compruebo que exista la especialidad con consulta a la base			
	}
	$v=new ListadoMedicos();
	$v->medicos=$lista;
	$v->render();
	exit();
}

header('Location:./IngresoAlSistema.php');//si el tipo de ususario no es 0 ni 1 que vuelva al principio