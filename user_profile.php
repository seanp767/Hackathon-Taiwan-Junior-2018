<?php
if(!isset($_GET["username"]) ) {
	header('Location: home.php');
}
$db = mysqli_connect("localhost", "root", "", "samplelogindb");
$sql = "SELECT * FROM `newuser` WHERE `username` = '".$_GET["username"]."'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);

$sql_asked = "SELECT COUNT( * ) as 'total' FROM questiontb WHERE username ='".$_GET["username"]."'";
$sql_ansed = "SELECT COUNT( * ) as 'total' FROM answertb WHERE username ='".$_GET["username"]."'";
$asked = mysqli_fetch_assoc(mysqli_query($db, $sql_asked));
$ansed = mysqli_fetch_assoc(mysqli_query($db, $sql_ansed));
?>
<html>
<head>
<title>Ask&Find</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body><font face="Arial">
	<a href="home.php"><img src="back_btn.jpg" class="back_btn"></a>

	<div class="container">
	<h1 align="center">Ask & Find</h1> 
	<h2><?php echo $row['username']; ?></h2>
	<table align="center" class="profile_container">
		<tr><td align="center" colspan="2"><img src="profile_pic.jpg" class="profile"></td></tr>
		<tr>
			<td>Level: </td>
			<td><?php echo $row['qualification'] ?></td>
		</tr>
		<tr>
			<td>School: </td>
			<td><?php echo $row['school'] ?></td>
		</tr>
		<tr>
			<td>Email: </td>
			<td><?php echo $row['email'] ?></td>
		</tr>
		<tr>
			<td>Asked Questions: </td>
			<td><?php echo $asked['total'] ?></td>
		</tr>
		<tr>
			<td>Answered Questions: </td>
			<td><?php echo $ansed['total'] ?></td>
		</tr>
	</table>
	

	</div>
</font>
</body>

</html>