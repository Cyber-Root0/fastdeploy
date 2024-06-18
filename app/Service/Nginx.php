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

use FastDeploy\Service\LAN;
use FastDeploy\Template\Base;
use FastDeploy\Service\Shell;
use FastDeploy\Service\Cloudflare;
class Nginx
{
    private const nginx_sitespath = 'sites-enabled/';
    private const nginx_sitesrepo = 'sites-available/';
    private const nginx_path = '/etc/nginx/';
    private const nginx_command = 'nginx -s reload';
    private const nginx_symbolic = "ln -s /etc/nginx/sites-available/%s/%s.conf /etc/nginx/sites-enabled/";
    private LAN $lan;
    private BASE $template;
    private Shell $shell;
    private Cloudflare $cloudflare;
    public function __construct()
    {
        $this->lan = new LAN();
        $this->template = new Base();
        $this->shell = new Shell();
        $this->cloudflare = new Cloudflare();
    }
    /**
     * createApp
     *
     * @param string $domain
     * @param int $port
     * @return bool
     */
    public function execute(string $domain, string $port)
    {
        if (!$this->rules($domain)) {
            return false;
        }
        $template = $this->getTemplate($domain, $port);
        $this->create($template, $domain, $port);
        $this->apply($domain);
        return true;
    }    
    /**
     * create
     *
     * @param  string $template
     * @param  string $domain
     * @param  string $port
     * @return void
     */
    private function create(string $template, string $domain, string $port){
        $path = self::nginx_path . self::nginx_sitesrepo . $domain;
        $configFile = $path.'/'.$domain.".conf";
        $portFile = $path.'/'.'port'.".txt";
        file_put_contents($configFile, $template);
        file_put_contents($portFile, $port);
    }    
    /**
     * apply
     *
     * @param string $domain
     * @return void
     */
    private function apply($domain){
        $this->createLink($domain);
        $ip = $this->lan->getIPServer();
        $this->cloudflare->recordDNS($domain, $ip);
        $this->reload();
    }    
    /**
     * createLink
     *
     * @param  string $domain
     * @return void
     */
    private function createLink(string $domain){
        $symbolic =  sprintf(self::nginx_symbolic, $domain, $domain);
        $this->shell->execute($symbolic);
    }    
    /**
     * reload
     *
     * @return void
     */
    private function reload(){
        $this->shell->execute(self::nginx_command);
    }
    /**
     * rules
     *
     * @param string $domain
     * @return bool
     */
    private function rules(string $domain)
    {
        if ($this->AppExists($domain)) {
            $currentPort = $this->getUsedPort($domain);
            if ($this->isListen($currentPort)) {
                return false;
            }
            $this->reset($domain);
            return true;
        }
        mkdir(self::nginx_path . self::nginx_sitesrepo . $domain);
        return true;
    }
    /**
     * isListen
     *
     * @param  mixed $port
     * @return bool
     */
    private function isListen(string $port): bool
    {
        return $this->lan->isPortUsed($port);
    }
    /**
     * AppExists
     *
     * @param string $domain
     * @return bool
     */
    private function AppExists(string $domain)
    {
        $appfolder = self::nginx_path . self::nginx_sitesrepo . $domain;
        return is_dir($appfolder);
    }    
    /**
     * getTemplate
     *
     * @param  string $domain
     * @param  string $port
     * @return string
     */
    private function getTemplate(string $domain, string $port)
    {
        return $this->template->render('reverse-proxy', [
            'domain' => $domain,
            'port' => $port,
            'certpath' => $this->getCert(),
            'certkey' => $this->getCertKey()
        ]);
    }    
    /**
     * getCert
     *
     * @return string
     */
    private function getCert(){
        return __DIR__.'/../../cert/cert.crt';
    }    
    /**
     * getCertKey
     *
     * @return string
     */
    private function getCertKey(){
        return __DIR__.'/../../cert/cert.key';
    }    
    /**
     * getUsedPort
     *
     * @param  mixed $domain
     * @return void
     */
    private function getUsedPort(string $domain)
    {
        return file_get_contents(self::nginx_path . self::nginx_sitesrepo . $domain . "/port.txt");
    }
    /**
     * clear all content on app folder
     *
     * @param string $domain
     * @return void
     */
    private function reset(string $domain)
    {
        $dir = self::nginx_path . self::nginx_sitesrepo . $domain;
        $files = glob($dir . '/*');
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file);
        }
    }
}