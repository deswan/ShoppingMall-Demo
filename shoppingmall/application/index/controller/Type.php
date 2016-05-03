<?php  
namespace app\index\controller;
class Type {
	public function index(){
		$view = new \think\View();
		$MType = new \app\index\model\GoodsType;
		$MGoods = new \app\index\model\Goods;
		$typeid = \think\Input::get('typeid');	
		if(!is_numeric($typeid)&&isset($typeid)){	//参数只限null(不存在)或是数字
			//跳转到空控制器
		}
		if(\think\Session::has('username')){
            $view->username=\think\Session::get('username');
        }
		//导航部分数据（根据当前id显示子元素）
		$navData = $MType->selectChildsData($typeid);
		$view->navData = $navData;

		//商品数据
		$leaveIDs = $MType->selectLeavesID($typeid);
		$goodsList = $MGoods->selectGoodsForShow($leaveIDs);
		$view->goodsList = $goodsList;
		return $view->fetch();
	}
}
?>