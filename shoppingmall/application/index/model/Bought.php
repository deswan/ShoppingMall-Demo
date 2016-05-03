<?php 
namespace app\index\model;
use think\Model;
class Bought extends Model{
	public function join($goodid,$username){
		$time = date("Y-m-d H:i:s" ,time());
		$res = \think\Db::name('bought')->insert([
			'goodid'=>"$goodid",
			'username'=>"$username",
			'time'=>"$time"
		]);
		if($res) return true;
		else return false;
	}
	public function showBought($username){
		return \think\Db::name('bought')->alias('b')
		->join('think_goods g','g.id=b.goodid')
		->where("b.username='$username'")
		->field('g.id,g.price,g.imgurl,g.name,b.time')
		->order('b.time desc')
		->select();
	}
}
?>