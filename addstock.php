<?php
session_start(); // Use session variable on this page. This function must put on the top of page.
if(!isset($_SESSION['username']) || $_SESSION['usertype'] !='admin'){ // if session variable "username" does not exist.
header("location:index.php?msg=Please%20login%20to%20access%20admin%20area%20!"); // Re-direct to index.php
}
else
{
	include_once "db.php"; 

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to Stock Management System !</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<script src="js/jquery.min.js" type="text/javascript"></script>
		
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
	


	$("#singleBirdRemote").autocomplete("search.php", {
		width: 160,
		autoFill: true,
		selectFirst: false
	});
	$("#suplier").autocomplete("search.php", {
		width: 160,
		autoFill: true,
		selectFirst: false
	});
	$("#uom").autocomplete("search.php", {
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
			 $("#name").focus();
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
			window.location = "index.php";
		  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+1',function() {
			window.location = "addstock.php";
			  return false;
			});
			jQuery(document).bind('keydown', 'Ctrl+2',function() {
			window.location = "dsfsd.php";
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

-->
</style>
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="960" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="90" align="left" valign="top"><img src="images/topbanner.jpg" width="960" height="82"></td>
          </tr>
          <tr>
            <td height="800" align="left" valign="top"><table width="960" border="0" cellspacing="0" cellpadding="0">
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


	<div id="vertmenu">
<h1>Options</h1>
<ul>
<li><a href="admin.php" tabindex="1">Admin Home</a></li>
<li><a href="add_purchase.php" tabindex="2">Add Stock Entry</a></li>
<li><a href="add_stock_sales.php" tabindex="3">AddStock Sales</a></li>
<li><a href="add_stock_details.php" tabindex="4">Add Stock Details</a></li>
<li><a href="add_category.php" tabindex="5">Add Catetogry</a></li>
<li><a href="add_supplier_details.php" tabindex="6">Add Supplier Details</a></li>
<li><a href="add_customer_details.php" tabindex="7">Add Customer Details</a></li>

<li><a href="view_stock_entries.php" tabindex="8">View Stock Entries</a></li>
<li><a href="view_stock_sales.php" tabindex="9">View Stock Sales</a></li>
<li><a href="view_stock_details.php" tabindex="10">View Stock Details</a></li>
<li><a href="view_supplier_details.php" tabindex="11">View Supplier Details</a></li>
<li><a href="view_customer_details.php" tabindex="12">View Customer Details</a></li>

<li><a href="report.php" tabindex="13">Report</a></li>
<li><a href="logout.php" tabindex="14">Signout</a></li>
</ul>
</div>
				
				
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
			
			$id=mysql_real_escape_string($_POST['id']);
			$name=mysql_real_escape_string($_POST['name']);
			$category=mysql_real_escape_string($_POST['category']);
			$buyingrate=mysql_real_escape_string($_POST['buyingrate']);
			$sellingrate=mysql_real_escape_string($_POST['sellingrate']);
			$suplier=mysql_real_escape_string($_POST['suplier']);
			$uom=mysql_real_escape_string($_POST['uom']);
			$expiry=mysql_real_escape_string($_POST['expiry']);
			$count = $db->countOf("stock_details", "stock_id='$id'");
		if($count==1)
			{
		echo "<font color=red> Dublicat Entry. Please Verify</font>";
			}
			else
			{
				
			if($db->query("insert into stock_details(stock_id,stock_name,stock_quatity,supplier_id,company_price,selling_price,category,expire_date,uom) values('$id','$name',0,'$suplier',$buyingrate,$sellingrate,'$category','$expiry','$uom')"))
			echo "<br><font color=green size=+1 >Stock Details Added !</font>" ;
			else
			echo "<br><font color=red size=+1 >Problem in Adding !</font>" ;
			
			}
			
			
			}
				
				?>
				
				<br>
<br>

				
				<form name="form1" method="post" id="form1" action="">
                  
                  <p align="center"><strong>Add New Stock Details </strong> - Add New ( Control +A)</p>
                  <table width="300"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">ID</td>
                      <td width="150"><input name="id" type="text" id="id" ></td>
                    </tr>
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">Name</td>
                      <td width="150"><input name="name" type="text" id="name" class="validate[required,length[0,100]] text-input"></td>
                    </tr>
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">Category</td>
                      <td width="150"><input name="category" type="text" id="singleBirdRemote"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Buying Rate</td>
                      <td><input name="buyingrate" type="text" id="buyingrate"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input" ></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Selling Rate </td>
                      <td><input name="sellingrate" type="text" id="sellingrate"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input" ></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Suplier Name</td>
                      <td><input name="suplier" type="text" id="suplier" class="validate[optional,length[0,100]] text-input"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>UOM</td>
                      <td><input name="uom" type="text" id="uom" class="validate[optional,length[0,100]] text-input"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Expiry Date </td>
                      <td><input name="expiry" type="text" id="expiry" class="validate[optional,length[0,100]] text-input" ></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right"><input type="reset" name="Reset" value="Reset">                     &nbsp;&nbsp;&nbsp;</td>
                      <td>                        &nbsp;&nbsp;&nbsp;
                        <input type="submit" name="Submit" value="Save"></td>
                    </tr>
                    <tr>
                      <td align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Control + R) </td>
                      <td align="left"> &nbsp;&nbsp;( Control + S ) </td>
                    </tr>
                  </table>
                </form></td>
              </tr>
            </table>
			
		</td>
          </tr>
          <tr>
            <td height="30" align="center"><a href="http://www.pluskb.com">Developed by PlusKB Innovations</a></td>
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