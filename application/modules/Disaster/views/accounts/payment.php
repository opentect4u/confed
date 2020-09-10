
<div class="wraper">      

    <div class="col-md-7 container form-wraper">
    
        <form role="form" name="payment_form" method="POST" id="form" action="<?php echo site_url("Disaster/paymentDtlsEntry");?>" onsubmit="return validate()" >
        
            
            <div class="form-header">
            
                <h4>Payment Details Entry</h4>
            
            </div>
            
            <div class="form-group row">

                <label for="mr_no" class="col-sm-2 col-form-label">MR No:<font color="red">*</font></label>

                <div class="col-sm-4">
                    <input type="text" name="mr_no" class="form-control required" id="mr_no" required>
                </div>
                
                <label for="date" class="col-sm-2 col-form-label">Date:</label>
            
                <div class="col-sm-4"> 
                    <input type="date" name="date" class="form-control required" id="date" required>                             
                </div>

            </div>

            <div class="form-group row">
                
                <label for="memo_no" class="col-sm-2 col-form-label">Memo no:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select type="text" name="memo_no" class="form-control" id="memo_no" required>
                        <option value="">Select Memo</option>
                        <?php
                            foreach($memo as $key1)
                            { 
                            ?>
                                <option value="<?php echo ($key1->memo_no); ?>"><?php echo ($key1->memo_no); ?></option>
                        <?php
                            }
                            ?>

                    </select>
                    
                </div>
                
                
                <label for="bank" class="col-sm-2 col-form-label">Bank:<font color="red">*</font></label>
                
                <div class="col-sm-4"> 
                    <select type="text" name="bank" class="form-control required" id="bank" >
                    <option value= "0">Select Bank</option>
                    <?php foreach($bank as $key2){ ?>
                        <option value="<?php echo $key2->sl_no; ?>"><?php echo $key2->bank_name; ?></option>
                    <?php } ?>
                    </select>
                </div>
                

            </div>
               <div class="form-group row">

                <label for="tot_credited" class="col-sm-2 col-form-label">Amount Credited(Rs):<font color="red">*</font></label>
            
                <div class="col-sm-4"> 
                    <input type="text" name="tot_credited" class="form-control required" id="tot_credited" placeholder= "00.00" required>                             
                </div>
                
                <label for="cr_dt" class="col-sm-2 col-form-label">Credited Date:<font color="red">*</font></label>
            
                <div class="col-sm-4"> 
                    <input type="date" name="cr_dt" class="form-control required" id="cr_dt" placeholder= "00.00" required>                             
                </div>
                
            </div>
            <div class="form-group row">
                 <label for="pb_amnt" class="col-sm-2 col-form-label">PB Amount(Rs.):</label>
            
                <div class="col-sm-4"> 
                    <input type="text" name="pb_amnt" class="form-control required" id="pb_amnt" placeholder= "00.00" readonly>                             
                </div>

                <label for="bill_amnt" class="col-sm-2 col-form-label">SB Amount(Rs.):</label>
            
                <div class="col-sm-4"> 
                    <input type="text" name="bill_amnt" class="form-control required" id="bill_amnt" placeholder= "00.00" readonly>                             
                </div>
                <!-- <span id= "alert4" ><font color="red">*Please Select Rate First</font></span>                 -->

               

            </div>

            <div class="form-group row">

                <label for="commission" class="col-sm-2 col-form-label">Commission (Rs):<font color="red">*</font></label>
            
                <div class="col-sm-4"> 
                    <input type="text" name="commission" class="form-control required" id="commission" placeholder= "00.00" required>                             
                </div>

            </div>

            

            <div class="form-group row">

                <label for="less" class="col-sm-2 col-form-label">Less (Rs)(If Any):</label>
            
                <div class="col-sm-4"> 
                    <input type="text" name="less" class="form-control required" id="less" placeholder= "00.00" >                             
                </div>

                <label for="naration" class="col-sm-2 col-form-label">Naration(If Any Less):</label>
            
                <div class="col-sm-4"> 
                    <textarea name="naration" id="naration" class="form-control" cols="20" rows="2"></textarea>                             
                </div>

            </div>

            <div class="form-group row">

                <label for="tot_payable" class="col-sm-2 col-form-label">Payable Amount (Rs):<font color="red">*</font></label>
            
                <div class="col-sm-4"> 
                    <input type="text" name="tot_payable" value= "00.00" class="form-control required" id="tot_payable" required>                             
                </div>

            </div>

            <div class="form-group row">

                <label for="vendor" class="col-sm-2 col-form-label">Vendor:<font color="red">*</font></label>
            
                <div class="col-sm-10"> 

                    <select name="vendor" id="vendor" class= "form-control required" required>
                        <option value="">Select Vendor</option>
                        <?php foreach($vendor as $key2){ ?>
                        <option value="<?php echo $key2->sl_no; ?>"><?php echo $key2->vendor_name; ?></option>
                        <?php } ?>
                    </select>

                </div>

            </div>

            <div class="form-group row">

                <label for="Remarks" class="col-sm-2 col-form-label">Remarks:</label>
                <div class="col-sm-10">
                    <textarea name="remarks" id="remarks" class="form-control required" cols="30" rows="2"></textarea>
                </div>

            </div>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Proceed" />

                </div>

            </div>

    
        </form>
    
    </div>

