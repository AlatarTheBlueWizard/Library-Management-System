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
$id = $_REQUEST['teacherid'];
$stmt = $db->prepare("DELETE FROM teachers WHERE teacherid = '$id'") or die(mysql_error());
$stmt->execute();
if($stmt) {
	echo "<h2 style='text-align:center;font-family:Helvetica'>Teacher Removed Successfully</h2>
	<br/><br/>";
} else {
	echo "Delete Failed";
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Teacher Removal</title>
		<link rel="stylesheet" type="text/css" href="libary.css"/>
	</head>
	<body>
		<div class="tForm">
			<button class="button" onclick="location.href='teachers.php'" type="button">Back to teachers</button>
		</div>
	</body>
</html>