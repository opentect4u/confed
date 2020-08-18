<div class="wraper">      

    <div class= "row">

        <div class="col-md-12 container form-wraper" style= "margin-left: 0%;">

            <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/addPaymentEntry");?>" onsubmit="return validate()" >
                

                <div class="form-header">
                
                    <h4>Add New Payment</h4>
                
                </div>

                <div class="form-group row">

                    <label for="date" class="col-sm-2 col-form-label">Date:<font color= "red">*</font></label>

                    <div class="col-sm-4">
                        <input type="date" name= "trans_dt" id= "trans_dt" class= "form-control required" required>
                    </div>

                    <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color= "red">*</font></label>

                    <div class="col-sm-4">
                        
                        <select name="dist_cd" id="dist_cd" class= "form-control required" required>
                        <option value="0">Select District</option>
                        <?php
                            foreach($dist as $data)
                            { 
                            ?>
                                <option value="<?php echo ($data->district_code); ?>"><?php echo ($data->district_name); ?></option>
                        <?php
                            }
                            ?>
                        </select>
                       
                    </div>

                </div>

             <!--    <div class="form-group row">

                    <label for="entry_type" class="col-sm-2 col-form-label">Entry Type:</label>
                    <div class="col-sm-4">
                        
                        <select name="entry_type" id="entry_type" class= "form-control required" required>
                            <option value="1">Regular Entry</option>
                            <option value="2">Backlog Entry</option>
                        </select>

                    </div>

                </div> -->

                <div class="row" style ="margin: 5px;">

                    <div class="form-group">

                        <table class= "table table-striped table-bordered table-hover">

                            <thead>

                                <th style= "text-align: center">PB No</th>
                                <th style= "text-align: center">PB Date</th>
                                <th style= "text-align: center">PB Amount</th>
                                <th style= "text-align: center">Item</th>
                                <th style= "text-align: center">SB No</th>
                                <th style= "text-align: center">SB Date</th>
                                <th style= "text-align: center">SB Amount</th>
                                <th style= "text-align: center">MR No</th>
                                <th style="text-align: center">Project</th>
<!--                                 <th id= "th_cdpo_no" style= "text-align: center">cdpo_no</th>
                                <th id= "th_order_no" style= "text-align: center">order_no</th> -->
                                
                                <th>
                                    <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                </th>

                            </thead>
                            <hr>
                            <tbody id= "intro">
                            <tr>
                            
                                <td>
                                    <input type="text" name="pb_no[]" class="form-control required pbNo" id="pb_no" required>
                                </td>

                                <td>
                                    <input type="date" name="pb_dt[]" class="form-control pbDate" id="pb_dt" required >
                                </td>

                                <td>
                                    <input type="text" name="pb_amnt[]" class="form-control required pbAmnt" id="pb_amnt" required>
                                </td>

                                <td>
                                    <select name="hsn_no[]" id="hsn_no" class= "form-control" style="width:130px" required>
                                        <option value="">Select</option>
                                         <?php
                                            foreach($item as $key1)
                                            { ?>
                                                <option value="<?php echo $key1->hsn_no; ?>"><?php echo $key1->item_name; ?></option>
                                            <?php
                                            } ?>
                                            
                                    </select>
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

                                <td>
                                    <input type="text" name="mr_no[]" class="form-control required" id="mr_no" required>
                                </td>

                                <td>
                                    <select name="cdpo[]" id="cdpo" class= "form-control project" required style="min-width: 110px;">
                                        <option value="">Select</option>
                                         <?php
                                            foreach($projects as $key1)
                                            { ?>
                                                <option value="<?php echo $key1->sl_no; ?>"><?php echo $key1->cdpo; ?></option>
                                            <?php
                                            } ?>
                                    </select>
                                    
                                </td>
            
                            
                            </tr>

                            </tbody>
                        
                        </table>

                    </div> 

                    <hr>
                    
                </div>

                

                <div class="form-group row">

                    <label for="remarks" class="col-sm-2 col-form-label">Remarks<font color="red">*</font></label>
                    
                    <div class="col-sm-9">

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




