<?php
session_start();

if(isset($_POST['submit'])) {
	$id = $_POST['id'];
	$ans = $_POST['answer'];
	$quesID = $_POST['question_id'];
	$date = date("m-d-Y");
	$uname = $_SESSION['username'];
	$db = mysqli_connect("localhost", "root", "", "samplelogindb");
	echo $id;
	echo $ans;
	echo $quesID;
	echo $date;
	echo $uname;

	$sql = "INSERT INTO `answertb` (`id`, `answer`, `likenum`, `questionid`, `date`, `username`) VALUES ('$id', '$ans', '0', '$quesID', '$date', '$uname')";
	$result = mysqli_query($db, $sql);
	header('location: home.php');
}

if(!isset($_GET["question_id"]) || !is_numeric($_GET["question_id"])) {
	header('Location: home.php');
}

$db = mysqli_connect("localhost", "root", "", "samplelogindb");
$sql = "SELECT * FROM `questiontb` WHERE `id` =".$_GET["question_id"];
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);

$result_getid = mysqli_query($db, "SELECT COUNT( * ) as 'total' FROM `answertb` WHERE `questionid` = '".$_GET["question_id"]."'");
$row_getid = mysqli_fetch_array($result_getid);
?>

<!DOCTYPE html>
<html>
<head>
<title>Anwser Page</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body><font face="Arial">

<div class="container">
	<h2 style="font-size: 30px;">Solve a Question Now:<br>
	 <!--<?php echo $row['question'];?></h2>-->
	<!--<p><?php echo $row['description'];?></p>-->
	<!--<img class="question_pic" src="test.jpg"/>--><br><br>

	<h3>Answer:</h3>
	<form action="answer.php" method="post">
		<input type="hidden" name="id" value="<?php echo $row_getid['total']; ?>" />
		<textarea rows="10" cols="40" name="answer" placeholder="Enter your answer here" style="border:1px solid black"></textarea> <br />
		<input type="hidden" name="question_id" value="<?php echo $_GET["question_id"]; ?>" />
		<input type="submit" name="submit"/>
	</form>
</div>
</font>
</body>
</html>
