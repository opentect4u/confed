<div class="wraper">      

<div class="col-md-9 container form-wraper">

    <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/updateBillPayment");?>" onsubmit="return validate()" >

        <div class="form-header">
            
            <h4>Bank & File Details</h4>
        
        </div>
        <?php foreach($bank as $key); ?>

            <div class="form-group row">
                <label for="file_name" class="col-sm-1 col-form-label">File Name<font color="red">*</font></label>

                    <div class="col-sm-3">

                        <input type="text" name="file_name" value = "<?php echo $key->file_name; ?>" class="form-control file_name" id="file_name" required>
                            
                    </div>
                <label for="page_no" class="col-sm-1 col-form-label">Page No<font color="red">*</font></label>
                <div class="col-sm-3">

                    <input type="text" name="page_no" value = "<?php echo $key->page_no; ?>" class="form-control page_no" id="page_no" required>
                        
                </div>

                <label for="bank" class="col-sm-1 col-form-label">Bank<font color="red">*</font></label>

                <div class="col-sm-2">

                    <input type="text" name="bank" value = "<?php echo $key->bank; ?>" class="form-control bank" id="bank" required>
                    <!-- <select name="bank" id="bank" class= "form-control bank"  required >
                            <option value="<?php echo $key->bank; ?>"><?php echo $key->bank; ?></option>
                    </select> -->
                        
                </div>
              
                </div>
           
            <div class="form-group row">
                
                <!-- <label for="mode" class="col-sm-2 col-form-label">Mode Of Transaction</label>
                
                <div class="col-sm-4">

                    <select name="mode" id="mode" class= "form-control required"  >
                            <option value="<?php echo $key->mode; ?>"><?php echo $key->mode; ?></option>
                            
                    </select>

                </div> -->
            </div>
            
<div class="row" style ="margin: 5px;">
<div class="form-header">
            
            <h4>Payment Details</h4>
        
        </div>

        <table class="table">

            <thead>

                <tr>
                    <!-- <th>Trans Cd.</th> -->
                    <th>Supply To.</th>
                    <th>Order Details.</th>
                </tr>

            </thead>
            <tbody id="intro1" class="tables" >
            <?php foreach($supplier as $key1){ ?>
           <tr>
           <td>
                <input type="text" name="project[]" class="form-control project" value= "<?php echo $key1->project; ?>" id="project"/>
            </td>
           
            <td>
                <input type="text" name="order_no[]" class="form-control order_no" value= "<?php echo $key1->order_no; ?>" id="order_no"/>
            </td>
           
           </tr>
           <?php } ?>
            </tbody> 
            </table>

            <div class="form-header">
            
            <h4>Bills Details</h4>
        
        </div>
        
        <table class="table">

            <thead>

                <tr>
                    
                    <th>S Bill No.</th>
                    <th>Date</th>
                    <th>Value</th>
                    <th>P Bill No.</th>
                    <th>Date</th>
                    <th>Value</th>
                </tr>

            </thead>

            <tbody id="intro2" class="tables">
               
                <?php foreach($s_p_bill as $key2){ ?>
           <tr>
           <td>
                <input type="text" name="s_bill_no[]" class="form-control s_bill_no" value= "<?php echo $key2->s_bill_no; ?>" id="s_bill_no"/>
            </td>
            <td>
                <input type="date" name="s_bill_dt[]" class="form-control s_bill_dt" value= "<?php echo $key2->s_bill_dt; ?>" id="s_bill_dt"/>
            </td>
            <td>
                <input type="text" name="s_bill_amt[]" class="form-control s_bill_amt" value= "<?php echo $key2->s_bill_amt; ?>" id="s_bill_amt"/>
            </td>
            <td>
                <input type="text" name="p_bill_no[]" class="form-control p_bill_no" value= "<?php echo $key2->p_bill_no; ?>" id="p_bill_no"/>
            </td>
            <td>
                <input type="date" name="p_bill_dt[]" class="form-control p_bill_dt" value= "<?php echo $key2->p_bill_dt; ?>" id="p_bill_dt"/>
            </td>
            <td>
                <input type="text" name="p_bill_amt[]" class="form-control p_bill_amt" value= "<?php echo $key2->p_bill_amt; ?>" id="p_bill_no"/>
            </td>
          
           <?php } ?>
            </tr>
            </tbody>

            </tbody> 
         
            <tfoot>
                <tr></tr>
                <tr>
                <tr>
                
                    <td colspan="2" style="text-align: right;">Less Amount:</td>
                    
                    <td><input type="text"  style="width:100px" value= "<?php echo $key->s_bill_less_amt; ?>" id=s_bill_less_amt class="form-control s_bill_less_amt" name="s_bill_less_amt"></td>
                   
                    <td></td>
                    <td></td>
                    <td><input type="text"  style="width:100px"   value= "<?php echo $key->p_bill_less_amt; ?>"  class="form-control p_bill_less_amt" name="p_bill_less_amt"></td>
                </tr>
                    <td>Total:</td>
                    <td colspan="1">
                    <td ><input type="text" style="width:100px;text-align: left;" value= "<?php echo $key->tot_s_bill; ?>"  class="form-control tot_s_bill" id="tot_s_bill" name="tot_s_bill" readonly>
                    </td>
                     </td>
                     <td colspan="2" >
                    <td><input type="text" style="width:100px;text-align: left;"  value= "<?php echo $key->tot_p_bill; ?>" class="form-control tot_p_bill" id="tot_p_bill" name="tot_p_bill" readonly></td>
                   
                    <td></td></td>
                </tr>

                <tr> 
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                </tr>

            </tfoot> 
        </table>

            <div class="form-header">
        
        <h4>Mr Details</h4>
    
    </div>

<div class="form-group">

<table class="table table-striped table-bordered table-hover">
        
    <thead>
    <th style= "text-align: center">MR No.</th>  
    <th style= "text-align: center">Mr Date.</th>
    <th style= "text-align: center">Chq Type.</th>
     <th style= "text-align: center">Chq Dt</th> 
    <th style= "text-align: center">Amount</th>
    <th>
    </thead>
        
    <tbody id= "intro">
    <?php foreach($mr as $key){ ?>
        <tr>
  
            <td>
                <input type="text" name="mr_no[]" class="form-control mr_no" value= "<?php echo $key->mr_no; ?>" id="mr_no"/>
            </td>
            <!-- <td>
          <select name="mr_dt[]" id="mr_dt" class="form-control mr_dt">
                                                
                  <option value="<?php echo $key->project; ?>"><?php echo $key->project; ?></option>
                                                    
              </select>

           </td>  -->
           <td>
                <input type="date" name="mr_dt[]" class="form-control mr_dt" value= "<?php echo $key->mr_dt; ?>" id="mr_dt"/>
            </td>

            <td>
            <input type="text" name="chq_type[]" value= "<?php echo $key->chq_type; ?>" class="form-control chq_type" id="chq_type" />
            </td>

            <td>
                <input type="date" name="chq_dt[]" class="form-control chq_dt" value= "<?php echo $key->chq_dt; ?>" id="chq_dt"/>
            </td>
            
            <td>
                <input type="text" name="amt[]" class="form-control amt" value= "<?php echo $key->amt; ?>" id="amt"/>
            </td>
            
            <!-- <td>
                <input type="text" name="remarks[]" class="form-control required" value= "<?php echo $key->remarks; ?>" id="remarks"/>
            </td> -->
           
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

