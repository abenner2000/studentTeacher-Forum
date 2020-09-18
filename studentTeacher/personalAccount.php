<!DOCTYPE HTML>
<html>
	<head>
		<title>
			<?php 
				session_start();

				$user = $_SESSION['username'];
				echo "$user"."'s page";
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

			$contact = $_SESSION['username'];

			$retrieve1 = "SELECT * FROM emails_r WHERE contact = '$contact';";
			$obtained1 = mysqli_query($conn, $retrieve1);
			$real1 = $obtained1->fetch_assoc();
			if (is_null($real1)){
				echo "Welcome to your page "."$user"."!";
				echo "<br><br><br>";
				echo "You have no mail at the moment. Check later!";
				exit();
			}
			echo "Welcome to your page "."$user"."!";
			echo "<br><br>Here's your mail:";
			echo "<br><br><br><br>";
			echo "<table style='margin: 0 auto; width: 800px; border-style:solid; border-color:black; border-width: 1px;'><tr><th>Contact</th><th>Subject</th><th>Message</th><th>UserID</th></tr>";
			$count = 0.25;
			foreach($real1 as $key => $value){
				echo "<td style='width: 140px; border-width:1px;border-style:solid;border-color:black;'>";
				echo $value;
				echo "</td>";
				if (is_int($count)){
					echo"</tr>";
				}
				$count += 0.25;
			}
			echo "</table>";
		?>
	</body>
</html>