<?php
session_start(); // Use session variable on this page. This function must put on the top of page.
if(!isset($_SESSION['username']) || $_SESSION['usertype'] !='admin'){ // if session variable "username" does not exist.
header("location:index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
}
else
{
	include_once "db.php"; 
	error_reporting (E_ALL ^ E_NOTICE);
	if(isset($_GET['tid']) && isset($_GET['table']))
	{
	$tid=$_GET['tid'];
	$tablename=$_GET['table'];
	$return=$_GET['return'];
	
	$result =$db->query("SELECT * FROM stock_sales WHERE transactionid='$tid'");
  while ($line = $db->fetchNextObject($result)) {
  
  
				$difference=$db->queryUniqueValue("SELECT quantity FROM stock_sales WHERE id=$line->id");	
				echo "SELECT id FROM stock_entries WHERE salesid='$tid' and stock_name='$line->stock_name'";
				$id=$db->queryUniqueValue("SELECT id FROM stock_entries WHERE salesid='$tid' and stock_name='$line->stock_name'");
				
				$name=$line->stock_name;
				$result1=$db->query("SELECT * FROM stock_entries where id > $id");
				while ($line2 = $db->fetchNextObject($result1)) {
				$osd=$line2->opening_stock + $difference;
				$csd=$line2->closing_stock + $difference;
				$cid=$line2->id;
				$db->execute("UPDATE stock_entries SET opening_stock=".$osd.",closing_stock=".$csd." WHERE id=$cid");
 					
				}
				
				$total = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name'");
				$total = $total + $difference;
				$db->execute("UPDATE stock_avail SET quantity=$total WHERE name='$name'");
				$db->execute("DELETE FROM $tablename WHERE id=$line->id");
				$db->execute("DELETE FROM stock_entries WHERE salesid='$tid' and stock_name='$line->stock_name'");
				
				}
				
			

	
	header("location:$return?msg=Record Deleted Successfully!&id=$tid");
	
		}

	
}
?>