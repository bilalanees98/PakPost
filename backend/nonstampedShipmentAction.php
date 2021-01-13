<html>
  <head><title>Confirm</title></head>
  <body><br><br><br>
   <?php

	$db_sid = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-B029F5B)(PORT = 1522))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = bilal)))";
    $db_user = "scott"; 
    $db_pass = "tiger";
     
      $con = oci_connect($db_user,$db_pass,$db_sid); 
      if($con) 
      { 
       echo "Oracle Connection Successful.";
        
      } 
   else 
      { die('Could not connect to Oracle: '); 
      }
	if(isset($_POST["submit1"])){
	$id1=$_POST['S_ID'];
    $mtype1=$_POST['mailType'];
    $weight1=$_POST['weight'];
    $urgency1=$_POST['urgency'];
    $desc1=$_POST['desc'];
	$iType1=$_POST['iType'];
	$rname1 = $_POST['receiverName'];
	$radd1 = $_POST['recAddress'];
	$rtel1 = $_POST['recTel'];
	$newdob = date('Y-m-d',strtotime($_POST['dob']));
	
    $query1=" INSERT INTO non_stamped_shipment(s_id,status,weight,mailType,urgency,description,Itype)
 VALUES ('$id1','order placed', '$weight1', '$mtype1','$urgency1','$desc1', '$iType1')";
 
	/*$query2=" INSERT INTO order11(o_id,s_id,c_id,order_time,order_date,order_arrival_date,branch_id,arrivaltime,price)
 VALUES (<oid>,'$id1',<c-id>, <order-time>, <order-date>,<order-arrival-date>,<branch id>, <arrivaltime>,<price>)";*/
 
	 $query3=" INSERT INTO rec(s_id,r_name,r_address,r_telno)
	 VALUES ('$id1','$rname1, '$radd1', '$rtel1')";
	 
     $compile1 = oci_parse($con, $query1); 
     $exe1 = oci_execute($compile1);
	 /*$compile2 = oci_parse($con, $query2); 
     $exe2 = oci_execute($compile2);*/
	 $compile3 = oci_parse($con, $query3); 
     $exe3 = oci_execute($compile3);
	 echo "addition successful!</br>";
	 /*header("Location: nonstampedShipment.html");*/
   }
   else{
	   echo "Error!";
   }
?>
  </body>
</html>