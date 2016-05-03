<?php
namespace app\index\model;
use \think\Model;
class ShopCar extends Model{
	public function join($goodid,$username){
		$time = date("Y-m-d H:i:s" ,time());
		return \think\Db::name('shop_car')->insert(['goodid'=>"$goodid",'username'=>"$username",'time'=>"$time"]);
	}
	// public function delete($shopcarid,$username)
	public function showShopCar($username){
		//如果该用户登录了但购物车是空的？where无查询结果会报错吗
		return \think\Db::name('shop_car')->alias('car')
				->join('think_goods g','g.id=car.goodid')
				->where("car.username='$username'")
				->field('car.id,g.id as goodid,g.price,g.imgurl,g.name,car.time')
				->order('car.time desc')
				->select() ;
	}
}
?>