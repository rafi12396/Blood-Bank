<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="back.css">
<title>blood donation</title>
</head>
<body>
<form action ="index.php" method= "post" align="right">
<img id="bak" src="hosp.jpg" alt="hosp">
<ul>
  <li><a class="active" href="#home">SEARCH</a></li>
  <li><a href="#news">LOGIN</a></li>
  <li><a href="#contact">BLOOD BANK DETAILS</a></li>
  <li><a href="#about">HOSPITAL DETAILS</a></li>
</ul>
<b>USERNAME :</b>
<input type= "text" name ="user"><BR><br>

<b>PASSWORD  :</b>
<input type="password" name = "password"><br><br>
<input type="submit" value = "LOGIN">
</form>

</body>
</html>


<?php
	try
	{
		$connection= new MongoClient();
		$db= $connection->blood;
		//echo "Connection to database successfully";
		$collection= $db->users;
		//echo "Database mydb selected";
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$criteria = array(
				'uname' => $_POST["user"]
			);
			$doc = $collection->findOne($criteria);
			if(!empty($doc)) {
				 echo 'Data Already Exist';
			}
			else
			{
			  // insert a new document
				$object = array(
				"uname" => $_POST["user"],
				"pass" =>$_POST["password"]
				);
				$collection->save($object);
				echo 'Added Successfully!';
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