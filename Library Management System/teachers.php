<?php
require "connect.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Teachers</title>
		<link rel="stylesheet" type="text/css" href="libary.css"/>
		<script>
			function valdiateFields() {
				var x = document.forms["teacherForm"]["tFirstName"].value;
				var y = document.forms["teacherForm"]["tLastName"].value;
				var z = document.forms["teacherForm"]["tBook"].value;
				var date = document.forms["teacherForm"]["tDateOne"].value;
				var date_two = document.forms["teacherForm"]["tDateTwo"].value;

				if(x == "") {
					alert("First name must be filled out");
					return false;
				}

				if(y == "") {
					alert("Last name must be filled out");
					return false;
				}

				if(z == "") {
					alert("Book title must be filled out");
					return false;
				}

				if(date == "") {
					alert("Date must be filled out");
					return false;
				}

				if(date_two == "") {
					alert("Date must be filled out");
					return false;
				}
			}
		</script>
	</head>
	<body>
		<div class="tHeader">
			<header>
				<button class="button" onclick="location.href='students.php'" type="button">Students</button>
				<button class="button" onclick="location.href='teachers.php'" type="button">Teachers</button>
				<button class="button" onclick="location.href='author.php'" type="button">Authors</button>
			</header>
		</div>
		<br/>
		<h1 class="tTitle">Teacher List</h1>
		<br/><br/>
		<div class="tForm">
			<form action="updateTeacher.php" method="post" name="teacherForm" onsubmit="return valdiateFields()">
				<br/>
				<label>Enter first name: <input type="text" id="tFirstName" name="tFirstName"/></label><br/><br/>
				<label>Enter last name: <input type="text" id="tLastName" name="tLastName"/></label><br/><br/>
				<label>Enter book (title): <input type="text" id="tBook" name="tBook"/></label><br/><br/>
				<div id="txtHint">
					<h2>Book List</h2>
					<?php
					$db = get_db();
					//prep statements
					$statement = $db->prepare("SELECT title, publishdate FROM books");
					$statement->execute();
					echo "<table>
					<tr>
					<th>Book Title</th>
					<th>Publish Date</th>
					</tr>";
					//go through each result and display data in a table
					while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
						echo "<tr>";
						echo "<td>" . $row['title'] . "</td>";
						echo "<td>" . $row['publishdate'] . "</td>";
						echo "</tr>";
					}
					echo "</table>";
					?>
				</div>
				<br/><br/>
				<label>Dates to rent: <input type="text" name="tDateOne" id="tDateOne" placeholder="YYYY-MM-DD"/>
				to </label>
				<input type="text" name="tDateTwo" id="tDateTwo" placeholder="YYYY-MM-DD"/>
				<br/><br/>
				<input class="button" type="submit" id="tSubmit" name="tSubmit" value="Checkout"/>
				<br/><br/>
			</form>
		</div>
		<br/><br/>
		<form class="tDisplay" method="post" action="">
			<br/>
			<h2>Teacher's who have books issued</h2>
			<br/><br/>
			<?php
			$db = get_db();
			//prep statements
			$statement = $db->prepare("SELECT teacherid, firstname, lastname, booktitle, daterented, datedue FROM teachers");
			$statement->execute();
			echo "<table>
			<tr>
			<th>Firstname</th>
			<th>Lastname</th>
			<th>Book Title</th>
			<th>Date Rented</th>
			<th>Date Due</th>
			<th>Book Returns</th>
			</tr>";
			//go through each result and display data in a table
			while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr>";
				echo "<td>" . $row['firstname'] . "</td>";
				echo "<td>" . $row['lastname'] . "</td>";
				echo "<td>" . $row['booktitle'] . "</td>";
				echo "<td>" . $row['daterented'] . "</td>";
				echo "<td>" . $row['datedue'] . "</td>";
				echo '<td><button class="button"><a href="deleteTeacher.php?teacherid='.$row['teacherid'].'">Remove Teacher</a></button></td>';
				echo "</tr>";
			}
			echo "</table>";
			?>
			<br/><br/>
		</form>
		<br/>
		<form action="signOut.php" class="lOutForm" method="post">
			<input type="submit" class="button" value="Logout"/>
		</form>
	</body>
</html>