<div class="wraper">      

    <div class= "row">

        <div class="col-md-12 container form-wraper" style= "margin-left: 0%;">

            <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("sw/updateShortageEntry");?>" onsubmit="return validate()" >
                
                <div class="form-header">
                
                    <h4>Add New Payment</h4>
                
                </div>

                <?php foreach($data1 as $key1){ ?>

                    <div class="form-group row">

                        <label for="date" class="col-sm-2 col-form-label">Date:<font color= "red">*</font></label>

                        <div class="col-sm-4">
                            <input type="date" name= "trans_dt" value= "<?php echo $key1->trans_dt; ?>" id= "trans_dt" class= "form-control required" readonly>
                            
                        </div>

                        <label for="payment_key" class="col-sm-2 col-form-label">Payment Key:<font color= "red">*</font></label>

                        <div class="col-sm-4">
                            
                            <input type="text" name= "payment_key" value= "<?php echo $key1->payment_key; ?>" id= "payment_key" class= "form-control required" readonly>
                            
                        </div>

                    </div>

                    <div class="form-group row">
                        <?php foreach($data2 as $key2){ ?>

                        <label for="tot_pb_amnt" class="col-sm-2 col-form-label">Total PB Amount</label>
                        <div class="col-sm-4">
                            
                            <input type= "text" name= "tot_pb_amnt" value= "<?php echo $key2->pb_amnt; ?>" id= "tot_pb_amnt" class= "form-control required">

                        </div>

                        <label for="tot_sb_amnt" class="col-sm-2 col-form-label">Total SB Amount</label>
                        <div class="col-sm-4">
                            
                            <input type="text" name= "tot_sb_amnt" value= "<?php echo $key2->sb_amnt; ?>" id= "tot_sb_amnt" class= "form-control required">

                        </div>
                        <?php } ?>

                    </div>

                    <div class="form-group row">

                        <label for="shortage" class="col-sm-2 col-form-label">Shortage(Rs)</label>
                        <div class="col-sm-4">
                            
                            <input type="text" name= "shortage" value= "<?php echo $key1->shortage; ?>" id= "shortage" class= "form-control required">

                        </div>

                        <label for="oil_shortage" class="col-sm-2 col-form-label">Oil Shortage</label>
                        <div class="col-sm-4">
                            
                            <input type="text" name= "oil_shortage" value= "<?php echo $key1->oil_shortage; ?>" id= "oil_shortage" class= "form-control required">

                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="tot_payable" class="col-sm-2 col-form-label">Total Payable(Rs)</label>
                        <div class="col-sm-4">
                            
                            <input type="text" name= "tot_payable" value= "<?php echo $key1->tot_payable; ?>" id= "tot_payable" class= "form-control required">

                        </div>

                        <label for="tot_rcv" class="col-sm-2 col-form-label">Total Received(Rs)</label>
                        <div class="col-sm-4">
                            
                            <input type="text" name= "tot_rcv" value= "<?php echo $key1->tot_rcv; ?>" id= "tot_rcv" class= "form-control required">

                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="commission" class="col-sm-2 col-form-label">Commission (Rs)</label>
                        <div class="col-sm-4">
                            
                            <input type="text" name= "commission" value= "<?php echo $key1->commission; ?>" id= "commission" class= "form-control required">

                        </div>

                    </div>

                    <div class="form-header">
                    
                        <h4>Payment Details</h4>
                    
                    </div>

                    <?php foreach($data3 as $key3){ ?>

                    <div class="row" style ="margin: 5px;">

                        <div class="form-group">

                            <table class= "table table-striped table-bordered table-hover">

                                <thead>

                                    <th id= "sl_no_th" style= "text-align: center">SL No</th>
                                    <th style= "text-align: center">MR No</th>
                                    <th style= "text-align: center">Bank Name</th>
                                    <th style= "text-align: center">Credited(Rs)</th>
                                    <th style= "text-align: center">M. Oil(Rs)</th>
                                    <th style= "text-align: center">Credit Date</th>
                                    
                                </thead>
                                <hr>
                                <tbody id= "intro">
                                    <tr>
                                    
                                        <td id= "sl_no_td">
                                            <input type="text" name="sl_no[]" class="form-control required sl_no" value= "<?php echo $key3->sl_no; ?>" id="sl_no" required>
                                        </td>
                                        
                                        <td>
                                            <select name="mr_no[]" id="mr_no" class="form-control required mr_no">
                                                <option value="<?php echo $key3->mr_no; ?>"><?php echo $key3->mr_no; ?></option>
                                            </select>
                                        </td>

                                        <td>
                                            <select name="bank[]" id="bank" class="form-control required">
                                                <option value="<?php echo $key3->bank; ?>"><?php echo $key3->bank_name; ?></option>
                                                <?php foreach($data4 as $key4){ ?>
                                                    
                                                    <option value="<?php echo $key4->sl_no; ?>" ><?php echo $key4->bank_name; ?></option>
                                                   
                                                <?php } ?>
                                            </select>
                                        </td>

                                        <td>
                                            <input type="text" name="amnt_cr[]" class="form-control required amnt_cr" value= "<?php echo $key3->amnt_cr; ?>" id="amnt_cr" required>
                                        </td>

                                        <td>
                                            <input type="text" name="amnt_oil[]" class="form-control required amnt_oil" value= "<?php echo $key3->amnt_oil; ?>" id="amnt_oil" required>
                                        </td>

                                        <td>
                                            <input type="date" name="cr_dt[]" class="form-control required cr_dt" value= "<?php echo $key3->cr_dt; ?>" id="cr_dt" required>
                                        </td>

                                    </tr>

                                </tbody>
                            
                            </table>

                        </div> 

                        <hr>
                    
                    </div>

                    <?php } ?>

                    <div class="form-group row">

                        <label for="remarks" class="col-sm-2 col-form-label">Remarks<font color="red">*</font></label>
                        
                        <div class="col-sm-10">

                            <textarea name="remarks" id="remarks" class="form-control required" cols="200" rows="2"><?php echo $key1->remarks; ?></textarea>

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



<!-- To hide sl_no in table  -->
<script>

    $(document).ready(function(){

        $('#sl_no_th').hide();
        $('#sl_no_td').hide();

    })

</script>