<?php
    include_once "./conn.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    // $username = $_POST['username'];

    $password = md5($password);

    $sql = "INSERT INTO user (email, password) VALUES ('$email', '$password')";

    if(mysqli_query($conn, $sql)){
        echo "register success";
        header("Location: ./login.php");
        exit;
    }
?>