<?php

//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Especialidad.php';
require '../views/ListadoEspecialidades.php';

$e=new Especialidad();
$lista=$e->getTodos();

$v=new ListadoEspecialidades();
$v->especialidades=$lista;
$v->render();