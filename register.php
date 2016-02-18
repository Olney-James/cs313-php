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
        <!-- title register below WhyBuy -->
        <H1>WhyBuy</H1>
        <h3>Register</h3>

        <!-- below here is the form to submit -->
        <center>
            <form action="insertUser.php" method="post">
                User Name:
                <input type="text" name="user" size="10" maxlength="50"><br>
                <!--Email(not required):
                <input type="text" name="email" size="20" maxlength="50"><br>-->
                Password:
                <input type="password" name="password" size="10" maxlength="50">
                <br>
                <!--Verify Password:
                <input type="text" name="password" size="10" maxlength="50">
                <br>-->
                <input type="submit" value="Send" class="btn btn-default">
            </form>
        </center>
    </BODY>
</ARTICLE>

