<?php

require_once 'Controllers/IndexController.php';
require_once 'Controllers/AdminController.php';
require_once 'Controllers/LoginController.php';

const PATH = '/Desafio_2_lis';
$url = $_SERVER['REQUEST_URI'];

$slices = explode('/', $url);
$controller = empty($slices[2])?"IndexController":$slices[2]."Controller";
$method = empty($slices[3])?"index":$slices[3];
$param = empty($slices[4])?[]:array_slice($slices, 4);

$cont = new $controller;
$cont->$method($param);