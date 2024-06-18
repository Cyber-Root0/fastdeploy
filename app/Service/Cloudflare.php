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
use CR0\HTTPClient\Client;
class Cloudflare
{   
    private const base_url = "https://api.cloudflare.com/";
    private Client $request;
    public function __construct(){
        $this->request = new Client(self::base_url);
    }
    public function recordDNS(string $domain, string $ip){
        $this->request->setBody($this->getAllParams($domain, $ip));
        $this->request->addHeader('Authorization', 'Bearer '.$this->getToken());
        $output = $this->request->setMethod('POST')->send($this->getZoneEndpoint());
    }    
    /**
     * getAllParams
     *
     * @param  string $domain
     * @param  string $ip
     * @return string
     */
    private function getAllParams(string $domain, string $ip){
        return json_encode(
            [
                "type"=> "A",
                "ttl" => 3600,
                "proxied" => true,
                "content" => $ip,
                'name' => $domain
            ]
            );
    }
    private function getZoneEndpoint(){
        return 'client/v4/zones/'.$this->getZoneId().'/dns_records';
    }    
    /**
     * getToken
     *
     * @return string
     */
    public function getToken(){
        return CLOUDFLARE_TOKEN;
    }    
    /**
     * getZoneId
     *
     * @return string
     */
    public function getZoneId(){
        return CLOUDFLARE_ZONE;
    }
}