
<div class="wraper">      

    <div class="col-md-7 container form-wraper">

        <form role="form" name="agent_distForm" method="POST" id="form" action="<?php echo site_url("Disaster/entryAgentDistribution");?>" onsubmit="return validate()" >
        
            <div class="form-header">
            
                <h4>Add Agent Distribution</h4>
            
            </div>

                    <div class="form-group row">

                        <label for="dist_dt" class="col-sm-2 col-form-label">Date:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="date" name="dist_dt" class="form-control required" id="dist_dt" />
                
                        </div>

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
                        <input type="hidden" name="sl_no" class="form-control required" value= "<?php echo ($slNo_data->sl_no) + 1; ?>" /> 
                        
                    </div>
                    

                    <div class= "form-group row">

                        <label for="tot_dist_qty" class="col-sm-2 col-form-label">Quantity(M.T):<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="text" name="tot_dist_qty" class="form-control required" id="tot_dist_qty" readonly />
                
                        </div>

                        <!-- <label for="tot_dist_qty_qnt" class="col-sm-2 col-form-label">Quantity(Qnt):<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="text" name="tot_dist_qty_qnt" class="form-control required" id="tot_dist_qty_qnt" readonly />
                
                        </div> -->

                    </div>


                    <div class="form-group row">

                        <label for="sdo_memo" class="col-sm-2 col-form-label">SDO Memo:</label>

                        <div class="col-sm-4">

                            <input type="text" name="sdo_memo" class="form-control" id="sdo_memo" />
                
                        </div>

                        <label for="bdo_memo" class="col-sm-2 col-form-label">BDO Memo:</label>

                        <div class="col-sm-4">

                            <input type="text" name="bdo_memo" class="form-control " id="bdo_memo" />
                
                        </div>

                    </div>
            
            <div class="row" style ="margin: 5px;">

                <div class="form-group"> 

                    <table class="table table-striped table-bordered table-hover">
                        
                        <thead>
                            
                            <tr>
                                <th>Agent</th>
                                <th>Allotment Qty(MT)</th>
                                <th><button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                
                            </tr>

                        </thead>
                            
                        <tbody id= "intro">
                        
                            <tr>
                                <td>
                                
                                    <select class="form-control" name="point_no[]" id="point_no" required >
                                        
                                        <option value= "">Select Agent</option>                                              
                                    
                                    </select>
                                
                                </td>
                                
                                <td>
                                    
                                    <input name="allot_qty[]" id="allot_qty" class="form-control amount_cls" placeholder="Amount" required>
                                    
                                </td>

                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td>
                                    <strong>Total:</strong>
                                </td>
                                <td colspan="2">
                                    <input name="total" id="total" class="form-control" placeholder="Total">  
                                </td>
                            </tr>
                        </tfoot>

                    </table>

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

<!-- To get Agents of as per District -->
<script>

    $(document).ready(function(){

        var i = 1;

        $('#dist_cd').change(function(){

            $.get( 

                '<?php echo site_url("Disaster/js_agent");?>',
                { 

                    dist_cd: $(this).val()

                }

            ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.point_no + '">' + value.agent + '- '+ (value.bdo_name) +'</option>'

                });

                
                $('#point_no').html(string);

            });

        });


    });

</script>

<!-- To get total alloted amount of A District as per WO No -->
<script>

    $(document).ready(function(){

        var i = 2;

        $('#order_no').change(function(){

            $.get( 

                '<?php echo site_url("Disaster/js_dist_allotQty");?>',
                { 

                    order_no: $(this).val(),
                    //dist_cd: $(this).val(),
                    dist_cd : $('#dist_cd').val()
                    
                }

            )
            .done(function(data){

                //console.log(data);
                var parseData = JSON.parse(data);
                var allotQty = parseData[0].allot_qty;
                var allotQty_qnt = parseData[0].allot_qty_qnt;
                
                //console.log(parseData);
                // console.log(parseData[0].allot_qty);
                // console.log(parseData[0].allot_qty_qnt);

                $('#tot_dist_qty').val(allotQty);
                $('#tot_dist_qty_qnt').val(allotQty_qnt);

            });

        });

    });

</script>


<!-- for WO Selection As per dist_cd  -->
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

<!-- JS for Table   -->
<script>

    $(document).ready(function(){

        // to calculate the total of amount rows

        $('#intro').on( "change", ".amount_cls", function(){

            $("#total").val('');
            var total = 0;
            $('.amount_cls').each(function(){
                total += +$(this).val();
            });
            $("#total").val(total);
        
        });

        // to add row -->
        
        $("#addrow").click(function(){

            // to set select options as per selected district --> 

            $.get( 

                '<?php echo site_url("Disaster/js_agent");?>',
                { 

                    dist_cd : $('#dist_cd').val()

                }

            ).done(function(data){

                var string = '<option value="">Select</option>';
                //console.log(data);
                $.each(JSON.parse(data), function( index, value ) {

                    //console.log(value.bdo_name);

                    string += '<option value="' + value.point_no + '">' + value.agent + '- '+ (value.bdo_name) +'</option>'

                   // var newElement = '<tr><td><select class="form-control" name="point_no[]" id="point_no"><option value=" ' + value.point_no + ' ">' + value.agent + '- '+ (value.sdo) +'</option>   </select></td><td><input name="allot_qty[]" id="allot_qty" class="form-control amount_cls" placeholder="Amount" required></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>'; 

                });

                var newElement = '<tr><td><select class="form-control" name="point_no[]" id="point_no"> '+ string +' </select></td><td><input name="allot_qty[]" id="allot_qty" class="form-control amount_cls" placeholder="Amount" required></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>'; 

                $("#intro").append(newElement);
                //$('#intro').html(newElement);
                

            });            
                                 
                            
        });
        

        // to remove any added row
        
        $("#intro").on("click","#removeRow", function(){
            $(this).parent().parent().remove();
            $('.amount_cls').change();
        });


    });


</script>


<script>

    $(document).ready(function(){

        $('#intro').on("change", ".amount_cls", function(){

            var tot_dist_qty_qnt    =   $('#tot_dist_qty_qnt').val();
            var total               =   $('#total').val();

            // console.log(tot_dist_qty_qnt);
            // console.log(total);

            if(parseFloat(total) > parseFloat(tot_dist_qty_qnt))
            {
                $('#total').css('border-color', 'red');
                $('#submit').prop('disabled', true);
                return false;
            }
            else
            {
                $('#submit').prop('disabled', false);
                return true;
            }

        })

    })

</script>