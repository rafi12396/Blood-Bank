<html>
<head>
	<style>
	table{
		position: absolute;
		color:#FF4500;
		left: 400px;
		top: 250px;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="back.css">
	<title>blood donation</title>
</head>
<body>
<form action ="changepass.php" method= "post">
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
	<li><a class="active" href="searchdonor.php">SEARCH DONOR</a></li>
  <li><a href="bloodbankdetail.php">BLOOD BANK DETAILS</a></li>
  <li><a href="hospitaldetail.php">HOSPITAL DETAILS</a></li>
	</ul>
</nav>
</div>
<article>
	<table border=20 cellspacing=1 cellpadding=5 bgcolor=#ffffff align="center">

	<CAPTION> <h3> CHANGE PASSWORD </h3> </caption>
	
	<tr> <td>CURRENT PASSWORD <td><input type="password" name="curpass">  
	
	<tr> <td>NEW PASSWORD <td><input type="password" name="newpass">

	<tr> <td>RE-ENTER PASSWORD <td><input type="password" name="repass">
	<tr>  <td>
  	      <td><input type="submit" value="CHANGE" name="sub">  
	</table>
</article>

<footer>Copyright © www.bloodbank.com</footer>

</div>
  
</form>
</body>
</html>

<?php

	include('session.php');
	try{
		$connection=new MongoClient();
		$db=$connection->blood;
		$collection=$db->donordetail;
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$query=array(
				'uname'=>$_SESSION['user'],
				'password'=>$_POST["curpass"]
			);
			$doc=$collection->find($query);
			if(!empty($doc))
			{
				if(strcmp($_POST["newpass"],$_POST["repass"])==0)
				{
					$collection->update(array("uname"=>$_SESSION['user']),array('$set'=>array("password"=>$_POST["newpass"])));
					echo "PASSWORD CHANGED SUCCESSFULLY!";
					header('location:userhome.php');
				}
			}
		}
		$connection->close();
	}catch (MongoConnectionException $e) {
      die('Error connecting to MongoDB server');
    } catch (MongoException $e) {
      die('Error: ' . $e->getMessage());
    }
?>