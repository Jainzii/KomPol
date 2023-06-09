<?php
include "MainController.php";
include "View.php";

$request = array_merge($_GET, $_POST);
$controller = new MainController($request);

echo $controller->work();
?>