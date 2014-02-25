<?php
session_start(); // Use session variable on this page. This function must put on the top of page.
if(!isset($_SESSION['username']) || $_SESSION['usertype'] !='admin'){ // if session variable "username" does not exist.
header("location:index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
}
else
{
	include_once "db.php"; 
	error_reporting (E_ALL ^ E_NOTICE);
	if(isset($_GET['id']) && isset($_GET['table']))
	{
	$id=$_GET['id'];
	$tablename=$_GET['table'];
	$return=$_GET['return'];
	
	$result =$db->query("SELECT * FROM stock_entries WHERE stock_id='$id'");
  while ($line = $db->fetchNextObject($result)) {
			
				$difference=$db->queryUniqueValue("SELECT quantity FROM stock_entries WHERE id=$line->id");
				
				$name=$db->queryUniqueValue("SELECT stock_name FROM stock_entries WHERE id=$line->id");
				$result1=$db->query("SELECT * FROM stock_entries where id > $line->id");
				while ($line2 = $db->fetchNextObject($result1)) {
				$osd=$line2->opening_stock - $difference;
				$csd=$line2->closing_stock - $difference;
				$cid=$line2->id;
				$db->execute("UPDATE stock_entries SET opening_stock=".$osd.",closing_stock=".$csd." WHERE id=$cid");
 					
				}
				$total = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name'");
				$total = $total - $difference;
				$db->execute("UPDATE stock_avail SET quantity=$total WHERE name='$name'");
				$db->execute("DELETE FROM stock_entries WHERE id=$line->id");
	
	
	}
	

	
	
	
	header("location:$return?msg=Record Deleted Successfully!&id=$id");
	}
		

	
}
?>