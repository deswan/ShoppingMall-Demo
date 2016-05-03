<?php
namespace app\index\controller;
use \think\Controller;
use \app\index\model as M;
class User extends Controller{
	public function index(){
		if(\think\Session::has('username')){
			$view = new \think\View();
			$username = \think\Session::get('username');
			$b=new M\Bought();
			$infor = M\User::where("user_name='$username'")->find();
			$goodsLis = $b->showBought(\think\Session::get('username'));
			if(empty($goodsLis)) $view->emptyInform="无购买记录！";
			$view->goodsList = $goodsLis;
			$view->phone = $infor->phone_number;
			$view->email = $infor->email;
			// dump($view->goodsLis);
			return $view->fetch('homepage');
		}
		else{
			$view =new \think\View();
			return $view->fetch();
		}
	}

	//login=>登陆
	public function login(){
		//若没有post则跳转到空控制器
		if(!\think\Input::post('?username')||!\think\Input::post('?password')) return;

		$username = \think\Input::post('username');
		$password = \think\Input::post('password');
		$vali_result = $this->validate([
			'username'=>"$username",
			'password'=>"$password"
		],
		[
			'username'=>'require|length:3,21',
			'password'=>'require|length:5,15|alphaDash'
		]);
		//RC3:若验证成功则返回bool(true)，否则返回错误信息string
		if($vali_result !== true){
			return $this->error($vali_result);
		}
		$MUser =new M\User();
		$username_result = M\User::where("user_name='$username'")->find();
		if(!$username_result) return $this->error('该用户名不存在');
		var_dump($password);
		var_dump($username_result->password);
		if($password !== $username_result->password) return $this->error('密码不正确');
		\think\Session::set('username',"$username");
		return $this->success('登陆成功','../index/index');
		
	}
	//signup=>签约（注册）
	public function signup(){
		if(!\think\Input::post('?username')||!\think\Input::post('?password')) return;

		$username = \think\Input::post('username');
		$password = \think\Input::post('password');
		$vali_result = $this->validate([
			'username'=>"$username",
			'password'=>"$password"
		],
		[
			'username'=>'require|length:3,21',
			'password'=>'require|length:5,15|alphaDash'
		]);
		if($vali_result!==true){
			//当前路径为index.php/user/
			//用绝对路径好还是相对路径好？
			return $this->error($vali_result);
		}
		
			//若直接把取得的数据进行数据库操作，数据库可能会报错（无法捕获？）

			$MUser =new M\User();
			//若找不到结果，则返回bool(false);若找到结果，则返回app\index\model\User类实例
			$username_result = M\User::where("user_name='$username'")->find();
			// $username_result = $MUser->findAUserName($username);
			
			if($username_result){
				return $this->error('注册失败（用户名已经存在）');
			}
			$MUser->user_name=$username;
			$MUser->password=$password;
			$res = $MUser->save();	
			\think\Session::set('username',"$username");
			return $this->success('注册成功','../index/index');
	}
	public function modify(){
		if(!\think\Input::post('?phone')||!\think\Input::post('?email')) return;
		if(!\think\Session::has('username')) return $this->index();
		$phone = \think\Input::post('phone');
		$email = \think\Input::post('email');
		$username = \think\Session::get('username');
		$vali_result = $this->validate([
			'phone'=>"$phone",
			'email'=>"$email"
		],
		[
			'phone'=>'require|length:11',
			'email'=>'require|email'
		]);
		if($vali_result!==true) return $this->error($vali_result);
		// $MUser =new M\User();
		$u = M\User::get($username);
		$u->phone_number=$phone;
		$u->email=$email;
		$u->save();
		return $this->success('修改成功！');
	}
	public function logout(){
		if(!\think\Session::has('username')) return;
		\think\Session::delete("username");
		return $this->success('成功退出');
	}
}
?>