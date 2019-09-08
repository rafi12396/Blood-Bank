<html>
<head>
	<link rel="stylesheet" type="text/css" href="back.css">
	<title>blood donation</title>
</head>
<body>
<form action ="searchdonor.php" method= "post">
<div class="container">
<header>
   <img src="sidehdr.png" alt="HTML5 Icon" style="float:right;width:100px;height:90px;">
   <h1>BLOOD BANK</h1>
</header>
<div id="nav">  
<nav>
	<ul>
	<li><a href="logout.php">SIGN OUT</a></li>
	<li><a class="active" href="userhome.php">MY HOMEPAGE</a></li>
	<li><a class="active" href="editudetails.php">EDIT PROFILE</a></li>
  <li><a href="bloodbankdetail.php">BLOOD BANK DETAILS</a></li>
  <li><a href="hospitaldetail.php">HOSPITAL DETAILS</a></li>
  <li><a href="changepass.php">CHANGE PASSWORD</a></li>
	</ul>
</nav>
</div>
<article>
	<?php
	include('session.php');
   // connect to mongodb
   if(isset($_POST['sub']))
   {
	   $m = new MongoClient();
	   //echo "Connection to database successfully";
		
	   // select a database
	   $db = $m->blood;
	   //echo "Database mydb selected";
	   $collection = $db->donordetail;
	   $bgr=$_POST["bg"];
	   $city=$_POST["city"];
	   //echo "Collection selected succsessfully";
		$querry=array('bldgrp'=>"$bgr",'city'=>"$city");
	   $cursor = $collection->find($querry);
	   if($cursor->count()==0)
		echo "NO RECORD FOUND";
	echo "<table border=10 cellspacing=1 cellpadding=5 bgcolor=#ffffff style='float:right;'>";
	echo "<tr><th>NAME<th>EMAILID<th>CONTACT<th>BLOODGROUP";
	foreach ($cursor as $document)
		{
			echo "<tr>";

				echo"<td>".$document["uname"];
							echo"<td>".$document["email"];
										echo"<td>".$document["phone"];
													echo"<td>".$document["bldgrp"];

		}
	echo"</table>";
	}
?>
	<table border=20 cellspacing=1 cellpadding=5 bgcolor=#ffffff style="float:right;">

	<CAPTION> <h3> SEARCH FOR DONOR </h3> </caption>
	<tr> <td>BLOOD GROUP <td><select name="bg">
				<option>A+</option>
				<option>A-</option>
				<option>B+</option>
				<option>B-</option>
				<option>AB+</option>
				<option>AB-</option>
				<option>O+</option>
				<option>O-</option>
			</select>
	<tr> <td>CITY <td><select name="city">
				<option selected>PUNE</option>
				<option>MUMBAI</option>
				<option>BANGALORE</option>
				<option>REWA</option>
			</select>
			<tr>  <td>
  	      <td><input type="submit" value="SEARCH" name="sub">  
	</table>
	
</article>

<footer>Copyright © www.bloodbank.com</footer>

</div>

  
</form>
</body>
</html>
