<?php

//controlador
require '../class_helper/seguridad.php';
require '../fw/fw.php';
require '../models/Usuario.php';
require '../views/IngresoAlSistema.php';
session_start();

$mensaje="";
if(isset($_POST['dni'],$_POST["contra"])){
	$dni=$_POST['dni'];
	$contra=$_POST["contra"];
	$u = new usuario();
	if ($u->intentarLoguear($dni,$contra)){
		$tipo=$u->tipoDeUsuario($dni);
		if ($tipo==0){
			$_SESSION['idUsuario']=$dni;
			$_SESSION['tipoUsuario']=0;
			header('Location:./MenuPrincipalAdministracion.php');
			exit();
		}
		if ($tipo==1){
			$_SESSION['idUsuario']=$dni;
			$_SESSION['tipoUsuario']=1;
			header('Location:./MenuPrincipalPaciente.php');
			exit();
		}
		if ($tipo==2){
			$_SESSION['idUsuario']=$dni;
			$_SESSION['tipoUsuario']=2;
			header('Location:./MenuPrincipalMedico.php');
			exit();
		}	
	}
	else {
		$mensaje="Contraseña o DNI inválido";
	}
}
$v = new IngresoAlSistema();
$v->mensaje=$mensaje;
$v->render();
?>


