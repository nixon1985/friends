

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



<script type="text/javascript">
/*
	$(document).ready(function(){
		loadDataGrid();
	});
*/
    loadDataGrid();
	function loadDataGrid(){
		var formData='erer';
		//$('.table tbody tr').remove();
		var html = "";
			$.ajax({
				url: 'controller/infos.php',
				type: 'POST',
				data: formData,
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
                        html +='<td class="payment_date" align="center"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-pencil"></i></a></td>';
						html +='</tr>';
					});				
				}
			});
		$('#member_grid tbody').html(html);
	}
	

	
	</script>



	
