<?php 
	session_start();
	//success msg or failure
	if(isset($_SESSION['login_msg'])){
		$message = $_SESSION['login_msg'];
		echo "<script type='text/javascript'>alert('$message');</script>";
		unset($_SESSION['login_msg']);
	}
	unset($_SESSION['user']);
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
			
			div.container {
				margin: auto;
				width: 40px;
			}
			a.whybuy:hover{
				text-decoration: none;
			}
			a.whybuy:active {
				text-decoration: none;
			}
		</style>
		
      <TITLE>
         WhyBuy
      </TITLE>
   </HEAD>
<BODY>
	<a class="whybuy" href="whybuy.php"><H1>WhyBuy</H1></a>
		<H2>Login</H2>
	   <!--<H6>For testing purposes, use user: 'test' password: 'test'</H6>-->
		<div class="container">
			<form action="loginsubmit.php" method="post">
				<p><input type="text" name="username" size="10" maxlength="20" placeholder="Username"></p>
				
				<p><input type="password" name="password" size="10" maxlength="20" placeholder="Password"></p>
				
				<br>
				<center>
					<input type="submit" value="Send" class="btn btn-default">
				</center>

			</form>	
		</div>
	   <a href="register.php">
		   <h3>Register for a username here</h3>
	   </a><br>
	<a href="index.html">
		<h3><span class="glyphicon glyphicon-home"></span> Home</h3>
	</a>

</BODY>
</ARTICLE>
