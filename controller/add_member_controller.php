<?php

include("DBcontroller.php");
$obj 		= new DBcontroller;	
$conn       = $obj->getDbConn();

try {				
		$conn->beginTransaction();					
		$sql_query = "INSERT INTO member_info (member_name,phone_no,email,present_address,permanent_address) VALUES (:member_name,:phone_no,:email,:present_address,:permanent_address)";
		$stmt = $conn->prepare($sql_query);
		
		$stmt->bindParam(':member_name', $member_name);
		$stmt->bindParam(':phone_no', $phone_no);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':present_address', $present_address);
		$stmt->bindParam(':permanent_address', $permanent_address,PDO::PARAM_NULL);
		// $stmt->bindParam(':description', $description,PDO::PARAM_NULL);
		// $stmt->bindParam(':created_by', $created_by);
		
		$member_name 	      = trim($_POST['member_name']);
		$phone_no 	  		  = trim($_POST['phone_no']);
		$email 	      		  = trim($_POST['email']);
		$present_address 	  = trim($_POST['present_address']);
		$permanent_address 	  = trim($_POST['permanent_address']);
		// $duration 	          = (!empty($_POST['duration'])) ? trim($_POST['duration']):null;
		// $description 	      = (!empty($_POST['allow_desc'])) ? trim($_POST['allow_desc']):null;
		// $created_by 	      = $loginUser;
		
		$stmt->execute();
		$conn->commit();			 
		echo "1";
	} catch(PDOException $e) {
		$conn->rollback();
		echo "Insert:Error: " . $e->getMessage();
	}







/*include("db_conect.php");


$query = "SELECT * FROM member_info";
$var1 = '';
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
	//$data['records'][] = $row;	
}

$data['success']='sdfs';
echo json_encode($data);
*/

?>