
<div class="wraper">      

    <div class="col-md-7 container form-wraper">
    <!--  -->
        <form role="form" name="agent_delForm" method="POST" id="form" action="<?php echo site_url("Disaster/updateAgentDelivery");?>" onsubmit="return validate()" >
        
            <div class="form-header">
            
                <h4>Add New Delivery</h4>
            
            </div>

            <?php foreach($data1 as $key1)
            { ?>
                    <!-- <input type="text" name="sl_no" value= "<?php //echo $key1->sl_no; ?>" class="form-control required" id="sl_no" /> -->
                    <input type="hidden" name="trans_dt" class="form-control required" value= "<?php echo $key1->trans_dt; ?>" id="trans_dt" readonly/>
                    <input type="hidden" name="trans_id" class="form-control required" value= "<?php echo $key1->trans_id; ?>" id="trans_id" readonly/>

                    <div class="form-group row">

                        <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <select type="text" name="dist_cd" class="form-control required" id="dist_cd" readonly >
                                
                                <option value="<?php echo ($key1->district_code); ?>"><?php echo ($key1->district_name); ?></option>
                                
                            </select>

                        </div>

                        <label for="point_no" class="col-sm-2 col-form-label">Agent:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <select class="form-control" name="point_no" id="point_no" readonly >
                                            
                                <option value="<?php echo ($key1->point_no); ?>"><?php echo ($key1->agent). '- '.($key1->sdo_name); ?></option>
                                                                                
                            </select>
                        
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="order_no" class="col-sm-2 col-form-label">W.O No:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <select type="text" name="order_no" class="form-control required" id="order_no" readonly>
                                <option value= "<?php echo $key1->order_no; ?>"><?php echo $key1->order_no.' DT '.$order_dt->order_dt ; ?></option>
                                
                            </select>

                        </div>


                    </div>

                    <div class="form-group row">

                        <label for="sdo_memo" class="col-sm-2 col-form-label">SDO Memo:</label>

                        <div class="col-sm-4">

                            <select  name="sdo_memo" class="form-control required" id="sdo_memo" readonly >
                                
                                <option value= "<?php echo ($key1->sdo_memo); ?>"><?php echo ($key1->sdo_memo); ?></option>
                                    
                            </select>

                        </div>

                        <label for="bdo_memo" class="col-sm-2 col-form-label">BDO Memo:</label>

                        <div class="col-sm-4">

                            <select name="bdo_memo" class="form-control required" id="bdo_memo" readonly >
                                
                                <option value= "<?php echo ($key1->bdo_memo); ?>"><?php echo ($key1->bdo_memo); ?></option>
                                    
                            </select>

                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="qty_bal" class="col-sm-2 col-form-label">Undelivered Qty(Qnt):</label>

                        <div class="col-sm-4">

                            <input type="text" name="qty_bal" value= "<?php echo $data2; ?>" class="form-control required" id="qty_bal" readonly/>
                
                        </div>

                    </div>

                
                        <div class="form-group row">
                        
                        <label for="bill_no" class="col-sm-2 col-form-label">Purchase Bill No:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="text" name="bill_no" class="form-control required" id="bill_no" value= "<?php echo $key1->bill_no; ?>" />
                
                        </div>

                        
                        <label for="bill_dt" class="col-sm-2 col-form-label">Purchase Bill Date:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="date" name="bill_dt" class="form-control required" id="bill_dt" value= "<?php echo $key1->bill_dt; ?>" />
                
                        </div>
                        
                    </div>

                    
                    <div class="form-group row">

                        <label for="challan_from" class="col-sm-2 col-form-label">Challan No(From):<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="text" name="challan_from" class="form-control required" value= "<?php echo $key1->challan_from; ?>" id="challan_from" required/>
                
                        </div>


                        <label for="challan_to" class="col-sm-2 col-form-label">Challan No(To):<font color="red">*</font></label> 

                        <div class="col-sm-4">

                            <input type="text" name="challan_to" class="form-control required" value= "<?php echo $key1->challan_to; ?>" id="challan_to" required/>
                
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="tot_qty" class="col-sm-2 col-form-label">Delivery Qty(Qnt.):<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="text" name="tot_qty" class="form-control required" value= "<?php echo $key1->tot_qty ?>" id="tot_qty" placeholder= "MT" required/>
                
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="tot_qty" class="col-sm-2 col-form-label">Vendor:<font color="red">*</font></label>

                        <div class="col-sm-10">

                            <select type="text" name="vendor" class="form-control required" id="vendor" required>
                                <option value= "<?php echo $key1->vendor; ?>"><?php echo $key1->vendor_name; ?></option>
                               
                            </select>

                        </div>

                    </div>

                    <div class="form-header">
            
                        <h4>Previous Delivery Details</h4>
                    
                    </div>

                    <div class="form-group row">

                        <label for="rate" class="col-sm-2 col-form-label">Rate Per Qnt:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="text" name="rate" class="form-control required" id="rate" value= "<?php echo $key1->rate; ?>" required/>
                
                        </div>

                        <label for="amount" class="col-sm-2 col-form-label">Amount (Rs.):</label> 

                        <div class="col-sm-4">

                            <input type="text" name="amount" class="form-control required" id="amount" value= "<?php echo $key1->amount; ?>"  required/>
                
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="remarks" class="col-sm-2 col-form-label">Remarks</label> 
                        
                        <div class="col-sm-8">
                            <textarea name="remarks" id="remarks" class="form-control required" cols="30" rows="3"><?php echo $key1->remarks; ?></textarea>
                        </div>

                    </div>
                
                <?php
                }
                ?>


            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>

    </div>

