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
use FastDeploy\Http\Controller\Available;
$routes = [
    '/ports/available' => Available::class,  
];
/* Process route and return action  */
foreach($routes as $path => $action){
    $routeManager->get($path, $action);
    $routeManager->post($path, $action);
}
return $routeManager->handler();