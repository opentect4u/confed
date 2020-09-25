<div class="wraper">      

<div class="col-md-9 container form-wraper">

    <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/updateBillPayment");?>" onsubmit="return validate()" >

        <div class="form-header">
            
            <h4>Bank & File Details</h4>
        
        </div>
        <?php foreach($bank as $key); ?>

            <div class="form-group row">
            
                <label for="file_name" class="col-sm-1 col-form-label">File Name<font color="red">*</font></label>

                    <div class="col-sm-2">

                        <input type="text" name="file_name" value = "<?php echo $key->file_name; ?>" class="form-control file_name" id="file_name" required>
                            
                    </div>
                <label for="page_no" class="col-sm-1 col-form-label">Page No<font color="red">*</font></label>
                <div class="col-sm-2">

                    <input type="text" name="page_no" style="width:100px;" value = "<?php echo $key->page_no; ?>" class="form-control page_no" id="page_no" required>
                        
                </div>

                <label for="bank" class="col-sm-1 col-form-label">Bank<font color="red">*</font></label>

                <div class="col-sm-3">

                    <input type="text" name="bank" value = "<?php echo $key->bank; ?>" class="form-control bank" id="bank" required>
                    <!-- <select name="bank" id="bank" class="form-control bank" required>
                                <option value="">Select bank</option>
                                <?php foreach($bank1 as $key3){ ?>
                                        <option value="<?php echo $key->bank; ?>" <?php echo($key3->bank_name == $key->bank_name)?'selected':'' ?> >
                                            <?php echo $key3->bank_name; ?>
                                        </option>
                                <?php } ?>
                            </select> -->

                                     
                </div>
                <!-- <label for="ref_no" class="col-sm-1 col-form-label">ref_no<font color="red">*</font></label> -->
                <div class="col-sm-2">

                    <input type="hidden" name="ref_no" style="width:80px;" value = "<?php echo $key->ref_no; ?>" class="form-control ref_no" id="ref_no" required>
                        
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
                <input type="text" name="project[]" class="form-control project" value= "<?php echo $key1->project; ?>" id="project" readonly/>
            </td>
           
            <td>
                <input type="text" name="order_no[]" class="form-control order_no" value= "<?php echo $key1->order_no; ?>" id="order_no" readonly/>
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

            <!-- </tbody>  -->
         
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
                <tr>
                <td colspan="2" style="text-align: right;">Add Amount:</td>
                    
                    <td><input type="text"  style="width:100px" value= "<?php echo $key->s_bill_add_amt; ?>" id=s_bill_less_amt class="form-control s_bill_add_amt" name="s_bill_add_amt"></td>
                   
                    <td></td>
                    <td></td>
                    <td><input type="text"  style="width:100px"   value= "<?php echo $key->p_bill_add_amt; ?>"  class="form-control p_bill_add_amt" name="p_bill_add_amt"></td>
                </tr>
                

                 <tr>
                <td colspan="2" style="text-align: right;">Less Round Off:</td>
                    
                    <td><input type="text"  style="width:100px" value= "<?php echo $key->s_bill_less_rnd_off; ?>" id="s_bill_less_rnd_off" class="form-control s_bill_less_rnd_off" name="s_bill_less_rnd_off"></td>
                   
                    <td></td>
                    <td></td>
                    <td><input type="text"  style="width:100px"   value= "<?php echo $key->p_bill_less_rnd_off; ?>" id="p_bill_less_rnd_off" class="form-control p_bill_less_rnd_off" name="p_bill_less_rnd_off"></td>
                </tr> 

                 <tr>
                <td colspan="2" style="text-align: right;">Add Round Off:</td>
                    
                    <td><input type="text"  style="width:100px" value= "<?php echo $key->s_bill_add_rnd_off; ?>" id="s_bill_add_rnd_off" class="form-control s_bill_add_rnd_off" name="s_bill_add_rnd_off"></td>
                   
                    <td></td>
                    <td></td>
                    <td><input type="text"  style="width:100px"   value= "<?php echo $key->p_bill_add_rnd_off; ?>" id="p_bill_add_rnd_off" class="form-control p_bill_add_rnd_off" name="p_bill_add_rnd_off"></td>
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
    <?php foreach($mr as $key1){ ?>
        <tr>
  
            <td>
                <input type="text" name="mr_no[]" class="form-control mr_no" value= "<?php echo $key1->mr_no; ?>" id="mr_no"/>
            </td>
            <!-- <td>
          <select name="mr_dt[]" id="mr_dt" class="form-control mr_dt">
                                                
                  <option value="<?php echo $key1->project; ?>"><?php echo $key1->project; ?></option>
                                                    
              </select>

           </td>  -->
           <td>
                <input type="date" name="mr_dt[]" class="form-control mr_dt" value= "<?php echo $key1->mr_dt; ?>" id="mr_dt"/>
            </td>

            <td>
            <input type="text" name="chq_type[]" value= "<?php echo $key1->chq_type; ?>" class="form-control chq_type" id="chq_type" />
            </td>

            <td>
                <input type="date" name="chq_dt[]" class="form-control chq_dt" value= "<?php echo $key1->chq_dt; ?>" id="chq_dt"/>
            </td>
            
            <td>
                <input type="text" name="amt[]" class="form-control amt" value= "<?php echo $key1->amt; ?>" id="amt"/>
            </td>
            
            <!-- <td>
                <input type="text" name="remarks[]" class="form-control required" value= "<?php echo $key1->remarks; ?>" id="remarks"/>
            </td> -->
           
        </tr>
        <?php } ?>
    </tbody>   
