<div class="wraper">      

    <div class= "row">

        <div class="col-md-6 container form-wraper" style="margin-left: 0px;" >
        
            <form role="form" name="agent_delForm" method="POST" id="form" action="<?php echo site_url("Disaster/entryAgentDelivery");?>" onsubmit="return validate()" >
            
                <div class="form-header">
                
                    <h4>Add New Delivery</h4>
                
                </div>

                <!-- <input type="hidden" name="trans_id" class="form-control required" id="trans_id" /> -->
                <input type="hidden" name="sl_no" value= "<?php echo $sl_no->sl_no+1; ?>" class="form-control required" id="sl_no" />

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

                    <label for="point_no" class="col-sm-2 col-form-label">Agent:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select class="form-control" name="point_no" id="point_no" required >
                                        
                            <option value= "">Select Agent</option>                                              
                                    
                        </select>
                    
                    </div>

                </div>

                <div class="form-group row">

                    <label for="order_no" class="col-sm-2 col-form-label">W.O No:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select type="text" name="order_no" class="form-control required" id="order_no" >
                            
                            <option value= "">Select WO</option>
                                
                        </select>        

                    </div>


                </div>

                <div class="form-group row">

                    <label for="sdo_memo" class="col-sm-2 col-form-label">SDO Memo:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select type="text" name="sdo_memo" class="form-control required" id="sdo_memo" >
                            
                            <option value= "">Select Memo</option>
                                
                        </select>

            
                    </div>

                    <label for="bdo_memo" class="col-sm-2 col-form-label">BDO Memo:</label>

                    <div class="col-sm-4">

                        <select type="text" name="bdo_memo" class="form-control required" id="bdo_memo" >
                            
                            <option value= "">Select Memo</option>
                                
                        </select>

                    
                    </div>

                </div>

                <div class="form-group row">

                    <label for="qty_bal" class="col-sm-2 col-form-label">Undelivered Qty(Qnt):</label>

                    <div class="col-sm-4">

                        <input type="text" name="qty_bal" class="form-control required" id="qty_bal" readonly/>
            
                    </div>

                </div>


                <div class="form-group row">
                    
                    <label for="bill_no" class="col-sm-2 col-form-label">Purchase Bill No:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="bill_no" class="form-control required" id="bill_no" required/>
            
                    </div>

                    <label for="bill_dt" class="col-sm-2 col-form-label">Bill Date:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="date" name="bill_dt" class="form-control required" id="bill_dt" required/>
            
                    </div>
                    
                </div>

                <div class="form-group row">

                    <label for="challan_from" class="col-sm-2 col-form-label">Challan No(From):<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="challan_from" class="form-control required" id="challan_from" required/>
            
                    </div>


                    <label for="challan_to" class="col-sm-2 col-form-label">Challan No(To):<font color="red">*</font></label> 

                    <div class="col-sm-4">

                        <input type="text" name="challan_to" class="form-control required" id="challan_to" required/>
            
                    </div>

                </div>

                <div class="form-group row">

                    <label for="tot_qty" class="col-sm-2 col-form-label">Delivery Qty(Qnt.):<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <input type="text" name="tot_qty" class="form-control required" id="tot_qty" placeholder= "Qnt" required/>
            
                    </div>

                </div>

                <div class="form-group row">

                    <label for="tot_qty" class="col-sm-2 col-form-label">Vendor:<font color="red">*</font></label>

                    <div class="col-sm-10">

                        <select type="text" name="vendor" class="form-control required" id="vendor" required>
                            <option value= "">Select Vendor</option>
                            <?php
                                foreach($vendor as $key1)
                                { 
                                ?>
                                    <option value="<?php echo ($key1->sl_no); ?>"><?php echo ($key1->vendor_name); ?></option>
                            <?php
                                }
                                ?>

                        </select>

                    </div>

                </div>

                <div class="form-header">
                
                    <h4>Purchase Details</h4>
            
                </div>

                    <div class="form-group row">

                        <label for="rate" class="col-sm-2 col-form-label">Rate Per Qnt:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="text" name="rate" class="form-control required" id="rate" required/>
                
                        </div>


                        <label for="amount" class="col-sm-2 col-form-label">Amount (Rs.):</label> 

                        <div class="col-sm-4">

                            <input type="text" name="amount" class="form-control required" id="amount" required />
                
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="remarks" class="col-sm-2 col-form-label">Remarks</label> 
                        <div class="col-sm-8">
                            <textarea name="remarks" id="remarks" class="form-control required" cols="30" rows="3"></textarea>
                        </div>

                    </div>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            </form>

        </div>

        <div class="col-md-5 container form-wraper" style="margin-left: 10px; width: 48%;" >

            <div class="form-header">
                
                <h4>Previous Delivery Details</h4>
            
            </div>
            
            <table class="table table-bordered table-hover">

                <thead>
                    <caption id= "infoCaption"></caption>
                    <tr>

                        <th>P. Bill No</th>
                        <th>P. Bill Dt</th>
                        <th>Delivered Qty(Qnt)</th>

                    </tr>

                </thead>

                <tbody id= "info_table" >
                
                </tbody>

            </table>

        </div>

    </div>

</div>



<!--  To select "trans_id" for the date selected // like transaction code   -->
<script>

    $(document).ready(function(){

        $('#del_dt').change(function(){

            $.get( 
                '<?php echo site_url("Disaster/js_get_deliveryTransId");?>',
                { 

                    del_dt: $(this).val()
                    
                }
            )
            .done(function(data){

                //console.log(data);
                var slData = JSON.parse(data);
                var No = slData.trans_id;

                console.log(No);
                if(No != null)
                {   
                    //console.log('if');
                    var trans_id = parseInt(No) + 1;
                    $('#trans_id').val(parseInt(trans_id));
                }
                else
                {   
                    //console.log('else');
                    $('#trans_id').val(1);
                }

                
            });

        });

    });

