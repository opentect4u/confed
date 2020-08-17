
<div class="wraper">      

    <div class="row">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/addSaleEntry");?>" onsubmit="return validate()" >
            
            <div class="col-md-6 container form-wraper" style="margin-left: 0px;" >

                <div class="form-header">
                
                    <h4>Add New Sale</h4>
                
                </div>

                <div class="form-group row">

                    <label for="trans_dt" class="col-sm-2 col-form-label">Date:<font color="red">*</font></label>
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

                    <label for="project_no" class="col-sm-2 col-form-label">Project:</label>
                    <div class="col-sm-10">

                        <select name="project_no" id="project_no" class= "form-control required" required>
                            
                        </select>

                    </div>

                </div>
                
                <div class="form-group row">

                    <label for="challan_no" class="col-sm-2 col-form-label">Challan No :<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <select name="challan_no" id="challan_no" class= "form-control required" required>
                            <option value= "0">Select Challan</option>
                        </select>

                    </div>

                    <label for="hsn_no" class="col-sm-2 col-form-label">Item :</label>
                    <div class="col-sm-4">
                       
                        <select name="hsn_no" id="hsn_no" class= "form-control required" required>
                            
                        </select>

                    </div>

                </div>

                <div class="form-group row">
                            
                    <label for="del_qty" class="col-sm-2 col-form-label">Delivered Qty :</label>
                    <div class="col-sm-4">

                        <input type="text" name="del_qty" class="form-control required" id="del_qty" readonly>
                                
                    </div>

                </div>

                
                <div class="form-header">
                
                    <h4>Sale Details</h4>
                
                </div> 

                <div class="form-group row">

                    <label for="sale_dt" class="col-sm-2 col-form-label">Sale Date:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="date" name="sale_dt" class="form-control required" id="sale_dt" required>
                                
                    </div>

                    <label for="bill_no" class="col-sm-2 col-form-label">S/B No:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="text" name="bill_no" class="form-control required" id="bill_no" required>
                        <span id= "alert"><font color= "red">* Bill No exists</font></span>       
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

                    <label for="tot_amnt" class="col-sm-2 col-form-label">Sale Amount(Rs.):</label>
                    <div class="col-sm-4">

                        <input type="text" name="tot_amnt" class="form-control required" id="tot_amnt" value= "0.00" required>
                                
                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" id= "submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            </div>

            <div class="col-md-5 container form-wraper" style="margin-left: 10px; width: 48%;" >

                <div class="form-header">
                    
                    <h4>Delivery Details</h4>
                
                </div>
                
                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th>Challan</th>
                            <th>Item</th>
                            <th>Delivered Qty(Qnt)</th>

                        </tr>

                    </thead>

                    <tbody id= "info_table" >
                    
                    </tbody>

                </table>

            </div>

        </form>

    </div>

</div>



<!-- To get district, project and challan no. s as per order no given  -->
<script>

    $(document).ready(function(){
        $('#alert').hide();
        $('#order_no').on("change", function(){

            $.get('<?php echo site_url("sw/js_get_order_projectName");?>',{ order_no: $(this).val() })
            
            .done(function(data)
            {
                var string1 = '';
                var string2 = '';

                $.each(JSON.parse(data), function( index, value ) {

                    string1 += '<option value="'+value.dist_cd +'">'+value.district_name+'</option>';
                    string2 += '<option value="'+value.project_no +'">'+value.cdpo+'</option>';

                    var dist_cd = value.dist_cd;
                    var project_no = value.dist_cd;

                });
                
                $('#dist_cd').html(string1);
                $('#project_no').html(string2);

                //console.log(data);
            
            });

        })

        $('#order_no').on("change", function(){

            $.get('<?php echo site_url("sw/js_get_sale_challan_nos");?>',{ order_no: $(this).val()})
            .done(function(data){
                var string = '<option value= "">Select Challan</option>';
                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="'+value.challan_no +'">'+value.challan_no+'</option>';

                })
                    //console.log(JSON.parse(data));
                $('#challan_no').html(string);
    
            })
            
        })

    })