</div>


<!-- To Check empty Field  -->
<script>

    // var dist_cd    =   document.forms["payment_form"]["dist_cd"];
    // $("#alert1").hide();
    // var order_no    =   document.forms["payment_form"]["order_no"];
    // $("#alert2").hide();
    // var bill_no    =   document.forms["payment_form"]["bill_no"];
    // $("#alert3").hide();
    // var rate        =   document.forms["payment_form"]["rate"];
    // $("#alert4").hide();
    // var cgst        =   document.forms["payment_form"]["cgst"];
    // $("#alert5").hide();
    // var sgst        =   document.forms["payment_form"]["sgst"];
    // $("#alert6").hide();
    // var mode        =   document.forms["payment_form"]["mode"];
    // $("#alert7").hide();
    

    // function validate()
    // {
    //     console.log(cgst.value);
    //     //return false;

    //     if(dist_cd.value == "0")
    //     {
    //         dist_cd.style.border = "1px solid red";
    //         //total.focus();
    //         $("#alert1").show();

    //         return false;
    //     }
    //     else if(order_no.value == "0")
    //     {
    //         order_no.style.border = "1px solid red";            
    //         $("#alert2").show();            
    //         return false;
    //     }
    //     else if(bill_no.value == "0")
    //     {
    //         bill_no.style.border = "1px solid red";            
    //         $("#alert3").show();            
    //         return false;
    //     }
    //     else if(rate.value == '')
    //     {
    //         rate.style.border = "1px solid red";            
    //         $("#alert4").show();            
    //         return false;
    //     }
    //     else if(cgst.value == '')
    //     {
    //         cgst.style.border = "1px solid red";            
    //         $("#alert5").show();            
    //         return false;
    //     }
    //     else if(sgst.value == '')
    //     {
    //         sgst.style.border = "1px solid red";            
    //         $("#alert6").show();            
    //         return false;
    //     }
    //     else if(mode.value == "0")
    //     {
    //         mode.style.border = "1px solid red";            
    //         $("#alert7").show();            
    //         return false;
    //     }
    //     else
    //     {
    //         return true;
    //     }

    // }

</script>


<!--  To get bill amount as per memo_no selection   -->
<script>

    $(document).ready(function(){

        $('#memo_no').select2();
        $('#bank').select2();

        $(document).ready(function(){

            $('#memo_no').on('change', function(){

                var memoNo= $(this).val();

                $.get('<?php echo site_url("Disaster/js_get_billAmnt_formemoNo"); ?>', {memo_no:memoNo})
                .done(function(data){

                    var result = JSON.parse(data);
                    //console.log(result[0].bill_amount);
                    var billAmnt = result[0].bill_amount;
                    var pbAmnt = result[0].pb_amount;
                    var commissionAmnt = parseFloat(billAmnt)-parseFloat(pbAmnt);
                    $('#bill_amnt').val(billAmnt);
                    $('#pb_amnt').val(pbAmnt);
                    $('#commission').val(parseFloat(commissionAmnt).toFixed('2'));

                    // For getting payable amount by giving amount credited --
                    $('#tot_credited').on('change', function(){

                        var totCrtdAmnt = $(this).val();
                        var totpayableAmnt = parseFloat(totCrtdAmnt)-parseFloat(commissionAmnt);
                        $('#tot_payable').val(parseFloat(totpayableAmnt).toFixed('2'));

                        // For calculating payable amount for Less--
                        $('#less').on('change', function(){

                            var less = $(this).val();
                            var finalAmnt = parseFloat(totpayableAmnt)-parseFloat(less);
                            $('#tot_payable').val(parseFloat(finalAmnt).toFixed('2'));

                        })


                        // For calculating payable amount for commission--
                        // $('#commission').on('change', function(){

                        //     var commission = $(this).val();
                        //     var totCredited = $('#tot_credited').val();
                        //     var payableAmnt = parseFloat(totCredited)-parseFloat(commission);
                        //     $('#tot_payable').val(parseFloat(payableAmnt).toFixed('2'));

                        // })

                    })

                })

            })

        })

    });

</script>


<!-- If less amount is being given-- naration is required -->
<script>

    $(document).ready(function(){

        $('#less').on('change', function(){

            var less = $(this).val();
            if(less != '')
            {
                $('#naration').prop('required', true);
            }
            else
            {
                $('#naration').prop('required', false);
            }

        })

    })

</script>


<!-- For duplicate mr no and memo_no -->
<script>

    $(document).ready(function(){

        $('#mr_no').on('change', function(){

            var mrNo = $(this).val();
            $.get('<?php echo site_url("Disaster/js_check_duplicateMrNo"); ?>', {mr_no:mrNo})
            .done(function(data){

                var result = JSON.parse(data);
                if(result.num_row != '0')
                {
                    alert('Mr No. Exist...');
                }

            })

        })

        $('#memo_no').on('change', function(){

            var memoNo = $(this).val();
            $.get('<?php echo site_url("Disaster/js_check_duplicateMemoNo") ?>', {memo_no:memoNo})
            .done(function(data){

                var result = JSON.parse(data);
                if(result.num_row != '0')
                {
                    alert('Memo No. Exist...');
                }

            })

        })

    })

</script>