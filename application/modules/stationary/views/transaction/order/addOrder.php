<div class="wraper">   

    <div class= "row">

        <div class="col-md-8 container form-wraper" style="margin-left: 200px;">

            <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/addNewOrder");?>" onsubmit="return validate()" >
                

                <div class="form-header">
                
                    <h4>Add New Order</h4>
                
                </div>

                <div class="form-group row">

                    <label for="order_no" class="col-sm-2 col-form-label">Confed Order No:<font color="red">*</font></label>
                    
                    <div class="col-sm-4">

                        <input type="text" name="c_order_no" class="form-control required" id="c_order_no" required>
                        <span id= "alert1"><font color= "red">* Order No already Exists</font></span>
                                
                    </div>
                    
                    <label for="order_dt" class="col-sm-2 col-form-label">Confed Order Date<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="date" name="c_order_dt" class="form-control required" id="c_order_dt" required>
                        <span id= "date_alert"><font color= "red">* Select Date</font></span>  
                    </div>

                </div>

                <div class="form-group row">

                    <label for="supplier_cd" class="col-sm-2 col-form-label">Supplier<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select name="supplier_cd" id="supplier_cd" class="form-control required sch_cd" required>
                            <option value="0">Select Supplier</option>
                            <?php foreach($supplier as $supName){ ?>
                                <option value="<?php echo $supName->sl_no; ?>"><?php echo $supName->name; ?></option>
                            <?php } ?>
                        </select>

                    </div>

                </div>

                <div class="row" style ="margin: 5px;">

                    <div class="form-group">

                        <table class= "table table-striped table-bordered table-hover">

                            <thead>

                                <th style= "text-align: center">Govt. Order</th>
                                <th style= "text-align: center">Order Date</th>
                                <th style= "text-align: center">Project</th>
                                
                                <th>
                                    <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                </th>

                            </thead>
                            <hr>
                            <tbody id= "intro">
                            <tr>
                            
                                <td>
                                    <input type="text" name="g_order_no[]" class="form-control required" id="g_order_no" required>                            
                                </td>

                                <td>
                                    <input type="date" name="g_order_dt[]" class="form-control required" id="g_order_dt" required>
                                </td>

                                <td>
                                    <select name="project_cd[]" id="project_cd" class= "form-control required sch_cd" required>
                                        <option value="">Select Project</option>
                                        <?php
                                            foreach($projects as $key1)
                                            { ?>
                                                <option value="<?php echo $key1->project_cd; ?>"><?php echo $key1->name; ?></option>
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

                    <label for="remarks" class="col-sm-2 col-form-label">Remarks<font color="red"></font></label>
                    
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



<!-- For Confed Order No Validation -->
<script>

    $(document).ready(function(){

        $("#alert1").hide(); 

        $('#c_order_no').on("change", function(){

            var c_order_no = $(this).val();
            //console.log(c_order_no);
            $.get('<?php echo site_url("stationary/js_get_C_OrderNo_validation") ?>', {c_order_no : c_order_no})
            .done(function(data){
                console.log(parseInt(JSON.parse(data).num_row));
                var row = parseInt(JSON.parse(data).num_row);

                if(row == 0)
                {
                    //$("#c_order_no").css('border-color', 'red');
                    //$("#c_order_no").focus();

                    $("#alert1").hide();
                    return true;

                }
                else
                {
                    $("#c_order_no").css('border-color', 'red');
                    $("#c_order_no").focus();
                    $("#alert1").show();

                    return false;
                }

            })

        })

    })

</script>


<!-- For adding select2() function to first row -->
<script>

    $(".sch_cd").select2();

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
                                +'<td><input type="text" name="g_order_no[]" class="form-control required" id="g_order_no" required>'
                                +'</td>'
                                +'<td>'
                                    +'<input type="date" name="g_order_dt[]" class="form-control required" id="g_order_dt" required>'
                                +'</td>'
                                +'<td>'
                                    +'<select name="project_cd[]" id="project_cd" class= "form-control required sch_cd" required>'
                                        +'<option value="">Select Project</option>'
                                        +string
                                    +'<select>'
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


<!-- To get Supplier As per Project selected -->
<script>

    // $(document).ready(function()
    // {
    //     $('#project_cd').on( "change", function()
    //     {
            
    //         $.get('<?php //echo site_url("stationary/js_get_suppliersForProject");?>',{ project_cd: $(this).val() })
                                                                            
    //         .done(function(data)
    //         {
    //             //console.log(data);
    //             //var supplierData = JSON.parse(data);

    //             var string = '<option value="0">Select Supplier</option>';

    //             $.each(JSON.parse(data), function( index, value ) {

    //                 string += '<option value="'+value.supplier_cd +'">'+value.name+'</option>'

    //             });
                
    //             $('#supplier_cd').html(string);
    //         });

    //     });

    // });

    $(document).ready(function(){

        $("#date_alert").hide();

        $("#supplier_cd").change(function(){
            var supplier = $("#supplier_cd").val();
            //var order_dt = $("#c_order_dt").val();
            var order_dt = (new Date()).toISOString().split('T')[0];

            console.log(order_dt);

            if(order_dt != '')
            {
            
                $.get('<?php echo site_url("stationary/js_get_supplier_status");?>',{supplier_cd:supplier, order_dt:order_dt})
                .done(function(data){

                    console.log(data);

                    if (data!=1){
                            alert("Supplier status is off");
                            $("#supplier_cd").val(0);
                            $("#supplier_cd").css("border","2px solid #ff0000");
                    }else{
                            $("#supplier_cd").css("border","1px solid #ccc");
                    }

                });
            }
            else
            {
                alert("Select date first");
                $("#supplier_cd").val(0);
                $("#date_alert").show().fadeOut(2000);
                
            }

        });

    });

</script> 



<!--  For making supplier field required -->
<script>

    $(document).ready(function(){

        $('#g_order_no').on('click', function(){

            var supplierCd = $('#supplier_cd').val();
            if(supplierCd == '0')
            {
                alert('Please Select Supplier First...');
            }

        })

    })

</script>