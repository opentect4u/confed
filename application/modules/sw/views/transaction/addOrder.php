<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/addNewOrder");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Add New Supply Order</h4>
            
            </div>

            <div class="form-group row">

                <label for="order_dt" class="col-sm-2 col-form-label">Date:<font color="red">*</font></label>
                <div class="col-sm-4">

                    <input type="date" name="order_dt" class="form-control required" id="order_dt" required>
                            
                </div>

                <label for="order_no" class="col-sm-2 col-form-label">Order No:<font color="red">*</font></label>
                <div class="col-sm-4">

                    <input type="text" name="order_no" class="form-control required" id="order_no" required>
                    <span id= "alert1"><font color= "red">* Order No. exists</font></span>        
                </div>

            </div>

            
            <div class="form-group row">

                <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>
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

                <label for="project_no" class="col-sm-2 col-form-label">Project:<font color="red">*</font></label>
                <div class="col-sm-4">

                    <select name="project_no" id="project_no" class= "form-control required" required>
                        <option value="0">Select Project</option>

                    </select>
                      
                </div>

            </div>

            <div class="row" style ="margin: 5px;">

                <div class="form-group">

                    <table class="table table-striped table-bordered table-hover">
                            
                        <thead>
                            
                            <tr>
                                <th>Item</th>
                                <th>Unit</th>
                                <th>Quantity</th>

                                <th> <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button> </th>
                            </tr>

                        </thead>
                            
                        <tbody id= "intro">

                            <tr>

                                <td>
                                
                                    <select name="hsn_no[]" id="hsn_no" class="form-control autoUnit_cls">
                                        <option value="0">Select Item</option>
                                        <?php
                                            foreach($item as $key1)
                                            { ?>
                                                <option value="<?php echo $key1->hsn_no; ?>"><?php echo $key1->item_name; ?></option>
                                            <?php
                                            } ?>
                                            
                                    </select>

                                </td>
                                
                                <td>
                                    
                                    <input type="text" name="unit[]" class="form-control unit_cls" id="unit" readonly/>
                                        
                                </td>

                                <td>

                                    <input type="text" name="allot_qty[]" class="form-control" id="allot_qty" />

                                </td>

                            </tr>

                        </tbody>   

                    </table>

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



<!-- To get unit after selecting product  -->
<script>

    $(document).ready(function()
    {
        $('#intro').on( "change", ".autoUnit_cls", function()
        {
            //console.log($(this).val());
            $.get('<?php echo site_url("sw/js_get_productUnit");?>',{ hsn_no: $(this).val() })
                                                                            
            .done(function(data)
            {
                //console.log(data);
                var unitData = JSON.parse(data);
                $('.unit_cls').eq($('.autoUnit_cls').index(this)).val(unitData.unit); 
            
            });

        });

    });

</script>


<!-- for addrow in table -->
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



<!-- To get Project name as per district selection  -->
<script>

    $(document).ready(function()
    {
        $('#dist_cd').on( "change", function()
        {
            $.get('<?php echo site_url("sw/js_get_project_perDistCd");?>',{ dist_cd: $(this).val() })
            
            .done(function(data)
            {
                //console.log(data);
                var string = '<option value="0">Select Project</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="'+value.sl_no +'">'+value.cdpo+'</option>'

                });
                
                $('#project_no').html(string);
            
            });

        });
    });

</script>


<!-- Checking Whather the order no. exists or not -->
<script>

    $(document).ready(function(){
        $('#alert1').hide();
        $('#order_no').on("change", function(){

            var order_no =  $(this).val();
            $.get('<?php echo site_url("sw/js_get_orderNo_forNewOrderEntry") ?>', {order_no : order_no})
            .done(function(data){
                
                var num_row = JSON.parse(data).num_row;
                //console.log(num_row);

                if(num_row != 0)
                {
                    //$('#order_no').css('border-color', 'red');
                    $('#order_no').focus();
                    $('#alert1').show();
                }
                else
                {
                    $('#alert1').hide();
                }

            })

        })

    })

</script>



<!-- To get district and project details from previous latest record if the order no exists -->
<!-- <script>

    $(document).ready(function(){

        $('#order_no').on("change", function(){

            var order_no = $(this).val();
            $.get('<?php echo site_url("sw/js_get_order_details_forexistOrder_entry") ?>', {order_no : order_no})
            .done(function(data){

                var dist_string = '';
                var project_string = '';

                $.each(JSON.parse(data), function(index,value){

                    dist_string += '<option value= "'+value.dist_cd+'">'+value.district_name+'</option>';
                    project_string += '<option value= "'+value.project_no+'">'+value.cdpo+'</option>';

                })

                $('#dist_cd').html(dist_string);
                $('#project_no').html(project_string);

            })

        })

    })

</script> -->