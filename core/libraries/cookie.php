<?php
/**
 * Class CCookie
 */
class CCookie{
    /**
     * set new cookie in $_COOKIE array
     * @param $id
     * @param $value
     * @param bool $lifeTime
     * @return bool
     */
    public function _set($id,$value,$lifeTime = false){
        if(!isset($_COOKIE[$id])){
            $time = time() + (30 * 8600);
            ($lifeTime ? setcookie($id,$value,$time) : setcookie($id,$value));
        }else{
            return false;
        }
    }

    /**
     * output buffer be start
     */
    public function _obStart(){
        ob_start();
    }

    /**
     * output buffer be close
     */
    public static function _obEnd(){
        ob_end_flush();
    }

    /**
     * check cookie is set or not
     * @param $id
     * @return bool
     */
    public static function _isset($id){
        return (isset($_COOKIE[$id]) ? true : false);
    }

    /**
     * remove cookie and if $lifeTime was TRUE set kill time for it
     * @param $id
     * @param bool $lifeTime
     */
    public static function _destroy($id,$lifeTime = false){
        if(isset($_COOKIE[$id])){
            $kill = time () - (time() + 30 * 86400);
            ($lifeTime ? setcookie($id,null,$kill) : setcookie($id,null));
        }
    }
}
