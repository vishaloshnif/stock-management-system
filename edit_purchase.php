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
<META Http-Equiv="Cache-Control" Content="no-cache">
<META Http-Equiv="Pragma" Content="no-cache">
<META Http-Equiv="Expires" Content="0"> 
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" title="no title" charset="utf-8" />
		<script src="js/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="jquery.date_input.js"></script>
<link rel="stylesheet" href="date_input.css" type="text/css">
<script type="text/javascript">$(function() {
  $("#datefield").date_input();
   $("#due").date_input();
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
	
	


	
	
	$("#supplier").autocomplete("supplier1.php", {
		width: 160,
		autoFill: true,
		selectFirst: false
	});
	

	
});


</script>

		<script type="text/javascript" src="lib/jquery-ui-1.7.2.custom.min.js"></script>
		<script type="text/javascript" src="jquery-dynamic-form.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){	
				$("#duplicate").dynamicForm("#plus", "#minus", {limit:50, createColor: 'yellow',removeColor: 'red'});
				
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
		
		function callAutoComplete(idname)
	{
	
	$("#"+idname).autocomplete("stock.php", {
		width: 160,
		autoFill: true,
		mustMatch: true,
		selectFirst: false
	});
	
	
	
	}
	
	
	function checkDublicateName()
	{	var k=0;
				for (i=0;i<=400;i=i+6)
					{
					if($("#0"+i).length>0)
					{		$k=0;
							 for (j=0;j<=400;j=j+6)
							{
							if($("#0"+j).length>0 && $("#0"+i).val()==$("#0"+j).val())
							{
							 $k++;
							 
							}
							}
						if($k>1)
					{
					alert("Dublicate stock Entry. please remove new and add stock in existing one !");
					
					}
				 	 
					}
					}
					
					
					
					
					
	}

	function callAutoAsignValue(idname)
	{
			
			 var name1 = parseInt(idname,10);
			 var quantity1 = name1+1;
			 var brate1 =  quantity1+1;
			 var srate1 =  brate1+1;
			 var avail1 = srate1+1;
			 var total1 = avail1+1;
			
			 if(parseInt(idname)>0)
			 {
			 quantity1="00"+quantity1;
			 brate1="000"+brate1;
			 srate1="0000"+srate1;
			 avail1="00000"+avail1;
			 total1="000000"+total1;
			 
			 }
			 else
			 {
			  quantity1="00";
			  brate1="000";
			  srate1="0000";
			  avail1="00000";
			  total1="000000";
			  
			 }
			 
				
		$.post('check_stock_details.php', {stock_name: $("#"+idname).val() },
				function(data){
				
								// if(data=='no') //if username not avaiable
		 						// {
								//  $("#category").focus();
								// }
															
								$("#"+brate1).val(data.buyingrate);
								$("#"+srate1).val(data.sellingprice);
								$("#"+avail1).val(data.available);
								$("#quantity").focus();
							}, 'json');
							
							
						checkDublicateName();	
							
	}
	
	
	function callQKeyUp(Qidname)
	{		
	
			
			 
			 var quantity = parseInt(Qidname,10);
			 var brate =  quantity+1;
			 var srate =  brate+1;
			 var avail = srate+1;
			 var total = avail+1;
			 var rowcount = parseInt((total+1)/5);
			 if(rowcount==0)
			 rowcount=1;
			
			 if(parseInt(Qidname)>0)
			 {
			 quantity="00"+quantity;
			 brate="000"+brate;
			 srate="0000"+srate;
			 avail="00000"+avail;
			 total="000000"+total
			 }
			 else
			 {
			  quantity="00";
			  brate="000";
			  srate="0000";
			  avail="00000";
			  total="000000";
			  
			  
			 }
			var result= parseFloat($("#"+quantity).val()) * parseFloat( $("#"+brate).val() );
			result=result.toFixed(2);
			$("#"+total).val(result);
			updateSubtotal();
			
	}
	function balanceCalc()
	{		if(parseFloat($("#payment").val()) > parseFloat($("#subtotal").val()))
			$("#payment").val(parseFloat($("#subtotal").val()));
			
			var result= parseFloat($("#subtotal").val()) - parseFloat( $("#payment").val() );
			result=result.toFixed(2);
			$("#balance").val(result);
	}
	function updateSubtotal()
	{					
					var temp=0;
					for (i=5;i<=400;i=i+6)
					{
					if($("#000000"+i).length>0)
					{
					 temp=parseFloat(temp)+parseFloat($("#000000"+i).val());
				 	 
					}
					}
				
			
			var subtotal=parseFloat(temp);
			
			if($("#000000").length>0)
			{
			var firstrowvalue=$("#000000").val();
			
			subtotal=parseFloat(subtotal)+parseFloat(firstrowvalue);
			}
			subtotal=subtotal.toFixed(2);
			$("#subtotal").val(subtotal);
			
			
	}
	
	function callRKeyUp(Ridname)
	{
			 var brate = parseInt(Ridname,10);
			 var quantity =  brate-1;
			 var srate =  brate+1;
			 var avail = srate+1;
			 var total = avail+1;
			 
			 
			 callQKeyUp(brate-1)
			 /*
			 if(parseInt(Ridname)>0)
			 {
			 quantity="00"+quantity;
			 brate="000"+brate;
			 srate="0000"+srate;
			 avail="00000"+avail;
			 total="000000"+total
			 
			 }
			 else
			 {
			  quantity="00";
			  brate="000";
			  srate="0000";
			  avail="00000";
			  total="000000";
			  
			 }
			
			var result= parseFloat($("#"+quantity).val()) * parseFloat( $("#"+brate).val() );
			result=result.toFixed(2);
			$("#"+total).val(result);
			
			updateSubtotal();
	*/
	
	}
		
		
		$(document).ready(function() {
			// SUCCESS AJAX CALL, replace "success: false," by:     success : function() { callSuccessFunction() }, 
			 $("#billnumber").focus();
			
			/*$("#"+quantity).keyup(function (e) {
			
			$("#"+total).val( parseInt( $("#"+qunatity).val()) * parseInt( $("#"+rate).val() ));
			if(parseInt($("#"+quantity).val()) > parseInt($("#"+avail).val()))
			$("#"+quantity).val(parseInt($("#"+avail).val()));
			
			});
			
			$("#"+rate).keyup(function (e) {
			
			$("#"+total).val( parseInt($("#"+quantity).val()) * parseInt($("#"+rate).val()) );
			if(parseInt($("#"+quantity).val()) > parseInt($("#"+avail).val()))
			$("#"+quatity).val(parseInt($("#"+avail).val()));
			
			});
				*/
			
			 $("#supplier").blur(function()
			{
			 
							
			 $.post('check_supplier_details.php', {stock_name1: $(this).val() },
				function(data){
				
								$("#address").val(data.address);
								$("#contact1").val(data.contact1);
								$("#contact2").val(data.contact2);
								if(data.address!=undefined)
								$("#0").focus();
								
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
			window.location = "add_purchase.php";
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
			
			jQuery(document).bind('keyup', 'Ctrl+down',function() {
			$('#plus').click();
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
            <td height="500" align="left" valign="top"><table width="960" border="0" cellpadding="0" cellspacing="0" bgcolor="#ECECEC">
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
			$billnumber=mysql_real_escape_string($_POST['billnumber']);
			$autoid=mysql_real_escape_string($_POST['id']);
			
			$supplier=mysql_real_escape_string($_POST['supplier']);
			$address=mysql_real_escape_string($_POST['address1']);
			$contact1=mysql_real_escape_string($_POST['contact1']);
			$contact2=mysql_real_escape_string($_POST['contact2']);
			$payment=mysql_real_escape_string($_POST['payment']);
			$balance=mysql_real_escape_string($_POST['balance']);
				$temp_balance = $db->queryUniqueValue("SELECT balance FROM supplier_details WHERE supplier_name='$supplier'");
				$temp_balance = (int) $temp_balance + (int) $balance;
				$db->execute("UPDATE supplier_details SET balance=$temp_balance WHERE supplier_name='$supplier'");
			$selected_date=$_POST['due'];
		  	$selected_date=strtotime( $selected_date );
			$mysqldate = date( 'Y-m-d H:i:s', $selected_date );
			$due=$mysqldate;
			$mode=mysql_real_escape_string($_POST['mode']);
			$description=mysql_real_escape_string($_POST['description']);
			
			$namet=$_POST['name'];
			$quantityt=$_POST['quanitity'];
			$bratet=$_POST['brate'];
			$sratet=$_POST['srate'];
			$totalt=$_POST['total'];
			
			$subtotal=mysql_real_escape_string($_POST['subtotal']);
			
			$username=$_SESSION['username'];
			
			$i=0;
			$j=1;
			$username = $_SESSION['username'];
					
		$selected_date=$_POST['date'];
		  	$selected_date=strtotime( $selected_date );
			$mysqldate = date( 'Y-m-d H:i:s', $selected_date );
			
			  foreach($namet as $name1)
			   {
			   
			$quantity=$_POST['quantity'][$i];
			$brate=$_POST['brate'][$i];
			$srate=$_POST['srate'][$i];
			$total=$_POST['total'][$i];
			$sysid=$_POST['sysid'][$i];
			
			
			$count = $db->countOf("stock_avail", "name='$name1'");
			if($count == 0)
			{
			$db->query("insert into stock_avail(name,quantity) values('$name1',$quantity)");
			echo "<br><font color=green size=+1 >New Stock Entry Inserted !</font>" ;
			   
			$db->query("insert into stock_details(stock_id,stock_name,stock_quatity,supplier_id,company_price,selling_price) values('$autoid','$name1',0,'$suplier',$brate,$srate)");
			 
			  
			
			
			$db->query("UPDATE stock_entries SET stock_name='$name1', stock_supplier_name='$supplier', quantity=$quantity, company_price=$brate, selling_price=$srate, opening_stock=0, closing_stock=$quantity, date='$mysqldate', username='$username', type='entry', total=$total, payment=$payment, balance=$balance, mode='$mode', description='$description', due='$due', subtotal=$subtotal,billnumber='$billnumber' WHERE stock_id='$autoid' AND count1=$j"); 
			
			}
			
			else if($count==1) 
			{
				$amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1'");
				$oldquantity = $db->queryUniqueValue("SELECT quantity FROM stock_entries WHERE stock_id='$autoid' AND count1=$j");
				$amount1 = ($amount + $quantity) - $oldquantity;
				if($quantity > $oldquantity)
				{
				$difference = $quantity - $oldquantity;
				$result = $db->query("SELECT opening_stock,closing_stock FROM stock_entries WHERE id > $sysid");
				while ($line10 = $db->fetchNextObject($result)) {
				
				$old_opening_stock = $line10->opening_stock;
				$new_opening_stock = $old_opening_stock + $difference;
				
				$old_closing_stock = $line10->closing_stock;
				$new_closing_stock = $old_closing_stock + $difference;
				
				
				$db->execute("UPDATE stock_entries SET opening_stock=$new_opening_stock,closing_stock=$new_closing_stock WHERE id=$line10->id");

				}
				
				}
				
				
					if($quantity < $oldquantity)
				{
				$difference = $oldquantity - $quantity ;
				$result = $db->query("SELECT opening_stock,closing_stock FROM stock_entries WHERE id > $sysid");
				while ($line10 = $db->fetchNextObject($result)) {
				
				$old_opening_stock = $line10->opening_stock;
				$new_opening_stock = $old_opening_stock - $difference;
				
				$old_closing_stock = $line10->closing_stock;
				$new_closing_stock = $old_closing_stock - $difference;
				
				
				$db->execute("UPDATE stock_entries SET opening_stock=$new_opening_stock,closing_stock=$new_closing_stock WHERE id=$line10->id");

				}
				
				}
				
				$db->execute("UPDATE stock_avail SET quantity=$amount1 WHERE name='$name1'");
			$db->query("UPDATE stock_entries SET stock_name='$name1', stock_supplier_name='$supplier', quantity=$quantity, company_price=$brate, selling_price=$srate, opening_stock=$amount, closing_stock=$amount1, date='$mysqldate', username='$username', type='entry', total=$total, payment=$payment, balance=$balance, mode='$mode', description='$description', due='$due', subtotal=$subtotal,billnumber='$billnumber' WHERE stock_id='$autoid' AND count1=$j"); 
			//INSERT INTO `stock`.`stock_entries` (`id`, `stock_id`, `stock_name`, `stock_supplier_name`, `category`, `quantity`, `company_price`, `selling_price`, `opening_stock`, `closing_stock`, `date`, `username`, `type`, `salesid`, `total`, `payment`, `balance`, `mode`, `description`, `due`, `subtotal`, `count1`) 
			//VALUES (NULL, '$autoid1', '$name1', '$supplier', '', '$quantity', '$brate', '$srate', '$amount', '$amount1', '$mysqldate', 'sdd', 'entry', 'Sa45', '432.90', '2342.90', '24.34', 'cash', 'sdflj', '2010-03-25 12:32:02', '45645', '1');
			
			
				
			
			}
			
			
				
			
			
			
			
			
			$i++;
			$j++;
			}
				echo "<br><font color=green size=+1 >Parchase order Updated successfully Ref: [ $autoid] !</font>" ;
				
				
				
				}
				?>
				
				<br>
<br>

				
				
                  
                  <p align="center"><strong>Add New Purchase Entry </strong> - Add New ( Control +A)<?php

if(isset($_GET['id']))
				{
				
				$id=$_GET['id'];
				
				
				$line = $db->queryUniqueObject("SELECT * FROM stock_entries WHERE stock_id='$id'");			
				
				?>

<form action="edit_purchase.php" method="post" name="edit" onSubmit="updateSubtotal()" >

				 
                  <table width="800"  border="0" cellspacing="0" cellpadding="0"  >
                    <tr>
                      <td width="61">&nbsp;</td>
                      <td width="110">&nbsp;</td>
                      <td width="15">&nbsp;</td>
                      <td width="76">&nbsp;</td>
                      <td width="171">&nbsp;</td>
                      <td width="74">&nbsp;</td>
                      <td width="111">&nbsp;</td>
                      <td width="77">&nbsp;</td>
                      <td width="105">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="61">&nbsp;</td>
                      <td width="110">&nbsp;</td>
                      <td width="15">&nbsp;</td>
                      <td width="76">&nbsp;</td>
                      <td width="171">&nbsp;</td>
                      <td width="74">&nbsp;</td>
                      <td width="111">&nbsp;</td>
                      <td width="77">&nbsp;</td>
                      <td width="105">&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="61">&nbsp;</td>
					  <td width="110">&nbsp;</td>
					  <td>&nbsp;</td>
					  <td><div align="left"><strong>ID</strong>
                              
                      </div></td>
					  <td><input name="id" type="text" id="id" readonly="" value="<?php echo $line->stock_id; ?>" style="width:50px;">
					  
					  </td>
					  <td><div align="left"><strong>Date</strong></div></td>
					  <td><input type="text" id="datefield" name="date" class="date_input" value="<?php 
					  
					  
 		$phpdate = strtotime( $line->date );

 		$phpdate = date("d-m-Y",$phpdate);
		echo $phpdate;
?>" style="width:70px;"></td>
					  <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="61">&nbsp;</td>
                      <td width="110">&nbsp;</td>
                      <td width="15"><div align="left"></div></td>
                      <td width="76">&nbsp;</td>
                      <td width="171"><div align="left"></div></td>
                      <td width="74">&nbsp;</td>
                      <td width="111"><div align="left"></div></td>
                      <td width="77">&nbsp;</td>
                      <td width="105">&nbsp;</td>
                    </tr>
                    <tr>
                      <td><div align="center"><strong>Bill No</strong></div></td>
                      <td><input type="text" name="billnumber" style="width:100px;" id="billnumber" class="validate[required,length[0,100]] text-input" value="<?php echo $line->billnumber; ?>"></td>
                      <td>&nbsp;</td>
                      <td><div align="left"><strong>Supplier</strong></div></td>
                      <td><input name="supplier" type="text" id="supplier"   style="width:100px;" autocomplete="off" value="<?php echo $line->stock_supplier_name; ?> "></td>
                      <td><div align="left">Address</div></td>
                      <td><textarea name="address1" id="address" style="width:100px;"><?php echo $db->queryUniqueValue("SELECT supplier_address FROM supplier_details WHERE supplier_name='$line->stock_supplier_name'"); ?></textarea></td>
                      <td><div align="left">Contact1<br>
                              <br>
                        Contact2</div></td>
                      <td><input name="contact1" type="text" id="contact1"  value="<?php echo $db->queryUniqueValue("SELECT supplier_contact1 FROM supplier_details WHERE supplier_name='$line->stock_supplier_name'"); ?>" style="width:80px;">
                          <br>
                          <br>
                          <input name="contact2" type="text" id="contact2"  value="<?php echo $db->queryUniqueValue("SELECT supplier_contact2 FROM supplier_details WHERE supplier_name='$line->stock_supplier_name'"); ?>" style="width:80px;" ></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><div align="left"></div></td>
                      <td>&nbsp;</td>
                      <td><div align="left"></div></td>
                      <td>&nbsp;</td>
                      <td><div align="left"></div></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                   </table>

                  <br>
					<?php 
					$max = $db->maxOf("count1", "stock_entries", "stock_id='$id'");
					$j=0;
					for($i=1; $i<=$max; $i++)
					{
					
					?>
					<table width="800" border="0" cellspacing="0" cellpadding="0"  style="margin-left:20px;">
  						<tr>
                      <td ><div align="center"><strong>Name</strong></div></td>
                      <td >
					  <input name="sysid[]" type="hidden" value="<?php echo $line->id; ?>">
					  <input name="name[]" type="text" class="validate[required,length[0,100]] text-input" id="0<?php echo 0+$j;?>"   style="width:100px;" onFocus="callAutoComplete(this.id)"  onBlur="callAutoAsignValue(this.id)" autocomplete="off" value="<?php 
					  $line1 = $db->queryUniqueObject("SELECT * FROM stock_entries WHERE stock_id='$id' and count1=$i");	
					  echo $line1->stock_name;
					  ?>"></td>
                      <td><div align="left"><strong>Qty</strong></div></td>
                      <td><input name="quantity[]" type="text" id="00<?php echo 1+$j;?>"   class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input"  style="width:50px;" onKeyUp="callQKeyUp(this.id)" value="<?php echo $line1->quantity;?>"></td>
                      <td><div align="left"><strong>Buy Rate:</strong></div></td>
                      <td><input name="brate[]" type="text" id="000<?php echo 2+$j;?>"  class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input"  style="width:50px;" onKeyUp="callRKeyUp(this.id)"  value="<?php echo $line1->company_price;?>" ></td>
					  <td>Sales Rate </td>
					  <td><input name="srate[]" type="text" id="0000<?php echo 3+$j;?>"  class="validate[optional,custom[onlyFloat],lengthCheck[6]] text-input"  style="width:50px;" value="<?php echo $line1->selling_price;?>"   ></td>
					  <td>Avail Qty</td>
						<td><input name="avail[]" type="text" id="00000<?php echo 4+$j;?>" readonly="" value="<?php echo $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$line1->stock_name'");?>" style="width:50px;" ></td>
                      <td><div align="left"><strong>Total:</strong></div></td>
                      <td><input name="total[]" type="text" id="000000<?php echo 5+$j;?>" readonly="" value="<?php echo $line1->total;?>" style="width:100px;text-align:right;" >  </td>
                      
                    </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						
					  </tr>
					  </table>
					  
					  <?php
					  $j=$j+6;
					  }
					  ?>
					  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0"  id="duplicate" style="margin-left:20px;">
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td width="103">&nbsp;</td>
						<td width="140">&nbsp;</td>
						<td width="5">&nbsp;</td>
						<td width="5">&nbsp;</td>
						<td width="5">&nbsp;</td>
						<td width="13">&nbsp;</td>
					  </tr>
					  <tr>
						<td>Payment:</td>
						<td><input type="text" name="payment" style="width:100px; " id="payment" class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input" onKeyUp="balanceCalc()" value="<?php echo $line->payment; ?>" ></td>
						<td><div align="left">Description</div></td>
						<td rowspan="2"><textarea name="description" style="width:150px; height:40px; "><?php echo $line->description; ?></textarea></td>
						<td>&nbsp;</td>
						<td><div align="center"><strong>Sub Total </strong></div></td>
						<td><input name="subtotal" id="subtotal" type="text" readonly="" value="<?php echo $line->subtotal; ?>" style="width:100px; text-align:right; color:#333333; font-weight:bold; font-size:16px;"><img src="images/refresh.png" alt="Refresh" align="absmiddle" onClick="updateSubtotal()"></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td>Balance:</td>
						<td><input name="balance" type="text" id="balance" style="width:100px; " value="<?php echo $line->balance; ?>" readonly=""></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><div align="center"></div></td>
						<td>&nbsp;</td>
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
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    </tr>
					  <tr>
						<td width="55">Mode:</td>
						<td width="125"><select name="mode">
						<option value="cheque" <?php if($line->mode=="cheque") echo "selected"; ?> >Cheque</option>
						<option value="cash" <?php if($line->mode=="cash") echo "selected"; ?> >Cash</option>
						<option value="others" <?php if($line->mode=="others") echo "selected"; ?> >others</option>
						
						  </select></td>
						<td width="77">Due Date </td>
						<td width="195"><input type="text" id="due" name="due" class="date_input" value="<?php 
 		$phpdate = strtotime($line->due);

 		$phpdate = date("d-m-Y",$phpdate);
		echo $phpdate;
?>" style="width:70px;"></td>
						<td width="77">&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
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
					    <td>&nbsp;</td>
					    <td><div align="center">
                           
                        </div></td>
					    <td><input type="submit" name="Submit" value="Update" onClick="updateSubtotal()" ></td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    </tr>
					</table>
</form>
<?php
}
?>
				
               
				<br>
<br>
<br>

				
  
  </td>
              </tr>
            </table>		</td>
          </tr>
          <tr>
		  
            <td height="30" align="center" bgcolor="#72C9F4">
			
</div><span class="style1"><a href="http://www.pluskb.com">Developed by PlusKB Innovations</a></span></td>
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