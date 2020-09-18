<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Sign up
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
		$email = $_POST['email'];
		$password_form = $_POST['pass'];
		$cpass = $_POST['cpass'];
		$username_form = $_POST['username'];
		$role = $_POST['role'];
		if ($password_form != $cpass){
			echo "<script>alert('Please match password')</script>";
		}
		else {
			$sql = "INSERT INTO s_login_info (email,pass,userid,role) VALUES ('$email','$password_form','$username_form','$role')";
			if ($conn -> query($sql) === TRUE) {
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $username_form;
			$_SESSION['role'] = $role;
			header("Location: http://localhost/studentTeacher/homePage.php");
			}
			else {
			echo "<script>alert('failed connection')</script>";
			}
		}
	}

	?>
	<body>
		<form method="post" name = "Login" id="Login" action="signup.php">
			<br>
			<label for="email" style="text-align: center;"><h2>
				Email:</h2>
			</label>
				<input type="email" id="email" name="email" style="margin: 0 auto; position: absolute; left: 43%"><br>
				<label for="pass" style="text-align: center;"><h2>
					Password:</h2>
				</label>
				<input type="Password" id="pass" name="pass" style="margin: 0 auto; position: absolute; left: 43%"><br>
				<label for="cpass" style="text-align: center;"><h2>
					Confirm Password:</h2>
				</label>
				<input type="Password" id="cpass" name="cpass" style="margin: 0 auto; position: absolute; left: 43%">
				<br>
				<label for="username" style="text-align: center;"><h2>
					Enter Username:</h2>
				</label>
				<input id="username" name="username" style="margin: 0 auto; position: absolute; left: 43%">
				<br><br>
				<label for="student" style="margin: 0 auto; position: absolute; left: 45%">
					Student
				</label>
				<input type = "radio" id="student" name="role" value = "student" style="margin: 0 auto; position: absolute; left: 52%">
				<br>
				<label for="teacher" style="margin: 0 auto; position: absolute; left: 45%">
					Teacher
				</label>
				<input type = "radio" id="teacher" name="role" value="teacher" style="margin: 0 auto; position: absolute; left: 52%">
				<br><br>
				<input type="submit" name ="submit" style="margin: 0; position: absolute; left: 47%">
		</form>
	</body>
	<script>
	</script>
	<noscript>
		Your computer does not run JavaScript
	</noscript>
</html>