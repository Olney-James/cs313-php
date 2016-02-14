<?php 
	session_start();
	$_SESSION['user']='test';
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
		<H1>Login</H1>
		<form action="whybuy.php" method="post">
			User: 
			<input type="text" name="chapter" size="1" maxlength="3"><br>
			Password: 
			<input type="text" name="verse" size="1" maxlength="3"><br>
			<input type="submit" value="Send" class="btn btn-default">
		</form>	
	
	<a href="index.html">
		<h3>Home</h3>
	</a>
	<p>User:<?php echo $_SESSION['user']; ?></p>

</BODY>
</ARTICLE>
