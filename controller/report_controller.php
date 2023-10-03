<?php

include("DBcontroller.php");
$obj   = new DBcontroller;
$conn  = $obj->getDbConn();

$actionType = '';
if(isset($_REQUEST['actionType'])){
    $actionType = $_REQUEST['actionType'];
}

switch ($actionType){

    case 'depositedHistory':
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);
        //echo $data['member_id'];
        $member_id = $data['member_id'];
        $sql = "SELECT p.collection_date deposited_date, p.collection_id transaction_id, 
                MONTHNAME(p.month_no)month_name,p.year_no, m.paid_method, p.ref_no, p.paid_amount deposited_amount 
                FROM payment_collection p
                JOIN payment_method m ON p.paid_method = m.paid_method_id
                WHERE p.member_id = $member_id
                ORDER BY p.collection_date desc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $opInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        break;

    default:
        $sql = "SELECT * FROM member_info";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $opInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        break;
}

echo json_encode($opInfo);

?>