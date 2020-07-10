
<div class="wraper">      

    <div class="row">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/addPaymentEntry");?>" onsubmit="return validate()" >
            
            <div class="col-md-6 container form-wraper" style="margin-left: 0px;" >

                <div class="form-header">
                
                    <h4>Add New Payment</h4>
                
                </div>

                <div class="form-group row">

                    <label for="order_no" class="col-sm-2 col-form-label">Order No:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="text" name="order_no" class="form-control required" id="order_no" required>
                                
                    </div>

                    <label for="trans_dt" class="col-sm-2 col-form-label">Date:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="date" name="trans_dt" class="form-control required" id="trans_dt" required>
                                
                    </div>

                </div>

                <div class="form-group row">

                    <label for="dist_cd" class="col-sm-2 col-form-label">District:</label>
                    <div class="col-sm-10">

                        <select name="dist_cd" id="dist_cd" class= "form-control required" required>
                            
                        </select>
                        
                    </div>
                
                </div>

                <div class="form-group row">

                    <label for="cdpo_no" class="col-sm-2 col-form-label">Project:</label>
                    <div class="col-sm-10">

                        <select name="cdpo_no" id="cdpo_no" class= "form-control required" required>
                            
                        </select>
                        
                    </div>

                </div>
            
                <div class="form-group row">

                    <label for="s_bill_no" class="col-sm-2 col-form-label">Sale Bill No :<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <textarea name="s_bill_no" id="s_bill_no" class= "form-control required" cols="30" rows=""></textarea> 

                    </div>

                    <label for="mr_no" class="col-sm-2 col-form-label">MR No :<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="text" name= "mr_no" id= "mr_no" class= "form-control required" required>
                    
                    </div>

                </div>
            
                <label for="alert" ><font color="green">*Bill No should be in (',') and no space Format. i.e:: 111,222,333,.....</font></label>

                <br><br>

                <div class="form-group row">

                    <label for="tot_sale_amnt" class="col-sm-2 col-form-label">Sale Price:</label>
                    <div class="col-sm-4">

                        <input type="text" name= "tot_sale_amnt" id= "tot_sale_amnt" class= "form-control required" >
                    
                    </div>

                    <label for="tot_purchase_amnt" class="col-sm-2 col-form-label">Purchase Price:</label>
                    <div class="col-sm-4">

                        <input type="text" name= "tot_purchase_amnt" id= "tot_purchase_amnt" class= "form-control required" >
                    
                    </div>
                        
                </div>

                <div class="form-group row">

                    <label for="rcv_amnt" class="col-sm-2 col-form-label">Received Amount(Rs):<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="text" name= "rcv_amnt" id= "rcv_amnt" class= "form-control required" required>
                    
                    </div>
                    
                    <label for="shortage_amnt" class="col-sm-2 col-form-label">Shortage Amount(Rs):</label>
                    <div class="col-sm-4">

                        <input type="text" name="shortage_amnt" class="form-control required" id="shortage_amnt" >
                                
                    </div>

                </div>

                <div class="form-group row">

                    <label for="pay_amnt" class="col-sm-2 col-form-label">Payable Amount(Rs):</label>
                    <div class="col-sm-4">

                        <input type="text" name= "pay_amnt" id= "pay_amnt" class= "form-control required" required >
                    
                    </div>

                    <label for="shortage_amnt" class="col-sm-2 col-form-label">Commission</label>
                    <div class="col-sm-4">

                        <input type="text" name="commission" class="form-control required" id="commission" value= "00.00" required>
                                
                    </div>

                </div>

                <div class="form-group row">

                    <label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
                    <div class="col-sm-8">
                    <textarea name="remarks" id="remarks" cols="30" rows="" class= "form-control required" ></textarea>
                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            </div>

            <div class="col-md-5 container form-wraper" style="margin-left: 10px; width: 48%;" >

                <div class="form-header">
                    
                    <h4>Sale Bill Details</h4>
                
                </div>
                
                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th>Bill No</th>
                            <th>Item</th>
                            <th>Amount(Rs)</th>

                        </tr>

                    </thead>

                    <tbody id= "info_table1" >
                    
                    </tbody>

                </table>

                <div class="form-header">
                    
                    <h4>Purchase Bill Details</h4>
                
                </div>
                
                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th>Bill No</th>
                            <th>Item</th>
                            <th>Amount(Rs)</th>

                        </tr>

                    </thead>

                    <tbody id= "info_table2" >
                    
                    </tbody>

                </table>

            </div>

        </form>

    </div>

