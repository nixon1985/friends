<?php
// session_start(); // Start the session

if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == true) {
    header('Location: layout.php');
    exit;
}else{
	header('Location: login.php');
    exit;
}
?>
