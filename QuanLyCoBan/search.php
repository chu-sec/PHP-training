
<html>
    <head>
        <title>Tìm kiếm người dùng</title>
    </head>
    <body>
        <div align="center">
            <form action="search.php" method="get">
                Tìm kiếm: <input type="text" name="search" />
                <input type="submit" name="ok" value="search" />
            </form>
        </div>

 <?php

        	require 'function.php';
       		//Nếu người dùng submit form thì thực hiện
        	if(isset($_REQUEST['ok'])){
        		//Gán hàm addslashes để chống sql injection
        		$search = addslashes($_GET['search']);

        		//Nếu $search rỗng thì báo người dùng chưa nhập dữ liệu
        		if(empty($search)){
        			echo "Bạn chưa nhập thông tin nào để tìm kiếm";
        		} else {
        			search_user($search);

        		// Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
        		$sql = "select * from users where username like '%$search%'";
         
        		// Thực hiện câu truy vấn
       			$query = mysqli_query($conn, $sql);
         
                // Đếm số đong trả về trong sql.
                $num = mysqli_num_rows($query);
        			// Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
                if ($num > 0 && $search != "") 
                {
                    // Dùng $num để đếm số dòng trả về.
                    echo "$num kết quả với từ khóa <b>$search</b>";
                    echo '<table border="1" cellspacing="0" cellpadding="10">';
		            echo '<tr>
			                <td>id</td>
			                <td>username</td>
			                <td>password</td>
			                <td>email</td>
			                <td>ten</td>
			                <td>sdt</td>
			                <td>avatar</td>
			                <td>role</td>
		            	  </tr>';
 					
                    // Vòng lặp while & mysqli_fetch_assoc dùng để lấy toàn bộ dữ liệu có trong table và trả về dữ liệu ở dạng array.
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo '<tr>';
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['username']}</td>";
                            echo "<td>{$row['password']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['ten']}</td>";
                            echo "<td>{$row['sdt']}</td>";
                            echo "<td>{$row['avatar']}</td>";
                            echo "<td>{$row['role']}</td>";
                        echo '</tr>';
                    }
                    echo '</table>';
                } 
                else {
                    echo "Không thấy kế quả nào!";
                }

        		}
        	}
        	disconnect_database();
        ?>   
    </body>
</html>