<?php
/*
 * Copyright (c) 2024 Bruno Venancio Alves
 *
 * Author: Bruno Venancio Alves
 * Email: boteistem@gmail.com
 *
 * Permission is granted to use, modify, and distribute this software with
 * acknowledgment of the original author. This notice must not be removed
 * or altered from any source distribution.
 */
require_once(__DIR__.'/../vendor/autoload.php');
use FastDeploy\Http\Router;
/* Exception Error Handler */
ini_set('display_errors', 0);
/* Handler Routes */
try{
    $method = $_SERVER['REQUEST_METHOD'];
    $path = $_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI'];
    $routeManager = new Router($method, $path);
    $controllerClass = require(__DIR__.'/../var/routes.php');
    if ($controllerClass!= null){
        $action = new $controllerClass();
        $output = $action->execute($routeManager->getParams());
        echo $output;
    }else{
        require_once(__DIR__.'/../app/Template/app/404.html');
    }
}catch(\Exception $e){
    echo $e->getMessage();
}