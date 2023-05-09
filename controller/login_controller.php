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
			// $stmt = $conn->prepare("SELECT * FROM appuser u, member_info m WHERE u.user_name=:user_id AND u.user_password=:user_password and m.member_no=u.user_id LIMIT 1");
            $stmt = $conn->prepare("SELECT * FROM appuser u LEFT JOIN member_info m ON m.member_no=u.user_id WHERE u.user_name=:user_id AND u.user_password=:user_password LIMIT 1");
			$stmt->execute(array(':user_id'=>trim($user_name), ':user_password'=>md5(trim($user_pass))));
			$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() > 0 && $userInfo['is_active']==1){
				$_SESSION['user_id']        = $userInfo['user_id'];
                $_SESSION['member_name']    = $userInfo['member_name'];
                $_SESSION['photo_path']     = $userInfo['photo_path'];
                $_SESSION['user_level']     = $userInfo['user_level'];

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