<<?php 

require '../fw/fw.php';
require './Sesion.php';
require '../models/Medico.php';
require '../models/Turno.php';
require '../class_helper/seguridad.php';

$horario = $_POST['horario'];
$dni =$_POST['dni'];


$m = new medico ();
$s = new seguridad ();

$m->cambiar_horario($dni,$horario,$s);
header('Location:./menuPrincipalAdmin.php');
 ?>