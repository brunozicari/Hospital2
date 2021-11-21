<<?php 
require '../fw/fw.php';
require './Sesion.php';
require '../models/estudios.php';
require '../class_helper/seguridad.php';



$e = new estudios();
$Identificador = ($_POST['identificador']);
$nombre     =($_POST['nombre']);
$descripcion=($_POST['descripcion']);
$precio		=($_POST['precio']);

$e->DarDeAlta($nombre,$descripcion,$precio,$s);

header('Location:./menuPrincipalAdmin.php'); 
 ?>