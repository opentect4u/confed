
<div class="wraper">      

    <div class="row">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/addNewDelivery");?>" onsubmit="return validate()" >
            
            <div class="col-md-6 container form-wraper" style="margin-left: 0px;" > 

                <div class="form-header">
                
                    <h4>Delivery Details</h4>
                
                </div>

                <div class="form-group row">

                    <label for="trans_dt" class="col-sm-2 col-form-label">Delivery Date:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="date" name="trans_dt" class="form-control required" id="trans_dt" required>
                                
                    </div>

                    <label for="order_no" class="col-sm-2 col-form-label">Order No:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="text" name= "order_no" class= "form-control required" id= "order_no">
                        
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

                    <label for="project_no" class="col-sm-2 col-form-label">Project:<font color="red">*</font></label>
                    <div class="col-sm-10">

                        <select name="project_no" id="project_no" class= "form-control required" required>
                            
                        </select>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="hsn_no" class="col-sm-2 col-form-label">Item :<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <select name="hsn_no" id="hsn_no" class= "form-control required" required>
                            <option value="0">Select Item</option>
                            
                        </select>

                    </div>

                    <label for="allot_qty" class="col-sm-2 col-form-label">Alloted Qty :</label>
                    <div class="col-sm-4">

                        <input type="text" name="allot_qty" class="form-control required" id="allot_qty" readonly>
                                
                    </div>

                </div>

                <div class="form-group row" id= "checkField">

                    <label for="delivered" class="col-sm-2 col-form-label">Already Delivered: </label>
                    <div class="col-sm-4">

                        <input type="text" name="delivered" class="form-control required" id="delivered" readonly>
                                
                    </div>

                </div>

                <div class="form-group row">

                    <label for="challan_no" class="col-sm-2 col-form-label">Challan No :<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="text" name="challan_no" class="form-control required" id="challan_no" required>
                                
                    </div>

                    <label for="del_qty" class="col-sm-2 col-form-label">Delivery Qty :<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="text" name="del_qty" class="form-control required" id="del_qty" required>
                                
                    </div>

                </div>
                <span id= "alert1"><font color="red">*Delivery Qty can't be greater than Alloted Qty</font></span>
                
                <div class="form-header">
                
                    <h4>Purchase Details</h4>
                
                </div> 

                <div class="form-group row">

                    <label for="purchase_dt" class="col-sm-2 col-form-label">Purchase Date:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="date" name="purchase_dt" class="form-control required" id="purchase_dt" required>
                                
                    </div>

                </div>

                <div class="form-group row">

                    <label for="vendor_cd" class="col-sm-2 col-form-label">Supplier:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <select name="vendor_cd" id="vendor_cd" class= "form-control required" required>
                            <option value="0">Select Suppriler</option>

                            <?php
                                foreach($vendor as $data2)
                                { 
                                ?>
                                    <option value="<?php echo ($data2->sl_no); ?>"><?php echo ($data2->vendor_name); ?></option>
                            <?php
                                }
                                ?>

                        </select>

                    </div>

                    <label for="pb_no" class="col-sm-2 col-form-label">P/B No:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="text" name="pb_no" class="form-control required" id="pb_no" required>
                                
                    </div>

                </div>

                <div class="form-group row">

                    <label for="cgst" class="col-sm-2 col-form-label">CGST:</label>
                    <div class="col-sm-4">

                        <input type="text" name="cgst" class="form-control required" id="cgst" value= "0.00" required>
                                
                    </div>

                    <label for="sgst" class="col-sm-2 col-form-label">SGST:</label>
                    <div class="col-sm-4">

                        <input type="text" name="sgst" class="form-control required" id="sgst" value= "0.00" required>
                                
                    </div>

                </div>

                <div class="form-group row">

                    <label for="tax_val" class="col-sm-2 col-form-label">Taxable Value:</label>
                    <div class="col-sm-4">

                        <input type="text" name="tax_val" class="form-control required" id="tax_val" value= "0.00" required>
                                
                    </div>

                    <label for="tot_amnt" class="col-sm-2 col-form-label">Purchase Amount(Rs.):<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="text" name="tot_amnt" class="form-control required" id="tot_amnt" value= "0.00" required>
                                
                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" id= "submit" value="Save" />

                    </div>

                </div>

            </div>

            <div class="col-md-6 container form-wraper" style="margin-left: 10px; width: 48%;" > 

                <div class="form-header">
                    
                    <h4>Order Details</h4>
                
                </div>
                
                <table class="table table-bordered table-hover">

                    <thead>
                        <caption id= "infoCaption"></caption>
                        <tr>
                            <th>Project</th>
                            <th>Item</th>
                            <th>Alloted Qty (Qnt)</th>

                        </tr>

                    </thead>

                    <tbody id= "info_table" >
                    
                    </tbody>

                </table>

                <div class="form-header">
                    
                    <h4>Delivery Details</h4>
                
                </div>

                <table class="table table-bordered table-hover">
                
                      <thead>

                        <tr>
                            <th>Project</th>    
                            <th>Item</th>
                            <th>Delivered Qty(Qnt)</th>
                        </tr>

                    </thead>

                    <tbody id= "info_table2" >
                    
                    </tbody>
         

                </table>

            </div>

        </form>

    </div>

