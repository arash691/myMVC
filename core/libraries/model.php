<?php
/**
 * this class has main methods to work with mysql with mysqli extension
 */
class CDataBase{
    /**
     * $con is instance of mysqli class
     * @var
     */
    protected static $con;
    /** create instance of mysqli class with singleton pattern
     */
    public function __construct(){
        $config = Loader::load('Configs');
        if(self::$con == null){
            self::$con = new mysqli($config->dbHost,$config->dbUser,$config->dbPass,$config->dbName);
            self::$con->query('SET NAMES \'utf8\'');
            self::$con->set_charset('utf8');
        }
    }
    /**
     * return the number of rows that affected by query
     * @return int
     */
    protected static function _affectedRows(){
        if(self::$con){
            return self::$con->affected_rows;
        }
        return 0;
    }
    /**
     * execute query that has single result
     * @param $query
     * @return mixed
     * @throws MySQLQueryException
     * @throws MySQLConnectionException
     */
    protected function _queryResult($query){
        if(self::$con){
            $result = self::$con->query($query);
            if($result){
                return $result;
            }else{
                throw new MySQLQueryException($query);
            }
        }else{
            $config = Loader::load('Configs');
            throw new MySQLConnectionException($config->dbName);
        }
    }
    /**
     * execute query that has array result
     * @param $query
     * @return array
     * @throws MySQLConnectionException
     */
    protected function _queryMultiResult($query){
        if(self::$con){
            $result = array();
            $rows = self::_queryResult($query);
            while($row = $rows->fetch_assoc()){
                $result[] = $row;
            }
            return  $result;
        }else{
            $config = Loader::load('Configs');
            throw new MySQLConnectionException($config->dbName);
        }
    }
    /**
     * check the input value and escape some symbol and return string result
     * @param $value
     * @return bool
     */
    protected function _checkInput($value){
       if(self::$con){
            return self::$con->real_escape_string($value);
       }
       return false;
    }
    /**
     * close connection string and return bool result from close(). for no connection return false
     * @return mixed
     */
    protected function _close(){
        if(self::$con){
            return self::$con->close();
        }
        return false;
    }
}
