<?php 
include_once('config.php');
$id = $_GET['id'];
$info = $pdo->table('flowerlist')->where(['id'=>$id])->find();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>详情</title>
	<script src="./js/jquery-3.4.1.min.js"></script>
	<link rel="shortcut icon" href="./icon/logo.ico" />
	<link rel="stylesheet" href="./css/detail.css">
</head>
<body>
<!-- 登录 -->
	<div>
		<?php
			include_once('commont/loginNav.php');
		?>
	</div>
	<!-- logo -->
	<div class="divLogo">
		<script>
			$('.divLogo').load('./commont/logo.php')
		</script>
	</div>
	<div class="detail">
		<div class="detailLeft">
			<img src="img/flowerimg/<?php echo $info['img']?>" alt="">
		</div>
		<div class="detailRight">
			<div class="title-name"><?php echo $info['name']?></div>
			<div class="title-detial">
				<span class="tag"><?php echo $info['tag']?> </span>
				<span class="title-title"><?php echo $info['detail']?></span>
			</div>
			<div class="goods-price-warp">
				<div class="goods-price-name">售价</div>
				<span class="goods-price">￥<?php echo $info['price']?></span>
				<span class="goods-oldprice">市场价<s>￥<?php echo $info['oldprice']?></s></span>
				<span class="goods-pay">已售<i><?php
							if($info['count']>10000){
								echo ($info['count']/10000)."万";
							}else{
								echo $info['count'];
								}?></i> 件</span>
			</div>
			<div class="content">
				<div class="content-item">
				 <?php if(empty($info['flowertell'])){}else{?>
					<div class="huayu">
						<div class="huayu-title">花语</div>
						<span class="huayu-name"><?php echo $info['flowertell']?></span>
					</div>
					<?php } ?>
					<div class="huayu">
						<div class="huayu-title">材料</div>
						<span class="huayu-name"><?php echo $info['cailiao']?></span>
					</div>
					<div class="huayu">
						
						<div class="huayu-title">包装</div>
						<span class="huayu-name"><?php echo $info['baozhuang']?></span>
					</div>
				</div>
			</div>
			<div id="btn">
				<button class="addcar">加入购物车</button>
				<button class="pay">点击购买</button>
			</div>
		</div>
	</div>
</body>
</html>