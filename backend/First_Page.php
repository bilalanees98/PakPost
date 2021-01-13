<!DOCTYPE html>
<html lang="en">
<head>
<title>PPost Home</title>
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
  text-align: center;
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
<?php 
	session_start();
	$_SESSION["branchno"] = "12";?>
<div class="header">
  <h1>Pakistan Post Online Portal</h1>
  <p>A service provided by Hyder, Furrukh, Shayaan and Bilal</p>
</div>

<div class="navbar">
  <a href="First_Page.php">Home</a>
  <a href="newOrOld.html">Place order</a>
  <a href="trackingForm.php">Track order</a>
  <a href="updateStatus.php" >Update Shipment Status</a>
  <a href="stampedShipment.html">Add stamped shipment</a>
 
  
  <?php
	$db_sid = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-B029F5B)(PORT = 1522))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = bilal)))";
    $db_user = "Postoffice"; 
    $db_pass = "fast123";
      $con = oci_connect($db_user,$db_pass,$db_sid); 
      if($con) 
      { 
		$query = "select value from vartable where varno=6";
		$compile = oci_parse($con, $query);
		oci_execute($compile);
		$check = oci_fetch_row($compile);
		if($check[0] == 1){
			print "<a href='finances.php'>Finances</a>";
		}
	  }
  ?>
 <a href="loginPage.html" class = 'right'>Logout</a>
</div>

<div class="row">
  <div class="main">
    <h2>About PPost</h2>
    <p>Pakistan Post Office is one of the oldest government departments in the Sub-Continent. In 1947, it began functioning as the Department of Post & Telegraph. In 1962 it was separated from the Telegraph & Telephone and started working as an independent attached department.</p>
	
    <br>
    <h2>Postal Network</h2>
    <p>Pakistan Post is providing postal services in every nook and corner of the country through a network of around 13,000 post offices. Pakistan Post is providing delivery services to about 20 million households and businesses as community service without any cost considerations. In addition to its traditional role, the Pakistan Post also performs agency functions on behalf of Federal and Provincial governments, which inter-alias include Savings Bank, Postal Life Insurance, Collection of Taxes, Collection of Electricity, Water, Sui Gas and Telephone bills.

Pakistan Post is also providing a universal postal service network in harmony with the Universal Postal Union (UPU) strategy to ensure secure and timely delivery of mail, money and material at affordable cost through utilization of people, process and technology and innovative product offerings.</p>
    <br>	
	<h2>Organization</h2>
    <p>An autonomous High Powered Postal Services Management Board has been established through Pakistan Postal Services Management Board Ordinance, 2002. The executive management of postal and allied services below the Directorate General is done at three levels – the Circle Level, the Regional Level and Divisional / District Level. 
Each Circle is headed by a Postmaster General and its territorial jurisdiction extends to a province. In carrying out their responsibilities, the Postmasters General are assisted by the Regional Deputy Postmasters General and Unit Officers at operational level.</p>

  </div>
</div>

<div class="footer">
  <h2>Sources</h2>
  <p>the data on this website is mostly gathered from: </p><br>
  <a href="https://en.wikipedia.org/wiki/File:ER_Diagram_MMORPG.png">Wikipedia</a>
  <a href="https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_example_website">W3 Schools</a>
  <a href="https://www.google.com">Google</a>
</div>

</body>
</html>