<?php

include("DBcontroller.php");
$obj 		= new DBcontroller;
$conn       = $obj->getDbConn();
$newMemberNo = $obj->getNewMemberNo();
try {
    $conn->beginTransaction();
    $sql_query = "INSERT INTO payment_collection (member_id,month_no,year_no,collection_date,payable_amount,paid_method,ref_no,paid_amount) 
                                       VALUES (:member_id,:month_no,:year_no,:collection_date,:payable_amount,:paid_method,:ref_no,:paid_amount)";
    $stmt = $conn->prepare($sql_query);

    $stmt->bindParam(':member_id', $member_id);
    $stmt->bindParam(':month_no', $month_no);
    $stmt->bindParam(':year_no', $year_no);
    $stmt->bindParam(':collection_date', $collection_date);
    $stmt->bindParam(':payable_amount', $payable_amount);
    $stmt->bindParam(':paid_method', $paid_method);
    $stmt->bindParam(':ref_no', $ref_no,PDO::PARAM_NULL);
    $stmt->bindParam(':paid_amount', $paid_amount);
    // $stmt->bindParam(':description', $description,PDO::PARAM_NULL);
    // $stmt->bindParam(':created_by', $created_by);

    $member_id 	          = trim($_POST['member_id']);
    $month_no 	  		  = trim($_POST['month_no']);
    $year_no 	      	  = trim($_POST['year_no']);
    $collection_date 	  = trim($_POST['collection_date']);
    $payable_amount 	  = trim($_POST['paid_amount']);
    $paid_method 	      = trim($_POST['paid_method']);
    $ref_no 	          = (!empty($_POST['ref_no'])) ? trim($_POST['ref_no']):null;
    $paid_amount 	      = (!empty($_POST['paid_amount'])) ? trim($_POST['paid_amount']):0;
    // $created_by 	      = $loginUser;

    $stmt->execute();
    $conn->commit();
    $data['success']='New Member added successfully';
    echo json_encode($data);

} catch(PDOException $e) {
    $conn->rollback();
    $data['error']='Insert error. '. $e->getMessage();
    echo json_encode($data);
}

?>