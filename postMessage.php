<?php
    include_once "./conn.php";

    $userID = $_GET['userId'];
    $message = $_POST['message'];
    echo $message;
    echo $userID;


    $sql = "INSERT INTO post (userID, message) VALUES ($userID, '$message')";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: ./feed.php");
        exit;
    }
?>