<!-- for addrow in table -->
<script>

    $(document).ready(function(){

        $('#th_cdpo_no').hide();
        $('#th_order_no').hide();
        $('#td_order_no').hide();
        $('#td_cdpo_no').hide();
        
        var entryType = $('#entry_type').val();

        if(entryType == 1)
        {
            $('#th_cdpo').hide();
            $('#td_cdpo').hide();
            $('.td_cdpo').hide();
        }


        $("#addrow").click(function()
        {

            var entryType = $('#entry_type').val();

            // if(entryType == 1)
            // {
            //     $('#th_cdpo').hide();
            //     $('#td_cdpo').hide();
            //     $('.td_cdpo').hide();
            // }
            // else
            // {
            //     $('#th_cdpo').show();
            //     $('#td_cdpo').show();
            //     $('.td_cdpo').show();
            // }

            // $.get('<?php //echo site_url("sw/js_get_project_perDistCd") ?>', {dist_cd: $('#dist_cd').val()})
            // .done(function(data){

            //     var string = '<option value="">select</option>';
            //     $.each(JSON.parse(data), function( index, value ){

            //         string += '<option value="' + value.sl_no + '">' + value.cdpo +'</option>';
            //         //console.log(string);
            //     })

                // var newElement1= '<tr>'
                //                 +'<td>'
                //                     +'<input type="text" name="pb_no[]" class="form-control required pbno" id="pb_no" required>'
                //                 +'</td>'
                //                 +'<td>'
                //                     +'<input type="date" name="pb_dt[]" class="form-control required pbDate" id="pb_dt" required>'
                //                 +'</td>'
                //                 +'<td>'
                //                     +'<input type="text" name="pb_amnt[]" class="form-control required pbAmnt" id="pb_amnt" required>'
                //                 +'</td>'
                //                 +'<td>'
                //                     +'<input type="text" name="hsn_no[]" class="form-control required" id="hsn_no" required>'
                //                 +'</td>'
                //                 +'<td>'
                //                     +'<input type="text" name="sb_no[]" class="form-control required sbNo" id="sb_no" required>'
                //                 +'</td>'
                //                 +'<td>'
                //                     +'<input type="date" name="sb_dt[]" class="form-control required sbDate" id="sb_dt" required>'
                //                 +'</td>'
                //                 +'<td>'
                //                     +'<input type="text" name="sb_amnt[]" class="form-control required sbAmnt" id="sb_amnt" required>'
                //                 +'</td>'
                //                 +'<td>'
                //                     +'<input type="text" name="mr_no[]" class="form-control required" id="mr_no" required>'
                //                 +'</td>'
                //                 +'<td id= "td_cdpo" class= "td_cdpo">'
                //                     +'<select name="cdpo[]" id="cdpo" class= "form-control required project" required>'
                //                         +string
                //                     +'</select>'
                //                 +'</td>'
                //                 +'<td id= "td_cdpo_no" class= "td_cdpo_no">'
                //                     +'<input type="text" name="cdpo_no[]" class="form-control" id="cdpo_no" >'
                //                 +'</td>'
                //                 +'<td id= "td_order_no" class= "td_order_no">'
                //                     +'<input type="text" name="order_no[]" class="form-control" id="order_no" >'
                //                 +'</td>'
                //                 +'<td>'
                //                     +'<button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>'
                //                 +'</td>'
                //             +'</tr>';


                var newElement2= '<tr>'
                                +'<td>'
                                    +'<input type="text" name="pb_no[]" class="form-control pbNo" id="pb_no" required>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="date" name="pb_dt[]" class="form-control required pbDate" id="pb_dt" required>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="text" name="pb_amnt[]" class="form-control required pbAmnt" id="pb_amnt" required>'
                                +'</td>'
                                +'<td>'
                                    +'<select name="hsn_no[]" id="hsn_no" class= "form-control" style="width:130px" required><option value="">Select</option><?php foreach($item as $key1){?><option value="<?php echo ($key1->hsn_no); ?>"><?php echo ($key1->item_name);?><?php } ?></select>'
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
                                    +'<input type="text" name="mr_no[]" class="form-control required" id="mr_no" required>'
                                +'</td>'
                                +'<td id= "td_cdpo" class= "td_cdpo">'
                                    +'<select name="cdpo[]" id="cdpo" class= "form-control project" required><option value="">Select</option>'
                                    +'<?php foreach($projects as $key1){ ?><option value="<?php echo $key1->sl_no; ?>"><?php echo $key1->cdpo; ?></option><?php } ?></select>'
                                +'</td>'                             
                                +'<td>'
                                    +'<button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>'
                                +'</td>'
                            +'</tr>';

                // if(entryType == 1)
                // {
                //     $("#intro").append($(newElement1));
                // }
                // else if(entryType == 2)
                // {
                    $("#intro").append($(newElement2));
                // }

                // $('.td_cdpo_no').hide();
                // $('.td_order_no').hide();
                // $('.td_cdpo').hide();
                // if(entryType == 1)
                // {
                //     $('.td_cdpo').hide();
                // }
                // else
                // {
                //     $('.td_cdpo').show();
                // }

            })
            
                                                                
        });

        // to change the value of total field as per fees field selected by adding rows
        
        $("#intro").on("click","#removeRow", function(){
            $(this).parents('tr').remove();
            //$('.amount_cls').change();
        });

        // $('#entry_type').on("change", function(){

        //     var entry_type =  $('#entry_type').val();
        //     if(entry_type == 2)
        //     {
        //         $('#th_cdpo').show();
        //         $('#td_cdpo').show();
        //         $('.td_cdpo').show();
        //     }
        //     else
        //     {
        //         $('#th_cdpo').hide();
        //         $('#td_cdpo').hide();
        //         $('.td_cdpo').hide();
        //     }

        // })
    
  //  });

