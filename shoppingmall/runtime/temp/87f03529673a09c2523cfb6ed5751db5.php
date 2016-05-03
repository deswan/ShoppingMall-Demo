<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:97:"/Applications/XAMPP/xamppfiles/htdocs/thinkphp5/public/../application/index/view/index/index.html";i:1462258971;}*/ ?>
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
			<li><a href=<?php echo url('user/index'); ?>><?php echo (isset($username ) && ($username  !== '')?$username :"个人中心"); ?></a>
			<?php if(isset($username)): ?>
			<li><a href=<?php echo url('user/logout'); ?>>退出</a></li>
			<?php endif; ?>

			
		</ul>
	</header>
	<div class="top"></div>
	<div class="container">

			<?php if(is_array($goodsList)): $i = 0; $__LIST__ = $goodsList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$good): $mod = ($i % 2 );++$i;?>
			<div class="goods">
				<img src='/thinkphp5/public/static/<?php echo $good['imgurl']; ?>'>
				<p class="goodName"><?php echo $good['name']; ?></p>
				<p class="price">价钱:<?php echo $good['price']; ?></p>
				<p class='type'>分类:<?php echo $good['type_name']; ?></p>
				<p class='hits'>热门度：<?php echo $good['hits']; ?></p>
				<p class="join"><a href=<?php echo url('shopcar/join',['id'=>$good['id']]); ?>>加入购物车</a></p>
			</div>
			<?php endforeach; endif; else: echo "" ;endif; ?>
	</div>
	
</body>
</html>