<div class="wraper">      

    <div class= "row">

        <div class="col-md-12 container form-wraper" style= "margin-left: 0%;">

            <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/UpdatePaymentEntry");?>" onsubmit="return validate()" >
                

                <div class="form-header">
                
                    <h4>Edit New Payment</h4>
                
                </div>
                <?php foreach($data as $key){ ?>

                    <div class="form-group row">

                        <label for="date" class="col-sm-2 col-form-label">Date:<font color= "red">*</font></label>

                        <div class="col-sm-4">
                            <input type="date" name= "trans_dt" value= "<?php echo $key->trans_dt; ?>" id= "trans_dt" class= "form-control required" readonly>
                        </div>
                        <input type="hidden" name= "sl_no" value= "<?php echo $key->sl_no; ?>" id= "sl_no" class= "form-control required" required>
                        <!-- <input type="hidden" name= "payment_key" value= "<?php //echo $key->payment_key; ?>" id= "payment_key" class= "form-control required" required> -->
                    <input type="hidden" name="payment_key" value= "<?php echo $key->payment_key; ?>" id= "payment_key" class= "form-control required" readonly>
                        <label for="payment_key" class="col-sm-2 col-form-label">District:<font color= "red">*</font></label>

                        <div class="col-sm-4">
                         
                             <select name="dist_cd" id="dist_cd" class= "form-control required" required>
                        <option value="0">Select District</option>
                        <?php
                            foreach($dist as $data)
                            { 
                            ?>
                                <option value="<?php echo ($data->district_code); ?>"  <?php if($data->district_code == $key->dist){ echo "selected";} ?>><?php echo ($data->district_name); ?></option>
                        <?php
                            }
                            ?>
                        </select>
                        </div>

                    </div>

                    
                    <div class="row" style ="margin: 5px;">

                        <div class="form-group">

                            <table class= "table table-striped table-bordered table-hover">

                                <thead>

                                    <th style= "text-align: center">PB No</th>
                                    <th style= "text-align: center">PB Date</th>
                                    <th style= "text-align: center">PB Amount</th>
                                    <th style= "text-align: center">Item</th>
                                    <th style= "text-align: center">Project</th>
                                    <th style= "text-align: center">SB No</th>
                                    <th style= "text-align: center">SB Date</th>
                                    <th style= "text-align: center">SB Amount</th>
                                    <th style= "text-align: center">MR No</th>

                                </thead>
                                <hr>
                                <tbody id= "intro">
                                <tr>
                                
                                    <td>
                                        <input type="text" name="pb_no" value= "<?php echo $key->pb_no; ?>" class="form-control required pbNo" id="pb_no" required>
                                    </td>

                                    <td style= "width: 10">
                                        <input type="date" name="pb_dt" value= "<?php echo $key->pb_dt; ?>" class="form-control required pbDate" id="pb_dt" required>
                                    </td>

                                    <td>
                                        <input type="text" name="pb_amnt" value= "<?php echo $key->pb_amnt; ?>" class="form-control required pbAmnt" id="pb_amnt" required>
                                    </td>

                                    <td>
                                    <select name="hsn_no" id="hsn_no" class= "form-control" style="width:130px" required>
                                        <option value="">Select</option>
                                         <?php
                                            foreach($item as $key1)
                                            { ?>
                                            <option value="<?php echo $key1->hsn_no; ?>" <?php if($key1->hsn_no == $key->hsn_no){ echo "selected";} ?> ><?php echo $key1->item_name; ?></option>
                                            <?php
                                            } ?>
                                            
                                    </select>
                                    </td>

                                    <td>
                                         <select name="cdpo" id="cdpo" class= "form-control" style="width:130px" required>
                                        <option value="">Select</option>
                                         <?php
                                            foreach($projects as $keys)
                                            { ?>
                                            <option value="<?php echo $keys->sl_no; ?>" <?php if($keys->sl_no == $key->cdpo_no){ echo "selected";} ?> ><?php echo $keys->cdpo; ?></option>
                                            <?php
                                            } ?>
                                            
                                         </select>



<!-- 
                                        <input type="text" name="cdpo" value= "<?php //echo $key->cdpo; ?>" class="form-control required" id="cdpo" required> -->
                                    </td>

                                    <td>
                                        <input type="text" name="sb_no" value= "<?php echo $key->sb_no; ?>" class="form-control required sbNo" id="sb_no" required>
                                    </td>

                                    <td>
                                        <input type="date" name="sb_dt" value= "<?php echo $key->sb_dt; ?>" class="form-control required sbDate" id="sb_dt" required>
                                    </td>

                                    <td>
                                        <input type="text" name="sb_amnt" value= "<?php echo $key->sb_amnt; ?>" class="form-control required sbAmnt" id="sb_amnt" required>
                                    </td>

                                    <td>
                                        <input type="text" name="mr_no" value= "<?php echo $key->mr_no; ?>" class="form-control required" id="mr_no" required>
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

                            <textarea name="remarks" id="remarks" class="form-control required" cols="200" rows="2"><?php echo $key->remarks; ?></textarea>

                        </div>

                    </div>
                
                <?php } ?>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            </form>


        </div>

    </div>

</div>

