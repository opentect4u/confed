
<div class="wraper">      

    <div class="col-md-7 container form-wraper">

        <form role="form" name="agent_distForm" method="POST" id="form" action="<?php echo site_url("Disaster/updateAgentDistribution");?>" onsubmit="return validate()" >
        
            <div class="form-header">
            
                <h4>Add New Distribution</h4>
            
            </div>

            <?php
                foreach($data1 as $eData)
                { ?>

                    <input type="hidden" value= "<?php echo $sl_no; ?>" name= "sl_no" id= "sl_no" >

                    <div class="form-group row">

                        <label for="dist_dt" class="col-sm-2 col-form-label">Date:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="date" name="dist_dt" value= "<?php echo $eData->dist_dt ?>" class="form-control required" id="dist_dt" readonly/>
                
                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <select type="text" name="dist_cd" class="form-control required" id="dist_cd" readonly >

                                <option value= "<?php echo ($eData->district_code); ?>"><?php echo ($eData->district_name); ?></option>

                            </select>

                        </div>

                        <label for="order_no" class="col-sm-2 col-form-label">W.O No:<font color="red">*</font></label>

                        <div class="col-sm-4">

                          <!--  <input type="text" name="order_no" value= "<?php// echo $eData->order_no.' DT '. $order_dt->order_dt ; ?>" class="form-control required" id="order_no" readonly/> -->
                            <select type="text" name="order_no" class="form-control required" id="order_no" readonly>
                                <option value= "<?php echo $eData->order_no; ?>"><?php echo $eData->order_no.' DT '. @$orderDt->order_dt ; ?></option>
                                
                            </select> 

                        </div>

                    </div>
                
                <?php foreach($totalQty as $tot_key) { ?>                
                    
                    <div class="form-group row">

                        <label for="tot_dist_qty" class="col-sm-2 col-form-label">Quantity(M.T):<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <input type="text" name="tot_dist_qty" value= "<?php echo (@$tot_key->allot_qty); ?>" class="form-control required" id="tot_dist_qty" readonly />
                
                        </div>

                        
                    </div>

                <?php } ?>

                    <div class="form-group row">

                        <label for="sdo_memo" class="col-sm-2 col-form-label">SDO Memo:</label>

                        <div class="col-sm-4">

                            <input type="text" name="sdo_memo" value= "<?php echo $eData->sdo_memo; ?>" class="form-control" id="sdo_memo" />
                
                        </div>

                        <label for="bdo_memo" class="col-sm-2 col-form-label">BDO Memo:</label>

                        <div class="col-sm-4">

                            <input type="text" name="bdo_memo" value= "<?php echo $eData->bdo_memo; ?>" class="form-control " id="bdo_memo" />
                
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

                                    <?php foreach($data2 as $key){ ?>

                                    <tr>
                                        <td>
                                        
                                            <select class="form-control" name="point_no[]" id="point_no" readonly >
                                                
                                                <option value= "<?php echo ($key->point_no); ?>"><?php echo ($key->agent) ; ?></option>                                              
                                            
                                            </select>
                                        
                                        </td>
                                        
                                        <td>
                                            
                                            <input name="allot_qty[]" id="allot_qty" value= "<?php echo  number_format(($key->allot_qty),3); ?>" class="form-control amount_cls" placeholder="Amount" required>
                                            
                                        </td>

                                    </tr>

                                    <?php } ?>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td>
                                            <strong>Total:</strong>
                                        </td>
                                        <td colspan="2">
                                            <input name="total" id="total" value= "<?php echo number_format($total->total,3); ?>" class="form-control" placeholder="Total">  
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>

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

                 // <!  string += '<option value="' + value.point_no + '">' + value.agent + '- '+ (value.sdo) +'</option>'-->
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

                console.log(data);
                var tot_dist_qty = JSON.parse(data);

                $('#tot_dist_qty').val(tot_dist_qty.allot_qty);

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

                $.each(JSON.parse(data), function( index, value ) {

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

<!-- To Check whather it is a duplicate entry for same point_no for same order_no -->

<!-- 
<script>

    $(document).ready(function(){

        $('#point_no').click(function(){

            console.log(1111);

            $.get( 

                '<?php// echo site_url("Disaster/js_duplicatePoint");?>',
                { 

                    order_no : $('#order_no').val(),
                    dist_cd : $('#dist_cd').val(),
                    point_no : $(this).val()

                    //console.log(order_no);    

                }

            )
            .done(function(data){

                console.log(data);

                var ck_point_no = JSON.parse(data);
                //console.log(ck_point_no);

                if(ck_point_no)
                {
                    alert(Sorry! Duplicate Agent Selected.);
                    return false;
                }

            });

        });

    });

</script> -->



<!-- To Validate/ Check whather distributed tot_qrt exceeds distict allot_qty   -->

<script>

    var agentTot    =   document.forms["agent_distForm"]["total"];
    var distTot     =   document.forms["agent_distForm"]["tot_dist_qty"];

    function validate()
    {

        /* if(agentTot.value > distTot.value)
        {
            total.style.border = "1px solid red";
            //total.focus();
            return false;
        } */

        return true;
    }

</script>