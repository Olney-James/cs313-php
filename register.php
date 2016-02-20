<?php
    //connect to the database and open session
    session_start();
    require_once("databaseconnection.php");
?>
<ARTICLE>
    <HEAD>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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

            div.container {
                margin: auto;
                width:40px;
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
        <!-- title register below WhyBuy -->
        <a class="whybuy" href="whybuy.php"><H1>WhyBuy</H1></a>
        <h3>Register</h3>

        <!-- below here is the form to submit -->
        <div class="container">
            <form action="insertUser.php" method="post">

                    <input type="text" name="user" size="10" maxlength="50" placeholder="Username"><br>
                    <!--Email(not required):
                    <input type="text" name="email" size="20" maxlength="50"><br>-->

                    <input type="password" name="password" size="10" maxlength="50" placeholder="Password">
                    <br>
                    <!--Verify Password:
                    <input type="text" name="password" size="10" maxlength="50">
                    <br>-->
                <center>
                    <input type="submit" value="Send" class="btn btn-default">
                </center>


            </form>
        </div>
        <a href="index.html">
            <h3><span class="glyphicon glyphicon-home"></span> Home</h3>
        </a>
    </BODY>
</ARTICLE>

