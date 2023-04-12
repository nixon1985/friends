<?php
	include("DBcontroller.php");
	$obj 		= new DBcontroller;	
	$conn       = $obj->getDbConn();

	$error       = "";
	$user_name   = $_POST['user_name'];	
	$user_pass   = $_POST['user_password'];
	// echo $user_name."-".$user_pass;
	
	try {				

		
		if(!empty($user_name) && !empty($user_pass)){			
			$stmt = $conn->prepare("SELECT * FROM appuser WHERE user_name=:user_id AND user_password=:user_password LIMIT 1");
			$stmt->execute(array(':user_id'=>trim($user_name), ':user_password'=>md5(trim($user_pass))));
			$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() > 0 && $userInfo['is_active']==1){
				$_SESSION['user_id'] = $userInfo['user_id'];
				
				/*
				$conn->beginTransaction();
				$appstmt = $conn->prepare("SELECT login_times FROM app_user_tracking WHERE user_id=:user_id");
				$appstmt->execute(array(':user_id'=>trim($user_name)));
				$appInfo = $appstmt->fetch(PDO::FETCH_ASSOC);
				//echo $appInfo['totalCount'];die;
				if($appInfo['login_times'] > 0){
					//update
					$appUpstmt = $conn->prepare("UPDATE app_user_tracking SET login_times=:login_times WHERE user_id=:user_id");
					$appUpstmt->execute(array(':login_times'=>($appInfo['login_times']+1),':user_id'=>trim($user_name)));
				} else {
					//insert
					$appInstmt = $conn->prepare("INSERT INTO app_user_tracking (login_times,user_id) VALUES (:login_times,:user_id)");
					$appInstmt->execute(array(':login_times'=>1,':user_id'=>trim($user_name)));
				}
				
				$conn->commit();
				*/
				
				// header('Location: ../index.php');
				$data['loginStatus']='yes';
				echo json_encode($data);
				
			} else {
				$data['loginStatus']='no';
				echo json_encode($data);
				// include('../index.php');
			}	
		} else {
			header('Location: index.php');
		}	
	} catch(PDOException $e) {
		$conn->rollback();
		echo "Insert:Error: " . $e->getMessage();
	}	