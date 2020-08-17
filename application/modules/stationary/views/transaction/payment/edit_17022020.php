
<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/updateBillPayment");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Edit Bill Payment</h4>
            
            </div>

            <?php foreach($data as $key){ ?>

                <div class="form-group row">

                    <label for="trans_dt" class="col-sm-2 col-form-label">Date<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="date" name="trans_dt" value= "<?php echo $key->trans_dt; ?>" class="form-control required" id="trans_dt" required>
                        <input type="hidden" name="sl_no" value= "<?php echo $key->sl_no; ?>" class="form-control required" id="trans_dt" >
                            
                    </div>

                    <label for="project_cd" class="col-sm-2 col-form-label">Project:<font color="red">*</font></label>
                    
                    <div class="col-sm-4">

                        <select name="project_cd" id="project_cd" class= "form-control required" required>
                            <option value="<?php echo $project->name; ?>"><?php echo $project->name; ?></option>
                            
                        </select>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="order_no" class="col-sm-2 col-form-label">Order No<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select name="order_no" id="order_no" class= "form-control required"  required >
                                <option value="<?php echo $key->order_no; ?>"><?php echo $key->order_no; ?></option>
                        </select>

                    </div>

                    <label for="bill_no" class="col-sm-2 col-form-label">Bill<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select name="bill_no" id="bill_no" class= "form-control required"  required >
                                <option value="<?php echo $key->bill_no; ?>"><?php echo $key->bill_no; ?></option>
                        </select>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="supplier" class="col-sm-2 col-form-label">Supplier</label>
                    
                    <div class="col-sm-4">

                        <input type="text" name="supplier_cd" value= "<?php echo $supplier->name; ?>" class="form-control required" id="supplier_cd" readonly >

                    </div>
                    
                    <label for="amount" class="col-sm-2 col-form-label">Amount(Rs.)</label>
                    
                    <div class="col-sm-4">

                        <input type="text" name="amount"  class="form-control required" id="amount" value= "<?php echo $billAmount->tot_amount; ?>" readonly >

                    </div>

                </div>
                <hr>

                <div class="form-group row">

                    <label for="part" class="col-sm-2 col-form-label">Payment Part<font color="red">*</font></label>
                    
                    <div class="col-sm-4">

                        <select name="part" id="part" class= "form-control required" >
                            <option value="<?php echo $key->part; ?>"><?php echo $key->part; ?></option>
                            
                        </select>

                    </div>
                    
                    <label for="col_amount" class="col-sm-2 col-form-label">Collection Amount(Rs.)<font color="red">*</font></label>
                    
                    <div class="col-sm-4">

                        <input type="text" name="col_amount" value="<?php echo $key->amount; ?>" class="form-control required" id="col_amount" value= "<?php echo "0.00" ?>" required >

                    </div>

                </div>

                <div class="form-group row">
                    
                    <label for="mode" class="col-sm-2 col-form-label">Mode Of Transaction</label>
                    
                    <div class="col-sm-4">

                        <select name="mode" id="mode" class= "form-control required"  >
                                <option value="<?php echo $key->mode; ?>"><?php echo $key->mode; ?></option>
                                
                        </select>

                    </div>

                    <div id= "refNo">
                        <label for="ref_no" class="col-sm-2 col-form-label">Ref No</label>
                        
                        <div class="col-sm-4">

                            <input type="text" name="ref_no" value="<?php echo $key->ref_no; ?>" class="form-control required" id="ref_no" value= "" >
                            
                        </div>
                    </div>

                </div>

                <div class="form-group row">
                    
                    <label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
                    
                    <div class="col-sm-6">

                        <textarea name="remarks" class="form-control required" id="remarks" cols="30" rows="2"><?php echo $key->remarks; ?></textarea>

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


