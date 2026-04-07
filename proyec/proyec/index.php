<?php
define("URL_BASE", "http://localhost/proyec/");

require_once "app/controllers/AuthController.php";

$action = isset($_GET["action"]) ? $_GET["action"] : "login";

$auth = new AuthController();

switch ($action) {
    case 'login':
        $auth->showLogin();
        break;
    case 'register':
        $auth->showRegister();
        break;
        case 'dashboard':
        require_once "app/views/dashboard.php";
        break;
    default:
        $auth->showLogin();
        break;
}