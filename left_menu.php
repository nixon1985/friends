<aside class="bg-light lter b-r aside-md hidden-print hidden-xs" id="nav"> 
		<section class="vbox"> 
			<header class="header bg-primary lter text-center clearfix"> 
				<div class="btn-group"> 
					<button type="button" class="btn btn-sm btn-dark btn-icon" title="New project"><i class="fa fa-plus"></i></button> 
					<div class="btn-group hidden-nav-xs"> 
						<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"> Switch Project <span class="caret"></span> </button> 
						<ul class="dropdown-menu text-left"> 
							<li><a href="#">Project</a></li> 
							<li><a href="#">Another Project</a></li> 
							<li><a href="#">More Projects</a></li> 
						</ul> 
					</div> 
				</div> 
			</header> 
			<section class="w-f scrollable"> 
				<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333"> 
				<!-- nav --> 
				<nav class="nav-primary hidden-xs"> 
					<ul class="nav"> 
						<li> 
							<a href="index.html" > 
								<i class="fa fa-dashboard icon"> <b class="bg-danger"></b> </i> 
								<span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> 
								<span>Registration</span> 
							</a> 
							<ul class="nav lt">
                                <?php if($_SESSION['user_level']=='ADMIN'){?>
								<li> <a href="#" onclick='openpage("view/member/add_member.php");' > <i class="fa fa-angle-right"></i> <span>Add Member</span> </a> </li>
                                <?php } ?>
								<li> <a href="#" onclick='openpage("view/member/member_list.php");'> <i class="fa fa-angle-right"></i> <span>Member List</span> </a> </li> 
							</ul> 
						</li> 
						<li > 
							<a href="#layout" > 
								<i class="fa fa-columns icon"> <b class="bg-warning"></b> </i> 
								<span class="pull-right"> 
									<i class="fa fa-angle-down text"></i> 
									<i class="fa fa-angle-up text-active"></i> 
								</span> 
								<span>Payment</span> 
							</a> 
							<ul class="nav lt"> 
								<li > <a href="#" onclick='openpage("view/collection/collection_form.php");' > <i class="fa fa-angle-right"></i> <span>Payment Collection</span> </a> </li> 
								<li > <a href="#" onclick='openpage("controller/infos.php");' > <i class="fa fa-angle-right"></i> <span>Collection List</span> </a> </li> 
								<li > <a href="layout-h.html" > <i class="fa fa-angle-right"></i> <span>Due List</span> </a> </li> 
							</ul> 
						</li>


						<li> 
							<a href="#layout" > 
								<i class="fa fa-columns icon"> <b class="bg-warning"></b> </i> 
								<span class="pull-right"> 
									<i class="fa fa-angle-down text"></i> 
									<i class="fa fa-angle-up text-active"></i> 
								</span> 
								<span>Investment</span> 
							</a> 
							<ul class="nav lt"> 
								<li > <a href="layout-c.html" > <i class="fa fa-angle-right"></i> <span>Create Project</span> </a> </li>
								<li > <a href="layout-c.html" > <i class="fa fa-angle-right"></i> <span>New Investment</span> </a> </li> 
								<li > <a href="layout-r.html" > <i class="fa fa-angle-right"></i> <span>Profit Collection</span> </a> </li> 
							</ul> 
						</li>

						<li> 
							<a href="#layout" > 
								<i class="fa fa-columns icon"> <b class="bg-warning"></b> </i> 
								<span class="pull-right"> 
									<i class="fa fa-angle-down text"></i> 
									<i class="fa fa-angle-up text-active"></i> 
								</span> 
								<span>Expense</span> 
							</a> 
							<ul class="nav lt"> 
								<li > <a href="layout-c.html" > <i class="fa fa-angle-right"></i> <span>Add Expense</span> </a> </li>
								<li > <a href="layout-c.html" > <i class="fa fa-angle-right"></i> <span>Expense List</span> </a> </li> 
							</ul> 
						</li>						
						
						
						
						
						<li> 
							<a href="#uikit"> 
								<i class="fa fa-flask icon"> <b class="bg-success"></b> </i> 
								<span class="pull-right"> 
									<i class="fa fa-angle-down text"></i> 
									<i class="fa fa-angle-up text-active"></i> 
								</span> 
								<span>Reports</span> 
							</a> 
							<ul class="nav lt">
                                <li> <a href="#" onclick='openpage("view/reports/balance_reports.php");' > <i class="fa fa-angle-right"></i> <span>Balance Report</span> </a> </li>
								<li><a href="buttons.html" class="active"> <i class="fa fa-angle-right"></i> <span>Report-1</span> </a> </li>
								<li > <a href="icons.html" > <i class="fa fa-angle-right"></i> <span>Report-2</span> </a> </li>  
							</ul> 
						</li> 
						<li > 
							<a href="#pages" > <i class="fa fa-file-text icon"> <b class="bg-primary"></b> </i> 
								<span class="pull-right"> <i class="fa fa-angle-down text"></i> <i class="fa fa-angle-up text-active"></i> </span> 
								<span>Pages</span> 
							</a> 
							<ul class="nav lt"> 
								<li > <a href="gallery.html" > <i class="fa fa-angle-right"></i> <span>Gallery</span> </a> </li> 
								<li > <a href="profile.html" > <i class="fa fa-angle-right"></i> <span>Profile</span> </a> </li> 
								<li > <a href="invoice.html" > <i class="fa fa-angle-right"></i> <span>Invoice</span> </a> </li> 
								<li > <a href="intro.html" > <i class="fa fa-angle-right"></i> <span>Intro</span> </a> </li> 
								<li > <a href="master.html" > <i class="fa fa-angle-right"></i> <span>Master</span> </a> </li> 
								<li > <a href="gmap.html" > <i class="fa fa-angle-right"></i> <span>Google Map</span> </a> </li> 
								<li > <a href="jvectormap.html" > <i class="fa fa-angle-right"></i> <span>Vector Map</span> </a> </li> 
								<li > <a href="signin.html" > <i class="fa fa-angle-right"></i> <span>Signin</span> </a> </li> 
								<li > <a href="signup.html" > <i class="fa fa-angle-right"></i> <span>Signup</span> </a> </li> 
								<li > <a href="404.html" > <i class="fa fa-angle-right"></i> <span>404</span> </a> </li> 
							</ul> 
						</li> 
						<li > <a href="mail.html" > <b class="badge bg-danger pull-right">3</b> <i class="fa fa-envelope-o icon"> <b class="bg-primary dker"></b> </i> <span>Message</span> </a> </li> 
						<li > <a href="notebook.html" > <i class="fa fa-pencil icon"> <b class="bg-info"></b> </i> <span>Notes</span> </a> </li> 
					</ul> 
				</nav> <!-- / nav --> 
			</div> 
		</section> 
		<footer class="footer lt hidden-xs b-t b-light"> 
			<div id="chat" class="dropup"> 
				<section class="dropdown-menu on aside-md m-l-n"> 
					<section class="panel bg-white"> 
						<header class="panel-heading b-b b-light">Active chats</header> 
						<div class="panel-body animated fadeInRight"> 
							<p class="text-sm">No active chats.</p> 
							<p><a href="#" class="btn btn-sm btn-default">Start a chat</a></p> 
						</div> 
					</section> 
				</section> 
			</div> 
			<div id="invite" class="dropup"> 
				<section class="dropdown-menu on aside-md m-l-n"> 
					<section class="panel bg-white"> 
						<header class="panel-heading b-b b-light"> John <i class="fa fa-circle text-success"></i> </header> 
						<div class="panel-body animated fadeInRight"> 
							<p class="text-sm">No contacts in your lists.</p> 
							<p><a href="#" class="btn btn-sm btn-facebook"><i class="fa fa-fw fa-facebook"></i> Invite from Facebook</a></p> 
						</div> 
					</section> 
				</section> 
			</div> 
			<a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-default btn-icon"> <i class="fa fa-angle-left text"></i> <i class="fa fa-angle-right text-active"></i> </a> 
			<div class="btn-group hidden-nav-xs"> 
				<button type="button" title="Chats" class="btn btn-icon btn-sm btn-default" data-toggle="dropdown" data-target="#chat"><i class="fa fa-comment-o"></i></button> 
				<button type="button" title="Contacts" class="btn btn-icon btn-sm btn-default" data-toggle="dropdown" data-target="#invite"><i class="fa fa-facebook"></i></button> 
			</div> 
		</footer> 
	</section> 
</aside> <!-- /.aside -->