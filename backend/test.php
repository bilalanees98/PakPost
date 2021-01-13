<html>
  <head><title>Confirm</title></head>
  <body><br><br><br>
   <?php
	
	$db_sid = "(DESCRIPTION =(ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-B029F5B)(PORT = 1522))(CONNECT_DATA =(SERVER = DEDICATED)(SERVICE_NAME = bilal)))";
    $db_user = "Postoffice"; 
    $db_pass = "fast123";
     
      $con = oci_connect($db_user,$db_pass,$db_sid); 
      if($con) 
      { 
       echo "Oracle Connection Successful.";
        
      } 
   else 
      { die('Could not connect to Oracle: '); 
      }
	  
	  $query = "select * from post_office";
					$compile = oci_parse($con, $query); 
					oci_execute($compile);
					while($r = oci_fetch_row($compile))
					{
						$temp = $r[0];
						echo $temp;
						//echo '<option value=" '.$temp.'"  >'.$temp.'</option>';
					}
	  
	  /*$date1 = date('Y-m-d',time());
	  $urgency1 = "Regular";
	  if($urgency1= "Regular"){
				$newDate = date('Y-m-d', strtotime($date1. ' + 2 days'));
		}
		echo $newDate;
	 /* $mtype1 = 3;
	  $urgency1 = "Same day";
	  $weight1 = 100;
	$auxQuery1 = "select Price_pgram from mailTable where type = '$mtype1' and urgency = '$urgency1'";
	$auxCompile1 = oci_parse($con, $auxQuery1); 
	oci_execute($auxCompile1);
	$pricePGram = oci_fetch_row($auxCompile1);
	echo $pricePGram[0]*$weight1;
	 /*create table vartable(
		varno int unique,
		name varchar2(8),
		value int
	  );
	  INSERT INTO vartable(varno,name,value)
	VALUES (1,'Ordno',1);
	INSERT INTO vartable(varno,name,value)
	VALUES (2,'cid',1);
	INSERT INTO vartable(varno,name,value)
	VALUES (3,'sid',1);
	INSERT INTO vartable(varno,name,value)
	VALUES (4,'ccid',1);*/
?>
  </body>
</html>
