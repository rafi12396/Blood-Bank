<html>
<head>
	<link rel="stylesheet" type="text/css" href="back.css">
	<title>blood donation</title>
	<script>
	function f1(form)
	{
	var uname=document.getElementById("uname").value;
	var zip=document.getElementById("zip").value;
	var pass=document.getElementById("pass").value;
	var mobile=document.getElementById("phone").value;
	var unamelen=uname.length;
	var ziplen=zip.length;
	var passlen=pass.length;
	var mobilelen=mobile.length;
	var zipcount=0,mobilecount=0;
	if(unamelen<3)
	{
		alert("USERNAME MIN LENGTH 3");
		return false;
	}
	if(passlen<5)
	{
		alert("PASSWORD LENGTH MUST BE GREATER THAN 5");
		return false;
	}
	
	for(var i=0;i<ziplen;i++)
	{
		if(zip.charAt(i)>='0' && zip.charAt(i)<='9')
		{
			zipcount++;		
		}
		else
			break;
	}
	if(zipcount!=ziplen ||  ziplen!=6)
	{
		alert("ZIP IS INVALID");
		return false;
	}
	
	
	for(var i=0;i<mobilelen;i++)
		{
			if(mobile.charAt(i)>='0' && mobile.charAt(i)<='9')
			{
				mobilecount++;		
			}
			else
				break;
		}
	if(mobilecount!=mobilelen ||  mobilelen!=10)
	{
		alert("MOBILE NO. INVALID");
		return false;
	}
	
	return true;
	}
	</script>
</head>
<body>
<form action ="<?php echo $_SERVER['PHP_SELF'];?>" method= "post">
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
  <li><a href="delbldbank.php">DELETE BLOOD BANK</a></li>
  <li><a class="active" href="bldbankreg.php">ADD HOSPITAL</a></li>
  <li><a href="hospitaldel.php">DELETE HOSPITAL</a></li>
	</ul>
</nav>
</div>
<article>
	<table border=20 cellspacing=1 cellpadding=5 bgcolor=white align="center">

	<CAPTION> <h3> BLOOD BANK REGISTRATION </h3> </caption>

	<tr> <td>BLOODBANK NAME <td><input type="text" name="bbname">
	
	<tr> <td>ADDRESS <td><textarea rows=5 cols=15 name="add"></textarea>

	<tr> <td>ZIP <td><input type="number" name="zip">

	<tr> <td>USER NAME <td><input type="text" name="uname" required>
	
	<tr> <td>PASSWORD <td><input type="password" name="pass">
	
	<tr> <td>E-MAIL <td><input type="email" name="email">   
		
	<tr> <td>CITY <td><select name="city">
				<option selected>PUNE</option>
				<option>MUMBAI</option>
				<option>BANGALORE</option>
				<option>REWA</option>
			</select>
	<tr> <td>PHONE <td><input type="text" name="phone"> 
	<tr>  <td><input type="reset" value="CLEAR" name="clr">
  	      <td><input type="submit" value="SUBMIT" name="sub" onclick="return f1(this);">  
	</table>
</article>

<footer>Copyright © www.bloodbank.com</footer>

</div>
  
</form>
</body>
</html>



<?php
	include('session.php');
	try
	{
		$connection= new MongoClient();
		$db= $connection->blood;
		//echo "Connection to database successfully";
		$collection= $db->bankdetail;
		//echo "Database mydb selected";
		if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST["uname"]))
		{
			$criteria = array(
				'uname' => $_POST["uname"]
			);
			$doc = $collection->findOne($criteria);
			if(!empty($doc)) {
				 echo "Username already exists";
			}
			else
			{
			$uid=$collection->count();
			  // insert a new document
				$object = array(
				"_id"=>$uid+1,
				"uname" => $_POST["uname"],
				"password" =>$_POST["pass"],
				"email" => $_POST["email"],
				"bankname" =>$_POST["bbname"],
				"address" => $_POST["add"],
				"zip" => $_POST["zip"],
				"city" =>$_POST["city"],
				"phone" =>$_POST["phone"],
				"bldgrp" => array("A+"=>0,
							"A-"=>0,
							"B+"=>0,
							"B-"=>0,
							"AB+"=>0,
							"AB-"=>0,
							"O+"=>0,
							"O-"=>0)
				);
				$collection->save($object);
				echo "Added Successfully!";
				header('location:adminhome.php');
			}
			  // disconnect from server
		$connection->close();
		}
    } catch (MongoConnectionException $e) {
      die('Error connecting to MongoDB server');
    } catch (MongoException $e) {
      die('Error: ' . $e->getMessage());
    }
?>