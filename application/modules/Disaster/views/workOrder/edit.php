<div class="wraper">      

    <div class="col-md-7 container form-wraper">

        <form method="POST" id="form" action="<?php echo site_url("Disaster/updateWorkOrder");?>" >
        
            <div class="form-header">
            
                <h4>Add New Order</h4>
            
            </div>

            <?php
                foreach($data1 as $key1)
                { 
                ?>

                    <div class="form-group row">

                        <label for="order_no" class="col-sm-2 col-form-label">W.O No:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="text" name="order_no" value= "<?php echo $key1->order_no ?>" class="form-control required" id="order_no" readonly />
                
                        </div>

                        <label for="order_dt" class="col-sm-2 col-form-label">Order Date:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="date" name="order_dt" value= "<?php echo $key1->order_dt ?>" class="form-control required" id="order_dt" readonly/>
                
                        </div>

                        
                    </div>

                    <div class="form-group row">

                        <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <select type="text" name="dist_cd" class="form-control required" id="dist_cd" readonly>
                                
                                <option value="<?php echo ($key1->dist_cd); ?>"><?php echo ($key1->district_name); ?></option>
                               
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

                                    </tr>

                                </thead>

                                <tbody id= "intro">

                                <?php foreach($data2 as $key2)
                                { ?>

                                    <tr>

                                        <td>
                                        
                                            <select name="item[]" id="item" class="form-control autoUnit_cls">
                                                
                                                <option value="<?php echo $key2->item; ?>"><?php echo $key2->item_name; ?></option>
                                                    
                                            </select>

                                        </td>
                                        
                                        <td>
                                            
                                            <input type="text" name="unit[]" value= "<?php echo $key2->unit; ?>" class="form-control unit_cls" id="unit" readonly/>
                                                
                                        </td>

                                        <td>

                                            <input type="text" name="allot_qty[]" value= "<?php echo $key2->allot_qty; ?>" class="form-control" id="allot_qty" />

                                        </td>

                                    </tr>

                                <?php } ?>

                                </tbody>   

                            </table>

                        </div>

                    </div>


                    <div class="form-group row">

                        <div class="col-sm-10">

                            <input type="submit" class="btn btn-info" value="Save" />

                        </div>

                    </div>

            <?php } ?>

        </form>

    </div>

</div>


<script>

    $(document).ready(function(){

        $('#allot_qty').on("change", function(){

            var allot_qty = $(this).val();
            //console.log(allot_qty);
            var allot_qty_qnt = parseFloat(allot_qty * 10).toFixed(5);
            //console.log(allot_qty_qnt);

            $('#allot_qty_qnt').val(allot_qty_qnt);
        })

    })

</script>