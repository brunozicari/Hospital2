<<?php 
require '../fw/fw.php';
require './Sesion.php';
require '../models/Medico.php';
require '../class_helper/seguridad.php';


$dni=($_POST['eliminar_dni']);



$s = new seguridad();


$m= new medico();
$m->eliminarMedico($dni,$s);
header('Location:./menuPrincipalAdmin.php'); 


?>
 