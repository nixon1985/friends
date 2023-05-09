<?php 
	session_start();
	date_default_timezone_set("Asia/Dhaka"); 
	
	class DBcontroller {
		
		private $dbCon;	
		private $userId;
		private $comId; /*Company Id*/
		private $finId; /*Financial Year Id*/

		public function __construct() {
			
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "somiti";

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo "Cannot Connect to Database : " . $e->getMessage();
			}	
			
			$this->dbCon  = $conn;
			$this->userId = 1;//$_SESSION['id'];
			$this->comId  = 1;//$_SESSION['user_company_id'];
			$this->finId  = 1;//$_SESSION['user_fin_id'];
		}
		
		function getDbConn(){
			return $this->dbCon;
		}
		
		function getUserId(){
			return $this->userId;
		}
		
		function getComId(){
			return $this->comId;
		}
		
		function getFinId(){
			return $this->finId;
		}


        function getNewMemberNo(){

            $newMemberId = "";

            /*Get Max Voucher ID*/
            $sql_query = "SELECT IFNULL(max(member_no)+1,1001) member_no from member_info";
            $stmt = $this->dbCon->prepare($sql_query);
            $stmt->execute();
            $newMemberNo = $stmt->fetch(PDO::FETCH_ASSOC);
            if(isset($newMemberNo['member_no'])){
                $newMemberId   = $newMemberNo['member_no'];
            }else{
                $newMemberId = "1001";
            }
            return $newMemberId;
        }



		
		function getComWiseFinId($comId){
			$sql_query = "SELECT fy_id from acc_fin_year WHERE fy_comid = '$comId' AND '".date("Y-m-d")."' BETWEEN  fy_start_dt AND fy_end_date";
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute(array(':id'=>$comId));
			$comInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$comInfo['fy_id'];	
		}
		
		
		function getPrevFinDetails(){
			$sql_query = "SELECT fy_id, date_format(fy_start_dt,'%Y-%m-%d') start_date, date_format(fy_end_date,'%Y-%m-%d') end_date 
						FROM acc_fin_year WHERE fy_comid = :id 
						ORDER BY fy_no DESC LIMIT 1,1";
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute(array(':id'=>$this->comId));
			$finInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$finInfo;
		}		

		function getComInfo(){
			$sql_query = "SELECT * FROM company_informations WHERE id=:id LIMIT 1";
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute(array(':id'=>$this->comId));
			$comInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$comInfo;	
		}
		
		function getComInfoById($comId){
			$sql_query = "SELECT * FROM company_informations WHERE id=:id LIMIT 1";
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute(array(':id'=>$comId));
			$comInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$comInfo;	
		}
		
		function getHeadOfficeID($company_id){
			$sql_query = "select project_code from project_infos where company_id = $company_id and project_name like '%Head Office%'";
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$headOfficeInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			return $headOfficeInfo['project_code'];		
		}
		
		function getProjectName($project_id){
			$sql_query = "select  project_name from project_infos where project_code='$project_id' ";
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$headOfficeInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			return $headOfficeInfo['project_name'];		
		}

		function getFinInfo(){
			$sql_query = "SELECT fy_id id,fy_no fin_no,fy_comid com_id ,DATE(fy_start_dt) start_date, DATE(fy_end_date) end_date FROM acc_fin_year WHERE fy_id=:fy_id LIMIT 1";
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute(array(':fy_id'=>$this->finId));
			$finInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$finInfo;	
		}
		
		function getGetOpenningBalance($head_id){
			$sql_query = "SELECT  (ob_debit-ob_credit)  as op_balance  FROM acc_opening_balance WHERE ob_ca_id=:head_id LIMIT 1";
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute(array(':head_id'=>$head_id));

			$opInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!$opInfo){
				$opInfo['op_balance']=0;	
			}
			return 	$opInfo;	
		}
		// openning balance only for Work progress head and sub head
		function getOpenningBalanceTillDateforWP($head_id, $till_date, $com_Id, $project){
			$com_condition = "";
			$con_group_by = "";
			$con_group_by2 = "";			
			$com2_condition = "";
			$join_on_con = " A.company_id=B.company_id";
			
			if($project != ""){
				$com_condition 	= "  AND vd_project_code='$project'";
				$com2_condition = " and ob_project='$project'";
				$con_group_by = " GROUP BY vd_project_code";
				$con_group_by2 = " GROUP BY ob_project";
				$join_on_con = " A.vd_project_code=B.ob_project";			
				$project= $this->getHeadOfficeID($com_Id);
			}
			$head_count = strlen($head_id);
			
			$sql = "SELECT  vd_project_code, ((IFNULL(upto_debit,0) + IFNULL(ob_debir,0)) -(IFNULL(upto_credit,0) + IFNULL(ob_credit,0))) openning_balance
				FROM(
					SELECT SUBSTRING(vm_vno,10) vno_1,vd_project_code, SUM(vd_debit) upto_debit, SUM(vd_credit) upto_credit, v.company_id
					FROM view_ledger_mgt v
					left join project_infos p on v.vd_project_code=p.project_code
					WHERE v.company_id =".$com_Id."	AND ((p.project_name NOT like '%Head office%' AND SUBSTRING(vd_ca_id,1,1) = '8') OR substr(vd_ca_id,1,$head_count) = '$head_id' ) AND vm_vdate < '$till_date' $com_condition $con_group_by							
				)A
				LEFT JOIN(
					SELECT ob_project, SUM(ob_debit) ob_debir, SUM(ob_credit) ob_credit, company_id
					FROM acc_opening_balance
					WHERE company_id =".$com_Id."  AND ob_fy_id <=67 AND substr(ob_ca_id,1,$head_count)= '$head_id'
					$con_group_by2
				)B ON $join_on_con
			";
			//echo $sql;die;
			//if($project != ''){echo $sql.'*********';}
			$stmt = $this->dbCon->prepare($sql);
			$stmt->execute();
			$opInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!$opInfo || $opInfo['openning_balance']==0){
				$only_opening_blnce_sql = "
						SELECT (sum(ob_debit)-sum(ob_credit))only_openning_balance
						FROM acc_opening_balance
						WHERE company_id =".$com_Id."  AND substr(ob_ca_id,1,$head_count)= '$head_id' $com2_condition AND ob_fy_id <=67
						";
						//echo $only_opening_blnce_sql;die;
					//if($project != ''){echo $only_opening_blnce_sql.'*********';die;}					
					$only_opInfo_stmt = $this->dbCon->prepare($only_opening_blnce_sql);
					$only_opInfo_stmt->execute();
					$only_opInfo = $only_opInfo_stmt->fetch(PDO::FETCH_ASSOC);
				if($only_opInfo){
					$opInfo['openning_balance']=$only_opInfo['only_openning_balance'];	
				}
				else	
					$opInfo['openning_balance']=0;	
			}
			return 	$opInfo['openning_balance'];	
		}
		
		

		
		function getOpenningBalanceTillDate($head_id, $till_date, $com_Id, $project, $fin_year){
			if($fin_year == ''){
				$fin_year = $vm_fin_year;
			}
			
			//echo $fin_year;die;
			$head_count = strlen($head_id);	
			$com_condition = "";
			$con_group_by = " GROUP BY SUBSTR(vd_ca_id,1,$head_count)";
			$con_group_by2 = " GROUP BY  SUBSTR(ob_ca_id,1,$head_count)";			
			$com2_condition = "";
			$join_on_con = " A.company_id=B.company_id";
			
			if($project != ""){
				$com_condition 	= "  AND vd_project_code='$project'";
				$com2_condition = " and ob_project='$project'";
				$con_group_by = " GROUP BY vd_project_code";
				$con_group_by2 = " GROUP BY ob_project";
				$join_on_con = " A.vd_project_code=B.ob_project";			
				$project= $this->getHeadOfficeID($com_Id);
			}
			
					
			$sql = "SELECT project_code , acc_group_id, ca_id, fun_get_ca_sub_group_name(acc_group_id)
					,SUM(case dc_type when 'P' then debit when 'O' then debit ELSE 0 END) o_debit,
					SUM(case dc_type when 'P' then credit when 'O' then credit ELSE 0 END) o_credit
					FROM(
						SELECT vd_project_code AS  project_code, SUBSTR(vd_ca_id,1,3) AS acc_group_id, vd_ca_id AS ca_id,	SUM(vd_debit) AS debit, SUM(vd_credit) AS credit , 'P' AS dc_type
						FROM view_ledger_mgt 
						WHERE vm_vdate <  '$till_date' AND company_id=$com_Id  AND substr(vd_ca_id,1,$head_count) = '$head_id'	$com_condition
						$con_group_by
						
						UNION 
						
						SELECT ob_project AS project_code,  SUBSTR(ob_ca_id,1,3) AS acc_group_id,  ob_ca_id AS ca_id, SUM(ob_debit) debit, SUM(ob_credit)  credit, 'O' AS dc_type
						FROM acc_opening_balance a 
						WHERE company_id=$com_Id  AND substr(ob_ca_id,1,$head_count)= '$head_id' AND ob_fy_id = $fin_year $com2_condition
						$con_group_by2
					) A	
			
					";
			//echo $sql;die;
			//if($head_id == '217'){echo $sql.'*********';}
			$stmt = $this->dbCon->prepare($sql);
			$stmt->execute();
			$opInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$openning_balance = 0;
			if($opInfo){
				foreach ($opInfo as $row){				  
					$openning_balance = $row['o_debit']-$row['o_credit'];
				}
			}
			return $openning_balance;

		}
		
		
		function getOpenningBalanceTillDateAllCompany($head_id, $till_date, $com_Id, $project){
			$head_count = strlen($head_id);	
			$com_condition = "";
			$con_group_by = " GROUP BY SUBSTR(vd_ca_id,1,$head_count)";
			$con_group_by2 = " GROUP BY  SUBSTR(ob_ca_id,1,$head_count)";			
			$com2_condition = "";
			$join_on_con = " A.company_id=B.company_id";
			
			if($project != ""){
				$com_condition 	= "  AND vd_project_code='$project'";
				$com2_condition = " and ob_project='$project'";
				$con_group_by = " GROUP BY vd_project_code";
				$con_group_by2 = " GROUP BY ob_project";
				$join_on_con = " A.vd_project_code=B.ob_project";			
				$project= $this->getHeadOfficeID($com_Id);
			}
			
					
			$sql = "SELECT project_code , acc_group_id, ca_id, fun_get_ca_sub_group_name(acc_group_id)
					,SUM(case dc_type when 'P' then debit when 'O' then debit ELSE 0 END) o_debit,
					SUM(case dc_type when 'P' then credit when 'O' then credit ELSE 0 END) o_credit
					FROM(
						SELECT vd_project_code AS  project_code, SUBSTR(vd_ca_id,1,3) AS acc_group_id, vd_ca_id AS ca_id,	SUM(vd_debit) AS debit, SUM(vd_credit) AS credit , 'P' AS dc_type
						FROM view_ledger_mgt 
						WHERE vm_vdate <  '$till_date' /* AND company_id=$com_Id */ AND substr(vd_ca_id,1,$head_count) = '$head_id' $com_condition
								
						$con_group_by					
						UNION 
						SELECT ob_project AS project_code,  SUBSTR(ob_ca_id,1,3) AS acc_group_id,  ob_ca_id AS ca_id, SUM(ob_debit) debit, SUM(ob_credit)  credit, 'O' AS dc_type
						FROM acc_opening_balance a 
						WHERE /* company_id=$com_Id  AND */ ob_fy_id <=67 AND substr(ob_ca_id,1,$head_count)= '$head_id'  $com2_condition
						$con_group_by2
					) A	
			
					";
			//echo $sql;die;
			//if($head_id == '217'){echo $sql.'*********';}
			$stmt = $this->dbCon->prepare($sql);
			$stmt->execute();
			$opInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$openning_balance = 0;
			if($opInfo){
				foreach ($opInfo as $row){				  
					$openning_balance = $row['o_debit']-$row['o_credit'];
				}
			}
			return $openning_balance;
			
		}
		
		
		function getOpenningBalanceTillDateProject($head_id, $till_date, $com_Id, $project){
			$com_condition = "";
			$con_group_by = "";
			$con_group_by2 = "";			
			$com2_condition = "";
			$join_on_con = " A.company_id=B.company_id";
			
			if($project != ""){
				$com_condition 	= "  AND vd_project_code='$project'";
				$com2_condition = " and ob_project='$project'";
				$con_group_by = " GROUP BY vd_project_code";
				$con_group_by2 = " GROUP BY ob_project";
				$join_on_con = " A.vd_project_code=B.ob_project";			
				$project= $this->getHeadOfficeID($com_Id);
			}
			$head_count = strlen($head_id);
			
			$sql = "SELECT  vd_project_code, 
						((IFNULL(upto_debit,0) + IFNULL(ob_debir,0)) -(IFNULL(upto_credit,0) + IFNULL(ob_credit,0))) openning_balance
						FROM(
							SELECT SUBSTRING(vm_vno,10) vno_1,vd_project_code, SUM(vd_debit) upto_debit, SUM(vd_credit) upto_credit, company_id
							FROM view_ledger_mgt
							WHERE company_id =".$com_Id." 	AND substr(vd_ca_id,1,$head_count) = '$head_id'  AND vm_vdate < '$till_date' $com_condition $con_group_by							
						)A
						LEFT JOIN(
							SELECT ob_project, SUM(ob_debit) ob_debir, SUM(ob_credit) ob_credit, company_id
							FROM acc_opening_balance
							WHERE company_id =".$com_Id." AND ob_fy_id <=67 AND substr(ob_ca_id,1,$head_count)= '$head_id'
							$con_group_by2
						)B ON $join_on_con
					";
				
			//if($head_id == '217'){echo $sql.'*********';}
			$stmt = $this->dbCon->prepare($sql);
			$stmt->execute();
			$opInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!$opInfo || $opInfo['openning_balance']==0){
				$only_opening_blnce_sql = "
						SELECT (sum(ob_debit)-sum(ob_credit))only_openning_balance
						FROM acc_opening_balance
						WHERE company_id =".$com_Id."  AND substr(ob_ca_id,1,$head_count)= '$head_id' $com2_condition AND ob_fy_id <=67
						";
					//if($head_id == '217'){echo $only_opening_blnce_sql.'*********';}					
					$only_opInfo_stmt = $this->dbCon->prepare($only_opening_blnce_sql);
					$only_opInfo_stmt->execute();
					$only_opInfo = $only_opInfo_stmt->fetch(PDO::FETCH_ASSOC);
				if($only_opInfo){
					$opInfo['openning_balance']=$only_opInfo['only_openning_balance'];	
				}
				else	
					$opInfo['openning_balance']=0;	
			}
			return 	$opInfo['openning_balance'];	
		}
		
		//get update opening balance fin year wise 
		function getOpeningBalanceFinYearWise($start_date,$end_date,$ca_id,$fin_year,$company_id,$project_code){
			
			$p_details = $this->getSingleResult("SELECT fy_id, date_format(fy_start_dt,'%Y-%m-%d') start_date,
												DATE_ADD('$start_date', INTERVAL - 1 DAY) AS end_date
												FROM acc_fin_year 
												WHERE fy_comid = $company_id AND '$start_date' BETWEEN fy_start_dt AND fy_end_date");
			
			
			//var_dump($p_details);die;
			if(empty($p_details)){
				$p_startDate = '0000-00-00';
				$p_endDate   = '0000-00-00';
			}else{
				$p_startDate = $p_details['start_date'];
				$p_endDate   = $p_details['end_date'];
			}
						
			if(isset($project_code) && $project_code != ''){
				$con1 = " AND vd.vd_project_code = '$project_code' "; 
				$con2 = " AND ob_project = '$project_code' "; 
			}else{
				$con1 = '';
				$con2 = '';
			}
			
			$sql = "SELECT project_code, ca_id,
				(sum(ob_debit) + SUM(p_debit)) ob_debit, (sum(ob_credit) + SUM(p_credit)) ob_credit,
				sum(c_debit) c_debit,  sum(c_credit) c_credit, 
				case when (sum(ob_debit) + SUM(p_debit) + sum(c_debit)) > (sum(ob_credit) + SUM(p_credit) + sum(c_credit)) 
				then (sum(ob_debit) + SUM(p_debit) + sum(c_debit)) - (sum(ob_credit) + SUM(p_credit) + sum(c_credit)) ELSE 0 end closing_debit, 
				case when (sum(ob_debit) + SUM(p_debit) + sum(c_debit)) < (sum(ob_credit) + SUM(p_credit) + sum(c_credit)) 
				then (sum(ob_credit) + SUM(p_credit) + sum(c_credit)) - (sum(ob_debit) + SUM(p_debit) + sum(c_debit)) ELSE 0 end closing_credit
				FROM 
				(
					SELECT vd_ca_id as ca_id, vd_project_code as project_code, 
					case when period = 'opening' then vd_debit ELSE 0 END ob_debit, 
					case when period = 'previous' then vd_debit ELSE 0 END p_debit, 
					case when period = 'current' then vd_debit ELSE 0 END c_debit, 
					case when period = 'opening' then vd_credit ELSE 0 END ob_credit, 
					case when period = 'previous' then vd_credit ELSE 0 END p_credit, 
					case when period = 'current' then vd_credit ELSE 0 END c_credit
					FROM
					(
						SELECT vd.vd_ca_id,vd.vd_project_code, sum(vd.vd_debit) vd_debit,
						sum(vd.vd_credit) vd_credit,'previous' AS period , SUBSTRING(vd.vd_ca_id,1,1) groupType,
						SUBSTRING(vd.vd_ca_id,1,3) sub_group, SUBSTRING(vd.vd_ca_id,1,6) ca_sub_group
						FROM acc_voucher_master vm
						JOIN acc_voucher_detail vd
						WHERE vm.vm_vno = vd.vd_vno AND vm.vm_vdate BETWEEN '".$p_startDate."' AND '".$p_endDate."' $con1 AND vm.company_id = $company_id 
						GROUP BY vd.vd_project_code, vd.vd_ca_id					
						
						UNION ALL  
						
						SELECT ob_ca_id vd_ca_id, ob.ob_project vd_project_code, sum(ob_debit) vd_debit, sum(ob_credit) vd_credit, 'opening' AS period,
						SUBSTRING(ob_ca_id,1,1) groupType, SUBSTRING(ob.ob_ca_id,1,3) sub_group, SUBSTRING(ob.ob_ca_id,1,6) ca_sub_group
						FROM acc_opening_balance ob WHERE ob.company_id = $company_id AND ob_fy_id = $fin_year $con2
						GROUP BY ob.ob_project, ob_ca_id
					) a
					ORDER BY ca_id
				) b
				WHERE ca_id = '$ca_id'
				GROUP BY ca_id";
			
			$stmt = $this->dbCon->prepare($sql);
			$stmt->execute();
			$opInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			//echo $sql;die;
			if(empty($opInfo)){
				return "0";
			}
			else{				
				return 	$opInfo['closing_debit']-$opInfo['closing_credit'];
			}
		}
		
		
		//update opening balance date wise
		function getOpeningBalanceDateWise($start_date,$end_date,$ca_id,$company_id,$project_code){
			
			$p_details = $this->getSingleResult("SELECT fy_id, date_format(fy_start_dt,'%Y-%m-%d') start_date,
												DATE_ADD('$start_date', INTERVAL - 1 DAY) AS end_date
												FROM acc_fin_year 
												WHERE fy_comid = $company_id AND '$start_date' BETWEEN fy_start_dt AND fy_end_date");
			
			
			//var_dump($p_details);die;
			if(empty($p_details)){
				$p_startDate = '0000-00-00';
				$p_endDate   = '0000-00-00';
			}else{
				$p_startDate = $p_details['start_date'];
				$p_endDate   = $p_details['end_date'];
			}
						
			if(isset($project_code) && $project_code != ''){
				$con1 = " AND vd.vd_project_code = '$project_code' "; 
				$con2 = " AND ob_project = '$project_code' "; 
			}else{
				$con1 = '';
				$con2 = '';
			}
			
			$sql = "SELECT project_code, ca_id,
				(sum(ob_debit) + SUM(p_debit)) ob_debit, (sum(ob_credit) + SUM(p_credit)) ob_credit,
				sum(c_debit) c_debit,  sum(c_credit) c_credit, 
				case when (sum(ob_debit) + SUM(p_debit) + sum(c_debit)) > (sum(ob_credit) + SUM(p_credit) + sum(c_credit)) 
				then (sum(ob_debit) + SUM(p_debit) + sum(c_debit)) - (sum(ob_credit) + SUM(p_credit) + sum(c_credit)) ELSE 0 end closing_debit, 
				case when (sum(ob_debit) + SUM(p_debit) + sum(c_debit)) < (sum(ob_credit) + SUM(p_credit) + sum(c_credit)) 
				then (sum(ob_credit) + SUM(p_credit) + sum(c_credit)) - (sum(ob_debit) + SUM(p_debit) + sum(c_debit)) ELSE 0 end closing_credit
				FROM 
				(
					SELECT vd_ca_id as ca_id, vd_project_code as project_code, 
					case when period = 'opening' then vd_debit ELSE 0 END ob_debit, 
					case when period = 'previous' then vd_debit ELSE 0 END p_debit, 
					case when period = 'current' then vd_debit ELSE 0 END c_debit, 
					case when period = 'opening' then vd_credit ELSE 0 END ob_credit, 
					case when period = 'previous' then vd_credit ELSE 0 END p_credit, 
					case when period = 'current' then vd_credit ELSE 0 END c_credit
					FROM
					(
						SELECT vd.vd_ca_id,vd.vd_project_code, sum(vd.vd_debit) vd_debit,
						sum(vd.vd_credit) vd_credit,'previous' AS period , SUBSTRING(vd.vd_ca_id,1,1) groupType,
						SUBSTRING(vd.vd_ca_id,1,3) sub_group, SUBSTRING(vd.vd_ca_id,1,6) ca_sub_group
						FROM acc_voucher_master vm
						JOIN acc_voucher_detail vd
						WHERE vm.vm_vno = vd.vd_vno AND vm.vm_vdate BETWEEN '".$p_startDate."' AND '".$p_endDate."' $con1 AND vm.company_id = $company_id 
						GROUP BY vd.vd_project_code, vd.vd_ca_id					
						
						UNION ALL  
						
						SELECT ob_ca_id vd_ca_id, ob.ob_project vd_project_code, sum(ob_debit) vd_debit, sum(ob_credit) vd_credit, 'opening' AS period,
						SUBSTRING(ob_ca_id,1,1) groupType, SUBSTRING(ob.ob_ca_id,1,3) sub_group, SUBSTRING(ob.ob_ca_id,1,6) ca_sub_group
						FROM acc_opening_balance ob WHERE ob.company_id = $company_id AND ob_fy_id = ".$p_details['fy_id']." $con2
						GROUP BY ob.ob_project, ob_ca_id
					) a
					ORDER BY ca_id
				) b
				WHERE ca_id = '$ca_id'
				GROUP BY ca_id";
			
			$stmt = $this->dbCon->prepare($sql);
			$stmt->execute();
			$opInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			//echo $sql;die;
			if(empty($opInfo)){
				return "0";
			}
			else{				
				return 	$opInfo['closing_debit']-$opInfo['closing_credit'];
			}
		}
		
		
		
		function getDailyReceivePayment($type,$com_Id,$vtype){
			$c_date = date("Y-m-d");
			if($vtype==1){
				$vcode = '210009035';
			}else if ($vtype == ""){
				$vcode = '202002';
			}
			$total_daily_receive_payment_infos = $this->getSingleResult("SELECT sum(vd_debit) as vd_debit, sum(vd_credit) as vd_credit
																		FROM view_ledger_mgt m
																		WHERE m.company_id =$com_Id AND m.vd_ca_id='$vcode' and m.vm_vdate='$c_date'");
			
			if($type == 'PVC')       return 	$total_daily_receive_payment_infos['vd_credit'];	
			else  if($type == 'RVC') return 	$total_daily_receive_payment_infos['vd_debit'];	
		}
		
		
		function is_valid_access($view_id){				
			
			$sql_query = "SELECT * FROM appuser WHERE user_id=:user_id";
			$stmt_user = $this->dbCon->prepare($sql_query);
			$stmt_user->execute(array(':user_id'=>$this->userId));
			$userInfo = $stmt_user->fetch(PDO::FETCH_ASSOC);
			
			if($userInfo['user_level'] == "ROLE_ADMIN"){
				return true;
			} else {
			
				$sql_query = "SELECT group_id
				FROM user_group_member
				WHERE user_id=:user_id AND group_id IN (
				SELECT group_id
				FROM form_access
				WHERE form_id=:form_id)";
				$stmt = $this->dbCon->prepare($sql_query);
				$stmt->execute(array(':user_id'=>$this->userId, ':form_id'=>$view_id));
				$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			
				if($stmt->rowCount() > 0){
					return true;
				} else {
					return false;
				}
			}			
			return false;			
		}
				
		
		function isValidAccess($view_id){			
			$sql_query = "SELECT * FROM appuser WHERE user_id=:user_id";
			$stmt_user = $this->dbCon->prepare($sql_query);
			$stmt_user->execute(array(':user_id'=>$this->userId));
			$userInfo = $stmt_user->fetch(PDO::FETCH_ASSOC);
			
			if($userInfo['user_level'] == "ROLE_ADMIN"){
				return true;
			} else {
			
				$sql_query = "SELECT * FROM app_view_access WHERE user_id=:user_id AND view_id=:view_id";
				$stmt = $this->dbCon->prepare($sql_query);
				$stmt->execute(array(':user_id'=>$this->userId, ':view_id'=>$view_id));
				$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);			
				if($stmt->rowCount() > 0){
					return true;
				} else {
					return false;
				}			
			}			
			return false;		
			
		}
		
		function check_group_access($group_id){
			$sql_query = "SELECT * FROM user_group_member	WHERE user_id=:user_id and group_id=:group_id";
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute(array(':user_id'=>$this->userId, ':group_id'=>$group_id));
			$accessInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() > 0){
				return true;
			} else {
				return false;
			}
		}
			
		
		
		function is_valid_Site_EMP_access($view_id ,$group_id ){	
			if($this->check_group_access($group_id)){
				$sql_query = "SELECT * FROM form_access	WHERE form_id=:form_id and group_id=:group_id";
				$stmt = $this->dbCon->prepare($sql_query);
				$stmt->execute(array(':group_id'=>$group_id, ':form_id'=>$view_id));
				$accessInfo = $stmt->fetch(PDO::FETCH_ASSOC);	
				if($stmt->rowCount() > 0){
					return true;
				} else {
					return false;
				}
			}
			else 
				return false;
		}
		
				
		function MASTER_ROLL_SALARY_SETUP($emp_id){
			// After deleting all pay_emp_salary_setup data for the employees again insert setup data
			$delete_salary_setup_sql = "DELETE  FROM pay_emp_salary_setup WHERE EMP_ID='".$emp_id."' and ALLOW_DEDUC_ID!=19";
			$delete_salary_setup = $this->dbCon->prepare($delete_salary_setup_sql);
			$deleted_salary = $delete_salary_setup->execute();
			if($deleted_salary){
				$consd_salary_sql = "SELECT e.EMP_ID, CONSOLIDATED_SALARY, fooding,wash_hair_cut,welfare_fund ,ifnull(special_allowance,0) SPECIAL	FROM EMP_INFOS e WHERE CONSOLIDATED_SALARY IS NOT NULL AND e.EMP_ID='".$emp_id."'";
				$consd_salary_sql_result = $this->getSingleResult($consd_salary_sql);
				$c_salary = $consd_salary_sql_result['CONSOLIDATED_SALARY'];
				$fooding 		= $consd_salary_sql_result['fooding'];
				$wash_hair_cut 	= $consd_salary_sql_result['wash_hair_cut'];
				$welfare_fund 	= $consd_salary_sql_result['welfare_fund'];
				$special 		= $consd_salary_sql_result['SPECIAL'];
				//echo $special; die;
				if($c_salary>0){
					$basic = ($c_salary*50)/100;
					$conditional_sql = "";

					if($fooding >0) 		$conditional_sql .= ",('".$emp_id."',12,$fooding,0)";
					if($wash_hair_cut >0) 	$conditional_sql .= ",('".$emp_id."',10,$wash_hair_cut,0)";
					if($welfare_fund >0) 	$conditional_sql .= ",('".$emp_id."',18,$welfare_fund,0)";
					if($special >0) 		$conditional_sql .= ",('".$emp_id."',17,$special,0)";
					else 					$conditional_sql .= ",('".$emp_id."',17,0,0)";					
					$salary_setup_sql  = "INSERT INTO PAY_EMP_SALARY_SETUP(EMP_ID, ALLOW_DEDUC_ID, AMOUNT,GROSS_PERCENT)
								VALUES
								('".$emp_id."',1,".$c_salary.",100), 
								('".$emp_id."',2,$basic, 50.00),
								('".$emp_id."',16,0,0),
								('".$emp_id."',20,0,0)".$conditional_sql;
					//echo $salary_setup_sql.'+++';//die; 
					$salary_setup = $this->dbCon->prepare($salary_setup_sql);
					$salary_setup->execute();						 	
				}			
			}
		}
		
		
		/*Getting Company Financial Years*/
		function getComFinYear(){			
			$sql_query = "SELECT fin.fy_id fin_id, DATE_FORMAT(fin.fy_start_dt,'%d/%m/%Y') fin_start
			, DATE_FORMAT(fin.fy_end_date,'%d/%m/%Y') fin_end
			FROM acc_fin_year fin
			WHERE fin.fy_comid=:fy_comid
			ORDER BY fin.fy_id DESC";		
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute(array(':fy_comid'=>$this->comId));
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		
		function getSingleResult($sql_query){
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$result;	
		}
		
		function getResultList($sql_query){		
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return 	$result;	
		}
		
		function getEmpInfo($emp_id){
			$sql_query = "SELECT * FROM view_emp_report WHERE emp_id = '$emp_id' LIMIT 1";
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$result;	
		}
		
		function getEmpSignature($emp_id){
			$sql_query = "SELECT signature FROM view_empdatasearch WHERE emp_id = '$emp_id' LIMIT 1";
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$result;	
		}		
		
		function getSupplierInfo($supplier_id){
			$sql_query = "SELECT supplier_id, supplier_name FROM supplier_infos WHERE supplier_id = $supplier_id";
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$result;	
		}
		
		
		function getDailyCashReceipt($companyId,$c_date){
			$sql_query = "SELECT SUM(credit) t_credit
						FROM(
							SELECT vm1.company_id, fun_get_company_name(vm1.company_id) company_name, vd1.vd_ca_id, 
							fun_get_ca_head_name(vd1.vd_ca_id) particular, SUM(vd1.vd_debit) debit, SUM(vd1.vd_credit) credit
							FROM acc_voucher_master vm1, acc_voucher_detail vd1
							WHERE vm1.vm_vno = vd1.vd_vno AND vd1.vd_ca_id != '202002' AND vd1.vd_vno 
							IN (SELECT DISTINCT vd.vd_vno FROM acc_voucher_detail vd, acc_voucher_master vm 
							WHERE vd.vd_vno = vm.vm_vno AND vd_ca_id = '202002' AND vm.vm_vdate = '$c_date' AND vm.company_id = $companyId)
							GROUP BY vd1.vd_ca_id, vm1.company_id
							ORDER BY vm1.company_id
						)A";	 	
			//echo $sql_query;die;
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$result['t_credit'];	
		}
		
		function getDailyCashReceipt1($companyId,$c_date){
			$sql_query = "SELECT sum(vd.vd_debit) total_received FROM acc_voucher_detail vd, acc_voucher_master vm
						WHERE vd.vd_vno = vm.vm_vno AND vd_ca_id = '202002' AND vm.vm_vdate = '$c_date' AND vm.company_id = '$companyId'"; 	
			//echo $sql_query;die;
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$result['total_received'];	
		}
		
		function getDailyCashPayment($companyId,$c_date){
			$sql_query = "SELECT SUM(debit) t_debit
						FROM(
							SELECT vm1.company_id, fun_get_company_name(vm1.company_id) company_name, vd1.vd_ca_id, 
							fun_get_ca_head_name(vd1.vd_ca_id) particular, SUM(vd1.vd_debit) debit, SUM(vd1.vd_credit) credit
							FROM acc_voucher_master vm1, acc_voucher_detail vd1
							WHERE vm1.vm_vno = vd1.vd_vno AND vd1.vd_ca_id != '202002' AND vd1.vd_vno 
							IN (SELECT DISTINCT vd.vd_vno FROM acc_voucher_detail vd, acc_voucher_master vm 
							WHERE vd.vd_vno = vm.vm_vno AND vd_ca_id = '202002' AND vm.vm_vdate = '$c_date' AND vm.company_id = $companyId)
							GROUP BY vd1.vd_ca_id, vm1.company_id
							ORDER BY vm1.company_id
						)A";
			//echo $sql_query;die;
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$result['t_debit'];	
		}
		
		
		function getDailyCashPaymentDetails($companyId,$acc_code,$c_date){
			
			$sql_query ="SELECT * FROM(
						SELECT vm1.company_id, fun_get_company_name(vm1.company_id) company_name, vd1.vd_ca_id, 
						fun_get_ca_head_name(vd1.vd_ca_id) particular, SUM(vd1.vd_debit) debit, SUM(vd1.vd_credit) credit
						FROM acc_voucher_master vm1, acc_voucher_detail vd1
						WHERE vm1.vm_vno = vd1.vd_vno AND vd1.vd_ca_id != '202002' AND vd1.vd_vno 
						IN (SELECT DISTINCT vd.vd_vno FROM acc_voucher_detail vd, acc_voucher_master vm 
						WHERE vd.vd_vno = vm.vm_vno AND vd_ca_id = '202002' AND vm.vm_vdate = '$c_date' AND vm.company_id = $companyId)
						AND vd1.vd_ca_id = '$acc_code'
						GROUP BY vd1.vd_ca_id, vm1.company_id
						ORDER BY vm1.company_id
						)A WHERE A.debit>0";
				
			///echo $sql_query;die;
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$result['debit'];	
		}
		
		function getDailyCashPaymentDetails1($companyId,$acc_code,$c_date){
			
			 $sql_query ="SELECT sum(vd.vd_debit) debit FROM acc_voucher_detail vd, acc_voucher_master vm
					WHERE vd.vd_vno = vm.vm_vno AND vm.vm_vdate = '$c_date' AND vm.company_id = $companyId AND vd_ca_id = '$acc_code'"; 
				
			///echo $sql_query;die;
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			return 	$result['debit'];	
		}
		
		
		function getDepartments(){			
			$sql_query = "SELECT department_id,department_name FROM hrm_departments WHERE display=0 ORDER BY department_name";		
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		
		function getDesignations(){			
			$sql_query = "SELECT id,designation_title,short_name FROM hrm_designations ORDER BY designation_title";		
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		
		function getMonths(){			
			$sql_query = "SELECT month_id,month_name FROM hrm_month";		
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		
		function getBanks(){			
			$sql_query = "SELECT * FROM acc_bank_info ORDER BY bi_name";		
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		
		function errorMessage(){
		   $message = "<table align='center' style='vertical-align:middle; margin-top:130px;' >
						<tr><td><p align='center' style='color:red; font-size:18px; font-weight:bold'>You cannot access this page !!! </p></td></tr>
						<tr><td align='left'><a href='home.php'> back </a></td></tr>
					</table>";
			return $message;	   
	    }
		
		function getDate($param_date){
			$date = date_create($param_date);
			return date_format($date,"d-m-Y");
	    }
		
		function getCurrentDateTime(){			
			return date('d/m/Y h:i A');
	    }
		
		function getFormattedBalance($balance){			
			$format_balance = "";
		
			if($balance<0){
				$format_balance = "(".number_format(abs($balance),2).")";
			} else {
				$format_balance = number_format($balance,2);
			}
			
			return $format_balance;
	    }
		
		function getPVoucherId($fin_no,$voucherTp,$vDate){	
			$voucher_id = "";
			$vmonth     = date("m",strtotime($vDate));	
			$vyear     = date("Y",strtotime($vDate));	
			
			$sub_str_no = ($voucherTp=='JV')?2:3;
			/*$sql_query = "SELECT max(cast(SUBSTRING(vm_vno,10) AS UNSIGNED)) max_sl_no, vm_vno maxVno from acc_voucher_master where SUBSTRING(vm_vno,7,$sub_str_no) =:voucherTp AND company_id=:company_id AND vm_fin_year=:vm_fin_year AND MONTH(vm_vdate)=:vmonth AND YEAR(vm_vdate) = :vyear";*/
			
			$sql_query = "SELECT vm_vno maxVno from acc_voucher_master where SUBSTRING(vm_vno,7,$sub_str_no) =:voucherTp AND company_id=:company_id AND vm_fin_year=:vm_fin_year AND MONTH(vm_vdate)=:vmonth AND YEAR(vm_vdate) = :vyear and cast(SUBSTRING(vm_vno,10) AS UNSIGNED) = (SELECT max(cast(SUBSTRING(vm_vno,10) AS UNSIGNED)) from acc_voucher_master where SUBSTRING(vm_vno,7,$sub_str_no) =:voucherTp AND company_id=:company_id AND vm_fin_year=:vm_fin_year AND MONTH(vm_vdate)=:vmonth AND YEAR(vm_vdate) = :vyear)";
			
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute(array(':voucherTp'=>$voucherTp,':company_id'=>$this->comId,':vm_fin_year'=>$this->finId,':vmonth'=>$vmonth, ':vyear'=>$vyear));		
			$voucherInfo = $stmt->fetch(PDO::FETCH_ASSOC);		
			//$this->print_arrays($voucherInfo);
			if(isset($voucherInfo['maxVno'])){				
				$temp_com_id = str_pad(substr($voucherInfo['maxVno'], 0, 2), 2, '0', STR_PAD_LEFT);
				$temp_fin_year = str_pad($fin_no, 2, '0', STR_PAD_LEFT);
				$temp_vmonth = str_pad($vmonth, 2, '0', STR_PAD_LEFT);
				$temp_type = substr($voucherInfo['maxVno'], 6, 3);
				$temp_vno  = str_pad(intval(substr($voucherInfo['maxVno'],-6))+1, 7, '0', STR_PAD_LEFT);
				$voucher_id = $temp_com_id.$temp_fin_year.$temp_vmonth.$temp_type.$temp_vno;				 
			} 
			else {				
				$temp_com_id = str_pad($this->comId, 2, '0', STR_PAD_LEFT);
				$temp_fin_id = str_pad($fin_no, 2, '0', STR_PAD_LEFT);
				$temp_vmonth = str_pad($vmonth, 2, '0', STR_PAD_LEFT);			
				$voucher_id = $temp_com_id.$temp_fin_id.$temp_vmonth.$voucherTp.'0000001';		
			}
			return $voucher_id;
		}
		
		
		
		function getHOExpenses($month,$year,$ho_id){
			$timestamp    = strtotime('$month $year');
			$start_date = date('m-01-Y', $timestamp);
			$end_date  = date('m-t-Y', $timestamp);
			
			$project_id = $ho_id;
	
			$sql_query = "			
				SELECT vm_vno, fun_get_project_name(vd_project_code) AS prj_name, SUBSTRING(vd_ca_id,1,6) vd_ca_id_head, vd_project_code,
				fun_get_ca_head_name(SUBSTRING(vd_ca_id,1,6)) ca_name, SUM(CASE WHEN vm_vdate BETWEEN '$start_date' AND '$end_date'  THEN vd_debit ELSE 0 END) debit,
				SUM(CASE WHEN vm_vdate BETWEEN '$start_date' AND '$end_date'  THEN vd_credit ELSE 0 END) credit, B.head_name, B.acc_head,B.id as seria_no
				FROM view_ledger_mgt mgt
				LEFT JOIN acc_opening_balance ob ON (vd_ca_id= ob.ob_ca_id AND vd_project_code=ob.ob_project)
				LEFT JOIN (
					select rm.id, rm.head_name, acc_head
					from acc_report_heads rm 
					left join acc_report_head_detail rd on rd.head_id=rm.id
					where id>24 and id <38
					order by rm.id
				) B ON (SUBSTRING(mgt.vd_ca_id,1,6)= B.acc_head OR SUBSTRING(mgt.vd_ca_id,1,3)= B.acc_head)
				WHERE mgt.company_id=$comID AND (SUBSTRING(vd_ca_id,1,1) = '8' OR SUBSTRING(vd_ca_id,1,6) = '207005') AND vd_project_code='$project_id'
				GROUP BY SUBSTRING(vd_ca_id,1,6)
				ORDER BY seria_no, vd_ca_id
			";
			//echo $sql_query;die;
			$stmt = $conn->prepare($sql_query);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$balance = 0;	
			foreach ($result as $rows){
				$balance  +=  $rows['debit'] - $rows['credit'];		
			}			
			return $balance;
		}
		
		
		
		function getJVoucherId($fin_no,$vDate){

			$voucher_id = "";
			$vmonth     = date("m",strtotime($vDate));	
			$vyear     = date("Y",strtotime($vDate));	
			
			/*Get Max Voucher ID*/
			/*$sql_query = "SELECT max(cast(SUBSTRING(vm_vno,10) AS UNSIGNED)) max_sl_no, vm_vno maxVno from acc_voucher_master where SUBSTRING(vm_vno,7,2) = 'JV' AND company_id=:company_id AND vm_fin_year=:vm_fin_year AND MONTH(vm_vdate)=:vmonth AND YEAR(vm_vdate)=:vyear";*/
			
			$sql_query = "SELECT vm_vno maxVno from acc_voucher_master where SUBSTRING(vm_vno,7,2) = 'JV' AND company_id=:company_id AND vm_fin_year=:vm_fin_year AND MONTH(vm_vdate)=:vmonth AND YEAR(vm_vdate)=:vyear and cast(SUBSTRING(vm_vno,10) AS UNSIGNED) = (SELECT max(cast(SUBSTRING(vm_vno,10) AS UNSIGNED)) from acc_voucher_master where SUBSTRING(vm_vno,7,2) = 'JV' AND company_id=:company_id AND vm_fin_year=:vm_fin_year AND MONTH(vm_vdate)=:vmonth AND YEAR(vm_vdate)=:vyear)";
			
			
			$stmt = $this->dbCon->prepare($sql_query);
			$stmt->execute(array(':company_id'=>$this->comId,':vm_fin_year'=>$this->finId,':vmonth'=>$vmonth,':vyear'=>$vyear));		
			$voucherInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			
			//echo $this->finId; die;
			
			if(isset($voucherInfo['maxVno'])){				
				$temp_com_id   = str_pad(substr($voucherInfo['maxVno'], 0, 2), 2, '0', STR_PAD_LEFT);
				$temp_fin_year = str_pad($fin_no, 2, '0', STR_PAD_LEFT);
				$temp_type     = "JV";
				$temp_vno      = str_pad(intval(substr($voucherInfo['maxVno'],-7))+1, 8, '0', STR_PAD_LEFT);		
				$voucher_id    = $temp_com_id.$temp_fin_year.$vmonth.$temp_type.$temp_vno;
			
			} else {
				$temp_com_id   = str_pad($this->comId, 2, '0', STR_PAD_LEFT);
				$temp_fin_year = str_pad($fin_no, 2, '0', STR_PAD_LEFT);			
				$voucher_id    = $temp_com_id.$temp_fin_year.$vmonth.'JV00000001';
			}
			
			return $voucher_id;
		}
		
		  function addOrdinalNumberSuffix($num) {
			if (!in_array(($num % 100),array(11,12,13))){
			  switch ($num % 10) {
				// Handle 1st, 2nd, 3rd
				case 1:  return $num.'st';
				case 2:  return $num.'nd';
				case 3:  return $num.'rd';
			  }
			}
			return $num.'th';
		  }
		
		
	 public function print_arrays()
		{
			$args = func_get_args();
			echo "<pre>";
			foreach ($args as $arg) {
				print_r($arg);
			}
			echo "</pre>";
			die();
		}
		
		public function print_arrays_without_die()
		{
			$args = func_get_args();
			echo "<pre>";
			foreach ($args as $arg) {
				print_r($arg);
			}
			echo "</pre>";
		}	
		
		function numberToWord($number){
			
			$denom   = array('Crore','Lac','Thousand','Hundred');
			$denom1  = array('One','Two','Three','Four','Five','Six','Seven','Eight','Nine');
			$denom10 = array('Ten','Twenty','Thirty','Fourty','Fifty','Sixty','Seventy','Eighty','Ninety');
			$denom11 = array('Eleven','Twelve','Thirteen','Fourteen','Fifteen','Sixteen','Seventeen','Eighteen','Nineteen');
			$i=1;$output='';$abc=0;
			if($number == 0){
				return 'zero';
			}
			
			while(round($number) > 0){
				$digit1 = fmod($number ,10);
				$number = floor($number / 10);
				$dummy = $number;
				if($i > 10)	{
						return 'Number Exceeded Computation Limits';
				}
				if($i==1 || $i==4 || $i==6 || $i==8) {
					$digit2= fmod($dummy ,10);
					if($digit2 == 1){
							if($digit1 != 0)
							$number = floor($number / 10);
						}
					}					
					if($digit1 == 0){
						 
						$i++;
						$test='';
						continue;
					}
					
					switch($i) {
						case 1:
							if (intval($digit2) == 1){
								$output = $denom11[intval($digit1)-1].' '.$output;
								$digit2 =0;
								$i++;
							} else {
								$output = $denom1[intval($digit1)-1].' '.$output;
							}								 
							break;
						
						case 2:
							$output = $denom10[intval($digit1)-1 ].' '.$output; 
							break;
						 
						case 3:
							$output = $denom1[intval($digit1)-1].' '.$denom[3].' '.$output;
							break;
						 
						case 4:
							if (intval($digit2) == 1) {       
								$output = $denom11[intval($digit1)-1].' '.$denom[2].' '.$output;
								$i++;
							} else if($digit2 == 0) {
									$output = $denom1[intval($digit1)-1].' '.$denom[2].' '.$output;
							} else {
								$test = $denom1[intval($digit1)-1];
							}				 
							break;
							
						case 5:
							$output = $denom10[intval($digit1)-1].' '.$test.' '.$denom[2].' '.$output;
							break;
		 
						case 6:
							if (intval($digit2) == 1){       
								$output = $denom11[intval($digit1)-1].' '.$denom[1].' '.$output;
								$i++;
							} else if($digit2 == 0) {
								$output = $denom1[intval($digit1)-1].' '.$denom[1].' '.$output;
							} else {
								$test = $denom1[intval($digit1)-1];
							}								
							break;
							
						case 7:
							$output = $denom10[intval($digit1)-1].' '.$test.' '.$denom[1].' '.$output;
							break;
		 
						case 8:
						
							if (intval($digit2) == 1) {       
								$output = $denom11[intval($digit1)-1].' '.$denom[0].' '.$output;
								$i++;
							} else if($digit2 == 0)	{
								$output = $denom1[intval($digit1)-1].' '.$denom[0].' '.$output;
							} else {
								$test = $denom1[intval($digit1)-1];
							}
							break;
						
						case 9:
							$output = $denom10[intval($digit1)-1].' '.$test.' '.$denom[0].' '.$output;
							break;
						case 10:
							$output = $denom1[intval($digit1)-1].' '.$denom[3].' '.$output;
							break;
						 
					}
					$i++;
				}
				return $output;
						 
			}
		
		
	}


?>