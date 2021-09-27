<?php

use WHMCS\Database\Capsule;
use WHMCS\Module\Addon\arvancloud_IaaS\Admin\Controller;


function arvancloud_IaaS_config() {
    $configarray = array(
    "name" => "Arvan Cloud IaaS",
    "description" => "Manage Your Servers",
    "version" => "1.0",
    "author" => "Parham Afkar",
    "fields" => array(
        "arvancloud_api" => array ("FriendlyName" => "API Key", "Type" => "text", "Size" => "60", "Description" => "کلید API خود را وارد نمایید"),
    ));
    return $configarray;
}


function arvancloud_IaaS_activate()
{
    try {
        return [
            'status' => 'success',
            'description' => 'ماژول مدیریت سرور ابر آروان با موفقیت فعال شد.',
        ];
    } catch (\Exception $e) {
        return [
            'status' => "error",
            'description' => 'خطایی رخ داده است. مجدد امتحان نمایید.',
        ];
    }
}


function arvancloud_IaaS_deactivate()
{
    try {
        return [
            'status' => 'success',
            'description' => 'ماژول مدیریت سرور ابر آروان با موفقیت غیرفعال شد.',
        ];
    } catch (\Exception $e) {
        return [
            "status" => "error",
            "description" => "خطایی رخ داده است. مجدد امتحان نمایید.",
        ];
    }
}



function arvancloud_IaaS_output($vars) {

    $Controller = new Controller();

    $response = $Controller->caller('/regions/{region}/float-ips');
    
}