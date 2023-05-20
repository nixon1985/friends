<?php

include("DBcontroller.php");
$obj 		= new DBcontroller;
$conn       = $obj->getDbConn();


//$query = "SELECT * FROM member_info";
//$var1 = '';
//$result = mysql_query($query);
/*while($row = mysql_fetch_array($result))
{
	$data['records'][] = $row;	
}*/

//$all_employee = $funLib->getResultList($sql);
//foreach ($all_employee as $row) {
//    $data['records'][] = $row;
//}
//$row1 = mysql_fetch_array($result);
//echo json_encode($row1);

$actionType = '';
/*
if(isset($_POST['actionType'])){
    //echo $_POST['member_id'];
    $actionType = $_POST['actionType'];
}
*/

if(isset($_REQUEST['actionType'])){
    $actionType = $_REQUEST['actionType'];
}


switch ($actionType){

    case 'personInfo':
        $member_id = $_POST['member_id'];
        $sql = "SELECT * FROM member_info WHERE member_id = $member_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $opInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 'getPaymentMethod':
        $sql = "SELECT * FROM payment_method";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $opInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 'paymentInfo':
        $sql = "SELECT p.collection_id, p.month_no, p.year_no, m.member_name, m.member_no, p.paid_amount, 
                MONTHNAME(Concat(p.year_no,'-',p.month_no,'-',0)) month_name, t.paid_method, 
                FROM payment_collection p
                JOIN member_info m ON m.member_id = p.member_id
                JOIN payment_method t ON t.paid_method_id = p.paid_method";
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