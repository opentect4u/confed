
<div class="wraper">      
<div class= "row">

    <div class="col-md-8 container form-wraper" style="margin-left: 200px;">
    
        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/updateNewDelivery");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Add New Delivery</h4>
            
            </div>
            
            <?php foreach($data as $key1)
                { ?>
                <?php //echo $key1->purchase_dt; die; ?>

                    <div class="form-group row">

                        <label for="trans_dt" class="col-sm-2 col-form-label">Delivery Date:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="date" name="trans_dt" class="form-control required" value= "<?php echo $key1->trans_dt ?>" id="trans_dt" readonly>
                                    
                        </div>

                        <label for="order_no" class="col-sm-2 col-form-label">Order No:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="text" name= "order_no" id= "order_no" value= "<?php echo $key1->order_no.' DT '.$key1->order_dt; ?>" class="form-control required" readonly>

                        </div>
                        <input type="hidden" name="trans_cd" class="form-control required" value= "<?php echo $key1->trans_cd ?>" id="trans_dt" required>
                        <input type="hidden" name="sl_no" class="form-control required" value= "<?php echo $key1->sl_no ?>" id="trans_dt" required>

                    </div>

                    <div class="form-group row">

                        <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>
                        <div class="col-sm-10">

                            <select name="dist_cd" id="dist_cd" class= "form-control required" required>
                                <option value="<?php echo ($key1->dist_cd); ?>"><?php echo ($key1->district_name); ?></option>
                                
                            </select>
                            <input type="hidden" value= "<?php echo $key1->trans_cd; ?>"  name= "trans_cd" id= "trans_cd" >
                        
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="project_no" class="col-sm-2 col-form-label">Project:<font color="red">*</font></label>
                        <div class="col-sm-10">

                            <select name="project_no" id="project_no" class= "form-control required" required>
                                <option value="<?php echo $key1->cdpo_no; ?>"><?php echo $key1->cdpo; ?></option>

                            </select>
                            
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="hsn_no" class="col-sm-2 col-form-label">Item :<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <select name="hsn_no" id="hsn_no" class= "form-control required" required>
                                <option value="<?php echo ($key1->hsn_no); ?>"><?php echo ($key1->item_name); ?></option>

                            </select>

                        </div>

                        <label for="allot_qty" class="col-sm-2 col-form-label">Alloted Qty :</label>
                        <div class="col-sm-4">
                            
                            <input type="text" name="allot_qty" value= "<?php echo $allotQty->allot_qty; ?>" class="form-control required" id="allot_qty" readonly>
                              
                        </div>

                    </div>

                    <div class="form-group row" id= "deliveredSection">

                        <label for="allot_qty" class="col-sm-2 col-form-label">Already Delivered:</label>
                        <div class="col-sm-4">
                            
                            <input type="text" name="delivered" value= "<?php echo $already_del_qty; ?>" class="form-control required" id="delivered" readonly>
                              
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="challan_no" class="col-sm-2 col-form-label">Challan No :<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="text" name="challan_no" value= "<?php echo $key1->challan_no; ?>" class="form-control required" id="challan_no" readonly>
                                    
                        </div>

                        <label for="del_qty" class="col-sm-2 col-form-label">Delivery Qty :<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="text" name="del_qty" value= "<?php echo $key1->del_qty; ?>" class="form-control required" id="del_qty" required>
                                    
                        </div>

                    </div>

            
                    <span id= "alert1"><font color="red">*Delivered Qty can't be greater than Alloted Qty</font></span>
                    
                    <div class="form-header">
                    
                        <h4>Supplier Details</h4>
                    
                    </div> 

                    <div class="form-group row">

                        <label for="purchase_dt" class="col-sm-2 col-form-label">Purchase Date:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="date" name="purchase_dt" value= "<?php echo $key1->purchase_dt; ?>" class="form-control required" id="purchase_dt" required>
                                    
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="vendor_cd" class="col-sm-2 col-form-label">Supplier:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <select name="vendor_cd" id="vendor_cd" class= "form-control required" required>
                                <option value="<?php echo ($key1->vendor_cd); ?>"><?php echo ($key1->vendor_name); ?></option>

                            </select>

                        </div>

                        <label for="pb_no" class="col-sm-2 col-form-label">P/B No:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="text" name="pb_no" value= "<?php echo $key1->pb_no; ?>" class="form-control required" id="pb_no" required>
                                    
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="cgst" class="col-sm-2 col-form-label">CGST:</label>
                        <div class="col-sm-4">

                            <input type="text" name="cgst" value= "<?php echo $key1->cgst; ?>" class="form-control required" id="cgst" value= "0.00" required>
                                    
                        </div>

                        <label for="sgst" class="col-sm-2 col-form-label">SGST:</label>
                        <div class="col-sm-4">

                            <input type="text" name="sgst" value= "<?php echo $key1->sgst; ?>" class="form-control required" id="sgst" value= "0.00" required>
                                    
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="tax_val" class="col-sm-2 col-form-label">Taxable Amount:</label>
                        <div class="col-sm-4">

                            <input type="text" name="tax_val" value= "<?php echo $key1->tax_val; ?>" class="form-control required" id="tax_val" value= "0.00" required>
                                    
                        </div>

                        <label for="tot_amnt" class="col-sm-2 col-form-label">Total(Rs.):<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="text" name="tot_amnt" value= "<?php echo $key1->tot_amnt; ?>" class="form-control required" id="tot_amnt" value= "0.00" required>
                                    
                        </div>

                    </div>

            <?php 
                } ?>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" id= "submit" value="Save" />

                </div>

            </div>

        </form>

    </div>

    </div>

