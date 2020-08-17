<div class="wraper">      

    <div class="row">
    
        <form role="form" name="approve_form" method="POST" id="form" action="<?php echo site_url("Disaster/show_confirmationTable");?>" onsubmit="return validate()" >
        
            <div class="col-md-6 container form-wraper" style="margin-left: 0px;" > 

                <div class="form-header">
                
                    <h4>Confirmation Of Delivery</h4>
                
                </div>
                
                <div class="form-group row">

                    <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select type="text" name="dist_cd" class="form-control required" id="dist_cd" >
                            <option value= "0">Select District</option>
                            <?php
                                foreach($dist_data as $key)
                                { 
                                ?>
                                    <option value="<?php echo ($key->district_code); ?>"><?php echo ($key->district_name); ?></option>
                            <?php
                                }
                                ?>

                        </select>
                        <span id= "alert1" ><font color="red">*Please Select District First</font></span>

                    </div>
                    

                    <label for="order_no" class="col-sm-2 col-form-label">Order No:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select type="text" name="order_no" class="form-control required" id="order_no" >
                            <option value= "0">Select WO</option>
                            
                        </select>
                        <span id= "alert2" ><font color="red">*Please Select Order No</font></span>

                    </div>
            
                </div>

                <div class="form-group row">

                    <label for="sdo_memo" class="col-sm-2 col-form-label">Memo No:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select type="text" name="sdo_memo" class="form-control required" id="sdo_memo" >
                            <option value= "0">Select Memo No</option>

                        </select>
                        <span id= "alert3" ><font color="red">*Please Select Memo No</font></span>

                    </div>
                    
                    <!-- <label for="bill_no" class="col-sm-2 col-form-label">Bill No:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select type="text" name="bill_no" class="form-control required" id="bill_no" >
                            <option value= "0">Select Bill No</option>
                            
                        </select>
                        <span id= "alert4" ><font color="red">*Please Select Bill No</font></span>

                    </div> -->
            
                </div>

                <!-- <div class="form-group row">

                    <label for="point_no" class="col-sm-2 col-form-label">Agent:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select type="text" name="point_no" class="form-control required" id="point_no" >
                            <option value= "0">Select Agent</option>
                            
                        </select>
                        <span id= "alert5" ><font color="red">*Please Select Agent</font></span>

                    </div>
                    

                    <label for="allot_qty" class="col-sm-2 col-form-label">Alloted Qty(MT.):</label>

                    <div class="col-sm-4">

                        <input type="text" name="allot_qty" class="form-control required" id="allot_qty" >
                            
                    </div>
            
                </div> -->

                <div class="form-group row">

                    <label for="bill_from" class="col-sm-2 col-form-label">Bill No.(From)<font color="red">*</font></label>
                
                    <div class="col-sm-4"> 
                        <input type="text" name="bill_from" class="form-control required" id="bill_from" >                             
                    </div>

                    <label for="bill_to" class="col-sm-2 col-form-label">Bill No.(To)<font color="red">*</font></label>
                
                    <div class="col-sm-4"> 
                        <input type="text" name="bill_to" class="form-control required" id="bill_to" >                             
                    </div>

                </div>

                <div class="form-group row">

                    <label for="del_qty" class="col-sm-2 col-form-label">Delivered Qty(Qnt):</label>
                
                    <div class="col-sm-4"> 
                        <input type="text" name="del_qty" class="form-control required" id="del_qty" >                             
                    </div>

                    <!-- <label for="rate" class="col-sm-2 col-form-label">Rate (Per Qnt):</label>
                
                    <div class="col-sm-4"> 
                        <input type="text" name="rate" class="form-control required" id="rate" >                             
                    </div> -->

                </div>


                <div class="form-group row">

                    <label for="cnf_dt" class="col-sm-2 col-form-label">Confirmation Date:<font color="red">*</font></label>
                
                    <div class="col-sm-4"> 
                        <input type="date" name="cnf_dt" class="form-control required" id="cnf_dt" required>                             
                    </div>

                    <label for="cnf_memo" class="col-sm-2 col-form-label">Confirmation Memo:<font color="red">*</font></label>
                
                    <div class="col-sm-4"> 
                        <input type="text" name="cnf_memo" class="form-control required" id="cnf_memo" required>                             
                    </div>

                </div>

                <div class="form-group row">

                    <label for="cnf_qty" class="col-sm-2 col-form-label">Confirmed Qty:<font color="red">*</font></label>
                
                    <div class="col-sm-4"> 
                        <input type="text" name="cnf_qty" class="form-control required" id="cnf_qty" required>                             
                    </div>         

                </div>
                

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Proceed" />

                    </div>

                </div>

            </div>

            <div class="col-md-5 container form-wraper" style="margin-left: 10px; width: 48%;" > 

                <div class="form-header">
                
                    <h4>Previous Confirmation Details</h4>
                
                </div>

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th>Date</th>
                            <th>Memo No</th>
                            <th>Confirmed Qty(Qnt)</th>

                        </tr>

                    </thead>

                    <tbody id= "confirmation" >
                    
                    </tbody>
                    
                    <tfoot id= "tot_cnf">
                    
                    </tfoot>

                </table>


            </div>

        </form>
    
    </div>

