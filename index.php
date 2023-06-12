<?php
include "MainController.php";
include "View.php";

session_start();

$request = array_merge($_GET, $_POST);
$controller = new MainController($request);

echo $controller->work();
?>