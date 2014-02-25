<?php
session_start();
include_once "db.php"; 

$tbl_name="stock_user"; // Table name


// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'" ;
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
$row = mysql_fetch_row($result);

$_SESSION['id']=$row[0];
$_SESSION['username']=$row[1];
$_SESSION['usertype']=$row[3];

if($row[3]=="admin")
header("location:admin.php");
else if($row[3]=="user")
header("location:user.php");
else
echo "error in validate user";

}
else {
header("location:index.php?msg=Wrong%20Username%20or%20Password");
}
?>