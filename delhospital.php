<html>
<head>
	<link rel="stylesheet" type="text/css" href="back.css">
	<title>blood donation</title>
</head>
<body>
<form action ="delhospital.php" method= "post">
<div class="container">
<header>
   <img src="sidehdr.png" alt="HTML5 Icon" style="float:right;width:100px;height:90px;">
   <h1>BLOOD BANK</h1>
</header>
<div id="nav">  
<nav>
	<ul>
	<li><a href="logout.php">SIGN OUT</a></li>
	<li><a href="adminhome.php">MY HOMEPAGE</a></li>
	<li><a class="active" href="bldbankreg.php">ADD BLOOD BANK</a></li>
	<li><a href="delbldbank.php">DELETE BLOOD BANK</a></li>
  <li><a href="hospitalreg.php">ADD HOSPITAL</a></li>
	</ul>
</nav>
</div>
<article>
	<?php
		include('session.php');
		$connection= new MongoClient();
		$db= $connection->blood;
		//echo "Connection to database successfully";
		$collection= $db->hospitaldetail;
			$data  = "<table border=10px align='center' style='color:red;'>";
			$data .= "<thead>";
			$data .= "<tr>";
			$data .= "<th>HOSPITAL</th>";
			$data .= "<th>DELETE</th>";
			$data .= "</tr>";
			$data .= "</thead>";
			$data .= "<tbody>";
			$cursor = $collection->find();
			foreach($cursor as $document){
				$data .= "<tr>";
				$data .= "<td>" . $document["hospname"] . "</td>";
				$data .= "<td><input type='checkbox' name='hospnm[]' value='".$document["hospname"]."'></td>";
				$data .= "</tr>";
			}
			$data .="<tr><td colspan=2><input type='submit' name='submit' value='submit'></tr>";
			$data .= "</tbody>";
			$data .= "</table>";
			echo $data;
			if(!empty($_POST['hospnm']) && isset($_POST['submit'])) {
			foreach($_POST['hospnm'] as $check) {
					$collection->remove(array('hospname'=>$check)); //echoes the value set in the HTML form for each checked checkbox.
								 //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
								 //in your case, it would echo whatever $row['Report ID'] is equivalent to.
			}
			
}
	//$connection->close();
			//header('location:adminhome.php');
	?>
</article>

<footer>Copyright © www.bloodbank.com</footer>

</div>
</form>
</body>
</html>