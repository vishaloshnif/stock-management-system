<?php
include "db.php";

$line = $db->queryUniqueObject("SELECT * FROM stock_details  WHERE stock_name='".$_POST['stock_name']."'");
$category=$line->category;
$supplier_id=$line->supplier_id;
$company_price=$line->company_price;
$selling_price=$line->selling_price;


if($line!=NULL)
{
$line1 = $db->queryUniqueObject("SELECT * FROM stock_avail  WHERE name='".$_POST['stock_name']."'");
$quantity=$line1->quantity;
$arr = array ("category"=>"$category","supplier"=>"$supplier_id","buyingrate"=>"$company_price","sellingprice"=>"$selling_price","available"=>"$quantity");
echo json_encode($arr);

}
else
echo "no";
?>