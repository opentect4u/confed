<div class="wraper">      

    <div class="col-md-7 container form-wraper">

        <form role="form" name="agent_distForm" method="POST" id="form" action="<?php echo site_url("Disaster/entryAgentSale");?>" onsubmit="return validate()" >
        
            <div class="form-header">
            
                <h4>Add Agent Sale</h4>
            
            </div>

            <div class="form-group row">

                <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select type="text" name="dist_cd" class="form-control required" id="dist_cd" >
                        <option value= "">Select District</option>
                        <?php
                            foreach($dist_data as $key)
                            { 
                            ?>
                                <option value="<?php echo ($key->district_code); ?>"><?php echo ($key->district_name); ?></option>
                        <?php
                            }
                            ?>

                    </select>

                </div>

                <label for="order_no" class="col-sm-2 col-form-label">W.O No:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select type="text" name="order_no" class="form-control required" id="order_no" >
                        
                        <option value= "">Select WO</option>
                            
                    </select>        

                </div>

            </div>

            <div class="form-group row">
                
                <label for="p_bill_no" class="col-sm-2 col-form-label">Purchase Bill No:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="text" name="p_bill_no" class="form-control required" id="p_bill_no" required/>

                </div>

                <label for="p_bill_dt" class="col-sm-2 col-form-label">Purchase Bill Date:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="date" name="p_bill_dt" class="form-control required" id="p_bill_dt" required/>

                </div>
                
            </div>

            <div class="form-group row">

                <label for="point_no" class="col-sm-2 col-form-label">Agent:</label>

                <div class="col-sm-4">

                    <input type="text" name="agent" class="form-control required" id="agent" readonly />
                    <input type="hidden" name="point_no" class="form-control required" id="point_no" readonly />
                
                </div>

            </div>

            <div class="form-group row">

                <label for="sdo_memo" class="col-sm-2 col-form-label">SDO Memo:</label>

                <div class="col-sm-4">

                    <input type="text" name="sdo_memo" class="form-control required" id="sdo_memo" readonly />

                </div>

                <label for="bdo_memo" class="col-sm-2 col-form-label">BDO Memo:</label>

                <div class="col-sm-4">

                    <input type="text" name="bdo_memo" class="form-control required" id="bdo_memo" readonly />
                
                </div>

            </div>


            <div class="form-group row">

                <label for="challan_from" class="col-sm-2 col-form-label">Challan No(From):</label>

                <div class="col-sm-4">

                    <input type="text" name="challan_from" class="form-control required" id="challan_from" readonly/>

                </div>


                <label for="challan_to" class="col-sm-2 col-form-label">Challan No(To):</label> 

                <div class="col-sm-4">

                    <input type="text" name="challan_to" class="form-control required" id="challan_to" readonly/>

                </div>

            </div>

            <div class="form-group row">

                <label for="tot_qty" class="col-sm-2 col-form-label">Delivery Qty:</label>

                <div class="col-sm-4">

                    <input type="text" name="tot_qty" class="form-control required" id="tot_qty" placeholder= "Qnt" readonly/>

                </div>

                <label for="p_amount" class="col-sm-2 col-form-label">Purchase Amount (Rs.):</label> 

                <div class="col-sm-4">

                    <input type="text" name="p_amount" class="form-control required" id="p_amount" placeholder= "0.00" readonly />
        
                </div>

            </div>

            <div class="form-group row">
                
                <label for="s_bill_no" class="col-sm-2 col-form-label">Sale Bill No:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="text" name="s_bill_no" class="form-control required" id="s_bill_no" required/>

                </div>

                <label for="s_bill_dt" class="col-sm-2 col-form-label">Sale Bill Date:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="date" name="s_bill_dt" class="form-control required" id="s_bill_dt" required/>

                </div>
                
            </div>

            <div class="form-group row">

                <label for="sale_rate" class="col-sm-2 col-form-label">Sale Rate(Rs.):<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="text" name="sale_rate" class="form-control required" id="sale_rate" placeholder= "0.00" required/>

                </div>

                <label for="s_amount" class="col-sm-2 col-form-label">Sale Bill Amount (Rs.):<font color="red">*</font></label> 

                <div class="col-sm-4">

                    <input type="text" name="s_amount" class="form-control required" id="s_amount" placeholder= "0.00" required/>
        
                </div>

            </div>

            <div class="form-group row">

                <label for="remarks" class="col-sm-2 col-form-label">Remarks</label> 
                <div class="col-sm-10">
                    <textarea name="remarks" id="remarks" class="form-control required" cols="30" rows="3"></textarea>
                </div>

            </div>

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


