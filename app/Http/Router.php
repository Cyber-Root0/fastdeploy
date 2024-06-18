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
namespace FastDeploy\Http;
class Router
{
    private $routes = [];
    private $method;
    private $path;
    private $params;
    /**
     * __construct
     *
     * @param string $method
     * @param string $path
     * @return void
     */
    public function __construct($method, $path)
    {
        $this->method = $method;
        $this->path = $path;
    }
    /**
     * get
     *
     * @param string $route
     * @param string | Closure $action
     * @return void
     */
    public function get(string $route, $action)
    {
        $this->add('GET', $route, $action);
    }
    /**
     * post
     *
     * @param string $route
     * @param string | Closure $action
     * @return void
     */
    public function post(string $route, $action)
    {
        $this->add('POST', $route, $action);
    }
    
    /**
     * add
     *
     * @param  string $method
     * @param  string $route
     * @param  mixed $action
     * @return void
     */
    private function add(string $method, string $route, $action){
        $this->routes[$method][$route] = $action;
    }

    public function getParams()
    {
        if (empty($this->params)){
            return [];
        }
        return $this->params;
    }
    /**
     * handler
     *
     * @return void
     */
    public function handler()
    {
        if (empty($this->routes[$this->method])){
            return false;
        }

        if (isset($this->routes[$this->method][$this->path])){
            return $this->routes[$this->method][$this->path];
        }

        foreach($this->routes[$this->method] as $route => $action){
            $result = $this->checkUrl($route, $this->path);
            if ($result >= 1){
                return $action;
            }
        }
    }    
    /**
     * checkUrl
     *
     * @param  string $route
     * @param  string $path
     * @return string
     */
    private function checkUrl(string $route, $path)
    {

        preg_match_all('/\{([^\}]*)\}/', $route, $variables);

        $regex = str_replace('/', '\/', $route);

        foreach ($variables[0] as $k => $variable) {
            $replacement = '([a-zA-Z0-9\-\_\ ]+)';
            $regex = str_replace($variable, $replacement, $regex);
        }

        $regex = preg_replace('/{([a-zA-Z]+)}/', '([a-zA-Z0-9+])', $regex);
        $result = preg_match('/^' . $regex . '$/', $path, $params);
        $this->params = $params;

        return $result;
    }
}