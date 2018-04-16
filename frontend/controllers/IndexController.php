<?php
namespace frontend\controllers;

use yii\web\Controller;
/**
 * Index controller
 */
class IndexController extends Controller
{
    /**
     * 默认继承模板
     * @var string
     */
    public $layout = 'header.php';

    /**
     * 首页
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
}