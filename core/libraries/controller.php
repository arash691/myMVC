<?php
class Controller{
    private static $layout = 'home';
    protected static function setLayout($name){
        self::$layout = $name;
    }
    protected static function getLayout(){
        return self::$layout;
    }
    protected function getParam($params,$keyName){
        return (isset($params[$keyName]) ? $params[$keyName] : null );
    }
    protected function loadView($view , $params = array() , $useLayout = false ){
        extract($params);
        $controller = substr(strtolower(get_class($this)), 0 , -10);
        $viewFile = "app/views/{$controller}/{$view}.php";
        if(!file_exists($viewFile)){
            throw new Exception("The '{$view}' Not Found in '{$viewFile}'");
        }
        ob_start();
        require_once $viewFile;
        $viewData = ob_get_clean();
        if($useLayout){
            $layoutFile = 'app/views/layouts/'.self::$layout.'.php';
            if(!file_exists($layoutFile)){
                throw new Exception('The '.self::$layout.' Not Found In '.$layoutFile.'');
            }
            require_once $layoutFile;
        }else{
            echo $viewData;
        }
    }
    public function render($view , $params = array() ){
        $this->loadView($view,$params,true);
    }
    public function renderPartial($view , $params = array()){
        $this->loadView($view,$params);
    }
    public function renderText($txt){
        echo $txt;
    }
}