<!--  To get Order No as per selected District  -->
<script>

    $(document).ready(function(){

        $('#dist_cd').change(function(){
            //console.log(100);

            $.get( 

                '<?php echo site_url("Disaster/js_get_orderNo_perDist");?>',
                { 

                    dist_cd : $(this).val()

                }

            ).done(function(data){
                //console.log(data);
                var string = '<option value="">Select WO</option>';

                $.each(JSON.parse(data), function( index, value ) {
                    
                    var order_dt = value.order_dt; 
                    var parts = order_dt.split('-');
                    var myOrder_dt = parts[2] + '-' + parts[1] + '-' + parts[0]; // to change date formate

                    string += '<option value="' + value.order_no + '">' + value.order_no + ' DT '+ myOrder_dt +'</option>'
                    
                });
                
                var newElement = '<select class="form-control" name="order_no" id="order_no"> '+ string +' </select>'; 
                //console.log(newElement);

                $("#order_no").html(newElement);
                

            });            
                                 
        });                    
       

    });

</script>


<!-- Checking purchase bill no and purchase bill dt -->
<script>

    $(document).ready(function(){

        $('#p_bill_dt').on('change', function(){

            $.get('<?php echo site_url("Disaster/js_check_pBillNo_forSale"); ?>', {p_bill_no:$('#p_bill_no').val(), p_bill_dt:$(this).val()})
            .done(function(data){

                var row = JSON.parse(data).row;
                if(row != 0)
                {
                    
                    var p_bill_no = $('#p_bill_no').val();
                    var p_bill_dt = $('#p_bill_dt').val();

                    $.get('<?php echo site_url("Disaster/js_get_details_byPBill"); ?>', {p_bill_no:p_bill_no, p_bill_dt:p_bill_dt})
                    .done(function(data){

                        var result = JSON.parse(data);
                        //console.log(result[0]);

                        var agent           =       result[0].agent;
                        var point_no        =       result[0].point_no;
                        var sdo_memo        =       result[0].sdo_memo;
                        var bdo_memo        =       result[0].bdo_memo;
                        var challan_from    =       result[0].challan_from;
                        var challan_to      =       result[0].challan_to;
                        var tot_qty         =       result[0].tot_qty;
                        var amount          =       result[0].amount;

                        $('#point_no').val(point_no);
                        $('#agent').val(agent);
                        $('#sdo_memo').val(sdo_memo);
                        $('#bdo_memo').val(bdo_memo);
                        $('#challan_from').val(challan_from);
                        $('#challan_to').val(challan_to);
                        $('#tot_qty').val(tot_qty);
                        $('#p_amount').val(amount);


                        $('#sale_rate').on('change', function(){

                            var s_amount = parseFloat(tot_qty)*parseFloat($(this).val());
                            //console.log(s_amount);
                            $('#s_amount').val(parseFloat(s_amount).toFixed('2'));

                        })



                    })

                }
                else if(row == 0)
                {
                    alert('Purchase Bill and Date is not valid');
                }

            })

        })

    })

</script>


<!-- Checking Duplicate entry -->
<script>

    $(document).ready(function(){

        $('#p_bill_dt').on('change', function(){

            if($('#p_bill_no') == '')
            {
                alert('Give Purchase Bill first');
            }
            else
            {
                var pb_no = $('#p_bill_no').val();
                var dist_cd = $('#dist_cd').val();
                var order_no = $('#order_no').val();

                $.get('<?php echo site_url("Disaster/js_check_duplicate_PBillNo"); ?>',{pb_no:pb_no, dist_cd:dist_cd, order_no:order_no})
                .done(function(data){

                    var row = JSON.parse(data).num_row;
                    
                    if(row == 0)
                    {
                        return true;
                    }
                    else
                    {
                        alert('Bill No exists ...');
                    }

                })

            }

        })

    })

</script>