<div class="wraper">      

    <div class= "row">

        <div class="col-md-12 container form-wraper" style= "margin-left: 0%;">
        
            <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/addPaymentDetails");?>" onsubmit="return validate()" >
                
                <div class="form-header">
                
                    <h4>Add New Payment</h4>
                
                </div>

                <div class="form-group row">

                    <label for="date" class="col-sm-2 col-form-label">Date:<font color= "red">*</font></label>

                    <div class="col-sm-4">
                        <input type="date" name= "trans_dt" id= "trans_dt" class= "form-control required" required>
                    </div>

                    <label for="payment_key" class="col-sm-2 col-form-label">Payment Key:<font color= "red">*</font></label>

                    <div class="col-sm-4">
                        
                        <input type="text" name= "payment_key" id= "payment_key" class= "form-control required" required>
                        
                    </div>

                </div>

                <div class="form-group row">

                    <label for="tot_pb_amnt" class="col-sm-2 col-form-label">Total PB Amount</label>
                    <div class="col-sm-4">
                        
                        <input type= "text" name= "tot_pb_amnt" id= "tot_pb_amnt" class= "form-control required">

                    </div>

                    <label for="tot_sb_amnt" class="col-sm-2 col-form-label">Total SB Amount</label>
                    <div class="col-sm-4">
                        
                        <input type="text" name= "tot_sb_amnt" id= "tot_sb_amnt" class= "form-control required">

                    </div>

                </div>

                <div class="form-group row">

                    <label for="shortage" class="col-sm-2 col-form-label">Shortage(Dal, Salt)</label>
                    <div class="col-sm-4">
                        
                        <input type="text" name= "shortage" id= "shortage" value= "<?php echo '0.00'; ?>" class= "form-control required">

                    </div>

                    <label for="oil_shortage" class="col-sm-2 col-form-label">Shortage(Oil)</label>
                    <div class="col-sm-4">
                        
                        <input type="text" name= "oil_shortage" id= "oil_shortage" value= "<?php echo '0.00'; ?>" class= "form-control required">

                    </div>

                </div>

                <div class="form-group row">

                    <label for="tot_payable" class="col-sm-2 col-form-label">Total Payable(Rs)</label>
                    <div class="col-sm-4">
                        
                        <input type="text" name= "tot_payable" id= "tot_payable" class= "form-control required">

                    </div>

                    <label for="tot_rcv" class="col-sm-2 col-form-label">Total Received(Rs)</label>
                    <div class="col-sm-4">
                        
                        <input type="text" name= "tot_rcv" id= "tot_rcv" class= "form-control required">

                    </div>

                </div>

                <div class="form-group row">

                    <label for="commission" class="col-sm-2 col-form-label">Commission (Rs)</label>
                    <div class="col-sm-4">
                        
                        <input type="text" name= "commission" id= "commission" class= "form-control required">

                    </div>

                </div>

                <div class="form-header">
                
                    <h4>Payment Details</h4>
                
                </div>


                <div class="row" style ="margin: 5px;">

                    <div class="form-group">

                        <table class= "table table-striped table-bordered table-hover">

                            <thead>

                                <th style= "text-align: center">MR No</th>
                                <th style= "text-align: center">Bank Name</th>
                                <th style= "text-align: center">Credited(Rs)</th>
                                <th style= "text-align: center">M. Oil(Rs)</th>
                                <th style= "text-align: center">Credit Date</th>
                                
                                <th>
                                    <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                </th>

                            </thead>
                            <hr>
                            <tbody id= "intro">
                                <tr>
                                
                                    <td>
                                        <select name="mr_no[]" id="mr_no" class="form-control required mr_no">
                                            <option value="0">Select MR No</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select name="bank[]" id="bank" class="form-control required">
                                            <option value="0">Select Bank</option>
                                            <?php foreach($data as $key){ ?>
                                                <option value="<?php echo $key->sl_no; ?>"><?php echo $key->bank_name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>

                                    <td>
                                        <input type="text" name="amnt_cr[]" class="form-control required amnt_cr" value= "0.00" id="amnt_cr" required>
                                    </td>

                                    <td>
                                        <input type="text" name="amnt_oil[]" class="form-control required amnt_oil" value= "0.00" id="amnt_oil" required>
                                    </td>

                                    <td>
                                        <input type="date" name="cr_dt[]" class="form-control required cr_dt" id="cr_dt" required>
                                    </td>

                                </tr>

                            </tbody>
                        
                        </table>

                    </div> 

                    <hr>
                    
                </div>

                <div class="form-group row">

                    <label for="remarks" class="col-sm-2 col-form-label">Remarks<font color="red">*</font></label>
                    
                    <div class="col-sm-10">

                        <textarea name="remarks" id="remarks" class="form-control required" cols="200" rows="2"></textarea>

                    </div>

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



<!-- To get pb_amnt and sb_amnt as per payment_key -->
<script>

    $(document).ready(function(){

        $('#payment_key').on("change", function(){

            $.get('<?php echo site_url("sw/js_get_billAmounts_for_paymentKey"); ?>', {payment_key: $('#payment_key').val()})
            .done(function(data){

                $.each(JSON.parse(data), function(index, value){

                    var tot_pb_amnt_val = value.tot_pb_amnt;
                    var tot_sb_amnt_val = value.tot_sb_amnt;
                    //console.log(tot_pb_amnt);

                    $('#tot_pb_amnt').val(tot_pb_amnt_val);
                    $('#tot_sb_amnt').val(tot_sb_amnt_val);

                })
                  
            })

        })

        $('#shortage').on("change", function(){

            var shortage_val = $(this).val();
            //$('#sb_shortage').val(pb_shortage_val);

            var tot_payable_val = parseFloat($('#tot_pb_amnt').val())-parseFloat(shortage_val);
            $('#tot_payable').val(tot_payable_val);

            var tot_rcv_val = parseFloat($('#tot_sb_amnt').val())-parseFloat(shortage_val);
            $('#tot_rcv').val(parseFloat(tot_rcv_val));

            var commission_val = parseFloat($('#tot_rcv').val())-parseFloat($('#tot_payable').val());
            $('#commission').val(commission_val);

        })

    })

</script>



<!-- For add row table -->
<script>

    $(document).ready(function(){

        $('#addrow').click(function(){

            var payment_key = $('#payment_key').val();
            $.get('<?php echo site_url("sw/js_get_mrNo_perPaymentKey");?>', {payment_key : payment_key}) // To get mr_no as per payment_key given
            .done(function(data){ 

                var string = '';
                $.each(JSON.parse(data), function(index, value){

                    string += '<option value= "'+value.mr_no+'">'+ value.mr_no +'</option>';

                })



                $.get('<?php echo site_url("sw/js_get_shortage_bankName_for_addRow") ?>') // To get bank name in add row option
                .done(function(data){

                    string1 = '<option value= "">Select Bank</option>';
                    $.each(JSON.parse(data), function(index, value){

                        string1 += '<option value= "'+value.sl_no+'">'+value.bank_name+'</option>';

                    })

                    //$('.bankClass').html(string1);
                    //$('#bank').html(string1);


                    var newElement = '<tr>'
                                        +'<td>'
                                            +'<select name="mr_no" id="mr_no" class="form-control required mr_no">'
                                                +'<option value="0">Select MR No</option>'
                                                +string
                                            +'</select>'
                                        +'</td>'
                                        +'<td>'
                                            +'<select name="bank" id="bank" class="form-control required bankClass">'
                                                +'<option value="0">Select Bank</option>'
                                                +string1
                                            +'</select>'
                                        +'</td>'
                                        +'<td>'
                                            +'<input type="text" name="amnt_cr[]" class="form-control required amnt_cr" value= "0.00" id="amnt_cr" required>'
                                        +'</td>'
                                        +'<td>'
                                            +'<input type="text" name="amnt_oil[]" class="form-control required amnt_oil" value= "0.00" id="amnt_oil" required>'
                                        +'</td>'
                                        +'<td>'
                                            +'<input type="date" name="cr_dt[]" class="form-control required cr_dt" id="cr_dt" required>'
                                        +'</td>'
                                        +'<td>'
                                            +'<button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>'
                                        +'</td>'
                                    +'</tr>';


                    $("#intro").append($(newElement));

                })

            })

        })

        $("#intro").on("click","#removeRow", function(){
            $(this).parents('tr').remove();
            //$('.amount_cls').change();
        });

    })

</script>



<!-- To get MR NO as per payment key given -->
<script>

    $(document).ready(function(){

        $('#payment_key').on("change", function(){

            var payment_key = $(this).val();
            $.get('<?php echo site_url("sw/js_get_mrNo_perPaymentKey");?>', {payment_key : payment_key})
            .done(function(data){

                var string = '';
                $.each(JSON.parse(data), function(index, value){

                    string += '<option value= "'+value.mr_no+'">'+ value.mr_no +'</option>';

                })

                $('#mr_no').append(string);
                
            })

        })

    })

</script>

