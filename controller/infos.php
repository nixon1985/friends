<?php

include("db_conect.php");

$query = "SELECT * FROM member_info";
$var1 = '';
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
	$data['records'][] = $row;	
}

echo json_encode($data);

?>