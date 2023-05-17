

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
                            <select id="member_list" class="select2" style="width:260px">
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
                        <div class="col-sm-4">
                            <select data-required="true" class="form-control"> <option value="">Please choose Month</option> <option value="foo">Foo</option> <option value="bar">Bar</option> </select>
                        </div>
                        <label class="col-sm-2 control-label">Year</label>
                        <div class="col-sm-4">
                            <select data-required="true" class="form-control"> <option value="">Please choose Year</option> <option value="foo">Foo</option> <option value="bar">Bar</option> </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Payment Type</label>
                        <div class="col-sm-4">
                            <select data-required="true" class="form-control">
                                <option value="">-- Choose Type --</option>
                                <option value="bar">Cash</option>
                                <option value="bar">Bank Check</option>
                                <option value="foo">BKash</option>
                                <option value="bar">Rocate</option>
                                <option value="bar">Rocate</option>
                            </select>
                        </div>

                        <label class="col-sm-2 control-label">Ref No</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Amount</label>
                        <div class="col-sm-4">
                            <input type="pament_amount" class="form-control">
                        </div>


                    </div>

                    <div class="line line-lg pull-in"></div>
                    <div class="form-group">
                        <div class="col-sm-10" align="center">
                            <button type="#" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
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
                        <table id="member_grid" class="table table-striped b-t b-light">
                            <thead>
                            <tr>
                                <th class="th-sortable" data-toggle="class">Collection ID</th>
                                <th>Date</th>
                                <th>Member Id</th>
                                <th>Member Name</th>
                                <th>Collection Type</th>
                                <th>Ref No</th>
                                <th>Collection Amount</th>
                                <th></th>
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
    });

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
                    html +="<option value='"+data.member_id+"'>"+data.member_name+"</option>";
                });
            }
        });
        $('#member_list').html(html);
    }

    $("form#submit_form").submit(function(event) {
        //var gender = $('input[name="gender"]:checked').val();

        if($.trim($('#member_name').val()).length==0 ){
            alert('Please Enter Member Name');
            return false;
        }else if($.trim($('#phone_no').val()).length==0 ){
            alert('Please Enter Phone Number');
            return false;
        }else if($.trim($('#monthly_payable').val()).length==0 ) {
            alert('Please Enter monthly payable amount');
            return false;
        }else if($.trim($('#opening_balance').val()).length==0 ){
            alert('Please Enter current balance');
            return false;
        } else {

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

    });
</script>


	
