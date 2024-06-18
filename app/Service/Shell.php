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
namespace FastDeploy\Service;
class Shell
{    
    /**
     * execute
     *
     * @param string $command
     * @return string
     */
    public function execute(string $command){
        return shell_exec($command);
    }
}