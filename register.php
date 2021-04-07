<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['username'])){
    if(isset($_POST['register-btn'])){
        require_once('db_connect.php');

        //Filtering user submitted data
        $username = $conn->real_escape_string(trim($_POST['username']));
        $email = $conn->real_escape_string(trim($_POST['email']));
        $password = $conn->real_escape_string(trim($_POST['password']));

        // Generating hash password
        $hash_password = password_hash($password,PASSWORD_DEFAULT);

        // Code to handle file uploading including file type check
        if($_FILES['myfile']['error'] > 0){
            echo 'Error in uploading the file. Please try again later';
            exit;
        }
       // $file_name = explode('.',$_FILES['myfile'][''])
        $upload_path = 'uploads/'.$_FILES['myfile']['name'];
        if(is_uploaded_file($_FILES['myfile']['tmp_name'])){
            if(!move_uploaded_file($_FILES['myfile']['tmp_name'],$upload_path)){
                echo 'error in moving file to destination';
                exit;
            }
        }else{
            echo 'Possible file attack.';
            exit;
        }
        $img_url = $upload_path;
        //Inserting record into database
        $sql = "INSERT INTO user(username,email,password,image) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss',$username,$email,$hash_password,$img_url);
        $stmt->execute();
        if($conn->affected_rows > 0){
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            header('location:dashboard.php');
        }else{
            echo "CAN'T INSERT TO DATABASE";
        }
    }
}else{
    header('location:dashboard.php');
}
?>