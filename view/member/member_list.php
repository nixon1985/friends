

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="index.html"><i class="fa fa-home"></i> Home</a></li> 
	<li><a href="#">Member</a></li> 
	<li class="active">Member List</li> 
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

<div id="panel_view"></div>



<!-- Modal window -->
<div class="modal fade" id="modal-form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">


                <form id="submit_form" class="bs-example" role="search">
                    <div class="m-b-md"><h3 class="m-b-none">Member Registration</h3> </div>


                    <div class="row">
                        <div class="col-sm-12">
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
                                            <input class="input-sm input-s datepicker-input form-control" size="16" type="text" value="" data-date-format="dd-mm-yyyy" >
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
                        <div class="col-sm-12">
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
                                    <!--<a href="#modal-form" class="btn btn-success" data-toggle="modal">Form in a modal</a>-->
                                    <button type="submit" id="btnClear" class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </div>
                    </section>


            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<script type="text/javascript">
/*
	$(document).ready(function(){
		loadDataGrid();
	});
*/
    loadDataGrid();
	function loadDataGrid(){
        var postData = {actionType:'getAllMembers'};
		//$('.table tbody tr').remove();
		var html = "";
			$.ajax({
				url: 'controller/infos.php',
				type: 'POST',
				data: JSON.stringify(postData),
				async: false,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) { 
					// $('#member_grid').html(data);
                    var result = JSON.parse(data);
					$.each(result, function(i,data){
						html +="<tr>";
						html +="<td align='center' class='id'>"+data.member_no+"</td>";
						html +="<td align='center' class='installment_no'>"+data.member_name+"</td>";
						html +="<td class='pay_type'>"+data.phone_no+"</td>";
						html +="<td align='right' class='payable'>"+data.email+"</td>";
						html +="<td class='payment_date' align='center'>"+data.present_address+"</td>";
                        html +="<td class='payment_date' align='right'>"+data.monthly_payable+"</td>";
                        html +="<td class='payment_date' align='right'>"+data.opening_balance+"</td>";
                        html +='<td class="payment_date" align="center"><a href="javascript:editMember('+data.member_id+');"><i class="fa fa-pencil"></i></a></td>';
						html +='</tr>';
					});				
				}
			});
		$('#member_grid tbody').html(html);
	}

	function editMember(memberID){

        $.post("controller/infos.php", {actionType: "personInfo", member_id: memberID}, function(data, status){
            var result = JSON.stringify(data);
            alert("Data: " + data+ "\nStatus: " + status);
            $('#modal-form').modal('show');
        });


        /*
        $.ajax({
            url: 'controller/infos.php',
            type: 'POST',
            data: data,
            dataType: "json",
            async: false,
            cache: false,
            contentType: "application/json; charset=utf-8",
            processData: false,
            success: function(data) {
                var result = JSON.parse(data);
                $.each(result, function(i,data){

                });
            }
        });
        */

       // $('#modal-form').modal('show');
    }
	

	
	</script>



	
