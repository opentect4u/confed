
<div class="wraper">      

<div class="col-md-6 container form-wraper">

    <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/updateNewOrder");?>" onsubmit="return validate()" >
        
        <div class="form-header">
        
            <h4>Add New Supply Order</h4>
        
        </div>

        <?php  
            foreach($data1 as $key)
            { ?>

                <div class="form-group row">

                    <label for="order_dt" class="col-sm-2 col-form-label">Date:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="date" name="order_dt" value= "<?php echo $key->order_dt; ?>" class="form-control required" id="order_dt" readonly>
                                
                    </div>

                    <label for="order_no" class="col-sm-2 col-form-label">Order No:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="text" name="order_no" value= "<?php echo $key->order_no; ?>" class="form-control required" id="order_no" readonly>
                                
                    </div>

                </div>

                
                <div class="form-group row">

                    <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <select name="dist_cd" id="dist_cd" class= "form-control required" readonly>
                            <option value="<?php echo ($key->dist_cd); ?>"><?php echo $key->district_name; ?></option>
                        
                        </select>
                        
                    </div>

                    <label for="project_no" class="col-sm-2 col-form-label">Project:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <select name="project_no" id="project_no" class= "form-control required" readonly>
                            <option value="<?php echo $key->project_no ?>"><?php echo $key->cdpo; ?></option>

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

                                    <!-- <th> <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button> </th> -->
                                </tr>

                            </thead>
                                
                            <tbody id= "intro">

                                <?php
                                    foreach($data2 as $key2)
                                    { ?>
                                        <tr>
                                            <td>
                                            
                                                <select name="hsn_no[]" id="hsn_no" class="form-control autoUnit_cls">
                                                    <option value="<?php echo $key2->hsn_no; ?>"><?php echo $key2->item_name; ?></option>
                                                    
                                                </select>

                                            </td>
                                            
                                            <td>
                                                
                                                <input type="text" name="unit[]" value= "<?php echo $key2->unit; ?>" class="form-control unit_cls" id="unit" readonly/>
                                                    
                                            </td>

                                            <td>

                                                <input type="text" name="allot_qty[]" value= "<?php echo $key2->allot_qty; ?>" class="form-control" id="allot_qty"  />

                                            </td>

                                        </tr>

                                <?php
                                    } ?>

                            </tbody>   

                        </table>

                    </div>

                </div>

            <?php
            } ?>

        <!-- <div class="form-group row">

            <div class="col-sm-10">

                <a href= "<?php echo site_url('sw/supplyOrderEntry'); ?>"><button class="btn btn-info" onclick="" >Back</button></a>

            </div>

        </div> -->

         <div class="form-group row">

            <div class="col-sm-10">

                <input type="submit" class="btn btn-info" value="Save" />

            </div>

        </div>

    </form>


</div>

</div>
