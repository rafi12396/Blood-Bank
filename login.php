<html>
<head>
	<link rel="stylesheet" type="text/css" href="back.css">
	<title>blood donation</title>
</head>
<body>
<form action="login.php" method= "post">
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
	<table  border=20 cellspacing=1 cellpadding=5 bgcolor=white align="center">

	<CAPTION> <h4> LOGIN FORM </h4> </caption>
	
	<tr> <td>SELECT ONE: <td><input type="radio" name="usr" value="donor">PERSONAL   <input type="radio" name="usr" value="bank">BLOOD BANK   <input type="radio" name="usr" value="hospital">HOSPITAL

	<tr> <td>USER NAME <td><input class="inpt" type="text" name="uname" required size=40 maxlength=7>
	
	<tr> <td>PASSWORD <td><input class="inpt" type="password" name="pass">
	<tr> <td> <td>
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
	session_start();
	try
	{
		$connection= new MongoClient();
		$db= $connection->blood;
		//echo "Connection to database successfully";
		//echo "Database mydb selected";
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			if($_POST['usr']=='donor')
				$collection= $db->donordetail;
			else if($_POST['usr']=='bank')
				$collection= $db->bankdetail;
			else if($_POST['usr']=='hospital')
				$collection= $db->hospitaldetail;
			else
			{
				$connection->close();
				header('location:home.php');
			}
			$criteria = array(
				'uname' => $_POST["uname"]
			);
			$doc = $collection->findOne($criteria);
			if(!empty($doc)) {
				 $criteria1 = array(
				 'uname'=>$_POST["uname"],
				'password' => $_POST["pass"]
			);
			$doc = $collection->findOne($criteria1);
			if(!empty($doc)) {
				$_SESSION['user']=$_POST["uname"];
				if($_POST['usr']=='donor')
				{
					if($_POST['uname']=='Admin')
						header('location:adminhome.php');
					else
						header('location:userhome.php');
				}
				else if($_POST['usr']=='bank')
					header('location:bankhome.php');
				else if($_POST['usr']=='hospital')
					header('location:hospitalhome.php');
				else
				{
					$connection->close();
					header('location:logout.php');
				}
				}
			else
			{
			  echo "WRONG PASSWORD!!!";
			}
			}
			else
			{
				echo "WRONG USER-NAME";
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