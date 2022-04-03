<?php
require '../../vendor/autoload.php';

require_once '../routing.php';
require_once '../controllers.php';
require_once '../dispatcher.php';
session_start();

$action_url = $_GET['action'];
dispatch($routing, $action_url);

?>