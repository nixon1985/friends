<?php

include("DBcontroller.php");
$obj 		= new DBcontroller;	
$conn       = $obj->getDbConn();
$newMemberNo = $obj->getNewMemberNo();
try {
        $photoPath = photo_uplaod($newMemberNo);
        $conn->beginTransaction();
		$sql_query = "INSERT INTO member_info (member_no,member_name,phone_no,email,gender,present_address,permanent_address,photo_path) 
                                       VALUES (:member_no,:member_name,:phone_no,:email,:gender,:present_address,:permanent_address,:photo_path)";
		$stmt = $conn->prepare($sql_query);

        $stmt->bindParam(':member_no', $newMemberNo);
		$stmt->bindParam(':member_name', $member_name);
		$stmt->bindParam(':phone_no', $phone_no);
		$stmt->bindParam(':email', $email);
        $stmt->bindParam(':gender', $gender);
		$stmt->bindParam(':present_address', $present_address);
		$stmt->bindParam(':permanent_address', $permanent_address,PDO::PARAM_NULL);
        $stmt->bindParam(':photo_path', $photoPath);
		// $stmt->bindParam(':description', $description,PDO::PARAM_NULL);
		// $stmt->bindParam(':created_by', $created_by);
		
		$member_name 	      = trim($_POST['member_name']);
		$phone_no 	  		  = trim($_POST['phone_no']);
		$email 	      		  = trim($_POST['email']);
        $gender 	      	  = trim($_POST['gender']);
		$present_address 	  = trim($_POST['present_address']);
		$permanent_address 	  = trim($_POST['permanent_address']);
		// $duration 	          = (!empty($_POST['duration'])) ? trim($_POST['duration']):null;
		// $description 	      = (!empty($_POST['allow_desc'])) ? trim($_POST['allow_desc']):null;
		// $created_by 	      = $loginUser;
		
		$stmt->execute();
		$conn->commit();
		$data['success']='New Member added successfully';
        echo json_encode($data);

	} catch(PDOException $e) {
		$conn->rollback();
        $data['error']='Insert error. '. $e->getMessage();
        echo json_encode($data);
	}


	function photo_uplaod($newMemberNo){

        $target_dir = "../uploads/"; // specify the directory where you want to store the uploaded files
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $returnPath='';
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                //echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["photo"]["size"] > 500000) {
            // echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry, your file was not uploaded.";
            $returnPath = 0;
        // if everything is ok, try to upload file
        } else {
            $newname = $_SERVER['DOCUMENT_ROOT'].'/friends/uploads/'.$newMemberNo.'.'.$imageFileType;
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $newname)) {
                //echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.";
                $returnPath = 'uploads/'.$newMemberNo.'.'.$imageFileType;
            } else {
                $returnPath = 0;
            }
        }
        return $returnPath;

    }







/*include("db_conect.php");


$query = "SELECT * FROM member_info";
$var1 = '';
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
	//$data['records'][] = $row;	
}

$data['success']='sdfs';
echo json_encode($data);
*/

?>