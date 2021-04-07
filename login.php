<?php
session_start();
if(!isset($_SESSION['username'])){
    if(isset($_POST['login-btn'])){

        require_once('db_connect.php');

        //Filtering user submitted data
        $username = $conn->real_escape_string(trim($_POST['username']));
        $password = $conn->real_escape_string(trim($_POST['password']));

        $sql = "SELECT email,password FROM user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($email, $hash_password);
        $stmt->fetch();
        if($stmt->num_rows > 0){
            if(password_verify($password,$hash_password)){
                $_SESSION['username']=$username;
                $_SESSION['email']=$email;
                header('location:dashboard.php');
            }else{
                ?>
                    <script>alert("Password do not match");</script>
                <?php
            }
        }else{
            ?>
            <script>alert("User does not exists");</script>
            <?php
        }
    }
}
else{
    header('location:dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header><h1>Login Form</h1><a href="index.php">Register</a></header>
    <form action="" method="POST" class="form">
        <table>
            <tr>
                <td><input type="text" name="username" placeholder="Enter Your Name"/></td>
            </tr>
            <tr>
               <td><input type="password" name="password" placeholder="Enter Your Password"/></td>
            </tr>
            <tr>
                <td><input type="submit" name="login-btn" value="Login"/></td>
            </tr>
        </table>
    </form>
</body>
</html>