<?php 
	session_start();
	//success msg or failure
	if(isset($_SESSION['login_msg'])){
		$message = $_SESSION['login_msg'];
		echo "<script type='text/javascript'>alert('$message');</script>";
		unset($_SESSION['login_msg']);
	}
?>
<ARTICLE>
   <HEAD>
		
	   <style>
			body {
				background-color: #FFF8DC;
			}

			h1 {
				color: red;
				text-align: center;
				font-family: "Magneto";
				font-size: 50;
			}
			
			h2 {
				text-align: center;
			}
			
			h3 {
				text-align: center;
			}
			
			p {
				text-align: center;
			}
			
			div.user {
				height: 80px;
				width: 160px;
				box-shadow: 5px 5px 5px black;
				float: right;
			}
		</style>
		
      <TITLE>
         WhyBuy
      </TITLE>
   </HEAD>
<BODY>
	   <H1>WhyBuy</H1>
		<H2>Login</H2>
	   <!--<H6>For testing purposes, use user: 'test' password: 'test'</H6>-->
		<center>
			<form action="loginsubmit.php" method="post">
				<p>Username: <input type="text" name="username" size="10" maxlength="20"></p>
				
				<p>Password: <input type="password" name="password" size="10" maxlength="20"></p>
				
				<br>
				<input type="submit" value="Send" class="btn btn-default">
			</form>	
		</center>
	   <a href="register.php">
		   <h3>Register for a username here</h3>
	   </a><br>
	<a href="index.html">
		<h3>Home</h3>
	</a>
	<p>User:<?php echo $_SESSION['user']; ?></p>

</BODY>
</ARTICLE>
