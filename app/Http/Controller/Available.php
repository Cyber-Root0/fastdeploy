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
namespace FastDeploy\Http\Controller;
use FastDeploy\Service\LAN;
class Available
{   private LAN $lan;
    public function __construct(){
        $this->lan = new LAN();
    }    
    /**
     * execute
     *
     * @return string
     */
    public function execute(array $params = []){
        $object = $this->lan;
        return json_encode([
            'port' => $object()
        ]);
    }
}