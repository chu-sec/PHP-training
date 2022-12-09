<?php
require 'function.php';
$users = get_all_users();
disconnect_database();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách người dùng</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Danh sách người dùng</h1>
         <a href="search.php">Tìm kiếm người dùng</a> <br/> <br/>
        <a href="add.php">Thêm người dùng</a> <br/> <br/>

        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>id</td>
                <td>username</td>
                <td>password</td>
                <td>email</td>
                <td>ten</td>
                <td>sdt</td>
                <td>avatar</td>
                <td>role</td>
            </tr>
            <?php foreach ($users as $item) { ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['username']; ?></td>
                <td><?php echo $item['password']; ?></td>
                <td><?php echo $item['email']; ?></td>
                <td><?php echo $item['ten']; ?></td>
                <td><?php echo $item['sdt']; ?></td>
                <td><?php echo $item['avatar']; ?></td>
                <td><?php echo $item['role']; ?></td>
                <td>
                    <form method="post" action="delete.php">
                        <input onclick="window.location = 'edit.php?id=<?php echo $item['id']; ?>'" type="button" value="Sửa"/>

                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>"/>

                        <input onclick="return confirm('Bạn có chắc muốn xóa không?');" type="submit" name="delete" value="Xóa"/>

                        <input onclick="window.location = 'upload.php?id=<?php echo $item['id']; ?>'" type="button" value="Upload avatar"/>
                    </form>

                </td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <form method="post" action="phpexcel.php">
            <input onclick="return confirm('Bạn có chắc muốn xuất ra file excel không?');" type="submit" name="export" value="Export to excel"/>
        </form>
    </body>
</html>