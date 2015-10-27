<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Make Me Elvis - Add Email</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
	<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
	<p>Enter your first name, last name, and email to be added to the <strong>Make Me Elvis</strong> mailing list.</p>

<?php
	if (isset($_POST['submit'])) { // submit ���� �ִ°�?
		$first_name = $_POST['firstname']; // if �� �ȿ� ������ �����ߴٰ�
		$last_name = $_POST['lastname']; // if �� ���������� �Ҹ�Ǵ°� �ƴѵ��ϴ�
		$email = $_POST['email'];
		$output_form = 'no';

		if (empty($first_name) || empty($last_name) || empty($email)) {
			echo 'Please fill out all of the email information.<br />';
			$output_form = 'yes';
		}
	} else {
		$output_form = 'yes';
	}
	if ($output_form == 'no') { // submit ���� �ְ� ��ȿ�� �����͸� ���� ��� ������ ����
		$dbc = mysqli_connect('localhost', 'root', '000000', 'elvis_store')
			or die('Error connecting to MySQL server.');
		$query =	"INSERT INTO email_list (first_name, last_name, email) ".
					"VALUES ('$first_name', '$last_name', '$email')";
		mysqli_query($dbc, $query)
			or die ('Data not inserted.');

		echo 'Customer added.';
		mysqli_close($dbc);
	} else if ($output_form == 'yes') { // submit ���� ���ų� ��ȿ�� �����͸� ���� ���� ��� �� ����
?>

	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="firstname">First name:</label>
		<input type="text" id="firstname" name="firstname" value="<?php echo $first_name; ?>" /><br />
		
		<label for="lastname">Last name:</label>
		<input type="text" id="lastname" name="lastname" value="<?php echo $last_name; ?>" /><br />
		
		<label for="email">Email:</label>
		<input type="text" id="email" name="email" value="<?php echo $email; ?>" /><br />
		
		<input type="submit" name="submit" value="Submit" />
	</form>

<?php
	}
?>

</body>
</html>
