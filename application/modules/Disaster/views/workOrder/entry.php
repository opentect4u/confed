<div class="wraper">      

    <div class="col-md-7 container form-wraper">

        <form method="POST" id="form" action="<?php echo site_url("Disaster/entryNewOrder");?>" >
        
            <div class="form-header">
            
                <h4>Add New Order</h4>
            
            </div>

            <div class="form-group row">

                <label for="order_no" class="col-sm-2 col-form-label">W.O No:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="text" name="order_no" class="form-control required" id="order_no" />
        
                </div>

                <label for="order_dt" class="col-sm-2 col-form-label">Order Date:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="date" name="order_dt" class="form-control required" id="order_dt" />
        
                </div>

                <input type="hidden" name="sl_no" class="form-control required" value= "<?php echo ($max_slNo->sl_no) + 1; ?>" />
            
            </div>

            <!-- <div class="form-group row">

                <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select type="text" name="dist_cd" class="form-control required" id="dist_cd" >
                        <option value= "">Select District</option>
                        <?php
                            foreach($data as $key)
                            { 
                            ?>
                                <option value="<?php echo ($key->district_code); ?>"><?php echo ($key->district_name); ?></option>
                        <?php
                            }
                            ?>

                    </select>

                </div>

            
            </div> -->

            <!-- <div class="form-group row">

                <label for="allot_qty" class="col-sm-2 col-form-label">Quantity(MT):<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="text" name="allot_qty" class="form-control required" id="allot_qty" />
        
                </div>

                <label for="allot_qty_qnt" id= "qnt_label" class="col-sm-2 col-form-label">Quantity(Qnt):</label>

                <div class="col-sm-4">

                    <input type="text" name="allot_qty_qnt" class="form-control required" id="allot_qty_qnt" readonly/>
        
                </div>
            
            </div>  -->


            <div class="row" style ="margin: 5px;">

                <div class="form-group">

                    <table class="table table-striped table-bordered table-hover">
                            
                        <thead>
                            
                            <tr>
                                <th>District</th>
                                <th>Item</th>
                                <th>Unit</th>
                                <th>Quantity</th>

                                <th> <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button> </th>
                            </tr>

                        </thead>
                            
                        <tbody id= "intro">

                            <tr>

                                <td>

                                    <select type="text" name="dist_cd[]" class="form-control required" id="dist_cd" >
                                        <option value= "">Select District</option>
                                        <?php
                                            foreach($data as $key)
                                            { 
                                            ?>
                                                <option value="<?php echo ($key->district_code); ?>"><?php echo ($key->district_name); ?></option>
                                        <?php
                                            }
                                            ?>

                                    </select>

                                </td>

                                <td>
                                
                                    <select name="item[]" id="item" class="form-control autoUnit_cls">
                                        <option value="0">Select Item</option>
                                        <?php
                                            foreach($itemData as $key)
                                            { ?>
                                                <option value="<?php echo ($key->item_no); ?>"><?php echo ($key->item_name); ?></option>
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



<!-- for addrow in table -->
<script>

    $(document).ready(function(){

        $("#addrow").click(function()
        {

            var newElement= '<tr> <td><select type="text" name="dist_cd[]" class="form-control" id="dist_cd" ><option value= "">Select District</option><?php foreach($data as $key){ ?><option value="<?php echo ($key->district_code); ?>"><?php echo ($key->district_name); ?></option><?php } ?></select></td><td><select name="item[]" id="item" class="form-control autoUnit_cls"><option value="0">Select Item</option><?php foreach($itemData as $key){?><option value="<?php echo ($key->item_no); ?>"><?php echo ($key->item_name);?><?php } ?></select></td><td> <input type="text" name="unit[]" class="form-control unit_cls" id="unit" readonly/></td><td><input type="text" name="allot_qty[]" class="form-control" id="allot_qty" /></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';

            $("#intro").append($(newElement));
                                                                
        });

        // to change the value of total field as per fees field selected by adding rows
        $("#intro").on("click","#removeRow", function(){
            $(this).parent().parent().remove();
            $('.amount_cls').change();
        });
    
    });

</script>


<!-- TO get Unit As per item selection  -->
<script>

    $(document).ready(function(){

        $('#intro').on("change", ".autoUnit_cls", function(){

            $.get('<?php echo site_url("Disaster/js_get_itemUnit");?>',{ item: $(this).val() })
            .done(function(data){
                
                var value = JSON.parse(data);
                
                //$('#unit').val(value.unit);
                $('.unit_cls').eq($('.autoUnit_cls').index(this)).val(value.unit);

            })

        });

    });

</script>


<!--  To convert MT into Qnt -->
<script>

    $(document).ready(function(){

        $('#allot_qty').change(function(){

            var qty_mt = $(this).val();
            var qty_qnt = parseFloat(qty_mt * 10 ).toFixed(5); 
            // console.log(qty_mt);
            // console.log(qty_qnt);
            $("#allot_qty_qnt").val(qty_qnt);

            var unit = $('#unit').val();
            //console.log(unit);
            if(unit == 'MT')
            {
                $("#allot_qty").val(parseFloat(qty_mt * 1).toFixed(6));
            }

        });

    });

</script>
