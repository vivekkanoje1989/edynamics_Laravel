<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [
    'getUrl' => 'office',
//    's3Path'=>'https://storage.googleapis.com/',
   's3Path'=>'https://storage.googleapis.com/'.$GLOBALS['aws_bucket_id'],
    'mastergcsPath'=>'https://storage.googleapis.com/businessapps.co.in',
    'getWebsiteUrl' => 'website',
    'companyName' => 'Edynamics BMS',
    'rootPath' => base_path(),
    'randomNoDigits' => 4,
    'themeName' => '', //Theme32
    'backendUrl' => 'office.php',
    'recordsPerPage' =>30,
    'client_id' => 1,
    //'client_info'=>$GLOBALS['client_info'],
];
