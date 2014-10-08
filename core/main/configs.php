<?php

/**
 * Class Configs : set general config to auto access class and other files
 */
class Configs{
    /**
     * @var store 
     */
    private $config;

    /**
     * require all config files and set $config
     */
    public function __construct(){
        require_once 'core/config/configs.php';
        @include_once 'app/config/configs.php';
        $this->config = $configs;
    }

    /**
     *
     * @param $keyName
     * @return null
     */
    public function __get($keyName){
        return ( isset($this->config[$keyName]) ? $this->config[$keyName] : null );
    }
}
