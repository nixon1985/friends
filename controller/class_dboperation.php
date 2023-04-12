<?php 
	date_default_timezone_set("Asia/Dhaka"); 


	//var_dump($_POST);
	class DatabaseOperation
	{	
	//var_dump($_POST);
		var $con;
		var $company;
		//Constructor
		function DatabaseOperation()
		{
			$this->con = mysql_connect("localhost","root","ServerDB_@876");			
			if (!$this->con)
			{
				die('Could not connect: ' .mysql_error());
			}
			mysql_select_db('suvastuapp_22', $this->con);
		}
		//Function for stublishing mysql connection
		function connectMySql()
		{
			$con = mysql_connect("localhost","root","ServerDB_@876");				
			if (!$con)
			{
				die('Could not connect: ' .mysql_error());
			}
		}
		//Function for inserting data to a database table
		function insertStatement($databaseName, $tableName, $columns, $valuesString)
		{
			$databaseName='suvastuapp_22';
			mysql_select_db($databaseName, $this->con);
			//echo $columns; die;
			$sql = "insert into " . $tableName . "(" . $columns . ") " . "values(" . $valuesString . ")";
			//echo $sql; die();
			if(!mysql_query($sql, $this->con))
			{
				die('Error: ' .mysql_error());
			}
			
		}
		//Function for selecting data from a database table
		function selectData($databaseName, $columns, $tableName, $condition, $gridID, $width, $height)
		{
			$databaseName='suvastuapp_22';
			$tr_id = - 1;
			$td_id = 0;
			/*echo '<div align="right" style="background:#999999; width:50%;background:url(images/design-mid.jpg) repeat-x;font-size:12px;font-weight:bold;">Search: <input name="filter" id="filter" value="" maxlength="50" size="50" type="text"></div>';*/
			echo '<div style="width:'.$width.'%; height:30px;">
				<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="1%" class="design-mid"><img src="images/design-left.jpg" width="9" height="30px" /></td>
						<td width="70%" class="design-mid" valign="middle">Search: <input name="filter" id="filter" value="" style="width:60%;height:19px;font-family: "Tahoma", Times New Roman, Times; font-size:10px;" type="text"></td>
						<td width="1%" align="right" class="design-mid"><img src="images/design-right.jpg" width="9" height="30px" /></td>
					</tr>
				</table>
			</div>';
			//$var1 = "<div  style='width:" . $width . "%; height:" . $height . "px; overflow:scroll' ><table width='100%' class='table' border='1' id='" . $gridID . "' style='overflow:scroll;'><tr class='head_tr' id='tr-" . $tr_id . "' >";
			$var1 = "<div  style='width:" . $width . "%; height:" . $height . "px; overflow:scroll;' >
			<table class='table' border='1' id='" . $gridID . "' style='max-height:10px; height:10px; width:100%; margin:0; padding:0;'>
				<thead>
					<tr>";
			$dbSelect = mysql_select_db($databaseName, $this->con) or die(mysql_error());
			if (!$dbSelect)
			  {
			  	die('Could not connect: ' . mysql_error());
			  }
			$query = 'select ' . $columns . ' from ' . $tableName . ' ' . $condition;
			
			//echo $query ; 
			
			$result = mysql_query($query);
			$stringArray = explode(',' , $columns);
			$column = count($stringArray);
			for($i = 0; $i < $column; $i++)
			{
				if($i + 1 == $column)
					$var1 = $var1 . '<th class="">' . $stringArray[$i] . '</th>' . '</tr></thead>';
				else
					$var1 = $var1 . '<th class="">' . $stringArray[$i] . '</th>';
			}
			echo $var1;
			//echo "<table width='100%' class='table' border='1' id='".$gridID."'>";
			//$row = mysql_fetch_array($result);
			while ($row=mysql_fetch_array($result, MYSQL_ASSOC) or die(mysql_error()))
		   	{
		  		$tr_id ++;
				echo "<tr class='tr' id='tr-".$tr_id."' >";
				for($i = 0; $i < $column; $i++)
				{
					$var1 = $var1 . '<th>' . $stringArray[$i] . '</th>';
					echo "<td class='td' id='td-".$td_id."' style='height:10px; overflow: hidden;'>" . $row[$stringArray[$i]] . "</td>";
					$td_id ++;
				}
		  		echo "</tr>";
		  	}
			echo "</table></div>";
		}
		
		//Function for selecting data from a database table for Allowance/Deduction Head(BY ARIF)
		function selectDataNew($databaseName, $titlehead, $columns, $tableName, $condition, $gridID, $width, $height, $another_best)
		{
			$tr_id = -1;
			$td_id = 0;
			$databaseName='suvastuapp_22';
			/*echo '<div align="right" style="background:#999999; width:50%;background:url(images/design-mid.jpg) repeat-x;font-size:12px;font-weight:bold;">Search: <input name="filter" id="filter" value="" maxlength="50" size="50" type="text"></div>';*/
			echo '<div style="width:'.$width.'%; height:30px;">
				<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="1%" class="design-mid"><img src="images/design-left.jpg" width="9" height="30px" /></td>
						<td width="70%" class="design-mid" valign="middle">Search: <input name="filter" id="filter" value="" style="width:60%;height:19px;font-family: "Tahoma", Times New Roman, Times; font-size:10px;" type="text"></td>
						<td width="1%" align="right" class="design-mid"><img src="images/design-right.jpg" width="9" height="30px" /></td>
					</tr>
				</table>
			</div>';
			//$var1 = "<div  style='width:" . $width . "%; height:" . $height . "px; overflow:scroll' ><table width='100%' class='table' border='1' id='" . $gridID . "' style='overflow:scroll;'><tr class='head_tr' id='tr-" . $tr_id . "' >";
			$var1 = "<div  style='width:" . $width . "%; height:" . $height . "px;overflow:scroll;' >
			<table class='table' border='1' id='" . $gridID . "' style='max-height:10px; height:10px; width:100%;margin:0; padding:0;'>
				<thead>
					<tr>";
			$dbSelect = mysql_select_db($databaseName, $this->con) or die(mysql_error());
			if (!$dbSelect)
			  {
			  	die('Could not connect: ' . mysql_error());
			  }
			$query = 'select ' . $columns . ' from ' . $tableName . ' ' . $condition;
			
			
			//echo $query ; 
			$result = mysql_query($query);
			
			//$titlehead="ID-Title-Description-Type-Applicable";
			$titleheadArray = explode(',',$titlehead);
			$titleheadcolumn = count($titleheadArray);
			
			$stringArray = explode(',' , $columns);
			//echo $stringArray[1];
			$column = count($stringArray);
			//echo $column;
			for($i = 0; $i < $titleheadcolumn; $i++)
			{
				if($i + 1 == $titleheadcolumn)
					$var1 = $var1 . '<th class="">' . $titleheadArray[$i] . '</th>' . '</tr></thead>';
				else
					$var1 = $var1 . '<th class="">' . $titleheadArray[$i] . '</th>';
			}
			echo $var1;
			//echo "<table width='100%' class='table' border='1' id='".$gridID."'>";
			//$row = mysql_fetch_array($result);
			while ($row=mysql_fetch_array($result, MYSQL_ASSOC) or die(mysql_error()))
		   	{
				if ($row[$stringArray[3]]==1){
					$row[$stringArray[3]]='Gross';
				}
				else if ($row[$stringArray[3]]==2){
					$row[$stringArray[3]]='Basic';
				}
				else if ($row[$stringArray[3]]==3){
					$row[$stringArray[3]]='Allowance';
				}
				else if ($row[$stringArray[3]]==4){
					$row[$stringArray[3]]='Diduction';
				}
			
			
				if ($row[$stringArray[4]]==1){
					$row[$stringArray[4]]='YES';
				}
				else{
						$row[$stringArray[4]]='NO';
						}
		  		$tr_id ++;
				echo "<tr class='tr' id='tr-".$tr_id."' >";
				for($i = 0; $i < $column; $i++)
				{
					$var1 = $var1 . '<th>' . $stringArray[$i] . '</th>';
					echo "<td class='td' id='td-".$td_id."' style='height:10px; overflow: hidden;'>" . $row[$stringArray[$i]] . "</td>";
					$td_id ++;
				}
				//echo $row[$stringArray[4]];
				echo "<td class='td' id='td-".$td_id."' style='height:10px; overflow: hidden;'><img onclick='delete_allowance(" . $row['ALLOW_DEDUC_ID'] . ")' src='images/delete.jpg' title='click to delete' style='cursor:pointer'/></td>";
		  		echo "</tr>";
		  	}
			echo "</table></div>";
		}
		

		
			//Function for selecting data from a database table New
		function dataGridWithSearch($databaseName, $columnDisplayNM, $columns, $tableName, $condition, $gridID, $filterID, $width, $height)
		{
			$tr_id = -1;
			$td_id = 0;
			$databaseName='suvastuapp_22';
			
			// Creating Search Panel
			echo '<div style="width:'.$width.'%; height:30px;">
				<table width="100%" height="100%" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td class="grid_search_box" width="100%" valign="middle" align="center"><input name="filter"  id="'. $filterID .'" style="width:40%;height:25px;:" placeholder="SEARCH" type="text">
						</td>						
					</tr>
				</table>
			</div>';
			
			// Creating pager panel
			//echo '<div align="center" id="pager" class="pager" style="width:100%; height:25px; background-color:#F3F3F1; padding:4px 0 1px 0; /*border:1px solid #CCCCCC;*/">
				/*<form>
					<img src="tablesorter/addons/pager/icons/first.png" class="first"/>
					<img src="tablesorter/addons/pager/icons/prev.png" class="prev"/>
					<input type="text" class="pagedisplay" style="width:50px;" readonly=""/>
					<img src="tablesorter/addons/pager/icons/next.png" class="next"/>
					<img src="tablesorter/addons/pager/icons/last.png" class="last"/>
					<select class="pagesize" style="width:60px;">
						<option selected="selected"  value="100">100</option>
						<option value="500">500</option>
						<option value="1000">1000</option>
						<option value="2000">2000</option>
						<option  value="5000">5000</option>
					</select>
				</form>
			</div>';
			*/
			// Creating Data table
			// 	$var1 = "<div  style='width:" . $width . "%; height:" . $height . "px;overflow:scroll;'>
			$var1 = "<div  style='width:" . $width . "%; height:" . $height . "px;overflow:scroll;'>
			<table class='table tablesorter' border='1' id='" . $gridID . "' style='max-height:16px; height:16px; width:100%;margin:0; padding:0;'><thead><tr>";
			$dbSelect = mysql_select_db($databaseName, $this->con);
			
			if (!$dbSelect)
			{
			  	die('Could not connect: ' . mysql_error());
			}
			
			$query = 'select ' . $columns . ' from ' . $tableName . ' ' . $condition;
		//echo $query;die;
			$result = mysql_query($query);
			
			$fields = mysql_num_fields($result);
			//echo $fields. "</br>";
			$fieldsArray = array();
			for ($i=0; $i < $fields; $i++) {
				$type  = mysql_field_type($result, $i);
				$name  = mysql_field_name($result, $i);
				$fieldsArray[$name] = $type ;
			}		
			$stringArray = explode(',' , $columns);
			$displayTitles = explode(',' , $columnDisplayNM);
			$column = count($stringArray);
			
			for($i = 0; $i < $column; $i++){
				if($i + 1 == $column)
					$var1 = $var1 . '<th class="' . $gridID . trim($stringArray[$i]) . '">' . trim($displayTitles[$i]) . '</th>' . '</tr></thead>';
				else
					$var1 = $var1 . '<th class="' . $gridID . trim($stringArray[$i]) . '">' . trim($displayTitles[$i]) . '</th>';
			}
			
			echo $var1;
			
			while($row = mysql_fetch_array($result) or die(mysql_error())){
		  		$tr_id ++;
				echo "<tr class='tr' id='" . $gridID . "tr-" . $tr_id . "' >";
				for($i = 0; $i < $column; $i++)
				{
					if($fieldsArray[trim($stringArray[$i])] == 'int' ||  $fieldsArray[trim($stringArray[$i])] == 'real')
						echo "<td align='right' class='" . $gridID . trim($stringArray[$i]) . "' id='" . $gridID . "td-" . $td_id . "' style='height:15px; overflow: hidden;'>".$row[trim($stringArray[$i])]. "</td>";
					else if(isset($fieldsArray['photo']) && $stringArray[$i]=='photo')
						echo "<td align='left' class='" . $gridID . trim($stringArray[$i]) . "' id='" . $gridID . "td-" . $td_id . "' style='height:15px; overflow: hidden;'><img src='".$row[trim($stringArray[$i])]. "' width='30' height='30' /></td>";
					else						
						echo "<td align='left' class='" . $gridID . trim($stringArray[$i]) . "' id='" . $gridID . "td-" . $td_id . "' style='height:15px; overflow: hidden;'>"					
					 .htmlspecialchars($row[trim($stringArray[$i])],ENT_QUOTES) . "</td>";
					$td_id ++;
				}
		  		echo "</tr>";
		  	}
			echo "</table></div>";			
		}
		
		//Function for combo
		function genCombo($dbName, $tableName, $columns, $passingValue, $condition, $passingTitle, $size,$select_id)
		{
			//echo $dbName.'--'.$tableName.'--'.$columns.'--'.$passingValue.'--'.$condition.'--'.$passingTitle.'--'.$size.'--'.$select_id;die;
			//$var1 = '$row[\'';
			$dbName='suvastuapp_22';
			$var2 = null;
			$dbSelect = mysql_select_db($dbName, $this->con);
			if(!$dbSelect)
			{
				die('DB Not Selected: ' . mysql_error());
			}	
			$queryitem = 'SELECT distinct ' . $passingValue . ', ' .  $columns . ' FROM ' . $tableName . ' ' . $condition . ' order by ' . $columns;
			//echo $queryitem;  die;
			$stringArray = explode(',' , $columns);
			//var_dump($stringArray );
			$column = count($stringArray);			
			//echo $queryitem;die;
			if($result = mysql_query($queryitem))  
			{
				if($success = mysql_num_rows($result) > 0) 
				{
					echo "<select name='$passingTitle' id='$select_id' style='width: " .$size."px'>";
					echo "<option value='null'>Select </option>";
					while ($row = mysql_fetch_array($result)){
						for($i = 0; $i < $column; $i++)
						{
							//if($stringArray[$i] != $passingValue)
							//{
								$var1 = $row[$stringArray[$i]];
								if($i == 0)
									$var2 = $var1;
								else
								{
									if($var2 !=  $var1)
										$var2 =  $var2 . ' -- ' . $var1;
									else 
										$var2 = $var1;
								}
								$var1 = null;
							//}
						}
						//echo $row;
						echo "<option value='" . $row[$passingValue] . "'>" . htmlspecialchars($var2,ENT_QUOTES) . "</option>";
						
					}
					echo "</select>";
				}
				else { echo "There is no data"; }
			}
			else 
			{ 
				echo "Failed to connect to database."; 
			}
			
			//$var3 = $row['emp_id']. "-". $row['full_name'];
		}
		
		
		//Function for comboMobile
		function genComboMobile($dbName, $tableName, $columns, $passingValue, $condition, $passingTitle,$select_id)
		{
			//$var1 = '$row[\'';
			$var2 = null;
			$dbName='suvastuapp_22';
			$dbSelect = mysql_select_db($dbName, $this->con);
			if(!$dbSelect)
			{
				die('DB Not Selected: ' . mysql_error());
			}	
			$queryitem = 'SELECT distinct ' . $passingValue . ', ' .  $columns . ' FROM ' . $tableName . ' ' . $condition . ' order by ' . $columns;
			//echo $queryitem;  die;
			$stringArray = explode(',' , $columns);
			$column = count($stringArray);			
			//echo $column; die;
			if($result = mysql_query($queryitem))  
			{
				if($success = mysql_num_rows($result) > 0) 
				{
					echo "<select class='select form-control' name='$passingTitle' id='$select_id'>";
					echo "<option value='null'>Select </option>";
					while ($row = mysql_fetch_array($result)){
						for($i = 0; $i < $column; $i++)
						{
							//if($stringArray[$i] != $passingValue)
							//{
								$var1 = $row[$stringArray[$i]];
								if($i == 0)
									$var2 = $var1;
								else
									$var2 =  $var2 . ' -- ' . $var1;
								$var1 = null;
							//}
						}
						//echo $row;
						echo "<option value='" . $row[$passingValue] . "'>" . htmlspecialchars($var2,ENT_QUOTES) . "</option>";
						
					}
					echo "</select>";
				}
				else { echo "There is no data"; }
			}
			else 
			{ 
				echo "Failed to connect to database."; 
			}
			
			//$var3 = $row['emp_id']. "-". $row['full_name'];
		}
		
		
		
		
		
		//Function for returning a id
		function getAnID($databaseName, $tableName, $column, $condition)
		{
			$var1 = "";
			$databaseName='suvastuapp_22';
			$dbSelect = mysql_select_db($databaseName, $this->con);
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
		
		//Function for returning a id
		function getAnIDwithNull($databaseName, $tableName, $column, $condition)
		{
			$var1 = "";
			$databaseName='suvastuapp_22';
			$dbSelect = mysql_select_db($databaseName, $this->con);
			if (!$dbSelect)
			{
				die('Could not connect: ' . mysql_error());
			}
			$query = 'select max(' . $column . ')' . ' from '  . $tableName .' '. $condition;
			//echo $query; //die;
			if($result = mysql_query($query)){
			$success = mysql_num_rows($result);
				//echo $success ."<br />";
				if($success > 0){
					while($row = mysql_fetch_array($result))
					{
						$var1 = $row[0];
					}
					return $var1;
				 }
			}
				 else return false;
	    }
		//Function for returning minimum id
		function getMinID($databaseName, $tableName, $column, $condition)
		{
			$databaseName='suvastuapp_22';
			$dbSelect = mysql_select_db($databaseName, $this->con);
			if (!$dbSelect)
			{
				die('Could not connect: ' . mysql_error());
			}
			$query = 'select min(' . $column . ')' . ' from '  . $tableName .' '. $condition;
			$result = mysql_query($query);
			while($row = mysql_fetch_array($result))
		   	{
				$var1 = $row[0];
			}
			echo $var1;
		}
		//Inserting message
		function insertMassage()
		{
			echo("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('1 Record Inserted')
				</SCRIPT>");
		}
		
		//Function for returning an array of all vallue from a table
		function returnArray($databaseName, $tableName,  $condition)
		{
			$databaseName='suvastuapp_22';
			$dbSelect = mysql_select_db($databaseName, $this->con);
			if (!$dbSelect)
			{
				die('Could not connect: ' . mysql_error());
			}
			$query = 'select * from '  . $tableName .' '. $condition;
			//echo $query; die;
			$result = mysql_query($query);
			$ret_array=mysql_fetch_row($result);
			
			return $ret_array;
		}
		
		//Function for return a column value from a table;
		function returnColumn($databaseName, $tableName, $columnName,  $condition)
		{
			$databaseName='suvastuapp_22';
			$dbSelect = mysql_select_db($databaseName, $this->con);
			if (!$dbSelect)
			{
				die('Could not connect: ' . mysql_error());
			}
			$query = 'select ' .$columnName . ' from '  . $tableName .' '. $condition;
			//echo $query;die;
			$result = mysql_query($query);
			$array = mysql_fetch_row($result);
			//echo $array[0];
			//$row = mysql_fetch_array($result);
			return $array[0];
		}
		
		//Function for retuen a column value from a table from Query;
		function returnColumnFrmQuery($databaseName, $query)
		{
			$databaseName='suvastuapp_22';
			$dbSelect = mysql_select_db($databaseName, $this->con);
			if (!$dbSelect)
			{
				die('Could not connect: ' . mysql_error());
			}
			//$query = 'select ' .$columnName . ' from '  . $tableName .' '. $condition;
			//echo $query;//die;
			$result = mysql_query($query);
			$array=mysql_fetch_row($result);
			//echo $array[0];
			//$row = mysql_fetch_array($result);
			return $array[0];
		}
                
        //Function for combo
		function dbCombo($dbName, $tableName, $columns, $passingValue, $passingTitle, $select_id)
		{
			$dbName='suvastuapp_22';
			$var2 = null;
			$dbSelect = mysql_select_db($dbName, $this->con);
			if(!$dbSelect)
			{
				die('DB Not Selected: ' . mysql_error());
			}	
			$queryitem = 'SELECT distinct ' .  $columns . ' FROM ' . $tableName . ' order by ' . $passingValue;
			$stringArray = explode(',' , $columns);
			$column = count($stringArray);

			
			
			if($result = mysql_query($queryitem))  
			{
				if($success = mysql_num_rows($result) > 0) 
				{
					echo "<select name='$passingTitle' id='$select_id' style='width: 180px;'>";
					echo "<option value='0'>- Select -</option>";
					while ($row = mysql_fetch_array($result)){
						for($i = 0; $i < $column; $i++)
						{
							$var1 = $row[$stringArray[$i]];
							if($i == 0)
								$var2 = $var1;
							else
								$var2 =  $var1;
							$var1 = null;
							
						}
						echo "<option value='$row[$passingValue]'>$var2</option>";
						
					}
					
					echo "</select>";
				}
				else { echo "No results found."; }
			}
			else 
			{ 
				echo "Failed to connect to database."; 
			}
			$var3 = $row['emp_id']. "-". $row['full_name'];
		}
        
        
        //Function of combo for datagrid
		function gridCombo($dbName, $tableName, $columns, $passingValue,$condition)
		{
			$dbName='suvastuapp_22';
 /*       echo ("1:Bangladeesh;2:India"); */
			$dbSelect = mysql_select_db($dbName, $this->con);
			if(!$dbSelect){
				die('DB Not Selected: ' . mysql_error());
			}	
            if(is_null($condition)){
                $queryitem = 'SELECT distinct ' .  $columns . ' FROM ' . $tableName . ' order by ' . $passingValue;
            }
            else{
                $queryitem = 'SELECT distinct ' .  $columns . ' FROM ' . $tableName  .' ' . $condition. ' order by ' . $passingValue ;
                 
            }
            //echo  $queryitem; die; 
			
			$stringArray = explode(',' , $columns);
            //$a="'"."null"."'";
            $selectString='null:Select;';
          //  echo $stringArray[0]; echo $stringArray[1];
			if($result = mysql_query($queryitem)){
			$success = mysql_num_rows($result);
				//echo $success ."<br />";
				if($success > 0) { 
 
				//echo $success."<br />";
					$i = 0;
					while($i < $success){
                        while ($row = mysql_fetch_array($result)){
                         
                                if($i < $success - 1)	
                                {
                                    $selectString .= $row[$stringArray[0]].":".$row[$stringArray[1]].";";
                                }
                                else 
                                {
                                    $selectString .= $row[$stringArray[0]].":".$row[$stringArray[1]];
                                }
								$i = $i + 1;                                             
                        
                   		}
				   }
                   //echo("FE:FedEx;TN:TNT;ad:s");
                   echo($selectString);
                }
				else { echo "No results found."; }
			}
			else 
			{ 
				echo "Failed to connect to database."; 
			}
            
		}
        
      ////////grid combo for employee name//////////////  
        
        function name_gridCombo($dbName, $tableName, $columns, $passingValue)
		{
			$dbName='suvastuapp_22';
 /*       echo ("1:Bangladeesh;2:India"); */
			$dbSelect = mysql_select_db($dbName, $this->con);
			if(!$dbSelect){
				die('DB Not Selected: ' . mysql_error());
			}	
			$queryitem = 'SELECT distinct ' .  $columns . ' FROM ' . $tableName . ' order by ' . $passingValue;
			$stringArray = explode(',' , $columns);
            $selectString='0:Select;1:Add Name;';
          //  echo $stringArray[0]; echo $stringArray[1];
			if($result = mysql_query($queryitem)){
			$success = mysql_num_rows($result);
				//echo $success ."<br />";
				if($success > 0) { 
 
				//echo $success."<br />";
					$i = 0;
					while($i < $success){
                        while ($row = mysql_fetch_array($result)){
                         
                                if($i < $success - 1)	
                                {
                                    $selectString .= $row[$stringArray[0]].":".$row[$stringArray[1]].";";
                                }
                                else 
                                {
                                    $selectString .= $row[$stringArray[0]].":".$row[$stringArray[1]];
                                }
								$i = $i + 1;                                             
                        
                   		}
				   }
                   //echo("FE:FedEx;TN:TNT;ad:s");
                   echo($selectString);
                }
				else { echo "No results found."; }
			}
			else 
			{ 
				echo "Failed to connect to database."; 
			}
            
		}
        
        function att_name_gridCombo($dbName, $tableName, $columns, $passingValue)
		{
			$dbName='suvastuapp_22';
 /*       echo ("1:Bangladeesh;2:India"); */
			$dbSelect = mysql_select_db($dbName, $this->con);
			if(!$dbSelect){
				die('DB Not Selected: ' . mysql_error());
			}	
			$queryitem = 'SELECT distinct ' .  $columns . ' FROM ' . $tableName . ' order by ' . $passingValue;
			$stringArray = explode(',' , $columns);
            $selectString='';
          //  echo $stringArray[0]; echo $stringArray[1];
			if($result = mysql_query($queryitem)){
			$success = mysql_num_rows($result);
				//echo $success ."<br />";
				if($success > 0) { 
 
				//echo $success."<br />";
					$i = 1;
					while($i < $success){
                        while ($row = mysql_fetch_array($result)){
                         
                                if($i < $success - 1)	
                                {
                                    $selectString .= $row[$stringArray[1]].":".$row[$stringArray[1]].";";
                                }
                                else 
                                {
                                    $selectString .= $row[$stringArray[1]].":".$row[$stringArray[1]];
                                }
								$i = $i + 1;                                             
                        
                   		}
				   }
                   //echo("FE:FedEx;TN:TNT;ad:s");
                   echo($selectString);
                }
				else { echo "No results found."; }
			}
			else 
			{ 
				echo "Failed to connect to database."; 
			}
            
		}
        
        
        
		//Function for Data Grid View
        function viewGrid($dbName, $columns, $tables, $condition, $limit, $page, $sidx, $sord)
		{
			$dbName='suvastuapp_22';
			//Database Connection
			$db = $this->con;
			mysql_select_db($dbName) or die("Error conecting to db.");
			
			$str = $columns;
			$total = substr_count($str,',');
			$tmp_total = $total;
			
			//Records Count
			$result = mysql_query("SELECT COUNT(*) AS count FROM " . $tables . ' ' . $condition);
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			$count = $row['count'];
	
			if( $count >0 ) {
			$total_pages = ceil($count/$limit);
			} else {
				$total_pages = 0;
				}
			if ($page > $total_pages) $page=$total_pages;
			$start = $limit*$page - $limit; // do not put $limit*($page - 1)
			if ($start<0) $start = 0;
            
              
			$SQL = 'SELECT ' . $columns. ' FROM ' . $tables . ' ' . $condition . ' LIMIT ' .  $start . ', ' . $limit;
			//echo $SQL; die;
			$result = mysql_query( $SQL ) or die("Couldn t execute query.".mysql_error());
		
			$str = ',' . $str;
			if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
				header("Content-type: application/xhtml+xml;charset=utf-8"); } else {
				header("Content-type: text/xml;charset=utf-8");
			}
			$et = ">";
			$s = "<?xml version='1.0' encoding='utf-8'?$et\n";
			$s .= "<rows>";
			$s .= "<page>".$page."</page>";
			$s .= "<total>".$total_pages."</total>";
			$s .= "<records>".$count."</records>";
			
			// be sure to put text data in CDATA
			while($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
				//$s .= "<row id='". $row[invid]."'>";
				$s .= "<row id='". $row[trim(substr($str, 1, strpos($str , ',' , 1) - 1))]."'>";
				
				$i = 0;
				$total = $tmp_total;
				while( $total >=  0)
				{	
					$start = strpos($str , ',' , $i);
					$end = strpos($str , ',' , $start + 1);
					if ($total == 0)
						$s.= "<cell><![CDATA[". $row[trim(substr($str, $start + 1))]."]]></cell>";

					else{
						$s .=  "<cell><![CDATA[". $row[trim(substr($str, ($start + 1) , ($end - $start) - 1))]."]]></cell>";
					}
					$i = $start + 1;
					$total = $total - 1;
				}		
				$s .= "</row>";
			}
			$s .= "</rows>";
			echo $s;
			mysql_close($db);
		}
	/*	// Function for daynamic checkbox
		function dynamic_checkbox_list($dbName, $sql, $listName, $checkBoxName, $valueColumn, $titleColumn){
			//$sql="select group_id,group_name from usergroup";
				$db = $this->con;
				mysql_select_db($dbName) or die("Error conecting to db.");
            	$result=mysql_query($sql);
            	$string="<div style='background-color:#999999;height:25px;' align='center' >" . $listName . "</div><table  width='100%' height='100%' style='border:1px solid #CCCCCC; font:Tahoma; font-size:11px'><tr>";
            	while($row = mysql_fetch_array($result)){
            		$string.= "<td style='border-bottom:1px solid #CCCCCC;' ><input type='checkbox'  name='$checkBoxName' id=".$row[$valueColumn]." value=".$row[$valueColumn]." /></td ><td style='border-bottom:1px solid #CCCCCC;'>".$row[$titleColumn]."</td>";
                	$string.="</tr>";                    
            	}
            	$string.="</table>";
            	echo $string;
		}
		*/
		
		// new param added $tableId="null" by monir 
		// Function for daynamic checkbox
		function dynamic_checkbox_list($dbName, $sql, $listName, $checkBoxName, $valueColumn, $titleColumn,$tableId="null"){
			//$sql="select group_id,group_name from usergroup";
				$db = $this->con;
				$dbName='suvastuapp_22';
				mysql_select_db($dbName) or die("Error conecting to db.");
				//echo $sql;
				$result=mysql_query($sql);
				if($tableId!=null)
            	$string="<div style='background-color:#999999;height:25px;' align='center' >" . $listName . "</div><table  width='100%' style='border:1px solid #CCCCCC; font:Tahoma;  font-size:11px' id='".$tableId."'>";
            	else $string="<div style='background-color:#999999;height:25px;' align='center' >" . $listName . "</div><table  width='100%' height='100%' style='border:1px solid #CCCCCC; font:Tahoma; font-size:11px'><tr>";
            	while($row = mysql_fetch_array($result)){
            		$string.= "<td style='border-bottom:1px solid #CCCCCC;' ><input type='checkbox'  name='$checkBoxName' id=".$row[$valueColumn]." value=".$row[$valueColumn]." /></td ><td style='border-bottom:1px solid #CCCCCC;'>".$row[$titleColumn]."</td>";
                	$string.="</tr>";                    
            	}
            	$string.="</table>";
            	echo $string;
		}
		
		function dynamic_checkbox_list_update($dbName, $sql, $listName, $checkBoxName, $valueColumn, $titleColumn,$tableId="null"){
			$dbName='suvastuapp_22';
				$db = $this->con;
				mysql_select_db($dbName) or die("Error conecting to db.");
				//echo $sql;
            	$result=mysql_query($sql);
				$stringArray = explode(',' , $titleColumn);
				$column = count($stringArray);
            	if($tableId!=null)
            		 $string="<div style='background-color:#999999;height:25px;' align='center' >" . $listName . "</div><table  width='100%' style='border:1px solid #CCCCCC; font:Tahoma;  font-size:11px' id='".$tableId."'>";
            	else $string="<div style='background-color:#999999;height:25px;' align='center' >" . $listName . "</div><table  width='100%' height='100%' style='border:1px solid #CCCCCC; font:Tahoma; font-size:11px'><tr>";
				
				//$string="<div style='background-color:#999999;height:25px;' align='center' >" . $listName . "</div><table  width='100%' height='100%' style='border:1px solid #CCCCCC; font:Tahoma;  font-size:11px' >";
            	while($row = mysql_fetch_array($result)){
					$string.= "<tr><td style='border-bottom:1px solid #CCCCCC;' ><input type='checkbox'  name='$checkBoxName' id=".$row[$valueColumn]." value=".$row[$valueColumn]." /></td >";
					for($i = 0; $i < $column; $i++){
            			if($i == $column - 1){
            				$string.= "<td style='border-bottom:1px solid #CCCCCC; color:#009933;'>".$row[$stringArray[$i]]."</td>";    
						}
						else{    
							$string.= "<td style='border-bottom:1px solid #CCCCCC;'>".$row[$stringArray[$i]]."</td>";    
						}           	
					}   
					$string.="</tr>";                 
            	}
            	$string.="</table>";
            	echo $string;
		}
		
		//function for returning data array
		function oneRowdataArray($dbName, $sql)
		{
			$dbName='suvastuapp_22';
			$db = $this->con;
			mysql_select_db($dbName) or die("Error conecting to db.");
			
            $result = mysql_query($sql);
			//$i = 0;
			while($row = mysql_fetch_array($result))
			{
				//$values[$i] = $row[0];
				//$i ++;
				echo $row[0];
			}
			//return $values;
		}
		
		//function for returning data array
		function returnOneColResultSet($dbName, $sql)
		{
			$dbName='suvastuapp_22';
			$db = $this->con;
			mysql_select_db($dbName) or die("Error conecting to db.");
			
            $result = mysql_query($sql);
			$i = 0;
			//$values = array();
			while($row = mysql_fetch_array($result))
			{
				$values[$i] = $row[0];
				$i ++;
				//echo $row[0];
			}
			return $values;
		}
        
        function form_access_previllage($user_id, $form_id){        
            $sql="select group_id from user_group_member where  user_id=".$user_id." and group_id in (select group_id from form_access where form_id='" . $form_id . "')  ";
			//echo $sql; die;
            $row=mysql_fetch_row(mysql_query($sql));
           // var_dump($row);
			if($row){
               return "1";
               //return true;
            }
            else
               return "0";
                //return false;
        }
      
	  function numbertoword($number)
    {
        $denom   = array('Crore','Lac','Thousand','Hundred');
        $denom1  = array('One','Two','Three','Four','Five','Six','Seven','Eight','Nine');
        $denom10 = array('Ten','Twenty','Thirty','Forty','Fifty','Sixty','Seventy','Eighty','Ninety');
        $denom11 = array('Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventeen','Eighteen','Nineteen');
        $i=1;$output='';$abc=0;
        if($number == 0)
        {
            return 'zero';
        }
        while(round($number) > 0)
        {
            $digit1 = fmod($number ,10);
            $number = floor($number / 10);
            $dummy = $number;
            if($i > 10)
            {
                return 'Number Exceeded Computation Limits';
            }
            if($i==1 || $i==4 || $i==6 || $i==8)
            {
                $digit2= fmod($dummy ,10);;
                if($digit2 == 1)
                {
                    if($digit1 != 0)
                    $number = floor($number / 10);
                }
            }
            if($digit1 == 0)
            {
                 
                $i++;
                $test='';
                continue;
            }
            switch($i)
            {
                case 1:if (intval($digit2) == 1)
                        {
                            $output = $denom11[intval($digit1)-1].' '.$output;
                            $digit2 =0;
                            $i++;
                        }
                        else
                        {
                            $output = $denom1[intval($digit1)-1].' '.$output;
                        }
                         
                        break;
                case 2:$output = $denom10[intval($digit1)-1 ].' '.$output;
                         
                        break;
                 
                case 3:$output = $denom1[intval($digit1)-1].' '.$denom[3].' '.$output;
                    break;
                 
                case 4:if (intval($digit2) == 1)
                        {       
                            $output = $denom11[intval($digit1)-1].' '.$denom[2].' '.$output;
 
                            $i++;
                        }
                        else if($digit2 == 0)
                        {
                            $output = $denom1[intval($digit1)-1].' '.$denom[2].' '.$output;
                        }
                        else
                            $test = $denom1[intval($digit1)-1];
                             
                        break;
                case 5:$output = $denom10[intval($digit1)-1].' '.$test.' '.$denom[2].' '.$output;
                        break;
 
                case 6:if (intval($digit2) == 1)
                        {       
                            $output = $denom11[intval($digit1)-1].' '.$denom[1].' '.$output;
 
                            $i++;
                        }
                        else if($digit2 == 0)
                        {
                            $output = $denom1[intval($digit1)-1].' '.$denom[1].' '.$output;
                        }
                        else
                            $test = $denom1[intval($digit1)-1];break;
                case 7:$output = $denom10[intval($digit1)-1].' '.$test.' '.$denom[1].' '.$output;break;
 
                case 8:if (intval($digit2) == 1)
                        {       
                            $output = $denom11[intval($digit1)-1].' '.$denom[0].' '.$output;
 
                            $i++;
                        }
                        else if($digit2 == 0)
                        {
                            $output = $denom1[intval($digit1)-1].' '.$denom[0].' '.$output;
                        }
                        else
                            $test = $denom1[intval($digit1)-1];break;
                case 9:$output = $denom10[intval($digit1)-1].' '.$test.' '.$denom[0].' '.$output;break;
                case 10:$output = $denom1[intval($digit1)-1].' '.$denom[3].' '.$output; break;
                 
            }
            $i++;
        }
        return $output;
                 
    }
        //Function for selecting data from a database table
	
	
	function genComboReturn($dbName, $tableName, $columns, $passingValue, $condition, $passingTitle, $size, $select_id,$selected)
		{
			//echo $selected;die;
			//$var1 = '$row[\'';
			$dbName='suvastuapp_22';
			$var2 = null;
			$dbSelect = mysql_select_db($dbName, $this->con);
			if(!$dbSelect)
			{
				die('DB Not Selected: ' . mysql_error());
			}	
			$queryitem = 'SELECT distinct ' . $passingValue . ', ' .  $columns . ' FROM ' . $tableName . ' ' . $condition . ' order by ' . $passingValue;
			//echo $queryitem;die;
			$stringArray = explode(',' , $columns);
			$column = count($stringArray);			
			$return_string = "";
			if($result = mysql_query($queryitem))  
			{
				if($success = mysql_num_rows($result) > 0) 
				{
					$return_string .= '<select name="'.$passingTitle.'" id="'.$select_id.'" style="width: ' .$size.'px">';
					$return_string .= '<option value="null">Select</option>';
					while ($row = mysql_fetch_array($result)){
						for($i = 0; $i < $column; $i++)
						{
							//if($stringArray[$i] != $passingValue)
							//{
								$var1 = $row[$stringArray[$i]];
								if($i == 0)
									$var2 = $var1;
								else
									$var2 =  $var2 . ' -> ' . $var1;
								$var1 = null;
							//}
						}
						if( $row[$passingValue]==$selected)
							$return_string .= '<option value="' . $row[$passingValue] . '" selected="selected">' . htmlspecialchars($var2,ENT_QUOTES) . "</option>";
						else 
							$return_string .= '<option value="' . $row[$passingValue] . '">' . htmlspecialchars($var2,ENT_QUOTES) . "</option>";
							//str_replace('"','\"',$var2)
					}
					$return_string .=  "</select>";
				}
				else { $return_string .=  "There is no data"; }
			}
			else 
			{ 
				$return_string .=  "Failed to connect to database."; 
			}
			
			//$var3 = $row['emp_id']. "-". $row['full_name'];
			return $return_string;
		}
		
		
	function storeSmsRecord($sender, $reciever, $content, $date)
	{
		$databaseName='suvastuapp_22';
		mysql_select_db($databaseName, $this->con);
		$sql = "insert into sms_record(sender_emp_id, reciever_mob_no,content,date) values($sender, $reciever, $content,$date)";
		if(!mysql_query($sql, $this->con))
		{
			die('Error: ' .mysql_error());
		}			
	}
	
	function split_string($main_string, $position) 
   {  // uses  --> echo split_string($main_string, 25)
	   $len=strlen($main_string);
	   if ($len>$position)
	   {
		  $whole= chunk_split($main_string, $position);
	   }
	   else
		 $whole= $main_string;
	   return $whole;
   }
   
   //It will return result as object
   function getSigleResult($table_name,$where_column_name,$column_value){
	
	$SQL_QUERY = "SELECT * FROM ".$table_name." WHERE ".$where_column_name." = '".$column_value."' limit 1";
	//echo $SQL_QUERY;die;
	$result = mysql_query($SQL_QUERY);
	$row = mysql_fetch_object($result);
	/* acces it like "$row->column_name" */
	return $row;
	
   }
   
   function getSigleRecord($sql_query){
	   $result = mysql_query($sql_query);
	   $row = mysql_fetch_object($result);
	   return $row;	
   }
   
   
   function isRecordFound($table_name,$where_con){
	   $SQL_QUERY = "SELECT * FROM ".$table_name." WHERE ".$where_con;
	   $result = mysql_query($SQL_QUERY);
	   if(mysql_num_rows($result)>0){
		   return true;
	   }else{
		   return false;
	   }
   }
   
   function errorMessage(){
	   $message = "<table align='center' style='vertical-align:middle; margin-top:130px;' >
					<tr>
						<td><p align='center' style='color:red; font-size:18px; font-weight:bold'>You cannot access this page. !!! </p>	</td>
					</tr>
					<tr>
						<td align='left'><a  href='home.php'> back </a> </td>
					</tr>
				</table>";
		return $message;
	   
   }
   
   function getMonth($index){	   
	   $month=array("1"=>"January","2"=>"February","3"=>"March","4"=>"April","5"=>"May","6"=>"June","7"=>"July","8"=>"August","9"=>"September","10"=>"October","11"=>"November","12"=>"December");
	   return $month[intVal($index)];
   }
   
   function get_client_ip() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
		
}
?>