<?php
/*
 * this class read url and fetch Controller & Action and Params
 * The Rule Of URL For MVC :
 * www.mySite.com/Controller/Action/ParamName1/ParamValue1/ParamName2/ParamValue2/.../ParamName(N)/ParamValue(N)
 */
class Router{
    private $route;
    private $controller;
    private $action;
    private $params;
    public function __construct(){
        $config = Loader::load('Configs');
        if(isset($_GET['r'])){ // check if url have any value
            $path = $_GET['r'];
        }else{
            $path = $config->defaultController; // else set default Controller 'Site'
        }
        $this->route = preg_replace($config->invalidURLChars,'',$path); // check the url have no any invalid characters and set ''
        $routeParts = explode('/',$this->route); // explode url with '/' char to array
        $this->controller = $routeParts[0]; // the first value is Controller
        $this->action = (isset($routeParts[1]) ? $routeParts[1] : 'index'); // the second value is Action
        array_shift($routeParts); // two times shift array for delete Controller and Action To get Params
        array_shift($routeParts);
        foreach($routeParts as $key => $value){ // check first defects like this : www.mySite.com/Site/index//5
            if(trim($value) === ''){  // if value is null or '' we delete it from array
                unset($routeParts[$key]);
            }
        }
        $this->params = array();
        if(count($routeParts) % 2 == 1){ // we check the number of Params , it must be Event
            throw new Exception('The Number Of Params Must be Even');
        }
        foreach(array_keys($routeParts) as $key){ // Create array of Params like array( 'ParamName' => 'Value' )
            if($key % 2 == 1){ // if $key is Index Passing But it's Value put it in Param
                continue;
            }
            $this->params[$key] = $routeParts[$key + 1]; // example $key = id and value = 3
        }
    }
    public function getController(){
        return (!empty($this->controller) ? $this->controller : 'Site' );
    }
    public function getAction(){
        return (!empty($this->action) ? $this->action : 'index' );
    }
    public function getParams(){
        return (!empty($this->params) ? $this->params : array() );
    }
}
