<?php
 
    require 'function.php';

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "mytask";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

     
    //Lấy thông tin hiển thị lên để người dùng sửa
    $id = isset($_GET['id']) ? (int)$_GET['id'] : '';
    if ($id) {
        $data = get_user($id);
    }
     
    // Nếu không có dữ liệu tức không tìm thấy người dùng cần sửa
    if (!$data) {
       header("location: list.php");
    }
     
    // Nếu người dùng submit form
    if (!empty($_POST['edit_user'])) {
        // Lấy data
        $data['email'] = isset($_POST['email']) ? $_POST['email'] : '';
        $data['ten'] = isset($_POST['ten']) ? $_POST['ten'] : '';
        $data['sdt'] = isset($_POST['sdt']) ? $_POST['sdt'] : '';
    }
     
     // Validate thông tin
    $errors = array();
    if (empty($data['email'])){
        $errors['email'] = 'Chưa nhập email';
    }
     
    if (empty($data['ten'])){
        $errors['ten'] = 'Chưa nhập họ tên';
    }

     if (empty($data['sdt'])){
        $errors['sdt'] = 'Chưa nhập số điện thoại';
    }
     
    // Nếu không có lỗi thì insert
    if (!$errors){
        edit_user($data['id'], $data['email'], $data['ten'], $data['sdt']);
        // Trở về trang danh sách
        header("location: list.php");
    }

    disconnect_database();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Sửa thông tin người dùng</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Sửa thông tin người dùng </h1>
        <a href="list.php">Trở về</a> <br/> <br/>
        <form method="post" action="edit.php?id=<?php echo $data['id']; ?>">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="text" name="email" value="<?php echo $data['email']; ?>"/>
                        <?php if (!empty($errors['email'])) echo $errors['email']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Họ tên</td>
                    <td>
                        <input type="text" name="ten" value="<?php echo $data['ten']; ?>"/>
                        <?php if (!empty($errors['ten'])) echo $errors['ten']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>
                        <input type="text" name="sdt" value="<?php echo $data['sdt']; ?>"/>
                        <?php if (!empty($errors['sdt'])) echo $errors['sdt']; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="edit_user" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>