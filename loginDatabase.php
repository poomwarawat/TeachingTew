<?php
    include_once "./conn.php";
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = md5($password);

    $sql = 'SELECT * FROM user';
    $result = mysqli_query($conn, $sql);
    $result_ckecked = mysqli_num_rows($result);

    if($result_ckecked > 0){
        while($row = mysqli_fetch_assoc($result)){            
            if($email == $row['email'] && $password == $row['password']){                
                $_SESSION['userID'] = $row['id'];
                header("Location: ./feed.php");
                exit;
            }
        }        
        header("Location: ./login.php");
    }

?>