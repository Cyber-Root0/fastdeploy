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

use FastDeploy\Service\Shell;

class LAN
{
    private Shell $shell;
    private const COMMAND_GETPORTS = 'netstat -tuln | grep -E "LISTEN|ESTABLISHED"';
    public function __construct()
    {
        $this->shell = new Shell();
    }    
    /**
     * __invoke
     *
     * @return int
     */
    public function __invoke(){
        $portsUsed = $this->getUsedPorts();
        return $this->availablePort($portsUsed);
    }
    /**
     * availablePort
     *
     * @param  array $userPorts
     * @return int
     */
    public function availablePort(array $usedPorts)
    {
        $foundPort = false;
        $port = 0;
        while (!$foundPort) {
            $aleatoryPort = rand(1024, 65000);
            if (in_array($aleatoryPort, $usedPorts)) {
                continue;
            }
            $foundPort = true;
            $port = $aleatoryPort;
        }
        return $port;
    }
    public function isPortUsed(string $port){
        $port = (int) $port;
        $usedPorts = $this->getUsedPorts();
        return in_array($port, $usedPorts);
    }    
    /**
     * getUsedPorts
     *
     * @return array
     */
    private function getUsedPorts()
    {
        $output = $this->shell->execute(self::COMMAND_GETPORTS);
        $usedPorts = [];
        $lines = explode("\n", trim($output));
        foreach ($lines as $line) {
            $fields = preg_split('/\s+/', $line);
            if (isset($fields[3])) {
                $address = $fields[3];
                $parts = explode(':', $address);
                $port = end($parts);
                if (is_numeric($port)) {
                    $usedPorts[] = (int) $port;
                }
            }
        }
        return $usedPorts;
    }    
    /**
     * getIPServer
     *
     * @return string
     */
    public function getIPServer(){
        return SERVER_IP;
    }
}