<?php ?>
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
			
	
	<a href="index.html">
		<h3>Home</h3>
	</a>
	<p>User:<?php echo $_SESSION['user']; ?></p>

</BODY>
</ARTICLE>
