<!DOCTYPE html>
<html lang="en">
<head>
<title>INVOICE</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Style the body */
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

/* Header/logo Title */
.header {
  padding: 80px;
  text-align: center;
  background: #3FA512;
  color: white;
}

/* Increase the font size of the heading */
.header h1 {
  font-size: 40px;
}

/* Sticky navbar - toggles between relative and fixed, depending on the scroll position. It is positioned relative until a given offset position is met in the viewport - then it "sticks" in place (like position:fixed). The sticky value is not supported in IE or Edge 15 and earlier versions. However, for these versions the navbar will inherit default position */
.navbar {
  overflow: hidden;
  background-color: #333;
  position: sticky;
  position: -webkit-sticky;
  top: 0;
}

/* Style the navigation bar links */
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}


/* Right-aligned link */
.navbar a.right {
  float: right;
}

/* Change color on hover */
.navbar a:hover {
  background-color: #ddd;
  color: black;
}

/* Active/current link */
.navbar a.active {
  background-color: #666;
  color: white;
}

/* Column container */
.row {  
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
  -ms-flex: 30%; /* IE10 */
  flex: 30%;
  background-color: #f1f1f1;
  padding: 20px;
}

/* Main column */
.main {   
  -ms-flex: 70%; /* IE10 */
  flex: 70%;
  background-color: white;
  padding: 20px;
}

/* Fake image, just for this example */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: left;
  background: #ddd;
}

/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
  .row {   
    flex-direction: column;
  }
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
  .navbar a {
    float: none;
    width: 100%;
  }
}
</style>
</head>
<body>

<div class="header">
  <h1>Pakistan Post Online Portal</h1>
  <p>Invoice</p>
</div>

<div class="navbar">
	<a href="First_Page.php">Home</a> 
	<a href="loginPage.html" class = 'right'>Logout</a>  
</div>

<div class="row">
  <div class="main">
  </div>
</div>

<div class="footer">
	
	<?php

	$db_sid = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-B029F5B)(PORT = 1522))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = bilal)))";
    $db_user = "Postoffice"; 
    $db_pass = "fast123";
     
      $con = oci_connect($db_user,$db_pass,$db_sid); 
      if($con) 
      { 
		 $query=" select value from vartable where varno = 1";
		 $a = oci_parse($con, $query); 
		 oci_execute($a);
		 $oid = oci_fetch_row($a);
		 
		 $query1 = "select * from order2 where O_ID = $oid[0]-1";
		 $compile1 = oci_parse($con, $query1); 
		 oci_execute($compile1);
		 ?>
		 <html>
		  <h1> INVOICE </h1>
		 
			<table border= true>
			<tr>
				<td>
					<label>order ID</label>
				</td>
				<td>
					<label>Shipment ID</label>
				</td>
				<td>
					<label>Customer ID</label>
				</td>
				<td>
					<label>order Placement Date</label>
				</td>
				<td>
					<label>Arrival Date</label>
				</td>
				<td>
					<label>Branch</label>
				</td>
				<td>
					<label>Price</label>
				</td>
			</tr>
		 </html>
		 <?php
		 $totalPrice = 0;
		 while($r = oci_fetch_row($compile1))
		 {
			print "<tr>";
			print "<td>$r[0]</td>";
			print "<td>$r[1]</td>";
			print "<td>$r[2]</td>";
			print "<td>$r[3]</td>";
			print "<td>$r[4]</td>";
			print "<td>$r[5]</td>";
			print "<td>$r[6]</td>";
			print "</tr>";
			$totalPrice = $totalPrice+$r[6];
		 }
		 print"</table>";
		 print "<tr>
		 <td><label>Total Price: </label></td>
		 <td>$totalPrice</td>
		 </tr>";
      } 
   else 
      {
		  die('Could not connect to Oracle: '); 
      }
?>	
</div>
	
</body>
</html>