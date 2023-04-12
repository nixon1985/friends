

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="index.html"><i class="fa fa-home"></i> Home</a></li> 
	<li><a href="#">Member</a></li> 
	<li class="active">Member List</li> 
</ul> 



<div class="m-b-md"> <h3 class="m-b-none">Member List</h3> </div> 
<section class="panel panel-default"> 
	<header class="panel-heading"> Members Information <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i> </header> 
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none"> 
			<thead> 
				<tr> <th width="20%">Name</th> <th width="25%">Phone</th> <th width="25%">Email</th> <th width="15%">Status</th> <th width="15%">Action</th> </tr> 
			</thead>
			<tbody> </tbody> 
		</table> 
	</div> 
</section> 

<div id="panel_view"></div>

<!-- datatables --><script src="js/datatables/jquery.dataTables.min.js"></script>
<script src="js/datatables/demo.js"></script> 
<!--script src="js/app.plugin.js"></script -->

<script type="text/javascript">
	
	$(document).ready(function(){
		loadDataGrid();
	})
	
	
	function loadDataGrid(){
		alert('sdfsdf');
		var formData='erer';
		$('.table tbody tr').remove();
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
					$.each(data.records, function(i,data){
						html += "<tr>";				
						html +="<td align='center' class='id'>"+data.id+"</td>";
						html +="<td align='center' class='installment_no'>"+data.member_name+"</td>";
						html +="<td class='pay_type'>"+data.phone+"</td>";
						html +="<td align='right' class='payable'>"+data.email+"</td>";
						html +="<td class='payment_date' align='center'>"+data.present_address+"</td>";
						html += '</tr>';
					});				
				}
			});
		$('.table tbody').append(html);	
	}
	
	
	/*
	function loadGrid(bookingId){
	var url = "./controller/sales_market/pm_schedule_controller.php?action=viewData&bookingId="+bookingId;
	$.getJSON(url,function(data){	
		
			if(!jQuery.isEmptyObject(data.records)){
				$('#filter_table tbody tr').remove();
				var html = "";
				$.each(data.records, function(i,data){
					html += "<tr>";				
					html +="<td align='center' class='id'>"+data.id+"</td>";
					html +="<td align='center' class='installment_no'>"+data.installment_no+"</td>";
					html +="<td class='pay_type'>"+data.pay_type+"</td>";
					html +="<td align='right' class='payable'>"+data.payable+"</td>";
					html +="<td class='payment_date' align='center'>"+data.payment_date+"</td>";
					
					html += '</tr>';
				});				
				
				$('#filter_table tbody').append(html);
				
				var options = {
					valueNames: ['payable','pay_type','payment_date']
				};			
				
				var userList = new List('recordsfilter', options);
				
				
				$('#filter_table >tbody > tr').dblclick(function(){						
					var record_id = $(this).find('td:eq(0)').text();		
					var url="./controller/sales_market/pm_schedule_controller.php?action=getInfo&record_id="+record_id;
					$.getJSON(url,function(data){
						if(!jQuery.isEmptyObject(data.schInfo)){
							$.each(data.schInfo, function(i,data){
								$("#temp_id").val(data.id); 							
								$("#payment_tp option[value='"+data.paymentTp+"']").attr('selected','selected');
								$("#installment_no").val(data.installment_no); 
								$("#payable_amount").val(data.payable); 
								$("#payable_date").val(data.payment_date);
							});			
						}					
					});				
				});
			}			  
		});
	}*/
	
	</script>



	
