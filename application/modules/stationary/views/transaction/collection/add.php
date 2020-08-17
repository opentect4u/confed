
<div class="wraper">      

    <div class="col-md-10 container form-wraper" style="margin-left: 120px;">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/addNewCollection");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Add Cash Memo</h4>
            
            </div>

            <div class="form-group row">

                <label for="trans_dt" class="col-sm-2 col-form-label">Date<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="date" name="trans_dt" class="form-control required" id="trans_dt" required>
                        
                </div>
                
            </div>

            <div class="form-group row">

                <label for="supplier_cd" class="col-sm-2 col-form-label">Supplier<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select name="supplier" id="supplier" class="form-control required" required>
                        <option value="0">Select Supplier</option>
                        <?php foreach($supplier as $supName){ ?>
                            <option value="<?php echo $supName->sl_no; ?>"><?php echo $supName->name; ?></option>
                        <?php } ?>
                    </select>

                </div>

            </div>

      <div class="form-group">

<table class= "table table-striped table-bordered table-hover">

    <thead>

        <th style= "text-align: center">MR No.</th>  
        <th style= "text-align: center">Project</th>
        <th style= "text-align: center">Amount</th>
        <th style= "text-align: center">Pay Type</th>
        <th style= "text-align: center">Chq No.</th>
        <th style= "text-align: center">Remarks</th>
        <th>
            <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
        </th>

    </thead>
    <hr>
    <tbody id= "intro">
    <tr>
    
        <td>
            <input type="text" name="mr_no[]" id="mr_no" style="width:80px" class="form-control required" id="mr_no" required>                            
        </td>

        <!-- <td>
            <input type="date" name="g_order_dt[]" class="form-control required" id="g_order_dt" required>
        </td> -->

        <td>
            <select name="project[]" id="project" style="width:150px"class="form-control required" required>
                <option value="">Select Project</option>
                <?php
                    foreach($projects as $key1)
                    { ?>
                        <option value="<?php echo $key1->project_cd; ?>"><?php echo $key1->name; ?></option>
                    <?php
                    } ?>
            </select>
        </td>
        
        <td>
            <input type="number" name="amount[]"  style="width:80px" class="form-control required" id="amount" required>                            
        </td>
        <td>
                    <select name="mode[]" id="mode" style="width:70px" class="form-control required"  >
                            <option value="0">Select mode</option>
                            <option value="cash">Cash</option>
                            <option value="neft">NEFT</option>
                            <option value="cheque">Cheque</option>
                    </select>

     </td>
     <td>
            <input type="text" name="chq_no[]"  style="width:80px" class="form-control" id="chq_no" >                            
        </td>
     <td>
            <input type="text" name="remarks[]"  style="width:100px" class="form-control" id="remarks" >                            
        </td>
    </tr>

    </tbody>

</table>

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
        /*$('#refNo').hide();
        
        // <!-- To get Order No as per Project Selected  -->

        $('#project_cd').on( "change", function()
        {
            //console.log($(this).val());
            $.get('<?php //echo site_url("stationary/js_get_collection_orderForProject");?>',{ project_cd: $(this).val() })
                                                    
            .done(function(data)
            {
                //console.log(data);
                var string = '<option value="0">Select Order</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="'+value.order_no +'">'+value.order_no+'</option>'

                });
                
                $('#order_no').html(string);            

            });

        });*/

        // To show or hide the Ref No section -->  
        /*$('#mode').on( "change", function()
        {

            var mode = $(this).val();
            if(mode == "neft" || mode == "cheque")
            {
                $('#refNo').show();
            }
            else if(mode == "cash" || mode == "0" )
            {
                $('#refNo').hide();
            }

        });*/

    });

</script> 

<!-- for addrow in table -->
<script>

    $(document).ready(function(){

        $("#addrow").click(function()
        {
            //$(".sch_cd").select2();
            $.get('<?php echo site_url("stationary/js_get_projectData"); ?>')
            .done(function(data){

                var string = '';
                
                $.each(JSON.parse(data), function(index, value){

                    string += '<option value= "'+value.project_cd+'">'+`${value.name}`+'</option>';

                })
                
                var newElement= '<tr>'
                                +'<td><input type="text" name="mr_no[]" id="mr_no" style="width:80px" class="form-control required " id="mr_no" required>'
                                +'</td>'
                                +'<td>'
                                    +'<select name="project[]" id="project" style="width:150px" class= "form-control required " required>'
                                        +'<option value="">Select Project</option>'
                                        +string
                                    +'<select>'
                                +'</td>'
                                +'<td><input type="number" name="amount[]"  style="width:80px" class="form-control required " id="amount" required>'
                                +'</td>'
                                +'<td>'
                                    +'<select name="mode[]" style="width:70px" id="mode" class= "form-control required " required>'
                                    +'<option value="0">Select mode</option>'
                            +'<option value="cash">Cash</option>'
                            +'<option value="neft">NEFT</option>'
                            +'<option value="cheque">Cheque</option>'
                                    +'<select>'
                                +'</td>'
                                +'<td><input type="text" name="chq_no[]"  style="width:80px" class="form-control " id="chq_no" >'
                                +'</td>'
                                +'<td><input type="text" name="remarks[]"  style="width:100px" class="form-control " id="remarks">'
                                +'</td>'
                                +'<td>'
                                    +'<button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>'
                                +'</td>'
                            +'</tr>';
                            
                $("#intro").append($(newElement)); 
                // for adding select2() function to each row-- 
                $(".sch_cd").each(function(){
                    $(".sch_cd").select2();
                });
                
            })

             
                                    
        });

        // to change the value of total field as per fees field selected by adding rows
        $("#intro").on("click","#removeRow", function(){
            $(this).parents('tr').remove();
            //$('.amount_cls').change();
        });


        $('#addrow').on("click", function(){
            $(".sch_cd").each(function(){
                $(".sch_cd").select2();
            }); 
        });
    
    });

</script>

