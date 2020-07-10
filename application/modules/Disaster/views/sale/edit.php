<div class="wraper">      

    <div class="col-md-7 container form-wraper">

        <form role="form" name="agent_distForm" method="POST" id="form" action="<?php echo site_url("Disaster/updateAgentSale");?>" onsubmit="return validate()" >
        
            <div class="form-header">
            
                <h4>Add Agent Sale</h4>
            
            </div>

            <?php foreach($data as $key){ ?>

                    <input type="hidden" name="trans_id" value= "<?php echo $key->trans_id; ?>" class="form-control required" id="trans_id" readonly />
                    <input type="hidden" name="trans_dt" value= "<?php echo $key->trans_dt; ?>" class="form-control required" id="trans_dt" readonly />
                    
                <div class="form-group row">

                    <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select type="text" name="dist_cd" class="form-control required" id="dist_cd" readonly>
                            <option value= "<?php echo $key->dist_cd; ?>"><?php echo $key->district_name; ?></option>
                            
                        </select>

                    </div>

                    <label for="order_no" class="col-sm-2 col-form-label">W.O No:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select type="text" name="order_no" class="form-control required" id="order_no" readonly>
                            
                            <option value= "<?php echo $key->order_no; ?>"><?php echo $key->order_no; ?></option>
                                
                        </select>        

                    </div>

                </div>

                <div class="form-group row">
                    
                    <label for="p_bill_no" class="col-sm-2 col-form-label">Purchase Bill No:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="p_bill_no" value= "<?php echo $key->pb_no; ?>" class="form-control required" id="p_bill_no" readonly/>

                    </div>

                    <label for="p_bill_dt" class="col-sm-2 col-form-label">Purchase Bill Date:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="date" name="p_bill_dt" value= "<?php echo $key->pb_dt; ?>" class="form-control required" id="p_bill_dt" readonly/>

                    </div>
                    
                </div>

                <div class="form-group row">

                    <label for="point_no" class="col-sm-2 col-form-label">Agent:</label>

                    <div class="col-sm-4">

                        <input type="text" name="agent" value= "<?php echo $key->agent ?>" class="form-control required" id="agent" readonly />
                        
                    </div>

                </div>

                <div class="form-group row">

                    <label for="sdo_memo" class="col-sm-2 col-form-label">SDO Memo:</label>

                    <div class="col-sm-4">

                        <input type="text" name="sdo_memo" value= "<?php echo $key->sdo_memo; ?>" class="form-control required" id="sdo_memo" readonly />

                    </div>

                    <label for="bdo_memo" class="col-sm-2 col-form-label">BDO Memo:</label>

                    <div class="col-sm-4">

                        <input type="text" name="bdo_memo" value= "<?php echo $key->bdo_memo; ?>" class="form-control required" id="bdo_memo" readonly />
                    
                    </div>

                </div>


                <div class="form-group row">

                    <label for="challan_from" class="col-sm-2 col-form-label">Challan No(From):</label>

                    <div class="col-sm-4">

                        <input type="text" name="challan_from" value= "<?php echo $key->challan_from; ?>" class="form-control required" id="challan_from" readonly/>

                    </div>


                    <label for="challan_to" class="col-sm-2 col-form-label">Challan No(To):</label> 

                    <div class="col-sm-4">

                        <input type="text" name="challan_to" value= "<?php echo $key->challan_to; ?>" class="form-control required" id="challan_to" readonly/>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="tot_qty" class="col-sm-2 col-form-label">Delivery Qty:</label>

                    <div class="col-sm-4">

                        <input type="text" name="tot_qty" value= "<?php echo $key->tot_qty; ?>" class="form-control required" id="tot_qty" placeholder= "Qnt" readonly/>

                    </div>

                    <label for="p_amount" class="col-sm-2 col-form-label">Purchase Amount (Rs.):</label> 

                    <div class="col-sm-4">

                        <input type="text" name="p_amount" value= "<?php echo $key->pb_amount; ?>" class="form-control required" id="p_amount" placeholder= "0.00" readonly />
            
                    </div>

                </div>

                <div class="form-group row">
                    
                    <label for="s_bill_no" class="col-sm-2 col-form-label">Sale Bill No:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="s_bill_no" value= "<?php echo $key->sb_no; ?>" class="form-control required" id="s_bill_no" required/>

                    </div>

                    <label for="s_bill_dt" class="col-sm-2 col-form-label">Sale Bill Date:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="date" name="s_bill_dt" value= "<?php echo $key->sb_dt; ?>" class="form-control required" id="s_bill_dt" required/>

                    </div>
                    
                </div>

                <div class="form-group row">

                    <label for="sale_rate" class="col-sm-2 col-form-label">Sale Rate(Rs.):<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="sale_rate" value= "<?php echo $key->rate; ?>" class="form-control required" id="sale_rate" placeholder= "0.00" required/>

                    </div>

                    <label for="s_amount" class="col-sm-2 col-form-label">Sale Bill Amount (Rs.):<font color="red">*</font></label> 

                    <div class="col-sm-4">

                        <input type="text" name="s_amount" value= "<?php echo $key->sb_amount; ?>" class="form-control required" id="s_amount" placeholder= "0.00" required/>
            
                    </div>

                </div>

                <div class="form-group row">

                    <label for="remarks" class="col-sm-2 col-form-label">Remarks</label> 
                    <div class="col-sm-10">
                        <textarea name="remarks" id="remarks" class="form-control required" cols="30" rows="3"><?php echo $key->remarks; ?></textarea>
                    </div>

                </div>

            <?php } ?>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" id= "submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>

    </div>

</div>



<!-- For select2 js -->
<script>

    $(document).ready(function(){

        $("#dist_cd").select2();
        $("#order_no").select2();
        
    })

</script>


<!-- For total sale amount calculation -->
<script>

    $(document).ready(function(){

        $('#sale_rate').on('change', function(){

            var amount = parseFloat($('#tot_qty').val())*parseFloat($(this).val());
            $('#s_amount').val(parseFloat(amount).toFixed('2'));

        })

    })

</script>