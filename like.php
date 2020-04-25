<?php
    include_once "./conn.php";

    $userId = $_GET['userID'];
    $postId = $_GET['postID'];    

    echo $userId . " " . $postId;

    $sql = "INSERT INTO likepost (userID, postID) VALUES ($userId, $postId)";
    if(mysqli_query($conn, $sql)){        
        header("Location: ./feed.php");
        exit;
    }
?>