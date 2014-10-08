<?php
/**
 * Class CSession
 */
class CSession{
    /**
     * Remove All Sessions
     */
    public static function _flush(){
       unset($_SESSION);
   }
    /**
     * set new session
     * @param $id
     * @param $value
     * @return bool
     */
    public static function _set($id,$value){
       if(!self::_isset($id)){
           $_SESSION[$id] = $value;
       }else{
           return false;
       }
   }
    /**
     * get session that saved with id
     * @param $id
     * @return bool
     */
    public static function _get($id){
       if(isset($_SESSION[$id])){
            return $_SESSION[$id];
       }else{
            return false;
       }
   }
    /**
     * check the session that saved or not
     * @param $id
     * @return bool
     */
    public static function _isset($id){
       return (isset($_SESSION[$id]) ? true : false);
   }

    /**
     * remove the session with id
     * @param $id
     * @return bool
     */
    public static function _destroy($id){
        if(isset($_SESSION[$id])){
            unset($_SESSION[$id]);
            return true;
        }else{
            return false;
        }
   }

    /**
     * regenerate the session
     */
    public static function _change_id(){
       session_regenerate_id();
   }

    /**
     * start session to use session
     */
    public static function _start(){
        if(!isset($_SESSION)){
            session_start();
        }
   }
}
