

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="index.html"><i class="fa fa-home"></i> Home</a></li> 
	<li><a href="#">Payment</a></li> 
	<li class="active">Payment Collection</li> 
</ul>




<div class="m-b-md"> <h3 class="m-b-none">Member List</h3> </div>
<section class="panel panel-default">
    <header class="panel-heading"> Members Information <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i> </header>

    <div class="table-responsive">
        <table id="member_grid" class="table table-striped b-t b-light">
            <thead>
            <tr>
                <th class="th-sortable" data-toggle="class">Member ID <span class="th-sort"> <i class="fa fa-sort-down text"></i> <i class="fa fa-sort-up text-active"></i> <i class="fa fa-sort"></i> </span> </th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Present Address</th>
                <th>Monthly Payable</th>
                <th>Opening Balance</th>
                <th></th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</section>







<form class="bs-example"> 
<div class="m-b-md"><h3 class="m-b-none">Payment Collection</h3> </div> 


<div class="row"> 
	<div class="col-sm-6"> 
		<section class="panel panel-default form-horizontal"> 
			<header class="panel-heading font-bold">Payment Collection Form</header> 
			<div class="panel-body"> 
				
					<div class="form-group"> 
						<label class="col-sm-2 control-label">Member</label> 
						<div class="col-sm-10"> 
							<select id="select2-option" class="select2" style="width:260px">
								<optgroup label="Alaskan/Hawaiian Time Zone"> 
									<option value="AK">Alaska</option> 
									<option value="HI">Hawaii</option> 
								</optgroup> 
								<optgroup label="Pacific Time Zone"> 
									<option value="CA">California</option> 
									<option value="NV">Nevada</option> 
									<option value="OR">Oregon</option> 
									<option value="WA">Washington</option> 
								</optgroup> 
								<optgroup label="Mountain Time Zone"> 
									<option value="AZ">Arizona</option> 
									<option value="CO">Colorado</option> 
									<option value="ID">Idaho</option> 
									<option value="MT">Montana</option>
									<option value="NE">Nebraska</option> 
									<option value="NM">New Mexico</option>
								</optgroup>
							</select>
						</div>				
					</div>
					
					<div class="form-group"> 
						<label class="col-sm-2 control-label">Month</label> 
						<div class="col-sm-10"> 
							<input type="text" class="form-control">
						</div> 
					</div>
					
					<div class="form-group"> 
						<label class="col-sm-2 control-label">Amount</label> 
						<div class="col-sm-10"> 
							<input type="email" class="form-control"> 
						</div> 
					</div>
					
					<div class="line line-lg pull-in"></div> 
					<div class="form-group"> 
						<div class="col-sm-10" align="center"> 
							<button type="submit" class="btn btn-default">Cancel</button> 
							<button type="submit" class="btn btn-primary">Save</button>  
						</div> 
					</div>
				 
			</div> 
		</section> 
	</div>
</div>


<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>


	
