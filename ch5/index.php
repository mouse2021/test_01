<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Guitar Wars - High Scores</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h2>Guitar Wars - High Scores</h2>
	<p>Welcome, Guitar Warrior, do you have what it takes to crack the high score list? If so, just <a href="addscore.php">add your own score</a>.</p>
	<hr />

<?php
	$dbc = mysqli_connect('localhost', 'root', '000000', 'gwdb');
	$query = "SELECT * FROM guitarwars";
	$data = mysqli_query($dbc, $query);

	echo '<table>';
	while ($row = mysqli_fetch_array($data)) { 
		echo '<tr><td class="scoreinfo">';
		echo '<span class="score">' . $row['score'] . '</span><br />';
		echo '<strong>Name:</strong> ' . $row['name'] . '<br />';
		echo '<strong>Date:</strong> ' . $row['date'] . '</td></tr>';
	}
	echo '</table>';

	mysqli_close($dbc);
?>

</body> 
</html>