</div>






<!-- To get total Amount after changing rate -->

<script>

    $(document).ready(function(){

        $('#rate').change(function(){

            //console.log(1111);
            
            var rate = $(this).val();
            var qty = $('#qty').val();
            
            var amount = rate*qty;
            $("#amount").val(amount);

        });

    });

</script> 

<script>

    $(document).ready(function(){

        $('#qty').change(function(){

            //console.log(1111);
            
            var qty = $(this).val();
            var rate = $('#rate').val();
            
            var amount = rate*qty;
            $("#amount").val(amount);

        });

    });

</script>

<!-- To get total Amount after changing "qty" -->

<script>

    $(document).ready(function(){

        $('#qty').change(function(){

            //console.log(1111);
            
            var qty = $(this).val();
            var rate = $('#rate').val();
            
            var amount = rate*qty;
            $("#amount").val(amount);

        });

    });

</script> 



<!-- To Validate/ Check whather distributed tot_qnt exceeds distict allot_qty   -->

<script>
   
var delAmount    =   document.forms["agent_delForm"]["tot_qty"];
var qtyBal       =   document.forms["agent_delForm"]["qty_bal"];

function validate()
{
    if((parseInt(delAmount.value)) > (parseInt(qtyBal.value))) {
        
        //document.getElementById("qty").style.border = "1px solid red";

        qty.style.border = "1px solid red";
        
        return false;

    }
    
}

</script>


<!-- to add and remove row of challan table -->

<script>

    $(document).ready(function(){

        $("#addrow").click(function()
        {

            var newElement= '<tr><td><input type="text" name="challan_no[]" class="form-control required" id="challan_no" /></td><td><input type="text" name="truck[]" class="form-control required" id="truck" /></td><td><input type="text" name="qty[]" class="form-control amount_cls" id="qty" /></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';

            $("#intro").append($(newElement));
                                                                
        });

        
        $("#intro").on("click","#removeRow", function(){
            $(this).parent().parent().remove();
            $('.amount_cls').change();
        });

        // to change the value of total field as per fees field selected by adding rows

        $('#intro').on( "change", ".amount_cls", function()
        {
            
            var total = $("#tot_qty").val();

            $('.amount_cls').each(function()
            {
                total += +$(this).val();

            });
            $("#tot_qty").val(total);

        });

    });

</script>
