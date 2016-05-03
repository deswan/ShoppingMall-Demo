<?php
namespace app\index\controller;
use \think\Controller;
use \app\index\model as M;
class Index
{
    public function index()
    {
    	$view = new \think\View();
        $goodsTypeModel = new M\GoodsType();
        $goodModel = new M\Goods();
        $goodsList = $goodModel->selectGoodsForShow();
    	$view->goodsList=$goodsList;
        if(\think\Session::has('username')){
            $view->username=\think\Session::get('username');
        }
    	return $view->fetch();
    }
    public function test(){
    }
}

?>
