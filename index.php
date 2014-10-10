<?php
require_once 'core/init.php';
require_once 'core/classloader.php';

try{
    Initializer::init();
    $router = Loader::load('Router');
    Dispatcher::dispatch($router);
    echo 'test';
    echo 'hi';
}catch (Exception $exc){
     echo '<p style="background-color: darkorange;color: antiquewhite;width: 400px;height: 25px;padding: 20px;text-align: center">'.$exc->getMessage().'</p>';
}
