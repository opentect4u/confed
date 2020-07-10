
<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        
            <div class="form-header">
            
                <h4>Add New Sale</h4>
            
            </div>

            <?php foreach($data as $key){ ?>

                    <div class="form-group row">

                        <label for="trans_dt" class="col-sm-2 col-form-label">Date:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="date" name="trans_dt" value= "<?php echo $key->trans_dt; ?>" class="form-control required" id="trans_dt" required>
                                    
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <select name="dist_cd" id="dist_cd" class= "form-control required" required>
                                <option value="<?php echo $key->dist_cd; ?>"><?php echo $key->district_name; ?></option>
                                
                            </select>
                            
                        </div>

                        <label for="project_no" class="col-sm-2 col-form-label">Project:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <select name="project_no" id="project_no" class= "form-control required" required>
                                <option value="<?php echo $key->cdpo_no; ?>"><?php echo $key->cdpo; ?></option>

                            </select>
                            
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="order_no" class="col-sm-2 col-form-label">Order No:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <select name="order_no" id="order_no" class= "form-control required" required>
                                <option value="<?php echo $key->order_no; ?>"><?php echo $key->order_no; ?></option>

                            </select>

                        </div>

                        <label for="challan_no" class="col-sm-2 col-form-label">Challan No :<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <select name="challan_no" id="challan_no" class= "form-control required" required>
                                <option value="<?php echo $key->challan_no; ?>"><?php echo $key->challan_no; ?></option>

                            </select>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="hsn_no" class="col-sm-2 col-form-label">Item :<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <select name="hsn_no" id="hsn_no" class= "form-control required" required>
                                <option value="<?php echo $key->hsn_no; ?>"><?php echo $key->item_name; ?></option>

                            </select>

                        </div>
                                
                        <label for="del_qty" class="col-sm-2 col-form-label">Delivered Qty :</label>
                        <div class="col-sm-4">

                            <input type="text" name="del_qty" value= "<?php echo @$data1->del_qty; ?>" class="form-control required" id="del_qty" readonly>
                                    
                        </div>

                    </div>

                    <div class="form-header">
                    
                        <h4>Sale Details</h4>
                    
                    </div> 

                    <div class="form-group row">

                        <label for="sale_dt" class="col-sm-2 col-form-label">Sale Date:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="date" name="sale_dt" value= "<?php echo $key->sale_dt; ?>" class="form-control required" id="sale_dt" required>
                                    
                        </div>

                        <label for="bill_no" class="col-sm-2 col-form-label">Bill No:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="text" name="bill_no" value= "<?php echo $key->bill_no; ?>" class="form-control required" id="bill_no" required>
                                    
                        </div>

                    </div>

                    
                    <div class="form-group row">

                        <label for="cgst" class="col-sm-2 col-form-label">CGST:</label>
                        <div class="col-sm-4">

                            <input type="text" name="cgst" value= "<?php echo $key->cgst; ?>" class="form-control required" id="cgst" value= "0.00" required>
                                    
                        </div>

                        <label for="sgst" class="col-sm-2 col-form-label">SGST:</label>
                        <div class="col-sm-4">

                            <input type="text" name="sgst" value= "<?php echo $key->sgst; ?>" class="form-control required" id="sgst" value= "0.00" required>
                                    
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="tax_val" class="col-sm-2 col-form-label">Taxable Amount:</label>
                        <div class="col-sm-4">

                            <input type="text" name="tax_val" value= "<?php echo $key->tax_val; ?>" class="form-control required" id="tax_val" value= "0.00" required>
                                    
                        </div>

                        <label for="tot_amnt" class="col-sm-2 col-form-label">Total(Rs.):<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="text" name="tot_amnt" value= "<?php echo $key->tot_amnt; ?>" class="form-control required" id="tot_amnt" value= "0.00" required>
                                    
                        </div>

                    </div>

            <?php } ?>

            <div class="form-group row">

                <div class="col-sm-10">

                    <a href= "<?php echo site_url('sw/sale'); ?>"><button class="btn btn-info" onclick="" >Back</button></a>

                </div>

            </div>

      
    </div>

</div>



<!-- for addrow in table -->
<!--
<script>

    $(document).ready(function(){

        $("#addrow").click(function()
        {

            var newElement= '<tr><td><select name="hsn_no[]" id="hsn_no" class="form-control autoUnit_cls"><option value="0">Select Item</option><?php foreach($item as $key1){?><option value="<?php echo ($key1->hsn_no); ?>"><?php echo ($key1->item_name);?><?php } ?></select></td><td> <input type="text" name="unit[]" class="form-control unit_cls" id="unit" readonly/></td><td><input type="text" name="allot_qty[]" class="form-control" id="allot_qty" /></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';

            $("#intro").append($(newElement));
                                                                
        });

        // to change the value of total field as per fees field selected by adding rows
        
        $("#intro").on("click","#removeRow", function(){
            $(this).parent().parent().remove();
            $('.amount_cls').change();
        });
    
    });

</script>
-->

<!-- To get Project name as per district selection  -->
<script>

    $(document).ready(function()
    {
        $('#dist_cd').on( "change", function()
        {
            $.get('<?php echo site_url("sw/js_get_order_projectName");?>',{ dist_cd: $(this).val() })
            
            .done(function(data)
            {
                var string = '<option value="0">Select Project</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="'+value.sl_no +'">'+value.cdpo+'</option>'

                });
                
                $('#project_no').html(string);
            
            });

        });
    });

</script>


<!-- To get Order as per Project selection  -->
<script>

    $(document).ready(function()
    {
        $('#project_no').on( "change", function()
        {
            $.get('<?php echo site_url("sw/js_get_delivery_orderNo");?>',{ project_no: $(this).val(),
                                                                            dist_cd: $('#dist_cd').val() })
            
            .done(function(data)
            {
                var string = '<option value="0">Select Order</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="'+value.order_no+'">'+value.order_no+' DT '+value.order_dt+'</option>'

                });
                
                $('#order_no').html(string);
            
            });

        });
    });

</script>


<!-- To get Challan No as per Order selection  -->
<script>

    $(document).ready(function()
    {
        $('#order_no').on( "change", function()
        {
            $.get('<?php echo site_url("sw/js_get_sale_challanNo");?>',{ order_no: $(this).val(),
                                                                            project_no: $('#project_no').val(),
                                                                            dist_cd: $('#dist_cd').val() })
            
            .done(function(data)
            {
                var string = '<option value="0">Select Challan</option>';
                
                $.each(JSON.parse(data), function( index, value ) {
                    
                    string += '<option value="'+value.challan_no+'">'+value.challan_no+' DT '+value.trans_dt+'</option>'; 

                });
                
                $('#challan_no').html(string);
            
            });

        });
    });

</script>



<!-- To get Delivered Qty name as per Item selection  -->
<script>

    $(document).ready(function()
    {
        $('#hsn_no').on( "change", function()
        {
            //var order_no = $('#order_no').val();
            $.get('<?php echo site_url("sw/js_get_sale_delQty");?>',{ hsn_no: $(this).val(),
                                                                        challan_no: $('#challan_no').val(),
                                                                        project_no : $('#project_no').val(),
                                                                        order_no: $('#order_no').val(),
                                                                        dist_cd: $('#dist_cd').val() })
            //console.log($('$order_no').val())
            .done(function(data)
            {
                var delQty =JSON.parse(data)
                //console.log(delQty);

                $('#del_qty').val(delQty.del_qty);
                    
            });

        });
    });

</script>

