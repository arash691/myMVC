<?php
/*
 * the AutoLoad function for AutoLoad Class
 */
function AutoLoad($className){
    require_once strtolower($className).'.php';
}
spl_autoload_register('AutoLoad');
