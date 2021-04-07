<?php
session_start();
if(isset($_SESSION['username'])){
    header('location:dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header><h1>Registration Form</h1><a href="login.php">Login</a></header>
    <form action="register.php" method="POST" enctype="multipart/form-data" class="form">
        <table>
            <tr>
                <td><input type="text" name="username" placeholder="Enter Your Username" required/></td>
            </tr>
            <tr>
                <td><input type="text" name="email" placeholder="Enter Your email" required/></td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="Enter Your Password" required/></td>
            </tr>
            <tr>
                <td><input type="file" name="myfile" placeholder="Upload your file here" required/></td>
            </tr>
            <tr>
                <td><input type="submit" name="register-btn" value="Register"/></td>
            </tr>
        </table>
    </form>
</body>
</html>