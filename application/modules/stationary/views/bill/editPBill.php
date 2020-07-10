
<div class="wraper">      

    <div class= "row">

        <div class="col-md-10 container form-wraper" style= "margin-left: 8%;">

            <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/updatePBill");?>" onsubmit="return validate()" >
                

                <div class="form-header">
                
                    <h4>Edit Purchase Bill</h4>
                
                </div>

                <?php
                foreach($data1 as $key1){
                    ?>

                    <div class="form-group row">

                        <label for="bill_dt" class="col-sm-2 col-form-label">Date<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="date" name="bill_dt" value= "<?php echo $key1->bill_dt; ?>" class="form-control required" id="bill_dt" readonly>
                                
                        </div>

                        <label for="bill_no" class="col-sm-2 col-form-label">Bill No:<font color="red">*</font></label>
                        
                        <div class="col-sm-4">

                            <input type="text" name="bill_no" value= "<?php echo $key1->bill_no; ?>" class="form-control required" id="bill_no" readonly>
                                    
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="order_no" class="col-sm-2 col-form-label">Order No<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="text" name="order_no" value= "<?php echo $key1->order_no; ?>" class="form-control required" id="order_no" required>
                            
                        </div>

                        <label for="supplier_cd" class="col-sm-2 col-form-label">Supplier</label>

                        <div class="col-sm-4">

                            <input type="text" name="supplier_cd" value= "<?php echo @$supplier->name; ?>" class="form-control required" id="supplier_cd" readonly>                    

                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="nt" class="col-sm-2 col-form-label">NT(Rs.)</label>
                        
                        <div class="col-sm-4">

                            <input type="text" name="nt" value= "<?php echo $key1->nt; ?>" class="form-control required" id="nt" >

                        </div>

                        <label for="non_tax" class="col-sm-2 col-form-label">Non Taxable(Rs.)</label>
                        
                        <div class="col-sm-4">

                            <input type="text" name="non_tax" value= "<?php echo $key1->non_tax; ?>" class="form-control required" id="non_tax" >

                        </div>

                    </div>

                    

                    <div class="row" style ="margin: 5px;">

                        <div class="form-group">

                            <table class= "table table-striped table-bordered table-hover">

                                <thead>

                                    <th style= "text-align: center">GST %</th>
                                    <th style= "text-align: center">Sub Amount</th>
                                    <th style= "text-align: center">CGST</th>
                                    <th style= "text-align: center">SGST</th>
                                    
                                    <th>
                                        <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                    </th>

                                </thead>

                                <tbody id= "intro">
                                    <?php 
                                        $i = 0; 
                                        foreach($data2 as $key2){ 
                                        $i++;   
                                    ?>
                                    <tr>
                                            
                                        <td>    
                                            <!-- <input type="hidden" name="gst_per[]" class="form-control required gst_per" value= "<?php echo $key2->sl_no; ?>" id="gst_per" required>  -->
                                            <input type="text" name="gst_per[]" class="form-control required gst_per" value= "<?php echo $key2->gst_per; ?>" id="gst_per" required> 
                                        </td>

                                        <td>    
                                            <input type="text" name="sub_amnt[]" class="form-control required sub_amnt" value= "<?php echo $key2->sub_amnt; ?>" id="sub_amnt" required> 
                                        </td>

                                        <td>
                                            <input type="text" name="cgst_val[]" class="form-control required cgst_val" value= "<?php echo $key2->cgst_val; ?>" id="cgst_val" required> 
                                        </td>

                                        <td>
                                            <input type="text" name="sgst_val[]" class="form-control required sgst_val" value= "<?php echo $key2->sgst_val; ?>" id="sgst_val" required>
                                        </td>
                                        <?php if($i != 1){ ?>
                                        <td>
                                            <button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td>
                                            <strong>Total:</strong>
                                        </td>
                                        <td colspan="2">
                                            <input name="total" id="total" value= "<?php echo $key1->total; ?>" class="form-control total" placeholder="Total">  
                                        </td>
                                    </tr>
                                </tfoot>
                        
                            </table>

                        </div> 

                    </div>

                    <?php 
                    } ?>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" id= "submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>



<!-- For Add Row Table -->
<script>

    $(document).ready(function(){

        // For add row option
        $('#addrow').click(function(){

            var newElement = '<tr>'
                                +'<td>'
                                    +'<input type="text" name="gst_per[]" class="form-control required gst_per" value= "" id="gst_per" required>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="text" name="sub_amnt[]" class="form-control required sub_amnt" value= "" id="sub_amnt" required>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="text" name="cgst_val[]" class="form-control required cgst_val" value= "" id="cgst_val" required>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="text" name="sgst_val[]" class="form-control required sgst_val" value= "" id="sgst_val" required>'
                                +'</td>'
                                +'<td>'
                                    +'<button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>'
                                +'</td>'
                            '</tr>';

            $("#intro").append($(newElement));

        });

        // For remove row 
        $("#intro").on("click","#removeRow", function(){
            $(this).parents('tr').remove();
            $('.total').change();
        });


        // For getting cgst and sgst value after giving gst%
        $("#intro").on("change", ".sub_amnt", function(){

            //var total = $('#total').val();
            var row = $(this).closest('tr');
            var gst_per = row.find("td:eq(0) input[type='text']").val();  
            var sub_amnt = row.find("td:eq(1) input[type='text']").val();           
            
            var nt_val = $('#nt').val();
            
            var gst_num = parseFloat(sub_amnt)*gst_per;
            //var gst_den = 100+parseFloat(gst_per);
            var gst_den = 100;
            //console.log(gst_den);
            var gst_val = parseFloat(gst_num)/parseFloat(gst_den);
           
            // row.find("td:eq(1) input[type='text']").val((parseFloat(gst_val)/2).toFixed(2));             
            // row.find("td:eq(2) input[type='text']").val((parseFloat(gst_val)/2).toFixed(2)); 

            row.find("td:eq(2) input[type='text']").val((parseFloat(gst_val)).toFixed(2));             
            row.find("td:eq(3) input[type='text']").val((parseFloat(gst_val)).toFixed(2));            

        })

        // For getting sum of gst and to calculate total amount
        $("#intro").on("change", ".sub_amnt", function(){

            var total = $('#nt').val();
            var ntAmount = $('#nt').val();
            $('.cgst_val').each(function(){

                var curr_gst_val = $(this).val();
                total = parseFloat(total)+parseFloat(parseFloat(curr_gst_val)*2);
                //console.log(total);
                
            })
            $('#total').val(parseFloat(total).toFixed());
            

            // Checking whather total to sub_amnt exeeds NT Rs or not-- 
            //var total_subAmnt = $('#sub_amnt').val();
            var total_subAmnt = 0;
            $('.sub_amnt').each(function(){

                var tot_sub_amnt = $(this).val();
                total_subAmnt = parseFloat(total_subAmnt)+parseFloat(tot_sub_amnt);
                
                /*if(parseFloat(ntAmount)<parseFloat(total_subAmnt))
                {
                    $('#nt').css('border-color', 'red');
                    $('#submit').prop('disabled', true);
                    return false;
                }
                else
                {
                    $('#nt').css('border-color', 'green');
                    $('#submit').prop('disabled', false);
                    return true;
                }*/

                
            })
            
        })

        // For getting total calculation after remove row
        $('.total').change(function(){

            var total = $('#nt').val();
            var ntAmount = $('#nt').val();
            $('.cgst_val').each(function(){

                var curr_gst_val = $(this).val();
                total = parseFloat(total)+parseFloat(parseFloat(curr_gst_val)*2);
                //console.log(total);

            })
            $('#total').val(parseFloat(total).toFixed());

            // Checking whather total to sub_amnt exeeds NT Rs or not-- 
            //var total_subAmnt = $('#sub_amnt').val();
            var total_subAmnt = 0;
            $('.sub_amnt').each(function(){

                var tot_sub_amnt = $(this).val();
                total_subAmnt = parseFloat(total_subAmnt)+parseFloat(tot_sub_amnt);
                
                if(parseFloat(ntAmount)<parseFloat(total_subAmnt))
                {
                    $('#nt').css('border-color', 'red');
                    $('#submit').prop('disabled', true);
                    return false;
                }
                else
                {
                    $('#nt').css('border-color', 'green');
                    $('#submit').prop('disabled', false);
                    return true;
                }

                
            })

        });

    })

</script>