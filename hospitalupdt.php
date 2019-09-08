<html>
<head>
	<link rel="stylesheet" type="text/css" href="back.css">
	<title>blood donation</title>
</head>
<body>
<form action ="hospitalupdt.php" method= "post">
<div class="container">
<header>
   <img src="sidehdr.png" alt="HTML5 Icon" style="float:right;width:100px;height:90px;">
   <h1>BLOOD BANK</h1>
</header>
<div id="nav">  
<nav>
	<ul>
	<li><a href="logout.php">SIGN OUT</a></li>
	</ul>
</nav>
</div>
<article>
	<table  border=20 cellspacing=1 cellpadding=5 bgcolor=white align="center">

	<CAPTION> <h4> BLOOD DETAILS </h4> </caption>

	<tr> <td>BLOOD GRP<td>QTY(ltrs)
	
	<tr> <td>A+ <td><input type="number" name="a+">
	
	<tr> <td>A- <td><input type="number" name="a-">
	
	<tr> <td>B+ <td><input type="number" name="b+">
	
	<tr> <td>B- <td><input type="number" name="b-">
	
	<tr> <td>AB+ <td><input type="number" name="ab+">
	
	<tr> <td>AB- <td><input type="number" name="ab-">
	
	<tr> <td>O+ <td><input type="number" name="o+">
	
	<tr> <td>O- <td><input type="number" name="o-">
	<tr>  <td><input type="reset" value="CLEAR" name="clr">
  	      <td><input type="submit" value="SUBMIT" name="sub"> 
	</table>
</article>

<footer>Copyright © www.bloodbank.com</footer>

</div>
</form>
</body>
</html>

<?php
	include('sessionhosp.php');
	try
	{
		$connection= new MongoClient();
		$db= $connection->blood;
		//echo "Connection to database successfully";
		$collection= $db->hospitaldetail;
		//echo "Database mydb selected";
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$criteria = array(
				'uname' => $_SESSION['user']
			);
			$doc = $collection->findOne($criteria);
			$uid=$doc["_id"];
			  // update the document
			$object = array(
			"bldgrp" => array("A+"=>$_POST['a+'],
							"A-"=>$_POST['a-'],
							"B+"=>$_POST['b+'],
							"B-"=>$_POST['b-'],
							"AB+"=>$_POST['ab+'],
							"AB-"=>$_POST['ab-'],
							"O+"=>$_POST['o+'],
							"O-"=>$_POST['o-'])
			);
			$collection->update(array("_id"=>$uid),array('$set'=>$object));
			echo "Added Successfully!";
			  // disconnect from server
		$connection->close();
		header('location:hospitalhome.php');
		}
    } catch (MongoConnectionException $e) {
      die('Error connecting to MongoDB server');
    } catch (MongoException $e) {
      die('Error: ' . $e->getMessage());
    }
?>