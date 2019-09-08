<html>
<body>
<form action="search.php" method="POST">
search value: ><input type="text" name="t1">
<input type="submit" value="submit">
</form>
</body>
</html>
<?php
if(!empty($_POST["t1"]))
{
   // connect to mongodb
   $m = new MongoClient();
   echo "Connection to database successfully";
	
   // select a database
   $db = $m->blood;
   echo "Database mydb selected";
   $collection = $db->donord;
   $name=$_POST["t1"];
   echo $name;
   echo "Collection selected succsessfully";
	$querry=array('bloodgroup'=>"$name");
   $cursor = $collection->find($querry);
   // iterate cursor to display title of documents
	
  // foreach ($cursor as $document) {
//var_dump($document);   }
echo "<table border=1 align=center cellspacing=5 cellpadding=5>";
echo "<tr><th>NAME<th>EMAILID<th>CONTACT<th>BLOODGROUP";
foreach ($cursor as $document)
	{
		echo "<tr>";

			echo"<td>".$document["name"];
						echo"<td>".$document["emailid"];
									echo"<td>".$document["contactno"];
												echo"<td>".$document["bloodgroup"];

	}
echo"</table>";
}
?>

