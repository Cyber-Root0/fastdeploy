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
namespace FastDeploy\Template;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
class Base
{   private $twig;    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){
        $loader = new FilesystemLoader(__DIR__.'/nginx');
        $this->twig = new Environment($loader);
    }    
    /**
     * render
     *
     * @param string $path
     * @param array $args
     * @return string
     */
    public function render(string $path, array $args){
        return $this->twig->render($path.".config", $args);
    }    
}