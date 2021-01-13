<!DOCTYPE html>
<html lang="en">
<head>
<title>New Customer</title>
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
  <h1>Update Status</h1>
  <p></p>
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
	<form name = "updateStatus" action = "action.php" method = "POST">
	<table>
		<tr>
			<td>
			<label>ShipmentId: </label>
			</td>
			<td>
			<?php
				$db_sid = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-B029F5B)(PORT = 1522))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = bilal)))";
				$db_user = "Postoffice"; 
				$db_pass = "fast123";
				 
				  $con = oci_connect($db_user,$db_pass,$db_sid); 
				  if($con){ 
						echo "<select  name = 'shipId'>";
						$query = "select s_id from non_stamped_shipment";
						$compile = oci_parse($con, $query); 
						oci_execute($compile);
						while($r = oci_fetch_row($compile))
						{
							$temp = $r[0];
							echo "<option value = $temp>".$temp."</option>";
							
						}
						echo "</select>";
				  }
				  ?>
			</td>
		</tr>
		<tr>
			<td>
			<label>New Status: </label>
			
			</td>
			<td>
				<select name = "status">
					<option value="order placed">order placed</option>
					<option value="enroute">enroute</option>
					<option value="order delivered">order delivered</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="Submit" name= "statusUpdate" id="statusUpdate">
			</td>
		</tr>
	</table>
 
</form>



  
  
</div>

</body>
</html>

