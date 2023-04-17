
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="index.html"><i class="fa fa-home"></i> Home</a></li> 
	<li><a href="#">Member</a></li> 
	<li class="active">Member Registration</li> 
</ul> 



<form id="submit_form" class="bs-example" role="search">
<div class="m-b-md"><h3 class="m-b-none">Member Registration</h3> </div> 


<div class="row"> 
	<div class="col-sm-6"> 
		<section class="panel panel-default form-horizontal"> 
			<header class="panel-heading font-bold">Member's Basic Information</header> 
			<div class="panel-body"> 
				
					<div class="form-group"> 
						<label class="col-sm-2 control-label">Name</label> 
						<div class="col-sm-10">
							<input type="text" id="member_name" name="member_name" class="form-control" data-required="true">
						</div> 
					</div>
					
					<div class="form-group"> 
						<label class="col-sm-2 control-label">Phone</label> 
						<div class="col-sm-10"> 
							<input type="text" id="phone_no" name="phone_no" class="form-control" data-required="true">
						</div> 
					</div>
					
					<div class="form-group"> 
						<label class="col-sm-2 control-label">Email</label> 
						<div class="col-sm-10"> 
							<input type="email" id="email" name="email" class="form-control"> 
						</div> 
					</div>
					
					<div class="form-group"> 
						<label class="col-sm-2 control-label">Present address</label> 
						<div class="col-sm-10"> 
							<input type="text" id="present_address" name="present_address" class="form-control"> 
						</div> 
					</div>
					
					<div class="form-group"> 
						<label class="col-sm-2 control-label">Permanent address</label> 
						<div class="col-sm-10"> 
							<input type="text" id="permanent_address" name="permanent_address" class="form-control"> 
						</div> 
					</div> 			 
					
					<div class="form-group"> 
						<label class="col-sm-2 control-label">Gender</label> 
						<div class="col-sm-10"> 
							<label class="checkbox-inline"> <input type="radio" name="gender" id="gender1" value="Male" checked> Male </label>
							<label class="checkbox-inline"> <input type="radio" name="gender" id="gender2" value="Female"> Female </label>
						</div> 
					</div>

					<div class="form-group"> 
						<label class="col-sm-2 control-label">Joining Date</label> 
						<div class="col-sm-10"> 
							<input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="12-02-2013" data-date-format="dd-mm-yyyy" >
						</div> 
					</div>
 
					<div class="form-group"> 
						<label class="col-sm-2 control-label">Photo</label> 
						<div class="col-sm-10"> 
							<input type="file" class="filestyle" name="photo" data-icon="false" data-classButton="btn btn-default" data-classInput="form-control inline input-s">
						</div> 
					</div> 
				 
			</div> 
		</section> 
	</div> 
	<div class="col-sm-6"> 
		<section class="panel panel-default form-horizontal"> 
			<header class="panel-heading font-bold">Nominee information</header> 
				<div class="panel-body"> 
					<div class="form-group"> 
					<label class="col-sm-2 control-label">Name</label> 
					<div class="col-sm-10"> 
						<input type="text" class="form-control"> 
					</div> 
				</div>
				
				<div class="form-group"> 
					<label class="col-sm-2 control-label">Phone</label> 
					<div class="col-sm-10"> 
						<input type="text" class="form-control">
					</div> 
				</div>

				<div class="form-group"> 
					<label class="col-sm-2 control-label">Email</label> 
					<div class="col-sm-10"> 
						<input type="email" class="form-control"> 
					</div> 
				</div>
				
				<div class="form-group"> 
					<label class="col-sm-2 control-label">Present address</label> 
					<div class="col-sm-10"> 
						<input type="text" class="form-control"> 
					</div> 
				</div>
				
				<div class="form-group"> 
					<label class="col-sm-2 control-label">Permanent address</label> 
					<div class="col-sm-10"> 
						<input type="text" class="form-control"> 
					</div> 
				</div> 			 
 
				<div class="form-group"> 
					<label class="col-sm-2 control-label">Relation with Nominee</label> 
					<div class="col-sm-10"> 
						<input type="text" class="form-control"> 
					</div> 
				</div>

			</div> 
		</section> 
	</div> 
</div>




<section class="panel panel-default form-horizontal"> 
	<header class="panel-heading font-bold"> Payment Information </header> 
	<div class="panel-body"> 

		<div class="form-group"> 
			<label class="col-sm-2 control-label">Monthly Payable Amount</label> 
			<div class="col-sm-10"> 
				<input type="text" id="monthly_payable" name="monthly_payable" class="form-control">
			</div> 
		</div> 
		
		<div class="form-group"> 
			<label class="col-sm-2 control-label">Current Balance</label> 
			<div class="col-sm-10"> 
				<input type="text" id="opening_balance" name="opening_balance" class="form-control">
			</div> 
		</div>
		<div class="line line-lg pull-in"></div> 
		<div class="form-group"> 
			<div class="col-sm-10" align="center"> 
				<a href="#modal-form" class="btn btn-success" data-toggle="modal">Form in a modal</a>
				<button type="submit" id="btnClear" class="btn btn-default">Cancel</button> 
				<button type="submit" class="btn btn-primary">Submit</button>  
			</div> 
		</div>
		
	</div>
