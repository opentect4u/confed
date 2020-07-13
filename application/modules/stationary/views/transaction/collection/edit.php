
<div class="wraper">      

<div class="col-md-10 container form-wraper" style="margin-left: 120px;">

    <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/updateCollection");?>" onsubmit="return validate()" >
        
        <div class="form-header">
        
            <h4>Edit Bill Collection</h4>
        
        </div>

        <?php foreach($data as $key); ?>

            <div class="form-group row">

                <label for="trans_dt" class="col-sm-2 col-form-label">Date<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="date" name="trans_dt" value = "<?php echo $key->trans_dt; ?>" class="form-control required" id="trans_dt" required readonly>
                        
                </div>
                
                <input type="hidden" name="lnk_sl_no" value = "<?php echo $key->lnk_sl_no; ?>" class="form-control required" id="lnk_sl_no">
            </div>

            <div class="form-group row">    
                <label for="supplier" class="col-sm-2 col-form-label">Supplier:<font color="red">*</font></label>
                <div class="col-sm-4">   
                    <select name="supplier" id="supplier" class="form-control required" required>
                        <option value="">Select Supplier</option>
                        <?php foreach($supplierAll as $suppData){?>
                            <option value="<?php echo $suppData->sl_no;?>"<?php echo($suppData->sl_no==$key->supplier)?'selected':''?>>
                                    <?php echo $suppData->name; ?>
                            </option>
                        <?php } ?>
                    </select>

                </div>
            </div>
            <hr>
 
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
                <input type="hidden" name="sl_no[]" value = "<?php echo $key->sl_no; ?>" class="form-control required" id="sl_no">
            </td>
            <td>
                
            <select name="project[]" id="project" class="form-control autoUnit_cls">

                  <option value="1">Select Project</option>   
                  <?php foreach($projectsAll as $projectData){ ?>                           
                    <option value="<?php echo $projectData->project_cd; ?>"<?php echo($projectData->project_cd==$key->project)?'selected':''?>>
                        <?php echo $projectData->name; ?></option>
                  <?php } ?>                                          
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