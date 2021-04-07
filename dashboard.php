    <?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:login.php');
    }
    require_once('db_connect.php');
    $sql = "SELECT image FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s',$_SESSION['email']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($email);
    $stmt->fetch();

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div id="dashboard-header">
            <div id="dashboard-top-left">
                <p>Welcome <span class="username-box"><?php echo $_SESSION['username']; ?></span> </p>
                <p>Account Email:- <span class="email-box"> <?php echo $_SESSION['email']; ?></span> </p>
            </div>
            <div id="dashboard-top-right">
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <div id="dashboard-image-container">
            <img src='<?php echo $email; ?>' alt=""/>
        </div>
    </body>
    </html>
