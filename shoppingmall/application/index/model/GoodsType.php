<?php
namespace app\index\model;
use think\Model;

class GoodsType extends Model{
	
	//因为thinkphp是惰性加载，所以可以这样写
	private $leavesArr = array();


	public function addType($typeName,$fatherTypeName){
		// $fatherID = $this->where("type_name='$fatherTypeName'")->find()['id'];
		// $data['id']=NULL;
		// $data['type_name']=$typeName;
		// $data['father_type_name']=$fatherID;
		// $this->add($data);
	}
	public function selectChildsData($fatherID,$fieldName = null){
		if(is_null($fatherID)) $sqlWhere = "father_type_name is null";
		else $sqlWhere = "father_type_name = $fatherID";
		if(!isset($fieldName)){
			return \think\Db::table('think_goods_type')->where($sqlWhere)->select();
		}
		else{
			return \think\Db::table('think_goods_type')->where($sqlWhere)->getField($fieldName,true);
		}

	}
	// public function selectData($typeid){
	// 	if(!is_numeric($typeid)) return false;

	// }
	public function selectLeavesID($fatherID){
		$this->findLeaves($fatherID);
		return $this->leavesArr;
	}

	private function findLeaves($fatherID){
		$id = $fatherID;
		$childsIDList = $this->selectChildsData($id);
		if(empty($childsIDList)) {
			$this->leavesArr[] = $fatherID;
		}
		else{
			foreach ($childsIDList as $child) {
				$this->findLeaves($child['id']);
 			}
 		}
	}
}
?>