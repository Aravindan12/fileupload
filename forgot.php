<?php
$email = "";

$errors = array();
//connect to db
$db = mysqli_connect('localhost','root','','auth');
//if submit is clicked
if(isset($_POST['check'])){
    $email = $_POST['email'];
    if(empty($email)){
        array_push($errors,"email is required");
    }
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($db,$query);
    if(mysqli_num_rows($result) == 1){
        $to = $email;
        $subject = "mail verify";
        $message = "<a href = 'http://localhost/trail/confirm.php'>verify</a>";
        $headers = "From: fortheotherpurpose04@gmail.com "."\r\n";
        $headers .="MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($to,$subject,$message,$headers);
        header('location:mail.php');
    } 
}

?>


<html>
<head>
welcome
</head>
<body>
<h1>please enter your email address</h1>
<form action = "forgot.php" method = "POST">
<div class="input-group">
<input type = "email" name = "email">
</div>
<div class="input-group">
<input type = "submit" name = "check">
</div>
</form>
</body>
</html>