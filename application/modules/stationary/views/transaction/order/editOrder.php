<div class="wraper">  

    <div class= "row">

        <div class="col-md-8 container form-wraper" style="margin-left: 200px;">

            <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/updateOrder");?>" onsubmit="return validate()" >
                

                <div class="form-header">
                
                    <h4>Add New Order</h4>
                
                </div>

                <?php
                foreach($data1 as $key1){
                    ?>

                    <div class="form-group row">

                        <label for="order_dt" class="col-sm-2 col-form-label">Confed Order Date<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="date" name="c_order_dt" value= "<?php echo $key1->c_order_dt; ?>" class="form-control required" id="order_dt" readonly>
                                
                        </div>

                        <label for="order_no" class="col-sm-2 col-form-label">Confed Order No:<font color="red">*</font></label>
                        
                        <div class="col-sm-4">

                            <input type="text" name="c_order_no" value= "<?php echo $key1->c_order_no; ?>" class="form-control required" id="order_no" readonly>
                                    
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="supplier_cd" class="col-sm-2 col-form-label">Supplier<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <select name="supplier_cd" id="supplier_cd" class="form-control sch_cd" required>
                                <option value="">Select Supplier</option>
                                <?php foreach($supplier as $key3){ ?>
                                        <option value="<?php echo $key3->sl_no; ?>" <?php echo($key3->sl_no == $key1->supplier_cd)?'selected':'' ?> >
                                            <?php echo $key3->name; ?>
                                        </option>
                                <?php } ?>
                            </select>

                        </div>

                    </div>
                    <div class="row" style="margin: 5px;">

                        <div class="form-group">
                        
                            <table class="table table-striped table-bordered table-hover">

                                <thead>

                                    <th style= "text-align: center;">Govt. Order No</th>
                                    <th style= "text-align: center;">Order Date</th>
                                    <th style= "text-align: center">Project</th>
                                    
                                    <th>
                                        <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                    </th>

                                </thead>
                                <hr>
                                <?php $i = 0; ?>

                                <tbody id= "intro">
                                <?php 
                                foreach($data2 as $key2){
                                    //var_dump($data2); die;
                                    ?>
                                <tr>
                                    <td>
                                        <input type="text" name="g_order_no[]" value="<?php echo $key2->g_order_no; ?>" class="form-control required" id="g_order_no" required>
                                    </td>

                                    <td>
                                        <input type="date" name="g_order_dt[]" value="<?php echo $key2->g_order_dt; ?>" class="form-control required" id="g_order_dt" required>
                                    </td>

                                    <td>
                                        <select name="project_cd[]" id="project_cd" class= "form-control required sch_cd" required>
                                            <option value="">Select Project</option>
                                            <?php
                                                foreach($projects as $key4)
                                                { ?>
                                                    <option value="<?php echo $key4->project_cd; ?>" <?php echo($key4->project_cd == $key2->project_cd)?'selected':'' ?> >
                                                        <?php echo $key4->name; ?>
                                                    </option>
                                                <?php
                                                } ?>
                                        </select>
                                    </td>

                                    <?php if($i != 0){ ?>
                                        <td>
                                            <button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>
                                        </td>
                                    <?php }
                                    else{
                                        echo "<td></td>";
                                    } ?>

                                    <?php $i++; ?>
                                
                                </tr>
                                
                                <?php
                                    } ?>

                                </tbody>
                            
                            </table>
                                
                            <hr>
                            
                        </div>

                    </div>
                    
                    <div class="form-group row">

                        <label for="remarks" class="col-sm-2 col-form-label">Remarks<font color="red"></font></label>
                        
                        <div class="col-sm-10">

                            <textarea name="remarks" id="remarks" class="form-control required" cols="10" rows="2"><?php echo $key1->remarks; ?></textarea>

                        </div>

                    </div>

                <?php
                    } ?>


                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            </form>


        </div>

    </div>

</div>


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
                                        +'<td>'
                                            +'<input type="text" name="g_order_no[]" class="form-control required" id="g_order_no" required>'
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



<!-- To get unit after selecting product  -->
<script>

    $(document).ready(function()
    {
        $('#project_cd').on( "change", function()
        {
            
            $.get('<?php echo site_url("stationary/js_get_suppliersForProject");?>',{ project_cd: $(this).val() })
                                                                            
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

</script> 