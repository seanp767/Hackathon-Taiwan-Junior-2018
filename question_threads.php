<?php
$currUser = "this is me2";

if(!isset($_GET["question_id"]) ) {
	header('Location: home.php');
}
$db = mysqli_connect("localhost", "root", "", "samplelogindb");
if (isset($_GET['add_like']) && isset($_GET['minus_like'])){
	$quesID = $_GET['question_id'];
	$ansID = ($_GET['add_like'] != "-1")? $_GET['add_like'] : $_GET['minus_like'];
	if ($_GET['add_like'] != "-1") {
		$sql_update_like = "INSERT INTO `likes` (`question_id`, `answer_id`, `username`) VALUES ('$quesID', '$ansID', '$currUser')";
	} else {
		$sql_update_like = "DELETE FROM `likes` WHERE `answer_id` = '$ansID' AND `question_id` = '$quesID' AND `username` = '$currUser'";
	}
	mysqli_query($db, $sql_update_like);

	/*$sql_update_num = "UPDATE member_profile 
    SET points = points + 1
    WHERE user_id = ";*/

}


$sql = "SELECT * FROM `questiontb` WHERE `id` =".$_GET["question_id"];
$sql_ans = "SELECT * FROM `answertb` WHERE `questionid` =".$_GET["question_id"]." ORDER BY `likenum` DESC";
$sql_like = "SELECT * FROM `likes` WHERE `question_id` = ".$_GET["question_id"]." AND `username` = '".$currUser."'";
$result = mysqli_query($db, $sql);
$result_ans = mysqli_query($db, $sql_ans);
$result_like = mysqli_query($db, $sql_like);
$row = mysqli_fetch_array($result);


	$storeArray = Array();
	while ($row_like = mysqli_fetch_array($result_like)) {
	    $storeArray[] =  $row_like['answer_id']; 
	}
?>
<?php

//"<script type="text/javascript">alert('".$_SESSION['username']."')</script>";
if(isset($_POST['urques'])){
$sql = "SELECT * FROM `questiontb` WHERE `username` = '".$_SESSION['username']."'";
}else if (isset($_POST['submit']) && $_POST['search'] != "") {
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
<title>Question Thread</title>

<script src="jquery-3.3.1.js"></script>
  <script type="text/javascript"> 
   // Update the 'nojs'/'js' class on the html node 
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js'); 

// Check that all required assets are uploaded and up-to-date 
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["museutils.js", "museconfig.js", "jquery.watch.js", "require.js", "home.css"], "outOfDate":[]}; 
</script> 
   
  <title>Home</title> 
  <!-- CSS --> 
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=4275521114"/> 
  <link rel="stylesheet" type="text/css" href="css/master_b_master.css?crc=3887285136"/> 
  <link rel="stylesheet" type="text/css" href="css/home.css?crc=292061251" id="pagesheet"/> 
    <!--HTML Widget code--> 
<script>
function like(id) {
	liked = document.getElementById("liked" + id);
	obj = document.getElementById("td" + id);
	like_act = $("#like_action");
	if (liked.innerText != "liked") {
		document.getElementById("add").value=id;
	} else {
		document.getElementById("minus").value=id;
	}
	like_action.submit();
		/*num = parseInt(obj.innerText) + 1;
		obj.innerText = num;
		liked.innerText = "liked";
		obj.classList.add("active");
	} else {
		num = parseInt(obj.innerText) - 1;
		obj.innerText = num;
		liked.innerText = "";
		obj.classList.remove("active");*/
}
</script>


<style> 
a { 
       transition:all 0.3s ease; 
 -webkit-transition: all 0.3s ease; 
 -moz-transition: all 0.3s ease; 
 -o-transition: all 0.3s ease; 
} 

.clip_frame, .Container, .ContainerGroup, .verticalspacer, #preloader,{ 
transition:none !important; 
-webkit-transition:none !important; 
-moz-transition:none !important; 
-o-transition:none !important; 
} 

.SlideShowContentPanel *{ 
transition:none !important; 
-webkit-transition:none !important; 
-moz-transition:none !important; 
-o-transition:none !important; 
} 

.ContainerGroup, .wp-panel, wp-panel-active{ 
transition:none !important; 
-webkit-transition:none !important; 
-moz-transition:none !important; 
-o-transition:none !important; 
} 

.js div#preloader{ 
transition:none !important; 
-webkit-transition:none !important; 
-moz-transition:none !important; 
-o-transition:none !important; 
} 
div.container { 
 margin:20 auto; 
 width:80%; 
} 
div.t-container { 
 margin: 20px auto; 
 width:70%; 
} 
div.sidebar { 
 width: 18%; 
 height: 100%; 
 position: absolute; 
 display: none; 
 top: 0; 
 right: 0; 
 background-color: rgb(50, 50, 50); 
 color: white; 
 padding: 15px; 
} 

table { 
 border: 1px solid; 
 border-collapse: collapse; 
} 
table.thread { 
 width: 100%; 
} 
table.profile_container { 
 width: 80%; 
} 

td { 
 padding: 5px; 
 vertical-align: center; 
} 

td.solved { 
 text-align: center; 
 width: 50px !important; 
} 
td.date { 
 width: 90px !important; 
} 
td.user { 
 width: 90px !important; 
} 
td.title { 
 width: 60%; 
} 
td.likes { 
 width: 30px; 
 font-size: 18px; 
} 
td.active { 
 color: rgb(0, 10, 200); 
} 
td.like_btn_container { 
 width: 20px; 
} 
td.liked { 
 width: 20px; 
 font-size: 14px; 
 color:rgb(100, 100, 100); 
} 