</div>


<!-- To check whather in selected distict any unapproved data is there or not  -->
<!--
<script>

    $(document).ready(function(){

        $("#alert1").hide();

        $('#dist_cd').change(function(){

            $.get( 

                '<?php //echo site_url("Disaster/js_get_unapproved_data");?>',
                { 

                    dist_cd: $(this).val()
                    
                }

            )
            .done(function(data){

                //console.log(data);
                var data = JSON.parse(data);

                //console.log(data);
                if(data.length == 0)
                {   
                    $("#alert1").show();
                    //return false;
                }
                else
                {   
                    $("#alert1").hide();
                    //return true;
                }

                
            });

        });

    });


</script>
--> 


<!-- To Check empty Field  -->
<script>

    var dist_cd    =   document.forms["approve_form"]["dist_cd"];
    $("#alert1").hide();
    var order_no    =   document.forms["approve_form"]["order_no"];
    $("#alert2").hide();
    var sdo_memo    =   document.forms["approve_form"]["sdo_memo"];
    $("#alert3").hide();
    var bill_no    =   document.forms["approve_form"]["bill_no"];
    $("#alert4").hide();
    var point_no    =   document.forms["approve_form"]["point_no"];
    $("#alert5").hide();
    

    function validate()
    {
        //console.log(dist_cd.value);
        //return false;

        if(dist_cd.value == "0")
        {
            dist_cd.style.border = "1px solid red";
            //total.focus();
            $("#alert1").show();

            return false;
        }
        else if(order_no.value == "0")
        {
            order_no.style.border = "1px solid red";            
            $("#alert2").show();            
            return false;
        }
        else if(sdo_memo.value == "0")
        {
            sdo_memo.style.border = "1px solid red";            
            $("#alert3").show();            
            return false;
        }
        else if(bill_no.value == "0")
        {
            bill_no.style.border = "1px solid red";            
            $("#alert4").show();            
            return false;
        }
        else if(point_no.value == "0")
        {
            point_no.style.border = "1px solid red";            
            $("#alert5").show();            
            return false;
        }
        else
        {
            return true;
        }

    }

</script>


<!-- to get WO as per dist selection -->
<script>

    $(document).ready(function(){

        $('#dist_cd').change(function(){

            $.get( 
                '<?php echo site_url("Disaster/js_get_orderNo_perDist");?>',
                { 
                    dist_cd: $(this).val()
                }
            )
            .done(function(data){

                var string = '<option value="0">Select WO</option>';

                $.each(JSON.parse(data), function( index, value ) {
                    
                    var order_dt = value.order_dt; 
                    var parts = order_dt.split('-');
                    var myOrder_dt = parts[2] + '-' + parts[1] + '-' + parts[0]; // to change date formate

                    string += '<option value="' + value.order_no + '">' + value.order_no + ' DT '+ myOrder_dt +'</option>'
                    
                });
                
                var newElement = '<select class="form-control" name="order_no" id="order_no"> '+ string +' </select>'; 

                $("#order_no").html(newElement);
            });

        });

    });


</script>


<!-- To get sdo_memo as per order_no selection  -->
<script>

    $(document).ready(function(){

        $('#order_no').change(function(){

            $.get( 
                '<?php echo site_url("Disaster/js_get_sdoMemo_perOrder");?>',
                { 
                    order_no: $(this).val(),
                    dist_cd: $('#dist_cd').val()

                }
            )
            .done(function(data){

                var string = '<option value="0">Select Memo No</option>';

                $.each(JSON.parse(data), function( index, value ) {
                    
                    string += '<option value="'+ value.sdo_memo+'">'+value.sdo_memo+'</option>'
                    
                });
                
                var newElement = '<select class="form-control" name="order_no" id="order_no"> '+ string +' </select>'; 

                $("#sdo_memo").html(newElement);
            });

        });

    });


</script>


<!--  To get bill_no as per sdo_memo selected   -->
<script>

    $(document).ready(function(){

        $('#sdo_memo').change(function(){

            $.get( 
                '<?php echo site_url("Disaster/js_get_billNo_perMemo");?>',
                { 
                    sdo_memo: $(this).val(),
                    dist_cd: $('#dist_cd').val(),
                    order_no: $('#order_no').val()

                }

            )
            .done(function(data){

                var string = '<option value="0">Select Bill No</option>';
                //console.log(data);

                $.each(JSON.parse(data), function( index, value ) {
                    
                    string += '<option value="' + value.bill_no + '">' + value.bill_no + '</option>'
                    
                });
                
                var newElement = '<select class="form-control" name="order_no" id="order_no"> '+ string +' </select>'; 

                $("#bill_no").html(newElement);
            });

        });

    });


