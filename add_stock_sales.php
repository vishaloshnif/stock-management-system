<?php
session_start(); // Use session variable on this page. This function must put on the top of page.
if(!isset($_SESSION['username']) || $_SESSION['password']){ // if session variable "username" does not exist.
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
	
	


	
	
	$("#customer").autocomplete("customer.php", {
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
				for (i=0;i<=400;i=i+5)
					{
					if($("#0"+i).length>0)
					{		$k=0;
							 for (j=0;j<=400;j=j+5)
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
			
			 var rate1 =  quantity1+1;
			 var avail1 = rate1+1;
			 var total1 = avail1+1;
			
			 if(parseInt(idname)>0)
			 {
			 quantity1="00"+quantity1;
			 rate1="000"+rate1;
			 avail1="0000"+avail1;
			 total1="00000"+total1;
			 
			 }
			 		 else
			 {
			  quantity1="00";
			  rate1="000";
			  avail1="0000";
			  total1="00000";
			  
			 }
			 
				 $.post('check_sales_details.php', {stock_name: $("#"+idname).val() },
				function(data){
								
								$("#"+rate1).val(data.rate);
								$("#"+avail1).val(data.availstock);
								$("#"+quantity1).click();
							}, 'json');
							
						checkDublicateName();	
							
	}
	
	
	function callQKeyUp(Qidname)
	{		
	
			
			 
			 var quantity = parseInt(Qidname,10);
			 var rate =  quantity+1;
			 var avail = rate+1;
			 var total = avail+1;
			 var rowcount = parseInt((total+1)/5);
			 if(rowcount==0)
			 rowcount=1;
			
			 if(parseInt(Qidname)>0)
			 {
			 quantity="00"+quantity;
			 rate="000"+rate;
			 avail="0000"+avail;
			 total="00000"+total
			 }
			 else
			 {
			  quantity="00";
			  rate="000";
			  avail="0000";
			  total="00000";
			  
			  
			 }
			var result= parseFloat($("#"+quantity).val()) * parseFloat( $("#"+rate).val() );
			result=result.toFixed(2);
			$("#"+total).val(result);
			if(parseFloat($("#"+quantity).val()) > parseFloat($("#"+avail).val()))
			$("#"+quantity).val(parseFloat($("#"+avail).val()));
			
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
					for (i=4;i<=400;i=i+5)
					{
					if($("#00000"+i).length>0)
					{
					 temp=parseFloat(temp)+parseFloat($("#00000"+i).val());
				 	 
					}
					}
				
			
			var subtotal=parseFloat(temp);
			
			if($("#00000").length>0)
			{
			var firstrowvalue=$("#00000").val();
			
			subtotal=parseFloat(subtotal)+parseFloat(firstrowvalue);
			}
			if(parseFloat($("#tax_amount").val())>0)
			{
				subtotal=subtotal+parseInt($("#tax_amount").val(),10);
			}
			subtotal=subtotal.toFixed(2);
			$("#subtotal").val(subtotal);
			
			
	}
	
	function callRKeyUp(Ridname)
	{
			var rate = parseInt(Ridname,10);
			 var quantity =  rate-1;
			 var avail = rate+1;
			 var total = avail+1;
			 
			 if(parseInt(Ridname)>0)
			 {
			 quantity="00"+quantity;
			 rate="000"+rate;
			 avail="0000"+avail;
			 total="00000"+total
			 
			 }
			 else
			 {
			  quantity="00";
			  rate="000";
			  avail="0000";
			  total="00000";
			  
			 }
			
			var result= parseFloat($("#"+quantity).val()) * parseFloat( $("#"+rate).val() );
			result=result.toFixed(2);
			$("#"+total).val(result);
			if(parseFloat($("#"+quantity).val()) > parseFloat($("#"+avail).val()))
			$("#"+quantity).val(parseFloat($("#"+avail).val()));
			
			updateSubtotal();
	
	}
	
	function calCulateTax(Ridname)
	{
			var taxPercent = parseFloat(Ridname);
			var taxAmount=0;
			if(taxPercent>0)
			{
				taxAmount= parseFloat($("#subtotal").val())*taxPercent/100;
			}
			taxAmount=taxAmount.toFixed(2);
			 $("#tax_amount").val(taxAmount);
			updateSubtotal();
	
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
			
			 $("#customer").blur(function()
			{
			
				 $.post('check_customer_details.php', {stock_name1: $(this).val() },
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
			window.location = "add_stock_sales.php";
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
         <!--Top-->   <td height="90" align="left" valign="top" bgcolor=""><img src="images/topbanner.jpg" width="960" height="82"></td>
          </tr>
          <tr>
            <td height="800" align="left" valign="top"><table width="960" border="0" cellpadding="0" cellspacing="0" bgcolor="#ECECEC">
              <tr>
                <td width="130" align="left" valign="top">
				
				<br>

				<strong>Welcome <font color="#3399FF"><?php echo $_SESSION['username']; ?> !</font></strong><br> <br><table width="100%"  border="0" cellspacing="0" cellpadding="0">
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
    <td align="left" valign="top"><a href="view_customer_details.php"><img src="images/customers.png" width="94" height="22" border="0"></a><br>      
      <a href="view_supplier_details.php"><img src="images/suppliers.png" width="94" height="22" border="0"></a><br>
      <a href="view_payments.php"><img src="images/payments.png" width="94" height="22" border="0"></a></td>
    <td align="left" valign="top"><a href="view_stock_sales_payments.php"><img src="images/outstanding.png" width="94" height="22" border="0"></a><br>      <a href="view_stock_entries_payments.php"><img src="images/pendings.png" width="94" height="22" border="0"></a><br>
      <a href="logout.php"><img src="images/logout.png" width="94" height="22" border="0"></a></td>
  </tr>
</table>
<?php
				if(isset($_POST['billnumber']))

            {
			$billnumber=mysql_real_escape_string($_POST['billnumber']);
			$autoid=mysql_real_escape_string($_POST['id']);
			
			$customer=mysql_real_escape_string($_POST['customer1']);
			$address=mysql_real_escape_string($_POST['address1']);
			$contact1=mysql_real_escape_string($_POST['contact1']);
			$contact2=mysql_real_escape_string($_POST['contact2']);
			$payment=mysql_real_escape_string($_POST['payment']);
			$balance=mysql_real_escape_string($_POST['balance']);
				$temp_balance = $db->queryUniqueValue("SELECT balance FROM customer_details WHERE customer_name='$customer'");
				$temp_balance = (int) $temp_balance +  (int) $balance;
				$db->execute("UPDATE customer_details SET balance=$temp_balance WHERE customer_name='$customer'");
			$selected_date=$_POST['due'];
		  	$selected_date=strtotime( $selected_date );
			$mysqldate = date( 'Y-m-d H:i:s', $selected_date );
			$due=$mysqldate;
			$mode=mysql_real_escape_string($_POST['mode']);
			$description=mysql_real_escape_string($_POST['description']);
			
			$namet=$_POST['name'];
			$quantityt=$_POST['quanitity'];
			$ratet=$_POST['rate'];
			$totalt=$_POST['total'];
			$tax_percent=$_POST['tax_percent'];
			$tax_amount=$_POST['tax_amount'];
			$subtotal=mysql_real_escape_string($_POST['subtotal']);
			
			$username=$_SESSION['username'];
			
			$i=0;
			$j=1;

			  foreach($namet as $name1)
			   {
			   
			$quantity=$_POST['quantity'][$i];
			$rate=$_POST['rate'][$i];
			$total=$_POST['total'][$i];
			
			
			$selected_date=$_POST['date'];
		  	$selected_date=strtotime( $selected_date );
			$mysqldate = date( 'Y-m-d H:i:s', $selected_date );
			$username = $_SESSION['username'];
			
			$count = $db->queryUniqueValue("SELECT count(*) FROM stock_avail WHERE name='$name1' and quantity >=$quantity");
			
			if($count == 1)
			{
			
			 
			  
			$db->query("insert into stock_sales (transactionid,stock_name,selling_price,quantity,amount,date,username,customer_id,tax_percent,tax_amount,subtotal,payment,balance,due,mode,description,count1,address1,contact1,contact2,billnumber) values('$autoid','$name1','$rate','$quantity','$total',curdate(),'$username','$customer','$tax_percent',
																																																																					'$tax_amount','$subtotal','$payment','$balance','$due','$mode','$description','$j' ,'$address','$contact1','$contact2',
'$billnumber')");																																														
																																														                       
																																													
																																				
			
			$amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1'");
				$amount1 = $amount - $quantity;
			
			$db->query("insert into stock_entries (stock_id,stock_name,quantity,opening_stock,closing_stock,date,username,type,salesid,total,selling_price,billnumber) values('$autoid','$name1','$quantity','$amount','$amount1','$mysqldate','$username','sales','$autoid','$total','$rate','$billnumber')");
			//echo "<br><font color=green size=+1 >New Sales Added ! Transaction ID [ $autoid ]</font>" ;
			
			
			$amount = $db->queryUniqueValue("SELECT quantity FROM stock_avail WHERE name='$name1'");
				$amount1 = $amount - $quantity;
				$db->execute("UPDATE stock_avail SET quantity=$amount1 WHERE name='$name1'");
			//echo "<br><font color=green size=+1> Current Stock Availability is  [ $amount1 ]</font>" ;	
			$j++;
			
			}
			else 
			{
				echo "<br><font color=red size=+1 >There is no enough stock deliver for $name1! Please add stock !</font>" ;
			}
			
			
			
			
			
			
			
			
			$i++;
			}
			echo "<div style='background-color:yellow;'><br><font color=green size=+1 >New Sales Added ! Transaction ID [ $autoid ]</font></div> ";
			echo "<script>window.open('add_sales_print.php?sid=$autoid','myNewWinsr','width=620,height=800,toolbar=0,menubar=no,status=no,resizable=yes,location=no,directories=no');</script>";
			$count1 = $db->queryUniqueValue("SELECT count(*) FROM customer_details WHERE customer_name='$customer'");
			if($count1!=1)
			{
			if($db->query("insert into customer_details values(null,'$customer','$address1','$contact1','$contact2','$balance')"))
			echo "<br><font color=green size=+1 > [ $name ] Customer Details Added !</font>" ;
			}
				}
				?>
				
				<br>
<br>

				
				<form name="salesform" method="post" id="form1" action="" onSubmit="updateSubtotal()" >
                  
                  <p align="center"><strong>Add New Sales Entry </strong> - Add New ( Control +A)</p>
				
                  <table width="800"  border="0" cellspacing="0" cellpadding="0"  id="dynamictable">
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
                              <?php
					  $max = $db->maxOfAll("id","stock_sales");
					  $max=$max+1;
					  $autoid="SA".$max."";
					  ?>
                      </div></td>
					  <td><input name="id" type="text" id="id" readonly="" value="<?php echo $autoid; ?>" style="width:50px;"></td>
					  <td><div align="left"><strong>Date</strong></div></td>
					  <td><input type="text" id="datefield" name="date" class="date_input" value="<?php echo date('d-m-Y');?>" style="width:70px;"></td>
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
                      <td><input type="text" name="billnumber" style="width:100px;" id="billnumber" class="validate[required,length[0,100]] text-input"></td>
                      <td>&nbsp;</td>
                      <td><div align="left"><strong>Customer</strong></div></td>
                      <td><input name="customer1" type="text" id="customer"  value="" style="width:100px;" autocomplete="off" ></td>
                      <td><div align="left">Address</div></td>
                      <td><textarea name="address1" id="address" style="width:100px;"></textarea></td>
                      <td><div align="left">Contact1<br>
                              <br>
                        Contact2</div></td>
                      <td><input name="contact1" type="text" id="contact1"  value="" style="width:80px;">
                          <br>
                          <br>
                          <input name="contact2" type="text" id="contact2"  value="" style="width:80px;" ></td>
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

					<table width="800" border="0" cellspacing="0" cellpadding="0"  id="duplicate" style="margin-left:20px;">
  						<tr>
                      <td ><div align="center"><strong>Pro.Name</strong></div></td>
                      <td ><input name="name[]" type="text" class="validate[required,length[0,100]] text-input" id="0"   style="width:100px;" onClick="callAutoComplete(this.id)" onBlur="callAutoAsignValue(this.id)" autocomplete="off"/></td>
                      <td><div align="left"><strong>Quantity</strong></div></td>
                      <td><input name="quantity[]" type="text" id="00"class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input"  style="width:50px;"   onKeyUp="callQKeyUp(this.id)"/></td>
                      <td><div align="left"><strong>Rate:</strong></div></td>
                      <td><input name="rate[]" type="text" id="000"  class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input"  style="width:50px;" onKeyUp="callRKeyUp(this.id)"/></td>
					  <td>Avail Qty</td>
						<td><input name="avail[]" type="text" id="0000" readonly="" value="" style="width:50px;"/></td>
                      <td><div align="left"><strong>Total:</strong></div></td>
                      <td><input name="total[]" type=" text" id="00000" readonly="" value="" style="width:100px;text-align:right;" />  </td>
                      <td width="50"><p><span><a id="minus" href=""  >[-]</a> <a id="plus" href="">[+]</a></span></p></td>
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
                      
					  </table>
					  <table width="800" border="0" align="center" cellpadding="0" cellspacing="0"  id="duplicate" style="margin-left:20px;">
					  <tr>
						<td>Tax(%)</td>
						<td><input type="text" maxlength="3" onKeyUp="calCulateTax(this.value);"  name="tax_percent" id="tax_percent" style="width:100px"/></td>
						<td>Tax Amount:</td>
						<td><input type="text" id="tax_amount" name="tax_amount" ></td>
						<td>&nbsp;</td>
						<td><div align="center"><strong>Sub Total </strong></div></td>
                        <td>
                        <input id="subtotal" name="subtotal"type="text" readonly=""  style="width:100px; text-align:right; color:#333333; font-weight:bold; font-size:16px;"><img src="images/refresh.png" alt="Refresh" align="absmiddle" onClick="updateSubtotal()"></td>
						<td width="5">&nbsp;</td>
						<td width="5">&nbsp;</td>
						<td width="5">&nbsp;</td>
						<td width="13">&nbsp;</td>
					  </tr>
					  <tr>
						<td>Payment:</td>
						<td><input type="text" name="payment" style="width:100px; " id="payment" class="validate[required,custom[onlyFloat],lengthCheck[6]] text-input" onKeyUp="balanceCalc()"></td>
						<td><div align="left">Description</div></td>
						<td rowspan="2"><textarea name="description" style="width:150px; height:40px; "></textarea></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
                        
                        
           
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td>Balance:</td>
						<td><input name="balance" type="text" id="balance" style="width:100px; " value="0.00" readonly=""></td>
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
						<option value="cheque">Cheque</option>
						<option value="cash" selected>Cash</option>
						<option value="others">others</option>
						
						  </select></td>
						<td width="77">Due Date </td>
						<td width="195"><input type="text" id="due" name="due" class="date_input" value="<?php echo date('d-m-Y');?>" style="width:70px;"></td>
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
                            <input type="button" name="Reset" value="Reset" >
                        </div></td>
					    <td><input type="submit" name="Submit" value="Save" onClick="updateSubtotal()" ></td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    <td>&nbsp;</td>
					    </tr>
					</table>
				
                </form></td>
              </tr>
            </table>
			
		</td>
          </tr>
          <tr>
            <td height="30" align="center" bgcolor="#72C9F4" ><span class="style1"><a href="http://www.Oshnif.com" style="color:#FFF; font-weight:bolder">Developed by Oshnif Technologies Pvt .Ltd </a></span></td>
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