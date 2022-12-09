<?php
    // Biến kết nối toàn cục
    global $conn;
 
    // Hàm kết nối database
    function connect_database() {
        // Gọi tới biến toàn cục $conn
        global $conn;
        $conn = mysqli_connect('localhost', 'root', '', 'mytask');
        if ($conn) {
            mysqli_query($conn, "SET NAMES 'utf8'");
            //Neu ket noi thong cong
            echo "Connected to database!";
            echo "<br/>";
            //Neu khong ket noi thanh cong
        } else {
            echo "Error" .mysqli_connect_error();
        }
    }

    // Hàm ngắt kết nối
    function disconnect_database()
    {
        // Gọi tới biến toàn cục $conn
        global $conn;
         
        // Nếu đã kêt nối thì thực hiện ngắt kết nối
        if ($conn){
            mysqli_close($conn);
        }
    }
     
    // Hàm lấy tất cả nguười dùng
    function get_all_users()
    {
        // Gọi tới biến toàn cục $conn
        global $conn;
         
        // Hàm kết nối
        connect_database();
         
        // Câu truy vấn lấy tất cả sinh viên
        $sql = "select * from users";
         
        // Thực hiện câu truy vấn
        $query = mysqli_query($conn, $sql);
         
        // Mảng chứa kết quả
        $result = array();
         
        // Lặp qua từng record và đưa vào biến kết quả
        if ($query){
            while ($row = mysqli_fetch_assoc($query)){
                $result[] = $row;
            }
        }
         
        // Trả kết quả về
        return $result;
    }

    // Hàm lấy tất cả blog
    function get_all_blogs()
    {
        // Gọi tới biến toàn cục $conn
        global $conn;
         
        // Hàm kết nối
        connect_database();
         
        // Câu truy vấn lấy tất cả sinh viên
        $sql = "select * from blogs";
         
        // Thực hiện câu truy vấn
        $query = mysqli_query($conn, $sql);
         
        // Mảng chứa kết quả
        $result = array();
         
        // Lặp qua từng record và đưa vào biến kết quả
        if ($query){
            while ($row = mysqli_fetch_assoc($query)){
                $result[] = $row;
            }
        }
         
        // Trả kết quả về
        return $result;
    }
     
     // Hàm lấy blog theo ID
    function get_blog($ID)
    {
        // Gọi tới biến toàn cục $conn
        global $conn;
         
        // Hàm kết nối
        connect_database();
         
        // Câu truy vấn lấy tất cả sinh viên
        $sql = "select * from blogs where ID = {$ID}";
         
        // Thực hiện câu truy vấn
        $query = mysqli_query($conn, $sql);
         
        // Mảng chứa kết quả
        $result = array();
         
        // Nếu có kết quả thì đưa vào biến $result
        if (mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            $result = $row;
        }
         
        // Trả kết quả về
        return $result;
    }
     
    // Hàm lấy người dùng theo id
    function get_user($id)
    {
        // Gọi tới biến toàn cục $conn
        global $conn;
         
        // Hàm kết nối
        connect_database();
         
        // Câu truy vấn lấy tất cả sinh viên
        $sql = "select * from users where id = {$id}";
         
        // Thực hiện câu truy vấn
        $query = mysqli_query($conn, $sql);
         
        // Mảng chứa kết quả
        $result = array();
         
        // Nếu có kết quả thì đưa vào biến $result
        if (mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            $result = $row;
        }
         
        // Trả kết quả về
        return $result;
    }
     
    // Hàm thêm người dùng
    function add_user($username, $password, $email, $ten, $sdt)
    {
        // Gọi tới biến toàn cục $conn
        global $conn;
         
        // Hàm kết nối
        connect_database();
         
        // Chống SQL Injection
        $username = addslashes($username);
        $password = addslashes($password);
        $email = addslashes($email);
        $ten = addslashes($ten);
        $sdt = addslashes($sdt);
         
        // Câu truy vấn thêm
        $sql = "
                INSERT INTO users(username, password, email, ten, sdt) VALUES
                ('$username', '$password', '$email', '$ten', '$sdt')
        ";
         
        // Thực hiện câu truy vấn
        $query = mysqli_query($conn, $sql);
         
        return $query;
    }
     
     
    // Hàm sửa người dùng
    function edit_user($id, $email, $ten, $sdt)
    {
        // Gọi tới biến toàn cục $conn
        global $conn;
         
        // Hàm kết nối
        connect_database();
         
        // Chống SQL Injection
        $email = addslashes($email);
        $ten = addslashes($ten);
        $sdt = addslashes($sdt);
         
        // Câu truy sửa
        $sql = " UPDATE users SET email = '$email', ten = '$ten', sdt = '$sdt' WHERE id = $id";
         
        // Thực hiện câu truy vấn
        $query = mysqli_query($conn, $sql);
         
        return $query;
    }
     
     
    // Hàm xóa người dùng
    function delete_user($id)
    {
        // Gọi tới biến toàn cục $conn
        global $conn;
         
        // Hàm kết nối
        connect_database();
         
        // Câu truy sửa
        $sql = "
                DELETE FROM users
                WHERE id = $id
        ";
         
        // Thực hiện câu truy vấn
        $query = mysqli_query($conn, $sql);
         
        return $query;
    }

    // Hàm tìm kiếm người dùng
     function search_user($search)
    {
        // Gọi tới biến toàn cục $conn
        global $conn;
         
        // Hàm kết nối
        connect_database();
         
        // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
        $sql = "select * from users where username like '%$search%'";
         
        // Thực hiện câu truy vấn
        $query = mysqli_query($conn, $sql);
         
        //return $query;
    }

    // Hàm thêm bình luận
    function add_comment($ID, $Name, $Comment)
    {
        // Gọi tới biến toàn cục $conn
        global $conn;
         
        // Hàm kết nối
        connect_database();
         
        // Chống SQL Injection
        $Name = addslashes($Name);
        $Commnet = addslashes($Commnet);
         
        // Câu truy vấn thêm
        $sql = " UPDATE blogs(comment) VALUES () ";
         
        // Thực hiện câu truy vấn
        $query = mysqli_query($conn, $sql);
         
        return $query;
    }
?>