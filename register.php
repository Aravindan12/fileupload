<?php

session_start();

$name = "";
$email = "";

$errors = array();

//connect to db
$db = mysqli_connect('localhost','root','','auth');
//if register button is clicked
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    
    

//check whether those fields are filled
if(empty($name)){
    array_push($errors,'name is required');
}
if(empty($email)){
    array_push($errors,'email is required');
}
if(empty($password)){
    array_push($errors,'password is required');
}

if($password != $c_password){
    array_push($errors,'password not match');
}

//if no error insert the field into database
if(count($errors)==0){
    $vkey = md5(time().$name);
    $password = md5($password);
    $sql = "INSERT INTO users(name,email,password,vkey) VALUES('$name','$email','$password','$vkey')";
    mysqli_query($db,$sql);
  
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($db,$query);
    
        

        
    if($sql){
        //send email
        $to = $email;
        $subject = "mail verify";
        $message = "<a href = 'http://localhost/trail/try.php?vkey=$vkey'>verify</a>";
        $headers = "From: fortheotherpurpose04@gmail.com "."\r\n";
        $headers .="MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($to,$subject,$message,$headers);
        header('location:mail.php');
    }else{
        echo "error";
    }

    
    $_SESSION['name'] = $name;
    $_SESSION['success'] = "you are logged in";
}
}

?>
<html>
    <head>
        <title>
        register form
        </title>
    </head>
    <body>
        <form action="register.php" method="POST">
        <?php include('errors.php'); ?>
            <div class="form-group">
            <input type="text" name="name" placeholder="name">
            </div>
            <div class="form-group">
            <input type="email" name="email" placeholder="email">
            </div>
            <div class="form-group">
            <input type="password" name="password" placeholder="password">
            </div>
            <div class="form-group">
            <input type="password" name="c_password" placeholder="confirm password">
            </div>
            <div class="form-group">
            <input type="submit" name="register" value="register">
            </div>
            
            <p>Already a user?<a href="login.php" name="login">login</a></p>
        </form>
    </body>
</html>    