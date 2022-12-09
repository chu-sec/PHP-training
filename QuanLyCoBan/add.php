<?php
    require 'function.php';
     
    // Nếu người dùng submit form
    if (!empty($_POST['add_user']))
    {
        // Lấy data
        $data['username'] = isset($_POST['username']) ? $_POST['username'] : '';
        $data['password'] = isset($_POST['password']) ? md5($_POST['password']) : '';
        $data['email'] = isset($_POST['email']) ? $_POST['email'] : '';
        $data['ten']    = isset($_POST['ten']) ? $_POST['ten'] : '';
        $data['sdt']    = isset($_POST['sdt']) ? $_POST['sdt'] : '';
         
        // Validate thông tin
        $errors = array();
        if (empty($data['username'])){
            $errors['username'] = 'Chưa nhập tên người dùng';
        }
         
        if (empty($data['password'])){
            $errors['password'] = 'Chưa nhập mật khẩu';
        }
        if (empty($data['email'])){
            $errors['email'] = 'Chưa nhập email';
        }
        if (empty($data['ten'])){
            $errors['ten'] = 'Chưa nhập họ tên';
        }
        if (empty($data['sdt'])){
            $errors['sdt'] = 'Chưa nhập số điện thoại';
        }
         
        // Nếu không có lỗi
        if (!$errors){
            add_user($data['username'], $data['password'], $data['email'], $data['ten'], $data['sdt']);
            // Trở về trang danh sách
            header("location: list.php");
        }
    }
     
    disconnect_database();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Thêm người dùng</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Thêm người dùng</h1>
        <a href="list.php">Trở về</a> <br/> <br/>
        <form method="post" action="add.php">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Tên đăng nhập</td>
                    <td>
                        <input type="text" name="username" value="<?php echo !empty($data['username']) ? $data['username'] : ''; ?>"/>
                        <?php if (!empty($errors['username'])) echo $errors['username']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Mật khẩu</td>
                    <td>
                        <input type="password" name="password" value="<?php echo !empty($data['password']) ? $data['password'] : ''; ?>"/>
                        <?php if (!empty($errors['password'])) echo $errors['password']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="text" name="email" value="<?php echo !empty($data['email']) ? $data['email'] : ''; ?>"/>
                        <?php if (!empty($errors['email'])) echo $errors['email']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Họ tên</td>
                    <td>
                        <input type="text" name="ten" value="<?php echo !empty($data['ten']) ? $data['ten'] : ''; ?>"/>
                        <?php if (!empty($errors['ten'])) echo $errors['ten']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>
                        <input type="text" name="sdt" value="<?php echo !empty($data['sdt']) ? $data['sdt'] : ''; ?>"/>
                        <?php if (!empty($errors['sdt'])) echo $errors['sdt']; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="add_user" value="Lưu"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>