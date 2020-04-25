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
    <div class="container">
        <a href="./feed.php">Feed</a>
        <div class="row">
            <div class="col-12 profile">
                <div>
                    <form action=<?php echo "./uploadprofile.php?userID=" . $userID ?> method="POST" enctype="multipart/form-data">
                    <?php
                        $sql = "SELECT * FROM user WHERE id='$userID'";
                        $result = mysqli_query($conn, $sql);
                        $result_check = mysqli_num_rows($result);

                        if($result_check > 0){
                            while($row = mysqli_fetch_assoc($result)){
                                if($row['profile'] != ""){
                                    echo '<img id="profile" src="./' . $row['profile']  . '">';                                    
                                }else{
                                    echo '<img id="profile" src="https://i.dlpng.com/static/png/6910276_preview.png">';                                    
                                }
                            }
                        }
                    ?>                    
                    <input type="file"  accept="image/*" name="picture-profile" id="picture-profile"  onchange="loadFile(event)" class="form-control mt-2">
                    <label for="picture-profile" class="btn btn-success mt-2" id="labelBtn">Select photo</label>
                    <button type="submit" class="btn btn-primary" id="UploadBtn">Upload</button>
                    <?php
                        $sql1 = "SELECT * FROM user WHERE id='$userID'";
                        $result1 = mysqli_query($conn, $sql1);
                        $result_check1 = mysqli_num_rows($result1);

                        if($result_check1 > 0){
                            while($row1 = mysqli_fetch_assoc($result1)){
                                echo '<h3 class="mt-2">' . $row1['email'] . '</h3>';
                            }
                        }
                    ?>                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>    
    var loadFile = function(event) {
        var image = document.getElementById('profile');
        if(image.src = URL.createObjectURL(event.target.files[0])){            
            const upload = document.getElementById("UploadBtn")
            upload.className = "btn btn-primary mt-2"
            upload.style.display = "inline"
            document.getElementById("labelBtn").style.display = "none"
        }
    };
</script>
</html>