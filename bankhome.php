<html>
<head>
	<link rel="stylesheet" type="text/css" href="back.css">
	<title>blood donation</title>
</head>
<body>
<form action ="bankhome.php" method= "post">
<div class="container">
<header>
   <img src="sidehdr.png" alt="HTML5 Icon" style="float:right;width:100px;height:90px;">
   <h1>BLOOD BANK</h1>
</header>
<div id="nav">  
<nav>
	<ul>
	<li><a href="logout.php">SIGN OUT</a></li>
	<li><a class="active" href="bankupdt.php">EDIT BLOOD DETAILS</a></li>
	</ul>
</nav>
</div>
<article>
	<?php
		include('sessionbank.php');
		$connection= new MongoClient();
		$db= $connection->blood;
		//echo "Connection to database successfully";
		$collection= $db->bankdetail;
		$criteria = array(
				'uname' => $_SESSION['user']
			);
		$cursor = $collection->find($criteria);
		$data  = "<table border=10px align='center' style='color:red;'>";
			foreach($cursor as $document){
				
				$data .= "<tr> <td> NAME:  <td>". $document["bankname"];
				$data .= "<tr> <td> ADDRESS:  <td>". $document["address"];
				$data .= "<tr> <td> EMAIL:  <td>". $document["email"];
				$data .= "<tr> <td> PHONE:  <td>". $document["phone"];
				$data .= "<tr> <td> <table>";
				$data .= "<tr> <th>BLD GRP <th>QTY";
				$data .= "<tr> <td>A+ <td>".$document["bldgrp"]["A+"];
				$data .= "<tr> <td>A- <td>".$document["bldgrp"]["A-"];
				$data .= "<tr> <td>B+ <td>".$document["bldgrp"]["B+"];
				$data .= "<tr> <td>B- <td>".$document["bldgrp"]["B-"];
				$data .= "<tr> <td>AB+ <td>".$document["bldgrp"]["AB+"];
				$data .= "<tr> <td>AB- <td>".$document["bldgrp"]["AB-"];
				$data .= "<tr> <td>O+ <td>".$document["bldgrp"]["O+"];
				$data .= "<tr> <td>O- <td>".$document["bldgrp"]["O-"];
				$data .= "</table><td> ";
				$data .="<br><br><br><br>";
			}
			$data .= "</table>";
			echo $data;
	?>
</article>

<footer>Copyright © www.bloodbank.com</footer>

</div>
</form>
</body>
</html>
