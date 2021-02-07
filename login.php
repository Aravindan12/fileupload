<?php 
session_start();

$name = "";
$password = "";

$errors = array();

//connect to db
$db = mysqli_connect('localhost','root','','auth');

//log user in from login page
    if(isset($_POST['login'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
    
    if(empty($name)) {
        array_push($errors,"username is required");
    }
    if(empty($password)){
        array_push($errors,"password is required");
    }
    if(count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE name='$name' AND password = '$password' ";
        $result = mysqli_query($db,$query);
        if (mysqli_num_rows($result) == 1){
            $row = $result->fetch_assoc();
            $verified = $row['verified'];

            if($verified == 1){
                $_SESSION['name'] = $name;
            $_SESSION['success'] = "you are logged in";
            header('location: index.php');//redrict to home pag
            } else {
            echo "please verify your account";
            }
        }else{
            array_push($errors,"wrong username/password combination");
        }
    }
}
    //logout 
    if(isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['name']);
        header('location:login.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User login form</title>
    </head>
    
    <body>
        <h2>Login</h2>
        <form action="login.php" method="POST">
        <?php include('errors.php'); ?>
            <div class="input-group">
                <label>Username:</label><input type="text" name="name" id="name">
            </div>
            <div class="input-group">
                <label>password:</label><input type="password" name="password" id="pas">
            </div>
            <div class="input-group">
                <input type="submit" value="submit" name="login">
            </div>
            <p> not Already a member?<a href="register.php">register</a></p>
            <p>Forgot password?<a href="forgot.php" name="forgot">click me!</a></p>

        </form>
    </body>
</html>