</script>


<!-- To get Agents  as per District -->
<script>

    $(document).ready(function(){

        var i = 1;

        $('#dist_cd').change(function(){

            $.get('<?php echo site_url("Disaster/js_agent");?>',{ dist_cd: $(this).val() } )
            
            .done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.point_no + '">' + value.agent + '- '+ (value.bdo_name) +'</option>'

                });

                
                $('#point_no').html(string);

            });

        });


    });

</script>


<!-- To get total undelivered alloted balance of a agent as per WO No & Dist_cd -->
<script>

    $(document).ready(function(){

        $('#sdo_memo').change(function(){

            $.get( 

                '<?php echo site_url("Disaster/js_agent_allotQtyBal");?>',
                { 

                    order_no : $('#order_no').val(),                    
                    dist_cd : $('#dist_cd').val(),
                    point_no: $('#point_no').val(),
                    sdo_memo: $(this).val()
                    
                }
            )
            .done(function(data){

                console.log(data);
                var tot_allot_bal = JSON.parse(data);

                $('#qty_bal').val(tot_allot_bal);

            });

        });

    });

</script>


<!-- To get "sdo_memo" as per District and WO -->
<script>

    $(document).ready(function(){

       
        $('#order_no').change(function(){

            $.get( 

                '<?php echo site_url("Disaster/js_getMemo_perDist_perWO");?>',
                { 

                    order_no: $(this).val(),
                    dist_cd : $('#dist_cd').val()

                }

            ).done(function(data){

                var string1 = '<option value="">Select Memo</option>';
                //var string2 = '<option value="">Select Memo</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string1 += '<option value="' + value.sdo_memo + '">' + value.sdo_memo + '</option>';
                    //string2 += '<option value="' + value.bdo_memo + '">' + value.bdo_memo + '</option>';

                });

                
                $('#sdo_memo').html(string1);
                //$('#bdo_memo').html(string2);

            });

        });


    });

</script>



<!-- To get "bdo_memo" as per District and WO and sdo_memo   -->
<script>

    $(document).ready(function(){

       
        $('#sdo_memo').change(function(){

            $.get( 

                '<?php echo site_url("Disaster/js_get_sdoMemo_perDist_WO_sdo");?>',
                { 

                    sdo_memo: $(this).val(),
                    dist_cd : $('#dist_cd').val(),
                    order_no : $('#order_no').val()

                }

            ).done(function(data){

                //var string1 = '<option value="">Select Memo</option>';
                var string2 = '<option value="">Select Memo</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    //string1 += '<option value="' + value.sdo_memo + '">' + value.sdo_memo + '</option>';
                    string2 += '<option value="' + value.bdo_memo + '">' + value.bdo_memo + '</option>';

                });

                
                //$('#sdo_memo').html(string1);
                $('#bdo_memo').html(string2);

            });

        });


    });

</script>



<!-- TO get Amount calculation as per rate  -->
<script>

    $(document).ready(function(){

        $('#tot_qty').change(function(){

            //console.log(1111);
            
            var tot_qty = $(this).val();
            var rate = $('#rate').val();
            
            var amount = parseFloat(rate*tot_qty).toFixed(2); // 2 decimal point
            $("#amount").val(amount);

        });


        $('#rate').change(function(){

            //console.log(1111);
            
            var tot_qty = $('#tot_qty').val();
            var rate = $(this).val();
            
            var amount = parseFloat(rate*tot_qty).toFixed(2); // 2 decimal point
            $("#amount").val(amount);

        });

    });

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



<!-- To Validate/ Check whather distributed tot_qnt exceeds distict allot_qty   -->
<script>
       
    var delAmount    =   document.forms["agent_delForm"]["tot_qty"];
    var qtyBal       =   document.forms["agent_delForm"]["qty_bal"];
   
    function validate()
    {
        if((parseInt(delAmount.value)) > (parseInt(qtyBal.value))) {
            
            //document.getElementById("qty").style.border = "1px solid red";

            tot_qty.style.border = "1px solid red";
            
            return false;

        }
        
    }

</script>


<!-- To add row in table -->
<!-- <script>

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
            
            $("#tot_qty").val('');
            var total = 0;
            $('.amount_cls').each(function(){
                total += +$(this).val();

            });
            $("#tot_qty").val(total);

        });

    });

</script> -->


<!-- For select2 js -->
<script>

    $(document).ready(function(){

        $("#dist_cd").select2();
        $("#point_no").select2();
        $("#order_no").select2();
        $("#sdo_memo").select2();
        $("#bdo_memo").select2();

    })

</script>


<!-- For generating info-table after agent selection -->
<script>

    $(document).ready(function(){

        $('#sdo_memo').on('change', function(){

            var distCd      =   $('#dist_cd').val();
            var pointNo     =   $('#point_no').val();
            var orderNo     =   $('#order_no').val();
            var sdoMemo     =   $('#sdo_memo').val();
            
            $.get('<?php echo site_url("Disaster/js_get_prev_deliveryDtls"); ?>', {distCd:distCd, pointNo:pointNo, orderNo:orderNo, sdoMemo:sdoMemo})
            .done(function(data){

                //console.log(data);
                var row = '';
                $.each(JSON.parse(data), function(index, value){

                    var billDt = (value.bill_dt).split('-').reverse().join('-');

                    row += '<tr>'
                                +'<td>'+value.bill_no+'</td>'
                                +'<td>'+billDt+'</td>'
                                +'<td>'+value.tot_qty+'</td>'
                            +'</tr>' ;

                })

                $('#info_table').html(row);

            })
            
        })

    })

</script>