<?php

namespace WHMCS\Module\Addon\arvancloud_IaaS\Admin;

class Controller {

    private $Class;

    public function caller($url, $action = 'ErrorController@index', array $params = [])
    {

        $action = explode('@', $action);

        $controller = $action[0];
        $method = $action[1];

        if(count($action) < 2) {
            $controller = "ErrorController";
            $method = 'index';
        }


        $this->Class = "WHMCS\\Module\\Addon\\arvancloud_IaaS\\Admin\\" . $controller;

        $class = $this->Class;
        $class = new $this->Class;
        
        if (is_callable(array($class, $method))) {
            return $class->$method($url, $params);
        } else {
            echo 'Not Found Controller';
        }

    }
}