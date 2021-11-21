<<?php 
require '../fw/fw.php';
require './Sesion.php';
require '../models/estudios.php';
require '../class_helper/seguridad.php';


$nombre=($_POST['nombre']);



$s = new seguridad();


$e= new estudios();
$e->eliminar($nombre);
header('Location:./menuPrincipalAdmin.php'); 


?>