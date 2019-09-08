<html>
<head>
	<link rel="stylesheet" type="text/css" href="back.css">
	<style>
	table{
		position: absolute;
		left: 400px;
		top: 250px;
		}
	</style>
	<title>blood donation</title>
	<script>
	function f1(form)
	{
	var uname=document.getElementById("uname").value;
	var rad=document.getElementById("gen").value;
	var c=-1;
	var age=document.getElementById("age").value;
	var zip=document.getElementById("zip").value;
	var pass=document.getElementById("pass").value;
	var dname=document.getElementById("dname").value;
	var mobile=document.getElementById("phone").value;
	var address=document.getElementById("address").value;
	var unamelen=uname.length;
	var agelen=age.length;
	var ziplen=zip.length;
	var passlen=pass.length;
	var dnamelen=dname.length;
	var mobilelen=mobile.length;
	var addresslen=address.length;
	var agecount=0,zipcount=0,dnamecount=0,mobilecount=0,addresscount=0,valid=0;
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
	for(var i=0;i<dnamelen;i++)
		{
			if((dname.charAt(i)>='a' && dname.charAt(i)<='z')|| (dname.charAt(i)>='A' && dname.charAt(i)<='Z')||( dname.charAt(i)==' '))
			{
				dnamecount++;		
			}
			else
				break;
		}
	if(dnamecount!=dnamelen)
	{
		alert("NAME IS INVALID");
		return false;
	}
	/*for(var i=0; i < rad.length; i++){
		if(rad[i].checked) {
		c = i; 
		}
	}
	if (c == -1){ 
		alert("PLEASE SELECT GENDER");
		return false;
	}*/
	for(var i=0;i<agelen;i++)
		{
			if(age.charAt(i)>='0' && age.charAt(i)<='9')
			{
				agecount++;		
			}
			else
				break;
		}
	if(agecount!=agelen ||  agelen!=2 || age.charAt(0)<'2')
	{
		alert("AGE BELOW 20 NOT ACCEPTED");
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
<form action ="editudetails.php" method= "post">
<div class="container">
<header>
   <<img src="sidehdr.png" alt="HTML5 Icon" style="float:right;width:100px;height:90px;">
   <h1>BLOOD BANK</h1>
</header>
<div id="nav">  
<nav>
	<ul>
	<li><a href="logout.php">SIGN OUT</a></li>
	<li><a class="active" href="userhome.php">MY HOMEPAGE</a></li>
	<li><a class="active" href="searchdonor.php">SEARCH DONOR</a></li>
  <li><a href="bloodbankdetail.php">BLOOD BANK DETAILS</a></li>
  <li><a href="hospitaldetail.php">HOSPITAL DETAILS</a></li>
  <li><a href="changepass.php">CHANGE PASSWORD</a></li>
	</ul>
</nav>
</div>
<article>
	<table border=20 cellspacing=1 cellpadding=5 bgcolor=#ffffff align="center">

	<CAPTION> <h3> UPDATE DETAILS </h3> </caption>
	
	<tr> <td>E-MAIL <td><input type="email" name="email"> 
	
	<tr> <td>AGE <td><input type="number" name="age"> 
	
	<tr> <td>ADDRESS <td><textarea rows=5 cols=15 name="add"></textarea> 
	
	<tr> <td>ZIP <td><input type="number" name="zip"> 
		
	<tr> <td>CITY <td><select name="city">
				<option selected>PUNE</option>
				<option>MUMBAI</option>
				<option>BANGALORE</option>
				<option>REWA</option>
			</select>
	<tr> <td>PHONE <td><input type="text" name="phone"> 
	<tr> <td>LAST DONATION DATE: <td><input type="date" name="ldo" id="ldat">
	<tr>  <td>
  	      <td><input type="submit" value="UPDATE" name="sub" onclick="return f1(this.form);">  
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
		$collection= $db->donordetail;
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
			"email" => $_POST["email"],
			"age" =>$_POST["age"],
			"address" => $_POST["add"],
			"zip" => $_POST["zip"],
			"city" =>$_POST["city"],
			"phone" =>$_POST["phone"],
			"lastdate" => new MongoDate(strtotime($_POST["ldo"]))
			);
			$collection->update(array("_id"=>$uid),array('$set'=>$object));
			echo "Added Successfully!";
			  // disconnect from server
		$connection->close();
		header('location:userhome.php');
		}
    } catch (MongoConnectionException $e) {
      die('Error connecting to MongoDB server');
    } catch (MongoException $e) {
      die('Error: ' . $e->getMessage());
    }
?>