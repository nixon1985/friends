<?php

$con = mysql_connect("localhost","root","123456");			
if (!$con)
{
	die('Could not connect: ' .mysql_error());
}
mysql_select_db('somiti', $con);





function getAnID($databaseName, $tableName, $column, $condition)
{
	$var1 = "";
	$databaseName='somiti';
	$dbSelect = mysql_select_db($databaseName, $con);
	if (!$dbSelect)
	{
		die('Could not connect: ' . mysql_error());
	}
	$query = 'select max(' . $column . ')' . ' from '  . $tableName .' '. $condition;
	//echo $query; //die;
	$result = mysql_query($query);
	
	while($row = mysql_fetch_array($result))
	{
		$var1 = $row[0];
	}
	return $var1;

}

?>