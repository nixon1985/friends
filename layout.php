<!DOCTYPE html>
<?php
session_start(); // Start the session

if(!isset($_SESSION['user_id']) && $_SESSION['user_id'] == true) {
    header('Location: login.php');
    exit;
}
?>
<html lang="en" class="app">
<!-- Mirrored from flatfull.com/themes/note/buttons.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Jan 2023 10:00:11 GMT -->
<head> 
	<meta charset="utf-8" /> 
	<title>Notebook | Web Application</title> 
	<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	
	<!--<script src="js/jquery-ui/jquery.min.js"></script>-->
	<link rel="stylesheet" href="css/font.css" type="text/css" /> 
	<link rel="stylesheet" href="js/select2/select2.css" type="text/css" />
	<link rel="stylesheet" href="js/select2/theme.css" type="text/css" />
	<link rel="stylesheet" href="js/fuelux/fuelux.css" type="text/css" />
	<link rel="stylesheet" href="js/datepicker/datepicker.css" type="text/css" />
	<link rel="stylesheet" href="js/slider/slider.css" type="text/css" />
	<link rel="stylesheet" href="css/app.v1.css" type="text/css" />
	<link rel="stylesheet" href="js/datatables/datatables.css" type="text/css"/> 
	
	
	<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]-->
	<script type="text/javascript">
	
	function openpage(filePath){
		
		var formData='erer';
			$.ajax({
				url: filePath,
				type: 'POST',
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) { 
					$('#inner_page_content').html(data);
					/*
					if($.trim(data)==='1'){									
						alert('Saved Successfully.');
					}else{
						alert('Error !!!');
					}
					*/					
				}
			});
			
	}
	</script>
</head>
<body class=""> 
<section class="vbox"> 
	<?php include("header.php");?>
	<section> 
		<section class="hbox stretch"> <!-- .aside --> 	 
			<?php include("left_menu.php"); ?>
		
			<section id="content"> 
				<section class="vbox"> 
					<section class="scrollable padder" id="inner_page_content">

					</section> 
				</section> 
				<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a> 
			</section> 
			
			<aside class="bg-light lter b-l aside-md hide" id="notes"> 
				<div class="wrapper">Notification</div> 
			</aside> 
		</section> 
	</section> 
</section> <!-- Bootstrap --> <!-- App --> 
<script src="js/app.v1.js"></script>
<script src="js/parsley/parsley.min.js"></script>
<script src="js/parsley/parsley.extend.js"></script>
<script src="js/app.plugin.js"></script>

<!-- Mirrored from flatfull.com/themes/note/buttons.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Jan 2023 10:00:23 GMT -->

<!-- fuelux --><script src="js/fuelux/fuelux.js"></script>
<!-- datepicker --><script src="js/datepicker/bootstrap-datepicker.js"></script>
<!-- slider --><script src="js/slider/bootstrap-slider.js"></script>
<!-- file input --> <script src="js/file-input/bootstrap-filestyle.min.js"></script>
<!-- combodate --><script src="js/libs/moment.min.js"></script><script src="js/combodate/combodate.js"></script>
<!-- select2 --><script src="js/select2/select2.min.js"></script>
<!-- wysiwyg --><script src="js/wysiwyg/jquery.hotkeys.js"></script>
<script src="js/wysiwyg/bootstrap-wysiwyg.js"></script>
<script src="js/wysiwyg/demo.js"></script>
<!-- markdown --><script src="js/markdown/epiceditor.min.js"></script>
<script src="js/markdown/demo.js"></script>

</body>
<!-- Mirrored from flatfull.com/themes/note/buttons.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Jan 2023 10:00:23 GMT -->
</html>
