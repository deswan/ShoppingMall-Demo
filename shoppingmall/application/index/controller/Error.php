<?php
namespace app\index\controller;
use \think\Controller;
use \app\index\model as M;
class Error extends Controller{
	public function index(){
		$this->redirect('index/index');
	}
}
?>