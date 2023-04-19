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



$sql = "SELECT * FROM member_info";
$stmt = $conn->prepare($sql);
$stmt->execute();
$opInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);

/*
if($opInfo){
    foreach ($opInfo as $row){
        $openning_balance = $row['o_debit']-$row['o_credit'];
    }
}
*/

echo json_encode($opInfo);

?>