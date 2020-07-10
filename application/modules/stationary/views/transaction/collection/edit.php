
<div class="wraper">      

<div class="col-md-6 container form-wraper">

    <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/updateCollection");?>" onsubmit="return validate()" >
        
        <div class="form-header">
        
            <h4>Edit Bill Collection</h4>
        
        </div>

        <?php foreach($data as $key); ?>

            <div class="form-group row">

                <label for="trans_dt" class="col-sm-2 col-form-label">Date<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="date" name="trans_dt" value = "<?php echo $key->trans_dt; ?>" class="form-control required" id="trans_dt" required>
                        
                </div>
                <input type="hidden" name="sl_no" value = "<?php echo $key->sl_no; ?>" class="form-control required" id="sl_no">
                <input type="hidden" name="lnk_sl_no" value = "<?php echo $key->lnk_sl_no; ?>" class="form-control required" id="lnk_sl_no">
                <!-- <label for="project" class="col-sm-2 col-form-label">Project:<font color="red">*</font></label> -->
                
                <!-- <div class="col-sm-4">

                    <select name="project" id="project" class= "form-control required" required>
                        <option value="<?php echo $project->project; ?>"><?php echo $project->project; ?></option>
                        
                    </select>

                </div> -->
                <label for="supplier" class="col-sm-2 col-form-label">Supplier:<font color="red">*</font></label>
                <div class="col-sm-4">

                    <select name="supplier" id="supplier" class="form-control required" required>
                        <option value="<?php echo $supplier->supplier; ?>"><?php echo $supplier->supplier; ?></option>
                    </select>

                </div>
                </div>

            <div class="form-group row">

                 <!-- <label for="order_no" class="col-sm-2 col-form-label">Order No<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select name="order_no" id="order_no" class= "form-control required"  required >
                            <option value="<?php echo $key->order_no; ?>"><?php echo $key->order_no; ?></option>
                    </select>

                </div>  -->
<!-- 
                <label for="bill_no" class="col-sm-2 col-form-label">Bill<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select name="bill_no" id="bill_no" class= "form-control required"  required >
                            <option value="<?php echo $key->bill_no; ?>"><?php echo $key->bill_no; ?></option>
                    </select>

                </div>  -->

            </div>

            <!-- <div class="form-group row">

                <label for="amount" class="col-sm-2 col-form-label">Amount(Rs.)</label>
                
                <div class="col-sm-4">

                    <input type="text" name="amount" class="form-control required" id="amount" value= "<?php echo $saleAmount->tot_amount; ?>" readonly >

                </div>

            </div> -->
            <hr>

            <!-- <div class="form-group row">

                <label for="col_amount" class="col-sm-2 col-form-label">Amount(Rs.)<font color="red">*</font></label>
                
                <div class="col-sm-4">

                    <input type="text" name="amount" class="form-control required" id="amount" value= "<?php echo $key->amount; ?>" required >

                </div>

            </div> -->

            <div class="form-group row">
                
                <!-- <label for="mode" class="col-sm-2 col-form-label">Mode Of Transaction</label>
                
                <div class="col-sm-4">

                    <select name="mode" id="mode" class= "form-control required"  >
                            <option value="<?php echo $key->mode; ?>"><?php echo $key->mode; ?></option>
                            
                    </select>

                </div> -->

                <!-- <div id= "mrNo">
                    <label for="mr_no" class="col-sm-2 col-form-label">Ref No</label>
                    
                    <div class="col-sm-4">

                        <input type="text" name="mr_no" value= "<?php echo $key->mr_no; ?>" class="form-control required" id="ref_no" >
                        
                    </div>
                </div> -->

            </div>
<!-- 
            <div class="form-group row">
                
                <label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
                
                <div class="col-sm-6">

                    <textarea name="remarks" class="form-control required" id="remarks" cols="30" rows="2"><?php echo $key->remarks; ?></textarea>

                </div>

            </div> -->


            
            <div class="row" style ="margin: 5px;">

<div class="form-group">

<table class="table table-striped table-bordered table-hover">
        
    <thead>
        
    <th style= "text-align: center">MR No.</th>  
    <th style= "text-align: center">Project.</th>
    <th style= "text-align: center">Amount.</th>
     <th style= "text-align: center">Pay Type</th> 
    <th style= "text-align: center">Remarks</th>
    <th>
    </thead>
        
    <tbody id= "intro">
    <?php foreach($data as $key){ ?>
        <tr>
  
            <td>
                <input type="text" name="mr_no[]" class="form-control required" value= "<?php echo $key->mr_no; ?>" id="mr_no"/>
            </td>
            <td>
            <select name="project[]" id="project" class="form-control autoUnit_cls">
                                                
                  <option value="<?php echo $key->project; ?>"><?php echo $key->project; ?></option>
                                                    
              </select>

           </td>

            <td>
                <input type="text" name="amount[]" class="form-control required" value= "<?php echo $key->amount; ?>" id="remarks"/>
            </td>
            <td>
            <input type="text" name="mode[]" value= "<?php echo $key->mode; ?>" class="form-control required" id="unit" readonly/>
            </td>
            <td>
                <input type="text" name="remarks[]" class="form-control required" value= "<?php echo $key->remarks; ?>" id="remarks"/>
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

    </form>

</div>

</div>

