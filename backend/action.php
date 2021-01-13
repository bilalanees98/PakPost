<html>
  <head><title>Confirm</title></head>
  <body><br><br><br>
   <?php
	session_start();
	print "</br>";
	$db_sid = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-B029F5B)(PORT = 1522))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = bilal)))";
    $db_user = "Postoffice"; 
    $db_pass = "fast123";
     
      $con = oci_connect($db_user,$db_pass,$db_sid); 
      if($con) 
      { 
		if(isset($_POST["submitNewCust"])){//adding new customer to database
			$name1=$_POST['C_name'];
			$cnic1=$_POST['CNIC'];
			$dob1=$_POST['dob'];
			$gender1=$_POST['gender'];
			$address1=$_POST['Address'];
			$telno1 = $_POST['telno'];
			$newdob = date('Y-m-d',strtotime($_POST['dob']));
			//getting global cid
			$q1=" select value from vartable where varno = 2";//global cid
			$c1 = oci_parse($con, $q1); 
			oci_execute($c1);
			$e1 = oci_fetch_row($c1);
			$id1 = $e1[0];
			//updating global cid
			$qq1 = "update vartable set value = value+1 where varno=2";//global cid
			$cc1 = oci_parse($con, $qq1); 
			oci_execute($cc1);
			//setting current customer id
			$qq2 = "update vartable set value = '$id1' where varno=4";//global cid
			$cc2 = oci_parse($con, $qq2); 
			oci_execute($cc2);
			
			//inserting into customer table
			$query1=" INSERT INTO customer(c_id,c_name,address,CNIC,tel_no,gender,dob)
			VALUES ('$id1', '$name1', '$address1','$cnic1','$telno1', '$gender1',DATE '$newdob')";
			$compile1 = oci_parse($con, $query1); 
			oci_execute($compile1);
			
			header("Location: nonstampedShipment.html");
	   }
	   else{
		   echo "Error!";
	   }
	?>
	<?php
		if(isset($_POST["newShipment"])){//adding new shipment to same order
			$time1 = date('H:i:s',time());
			$date1 = date('Y-m-d',time());
			$mtype1=$_POST['mailType'];
			$weight1=$_POST['weight'];
			$urgency1=$_POST['urgency'];
			$desc1=$_POST['desc'];
			$iType1=$_POST['iType'];
			$rname1 = $_POST['receiverName'];
			$radd1 = $_POST['recAddress'];
			$rtel1 = $_POST['recTel'];
			
			$newDate;
			if($urgency1 == 'Regular'){
				$newDate = date('Y-m-d', strtotime($date1. ' + 2 days'));
			}
			if($urgency1 == 'Urgent'){
				$newDate = date('Y-m-d', strtotime($date1. ' + 1 days'));
			}
			if($urgency1 == 'Same day'){
				$newDate = date('Y-m-d', strtotime($date1. ' + 0 days'));
			}
			
			print "</br>";
			//getting global order no
			$q2=" select value from vartable where varno = 1";//global order no
			$c2 = oci_parse($con, $q2); 
			oci_execute($c2);
			$e2 = oci_fetch_row($c2);
			$orderno1 = $e2[0];

			$q3=" select value from vartable where varno = 3";//global shipment no
			$c3 = oci_parse($con, $q3); 
			oci_execute($c3);
			$e3 = oci_fetch_row($c3);
			$sid1 = $e3[0];
			//updating global shipment no
			$qq3 = "update vartable set value = value+1 where varno=3";//global shipment no
			$cc3 = oci_parse($con, $qq3); 
			oci_execute($cc3);
			
			$q4=" select value from vartable where varno = 4";//current cid
			$c4 = oci_parse($con, $q4); 
			oci_execute($c4);
			$e4 = oci_fetch_row($c4);
			$ccid = $e4[0]; //current customer id
			
			$auxQuery1 = "select Price_pgram from mailTable where type = '$mtype1' and urgency = '$urgency1'";
			$auxCompile1 = oci_parse($con, $auxQuery1); 
			oci_execute($auxCompile1);
			$pricePGram = oci_fetch_row($auxCompile1);
			echo $pricePGram[0]*$weight1;		
			$price1 = $pricePGram[0]*$weight1;
			
			$auxQuery2 = "select value from vartable where varno = 5";
			$auxCompile2 = oci_parse($con, $auxQuery2); 
			oci_execute($auxCompile2);
			$branchid = oci_fetch_row($auxCompile2);
			
			$query2=" INSERT INTO non_stamped_shipment(s_id,status,weight,mailType,urgency,description,Itype)
			VALUES ('$sid1','order placed', '$weight1', $mtype1,'$urgency1','$desc1', $iType1)";
		 
			$query3="INSERT INTO order2(o_id,s_id,c_id,order_date,order_arrival_date,branch_id,price)
			VALUES ($orderno1,'$sid1',$ccid,DATE '$date1',DATE '$newDate','$branchid[0]','$price1')";//add functionality for branch
		
			$query4=" INSERT INTO receiver_non_stamped(s_id,r_name,r_address,r_telno)
			VALUES ('$sid1','$rname1', '$radd1', '$rtel1')";
			 
			$compile2 = oci_parse($con, $query2); 
			oci_execute($compile2);
			$compile3 = oci_parse($con, $query3); 
			oci_execute($compile3);
			$compile4 = oci_parse($con, $query4); 
			oci_execute($compile4);

			header("Location: nonstampedShipment.html");
		   }
		if(isset($_POST["closeorder"])){//final submission of a order
		   /*-----enter insert nto order table---same as above*/
			$time1 = date('H:i:s',time());
			$date1 = date('Y-m-d',time());
			$mtype1=$_POST['mailType'];
			$weight1=$_POST['weight'];
			$urgency1=$_POST['urgency'];
			$desc1=$_POST['desc'];
			$iType1=$_POST['iType'];
			$rname1 = $_POST['receiverName'];
			$radd1 = $_POST['recAddress'];
			$rtel1 = $_POST['recTel'];
			
			$newDate;
			if($urgency1 == 'Regular'){
				$newDate = date('Y-m-d', strtotime($date1. ' + 2 days'));
			}
			if($urgency1 == 'Urgent'){
				$newDate = date('Y-m-d', strtotime($date1. ' + 1 days'));
			}
			if($urgency1 == 'Same day'){
				$newDate = date('Y-m-d', strtotime($date1. ' + 0 days'));
			}
			echo $urgency1;
			echo $newDate;
			print "</br>";
			//getting global order no
			$q2=" select value from vartable where varno = 1";//global order no
			$c2 = oci_parse($con, $q2); 
			oci_execute($c2);
			$e2 = oci_fetch_row($c2);
			$orderno1 = $e2[0];

			$q3=" select value from vartable where varno = 3";//global shipment no
			$c3 = oci_parse($con, $q3); 
			oci_execute($c3);
			$e3 = oci_fetch_row($c3);
			$sid1 = $e3[0];
			//updating global shipment no
			$qq3 = "update vartable set value = value+1 where varno=3";//global shipment no
			$cc3 = oci_parse($con, $qq3); 
			oci_execute($cc3);
			
			$q4=" select value from vartable where varno = 4";//current cid
			$c4 = oci_parse($con, $q4); 
			oci_execute($c4);
			$e4 = oci_fetch_row($c4);
			$ccid = $e4[0]; //current customer id
			
			$auxQuery1 = "select Price_pgram from mailTable where type = '$mtype1' and urgency = '$urgency1'";
			$auxCompile1 = oci_parse($con, $auxQuery1); 
			oci_execute($auxCompile1);
			$pricePGram = oci_fetch_row($auxCompile1);
			echo $pricePGram[0]*$weight1;
			$price1 = $pricePGram[0]*$weight1;
			
			$auxQuery2 = "select value from vartable where varno = 5";
			$auxCompile2 = oci_parse($con, $auxQuery2); 
			oci_execute($auxCompile2);
			$branchid = oci_fetch_row($auxCompile2);
			
			$query2=" INSERT INTO non_stamped_shipment(s_id,status,weight,mailType,urgency,description,Itype)
			VALUES ('$sid1','order placed', '$weight1', $mtype1,'$urgency1','$desc1', $iType1)";
		 
			$query3="INSERT INTO order2(o_id,s_id,c_id,order_date,order_arrival_date,branch_id,price)
			VALUES ($orderno1,'$sid1',$ccid,DATE '$date1',DATE '$newDate','$branchid[0]','$price1')";//add functionality for branch
		
			$query4=" INSERT INTO receiver_non_stamped(s_id,r_name,r_address,r_telno)
			VALUES ('$sid1','$rname1', '$radd1', '$rtel1')";
			 
			$compile2 = oci_parse($con, $query2); 
			oci_execute($compile2);
			$compile3 = oci_parse($con, $query3); 
			oci_execute($compile3);
			$compile4 = oci_parse($con, $query4); 
			oci_execute($compile4);
			//incrementing global order no
			$qq5 = "update vartable set value = value+1 where varno=1";//global shipment no
			$cc5 = oci_parse($con, $qq5); 
			oci_execute($cc5);

			header("Location: invoiceReport.php");
	   }
	    if(isset($_POST["oldCustSubmit"])){//checking if customer is existing or not
			$cnic=$_POST['cnic'];
			$query = "select * from customer where cnic = '$cnic'";
			$compile = oci_parse($con, $query); 
			oci_execute($compile);
			$cid = oci_fetch_row($compile);
			if(is_null($cid[0])){
				print "customer not existing</br>";
			}
			else{
				print "customer is existing</br>";
				//setting current customer id
				$qq2 = "update vartable set value = '$cid[0]' where varno=4";//global cid
				$cc2 = oci_parse($con, $qq2); 
				oci_execute($cc2);
				header("Location: nonstampedShipment.html");
			}
	   }
	    if(isset($_POST["login"])){//logging in initially
			$eid1=$_POST['eid'];
			$pass1=$_POST['pass'];
			$query = "select branch_no from staff where s_id = $eid1 and password = $pass1";
			$compile = oci_parse($con, $query); 
			oci_execute($compile);
			$branchid = oci_fetch_row($compile);
			if(is_null($branchid[0])){
				header("Location: loginPage.html");
			}
			else{
				$query1 = "update vartable set value = '$branchid[0]' where varno = 5";
				$compile1 = oci_parse($con, $query1); 
				oci_execute($compile1);

				$query2 = "select mgr_id from post_office where branch_no = $branchid[0]";
				$compile2= oci_parse($con, $query2); 
				oci_execute($compile2);
				$mgrid = oci_fetch_row($compile2);
				
				if($mgrid[0] == $eid1){
					echo $mgrid[0];
					$query3 = "update vartable set value = 1 where varno = 6";
					$compile3 = oci_parse($con, $query3); 
					oci_execute($compile3);		
				}
				else{
					$query3 = "update vartable set value = 0 where varno = 6";
					$compile3 = oci_parse($con, $query3); 
					oci_execute($compile3);
				}
				header("Location: First_Page.php");
			}
			
	   } 
	    if(isset($_POST["statusUpdate"])){//updating status of a shipment
			$sid=$_POST['shipId'];
			$status=$_POST['status'];
			$query = "update non_stamped_shipment set status = '$status' where s_id=$sid";
			$compile = oci_parse($con, $query); 
			oci_execute($compile);		
			header("Location: updateStatus.php");
	   }	
		if(isset($_POST["newStampedShipment"])){//updating status of a shipment
			$type=$_POST['stampType'];
			$ddate=$_POST['OrdDate'];
			$status=$_POST['status'];
			$sname=$_POST['sName'];
			$sAdd=$_POST['sAddress'];
			$sTel=$_POST['sTel'];
			$rname=$_POST['rName'];
			$rAdd=$_POST['rAddress'];
			$rTel=$_POST['rTel'];
			
			$q3=" select value from vartable where varno = 7";//global stamped shipment no
			$c3 = oci_parse($con, $q3); 
			oci_execute($c3);
			$e3 = oci_fetch_row($c3);
			$sid1 = $e3[0];
			//echo $e3[0];
			
			$qq3 = "update vartable set value = value+1 where varno=7";//global stamped shipment no
			$cc3 = oci_parse($con, $qq3); 
			oci_execute($cc3);
			
			$query1=" INSERT INTO stamped_shipment(s_id,status,s_type,Arrival_date,Receive_date)
			VALUES ('$sid1','$status', '$type',DATE '$ddate',DATE '$ddate')";
			$compile1 = oci_parse($con, $query1); 
			oci_execute($compile1);	
			
			$query2=" INSERT INTO receiver_stamped(s_id,r_name,r_address,r_telno)
			VALUES ('$sid1','$rname', '$rAdd', '$rTel')";
			$compile2 = oci_parse($con, $query2); 
			oci_execute($compile2);	

			$query3=" INSERT INTO sender_stamped(s_id,s_name,s_address,s_telno)
			VALUES ('$sid1','$sname', '$sAdd', '$sTel')";
			$compile3 = oci_parse($con, $query3); 
			oci_execute($compile3);	
			
			header("Location: stampedShipment.html");
	   }
		if(isset($_POST["done"])){
			$type=$_POST['stampType'];
			$ddate=$_POST['OrdDate'];
			$status=$_POST['status'];
			$sname=$_POST['sName'];
			$sAdd=$_POST['sAddress'];
			$sTel=$_POST['sTel'];
			$rname=$_POST['rName'];
			$rAdd=$_POST['rAddress'];
			$rTel=$_POST['rTel'];
			
			$q3=" select value from vartable where varno = 7";//global stamped shipment no
			$c3 = oci_parse($con, $q3); 
			oci_execute($c3);
			$e3 = oci_fetch_row($c3);
			$sid1 = $e3[0];
			//echo $e3[0];
			
			$qq3 = "update vartable set value = value+1 where varno=7";//global stamped shipment no
			$cc3 = oci_parse($con, $qq3); 
			oci_execute($cc3);
			
			$query1=" INSERT INTO stamped_shipment(s_id,status,s_type,Arrival_date,Receive_date)
			VALUES ('$sid1','$status', '$type',DATE '$ddate',DATE '$ddate')";
			$compile1 = oci_parse($con, $query1); 
			oci_execute($compile1);	
			
			$query2=" INSERT INTO receiver_stamped(s_id,r_name,r_address,r_telno)
			VALUES ('$sid1','$rname', '$rAdd', '$rTel')";
			$compile2 = oci_parse($con, $query2); 
			oci_execute($compile2);	

			$query3=" INSERT INTO sender_stamped(s_id,s_name,s_address,s_telno)
			VALUES ('$sid1','$sname', '$sAdd', '$sTel')";
			$compile3 = oci_parse($con, $query3); 
			oci_execute($compile3);	
			
			header("Location: First_Page.php");
		}

      } 
    else 
      { 
		die('Could not connect to Oracle: '); 
      }
	  
	
?>
  </body>
</html>