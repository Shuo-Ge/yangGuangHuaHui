
<style>
	.divLogin{
		width: 100%;
		height: 30px;
		background-color: #F3F5F7;
	}
	.divLogin .loginLeft{
		float: left;
	}
	.divLogin .loginLeft li,.divLogin .LoginRight li{
		margin-left: 20px;
		text-align: center;
		line-height: 30px;
		
	}
	.loginLeftA{
		position: relative;
		/* display: block; */
	}
	.loginLeftA:hover .loginLeftWx{
		display: block;
	}
	.loginLeftA .loginLeftWx{
		display: none;
		position: absolute;
		width: 200px;
		height: 200px;
		border: 1px solid #ccc;
		z-index: 2;
		background: url(./img/wx.jpg)no-repeat;
		background-size: 100%;
	}
	.divLogin a{
		color: #999;
	}
	.divLogin a:hover{
		color: #FF734C;
	}
	.divLogin .LoginRight{
		float: right;
	}

	 .loginLeft ul{
		float: left;
	}
	 .LoginRight ul{
		float: right;
	}
	 .loginLeft  li,.LoginRight  li{
		float: left;
	}
</style>

	<script>
	</script>
	<div class="divLogin">
			<ul class="loginLeft">
				<?php 
					session_start();
				
					$username = isset($_SESSION['username']) ? $_SESSION['username'] : ""; //判断session是否为空
					if (!empty($username)) { ?> 
						<li><a >欢迎你, <?php echo $username?></a></li>
						<li><a class="destroy" href="./static/quite.php">注销</a></li>
				 <?php }else{ ?>
						<li><a href="./login.php">登录</a></li>
				 	 <?php } ?>
				
				<li><a href="#">注册</a> </li>
				<li><a href="#" class="loginLeftA">联系我们
					<div class="loginLeftWx">
						
					</div>
				</a> </li>
			</ul>
			<ul class="LoginRight">
				<li><a href="#">购物车</a></li>
				<li><a href="#">设为首页</a></li>
				<li><a href="#">加入收藏夹</a></li>
			</ul>
		</div>
		
