<!DOCTYPE html>
<?php   
    session_start(); 
    include "./conn.php";

    if(isset($_SESSION['userID'])){
        $userID = $_SESSION['userID'];        
    }else{
        header("Location: ./login.php");
        exit;
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div>
        <a href="./logout.php">Logout</a>
        <a href="./profile.php">Profile</a>
    </div>        
    </div>    
    <div class="post-box">
        <div>
            <form action=<?php echo "./postMessage.php?userId=$userID"?> method="POST">
                <h1>Post status</h1>
                <input name="message" id="message" class="form-control" placeholder="Enter your status">
                <button class="btn btn-primary mt-2 w-100" type="submit">POST</button>
            </form>
        </div>
    </div>


    <?php

        $sql = 'SELECT post.id, post.message, user.email FROM post INNER JOIN user ON post.userID=user.id ORDER BY post.id DESC';
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo '<div class="show-box">';
                echo     '<div>';
                echo         '<h3>' . $row['email']    . '</h3>';
                echo         '<p>' .  $row['message']   . '</p>';                
                $postID = $row['id']; 
                
                $sql1 = "SELECT * FROM likepost WHERE userID='$userID' AND postID='$postID'";
                $result1 = mysqli_query($conn, $sql1);
                if(mysqli_num_rows($result1) > 0){                    
                    echo         '<form action="./unlike.php?userID=' . $userID . '&postID=' . $row['id'] . '" method="POST">';
                    echo            '<button class="btn btn-danger w-100 mt-2">';
                    echo                'Unlike';
                    echo            '</button>';
                    echo         '</form>';  
                } else{                  
                    echo         '<form action="./like.php?userID=' . $userID . '&postID=' . $row['id'] . '" method="POST">';
                    echo            '<button class="btn btn-info w-100 mt-2">';
                    echo                'Like';
                    echo            '</button>';
                    echo         '</form>';  
                }                                                                                                                                                  
                echo     '</div>';
                echo '</div>';
            }
        }
    ?>
</body>
</html>