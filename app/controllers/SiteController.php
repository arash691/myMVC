<?php
class SiteController extends Controller {
    public function actionIndex(){
        $this->renderPartial('index',array());
    }
}
