<?php
namespace app\index\controller;
use \think\Controller;
use \app\index\model as M;
class ShopCar extends Controller{
	public function index(){
		$view = new \think\View();
		if(!\think\Session::has('username')) {
			$this->redirect('user/index');
		}
		else{
			$username = \think\Session::get('username');
			$view->username = $username;
		}
		$MCar = new M\ShopCar();
		$goodsList = $MCar->showShopCar($username);
		//若$查询结构为空，则$goodsList==array()
		if(empty($goodsList)) $view->emptyInform="购物车为空！";
		$view->goodsList = $goodsList;
		return $view->fetch();
	}
	public function join(){
		if(!input('?get.id')) return;
		if(!\think\Session::has('username')) {
			$this->redirect('user/index');
		}
		else{
			$MCar = new M\ShopCar();
			if($MCar->join(input('get.id'),\think\Session::get('username'))){
				return $this->success('加入购物车成功！');
			};
		}
	}
	public function buy(){
		if(!input('?get.id')) return $this->_empty();
		if(!\think\Session::has('username')) {
			$this->redirect('user/index');
		}
		$id = input('get.id');
		$MBought =new M\Bought();
		$MCar = new M\ShopCar();
		$res = $MBought->join($id,\think\Session::get('username'));
		if($res){
			M\ShopCar::where("id=$id")->delete();
			return $this->success('购买成功！');
		}
		else{
			return $this->error('购买失败');
		}
	}
	public function delete(){
		if(!input('?get.id')) return $this->_empty();
		if(!\think\Session::has('username')) {
			$this->redirect('user/index');
		}
		$id = input('get.id');
		$res = M\ShopCar::where("id=$id")->delete();
		if($res){
			return $this->success('删除成功！');
		}
		else{
			return $this->error('操作失败！');
		}
	}

	public function _empty(){
		$this->redirect('index/index');
	}
}
?>