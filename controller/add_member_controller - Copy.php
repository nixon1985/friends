<?php

include("db_conect.php");



// echo $_POST['member_name'];

$query = "SELECT * FROM member_info";
$var1 = '';
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
	//$data['records'][] = $row;	
}

$data['success']='sdfs';
echo json_encode($data);

?>