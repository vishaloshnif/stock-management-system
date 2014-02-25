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
		mustMatch: true,
		selectFirst: false
	});
	
	$("#customer").autocomplete("customer.php", {
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
			
				 $.post('check_sales_details.php', {stock_name: $(this).val() },
				function(data){
				
								$("#rate").val(data.rate);
								$("#availstock").val(data.availstock);
								$("#quantity").focus();
							}, 'json');
							
							
					

			
			});
			
			
			$("#quantity").keyup(function (e) {
			
			$("#total").val( parseInt( $("#quantity").val()) * parseInt( $("#rate").val() ));
			if(parseInt($("#quantity").val()) > parseInt($("#availstock").val()))
			$("#quantity").val(parseInt($("#availstock").val()));
			
			});
			
			$("#rate").keyup(function (e) {
			
			$("#total").val( parseInt($("#quantity").val()) * parseInt($("#rate").val()) );
			if(parseInt($("#quantity").val()) > parseInt($("#availstock").val()))
			$("#quantity").val(parseInt($("#availstock").val()));
			
			});

			
			 $("#customer").blur(function()
			{
			
				 $.post('check_customer_details.php', {stock_name1: $(this).val() },
				function(data){
				
								$("#address").val(data.address);
								$("#contact1").val(data.contact1);
								$("#contact2").val(data.contact2);
								
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
div.pagination {

	padding: 3px;

	margin: 3px;

}



div.pagination a {

	padding: 2px 5px 2px 5px;

	margin: 2px;

	border: 1px solid #AAAADD;

	

	text-decoration: none; /* no underline */

	color: #000099;

}

div.pagination a:hover, div.pagination a:active {

	border: 1px solid #000099;



	color: #000;

}

div.pagination span.current {

	padding: 2px 5px 2px 5px;

	margin: 2px;

		border: 1px solid #000099;

		

		font-weight: bold;

		background-color: #000099;

		color: #FFF;

	}

	div.pagination span.disabled {

		padding: 2px 5px 2px 5px;

		margin: 2px;

		border: 1px solid #EEE;

	

		color: #DDD;

	}

	
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
				if(isset($_POST['name1']))

            {
			
			$name1=mysql_real_escape_string($_POST['name1']);
			$rate=mysql_real_escape_string($_POST['rate1']);
			$quantity=mysql_real_escape_string($_POST['quantity1']);
			$customer=mysql_real_escape_string($_POST['customer1']);
			$address=mysql_real_escape_string($_POST['address1']);
			$contact1=mysql_real_escape_string($_POST['contact1']);
			$contact2=mysql_real_escape_string($_POST['contact2']);
			$total=mysql_real_escape_string($_POST['total']);
			$username=$_SESSION['username'];
			
			$count = $db->countOf("stock_avail", "name='$name1'");
			$selected_date=$_POST['date'];
		  	$selected_date=strtotime( $selected_date );
			$mysqldate = date( 'Y-m-d H:i:s', $selected_date );
			$username = $_SESSION['username'];
			
			if($count==1)
			{
			
			   $max = $db->maxOfAll("id", "stock_sales");
					  $max=$max+1;
					  $autoid="SA".$max."";
			  
			$db->query("insert into stock_sales (transactionid,stock_name,selling_price,quantity,amount,date,username,customer_id) values(' $autoid','$name1',$rate,$quantity,$total,'$mysqldate','$username','$customer')");
			echo "<br><font color=green size=+1 >New Sales Added ! Transaction ID [ $autoid ]</font>" ;
			
			
			$amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1'");
				$amount1 = $amount - $quantity;
				$db->execute("UPDATE stock_avail SET quantity=$amount1 WHERE name='$name1'");
			echo "<br><font color=green size=+1> Current Stock Availability is  [ $amount1 ]</font>" ;	
			$count1 = $db->countOf("customer_details", "customer_name='$customer'");
			if($count!=1)
			{
			if($db->query("insert into customer_details values(NULL,'$customer','$address','$contact1','$contact2')"))
			echo "<br><font color=green size=+1 > [ $name ] Customer Details Updated !</font>" ;
			}
			}
			else 
			{
				echo "<br><font color=green size=+1 >Stock Not Available!</font>" ;
			}
			
			
			}
				if(isset($_GET['id']))
				{
				
				$id=$_GET['id'];
				
				
				$line = $db->queryUniqueObject("SELECT * FROM stock_entries WHERE id=$id");
				?>
				
				
				
				<br>
<br>

				
				<form name="form1" method="post" id="form1" action="">
                  
                  <p align="center"><strong>Update Sales Entry </strong> - Add New ( Control +A)</p>
                  <table width="600"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="165">&nbsp;</td>
                      <td width="135">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="165">&nbsp;</td>
                      <td width="135">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150">ID <?php
					  $max = $db->maxOfAll("id","stock_sales");
					  $max=$max+1;
					  $autoid="SA".$max."";
					  ?></td>
					  <td width="165"><input name="id" type="text" id="id" readonly="" value="<?php echo $autoid; ?>"></td>
					  <td width="135">Date</td>
					 
                      <td width="150"> <input type="text" id="datefield" name="date" class="date_input" value="<?php echo date('d-m-Y');?>"></td>
                    </tr>
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="165">&nbsp;</td>
                      <td width="135">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="150"><strong>Name</strong></td>
                      <td width="165"><input name="name1" type="text" id="singleBirdRemote" class="validate[required,length[0,100]] text-input"></td>
                      <td width="135">Available Stock </td>
                      <td width="150"><input name="availstock" type="text" id="availstock" readonly="" value=""></td>
                    </tr>
                    <tr>
                      <td width="150">&nbsp;</td>
                      <td width="165">&nbsp;</td>
                      <td width="135">&nbsp;</td>
                      <td width="150">&nbsp;</td>
                    </tr>
                    <tr>
                      <td><strong>Quantity</strong></td>
                      <td><input name="quantity1" type="text" id="quantity"   class="validate[required,custom[onlyNumber],lengthCheck[6],confirmMatch[quantity]] text-input"  ></td>
                      <td><strong>Rate:</strong></td>
                      <td><input name="rate1" type="text" id="rate"  class="validate[required,custom[onlyNumber],lengthCheck[6]] text-input" ></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><strong>Customer</strong></td>
                      <td><input name="customer1" type="text" id="customer"  value="" ></td>
                      <td>Address</td>
                      <td><textarea name="address1" id="address"></textarea></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Contact1</td>
                      <td><input name="contact1" type="text" id="contact1"  value="" ></td>
                      <td>Contact2</td>
                      <td><input name="contact2" type="text" id="contact2"  value="" ></td>
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
                      <td><strong>Total:</strong></td>
                      <td><input name="total" type="text" id="total" readonly="" value=""></td>
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
                </form></td>
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