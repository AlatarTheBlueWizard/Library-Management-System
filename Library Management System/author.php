<?php
require "connect.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Authors</title>
		<link rel="stylesheet" type="text/css" href="libary.css"/>
	</head>
	<body>
		<div class="aHeader">
			<header>
				<button class="button" onclick="location.href='students.php'" type="button">Students</button>
				<button class="button" onclick="location.href='teachers.php'" type="button">Teachers</button>
				<button class="button" onclick="location.href='author.php'" type="button">Authors</button>
			</header>
		</div>
		<br/>
		<h1 class="aTitle">Author List</h1>
		<br/><br/>
		<form class="aDisplay" method="post" action="">
			<br/>
			<input type="submit" name="displayAuthors" id="displayAuthors" value="Display Authors" class="button"/>
			<br/><br/>
			<?php
			function displayAuthors() {
				$db = get_db();
				//prep statements
				$statement = $db->prepare("SELECT firstname, lastname, bookpublished, publishdate FROM authors");
				$statement->execute();
				echo "<table>
				<tr>
				<th>Firstname</th>
				<th>Lastname</th>
				<th>Book Published</th>
				<th>Publish Date</th>
				</tr>";
				//go through each result and display data in a table
				while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
					echo "<tr>";
					echo "<td>" . $row['firstname'] . "</td>";
					echo "<td>" . $row['lastname'] . "</td>";
					echo "<td>" . $row['bookpublished'] . "</td>";
					echo "<td>" . $row['publishdate'] . "</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
			function hideAuthors() {
				echo "";
			}
			if(array_key_exists('displayAuthors', $_POST))
			{
				displayAuthors();
			}
			if(array_key_exists('hideTable', $_POST))
			{
				hideAuthors();
			}
			?>
			<br/>
			<input type="submit" name="hideTable" id="hideTable" value="Hide Author List" class="button"/>
			<br/><br/>
		</form>
	</body>
</html>