</script>


<!-- To get item and delivered qty as per challan selection -->
<script>

    $(document).ready(function(){

        $('#challan_no').on("change", function(){
            
            $.get('<?php echo site_url("sw/js_get_sale_itemPer_challan");?>',{challan_no: $(this).val(), order_no: $('#order_no').val()})
            .done(function(data){
                //console.log(data);
                var string1 = '';
                $.each(JSON.parse(data), function( index, value ) {

                    string1 += '<option value="'+value.hsn_no +'">'+value.item_name+'</option>';
                    var hsn_no = value.hsn_no;
                })

                $('#hsn_no').html(string1);

            })

        })


        $('#challan_no').on("change", function(){
        
            $.get('<?php echo site_url("sw/js_get_sale_delQty_perChallan");?>',{challan_no: $(this).val(), order_no: $('#order_no').val()})
            .done(function(data){

                var del_qty = JSON.parse(data).del_qty;
                $('#del_qty').val(del_qty);

            })

        })

        //FOr GST & total calculation 
        $('#challan_no').on("change", function(){

            $.get('<?php echo site_url("sw/js_get_sale_calculation_perChallan"); ?>', {challan_no: $(this).val(),order_no: $('#order_no').val()})
            .done(function(data){

                var details = JSON.parse(data).details;
                var delQty = JSON.parse(data).delQty;

                $.each(details, function( index, value ) {

                    var marginVal = value.margin;
                    var gstVal = value.gst;
                    var rateVal = value.rate;
                    
                    var total = parseFloat(delQty)*parseFloat(rateVal);

                    var totGSTVal_numerator = parseFloat(total)*parseFloat(gstVal);
                    var totGSTVal_denominator = (100 + parseFloat(gstVal)) ;
                    var totGSTVal = parseFloat(totGSTVal_numerator)/parseFloat(totGSTVal_denominator);
                    var GST = parseFloat(totGSTVal/2);

                    $('#cgst').val(GST.toFixed('2'));
                    $('#sgst').val(GST.toFixed('2'));
                    
                    if(gstVal != 0)
                    {
                        $('#tax_val').val((parseFloat(total) - parseFloat(totGSTVal)).toFixed('2'));
                        
                    }
                    else
                    {
                        $('#tax_val').val(0);
                        
                    }
                    
                    $('#tot_amnt').val(parseFloat(total).toFixed('2'));

                })

            })

        })

    })

</script>


<!-- CHecking duplicate entry of sale bill no -->
<script>

    $(document).ready(function(){

        $('#bill_no').on("change", function(){

            $.get('<?php echo site_url("sw/js_check_sale_duplicate_billEntry") ?>', {order_no: $('#order_no').val(), challan_no: $('#challan_no').val(), bill_no: $(this).val()})
            .done(function(data){

                var num_row = JSON.parse(data).num_row;
                if(num_row != 0)
                {
                    $('#bill_no').css('border-color', 'red');
                    $('#submit').prop('disabled', true);
                    $('#alert').show();
                    return false;
                }
                else
                {
                    $('#bill_no').css('border-color', 'green');
                    $('#submit').prop('disabled', false);
                    $('#alert').hide();
                    return true;
                }
                console.log(num_row);

            })

        })

    })

</script>


<!-- For info table -->
<script>

    $(document).ready(function(){

        $('#order_no').on("change", function(){

            var order_no = $(this).val();
            $.get('<?php echo site_url("sw/js_get_sale_deliveryInfoTableData_challan") ?>', {order_no : order_no})
            .done(function(data){

                //console.log(data);
                var tableData = JSON.parse(data);
                for(var key in tableData)
                {

                    var value = tableData[key];
                    var bodyEliment = '<tr> <td>'+value.challan_no+'</td> <td>'+value.item_name+'</td><td>'+value.del_qty+'</td></tr>';
                    $('#info_table').append($(bodyEliment));

                }

            })

        })

    })

</script>