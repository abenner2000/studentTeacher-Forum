<!DOCTYPE HTML>
<html>
	<head>
		<title>
			<?php 
				session_start();

				$clicked = $_SESSION['clickedaccount'];
				echo "$clicked"."'s account";
			?>
		</title>
	</head>
	<body>
		<?php

			$servername = "localhost";
			$database = "...";
			$username = "...";
			$password = "...";

			$conn = mysqli_connect($servername, $username, $password, $database);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			echo "Direct message "."$clicked".":";
			if (isset($_GET['submit'])) {
				$head = $_GET['Titlemess'];
				$body = $_GET['Bodymess'];
				$input = "INSERT INTO emails_r (contact,header,body) VALUES ('$clicked','$head','$body');";
				$conn -> query($input);
				echo "<script>alert('Email sent!')</script>";
			}
		?>
		<br><br><br><br><br><br>
		<form method = "get" action = "accountPage.php" name = "message">
			<label for="Titlemess">
				Message Title 
			</label><br><br>
			<input name = "Titlemess" id = "Titlemess"><br><br>
			<label for="Bodymess">
				Message Details
			</label><br><br>
			<input type="text" name = "Bodymess" id = "Bodymess" style="width: 400px; height: 150px;"><br><br>
			<input type="submit" name="submit">
		</form>
	</body>
</html>