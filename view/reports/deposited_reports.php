

<ul class="breadcrumb no-border no-radius b-b b-light pull-in">
    <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="#">Reports</a></li>
    <li class="active">Deposited Report</li>
</ul>



<form id="submit_form" class="bs-example">
    <div class="m-b-md"><h3 class="m-b-none">Deposited Report</h3> </div>


    <div class="row">
        <div class="col-sm-6">
            <section class="panel panel-default form-horizontal">
                <header class="panel-heading font-bold">Members</header>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <select id="member_list" class="select2" name="member_id" style="width: 100%">
                            </select>
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
            <header class="panel-heading font-bold">Deposited Statement</header>
            <div class="panel-body">

                <div class="table-responsive">
                    <table id="balance_grid" class="table table-striped b-t b-light">
                        <thead>
                        <tr>
                            <th>Deposited Date</th>
                            <th>Month</th>
                            <th>Payment Method</th>
                            <th>Ref No.</th>
                            <th align="right">Deposited Amount</th>
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
        $("#member_list").select2();
        $('#member_list').on('change', function() {
            var memberID = $(this).val();
            loadDepositedHistory(memberID);
        });
    });



    loadMemberCombobox();

    function loadMemberCombobox(){
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


    function loadDepositedHistory(memberID){
        var postData = {actionType:'depositedHistory',member_id:memberID};
        // var postData = "actionType=depositedHistory && member_id="+memberID;
        //$('.table tbody tr').remove();
        var html = "";
        $.ajax({
            url: 'controller/report_controller.php?actionType=depositedHistory&& member_id='+memberID,
            method: 'POST',
            data: JSON.stringify(postData),
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                // $('#balance_grid').html(data);
                let balanceAmount = 0;
                var result = JSON.parse(data);
                $.each(result, function(i,data){
                    html +="<tr>";
                    html +="<td align='center' class='installment_no'>"+data.deposited_date+"</td>";
                    html +="<td class='pay_type'>"+data.month_name+"</td>";
                    html +="<td class='pay_type'>"+data.paid_method+"</td>";
                    html +="<td class='pay_type'>"+data.ref_no+"</td>";
                    html +="<td class='pay_type' align='right'>"+data.deposited_amount+"</td>";
                    html +='</tr>';
                    balanceAmount += parseInt(data.deposited_amount);
                });
                html +="<tr><td colspan='2' align='right'><b>Total Deposited</b></td><td align='right'><b>"+balanceAmount+"</b></td></tr>";
            }
        });
        $('#balance_grid tbody').html(html);
    }

</script>



