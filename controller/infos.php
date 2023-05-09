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
if(isset($_POST['actionType'])){
    //echo $_POST['member_id'];
    $actionType = $_POST['actionType'];
}


switch ($actionType){

    case 'personInfo':
        $member_id = $_POST['member_id'];
        $sql = "SELECT * FROM member_info WHERE member_id = $member_id";
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