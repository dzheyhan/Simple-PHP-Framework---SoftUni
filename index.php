<?php
session_start();
require_once 'includes/config.php';
$requestParts=explode('/',parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));

$controllerName=DEFAULT_CONTROLLER; // HOME
if(count($requestParts)>=2 && $requestParts[1] !='' && $requestParts[1]!='index.php'){
  $controllerName=$requestParts[1];
}

$action=DEFAULT_ACTION;  // index
if(count($requestParts)>=3 && $requestParts[2] !=''){
  $action=$requestParts[2];
}
$params=array_splice($requestParts, 3);
//var_dump($requestParts);
//var_dump($params);

$ControllerClassName=  ucfirst(strtoLower($controllerName)).'Controller';
$ControllerFileName=  "controllers/".$ControllerClassName.'.php';

if(class_exists($ControllerClassName))
{
    $controller=new $ControllerClassName($controllerName,$action);
} 
    else {
    die ("Cannot find controler '$controllerName'in class $ControllerFileName");  
}


if(method_exists($controller, $action)){
//$controller->{$action}($params);
call_user_func_array(array($controller,$action),$params);

}
else {
    die("Connot find action '$action' in controller $ControllerClassName");
}

function __autoload($class_name)
{
    if(file_exists("controllers/$class_name.php")){
        include "controllers/$class_name.php";
    
    }
    if(file_exists("models/$class_name.php")){
        include "models/$class_name.php";
    
    }
}


  