</div>



<!-- To get Sale Bill Details in info_table1 -->
<script>

    $(document).ready(function(){

        $('#order_no').on("change", function(){
            //console.log($(this).val());
            $.get('<?php echo site_url("sw/js_get_payment_saleBillDtls") ?>', {order_no: $(this).val()})
            .done(function(data){
                
                $.each(JSON.parse(data), function( index, value ){

                    var bodyEliment1 = '<tr> <td>'+value.bill_no+'</td> <td>'+value.item_name+'</td> <td>'+value.tot_amnt+'</td> </tr>';
                    $('#info_table1').append($(bodyEliment1));
                })

            })

        })

        $('#order_no').on("change", function(){

            $.get('<?php echo site_url("sw/js_get_payment_purchaseBillDtls") ?>', {order_no: $(this).val()})
            .done(function(data){
                
                $.each(JSON.parse(data), function( index, value ){

                    var bodyEliment2 = '<tr> <td>'+value.pb_no+'</td> <td>'+value.item_name+'</td> <td>'+value.tot_amnt+'</td> </tr>';
                    $('#info_table2').append($(bodyEliment2));
                })

            })

        })

    })

</script>


<!-- To get district, project as per order_no -->
<script>

    $(document).ready(function(){

        $('#order_no').on("change", function(){

            $.get('<?php echo site_url("sw/js_get_payment_districtProject_forOrder") ?>', {order_no: $(this).val()})
            .done(function(data){

                var string1 = '';
                var string2 = '';

                $.each(JSON.parse(data), function( index, value ) {

                    string1 += '<option value="'+value.dist_cd +'">'+value.district_name+'</option>';
                    string2 += '<option value="'+value.cdpo_no +'">'+value.cdpo+'</option>';

                });
                
                $('#dist_cd').html(string1);
                $('#cdpo_no').html(string2);

            })

        })

    })

</script>


<!-- TO get total sale and purchase price of the Sale Bill nos given  -->
<script>

    $(document).ready(function()
    {
        $('#s_bill_no').on("change",function()
        {

            var s_billNo = $('#s_bill_no').val();
            var order_no = $('#order_no').val();
            var sBill_data = '('+s_billNo+')';
            //console.log(sBill_data);

            $.get('<?php echo site_url("sw/js_get_price_asSBillNo");?>',{ sBill_data: sBill_data, order_no: order_no })                                  
            .done(function(data){

                var amount1 =JSON.parse(data)
                //console.log(amount1);
                $('#tot_sale_amnt').val(amount1.tot_amnt);

            });

        });


        // $('#s_bill_no').on("change",function()
        // {

        //     var s_billNo = $(this).val();
        //     var order_no = $('#order_no').val();
        //     var sBill_data = '('+s_billNo+')';
        //     console.log(sBill_data);

        //     $.get('<?php //
        
        
        
        
        
        
        //echo site_url("sw/js_get_purchasePrice_asChallanNo");?>',{ sBill_data: sBill_data, order_no = order_no })                                    
        //     .done(function(data)
        //     {

        //         var amount2 =JSON.parse(data)
        //         console.log(amount2);
        //         $('#tot_purchase_amnt').val(amount2.tot_amnt);

        //     });

        // });
    
    });


</script>


<!-- To Get same shortage amount same in both sale and purchase -->
<script>

    $(document).ready(function()
    {
        $('#shortage_amnt_s').on( "change", function()
        {

            var shortage_amnt_s = $('#shortage_amnt_s').val();
            console.log(shortage_amnt_s);
            $('#shortage_amnt_p').val(shortage_amnt_s);
        
        });

        $('#shortage_amnt_p').on( "change", function()
        {

            var shortage_amnt_p = $('#shortage_amnt_p').val();
            console.log(shortage_amnt_p);
            $('#shortage_amnt_s').val(shortage_amnt_p);
        
        });

    });

</script>


