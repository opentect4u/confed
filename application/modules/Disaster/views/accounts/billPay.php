<div class="wraper">      

    <div class= "row">

        <div class="col-md-12 container form-wraper" style= "margin-left: 0%;">

            <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("Disaster/paymentEntry");?>" onsubmit="return validate()" >
                

                <div class="form-header">
                
                    <h4>Add New Receipt</h4>
                
                </div>

                <div class="form-group row">

                    <label for="memo" class="col-sm-2 col-form-label">Memo No:<font color= "red">*</font></label>

                    <div class="col-sm-4">
                        <input type="text" name= "memo_no" id= "memo_no" class= "form-control required" required>
                    </div>

                </div>
                <div class="form-group row">

                    <label for="entry_type" class="col-sm-2 col-form-label">Entry Type:</label>
                    <div class="col-sm-4">
                        
                        <select name="entry_type" id="entry_type" class= "form-control required" required>
                            <option value="1">Regular Entry</option>
                            <option value="2">Backlog Entry</option>
                        </select>

                    </div>

                </div>

                <div class="row" style ="margin: 5px;">

                    <div class="form-group">

                        <table class= "table table-striped table-bordered table-hover">

                            <thead>

                                <th style= "text-align: center">District</th>
                                <th style= "text-align: center">order_no</th>
                                <th style= "text-align: center">PB No</th>
                                <th style= "text-align: center">PB Date</th>
                                <th style= "text-align: center">PB Amount</th>
                                <th style= "text-align: center">SB No</th>
                                <th style= "text-align: center">SB Date</th>
                                <th style= "text-align: center">SB Amount</th>
                                
                                <th>
                                    <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                </th>

                            </thead>
                            <hr>

                            <tbody id= "intro" class= "tbody">

                                <tr>
                                
                                    <td>
                                        <select name="dist_cd[]" id="dist_cd" class= "form-control required distCd">
                                            <option value="">Select District</option>
                                            <?php foreach($dist_data as $key){ ?>
                                                <option value="<?php echo $key->district_code; ?>"><?php echo $key->district_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    
                                    <td>
                                        <input type="text" name= "order_no[]" class="form-control required orderNo" id= "order_no" required>
                                    </td>

                                    <td>
                                        <input type="text" name="pb_no[]" class="form-control required pbNo" id="pb_no" required>
                                    </td>

                                    <td>
                                        <input type="date" name="pb_dt[]" class="form-control required pbDate" id="pb_dt" required>
                                    </td>

                                    <td>
                                        <input type="text" name="pb_amnt[]" class="form-control required pbAmnt" id="pb_amnt" required>
                                    </td>

                                    <td>
                                        <input type="text" name="sb_no[]" class="form-control required sbNo" id="sb_no" required>
                                    </td>

                                    <td>
                                        <input type="date" name="sb_dt[]" class="form-control required sbDate" id="sb_dt" required>
                                    </td>

                                    <td>
                                        <input type="text" name="sb_amnt[]" class="form-control required sbAmnt" id="sb_amnt" required>
                                    </td>

                                </tr>   

                            </tbody>
                        
                        </table>

                    </div> 

                    <hr>
                    
                </div>

                
                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>


<!-- For add row table -->
<script>

    $(document).ready(function(){

        $("#addrow").click(function()
        {

            $.get('<?php echo site_url("Disaster/js_get_bill_districtCode") ?>')
            .done(function(data){

                var subString = '';

                $.each(JSON.parse(data), function(index, value){

                    subString += '<option value="'+value.district_code+'">'+value.district_name+'</option>';
                    
                })

                var string1 = '<tr>'
                                +'<td>'
                                    +'<select name="dist_cd[]" id="dist_cd" class= "form-control required distCd">'
                                        +'<option value="">Select District</option>'
                                            +subString
                                    +'</select>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="text" name= "order_no[]" class="form-control required orderNo" id= "order_no" required>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="text" name="pb_no[]" class="form-control required pbNo" id="pb_no" required>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="date" name="pb_dt[]" class="form-control required pbDate" id="pb_dt" required>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="text" name="pb_amnt[]" class="form-control required pbAmnt" id="pb_amnt" required>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="text" name="sb_no[]" class="form-control required sbNo" id="sb_no" required>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="date" name="sb_dt[]" class="form-control required sbDate" id="sb_dt" required>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="text" name="sb_amnt[]" class="form-control required sbAmnt" id="sb_amnt" required>'
                                +'</td>'
                                +'<td>'
                                    +'<button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>'
                                +'</td>'
                            '</tr>';

                $("#intro").append(string1);
                    
            })

            
        })

        $("#intro").on("click","#removeRow", function(){

            $(this).parents('tr').remove();

        });

    })

</script>



<!-- For getting sale bill details as per purchase bill  -->
<script>

    $('.table tbody').on('change', '.pbDate', function(){
        var row = $(this).closest('tr');

        //var col = $(this).closest('td');
        //var texto1 = row.find('td:eq(0)').value();
        
        var distCd = row.find('td:eq(0) :selected').val();
        //var orderNo = row.find('td:eq(1S) :selected').val();
        var orderNo = row.find('td:eq(1) :input').val();
        var pbNo = row.find('td:eq(2) :input').val();
        var pbDt = row.find('td:eq(3) :input').val();


        $.get('<?php echo site_url("Disaster/js_get_payment_saleBillDtls");?>',{ distCd: distCd, orderNo: orderNo, pbNo: pbNo, pbDt: pbDt })
        .done(function(data)
        {
            var result = JSON.parse(data)[0];
            //console.log(result);
            var pb_amount = result.pb_amount;
            var sb_amount = result.sb_amount;
            var sb_dt = result.sb_dt;
            var sb_no = result.sb_no;

            row.find('td:eq(4) :input').val(pb_amount);
            row.find('td:eq(5) :input').val(sb_no);
            row.find('td:eq(6) :input').val(sb_dt);
            row.find('td:eq(7) :input').val(sb_amount);
            

        });
        

    })
 
</script>
