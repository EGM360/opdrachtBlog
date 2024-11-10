<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register("autoloader");

function autoloader($class): void {
    $class = str_replace("\\", "/", $class);
    require_once $class . ".php";
}

session_start();

$actions = [
    "index" => [\controllers\SharesController::class, "index"],
    "add" => [\controllers\SharesController::class, "add"],
    "edit" => [\controllers\SharesController::class, "edit"],
    "delete" => [\controllers\SharesController::class, "delete"],
    "register" => [\controllers\AuthController::class, "register"],
    "login" => [\controllers\AuthController::class, "login"],
    "logout" => [\controllers\AuthController::class, "logout"],
];

$action = $_GET["action"] ?? "index";

if (!array_key_exists($action, $actions)) {
    echo "404 not found";
    die();
}

[$controller, $method] = $actions[$action] ?? [];

$connection = new \database\Connection();

$request = new \http\Request($_SERVER, $_GET, $_POST);

print (new $controller($connection, '/opdrachtBlog'))->$method($request);


