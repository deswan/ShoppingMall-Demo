<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:96:"/Applications/XAMPP/xamppfiles/htdocs/thinkphp5/public/../application/index/view/user/index.html";i:1462118224;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/css.css" />
</head>
<body>
<header>
		<ul>
			<li><a href=<?php echo url('index/index'); ?>>首页</a></li>
			<li><a href=<?php echo url('type/index'); ?>>分类</a></li>
			<li><a href=<?php echo url('shopcar/index'); ?>>购物车</a></li>
			<li><a href=<?php echo url('user/index'); ?>>个人中心</a></li>
		</ul>
	</header>
	<div class="top"></div>

<form action="" method="post" id="signup">
	<label>用户名</label>
	<input type="text" name="username">
	<label>密码</label>
	<input type="password" name='password'>
	<input type="submit" value='登陆' name='login'>
	<input type="submit" value='注册' name='signup'>
	
</form>
<script type="text/javascript" src="/thinkphp5/public/static/jQuery.js"></script>
<script type="text/javascript" src="/thinkphp5/public/static/form.js"></script>
</body>
</html>