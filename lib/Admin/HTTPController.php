<?php

namespace WHMCS\Module\Addon\arvancloud_IaaS\Admin;

use WHMCS\Database\Capsule;

class HTTPController {
    
    private $Provider;
    private $API_KEY;

    public function __construct() {
        $API_KEY = Capsule::table('tbladdonmodules')->where('module', 'arvancloud_IaaS')->where('setting', 'arvancloud_api')->pluck('value')->first();
        $this->setValue('Provider', 'https://napi.arvancloud.com/ecc/v1');
        $this->setValue('API_KEY', $API_KEY);
    }

    private function getValue($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    private function setValue($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }

    private function ClassName(){
        return (new \ReflectionClass($this))->getShortName();
    }

    public function Get($url, array $params = []) {
        $headers = array (
            'Authorization: ' . $this->getValue('API_KEY'),
        );
        $query = http_build_query($params); 
        $ch    = curl_init($this->getValue('Provider') . $url . '?' . $query);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }
   

    public function Post($url, array $params = []) {
        $headers = array (
            'Authorization: ' . $this->getValue('API_KEY'),
        );
        $query = http_build_query($params);
        $ch    = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $this->getValue('Provider') . $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }


    public function Put($url, array $params = []) {
        $headers = array (
            'Authorization: ' . $this->getValue('API_KEY'),
        );
        $query = \http_build_query($params);
        $ch    = \curl_init();
        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($ch, \CURLOPT_HEADER, false);
        \curl_setopt($ch, \CURLOPT_URL, $this->getValue('Provider') . $url);
        \curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, 'PUT');
        \curl_setopt($ch, \CURLOPT_POSTFIELDS, $query);
        $response = \curl_exec($ch);
        \curl_close($ch);
        return json_decode($response);
    }


    public function Delete($url, array $params = []) {
        $headers = array (
            'Authorization: ' . $this->getValue('API_KEY'),
        );
        $query = \http_build_query($params);
        $ch    = \curl_init();
        \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
        \curl_setopt($ch, \CURLOPT_HEADER, false);
        \curl_setopt($ch, \CURLOPT_URL, $this->getValue('Provider') . $url);
        \curl_setopt($ch, \CURLOPT_CUSTOMREQUEST, 'DELETE');
        \curl_setopt($ch, \CURLOPT_POSTFIELDS, $query);
        $response = \curl_exec($ch);
        \curl_close($ch);
        return json_decode($response);
    }
}