</div>


<!-- For GST and total value Calculation -->
<script>

    $(document).ready(function(){

        $('#deliveredSection').hide();
        $('#alert1').hide();

        $('#del_qty').on("change", function(){

            var deliveryQty = $(this).val();
            var del_dt = $('#trans_dt').val();
            var hsn_no = $('#hsn_no').val();
            
            $.get('<?php echo site_url("sw/js_get_marginGST_forProduct_priceCalculation") ?>', {hsn_no : hsn_no, del_dt : del_dt})
            .done(function(data){

                $.each(JSON.parse(data), function( index, value ) {

                    var marginVal = value.margin;
                    var gstVal = value.gst;
                    var rateVal = value.rate;

                    // Total calculation -- 
                    var priceVal = parseFloat(deliveryQty)*parseFloat(rateVal);
                    var totMarginVal = parseFloat(marginVal)*parseFloat(deliveryQty);
                    var total = parseFloat(priceVal - totMarginVal);
                    $('#tot_amnt').val(total);

                    //GST calculation --
                    var totGSTVal_numerator = parseFloat(priceVal)*parseFloat(gstVal) ;
                    var totGSTVal_denominator = (100 + parseFloat(gstVal)) ;
                    var totGSTVal = parseFloat(totGSTVal_numerator)/parseFloat(totGSTVal_denominator);
                    var GST = parseFloat(totGSTVal/2);

                    $('#cgst').val(GST.toFixed(2));
                    $('#sgst').val(GST.toFixed(2));

                    // Taxable Amount calculation --
                    var taxableVal = parseFloat(priceVal - totGSTVal);
                    $('#tax_val').val(taxableVal.toFixed(2));
                })

            })

        })

    })

</script>


<!-- For Checking whather del_qty is greater than undelivered qty of that product -->
<script>

    $(document).ready(function(){

        $('#del_qty').on("change", function(){

            var del_qty = $(this).val();
            var already_del_qty = $('#delivered').val();
            var allot_qty = $('#allot_qty').val();

            var undel_qty = parseFloat(allot_qty) - parseFloat(already_del_qty);
            if(del_qty > undel_qty)
            {
                $('#alert1').show();
                $('#submit').prop('disabled', true);
                $('#del_qty').css('border-color', 'red');
                return false;
            }
            else
            {
                $('#alert1').hide();
                $('#del_qty').css('border-color', 'green');
                $('#submit').prop('disabled', false);
                return true;
            }

        })

    })

</script>