<tfoot>
<tr>
                    <td colspan="4" style="text-align: right;">Add GST:</td>
                    <td><input type="text" style="width:100px"  id=mr_add_gst class="form-control mr_add_gst" name="mr_add_gst"  value="<?php echo $key->mr_add_gst; ?>"></td>
                    </tr>
                    <!-- value="<?php echo $key->mr_add_gst; ?>" -->
                    <tr>
                    <td colspan="4" style="text-align: right;">Less GST:</td>
                    <td><input type="text" style="width:100px"  id=mr_less_gst class="form-control mr_less_gst" name="mr_less_gst"  value="<?php echo $key->mr_less_gst; ?>"></td>
                    </tr>
                    <tr>
                    <td colspan="4" style="text-align: right;">Less Cofed Margin:</td>
                    <td><input type="text" style="width:100px"  id=confed_margin class="form-control confed_margin" name="confed_margin"  value="<?php echo $key->confed_margin; ?>"></td>
                    </tr>
                    <tr>
                    <td colspan="4" style="text-align: right;">Add GST:</td>
                    <td><input type="text"  style="width:100px" id=margin_add_gst class="form-control margin_add_gst" name="margin_add_gst"  value="<?php echo $key->margin_add_gst; ?>"></td>
                    </tr>
                    <tr>
                    <td colspan="4" style="text-align: right;">Less GST:</td>
                    <td><input type="text" style="width:100px" id=margin_less_gst class="form-control margin_less_gst" name="margin_less_gst" value="<?php echo $key->margin_less_gst; ?>"></td>
                    </tr>
                    <tr>
                    <td colspan="4" style="text-align: right;">Total:</td>
                    <td><input type="text" style="width:110px" class="form-control tot_mr_amt" id=tot_mr_amt value="<?php echo $key->tot_mr_amt; ?>" readonly></td>
                    

                </tr>

</tfoot>
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

<script>

$('#intro2').on('change', '#s_bill_no', function(){

    var row = $(this).closest('tr');
    var s_bill_no = row.find('td:eq(0) :input').val();

    $.get('<?php echo site_url("stationary/js_get_s_p_data");?>',{s_bill_no:s_bill_no })
    .done(function(data)
    {
        // console.log('ok');
        var result=JSON.parse(data);
        var s_bill_dt=result.s_bill_dt;
        var s_bill_amt=result.s_bill_amt;
        var p_bill_no=result.p_bill_no;
        var p_bill_dt=result.p_bill_dt;
        var p_bill_amt=result.p_bill_amt
       
        row.find('td:eq(1) :input').val(s_bill_dt);
        row.find('td:eq(2) :input').val(s_bill_amt);
        row.find('td:eq(3) :input').val(p_bill_no);
        row.find('td:eq(4) :input').val(p_bill_dt);
        row.find('td:eq(5) :input').val(p_bill_amt);
        var sum_sale = 0;
        var sum_pur = 0;
        $('.s_bill_amt').each(function(){
            
            sum_sale += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
   // sum += $('#amt').val();
});

// $("#tot_s_bill").val(sum_sale);  

$('.s_bill_less_amt').change(function(){

$('.tot_s_bill').val(sum_sale - $(this).val());

});
$("#tot_s_bill").val(sum_sale); 

$('.p_bill_amt').each(function(){
    // console.log(s_bill_less_amt);         
    sum_pur += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
   // sum += $('#amt').val();
});
$("#tot_p_bill").val(sum_pur);  

$('.p_bill_less_amt').change(function(){

$('.tot_p_bill').val(sum_pur - $(this).val());

});
    });
})
 </script>