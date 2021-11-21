<?php

//controlador

require '../fw/fw.php';
require './Sesion.php';
require '../models/Estudio.php';
require '../views/ListadoEstudios.php';

$e=new Estudio();
$lista=$e->getTodos();

$v=new ListadoEstudios();
$v->estudios=$lista;
$v->render();