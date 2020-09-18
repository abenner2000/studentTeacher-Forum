<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Home page
		</title>
	</head>
	<?php 
	session_start();

	$servername = "localhost";
	$database = "...";
	$username = "...";
	$password = "...";

	$conn = mysqli_connect($servername, $username, $password, $database);
	$_SESSION['conn'] = $conn;

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	    echo "<a href = 'personalAccount.php?t=true' style= 'text-decoration:none;'>Welcome, " . $_SESSION['username'] . "!</a>";
	    $realuser = $_SESSION['username'];
	    $role = $_SESSION['role'];
	} else {
	    echo "Please log in first to see this page.";
	}

	if (isset($_POST['submit'])){
		$title = $_POST['title'];
		$post = $_POST['post'];
		$sql = "INSERT INTO post_info (title,post,username,role) VALUES ('$title','$post','$realuser','$role');";
		$conn -> query($sql);
	}

	if (isset($_GET['t'])){
		header("Location: http://localhost/studentTeacher/personalAccount.php");
	}

	?>
	<body>
		<form method="post" name = "Login" id="Login" action="homePage.php">
			<br>
				<label for="title" style="text-align: center;"><h2>
					Post Title:</h2>
				</label>
				<input id="title" name="title" style="position: absolute; left: 43%;">
				<br><br>
				<label for="post" style="text-align: center;"><h2>
					What you have to say:</h2>
				</label>
				<input id="post" name="post" style="position:absolute; left: 43%;">
				<br><br>
				<input type="submit" name ="submit" style="margin: 0 auto; position: absolute; left: 47%">
		</form>
		<div>
			<br><br><br><br><br><br>
			<?php

			$count = 0;
			$forcounter = 0;
			while ($count <= 3) {
				$retrieve1 = "SELECT * FROM post_info ORDER BY id DESC LIMIT $count,5;";
				$obtained1 = mysqli_query($conn, $retrieve1);
				$real1 = $obtained1->fetch_assoc();
				echo "<table style='margin: 0 auto; width: 800px; border-style:solid; border-color:black; border-width: 1px;'><tr><th>topic</th><th>Post</th><th>Username</th><th>student/teacher</th><th>ID</th></tr>";
				foreach($real1 as $key => $value){
					$forcounter += 0.2;
					if (is_int($forcounter)){
						echo"<tr>";
					}
					if (($forcounter + 0.4) == 1) {
						echo "<td style='width: 140px; border-width:1px;border-style:solid;border-color:black;'>";
						echo "<a href='homePage.php?first=true'>".$value."</a>";
						echo "</td>";
						$_SESSION['row1'] = $value;
					}
					elseif (($forcounter + 0.4) == 2) {
						echo "<td style='width: 140px; border-width:1px;border-style:solid;border-color:black;'>";
						echo "<a href='homePage.php?second=true'>".$value."</a>";
						echo "</td>";
						$_SESSION['row2'] = $value;
					}
					elseif (($forcounter + 0.4) == 3) {
						echo "<td style='width: 140px; border-width:1px;border-style:solid;border-color:black;'>";
						echo "<a href='homePage.php?third=true'>".$value."</a>";
						echo "</td>";
						$_SESSION['row3'] = $value;
					}
					else{
						echo "<td style='width: 140px; border-width:1px;border-style:solid;border-color:black;'>";
						echo $value;
						echo "</td>";
					}
					if (is_int($forcounter)){
						echo"</tr>";
					}
				$count += 0.2;
				}
				echo "</table><br>";
				if (isset($_GET['first'])) {
					$_SESSION['clickedaccount'] = $_SESSION['row1'];
					header("Location: http://localhost/studentTeacher/accountPage.php");
				}
				elseif (isset($_GET['second'])) {
					$_SESSION['clickedaccount'] = $_SESSION['row2'];
					header("Location: http://localhost/studentTeacher/accountPage.php");
				}
				elseif (isset($_GET['third'])) {
					$_SESSION['clickedaccount'] = $_SESSION['row3'];
					header("Location: http://localhost/studentTeacher/accountPage.php");
				}
			}
			?>
		</div>
	</body>
</html>