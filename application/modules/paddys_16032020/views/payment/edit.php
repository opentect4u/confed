<div class="wraper">      

    <div class="col-md-12 container form-wraper" style="margin-left: 0px;">

        <form method="POST" 
            id="form"
            action="<?php echo site_url("paddy/payment/edit");?>" >

            <div class="form-header">
            
                <h4>Millers Payment Edit</h4>
            
            </div>

            <input type="hidden" name="pmt_bill_no" value="<?php echo $this->input->get('pmt_bill_no'); ?>">

            <div class="form-group row">

                <label for="dist" class="col-sm-1 col-form-label">District:</label>

                <div class="col-sm-5">

                    <select name="dist" id="dist" class="form-control required">

                        <option value="">Select</option>

                        <?php

                            foreach($dist as $dlist){

                        ?>

                            <option value="<?php echo $dlist->district_code;?>"
                            <?php echo ($dlist->district_code == $payment_dtls->dist)?'selected':'';?>
                            ><?php echo $dlist->district_name;?></option>

                        <?php

                            }

                        ?>     

                    </select>

                </div>

                <label for="block" class="col-sm-1 col-form-label">Block:</label>

                <div class="col-sm-5">

                    <select name="block" id="block" class="form-control required">

                        <option value="">Select</option>    

                        <option value="">Select District First</option>    

                    </select>

                </div>

            </div>

            <div class="form-group row">

                <label for="soc_name" class="col-sm-1 col-form-label">Society Name:</label>

                <div class="col-sm-5">

                    <select type="text"
                        class="form-control required sch_cd"
                        name="soc_name"
                        id="soc_name"
                        >

                        <option value="">Select</option>    

                        <option value="">Select Block First</option>    

                    </select>    

                </div>

                <label for="mill_name" class="col-sm-1 col-form-label">Mill Name:</label>

                <div class="col-sm-5">

                    <select type="text"
                        class="form-control required sch_cd"
                        name="mill_name"
                        id="mill_name"
                    >

                        <option value="">Select</option>    

                        <option value="">Select District First</option>    

                    </select>

                </div>

            </div>  
            
            <div class="form-group row">

                <label for="totPaddy" class="col-sm-1 col-form-label">Total Paddy:</label>

                <div class="col-sm-5">

                    <input type="text"
                            class="form-control required"
                            name="totPaddy"
                            id="totPaddy"
                            value="<?php echo $payment_dtls->tot_paddy; ?>"
                        />

                </div>

                <label for="totCmr" class="col-sm-1 col-form-label">Total CMR:</label>

                <div class="col-sm-5">

                    <input type="text"
                            class="form-control required"
                            name="totCmr"
                            id="totCmr"
                            value="<?php echo $payment_dtls->tot_cmr; ?>"
                        />

                </div>

            </div>

            <div class="form-group row">

                <label for="trans_dt" class="col-sm-1 col-form-label">Transaction Date:</label>

                <div class="col-sm-5">

                    <input type="date"
                            class="form-control required"
                            name="trans_dt"
                            id="trans_dt"
                            value="<?php echo $payment_dtls->trans_dt; ?>"
                        />

                </div>

                <label for="rice_type" class="col-sm-1 col-form-label">Rice Type:</label>

                <div class="col-sm-5">

                    <select class="form-control required"
                            name="rice_type"
                            id="rice_type"
                        >

                        <option>Select</option>

                        <option value="P" <?php echo ($payment_dtls->rice_type == 'P')?'selected':''; ?>>Par Boiled Rice</option>

                        <option value="R" <?php echo ($payment_dtls->rice_type == 'R')?'selected':''; ?>>Raw Rice</option>

                    </select>    

                </div>

            </div>

            <div class="form-group row">

                <label for="pool_type" class="col-sm-1 col-form-label">Pool Type:</label>

                <div class="col-sm-5">

                    <select class="form-control required"
                            name="pool_type"
                            id="pool_type"
                        >

                        <option>Select</option>

                        <option value="S" <?php echo ($payment_dtls->pool_type == 'S')?'selected':''; ?>>State Pool</option>

                        <option value="C" <?php echo ($payment_dtls->pool_type == 'C')?'selected':''; ?>>Central Pool</option>

                    </select>    

                </div>

            </div>

            <div class="form-header">
            
                <h4>Bills</h4>
            
            </div>
            
            <table class="table">

                <thead>

                    <tr>
                        
                        <th>Millers <br> Bill No.</th>
                        <th>Date</th>
                        <th>Confed Bill No.</th>
                        <th>Date</th>
                        <th>Quantity of Paddy <br>(Qtls)</th>
                        <th>Quantity of CMR<br>(Qtls)</th>
                        <th>Total Butta</th>
                        <th><button type="button" class="btn btn-success addAnother"><i class="fa fa-plus"></i></button></th>

                    </tr>

                </thead>

                <tbody id="intro" class="tables">

                    <?php
                        $flag = false;
                        foreach($bill_dtls as $b_dtls){
                    ?>

                        <tr>
                            <td><input type="text" 
                                    class="form-control mill_bill_no required" 
                                    name="mill_bill_no[]"
                                    value="<?php echo $b_dtls->mill_bill_no; ?>"
                                    >
                                    
                            </td>
                            <td><input type="date" 
                                    class="form-control mill_bill_date required" 
                                    name="mill_bill_date[]"
                                    value="<?php echo $b_dtls->mill_bill_dt; ?>"
                                    >
                            </td>
                            <td><input type="text" 
                                    class="form-control confed_bill_no required" 
                                    name="confed_bill_no[]"
                                    value="<?php echo $b_dtls->con_bill_no; ?>"
                                    >
                                    
                            </td>
                            <td><input type="date" 
                                    class="form-control confed_bill_date required" 
                                    name="confed_bill_date[]"
                                    value="<?php echo $b_dtls->con_bill_dt; ?>"
                                    >
                            </td>
                            <td><input type="text" 
                                    class="form-control qty_paddy required" 
                                    name="qty_paddy[]" 
                                    value="<?php echo $b_dtls->paddy_qty; ?>"
                                    >
                                    
                            </td>
                            <td><input type="text" 
                                    class="form-control qty_cmr required" 
                                    name="qty_cmr[]" 
                                    value="<?php echo $b_dtls->paddy_cmr; ?>"
                                    >
                                    
                            </td>
                            <td><input type="text" 
                                    class="form-control qty_butta required" 
                                    name="qty_butta[]" 
                                    value="<?php echo $b_dtls->paddy_butta; ?>"
                                    >
                                    
                            </td>
                            <td>
                                <?php
                                    if($flag){
                                        ?>
                                        
                                        <button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button>

                                        <?php
                                    }
                                ?>
                            </td>
                        </tr>

                    <?php
                        $flag = true;
                        }
                    ?>
                </tbody> 

                <tfoot>
                    
                    <tr>
                    
                        <td colspan="4" style="text-align: right;">Total:</td>
                        <td><input type="text" class="no-border tot_paddy" readonly></td>
                        <td><input type="text" class="no-border tot_cmr" readonly></td>
                        <td><input type="text" class="no-border tot_butta" readonly></td>
                        <td></td>

                    </tr>

                    <tr>
                    
                        <td colspan="5" style="text-align: right;">Extra Delivery:</td>
                        <td><input type="text" 
                                class="form-control" 
                                name="extra_delivery"
                                value="<?php echo $payment_dtls->extra_delivery; ?>"
                                />
                        </td>
                        <td></td>
                        <td></td>
                        
                    </tr>

                </tfoot>
            </table>

            <div class="form-header">
            
                <h4>Bill Details</h4>
            
            </div>
            
            <table class="table">

                <thead>

                    <tr>
                        
                        <th width="25%">Particulars</th>
                        <th>Rate/Qtls <br>Paddy</th>
                        <th>Total Amount <br> (Rs)</th>
                        <th>TDS Amount <br>(Less) <br> @2.00%</th>
                        <th>CGST <br> (Add) <br> @2.5%</th>
                        <th>SGST <br> (Add) <br> @2.5%</th>
                        <th>Payable Amount(Rs)</th>
                        <th><button type="button" class="btn btn-success addAnotherRow"><i class="fa fa-plus"></i></button></th>

                    </tr>

                </thead>

                <tbody id="intro1" class="tables">
                    
                    
                    <?php
                        $flag = false;
                        foreach($charges as $c_list){
                    ?>
                        <tr>
                            <td><select class="form-control particulars required" name="particulars[]">

                                    <option value="">Select</option>

                                    <?php
                                        foreach($bill_master as $b_list){

                                            ?>

                                            <option value="<?php echo $b_list->sl_no; ?>" 
                                                    <?php echo ($b_list->sl_no == $c_list->account_type)? 'selected':''; ?>
                                            ><?php echo $b_list->param_name; ?></option>

                                            <?php
                                        }
                                    ?>
                                </select>
                            
                            </td>

                            <td><input type="text" 
                                       class="no-border rate_per_qtls" 
                                       name="rate_per_qtls[]" 
                                       value="<?php echo $c_list->per_unit; ?>"
                                       readonly
                                       >
                            </td>
                            <td><input type="text" 
                                       class="form-control amounts required"
                                       value="<?php echo $c_list->total_amt; ?>" 
                                       name="amounts[]"
                                       >
                            </td>
                            <td><input type="text" 
                                       class="form-control tds_amount" 
                                       value="<?php echo $c_list->tds_amt; ?>"
                                       name="tds_amount[]"
                                       >
                            </td>
                            <td><input type="text" 
                                       class="form-control cgst"
                                       value="<?php echo $c_list->cgst_amt; ?>" 
                                       name="cgst[]"
                                       >
                                       
                            </td>
                            <td><input type="text" 
                                       class="form-control sgst" 
                                       name="sgst[]"
                                       value="<?php echo $c_list->sgst_amt; ?>"
                                       >
                            </td>
                            <td><input type="text" 
                                       class="form-control paybel" 
                                       name="paybel[]"
                                       value="<?php echo $c_list->payble_amt; ?>"
                                       >
                            </td>
                            <td>
                                <?php
                                    if($flag){
                                        ?>
                                        
                                        <button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button>

                                        <?php
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                        $flag = true;
                        }
                    ?>
                </tbody> 

                <tfoot>
                    <tr>
                    
                        <td colspan="6" style="text-align: right;">Total Amount:</td>
                        <td colspan="2"><input type="text" class="no-border tot_payble" readonly></td>

                    </tr>

                    <tr>
                    
                        <td colspan="6" style="text-align: right;">Less Butta:</td>
                        <td><input type="text" class="form-control less_butta"></td>

                    </tr>

                    <tr>
                    
                        <td colspan="6" style="text-align: right;">Payble Amount:</td>
                        <td><input type="text" class="form-control payble_amount" readonly></td>

                    </tr>

                </tfoot>
            </table>

            <div class="form-group row">

                <div class="col-sm-5">

                    <input type="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>

    </div>

</div>

<script>

    $("#form").validate();

    $( ".sch_cd" ).select2();

</script>

<script>

    $(document).ready(function(){

        var global_dist = '<?php echo $payment_dtls->dist ?>',
            global_block= '<?php echo $payment_dtls->block ?>';

        function millGroup(dist) {

            //District Wise Block
            $.get( 

                '<?php echo site_url("paddy/blocks");?>',

                { 

                    dist: dist

                }

                ).done(function(data){

                    var string = '<option value="">Select</option>',
                        selected= '';

                    $.each(JSON.parse(data), function( index, value ) {

                        if(value.sl_no == '<?php echo $payment_dtls->block ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.block_name + '</option>'

                    });

                    $('#block').html(string);

                });    


                //For District wise Mill
                $.get( 

                    '<?php echo site_url("paddy/mills");?>',

                    { 

                        dist: dist

                    }

                    ).done(function(data){

                    var string = '<option value="">Select</option>',
                        selected = '';

                    $.each(JSON.parse(data), function( index, value ) {

                        if(value.sl_no == '<?php echo $payment_dtls->mill_id ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.mill_name + '</option>'

                    });

                    $('#mill_name').html(string);

                });
                
            

            } 

            function socGroup(block) { 

                //For Block wise Society
                $.get( 

                    '<?php echo site_url("paddy/societies");?>',

                    { 

                        block: block

                    }

                    ).done(function(data){

                    var string = '<option value="">Select</option>',
                        selected = '';

                    $.each(JSON.parse(data), function( index, value ) {

                        if(value.sl_no == '<?php echo $payment_dtls->soc_id; ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                    });

                    $('#soc_name').html(string);

                });

            }

        millGroup('<?php echo $payment_dtls->dist ?>');

        socGroup( '<?php echo $payment_dtls->block ?>');

        $('#dist').change(function(){

            millGroup($(this).val());

            socGroup('');

        });

        $('#block').change(function(){
            
            socGroup($(this).val());

        });

    });

</script>

<script>
    $(document).ready(function(){

        $('.addAnother').click(function(){

            let row = '<tr>' +
                        '<td><input type="text" class="form-control mill_bill_no" name="mill_bill_no[]"></td>' +
                        '<td><input type="date" class="form-control mill_bill_date" name="mill_bill_date[]"></td>' +
                        '<td><input type="text" class="form-control confed_bill_no" name="confed_bill_no[]"></td>' +
                        '<td><input type="date" class="form-control confed_bill_date" name="confed_bill_date[]"></td>' +
                        '<td><input type="text" class="form-control qty_paddy" name="qty_paddy[]"></td>' +
                        '<td><input type="text" class="form-control qty_cmr" name="qty_cmr[]"></td>' +
                        '<td><input type="text" class="form-control qty_butta" name="qty_butta[]"></td>' +
                        '<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>' +
                      '</tr>';
            
            $('#intro').append(row);

        });

        $('.addAnotherRow').click(function(){

            let row = '<tr>' +
                        '<td><select class="form-control particulars" name="particulars[]"> ' +

                            '<option value="">Select</option> ' +

                            '<?php foreach($bill_master as $b_list){ ' +

                                '?> ' +

                                    '<option value="<?php echo $b_list->sl_no; ?>"><?php echo $b_list->param_name; ?></option> ' +

                                '<?php } ' +
                            '?> ' +
                            '</select> ' +
                        '</td> ' +
                        '<td><input type="text" class="no-border rate_per_qtls" name="rate_per_qtls[]" readonly></td>' +
                        '<td><input type="text" class="form-control amounts" name="amounts[]"></td>' +
                        '<td><input type="text" class="form-control tds_amount" name="tds_amount[]"></td>' +
                        '<td><input type="text" class="form-control cgst" name="cgst[]"></td>' +
                        '<td><input type="text" class="form-control sgst" name="sgst[]"></td>' +
                        '<td><input type="text" class="form-control paybel" name="paybel[]"></td>' +
                        '<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>' +
                    '</tr>';

            $('#intro1').append(row);

        });

    });

</script>

<script>

    $(document).ready(function(){

        function sumValuesOf(className){

            var sum = 0.00;

            $('.'+className+'').each(function(){

                sum += +$(this).val();

            });

            return sum;
        }

        //Billing Details
        $('#intro').on('change', '.confed_bill_no', function(){

            let indexNo = $('.confed_bill_no').index(this);

            $.get('<?php echo site_url("paddy/billDetails"); ?>',{

                billNo: $(this).val(),
                pool_type: $('#pool_type').val()

            }).done(function(data){

                data = JSON.parse(data);

                $('.confed_bill_date:eq('+indexNo+')').val(data.bill_dt);
                $('.qty_paddy:eq('+indexNo+')').val(data.paddy_qty * 10);
                $('.qty_cmr:eq('+indexNo+')').val(data.sub_tot_cmr_qty * 10);
                $('.qty_butta:eq('+indexNo+')').val(data.butta_cut);

                $('.tot_paddy').val(sumValuesOf('qty_paddy'));
                $('.tot_cmr').val(sumValuesOf('qty_cmr'));
                $('.tot_butta').val(sumValuesOf('qty_butta'));
                
            });

        });

        $('.tot_paddy').val(sumValuesOf('qty_paddy'));
        $('.tot_cmr').val(sumValuesOf('qty_cmr'));
        $('.tot_butta').val(sumValuesOf('qty_butta'));
        $('.less_butta').val(sumValuesOf('qty_butta'));

        //Millers Payment Details
        $('#intro1').on('change', '.particulars', function(){

            let indexNo = $('.particulars').index(this);

            $.get('<?php echo site_url("paddy/billMasterDetails"); ?>',{

                riceType: $('#rice_type').val(),
                sl_no: $(this).val()

            }).done(function(data){

                let values = JSON.parse(data);
                let action = values.action;
                
                $('.rate_per_qtls:eq('+indexNo+')').val(values.val);

                if(action == 'P'){

                    $('.amounts:eq('+indexNo+')').val(parseFloat(values.val) * parseFloat($('#totPaddy').val()));

                }else if(action == 'C'){

                    $('.amounts:eq('+indexNo+')').val(parseFloat(values.val) * parseFloat($('#totCmr').val()));

                }

            });

        });

        $('.less_butta').change(function(){

            $('.payble_amount').val(sumValuesOf('paybel') - $(this).val());

        });

        $('#intro1').on('change', '.paybel', function(){
            $('.tot_payble').val(sumValuesOf('paybel'));
            $('.payble_amount').val(sumValuesOf('paybel'));
            $('.less_butta').change();

        });

        $('.tot_payble').val(sumValuesOf('paybel'));
        $('.payble_amount').val(sumValuesOf('paybel'));
        $('.less_butta').change();

        $("#intro").on('click', '.removeRow',function(){
            
            $(this).parent().parent().remove();

            $('.tot_paddy').val(sumValuesOf('qty_paddy'));
            $('.tot_cmr').val(sumValuesOf('qty_cmr'));
            $('.tot_butta').val(sumValuesOf('qty_butta'));
            
        });

        $("#intro1").on('click', '.removeRow',function(){
            
            $(this).parent().parent().remove();

            $('.tot_payble').val(sumValuesOf('paybel'));
            $('.payble_amount').val(sumValuesOf('paybel'));
            $('.less_butta').change();
            
        });
    });

</script>