img.like_btn { 
 width:20px; 
 cursor: pointer; 
} 
img.back_btn { 
 width:60px; 
 position: absolute; 
 cursor: pointer; 
} 
img.profile { 
 width:200px; 
} 
img.sidebar_btn { 
 width:35px; 
 position: absolute; 
 top: 0; 
 right: 0; 
 z-index:2; 
 cursor: pointer; 
} 
img.question_pic, img.thread_pic { 
    display: block; 
    margin-left: auto; 
    margin-right: auto; 
} 

.form_content { 
 width: 200px; 
 font-size: 16px; 
 height: 18px; 
} 

input.go_btn { 
 width: 170px !important; 
} 

ul { 
 list-style: none; 
} 
</style> 


</head>

<body>
	<div class="clearfix" id="page"><!-- group --> 
   <div class="clearfix grpelem" id="ppu312-4"><!-- column --> 
    <div class="clearfix colelem" id="pu312-4"><!-- group --> 
     <div class="clearfix grpelem" id="u312-4"><!-- content --> 
      <p>Solved</p> 
     </div> 
     <a class="nonblock nontext MuseLinkActive rounded-corners clearfix grpelem" id="u325-4" href="home.php"><!-- content --><p>Home</p></a> 
     <a class="nonblock nontext rounded-corners clearfix grpelem" id="u341-4" href="ask.php"><!-- content --><p>Ask</p></a> 
    </div> 
    <div class="clearfix colelem" id="pu2004"><!-- group --> 
     <div class="grpelem" id="u2004">
      <form action="home.php" method="post" style="position: relative; left:500px; bottom:45px; font-family: Palatino; color:gray; font-size: 26px"><input type="submit" name="urques" value="Your Questions"></form><!-- custom html --> 
  </div>
</div>
</div>
</div>

	
	<font face="Arial">
	<a href="home.php"><img src="back_btn.jpg" class="back_btn"></a>
	<div class="container">
	
	<form action="answer.php"><input type="hidden" name="question_id" value="<?php echo $_GET['question_id'];?>" />
		<input type="submit" value="Answer it!" style="background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    position: relative;
    top:20px;"/></form>
	<h2>Question: <?php echo $row['question'];?></h2>
	<p><?php echo $row['description'];?></p>
	<img class="question_pic" src="test.jpg"/>
	</div>

	<?php
	$cnt = 1;
	while ($ans_row = mysqli_fetch_array($result_ans)) {
		$sql_like_num = "SELECT COUNT( * ) as 'total' FROM likes WHERE question_id = '".$_GET["question_id"]."' AND answer_id = '".$ans_row['id']."' ";
		$like_num = mysqli_fetch_assoc(mysqli_query($db, $sql_like_num));

		echo "
	<div class='t-container'>
		<table class='thread'>
			<tr>
				<td><font size='5'>";
		if ($cnt == 1) echo "Best Answer";
		else echo "Answer #".$cnt;
		echo ": by <a href='user_profile.php?username=".$ans_row['username']."'>".$ans_row['username']."</a></font></td>";
		echo "<td align='right' class='liked' id='liked".$ans_row['id']."'>";
		if (in_array($ans_row['id'], $storeArray)) echo "liked";
		echo "</td>
				<td class='like_btn_container' align='right'><img src='like_btn.png' class='like_btn' onclick='like(this.id)' id='".$ans_row['id']."'></td>
				<td class='likes ";
		if (in_array($ans_row['id'], $storeArray)) echo "active";
		echo "' id='td".$ans_row['id']."'> ".$like_num['total']."</td>
			</tr>";
			echo "<tr>
				<td colspan='4'>";
			echo $ans_row['answer'];

			echo "<img class='thread_pic' src='test.jpg' />
				</td>
			</tr>
		</table>
	</div>";


		$cnt++;

		mysqli_query($db ,"UPDATE `answertb` SET `likenum`= '".$like_num['total']."' WHERE `questionid` = '".$ans_row['questionid']."' AND `id` = '".$ans_row['id']."'");

	}
	?>



<!--	<div class="t-container">
		<table class="thread">
			<tr>
				<td><font size="5">Best Answer: </font></td>
				<td align="right" class="liked" id="liked1">liked</td>
				<td class="like_btn_container" align="right"><img src="like_btn.png" class="like_btn" onclick="like(this.id)" id="1"></td>
				<td class="likes active" id="td1"> 23</td>
			</tr>
			<tr>
				<td colspan="4">
					This is the inside
					<img class="thread_pic" src="test.jpg" />
				</td>
			</tr>
		</table>
	</div>

	<div class="t-container">
		<table class="thread">
			<tr>
				<td><font size="5">Answer #2: </font></td>
				<td align="right" class="liked" id="liked2"></td>
				<td class="like_btn_container" align="right"><img src="like_btn.png" class="like_btn" onclick="like(this.id)" id="2"></td>
				<td class="likes" id="td2"> 20</td>
			</tr>
			<tr>
				<td colspan="4">
					This is the inside
				</td>
			</tr>
		</table>
	</div>

	<div class="t-container">
		<table class="thread">
			<tr>
				<td><font size="5">Answer #3: </font></td>
				<td align="right" class="liked" id="liked3"></td>
				<td class="like_btn_container" align="right"><img src="like_btn.png" class="like_btn" onclick="like(this.id)" id="3"></td>
				<td class="likes" id="td3"> 5</td>
			</tr>
			<tr>
				<td colspan="4">
					This is the inside
					<img class="thread_pic" src="test.jpg" />
				</td>
			</tr>
		</table>
	</div>-->
</font>



<form action="question_threads.php" method="get" name="like_action" id="like_action">
	<input type="hidden" name="question_id" value="<?php echo $_GET["question_id"]; ?>" />
	<input type="hidden" name="add_like" id="add" value="-1" />
	<input type="hidden" name="minus_like" id="minus" value="-1" />
</form>

</body>

</html>