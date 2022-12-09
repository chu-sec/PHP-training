<?php
require 'function.php';
$blogs = get_all_blogs();
disconnect_database();
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>Danh sách bài viết</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Danh sách bài viết</h1>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>ID</td>
                <td>title</td>
                <td>content</td>
                <td>comment</td>
                <td>user_id</td>
            </tr>
            <?php foreach ($blogs as $item) { ?>
            <tr>
                <td><?php echo $item['ID']; ?></td>
                <td><?php echo $item['title']; ?></td>
                <td><?php echo $item['content']; ?></td>
                <td><?php echo $item['comment']; ?></td>
                <td><?php echo $item['user_id']; ?></td>
                <td>
                    <form method="post" action="comment.php">
                        <input onclick="window.location = 'comment.php?id=<?php echo $item['ID']; ?>'" type="button" value="Bình luận"/>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>