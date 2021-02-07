<?php
if(isset($_POST['submit'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $target = "upload/".basename($_FILES['file']['name']);
    $fileExt = explode(".",$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','pdf');

    if(in_array($fileActualExt,$allowed)){
        if($fileError === 0){
            if($fileSize <1000000){
                $db = mysqli_connect('localhost','root','','auth');
                $upload = $db->query("INSERT INTO photos(image) VALUES('$fileName')");
                if($upload){
                    echo "your picture is uploaded";
                }else{
                    echo "picture is not uploaded";
                }
                move_uploaded_file($fileTmp,$target);
            }else{
                echo  "yourfile is too big!";
            }
        }else{
            echo "there was an error in uploading";
        }
    }else{
        echo "format is not supported";
    }
}
?>
<html>
<head>
welcome
</head>
<body>
<?php
$db = mysqli_connect('localhost','root','','auth');
$display = $db->query("SELECT * FROM photos");
while($row=mysqli_fetch_array($display)){
    $id = $row['id'];
}
$display1 = $db->query("SELECT * FROM photos WHERE id='$id'");
while($row=mysqli_fetch_array($display1)){
    echo "<img src = 'upload/".$row['image']."'>";
}
?>
<form action = "index.php" method = "POST" enctype = "multipart/form-data">
<input type = "file" name = "file">
<input type = "submit" name = "submit">
</body>
</html>