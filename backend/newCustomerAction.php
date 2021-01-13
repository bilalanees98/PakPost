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
	$id1=$_POST['C_ID'];
    $name1=$_POST['C_name'];
    $cnic1=$_POST['CNIC'];
    $dob1=$_POST['dob'];
    $gender1=$_POST['gender'];
	$address1=$_POST['Address'];
	$telno1 = $_POST['telno'];
	$newdob = date('Y-m-d',strtotime($_POST['dob']));
    $query=" INSERT INTO customer4(c_id,c_name,address,CNIC,tel_no,gender,dob)
 VALUES ('$id1', '$name1', '$address1','$cnic1','$telno1', '$gender1',DATE '$dob1')";
     $compile = oci_parse($con, $query); 
     $exe = oci_execute($compile);
	 echo "addition successful!</br>";
	 header("Location: nonstampedShipment.html");
   }
   else{
	   echo "Error!";
   }
?>
  </body>
</html>