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
<html class="nojs html css_verticalspacer" lang="en-US">
 <head>

  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="generator" content="2018.1.0.386"/>
  
  <script type="text/javascript">
   // Update the 'nojs'/'js' class on the html node
document.documentElement.className = document.documentElement.className.replace(/\bnojs\b/g, 'js');

// Check that all required assets are uploaded and up-to-date
if(typeof Muse == "undefined") window.Muse = {}; window.Muse.assets = {"required":["museutils.js", "museconfig.js", "jquery.watch.js", "require.js", "solve.css"], "outOfDate":[]};
</script>
  
  <title>Solve</title>
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/site_global.css?crc=4275521114"/>
  <link rel="stylesheet" type="text/css" href="css/master_b_master.css?crc=3887285136"/>
  <link rel="stylesheet" type="text/css" href="css/solve.css?crc=4019065674" id="pagesheet"/>
    <!--HTML Widget code-->
  
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

<link rel="stylesheet" type="text/css" href="styles.css" />
</style>

 </head>
 <body>

  <div class="clearfix" id="page"><!-- group -->
   <div class="clearfix grpelem" id="ppu312-4"><!-- column -->
    <div class="clearfix colelem" id="pu312-4"><!-- group -->
     <div class="clearfix grpelem" id="u312-4"><!-- content -->
      <p>Solved</p>
     </div>
     <a class="nonblock nontext rounded-corners clearfix grpelem" id="u325-4" href="home.html"><!-- content --><p>Home</p></a>
    </div>
    <div class="colelem" id="u2004"><!-- custom html -->
     <form action="home.php" method="post">
			<input type="submit" value="Go" name="submit" class="form_content go_btn" />
			<br /><br />

			<h4>search:</h4>
			<input type="textbox" class="form_content" name="search" />
			<hr>
			<h4>filter:</h4>
		
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

			

		</form>


    </div>
   </div>
   <div class="clearfix grpelem" id="ppu341-4"><!-- column -->
    <div class="clearfix colelem" id="pu341-4"><!-- group -->
     <a class="nonblock nontext rounded-corners clearfix grpelem" id="u341-4" href="ask.html"><!-- content --><p>Ask</p></a>
     <a class="nonblock nontext rounded-corners clearfix grpelem" id="u2008-4" href="ask.html"><!-- content --><p>Your Questions</p></a>
     <div class="size_fixed grpelem" id="u330"><!-- custom html -->
      
            
     </div>
    </div>


    <div class="colelem" id="u2064"><!-- custom html -->
<div class="container" style="font-family: Arial">
	<h2 style="font-size: 30px;">Solve a Question Now:<br><br>
	 <?php echo $row['question'];?></h2>
	<p><?php echo $row['description'];?></p>
	<img class="question_pic" src="test.jpg"/><br><br>

	<h3>Answer:</h3>
	<form action="answer.php" method="post">
		<input type="hidden" name="id" value="<?php echo $row_getid['total']; ?>" />
		<textarea rows="10" cols="40" name="answer" placeholder="Enter your answer here" style="border:1px solid black"></textarea> <br><br>
		<input type="hidden" name="question_id" value="<?php echo $_GET["question_id"]; ?>" />
		<input type="submit" name="submit"/>
	</form>
</div>

</body>
</html>
    </div>


   <a class="nonblock nontext clip_frame grpelem" id="u420" href="user_profile.php"><!-- image --><img class="block" id="u420_img" src="images/pasted%20image%20640x64059x59.jpg?crc=3781660648" alt="" width="59" height="59"/></a>
   <div class="verticalspacer" data-offset-top="1198" data-content-above-spacer="1198" data-content-below-spacer="0"></div>
  </div>
  <!-- Other scripts -->
  <script type="text/javascript">
   // Decide whether to suppress missing file error or not based on preference setting
