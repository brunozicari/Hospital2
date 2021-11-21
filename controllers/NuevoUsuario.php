<?php
//controlador
require '../class_helper/seguridad.php';
require '../fw/fw.php';
require '../models/Usuario.php';
require '../views/NuevoUsuario.php';
$mensaje="";
if(count($_POST)>0){
	$u = new usuario();
	
	if (!isset($_POST['dni'])) die('Error al validar el dni');
	$dni=($_POST['dni']);
	
	if (!isset($_POST['nombre'])) die('Error al validar el nombre');
	$nombre=$_POST['nombre'];
	
	if (!isset($_POST['nombre'])) die('Error al validar el apellido');
	$apellido=$_POST['apellido'];
	
	if (!isset($_POST['contra'])) die('Error al validar la contraseña');
	$contra=$_POST['contra'];
	
	if (!isset($_POST['mail'])) die('Error al validar el correo electrónico');
	$mail=$_POST['mail'];
	
	$tipo=1;	
	
	if ($u->UsuarioExistente($dni)){
		$mensaje="Ya existe un usuario con ese número de DNI";
	}
	else{  
		$u->DarDeAlta($dni, $nombre, $apellido, $contra, $mail, $tipo);
		session_start();
		$_SESSION['idUsuario']=$dni;
		$_SESSION['tipoUsuario']=1;
		header('Location:./MenuPrincipalPaciente.php');
		exit();
	}
}
$v= new NuevoUsuario();
$v->mensaje= $mensaje;
$v->render();
?>



