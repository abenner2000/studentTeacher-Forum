<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Log in or Sign up
		</title>
	</head>
	<?php 

	session_start();

	$servername = "localhost";
	$database = "...";
	$username = "...";
	$password = "...";

	$conn = mysqli_connect($servername, $username, $password, $database);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if (isset($_POST['submit'])){
		$password_form = $_POST['pass'];
		$username_form = $_POST['username'];
		$retrieve1 = "SELECT pass FROM s_login_info WHERE userid = '$username_form';";
		$realpassobjresource = mysqli_query($conn, $retrieve1);
		$retrieve2 = "SELECT role FROM s_login_info WHERE userid = '$username_form';";
		$realroleobjresource = mysqli_query($conn, $retrieve2);
		while ($row = $realpassobjresource->fetch_assoc()) {
		    $realpass = $row['pass'];
		    $realrole = $row['role'];
		}
		if ($password_form == $realpass) {
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $username_form;
			$_SESSION['role'] = $realrole;
			header("Location: http://localhost/studentTeacher/homePage.php");
		}
		else {
			echo "<script>alert('Passwords do not match')</script>";
		}
	}

	?>
	<body>
		<a href = "signup.php" style="text-decoration: none;" target = "_blank">
			Sign up
		</a>
		<form method="post" name = "Login" id="Login" action="index.php">
			<br>
			<label for="username" style="text-align: center;"><h2>
				Enter Username:</h2>
			</label>
			<input id="username" name="username" style="margin: 0 auto; position: absolute; left: 43%">
			<br>
			<label for="pass" style="text-align: center;"><h2>
				Password:</h2>
			</label>
			<input type="Password" id="pass" name="pass" style="margin: 0 auto; position: absolute; left: 43%"><br><br>
			<input type="submit" name ="submit" style="margin: 0 auto; position: absolute; left: 47%">
		</form>
	</body>
</html>