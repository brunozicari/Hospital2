
<?php


require '../fw/fw.php';
require '../models/Usuario.php';
require '../models/Turno.php';
require './Sesion.php';
require '../class_helper/seguridad.php';



$contra= $_POST['contraseña'];
$dni = $_SESSION['idUsuario'];


$u = new usuario();
$s = new seguridad();


$u->cambiar_contraseña($dni,$contra,$s);


 if($_SESSION['tipoUsuario']==0){
header('Location:./menuPrincipalAdmin.php');
 }

 if($_SESSION['tipoUsuario']==1){
header('Location:./menuPrincipalPaciente.php');
 }


if($_SESSION['tipoUsuario']==2){
header('Location:./menuPrincipalMedico.php');
 }
?>