<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <br>
        <label>Chọn file</label>
        <input type="File" name="file">
        <input type="submit" name="submit" value="Tải lên">
    </form>
</body>
</html>

<?php
    require 'function.php';

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "mytask";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    $id = isset($_GET['id']) ? (int)$_GET['id'] : '';
    if ($id) {
        $data = get_user($id);
    }

    if(isset($_POST['submit'])){


        $pname = $_FILES["file"]["name"];

        $tname = $_FILES["file"]["tmp_name"];

        move_uploaded_file($tname, $pname);

        $sql = " UPDATE users SET avatar = '$pname' WHERE id = $id";

        if(mysqli_query($conn, $sql) && !empty($pname)){
            echo "Tải lên thành công";
        }else{
            echo "Thất bại";
        }
    }
?>
