<?php
    session_start();
    require_once("databaseconnection.php");
    //error_reporting(-1);
    if(isset($_SESSION['review_msg'])){
        $message = $_SESSION['review_msg'];
        echo "<script type='text/javascript'>alert('$message');</script>";
        unset($_SESSION['review_msg']);
    }


    function getReviewByItem()
    {
        global $test;
        $item = $_GET['item'];
        $query = "SELECT review, user_name.user_name FROM review INNER JOIN user_name ON review.user_id = user_name.user_id WHERE item_id = '$item'";
        $statement = $test->prepare($query);
        $statement->execute();
        $review = $statement->fetchAll();
        $statement->closeCursor();
        return $review;
    }
    $review = getReviewByItem();
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

            p.center{
                text-align: center;
            }
            div.container {
                width: 800px;
                box-shadow: 5px 5px 5px black;
                background-color: white;
                border: #ff1204;
                border-width: thin;
            }
            div.container2 {
                height: 500px;
                width: 800px;
                background-color: white;
                border: #ff1204;
                border-width: thin;
            }

            <!--below style table detail-->
                table {
                    width:100%;
                }
            table, th, td {
                border: 1px solid red;
                border-collapse: collapse;
            }
            th, td {
                padding: 5px;
                text-align: left;
            }
            table#t01 tr:nth-child(even) {
                background-color: #FFF8DC;
            }
            table#t01 tr:nth-child(odd) {
                background-color:	#FFFFF0;
            }
            table#t01 th	{
                background-color: red;
                color: white;
            }
            a.whybuy:hover{
                text-decoration: none;
            }
            a.whybuy:active {
                text-decoration: none;
            }
            button.red {
                background-color: #f44336;
                font-size: 15px;
                padding: 5px 5px;
                height: 30px;
            }
            div.user {
                position: absolute;
                right: 100px;
                top: 10px;
                width: 160px;
                float: right;
                border-style: solid;
                border-width: 5px;
                border-color: red;
            }
        </style>

        <TITLE>
            WhyBuy
        </TITLE>
    </HEAD>
    <BODY>

    <a class="whybuy" href="whybuy.php"><H1>WhyBuy</H1></a>

    <div class="container">
        <p><strong>Reviews: </strong></p>
        <?php
            foreach($review as $r)
            {
                echo $r['review'];
                echo " -".$r['user_name'];
                echo "<br><br>";
            }
        ?>
    </div>
    <br>
    <center>
        <div class="container2">
            <form action="insertReview.php?item=<?php $item = $_GET['item']; echo $item?>" method="post">
                <textarea name='comment' rows="12" cols="111" placeholder="Write your review here:"></textarea>
                <br><input type="submit" value="Send" class="btn btn-default">

            </form>
        </div>
    </center>
    <a href="index.html">
        <h3><span class="glyphicon glyphicon-home"></span> Home</h3>
    </a>
    <div class="user">
        <p><i class="glyphicon glyphicon-user"></i><strong>  Account: <?php echo $_SESSION['user']; ?>  </strong>

            <a href="login.php">
                <strong>Logout</strong>
            </a></p>
    </div>

    </BODY>
</ARTICLE>
