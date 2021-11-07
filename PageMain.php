<?php 
require_once('config.php');
$love = $pdo->table('flowerlist')->limit(0,8);
$parents = $pdo->table('flowerlist')->limit(8,8);
$belove = $pdo->table('flowerlist')->limit(16,8);
$swiper = $pdo->table('swiper')->all();
$nav = $pdo->table('navmenuul')->where(['position'=>1])->all();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>小拐拐花店</title>
	<script src="./js/jquery-3.4.1.min.js"></script>
	<link rel="shortcut icon" href="./icon/logo.ico" />
	<link rel="stylesheet" href="./css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="./css/MainCss.css">

</head>
<body>
	<div class="divAll">
		<!-- 登录 -->
		<div>
			<?php
				include_once('commont/loginNav.php');
			?>
		</div>
		<!-- logo -->
		<div class="divLogo">
			<script>
				$('.divLogo').load('commont/logo.php')
			</script>
		</div>
		<!-- 轮播图 -->
		<div class="divLunBo">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php
						foreach($swiper as $key=>$var){?>
					<div class="swiper-slide">
						<img src="img/flowerimg/<?php echo $var['img']?>">
					</div>
					<?php
							}
					?>
				</div>
				<!-- 如果需要分页器 -->
				<div class="swiper-pagination"></div>

				<!-- 如果需要导航按钮 -->
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>

				<!-- 如果需要滚动条 -->
				<div class="swiper-scrollbar"></div>
			</div>
		</div>
		<!-- 菜单 -->
		<div class="divMainMenu">
			<div class="divMenuContent">
				<ul>
					<?php foreach($nav as $k =>$v){?>
					<li class="firstNav"><?php echo $v['ul']?>
						<ul>
							<?php 
								$ulli = $pdo->table('ul_ulli')->where(['position'=>$v['ul-id']])->all();
								foreach($ulli as $key => $value){ ?>
									<li><?php echo $value['li']?></li>
							<?php }?>
						</ul>
					</li>
					<?php }?>
				</ul>
			</div>
		</div>
		<!-- 鲜花列表 -->
		<div class="divContent">
			<!-- 左侧列表 -->
			<div class="divContentLeft">
				<div class="LeftTop">
				
					<h2 class="divContenOne">产品列表</h2>
					<ul>
						<?php 
							$navli = $pdo->table('ul_ulli')->where(['position'=>7])->all();
							foreach($navli as $k => $v){?>
								<li><?php echo $v['li']?></li>
						<?php }?>
					</ul>
				</div>
				<div class="LeftDown">
					<h2 class="divContenOne">订购指南</h2>
					<ul>
						<?php 
							$navli = $pdo->table('ul_ulli')->where(['position'=>8])->all();
							foreach($navli as $k => $v){?>
								<li><?php echo $v['li']?></li>
						<?php }?>
					</ul>
				</div>
			</div>
			<!-- 右侧列表 -->
			<div class="divContentRight">
				<!-- 爱情鲜花 -->
				<div>
					<ul>
						<div class="loveFlower clearfix">
						<p><span>爱情鲜花</span> <span> | 送 · 让你怦然心动的人</span></p>
					</div>
						<?php foreach ($love as $key => $value) {?>
						<li onclick="window.location.href='detail.php?id=<?php echo $value['id']; ?>'">
							<div class="RightFulowerTop">
								<img src="img/flowerimg/<?php echo $value['img']?>">
							</div>
							<div class="RightFulowerDown">
								<p class="title">
									<?php echo $value['name']?>
								</p>
								<p class="price">￥
									<?php echo $value['price']?>
								</p>
								<p class="count">已售
									<?php
							if($value['count']>10000){
								echo ($value['count']/10000)."万";
							}else{
								echo $value['count'];
								}?>件
								</p>
							</div>
						</li>
						<?php }?>
					</ul>
				</div>
				<!-- 长辈鲜花 -->
				<div>
					<ul>
						<div class="loveFlower clearfix">
						<p><span>送长辈鲜花</span> <span> | 赠 · 父母/恩师/长辈</span></p>
					</div>
						<?php foreach ($parents as $key => $value) {?>
						<li onclick="window.location.href='detail.php?id=<?php echo $value['id']; ?>'">
							<div class="RightFulowerTop">
								<img src="img/flowerimg/<?php echo $value['img']?>">
							</div>
							<div class="RightFulowerDown">
								<p class="title">
									<?php echo $value['name']?>
								</p>
								<p class="price">￥
									<?php echo $value['price']?>
								</p>
								<p class="count">已售
									<?php
							if($value['count']>10000){
								echo ($value['count']/10000)."万";
							}else{
								echo $value['count'];
								}?>件
								</p>
							</div>
						</li>
						<?php }?>
					</ul>
				</div>
				<!-- 永恒鲜花 -->
				<div>
					<div class="loveFlower clearfix">
						<p><span>永生花</span> <span> | 许 · 她一生承诺</span></p>
					</div>
					<ul>
						<?php foreach ($belove as $key => $value) {?>
						<li onclick="window.location.href='detail.php?id=<?php echo $value['id']; ?>'">
							<div class="RightFulowerTop">
								<img src="img/flowerimg/<?php echo $value['img']?>">
							</div>
							<div class="RightFulowerDown">
								<p class="title">
									<?php echo $value['name']?>
								</p>
								<p class="price">￥
									<?php echo $value['price']?>
								</p>
								<p class="count">已售
									<?php
							if($value['count']>10000){
								echo ($value['count']/10000)."万";
							}else{
								echo $value['count'];
								}?>件
								</p>
							</div>
						</li>
						<?php }?>
					</ul>
				</div>
			</div>
		</div>
		<div class="divFooter">

			<?php include_once('commont/footer.php')?>
		</div>
		<!-- 右边浮动框 -->
		<div class="fiex">
			<img class="imgs" src="img/cat.png">
			<img class="imgs" src="img/qq.jpg">
			<img class="imgs" src="img/wechart.jpg">
		</div>

	</div>
	<!-- 提示会话框 -->
	<div class="handleView">
		<div class="content">改进中，尽请期待</div>
		<button class="btn">关闭</button>
	</div>
	<script src="./js/swiper.min.js"></script>
	<script type="text/javascript">
		var fieximg = document.querySelector('.fiex');
		var handleView = document.querySelector('.handleView')
		var btn = document.querySelector('.btn')
		fieximg.onclick = function () {
			handleView.style.display = 'block';
		}
		btn.onclick = function () {
			handleView.style.display = 'none';
		}
		var mySwiper = new Swiper('.swiper-container', {
			// direction: 'vertical', // 垂直切换选项
			loop: true, // 循环模式选项
			autoplay: true,
			// 如果需要分页器
			pagination: {
				el: '.swiper-pagination',
			},

			// 如果需要前进后退按钮
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},

			// 如果需要滚动条
			// scrollbar: {
			//   el: '.swiper-scrollbar',
			// },
		})
	</script>

</body>

</html>