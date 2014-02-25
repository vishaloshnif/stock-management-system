<?php
session_start(); // Use session variable on this page. This function must put on the top of page.
if(!isset($_SESSION['username']) || $_SESSION['usertype'] !='admin'){ // if session variable "username" does not exist.
header("location:index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
}
else
{
	include_once "db.php"; 
	error_reporting (E_ALL ^ E_NOTICE);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to Stock Management System !</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="jquery.date_input.js"></script>
<link rel="stylesheet" href="date_input.css" type="text/css">
<script type="text/javascript">$(function() {
  $("#datefield").date_input();
});</script>

		<script type='text/javascript' src='lib/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='lib/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='lib/thickbox-compressed.js'></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<script type='text/javascript' src='localdata.js'></script>

<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="lib/thickbox.css" />
	
<script type="text/javascript">
$().ready(function() {

	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	


	$("#singleBirdRemote").autocomplete("stock.php", {
		width: 160,
		autoFill: true,
		selectFirst: false
	});
	$("#supplier").autocomplete("supplier1.php", {
		width: 160,
		autoFill: true,
		selectFirst: false
	});
	$("#category").autocomplete("category.php", {
		width: 160,
		autoFill: true,
		selectFirst: false
	});
	$("#uom").autocomplete("uom.php", {
		width: 160,
		autoFill: true,
		selectFirst: false
	});


	$("#clear").click(function() {
		$(":input").unautocomplete();
	});
});


</script>

		<script src="js/jquery.validationEngine-en.js" type="text/javascript"></script>
		<script src="js/jquery.validationEngine.js" type="text/javascript"></script>
		 <script src="js/jquery.hotkeys-0.7.9.js"></script>
		<!-- AJAX SUCCESS TEST FONCTION	
			<script>function callSuccessFunction(){alert("success executed")}
					function callFailFunction(){alert("fail executed")}
			</script>
		-->
		
		<script>	
		
		
		
		
		
		$(document).ready(function() {
			// SUCCESS AJAX CALL, replace "success: false," by:     success : function() { callSuccessFunction() }, 
			 $("#singleBirdRemote").focus();
			 $("#singleBirdRemote").blur(function()
			{
			
				 $.post('check_stock_details.php', {stock_name: $(this).val() },
				function(data){
				
								// if(data=='no') //if username not avaiable
		 						// {
								//  $("#category").focus();
								// }
								$("#category").val(data.category);
								$("#supplier").val(data.supplier);
								$("#buyingrate").val(data.buyingrate);
								$("#sellingrate").val(data.sellingprice);
								$("#uom").val(data.uom);
								$("#available").val(data.available);
								$("#quantity").focus();
							}, 'json');
							
							
					

			
			});
			
			$("#form1").validationEngine(),
			
			jQuery(document).bind('keydown', 'Ctrl+s',function() {
		  $('#form1').submit();
		  return false;
			});
			
			jQuery(document).bind('keydown', 'Ctrl+r',function() {
		  $('#form1').reset();
		  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+a',function() {
			window.location = "addstock.php";
		  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+0',function() {
			window.location = "admin.php";
		  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+1',function() {
			window.location = "add_purchase.php";
			  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+2',function() {
			window.location = "add_stock_sales.php";
			  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+3',function() {
			window.location = "add_stock_details.php";
			  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+4',function() {
			window.location = "add_category.php";
			  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+5',function() {
			window.location = "add_supplier_details.php";
			  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+6',function() {
			window.location = "add_customer_details.php";
			  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+7',function() {
			window.location = "view_stock_entries.php";
			  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+8',function() {
			window.location = "view_stock_sales.php";
			  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+9',function() {
			window.location = "view_stock_details.php";
			  return false;
			});
			//$.validationEngine.loadValidation("#date")
			//alert($("#formID").validationEngine({returnIsValid:true}))
			//$.validationEngine.buildPrompt("#date","This is an example","error")	 		 // Exterior prompt build example								 // input prompt close example
			//$.validationEngine.closePrompt(".formError",true) 							// CLOSE ALL OPEN PROMPTS
		});
	</script>	
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #FFFFFF;
}

*{
padding: 0px;
margin: 0px;
}
#vertmenu {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 100%;
width: 160px;
padding: 0px;
margin: 0px;
}

#vertmenu h1 {
display: block;
background-color:#FF9900;
font-size: 90%;
padding: 3px 0 5px 3px;
border: 1px solid #000000;
color: #333333;
margin: 0px;
width:159px;
}