var suppressMissingFileError = false
</script>
  <script type="text/javascript">
   window.Muse.assets.check=function(c){if(!window.Muse.assets.checked){window.Muse.assets.checked=!0;var b={},d=function(a,b){if(window.getComputedStyle){var c=window.getComputedStyle(a,null);return c&&c.getPropertyValue(b)||c&&c[b]||""}if(document.documentElement.currentStyle)return(c=a.currentStyle)&&c[b]||a.style&&a.style[b]||"";return""},a=function(a){if(a.match(/^rgb/))return a=a.replace(/\s+/g,"").match(/([\d\,]+)/gi)[0].split(","),(parseInt(a[0])<<16)+(parseInt(a[1])<<8)+parseInt(a[2]);if(a.match(/^\#/))return parseInt(a.substr(1),
16);return 0},f=function(f){for(var g=document.getElementsByTagName("link"),j=0;j<g.length;j++)if("text/css"==g[j].type){var l=(g[j].href||"").match(/\/?css\/([\w\-]+\.css)\?crc=(\d+)/);if(!l||!l[1]||!l[2])break;b[l[1]]=l[2]}g=document.createElement("div");g.className="version";g.style.cssText="display:none; width:1px; height:1px;";document.getElementsByTagName("body")[0].appendChild(g);for(j=0;j<Muse.assets.required.length;){var l=Muse.assets.required[j],k=l.match(/([\w\-\.]+)\.(\w+)$/),i=k&&k[1]?
k[1]:null,k=k&&k[2]?k[2]:null;switch(k.toLowerCase()){case "css":i=i.replace(/\W/gi,"_").replace(/^([^a-z])/gi,"_$1");g.className+=" "+i;i=a(d(g,"color"));k=a(d(g,"backgroundColor"));i!=0||k!=0?(Muse.assets.required.splice(j,1),"undefined"!=typeof b[l]&&(i!=b[l]>>>24||k!=(b[l]&16777215))&&Muse.assets.outOfDate.push(l)):j++;g.className="version";break;case "js":j++;break;default:throw Error("Unsupported file type: "+k);}}c?c().jquery!="1.8.3"&&Muse.assets.outOfDate.push("jquery-1.8.3.min.js"):Muse.assets.required.push("jquery-1.8.3.min.js");
g.parentNode.removeChild(g);if(Muse.assets.outOfDate.length||Muse.assets.required.length)g="Some files on the server may be missing or incorrect. Clear browser cache and try again. If the problem persists please contact website author.",f&&Muse.assets.outOfDate.length&&(g+="\nOut of date: "+Muse.assets.outOfDate.join(",")),f&&Muse.assets.required.length&&(g+="\nMissing: "+Muse.assets.required.join(",")),suppressMissingFileError?(g+="\nUse SuppressMissingFileError key in AppPrefs.xml to show missing file error pop up.",console.log(g)):alert(g)};location&&location.search&&location.search.match&&location.search.match(/muse_debug/gi)?
setTimeout(function(){f(!0)},5E3):f()}};
var muse_init=function(){require.config({baseUrl:""});require(["jquery","museutils","whatinput","jquery.watch"],function(c){var $ = c;$(document).ready(function(){try{
window.Muse.assets.check($);/* body */
Muse.Utils.transformMarkupToFixBrowserProblemsPreInit();/* body */
Muse.Utils.prepHyperlinks(true);/* body */
Muse.Utils.makeButtonsVisibleAfterSettingMinWidth();/* body */
Muse.Utils.fullPage('#page');/* 100% height page */
Muse.Utils.showWidgetsWhenReady();/* body */
Muse.Utils.transformMarkupToFixBrowserProblems();/* body */
}catch(b){if(b&&"function"==typeof b.notify?b.notify():Muse.Assert.fail("Error calling selector function: "+b),false)throw b;}})})};

</script>
  <!-- RequireJS script -->
  <script src="scripts/require.js?crc=7928878" type="text/javascript" async data-main="scripts/museconfig.js?crc=310584261" onload="if (requirejs) requirejs.onError = function(requireType, requireModule) { if (requireType && requireType.toString && requireType.toString().indexOf && 0 <= requireType.toString().indexOf('#scripterror')) window.Muse.assets.check(); }" onerror="window.Muse.assets.check();"></script>
   </body>
</html>
