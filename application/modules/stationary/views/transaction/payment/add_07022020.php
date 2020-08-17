
<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/addNewPayment");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Add Bill Payment</h4>
            
            </div>

            <div class="form-group row">

                <label for="trans_dt" class="col-sm-2 col-form-label">Date<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="date" name="trans_dt" class="form-control required" id="trans_dt" required>
                        
                </div>

                <label for="project_cd" class="col-sm-2 col-form-label">Project:<font color="red">*</font></label>
                
                <div class="col-sm-4">

                    <select name="project_cd" id="project_cd" class= "form-control required" required>
                        <option value="">Select Project</option>
                        <?php foreach($projects as $data){ ?>
                            <option value="<?php echo $data->project_cd; ?>"><?php echo $data->name; ?></option>
                        <?php } ?>
                    </select>

                </div>

            </div>

            <div class="form-group row">

                <label for="order_no" class="col-sm-2 col-form-label">Order No<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select name="order_no" id="order_no" class= "form-control required"  required >
                            <option value="">Select Order</option>
                    </select>

                </div>

                <label for="bill_no" class="col-sm-2 col-form-label">Bill<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select name="bill_no" id="bill_no" class= "form-control required"  required >
                            <option value="">Select Bill</option>
                    </select>

                </div>

            </div>

            <div class="form-group row">

                <label for="supplier" class="col-sm-2 col-form-label">Supplier</label>
                
                <div class="col-sm-4">

                    <input type="text" name="supplier_cd" class="form-control required" id="supplier_cd" value= "" >

                </div>
                
                <label for="amount" class="col-sm-2 col-form-label">Amount(Rs.)</label>
                
                <div class="col-sm-4">

                    <input type="text" name="amount" class="form-control required" id="amount" value= "" readonly >

                </div>

            </div>
            <hr>

            <div class="form-group row">

                <label for="part" class="col-sm-2 col-form-label">Payment Part<font color="red">*</font></label>
                
                <div class="col-sm-4">

                    <select name="part" id="part" class= "form-control required" >
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>

                </div>
                
                <label for="col_amount" class="col-sm-2 col-form-label">Collection Amount(Rs.)<font color="red">*</font></label>
                
                <div class="col-sm-4">

                    <input type="text" name="col_amount" class="form-control required" id="col_amount" value= "<?php echo "0.00" ?>" required >

                </div>

            </div>

            <div class="form-group row">
                
                <label for="mode" class="col-sm-2 col-form-label">Mode Of Transaction</label>
                
                <div class="col-sm-4">

                    <select name="mode" id="mode" class= "form-control required"  >
                            <option value="0">Select mode</option>
                            <option value="cash">Cash</option>
                            <option value="neft">NEFT</option>
                            <option value="cheque">Cheque</option>
                    </select>

                </div>

                <div id= "refNo">
                    <label for="ref_no" class="col-sm-2 col-form-label">Ref No</label>
                    
                    <div class="col-sm-4">

                        <input type="text" name="ref_no" class="form-control required" id="ref_no" value= "" >
                        
                    </div>
                </div>

            </div>

            <div class="form-group row">
                
                <label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
                
                <div class="col-sm-6">

                    <textarea name="remarks" class="form-control required" id="remarks" cols="30" rows="2"></textarea>

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



<script>    

    $(document).ready(function()
    {
        $('#refNo').hide();
        
        // <!-- To get Order No as per Project Selected  -->

        $('#project_cd').on( "change", function()
        {
            //console.log($(this).val());
            $.get('<?php echo site_url("stationary/js_get_payment_orderForProject");?>',{ project_cd: $(this).val() })
                                                    
            .done(function(data)
            {
                //console.log(data);
                var string = '<option value="0">Select Order</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="'+value.order_no +'">'+value.order_no+'</option>'

                });
                
                $('#order_no').html(string);            

            });

        });


        // To get Supplier as per Order Selected -->

        $('#order_no').on( "change", function()
        {
            $.get('<?php echo site_url("stationary/js_get_Payment_supplierForBill");?>',{ order_no: $(this).val() })

            .done(function(data)
            {
                //console.log(data);
                var supplier = JSON.parse(data)
                $('#supplier_cd').val(supplier.supplier);            

            });

        });


        // <!-- To get Bill No as per Order Selected  -->

        $('#order_no').on( "change", function()
        {
            $.get('<?php echo site_url("stationary/js_get_payment_billForOrder");?>',{ order_no: $(this).val() })

            .done(function(data)
            {
                //console.log(data);
                var string1 = '<option value="0">Select Bill</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string1 += '<option value="'+value.bill_no +'">'+value.bill_no+'</option>'

                });
                
                $('#bill_no').html(string1);            

            });

        });


        // <!-- To get Amount as per Bill Selected  -->
        
        $('#bill_no').on( "change", function()
        {
            $.get('<?php echo site_url("stationary/js_get_payment_amountForBill");?>',{ bill_no: $(this).val() })

            .done(function(data)
            {
                //console.log(data);
                var amount = JSON.parse(data)
                $('#amount').val(amount.amount);            

            });

        });


        // To show or hide the Ref No section -->  
        $('#mode').on( "change", function()
        {

            var mode = $(this).val();
            if(mode == "neft" || mode == "cheque")
            {
                $('#refNo').show();
            }
            else if(mode == "cash" || mode == "0")
            {
                $('#refNo').hide();
            }

        });

    });

</script> 

