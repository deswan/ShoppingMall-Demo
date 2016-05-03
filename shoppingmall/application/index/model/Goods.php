<?php
namespace app\index\model;
use think\Model;
class Goods extends Model{
	public function addGoods($name,$price,$typeid){
		$data['id']=null;
		$data['name']=$name;
		$data['price']=$price;
		$data['typeid']=$typeid;

		$this->add($data);
	}
	//无参数=>取全部商品 数组参数=>取指定商品
	public function selectGoodsForShow($typeids=''){

		//选出每种购物车中每个goodid的数目以及其对应的goodid
		$num_car = \think\Db::name('shop_car')
				->field('goodid,count(*) as num')
				->group('goodid')
				->buildSql();

		//选出每种已购商品中中每个goodid的数目以及其对应的goodid
		$num_bought = \think\Db::name('bought')
				->field('goodid,count(*) as num')
				->group('goodid')
				->buildSql();

		return empty($typeids)? 
				\think\Db::name('goods')->alias('g')
				->join($num_car.'a','g.id=a.goodid','LEFT')
				->join($num_bought.'b','g.id=b.goodid','LEFT')
				->join('think_goods_type t','g.typeid=t.id')
				->field('ifnull(a.num*0.4,0)+ifnull(b.num,0)*0.6 as hits,g.id,g.price,g.imgurl,g.name,t.type_name')
				->order('hits desc')
				->select()
				:
				\think\Db::name('goods')->alias('g')
				->join($num_car.'a','g.id=a.goodid','LEFT')
				->join($num_bought.'b','g.id=b.goodid','LEFT')
				->join('think_goods_type t','g.typeid=t.id')
				->where('t.id','in',$typeids)
				->field('ifnull(a.num*0.4,0)+ifnull(b.num,0)*0.6 as hits,g.id,g.price,g.imgurl,g.name,t.type_name')
				->order('hits desc')
				->select() ;

	}

}
?>