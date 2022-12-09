
<?php 
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "mytask";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	//Kiem tra xem co ket noi duoc den database hay khong
	if ($conn) {
		mysqli_query($conn, "SET NAMES 'utf8'");
		//Neu ket noi thong cong
		echo "Connected to database!";
		echo "<br/>";
	//Neu khong ket noi thanh cong
	} else {
		echo "Error" .mysqli_connect_error();
	}

	// $sql1 = "SELECT * FROM users";
	// $sql2 = "SELECT * FROM blogs";

	// $result1 = mysqli_query($conn, $sql1);
	// $result2 = mysqli_query($conn, $sql2);

	// //Kiem tra xem bang can xem co du lieu hay khong
	// if(mysqli_num_rows($result2) > 0) { 
	// 	//Neu bang do co du lieu thi in ra du lieu
	// 	while($row = mysqli_fetch_assoc($result2)){
	// 		var_dump($row);
	// 	}
	// //Neu khong co du lieu thi in ra thong bao	
	// } else {
	// 	echo "Database null!";
	// }
	mysqli_close($conn);
?>
