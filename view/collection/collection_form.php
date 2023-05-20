

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="index.html"><i class="fa fa-home"></i> Home</a></li> 
	<li><a href="#">Payment</a></li> 
	<li class="active">Payment Collection</li> 
</ul>



<form id="submit_form" class="bs-example">
    <div class="m-b-md"><h3 class="m-b-none">Payment Collection</h3> </div>


    <div class="row">
        <div class="col-sm-6">
            <section class="panel panel-default form-horizontal">
                <header class="panel-heading font-bold">Payment Collection Form</header>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Member</label>
                        <div class="col-sm-10">
                            <select id="member_list" class="select2" name="member_id" style="width: 100%">
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Month</label>
                        <div class="col-sm-4">
                            <select data-required="true" class="form-control" id="month_no" name="month_no">
                                <option value="0">--Choose Month--</option>
                                <option value="1">Jan</option>
                                <option value="2">Feb</option>
                                <option value="3">Mar</option>
                                <option value="4">Apr</option>
                                <option value="5">May</option>
                                <option value="6">Jun</option>
                                <option value="7">Jul</option>
                                <option value="8">Aug</option>
                                <option value="9">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Year</label>
                        <div class="col-sm-4">
                            <select data-required="true" class="form-control" id="year_no" name="year_no">
                                <option value="0">--Choose Year--</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Payment Type</label>
                        <div class="col-sm-4">
                            <select data-required="true" class="form-control" id="paid_method" name="paid_method">

                            </select>
                        </div>

                        <label class="col-sm-2 control-label">Ref No</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="ref_no" name="ref_no">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Amount</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="paid_amount" name="paid_amount">
                        </div>
                        <label class="col-sm-2 control-label">Collection Date</label>
                        <div class="col-sm-4">
                            <input id="collection_date" name="collection_date" class="input-sm datepicker-input form-control" type="text" value="" data-date-format="yyyy-mm-dd" >
                        </div>
                    </div>

                    <div class="line line-lg pull-in"></div>
                    <div class="form-group">
                        <div class="col-sm-10" align="center">
                            <button type="button" id="resetBtn" class="btn btn-default">Cancel</button>
                            <button type="submit" id="btnSubmit" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>
</form>



    <div class="row">
        <div class="col-sm-12">
            <section class="panel panel-default form-horizontal">
                <header class="panel-heading font-bold">Payment Collection List</header>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="payment_grid" class="table table-striped b-t b-light">
                            <thead>
                            <tr>
                                <th class="th-sortable" data-toggle="class">Collection ID</th>
                                <th>Member Id</th>
                                <th>Member Name</th>
                                <th>Instalment</th>
                                <th>Date</th>
                                <th>Collection Type</th>
                                <th>Ref No</th>
                                <th>Collection Amount</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>



                    <div class="line line-lg pull-in"></div>
                    <div class="form-group">
                        <div class="col-sm-10" align="center">

                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>



<script>
    $(document).ready(function() {
        $('.select2').select2();
        $( "#collection_date" ).datepicker();
    });


    $('#resetBtn').click(function(){
        resetForm();
    });

    loadDataGrid();
    loadCollectionInfo();
    getPaymentMethod();
    function loadDataGrid(){
        var postData = {actionType:'getAllMembers'};
        //$('.table tbody tr').remove();
        var html = "<option value=''>-- Select Member --</option>";
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
                    html +="<option value='"+data.member_id+"'>"+data.member_name+"</option>";
                });
            }
        });
        $('#member_list').html(html);
    }


    function getPaymentMethod(){
        var postData = {actionType:'getAllMembers'};
        //$('.table tbody tr').remove();
        var html = "<option value=''>-- Select Method --</option>";
        $.ajax({
            url: 'controller/infos.php?actionType=getPaymentMethod',
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
                    html +="<option value='"+data.paid_method_id+"'>"+data.paid_method+"</option>";
                });
            }
        });
        $('#paid_method').html(html);
    }

    function resetForm(){
        $("#member_list").select2("val","");
        $('#submit_form')[0].reset();
    }

    function loadCollectionInfo(){
        var postData = {actionType:'paymentInfo'};
        //$('.table tbody tr').remove();
        var html = "";
        $.ajax({
            url: 'controller/infos.php?actionType=paymentInfo',
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
                    html +="<td align='center' class='id'>"+data.collection_id+"</td>";
                    html +="<td align='center' class='installment_no'>"+data.member_no+"</td>";
                    html +="<td class='pay_type'>"+data.member_name+"</td>";
                    html +="<td align='right' class='payable'>"+data.month_name+" "+data.year_no+"</td>";
                    html +="<td class='pay_type'>"+data.collection_date+"</td>";
                    html +="<td class='payment_date' align='center'>"+data.paid_method+"</td>";
                    html +="<td class='payment_date' align='center'>"+data.ref_no+"</td>";
                    html +="<td class='payment_date' align='right'>"+data.paid_amount+"</td>";
                    html +='</tr>';
                });
            }
        });
        $('#payment_grid tbody').html(html);
    }

    $("form#submit_form").submit(function(event) {
        //var gender = $('input[name="gender"]:checked').val();

        if($.trim($('#month_no').val()).length==0 ){
            alert('Please select month');
            return false;
        }else if($.trim($('#year_no').val()).length==0 ){
            alert('Please select year');
            return false;
        }else if($.trim($('#paid_method').val()).length==0 ) {
            alert('Please Enter paid method');
            return false;
        }else if($.trim($('#paid_amount').val()).length==0 ){
            alert('Please Enter paid amount');
            return false;
        } else {

            $('#btnSubmit').prop('disabled',true);
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            formData.append("action","insertOrUpdate");
            //formData.append("gender",gender);
            $.ajax({
                url: "../friends/controller/payment_collection_controller.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#btnSubmit').prop('disabled',false);
                    var result = JSON.parse(data);
                    if (result.success) {
                        // document.getElementById("submit_form").reset();
                        resetForm();
                        loadCollectionInfo();
                        alert("Paid Successfully.");
                    }
                    else if (result.error) {
                        //clearForm();
                        alert("Collection !! Error");
                    }
                }
            });
            return false;
        }

    });
</script>


	
