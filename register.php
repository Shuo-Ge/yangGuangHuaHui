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
        $data=$_POST;
       
		// $info = $pdo->table('user')->where(['username'=>$username])->find();
		if(strlen($username)<4 || strlen($username)>12){
			$GLOBALS['message'] = '请输入4-12位的用户名';
			return;
		}
		if(strlen($password)<6 || strlen($password)>18){
			$GLOBALS['message'] = '请输入6-18位的密码';
			return;
		}
        if($info['username']===$username){
            $GLOBALS['message'] = '用户名已经存在';
			return;
        }
        $success = $pdo->table('user')->insert($data);
        if($success){
                $GLOBALS['message1'] = '注册成功,3秒后回到登录页面';
            	// header('Location:./login.php');
                header('Refresh:3,Url=login.php'); 
        }
	
	}

	if($_SERVER['REQUEST_METHOD']==='POST'){
		login();
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册</title>
    <link rel="stylesheet" type="text/css" href="./css/login.css">
    <link rel="shortcut icon" href="./icon/logo.ico" />
    <link rel="stylesheet" href="./font/iconfont.css">
    <link rel="stylesheet" href="./css/animate.min.css">
</head>

<body>
    <div class="divLogo">
        <img onclick="window.location.href='./PageMain.php'" src="./img/logo1.png">
    </div>
    <!-- 广告 -->
    <div class="banner">
        <div class="banner_login">
            <div class="login_header">
                <div class="login_dl">账号注册</div>
                <div class="login_sm"> 微信扫码注册</div>
            </div>
            <div class="login_main">
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" autocomplete="off">
                    <div class="username"><input type="text" name="username" id="" value="" placeholder="请输入4-12位的用户名" />
                    </div>
                    <div class="password"><input type="password" name="password" id="" value="" placeholder="请输入6-18位的密码" />
                    </div>
                    <?php if(isset($message)): ?>
                    <div class="error animate__animated animate__shakeX"><i class="iconfont">&#xe617;</i>
                        <?php echo $message?>
                    </div>
                    <?php endif ?>
                     <?php if(isset($message1)): ?>
                    <div class="success animate__animated animate__shakeX"><i class="iconfont">&#xe63e;</i>
                        <?php echo $message1?>
                    </div>
                    <?php endif ?>
                    <button class="btn">立即注册</button>
                </form>
                <!-- 微信二维码 -->
                <div class="wximage">

                </div>
            </div>
            <div class="login_footer">
                <ul>
                    <li><a href="#"><i class="qq"></i><span>QQ</span></a></li>
                    <li><a href="#"><i class="zfb"></i>支付宝</a></li>
                    <li class="text"><a href="login.php">立即登录</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="list">
            <ul>
                <li><a href="#">制作人:小拐拐</a></li>
                <li><a href="#">电话:12345678911</a></li>
                <li><a href="#">QQ:1260199408</a></li>
                <li><a href="#">公司:小拐拐工作室</a></li>

            </ul>
        </div>
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