</script>

<!-- To get project no as per district selection -->
<script>

    $(document).ready(function(){

        // $('#dist_cd').on("change", function(){

        //     $.get('<?php //echo site_url("sw/js_get_project_perDistCd") ?>', {dist_cd: $('#dist_cd').val()})
        //     .done(function(data){

        //         var string1 = '<option value="">select</option>';
        //         $.each(JSON.parse(data), function( index, value ){

        //             string1 += '<option value="' + value.sl_no + '">' + value.cdpo +'</option>';
        //             //console.log(string);
        //         })

        //        // $("#cdpo").append($(string1));
        //          $("#cdpo").html(string1);

        //     })

        // })

    })

</script>


<!-- To get pb amount and sb amount as per pb_no and sb_no selection -->
<script>

    $(document).ready(function(){

        $("#intro").on("change", ".pbDate", function(){

            var row = $(this).closest('tr');
            var pb_no = row.find("td:eq(0) input[type='text']").val();
            var pb_dt = row.find("td:eq(1) input[type='date']").val();
            var payment_type = $('#entry_type').val();

            if(payment_type == 1)
            {

                $.get('<?php echo site_url("sw/js_get_Payment_purchaseAmount_forbillNo_date") ?>', {pb_no: pb_no, pb_dt: pb_dt})
                .done(function(data){

                    $.each(JSON.parse(data), function(index,value){

                        row.find("td:eq(2) input[type='text']").val(value.tot_amnt);
                        row.find("td:eq(3) input[type='text']").val(value.item_name);

                        row.find("td:eq(4) input[type='text']").val(value.sb_no);
                        row.find("td:eq(5) input[type='date']").val(value.sb_dt);
                        row.find("td:eq(6) input[type='text']").val(value.sb_amnt);

                        //row.find("td:eq(8) input[type='text']").val(value.cdpo);

                        row.find("td:eq(9) input[type='text']").val(value.cdpo_no);
                        row.find("td:eq(10) input[type='text']").val(value.order_no);
    
                    })
                    
                })

            }

        })

    })

            // To get Payment Bill Details

    $(document).ready(function(){

        $("#intro").on("change", ".pbNo", function(){

            var row = $(this).closest('tr');
            
             var pb_no = $(this).val();
             var dist_cd= $('#dist_cd').val();
                        row.find("td:eq(2) input[type='text']").val("");
                        row.find("td:eq(1) input[type='date']").val("");
                        row.find('td:eq(3) option[value=""]').prop('selected', true);
                        row.find('td:eq(8) option[value=""]').prop('selected', true);
            
            // var pb_dt = row.find("td:eq(1) input[type='date']").val();
            // var payment_type = $('#entry_type').val();

                $.get('<?php echo site_url("sw/js_get_pb_details") ?>', {pb_no: pb_no})
                .done(function(data){

                  var value = JSON.parse(data);

                        row.find("td:eq(2) input[type='text']").val(value.tot_amnt);
                        row.find("td:eq(1) input[type='date']").val(value.purchase_dt);
                        row.find('td:eq(3) option[value="'+value.hsn_no+'"]').prop('selected', true);
                        row.find('td:eq(8) option[value="'+value.cdpo_no+'"]').prop('selected', true);
                })

        })

         $("#intro").on("change", ".sbNo", function(){

            var row = $(this).closest('tr');
            
            var bill_no = $(this).val();
            var dist_cd = $('#dist_cd').val();

                row.find("td:eq(6) input[type='text']").val("");
                row.find("td:eq(5) input[type='date']").val("");
                

                $.get('<?php echo site_url("sw/js_get_sb_details") ?>', {bill_no: bill_no})
                .done(function(data){

                  var value = JSON.parse(data);

                        row.find("td:eq(5) input[type='date']").val(value.sale_dt);
                        row.find("td:eq(6) input[type='text']").val(value.tot_amnt);
                        
                })

        })

    })

</script>



<!-- To get Supplier As per Project selected -->
<!-- <script>

    $(document).ready(function()
    {
        $('#project_cd').on( "change", function()
        {
            
            $.get('<?php //echo site_url("stationary/js_get_suppliersForProject");?>',{ project_cd: $(this).val() })
                                                                            
            .done(function(data)
            {
                console.log(data);
                //var supplierData = JSON.parse(data);

                var string = '<option value="0">Select Supplier</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="'+value.supplier_cd +'">'+value.name+'</option>'

                });
                
                $('#supplier_cd').html(string);
            });

        });

    });

</script>  -->