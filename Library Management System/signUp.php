<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sign Up</title>
		<link rel="stylesheet" type="text/css" href="libary.css"/>
		<script>
			function fieldValidate() {
				var x = document.forms["signUpForm"]["txtUser"].value;
				var y = document.forms["signUpForm"]["txtPassword"].value;
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
		<h1 class="signUpTitle">Sign Up For an Admin Account</h1>
		<br/><br/>
		<form id="signUpForm" action="createAccount.php" method="post" onsubmit="fieldValidate()">
			<br/>
			<label for="txtUser">Username: </label>
			<input type="text" id="txtUser" name="txtUser" placeholder="Enter username"/>
			<br/><br/>
			<label for="txtPassword">Password: </label>
			<input type="password" id="txtPassword" name="txtPassword" placeholder="Enter Password"/>
			<br/><br/>
			<input type="submit" value="Create Account" class="button"/>
			<br/><br/>
		</form>
	</body>
</html>