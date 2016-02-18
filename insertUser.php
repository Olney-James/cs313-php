<?php
    error_reporting(-1);
    session_start();
    require_once("databaseconnection.php");

    function insertNewUser()
    {
        global $test;
        $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        // Begin a new Transaction -->
        $test->beginTransaction();
        $query = "INSERT into user_name (user_name, password) VALUES(:user, AES_ENCRYPT(:password, 'test'))";
        $statement = $test->prepare($query);
        $statement->bindValue(":user", $user);
        $statement->bindValue(":password", $password);
        $statement->execute();
        $statement->closeCursor();

        // Store the ID of the recently inserted scripture -->
        //$user_id = $test->lastInsertId();


        // End and send the Transaction to the database -->
        $test->commit();
        echo "user has been created";
    }
    insertNewUser();
    header('Location: login.php');
?>