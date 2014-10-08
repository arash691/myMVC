<?php
/*
 * This class set all path to php
 */
class Initializer {
    public static function init(){
        set_include_path(get_include_path().PATH_SEPARATOR.'core/libraries'); // set to core php
        set_include_path(get_include_path().PATH_SEPARATOR.'app/models');
        set_include_path(get_include_path().PATH_SEPARATOR.'core/controller');
        set_include_path(get_include_path().PATH_SEPARATOR.'core/views');
    }
}
