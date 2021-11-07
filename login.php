<?php 
	function login(){
		require_once('config.php');
		if(empty($_POST['username'])){
			$GLOBALS['message'] = '填写用户名';
			return ;
		}
		if(empty($_POST['password'])){
			$GLOBALS['message'] = '填写密码';
			return ;
		}
		$username = $_POST['username'];
		$password = $_POST['password'];
		$info = $pdo->table('user')->where(['username'=>$username])->find();
	
		if($info['username']!==$username){
			$GLOBALS['message'] = '用户名密码错误';
			return;
		}
		if($info['password']!==$password){
			$GLOBALS['message'] = '用户名密码错误';
			return;
		}
		session_start();
    	$_SESSION['username'] = $username;
		header('Location:./PageMain.php');
	}

	if($_SERVER['REQUEST_METHOD']==='POST'){
		login();
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>登录</title>
	<link rel="stylesheet" type="text/css" href="./css/login.css">
	<link rel="shortcut icon" href="./icon/logo.ico" />
	<link rel="stylesheet" href="./font/iconfont.css">
	<link rel="stylesheet" href="./css/animate.min.css">
</head>

<body>
	
	<!-- logo -->
	<div class="divLogo">
		<img onclick="window.location.href='./PageMain.php'" src="./img/logo1.png">
	</div>
	<!-- 广告 -->
	<div class="banner">
		<div class="banner_login">
			<div class="login_header">
				<div class="login_dl">账号登录</div>
				<div class="login_sm"> 微信扫码登录</div>
			</div>
			<div class="login_main">
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" autocomplete="on">
					<div class="username"><input type="text" name="username" id="" value="" placeholder="请输入手机号或者邮箱" /></div>
					<div class="password"><input type="password" name="password" id="" value="" placeholder="请输入密码" /></div>
					<?php if(isset($message)): ?>
						<div class="error animate__animated animate__shakeX"><i class="iconfont">&#xe617;</i><?php echo $message?></div>
					<?php endif ?>
					<button class="btn">登录</button>
				</form>
				<!-- 微信二维码 -->
				<div class="wximage">

				</div>
			</div>
			<div class="login_footer">
				<ul>
					<li><a href="#"><i class="qq"></i><span>QQ</span></a></li>
					<li><a href="#"><i class="zfb"></i>支付宝</a></li>
					<li class="text"><a href="register.php">立即注册</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="footer">
		<?php include_once('commont/footer.php')?>
	</div>
	
	<script>
		var phone = document.querySelector('.login_dl');
		var wx = document.querySelector('.login_sm');
		var form = document.querySelector('form');
		var wximage = document.querySelector('.wximage');
		phone.onclick = function () {
			form.style.display = "block";
			this.style.color = "#FF734C"
			wx.style.color = "#ccc";
			wximage.style.display = "none";

		}
		wx.onclick = function () {
			form.style.display = "none";
			this.style.color = "#FF734C"
			phone.style.color = "#ccc";
			wximage.style.display = "block";
		}
	</script>
</body>

</html>