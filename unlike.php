<?php
    include_once "./conn.php";

    $userId = $_GET['userID'];
    $postId = $_GET['postID'];    

    echo $userId . " " . $postId;

    $sql = "DELETE FROM likepost WHERE userID='$userId' AND postID='$postId'";
    if(mysqli_query($conn, $sql)){        
        header("Location: ./feed.php");
        exit;
    }
?>