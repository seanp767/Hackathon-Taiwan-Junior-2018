<?php
if (isset($_POST['submit']) && $_POST['search'] != "") {
	if ($_POST['subject'] != "Show All") {
		$sql = "SELECT * FROM `questiontb` WHERE `question` LIKE '%".$_POST['search']."%' AND `subject` = '".$_POST['subject']."'";
	} else {
		$sql = "SELECT * FROM `questiontb` WHERE `question` LIKE '%".$_POST['search']."%'";
	}
} else if (isset($_POST['submit']) && $_POST['subject']!="Show All") {
	$sql = "SELECT * FROM `questiontb` WHERE `subject` = '".$_POST['subject']."'";
} else {
	$sql = "SELECT * FROM `questiontb`";
}


$db = mysqli_connect("localhost", "root", "", "samplelogindb");

$result = mysqli_query($db, $sql);
?>

<html>
<head>
<title>Ask&Find</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script src="jquery-3.3.1.js"></script>
<script>
function sidebar_toggle() {
	$('.sidebar').fadeToggle();
}
</script>

</head>

<body><font face="Arial">
	<img class="sidebar_btn" src="nav_btn.png" onclick="sidebar_toggle()"/>
	<div class="sidebar">
		<form action="home.php" method="post">
			<input type="submit" value="Go" name="submit" class="form_content go_btn" />
			<br /><br />

			<h4>search:</h4>
			<input type="textbox" class="form_content" name="search" />
			<hr>
			<h4>filter:</h4>
			<!--<h5>school:</h5>
			<ul>
				<li><input type="checkbox" value="Elementary"/> Elementary</li>
				<li><input type="checkbox" value="Middle"/> Middle</li>
				<li><input type="checkbox" value="High"/> High</li>
				<li><input type="checkbox" value="University"/> University</li>
			</ul>-->

			<h5>subject:</h5>
			<ul>
				<li><input type="radio" name="subject" value="Show All" checked="checked" /> Show All</li>
				<li><input type="radio" name="subject" value="General" /> General</li>
				<li><input type="radio" name="subject" value="Social Studies" /> Social Studies</li>
				<li><input type="radio" name="subject" value="Physics" /> Physics</li>
				<li><input type="radio" name="subject" value="Chemistry" /> Chemistry</li>
				<li><input type="radio" name="subject" value="Biology" /> Biology</li>
				<li><input type="radio" name="subject" value="English" /> English</li>
				<li><input type="radio" name="subject" value="Math" /> Math</li>
				<li><input type="radio" name="subject" value="Chinese" /> Chinese</li>
				<li><input type="radio" name="subject" value="abc" /> abc</li>
				<li><input type="radio" name="subject" value="def" /> def</li>
			</ul>

			<h5>status:</h5>
			<ul>
				<li><input type="checkbox" name="unsolvedOnly" value="true" /> Show unsolved only</li>
			</ul>
			<hr>

			<!--<u4>sort by:</u4>
				<select class="form_content" name="sort_by">
				<option value="Date" selected>Date</option>
				<option value="User">User</option>
				<option value="Subject">Subject</option>
				<option value="Title">Title</option>
			</select> -->


		</form>
	</div>

	<div class="container">
	<h1 align="center">Ask & Find</h1> 
	<h2>Recent: </h2>
	<h5 align="right" style="margin-right:25px"><a href="home.php">Show All</a></h5>
	

	<table align="center" border="1">
		<tr><td class="date">Date</td>
			<td class="user">User</td>
			<td class="subject">Subject</td>
			<td class="title">Title</td>
			<td class="solved">Solved</td>
		</tr>
		
		<?php
		while($row = mysqli_fetch_array($result)) {
			$sql_ans = "SELECT COUNT( * ) as 'total' FROM answertb WHERE questionid = '".$row['id']."'";
			$ans = mysqli_query($db, $sql_ans);
			$ans_count = mysqli_fetch_assoc($ans);


			if(isset($_POST['submit']) && isset($_POST['unsolvedOnly']) && $ans_count['total'] != 0){ 
			} else {
				echo "<tr><td>". $row['date']."</td>";
				echo "<td><a href='user_profile.php?username=".$row['username']."'>".$row['username']."</a></td>";
				echo "<td>".$row['subject']."</td>";
				echo "<td><a href='question_threads.php?question_id=".$row['id']."''>".$row['question']."</a></td>";
				if ($ans_count['total'] == 0) echo "<td class='solved'></td>";
				else echo "<td class='solved'>v</td>";
			}
		}
		?>


		<!--<tr>
			<td>07-10-2018</td>
			<td><a href="user_profile.htm">testUser1</a></td>
			<td>General</td>
			<td><a href="question_threads.htm">How does this work?</a></td>
			<td class="solved">v</td>
		</tr>
		<tr>
			<td>07-03-2018</td>
			<td><a href="user_profile.htm">testUser2</a></td>
			<td>Social Studies</td>
			<td><a href="question_threads.htm">How does this work?</a></td>
			<td class="solved">v</td>
			
		</tr>
		<tr>
			<td>06-28-2018</td>
			<td><a href="user_profile.htm">testUser3</a></td>
			<td>Physics</td>
			<td><a href="question_threads.htm">How does this work?</a></td>
			<td class="solved">v</td>
		</tr>-->
	</table>

	</div>
</font>
</body>

</html>