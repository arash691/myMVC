<?php
/*
 * this class load class with singleTone Pattern
 */

class Loader {
    private static $loaded = array(); // this array store instance of our class
    public static function load($className){
        $validClass = array( // we can set valid name for class to load
            'Configs',
            'Router',
        );
        if(!in_array($className,$validClass)){ // when load class we check it for valid name to load
            throw new Exception("The '{$className}' Is Not Valid To Load !");
        }
        if(empty(self::$loaded[$className])){ // the  singleTone Pattern !
            self::$loaded[$className] = new $className();
        }
        return self::$loaded[$className];
    }
}