</div>



<!-- To get District and Project name as per Order No  -->
<script>

    $(document).ready(function()
    {   
        $('#alert1').hide();
        $('#checkField').hide();

        $('#order_no').on( "change", function()
        {
            $.get('<?php echo site_url("sw/js_get_order_projectName");?>',{ order_no: $(this).val() })
            
            .done(function(data)
            {
                var string1 = '';
                var string2 = '';

                $.each(JSON.parse(data), function( index, value ) {

                    string1 += '<option value="'+value.dist_cd +'">'+value.district_name+'</option>';
                    string2 += '<option value="'+value.project_no +'">'+value.cdpo+'</option>';

                });
                
                $('#dist_cd').html(string1);
                $('#project_no').html(string2);

                //console.log(data);
            
            });

        });
    });

</script>


<!-- To get Order as per Project selection  -->
<!-- <script>

    $(document).ready(function()
    {
        $('#project_no').on( "change", function()
        {
            $.get('<?php //echo site_url("sw/js_get_delivery_orderNo");?>',{ project_no: $(this).val(),
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

</script> -->


<!-- To get Order Details in infotable as per order no selection -->
<script>

    $(document).ready(function(){

        $('#order_no').on("change", function(){

            var order_no = $(this).val();

            $.get('<?php echo site_url("sw/js_get_delivery_orderDetailsData") ?>', {order_no : order_no })
            .done(function(data){

                //console.log(data);
                var tableData = JSON.parse(data);

                for(var key in tableData)
                {

                    var value = tableData[key];
                    var orderDt = value.order_dt.split("-");
                    var caption = 'Order Date: '+orderDt[2]+'-'+orderDt[1]+'-'+orderDt[0];
                    $('#infoCaption').html(caption);

                    var bodyEliment = '<tr> <td>'+value.cdpo+'</td> <td>'+value.item_name+'</td> <td>'+value.allot_qty+'</td> </tr>';
                    $('#info_table').append($(bodyEliment));

                }

            })

        })

//Delivery Details

        $('#order_no').on("change", function(){

            var order_no = $(this).val();

            $.get('<?php echo site_url("sw/js_get_delivery_previousDeliveryDetailsData"); ?>', { order_no : order_no })
            .done(function(data){

                //console.log(data);
                var tableData2 = JSON.parse(data);

                for(var key2 in tableData2)
                {

                    var value2 = tableData2[key2];
                    var bodyEliment2 = '<tr> <td>'+value2.cdpo+'</td> <td>'+value2.item_name+'</td> <td>'+value2.del_qty+'</td> </tr>';
                    $('#info_table2').append($(bodyEliment2));

                }

            })

        })

    })

</script> 


<!-- To get item names as per order & project selection -->
<script>

    $(document).ready(function(){

        $('#order_no').on("change", function(){

            var order_no = $(this).val();

            $.get('<?php echo site_url("sw/js_get_item_asPer_orderPorject") ?>', {order_no : order_no})
            .done(function(data){

                //console.log(data);
                var string = '<option value="0">Select Item</option>';

                $.each(JSON.parse(data), function(index,value){
                    string += '<option value= "'+value.hsn_no+'">'+value.item_name+'</option>';
                })

                $('#hsn_no').html(string);

            })

        })

    })

</script>


<!-- To get Alloted Qty name as per Item selection  -->
<script>

    $(document).ready(function()
    {
        $('#hsn_no').on( "change", function()
        {
            var order_no = $('#order_no').val();
            var cdpo_no = $('#project_no').val();

            $.get('<?php echo site_url("sw/js_get_delivery_allotQty");?>',{ hsn_no: $(this).val(), order_no: $('#order_no').val(), cdpo_no: cdpo_no })
                                                                                       
            //console.log($('$order_no').val())
            .done(function(data)
            {
                $.each(JSON.parse(data), function( index, value ) {
                
                    //var string = value.allot_qty+' '+value.unit;
                    $('#allot_qty').val(value.allot_qty); 
                    //$('#unit').val(value.unit);
                    //console.log(string);

                });

                //$('#allot_qty').val(string);                

            });

        });
    });

</script>


<!-- To get qty of a particular item already delivered -->
<script>

    $(document).ready(function(){

        $('#hsn_no').on("change", function(){

            var order_no = $('#order_no').val();
            var cdpo_no = $('#project_no').val();
            var hsn_no = $(this).val();

            $.get('<?php echo site_url("sw/js_get_deliveredQty_asPer_orderItem"); ?>', {order_no : order_no, cdpo_no: cdpo_no, hsn_no : hsn_no })
            .done(function(data){

                //console.log(data);
                var totVal = JSON.parse(data).totDelivered;
                if(totVal === null)
                {$('#delivered').val(0);}
                else
                {$('#delivered').val(totVal);}

            })

        })

    })

</script>



<!-- Checking whather del_qty is greater than undelivered qty or not  -->
<script>

    $(document).ready(function(){
        $('#alert1').hide();

        $('#del_qty').on("change", function(){

            var del_qty = $(this).val();

            
            
            var tot_del_qty = $('#delivered').val();

            var allot_qty = $('#allot_qty').val();

            var max_delQTY = parseFloat(allot_qty)- parseFloat(tot_del_qty);

           // alert(max_delQTY);


            if(parseFloat(del_qty).toFixed(3) > parseFloat(max_delQTY).toFixed(3))
            {
                $('#alert1').show();
                $('#del_qty').css('border-color', 'red');
                $('#submit').prop('disabled', true);
                return false;
            }
            else
            {
                $('#submit').prop('disabled', false);
                return true;
            }

        })

    })

</script>



<!-- To get Total amount GST calculation as per del_qty selected -->
<script>

    $(document).ready(function(){

        $('#del_qty').on("change", function(){

            var deliveryQty = $('#del_qty').val();
            var hsn_no = $('#hsn_no').val();
            var del_dt = $('#trans_dt').val();

            $.get('<?php echo site_url("sw/js_get_marginGST_forProduct_priceCalculation");?>', {hsn_no : hsn_no, del_dt : del_dt})
            .done(function(data){
                //console.log(data); 

                $.each(JSON.parse(data), function( index, value ) {

                    var marginVal = value.margin;
                    var gstVal = value.gst;
                    var rateVal = value.rate;
                    
                    if(gstVal != 0)
                    {
                        // Total calculation -- 
                        var priceVal = parseFloat(deliveryQty)*parseFloat(rateVal);
                        console.log(priceVal);
                        var totMarginVal = parseFloat(marginVal)*parseFloat(deliveryQty);
                        console.log(totMarginVal);
                        var total = parseFloat(priceVal - totMarginVal);
                        console.log(total);
                        $('#tot_amnt').val(total);
                        
                        //GST calculation --
                        var totGSTVal_numerator = parseFloat(priceVal)*parseFloat(gstVal) ;
                        var totGSTVal_denominator = (100 + parseFloat(gstVal)) ;
                        var totGSTVal = parseFloat(totGSTVal_numerator)/parseFloat(totGSTVal_denominator);
                        // var GST = parseFloat(totGSTVal/2);
                        //console.log(GST);
                        var GST=0.00;
                        $('#cgst').val(GST.toFixed(2));
                        $('#sgst').val(GST.toFixed(2));

                        // Taxable Amount calculation --
                        // var taxableVal = parseFloat(priceVal - totGSTVal);
                        $('#tax_val').val(taxableVal.toFixed(2));
                        //console.log(taxableVal);
                        var taxableVal=0.00;
                    }
                    else
                    {
                        // For total -- 
                        var priceVal = parseFloat(deliveryQty)*parseFloat(rateVal);
                        var totMarginVal = parseFloat(marginVal)*parseFloat(deliveryQty);
                        // var total = parseFloat(priceVal - totMarginVal);
                        //console.log(total);
                        var total =0.00;
                        $('#tot_amnt').val(total);

                    }
                    
                })
            
            })

        })

    })

</script>
