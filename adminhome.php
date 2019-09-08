<html>
<head>
	<link rel="stylesheet" type="text/css" href="back.css">
	<title>blood donation</title>
	<style>
		.w3-content {
		border:2px solid red;
	  position:absolute;
	  top:50%;
	  left:50%;
	  margin-top:-50px; /* this is half the height of your div*/  
	  margin-left:-100px; /*this is half of width of your div*/
	}
	</style>
</head>
<body>
<form action ="adminhome.php" method= "post">
<div class="container">
<header>
   <img src="sidehdr.png" alt="HTML5 Icon" style="float:right;width:100px;height:90px;">
   <h1>BLOOD BANK</h1>
</header>
<div id="nav">  
<nav>
	<ul>
	<li><a href="logout.php">SIGN OUT</a></li>
	<li><a class="active" href="bldbankreg.php">ADD BLOOD BANK</a></li>
  <li><a href="delbldbank.php">DELETE BLOOD BANK</a></li>
  <li><a href="hospitalreg.php">ADD HOSPITAL</a></li>
  <li><a href="delhospital.php">DELETE HOSPITAL</a></li>
	</ul>
</nav>
</div>
<article>
	<div class="w3-content w3-section" style="max-width:500px;float:right;">
		<img class="mySlides w3-animate-top" src="imgsld1.jpg" style="width:100%">
		<img class="mySlides w3-animate-bottom" src="imgsld2.jpg" style="width:100%">
		<img class="mySlides w3-animate-top" src="imgsld3.jpg" style="width:100%">
		<img class="mySlides w3-animate-bottom" src="imgsld4.jpg" style="width:100%">
	</div>
	<script>
		var myIndex = 0;
		carousel();

		function carousel() {
			var i;
			var x = document.getElementsByClassName("mySlides");
			for (i = 0; i < x.length; i++) {
			  x[i].style.display = "none";
			}
			myIndex++;
			if (myIndex > x.length) {myIndex = 1}
			x[myIndex-1].style.display = "block";
			setTimeout(carousel, 2500);
		}
	</script>
</article>

<footer>Copyright © www.bloodbank.com</footer>

</div>
</form>
</body>
</html>

<?php
	include('session.php');
?>