</section>
</form>


<!-- Modal window -->
<div class="modal fade" id="modal-form"> 
	<div class="modal-dialog"> 
		<div class="modal-content"> 
			<div class="modal-body"> 
				<div class="row"> 
					<div class="col-sm-6 b-r"> 
						<h3 class="m-t-none m-b">Sign in</h3> 
						<p>Sign in to meet your friends.</p> 
						<form role="form"> 
							<div class="form-group"> 
								<label>Email</label> 
								<input type="email" class="form-control" placeholder="Enter email"> 
							</div> 
							<div class="form-group"> 
								<label>Password</label> 
								<input type="password" class="form-control" placeholder="Password"> 
							</div> 
							<div class="checkbox m-t-lg"> 
								<button type="submit" class="btn btn-sm btn-success pull-right text-uc m-t-n-xs"><strong>Log in</strong></button> 
								<label> <input type="checkbox"> Remember me </label> 
							</div>
						</form>
					</div> 
					<div class="col-sm-6"> 
						<h4>Not a member?</h4> 
						<p>You can create an account <a href="#" class="text-info">here</a></p> 
						<p>OR</p> 
						<a href="#" class="btn btn-facebook btn-block m-b-sm"><i class="fa fa-facebook pull-left"></i>Sign in with Facebook</a> 
						<a href="#" class="btn btn-twitter btn-block m-b-sm"><i class="fa fa-twitter pull-left"></i>Sign in with Twitter</a> 
						<a href="#" class="btn btn-gplus btn-block"><i class="fa fa-google-plus pull-left"></i>Sign in with Google+</a> 
					</div> 
				</div> 
			</div> 
		</div><!-- /.modal-content --> 
	</div><!-- /.modal-dialog --> 
</div>


<script type="text/javascript">

$(document).ready(function(){
	var userList	= "";
	jQuery.ajaxSetup({
		beforeSend: function() {
			$('#wait').show();
		},
		complete: function(){
			$('#wait').hide();
		},
		success: function() {}
	}); 


	/*Clear Button Action Performed*/
	
	$('#btnClear').click(function(){
		//clearForm();	
		alert("clear form");
		return false;
	});	
	
	
	
	/*Submit Button Action Performed*/
	$("form#submit_form").submit(function(event) {
		alert($.trim($('#member_name').val()).length);
        var gender = $('input[name="gender"]:checked').val();

        if($.trim($('#member_name').val()).length==0 ){
			alert('Please Enter Member Name');
			return false;
		}
		else {
			//alert('save mode');
			//return false;
			
			$('#btnSubmit').prop('disabled',true);			
			event.preventDefault();
			var formData = new FormData($(this)[0]);
			formData.append("action","insertOrUpdate");
            formData.append("gender",gender);
            $.ajax({
				url: "../friends/controller/add_member_controller.php",
				type: 'POST',
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) {						
					//$('#btnSubmit').prop('disabled',false);	
					
					var result = JSON.parse(data);

					if (result.success) {
                        document.getElementById("submit_form").reset();
						alert("New Member Created Successfully.");
					}
					else if (result.error) {
						//clearForm();
						alert("Salary Sheet Updated Successfully.");
					}
				}
			});
			return false;	
		}
		
		/*
		var emp_working_day = $('input[name="pay_days[]"]').map(function () {    
			if(this.value !== '') {
				return this.value; 
			}		  
		}).get();
		
		if($.trim($('#search').val()).length>0 ){
			alert('Please Remove Search ');
			return false;
		}
		
		if($("input[name='pay_days[]']").size() !== emp_working_day.length){
			alert('Insert All Employees Working Days ???');
			return false;
		} 
		else if ($.trim($('#month_no').val()) === "0") {
			alert('Select Month ???');
			$('#month_no').focus();
			return false;	
		} 
		else if ($.trim($('#year_no').val()) === "0") {
			alert('Select Year ???');
			$('#year_no').focus();
			return false;	
		}
		else {
			//return false;
			$('#btnSubmit').prop('disabled',true);			
			event.preventDefault();
			var formData = new FormData($(this)[0]);
			var salary_year = $('#year_no').val();
			var salary_month = $('#month_no').val();
			formData.append("action","insertOrUpdate");	
			$.ajax({
				url: "../../controller/hrm/cash_salary_create_controller.php",
				type: 'POST',
				data: formData,
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) {						
					$('#btnSubmit').prop('disabled',false);				
					var result = JSON.parse(data);
					if ($.trim(result.msg) === '1') {						
						clearForm();
						alert("Salary Sheet Created Successfully.");
					}
					else if ($.trim(result.msg) === '2') {						
						clearForm();
						alert("Salary Sheet Updated Successfully.");
					}
					else if ($.trim(result.msg) === '3') {						
						alert("Salary Sheet has been generated already. You can not edit. check the month and year carefully ");
					}
					else if ($.trim(result.msg) === '4') {						
						clearForm();
						alert("Bonus Sheet Generated Successfully.");
					}
					else if($.trim(result.msg) === 'EE') {
						alert(result.errorDesc);
					}
				}
			});
			return false;	
		}
			*/
		
	});
		
	clearForm();
});


</script>




	
