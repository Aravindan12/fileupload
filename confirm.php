<?php

$password1 = "";
$password2 = "";

$errors = array();

$db = mysqli_connect('localhost','root','','auth');

//if valid button is clicked
if(isset($_POST['valid'])){
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if(empty($password1)){
        array_push($errors,"password is required");
    }
    if(empty($password2)){
        array_push($errors,"confirm your password");
    }
    if($password1 != $password2){
        array_push($errors,"password not match");
    }
    if(count($errors) == 0) {
        $password1 = md5($password1);
    $result = mysqli_query($db,"SELECT * FROM users");
    while($row = mysqli_fetch_array($result)){
        $id = $row['id'];
    }
    $update = "UPDATE users SET password = '$password1' WHERE id = '$id'";
    $result1 = mysqli_query($db,$update);
    
    if($result1){
        echo "your password is updated. you can login now";
        echo "<a href='login.php'>login</a>";

    }else{
        echo "invalid email-id";
    }
    }
}

?>
<html>
<head>
confirm password
</head>
<body>
<form action = "confirm.php" method = "POST">
<?php include('errors.php'); ?>
<div class="input-group">
Password:<input type="password" name = "password1">
</div>
<div class="input-group">
Confirm Password:<input type="password" name = "password2">
</div>
<div class="input-group">
<input type="submit" name = "valid">
</div>
</form>
</body>
</html>