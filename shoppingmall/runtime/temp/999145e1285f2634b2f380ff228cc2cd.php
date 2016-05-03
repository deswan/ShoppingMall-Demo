<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:99:"/Applications/XAMPP/xamppfiles/htdocs/thinkphp5/public/../application/index/view/user/homepage.html";i:1462159510;}*/ ?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
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



	<div class="container">
		<h2>个人资料</h2>
		<form action=<?php echo url('user/modify'); ?> method="post">
			<label>手机号</label><input type="text" name='phone' value=<?php echo (isset($phone) && ($phone !== '')?$phone:''); ?>>
			<label>邮箱</label><input type="text" name='email' value=<?php echo (isset($email) && ($email !== '')?$email:''); ?>>
			<input type="submit" value="修改">
		</form>
		<h2>我的足迹</h2>
		<?php echo (isset($emptyInform) && ($emptyInform !== '')?$emptyInform:""); if(is_array($goodsList)): $i = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?>
		<div class="goods">
			<img src='/thinkphp5/public/static/<?php echo $good['imgurl']; ?>'>
			<p class="goodName"><?php echo $good['name']; ?></p>
			<p class="price">价钱:<?php echo $good['price']; ?></p>
			<p class="price">购买时间:<?php echo $good['time']; ?></p>
			<p class="join"><a href=<?php echo url('shopcar/join',['id'=>$good['id']]); ?>>加入购物车</a></p>
		</div>
		<?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	
</body>
</html>