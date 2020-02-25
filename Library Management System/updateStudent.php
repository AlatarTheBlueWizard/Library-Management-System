<?php
//heroku postgres config URL
$dbUrl = getenv('DATABASE_URL');
$dbOpts = parse_url($dbUrl);
$dbHost = $dbOpts["host"];
$dbPort = $dbOpts["port"];
$dbUser = $dbOpts["user"];
$dbPassword = $dbOpts["pass"];
$dbName = ltrim($dbOpts["path"],'/');
//PDO connection
$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
	//prep statement
	$sql = "INSERT INTO students (firstname, lastname, booktitle, daterented, datedue) VALUES (:firstname, :lastname, :booktitle, :daterented, :datedue)";
	$stmt = $db->prepare($sql);
	//bind params
	$stmt->bindParam(':firstname', $_REQUEST['sFirstName']);
	$stmt->bindParam(':lastname', $_REQUEST['sLastName']);
	$stmt->bindParam(':booktitle', $_REQUEST['sBook']);
	$stmt->bindParam(':daterented', $_REQUEST['sDateOne']);
	$stmt->bindParam(':datedue', $_REQUEST['sDateTwo']);
	//execute prep stmt
	$stmt->execute();
	echo "<h2 style='text-align:center;font-family:Helvetica'>Student Checkout Successfull</h2>
	<br/><br/>";
} catch(PDOException $e) {
	die("ERROR: Could not execute $sql. " .$e->getMessage());
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Student Checkout</title>
		<link rel="stylesheet" type="text/css" href="libary.css"/>
	</head>
	<body>
		<div class="sForm">
			<button class="button" onclick="location.href='students.php'" type="button">Back to students</button>
		</div>
	</body>
</html>