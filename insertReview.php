<?php
    session_start();
    require_once("databaseconnection.php");

    function getuserid($name){
        global $test;
        $query="SELECT user_id FROM user_name WHERE user_name = '".$name."'";
        $statement = $test->prepare($query);
        $statement->execute();
        $userids = $statement->fetchAll();
        $statement->closeCursor();
        return $userids;
    }
    global $test;
    $item = $_GET['item'];
    $comment=filter_input(INPUT_POST, "comment", FILTER_SANITIZE_STRING);
    $user=$_SESSION['user'];
    $users = getuserid($user);
    foreach($users as $u) {
        $user_id = $u['user_id'];
    }
    //echo $user_id." ";
    //echo $item." ";
    //ho $comment." ";
    //echo $user." ";

    // Begin a new Transaction -->
    $test->beginTransaction();


    // First insert the scripture INSERT INTO review (review, item_id, user_id) VALUES ("TEST", 1, 3)-->
    $query = "INSERT INTO review (review, item_id, user_id) VALUES (:comment, :item, :user_name)";
    $statement = $test->prepare($query);
    $statement->bindValue(":comment", $comment);
    $statement->bindValue(":item", $item);
    $statement->bindValue(":user_name", $user_id);
    $statement->execute();
    $statement->closeCursor();

    // End and send the Transaction to the database -->
    $test->commit();
    $_SESSION['review_msg']="Review has been posted";
    header('Location: comment.php?item='.$item);
?>