#vertmenu ul {
list-style: none;
margin: 0px;
padding: 0px;
border: none;
}
#vertmenu ul li {
margin: 0px;
padding: 0px;
}
#vertmenu ul li a {
font-size: 80%;
display: block;
border-bottom: 1px dashed #C39C4E;
padding: 5px 0px 2px 4px;
text-decoration: none;
color: #666666;
width:160px;
}

#vertmenu ul li a:hover, #vertmenu ul li a:focus {
color: #000000;
background-color: #eeeeee;
}
.style1 {color: #000000}

-->
</style>
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="960" border="0" cellpadding="0" cellspacing="0" bgcolor="#ECECEC">
          <tr>
            <td height="90" align="left" valign="top"><img src="images/topbanner.jpg" width="960" height="82"></td>
          </tr>
          <tr>
            <td height="800" align="left" valign="top"><table width="960" border="0" cellpadding="0" cellspacing="0" bgcolor="#ECECEC">
              <tr>
                <td width="130" align="left" valign="top">
				
				<br>

				<strong>Welcome <font color="#3399FF"><?php echo $_SESSION['username']; ?> !</font></strong><br> <br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><a href="admin.php"><img src="images/home.png" width="130" height="99" border="0"></a></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center"><a href="add_purchase.php"><img src="images/purchase.png" width="130" height="124" border="0"></a></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center"><a href="add_stock_sales.php"><img src="images/sales.png" width="146" height="111" border="0"></a></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center"><a href="report.php"><img src="images/reports.png" width="131" height="142" border="0"></a></td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
  <tr>
    <td align="center">&nbsp;</td>
    </tr>
</table>


	
				
				
				</td> <td height="500" align="center" valign="top">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="add_stock_details.php"><img src="images/addstockdetails.png" width="67" height="62" border="0"></a></td>
    <td><a href="add_supplier_details.php"><img src="images/supplier.png" width="67" height="54" border="0"></a></td>
    <td><a href="add_customer_details.php"><img src="images/customer.png" width="67" height="54" border="0"></a></td>
    <td><a href="add_category.php"><img src="images/categories.png" width="67" height="54" border="0"></a></td>
    <td><a href="view_stock_sales.php"><img src="images/vsales.png" width="67" height="54" border="0"></a></td>
    <td><a href="view_stock_entries.php"><img src="images/vpurchase.png" width="67" height="54" border="0"></a></td>
    <td><a href="view_stock_details.php"><img src="images/stockdetails.png" width="67" height="54" border="0"></a></td>
    <td><a href="view_stock_availability.php"><img src="images/savail.png" width="67" height="54" border="0"></a></td>
     <td align="left" valign="top"><a href="view_customer_details.php"><img src="images/customers.png" width="94" height="22" border="0"></a><br>      <a href="view_supplier_details.php"><img src="images/suppliers.png" width="94" height="22" border="0"></a><br>
      <a href="view_payments.php"><img src="images/payments.png" width="94" height="22" border="0"></a></td>
    <td align="left" valign="top"><a href="view_stock_sales_payments.php"><img src="images/outstanding.png" width="94" height="22" border="0"></a><br>      <a href="view_stock_entries_payments.php"><img src="images/pendings.png" width="94" height="22" border="0"></a><br>
      <a href="logout.php"><img src="images/logout.png" width="94" height="22" border="0"></a></td>
  </tr>
</table>
<?php
				if(isset($_POST['name']))

            {
			$sid=$_POST['id'];
			$pid=$_POST['pid'];
			$name=mysql_real_escape_string($_POST['name']);
			$category=mysql_real_escape_string($_POST['category']);
			$buyingrate=mysql_real_escape_string($_POST['buyingrate']);
			$sellingrate=mysql_real_escape_string($_POST['sellingrate']);
			$suplier=mysql_real_escape_string($_POST['suplier']);
			
			$quantity=mysql_real_escape_string($_POST['quantity']);
			
			$selected_date=$_POST['date'];
		  	$selected_date=strtotime( $selected_date );
			$mysqldate = date('Y-m-d H:i:s', $selected_date );
			$username = $_SESSION['username'];
			
			$total = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name'");
			$previous = $db->queryUniqueValue("SELECT quantity FROM stock_entries WHERE stock_id='$sid'");
			$opening_stock = $db->queryUniqueValue("SELECT quantity FROM stock_entries WHERE stock_id='$sid'");
			
		
			
			if($quantity < $previous)
			{
			
			$difference = $previous - $quantity;
			$total = $total - $difference;
			
			$result=$db->query("SELECT * FROM stock_entries where id >= $pid");
				while ($line1 = $db->fetchNextObject($result)) {
				
				$osd=$line1->opening_stock - $difference;
				$csd=$line1->closing_stock - $difference;
				$cid=$line1->id;
				
				$db->execute("UPDATE stock_entries SET opening_stock=".$osd.",closing_stock=".$csd." WHERE id=$cid");
 					
				}
			
			
			}
			if($quantity > $previous)
			{
			$difference = $quantity - $previous;
			$total = $total + $difference;
			
			$result=$db->query("SELECT * FROM stock_entries where id >= $pid");
				while ($line2 = $db->fetchNextObject($result)) {
				$osd=$line2->opening_stock + $difference;
				$csd=$line2->closing_stock + $difference;
				$cid=$line2->id;
			
				$db->execute("UPDATE stock_entries SET opening_stock=".$osd.",closing_stock=".$csd." WHERE id=$cid");
 					
				}
			}
			
			
			
			$db->execute("UPDATE stock_avail SET quantity=$total WHERE name='$name'");
		
		$db->execute("UPDATE stock_entries SET stock_name='$name',stock_supplier_name='$suplier',category='$category',quantity=$quantity,company_price=$buyingrate,selling_price=$sellingrate,date='$mysqldate',username='$username' WHERE stock_id='$sid'");
			
			echo "<br><font color=green size=+1 > [$name] Stock Entry Updated !</font>" ;
			
			}
				
				
				if(isset($_GET['id']))
				{
				
				$id=$_GET['id'];
				
				
				$line = $db->queryUniqueObject("SELECT * FROM stock_entries WHERE id=$id");
				?>
				
				<br>
<br>
					
				
				<form name="form1" method="post" id="form1" action="">
				<input name="pid" type="hidden" value="<?php echo $_GET['id']; ?>">
                  
                  <p align="center"><strong>Update Stock Entry </strong> - Add New ( Control +A)</p>
                  <table width="600"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">ID</td>
					  <td width="150"><input name="id" type="text" id="id" readonly="" value="<?php echo $line->stock_id;?>"></td>
					  <td width="150">Date</td>
					 
                      <td width="150"> <input type="text" id="datefield" name="date" class="date_input" value="<?php 
					  	$mysqldate=$line->date;
 						$phpdate = strtotime( $mysqldate );
 						$phpdate = date("d-m-Y",$phpdate);
						echo $phpdate;
					  ?>"></td>
                    </tr>
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150"><strong>Name</strong></td>
                      <td width="150"><input name="name" type="text" id="singleBirdRemote" class="validate[required,length[0,100]] text-input" value="<?php echo $line->stock_name ;?>"></td>
                      <td width="150">Category</td>
                      <td width="150"><input name="category" id="category" type="text" value="<?php echo $line->category ;?>" ></td>
                    </tr>
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">Supplier</td>
                      <td width="150"><input name="suplier" type="text" id="supplier" class="validate[optional,length[0,100]] text-input" value="<?php echo $line->stock_supplier_name ;?>"></td>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Buying Rate</td>
                      <td><input name="buyingrate" type="text" id="buyingrate"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input"  value="<?php echo $line->company_price ;?>"></td>
                      <td>Selling Rate </td>
                      <td><input name="sellingrate" type="text" id="sellingrate"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input" value="<?php echo $line->selling_price ;?>"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><strong>Quantity</strong></td>
                      <td><input name="quantity" type="text" id="quantity"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input" value="<?php echo $line->quantity ;?>" ></td>
                      <td>Available Quantity </td>
                      <td><input name="available" type="text" id="available" value="<?php
					 
					  $availquantity = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='".$line->stock_name."'");
					   echo  $availquantity;?>"  readonly=""></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td align="right"><input type="reset" name="Reset" value="Reset">
&nbsp;&nbsp;&nbsp;</td>
                      <td> &nbsp;&nbsp;&nbsp;
                          <input type="submit" name="Submit" value="Save"></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center">&nbsp;</td>
                      <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Control + R) </td>
                      <td align="left"> &nbsp;&nbsp;( Control + S ) </td>
                      <td align="left">&nbsp;</td>
                    </tr>
                  </table>
                </form>
				
				
				<?php
				}
				else
				echo "Error in processing the stock Entry updation";
				?></td>
              </tr>
            </table>
			
		</td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#72C9F4"><span class="style1"><a href="http://www.pluskb.com">Developed by PlusKB Innovations</a></span></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
<?php
}
?>