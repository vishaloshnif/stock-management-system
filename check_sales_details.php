<?php
include "db.php";

$line = $db->queryUniqueObject("SELECT * FROM stock_details  WHERE stock_name='".$_POST['stock_name']."'");
$rate=$line->selling_price;

if($line!=NULL)
{
$line1 = $db->queryUniqueObject("SELECT * FROM stock_avail  WHERE name='".$_POST['stock_name']."'");
$availstock=$line1->quantity;
$arr = array ("rate"=>"$rate","availstock"=>"$availstock");
echo json_encode($arr);

}
else
{
$arr1 = array ("no"=>"no");
echo json_encode($arr1);

}
?>