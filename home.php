<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="back.css">
<title>BLOOD DONATION</title>
<script>
function f1(form)
{
var req=document.getElementById("rq").value;
var mobile=document.getElementById("phn").value;
var reqlen=req.length;
var mobilelen=mobile.length;
var reqcount=0,mobilecount=0,valid=0;
for(var i=0;i<reqlen;i++)
	{
		if(req.charAt(i)>='0' && req.charAt(i)<='9')
		{
			reqcount++;		
		}
		else
			break;
	}
if(reqcount==reqlen &&  reqlen<3 &&  reqlen>0)
{
	valid++;
}
else
{
	alert("REQUIRED UNITS MUST BE LESS THAN 100 ltrs");
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
if(mobilecount==mobilelen &&  mobilelen==10)
{
	valid++;
}
else
{
	alert("MOBILE NUMBER INVALID");
}
if(valid==2)
	form.submit();
else
	location.reload();


}
</script>

</head>
<body>
<form action ="home.php" method= "post" align="right">
<div class="container">
<header>
   <img src="sidehdr.png" alt="HTML5 Icon" style="float:right;width:100px;height:90px;">
   <h1>BLOOD BANK</h1>
</header>
<div id="nav">  
<nav>
	<ul>
	<li><a class="active" href="login.php">LOGIN PAGE</a></li>
	<li><a href="register.php">REGISTER FOR A/C</a></li>
	</ul>
</nav>
</div>
<article>
	<div id="emr">
	<h4>Post Emergency Requirements</h4>
	<table id="addreq">
		<tr> <td>BLOOD GROUP <td><select name="bg">
				<option id="bg">A+</option>
				<option id="bg">A-</option>
				<option id="bg">B+</option>
				<option id="bg">B-</option>
				<option id="bg">AB+</option>
				<option id="bg">AB-</option>
				<option id="bg">O+</option>
				<option id="bg">O-</option>
			</select>
		<tr> <td>REQUIRED UNITS <td><input type="text" name="requ" required id="rq">
		<tr> <td>PHONE NO. <td><input type="text" name="phn" size=10 required maxlength=10 id="phn">
		<!---<tr> <td>DATE: <td><input type="date" name="cdate" id="dat">--->
		<tr> <td> <td><input type="submit" value="ADD" name="submit" onclick="f1(this.form)">
	</table>
</div>
<div id="etb">
	<?php
		$connection= new MongoClient();
		$db= $connection->blood;
		//echo "Connection to database successfully";
		$collection= $db->emergency;
			$data  = "<table border=10px align='right' style='color:red;'>";
			$data .= "<thead>";
			$data .= "<tr>";
			$data .= "<th>BLOOD GR</th>";
			$data .= "<th>REQ</th>";
			$data .= "<th>PHONE</th>";
			$data .= "<th>DATE(m/d/y)</th>";
			$data .= "</tr>";
			$data .= "</thead>";
			$data .= "<tbody>";
			$cursor = $collection->find();
			foreach($cursor as $document){
				$data .= "<tr>";
				$data .= "<td>" . $document["bldgrp"] . "</td>";
				$data .= "<td>" . $document["req"]."</td>";
				$data .= "<td>" . $document["phone"]."</td>";
				$data .= "<td>" . date('m/d/Y',$document["date"]->sec)."</td>";
				$data .= "</tr>";
			}
			$data .= "</tbody>";
			$data .= "</table>";
			echo $data;
	?>
	</div>
</article>

<footer>Copyright © www.bloodbank.com</footer>

</div>

</form>
</body>
</html>

<?php
		//echo "Database mydb selected";
		if(isset($_POST['submit'])&& !empty($_POST["phn"]))
		{
			  // insert a new document
				$object = array(
				"bldgrp" => $_POST["bg"],
				"req" =>$_POST["requ"],
				"phone" =>$_POST["phn"],
				"date" =>new MongoDate()
				);
				$collection->save($object);
				$collection->deleteIndex("date");
				$collection->ensureIndex(
					['date' => 1], ['expireAfterSeconds' => 86400]
				);
				//echo 'Added Successfully!';
			  // disconnect from server
			  echo "<script type='text/javascript'>alert('YOUR EMERGENCY POST HAS BEEN ADDED ');</script>";
		$connection->close();
		}
?>