</script>


<!--  To get agent as per bill_no selection  -->
<!-- <script>

    $(document).ready(function(){

        $('#bill_no').change(function(){

            $.get( 
                '<?php //echo site_url("Disaster/js_get_agent_asPer_billNo");?>',
                { 
                    bill_no: $(this).val(),
                    dist_cd: $('#dist_cd').val(),
                    order_no: $('#order_no').val(),
                    sdo_memo: $('#sdo_memo').val()

                }
            )
            .done(function(data){

                var string = '<option value="0">Select Agent</option>';
                //console.log(data);

                $.each(JSON.parse(data), function( index, value ) {
                    
                    string += '<option value="' + value.point_no + '">' + value.agent + '</option>'
                    
                });
                
                var newElement = '<select class="form-control" name="order_no" id="order_no"> '+ string +' </select>'; 

                $("#point_no").html(newElement);
            });

        });

    });


</script> -->


<!--  To get alloted qty after agent selection  -->
<!-- <script>

    $(document).ready(function(){

        $('#point_no').change(function(){

            $.get( 
                '<?php //echo site_url("Disaster/js_agent_allotQty"); ?>',
                { 

                    point_no: $(this).val(),
                    order_no: $('#order_no').val(),
                    dist_cd : $('#dist_cd').val(),
                    sdo_memo: $('#sdo_memo').val()
                    
                }
            )
            .done(function(data){

                console.log(data);
                var qtyData = JSON.parse(data);

                $('#allot_qty').val(qtyData.allot_qty);

            });

        });

    });

</script> -->


<!--  To get total delivered qty after agent selection  -->
<script>

    $(document).ready(function(){

        $('#bill_to').change(function(){

            $.get( 
                '<?php echo site_url("Disaster/js_agent_del_totQty"); ?>',
                { 

                    bill_from: $('#bill_from').val(),
                    bill_to: $(this).val(),
                    order_no: $('#order_no').val(),
                    dist_cd : $('#dist_cd').val(),
                    sdo_memo: $('#sdo_memo').val()
                    
                }
            )
            .done(function(data){

                console.log(data);

                var del_qtyData = JSON.parse(data);

                $('#del_qty').val(del_qtyData.tot_qty);

            });

        });

    });

</script>



<!--   To get rate after selecting rate as per the bill no  -->
<script>

    $(document).ready(function(){

        $('#point_no').change(function(){

            $.get( 
                '<?php echo site_url("Disaster/js_agent_del_rate"); ?>',
                { 

                    point_no: $(this).val(),
                    order_no: $('#order_no').val(),
                    //dist_cd : $('#dist_cd').val(),
                    sdo_memo: $('#sdo_memo').val(),
                    bill_no: $('#bill_no').val()
                }
            )
            .done(function(data){

                //console.log(data);
                var rateData = JSON.parse(data);

                $('#rate').val(rateData.rate);

            });

        });

    });

</script>


<!-- To get previous confirmation details for the same bill no.  -->
<script>

    $(document).ready(function(){

        $('#bill_no').change(function(){
            
                var    bill_no = $(this).val();
                var    dist_cd = $('#dist_cd').val();
                var    order_no= $('#order_no').val();
                var    sdo_memo= $('#sdo_memo').val();

            $.get( '<?php echo site_url("Disaster/js_get_previous_cnfDtls"); ?>',
                { 
                    bill_no: $(this).val(),
                    dist_cd : $('#dist_cd').val(),
                    order_no: $('#order_no').val(),
                    sdo_memo: $('#sdo_memo').val()
                }
            )
            .done(function(data) {

                //console.log(data);
                var cnfDtls = JSON.parse(data);
                //console.log(cnfDtls);

                var tot_cnfQty = 0;

                for (var key in cnfDtls) 
                {
                    var value = cnfDtls[key];

                    var dummy = value.cnf_qty * 1;
                    tot_cnfQty = tot_cnfQty + dummy;

                    var date = value.cnf_dt.split('-');
                    //console.log(tot_cnfQty.toFixed(6));
                    var body_eliment = ' <tr>'+'<td>'+date[2]+'-'+date[1]+'-'+date[0]+'</td>'+'<td>'+value.cnf_memo+'</td>'+'<td>'+value.cnf_qty+'</td>'+'</tr>';
                    
                    $("#confirmation").append($(body_eliment));

                }

                //console.log(tot_cnfQty);
                var footer_element = '<tr><td colspan="2"><strong>TOTAL</strong></td><td colspan="2"><strong>'+tot_cnfQty.toFixed(6)+'</strong></td></tr>'
                $("#tot_cnf").append($(footer_element));

            });

        });

    });

</script>

