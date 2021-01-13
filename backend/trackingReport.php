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
  <p>Financial Collection Report</p>
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
		 $totalPrice = 0;
		 if(isset($_POST["trackSubmit"])){//for funds collection report
			$sid = $_POST['shipId'];
			
			$query1 = "select * from non_stamped_shipment where s_id = $sid";
			$compile1 = oci_parse($con, $query1); 
			oci_execute($compile1);	
			$shipment = oci_fetch_row($compile1);
			
			$query2 = "select * from receiver_non_stamped where s_id = $sid";
			$compile2 = oci_parse($con, $query2); 
			oci_execute($compile2);	
			$receiver = oci_fetch_row($compile2);
			
			$query3 = "select * from order where s_id = $sid";
			$compile3 = oci_parse($con, $query3); 
			oci_execute($compile3);	
			$order = oci_fetch_row($compile3);
			$branchid = $order[5]; 
			
			$query4= "select Address from post_office where branch_no = $branchid";
			$compile4 = oci_parse($con, $query4); 
			oci_execute($compile4);	
			$originAdd = oci_fetch_row($compile4);
			
			print "<h2>Shipment Details:</h2>";
			print "Origin: $originAdd[0]</br></br>";
			print "Destination: $receiver[3]</br></br>";
			print "Booking Date: $order[3]</br></br>";
			
			$query5 = "select * from order where s_id = $sid";
			$compile5 = oci_parse($con, $query5); 
			oci_execute($compile5);	
			$trackHis = oci_fetch_row($compile5);		

			print "<h2>Tracking History:</h2>";
			print "<table>";
			print "<tr>";
			print "<td>Date</td>";
			print "<td>Status</td>";
			print "<td></td>";
			print "</tr>";
			$query = "SELECT EXTRACT(month FROM order_date),COUNT(order_date),sum(price)
						FROM order
						where EXTRACT(year from order_date) = $year and branch_id = $branchid
						GROUP BY EXTRACT(month FROM order_date)";/////idhr comparison ki query likhni hai
			$compile = oci_parse($con, $query); 
			oci_execute($compile);	
			$totalAmount =0;
			$totalCollectionNum =0;
			while($r = oci_fetch_row($compile))
		 {
			$totalAmount = $totalAmount + $r[2];
			$totalCollectionNum = $totalCollectionNum + $r[1];
			print "<tr>";
			print "<td>$r[0]</td>";
			print "<td>$r[1]</td>";
			print "<td>$r[2]</td>";
			print "</tr>";
		 }
		}
		print "<tr>";
		print "<td><label>Total:</label></td>";
		print "<td>$totalCollectionNum</td>";
		print "<td>$totalAmount</td>";
		print "</tr>";
		 print"</table>";
      } 
   else 
      {
		  die('Could not connect to Oracle: '); 
      }
?>	
</div>
	
</body>
</html>