<?php
require("password.php");
session_start();
$badLogin = false;

if(isset($_POST['txtUser']) && isset($_POST['txtPassword']))
{
	$username = $_POST['txtUser'];
	$password = $_POST['txtPassword'];

	require("connect.php");
	$db = get_db();
	$query = 'SELECT password FROM login WHERE username =:username';
	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);
	$result = $statement->execute();
	if($result)
	{
		$row = $statement->fetch();
		$hashedPasswordFromDB = $row['password'];
		if(password_verify($password, $hashedPasswordFromDB))
		{
			$_SESSION['username'] = $username;
			header("Location: students.php");
			die();
		} else {
			$badLogin = true;
		}
	}
} else {
	$badLogin = true;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sign In</title>
		<link rel="stylesheet" type="text/css" href="libary.css"/>
		<script>
			function fieldValidate() {
				var x = document.forms["signInForm"]["txtUser"].value;
				var y = document.forms["signInForm"]["txtPassword"].value;
				if (x == "") {
					alert("Username must be filled out");
					return false;
				}
				if (y == "") {
					alert("Password must be filled out");
					return false;
				}
			}
		</script>
	</head>
	<body>
		<h1 class="signInTitle">Sign In</h1>
		<br/>
		<form name="signInForm" id="signInForm" action="signIn.php" method="post" onsubmit="return fieldValidate()">
			<br/>
			<label for="txtUser">Username: </label>
			<input type="text" id="txtUser" name="txtUser" placeholder="Enter username"/>
			<br/><br/>
			<label for="txtPassword">Password: </label>
			<input type="password" id="txtPassword" name="txtPassword" placeholder="Enter password"/>
			<br/><br/>
			<input type="submit" value="Sign in" name="sSubmit" id="sSubmit" class="button"/>
			<br/><br/>
			<?php
			if(isset($_POST['sSubmit']) && $badLogin == true) {
				echo "Incorrect username or password <br/><br/>";
			}
			?>
		</form>
		<br/><br/>
		<div class="sForm">
			<br/>
			<button class="button" onclick="location.href='signUp.php'" type="button">Create a new account</button>
			<br/><br/>
		</div>
	</body>
</html>