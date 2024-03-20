<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $address = $_POST["address"];
    $education = $_POST["education"];

    // $exists=false;
    
    // Check whether this username exists.
    $existSql = " SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    $result =  mysqli_query($conn, $existSql);
    if ($numExistRows > 0){
        // $exists = true;
        $showError = "Username Already Exists";
    }
    else{
        // $exists = false;
        if(($password == $cpassword)){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` ( `username`, `password`, `address`,`education`,`dt`) VALUES ( '$username', '$hash','$address','$education', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result){
                $showAlert = true;
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <?php require 'partials/_nav.php' ?>
        <?php
        if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You account is now created and you can login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
        if($showError){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong>'.$showError.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
        ?>
        <div class="container">
            <h1 class="text-center">Signup to our website</h1>
            <form action="/loginsystem/signup.php" method="post">
            <div class="mb-3 col-md-6">
                <label for="username">Username</label>
                <input type="text"maxlenght="30" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password"maxlenght="30" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">Make sure to type the same password</div>
            </div>
            <div class="mb-3 col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" maxlength="200" class="form-control" id="address" name="address"> 
            </div>
            <div class="mb-3 col-md-6">
                <label for="education" class="form-label">Your Education</label>
                <input type="text"maxlength="30" class="form-control" id="education" name="education"> 
            </div>
            <button type="submit" class="btn btn-primary col-md-6">Signup</button>
            </form>

        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
</body>
</html>
