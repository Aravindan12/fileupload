<?php



if(isset($_GET['vkey'])){
//verification
$vkey = $_GET['vkey'];

$db = mysqli_connect('localhost','root','','auth');

$resultSet = $db->query("SELECT verified FROM users WHERE verified = 0 LIMIT 1");
    //validate the email
    if($resultSet->num_rows == 1){
    $update = $db->query("UPDATE users SET verified = 1 WHERE vkey = '$vkey' LIMIT 1");

    if($update){
        echo "your account is verified";
        header('location:index.php');
    }else{
        echo "verify your account";
    }
}else{
    echo "you are already registered please go to login";
}

} else {
    die("something went wrong");
}

?>