<div class="wraper">      

    <div class="col-md-12 container form-wraper" style="margin-left: 0px;">

        <form method="POST" 
            id="form"
            action="<?php echo site_url("paddy/commission/edit");?>" >

            <div class="form-header">
            
                <h4>Commission Edit</h4>
            
            </div>

            <input type="hidden" name="pmt_commission_no" value="<?php echo $this->input->get('pmt_commission_no'); ?>">

            <div class="form-group row">

                <label for="dist" class="col-sm-1 col-form-label">District:</label>

                <div class="col-sm-5">

                    <select name="dist" id="dist" class="form-control required">

                        <option value="">Select</option>

                        <?php

                            foreach($dist as $dlist){

                        ?>

                            <option value="<?php echo $dlist->district_code;?>"
                            <?php echo ($dlist->district_code == $commission_dtls->dist)?'selected':'';?>
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

                <label for="totPaddy" class="col-sm-1 col-form-label">Total Paddy:</label>

                <div class="col-sm-5">

                    <input type="text"
                            class="form-control required"
                            name="totPaddy"
                            id="totPaddy"
                            value="<?php echo $commission_dtls->tot_paddy; ?>"
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
                            value="<?php echo $commission_dtls->trans_dt; ?>"
                        />

                </div>

                <label for="pool_type" class="col-sm-1 col-form-label">Pool Type:</label>

                <div class="col-sm-5">

                    <select class="form-control required"
                            name="pool_type"
                            id="pool_type"
                        >

                        <option>Select</option>

                        <option value="S" <?php echo ($commission_dtls->pool_type == 'S')?'selected':''; ?>>State Pool</option>

                        <option value="C" <?php echo ($commission_dtls->pool_type == 'C')?'selected':''; ?>>Central Pool</option>

                    </select>    

                </div>

            </div>

            <div class="form-header">
            
                <h4>Bills</h4>
            
            </div>
            
            <table class="table">

                <thead>

                    <tr>
                        
                        <th>Soc <br> Bill No.</th>
                        <th>Date</th>
                        <th>Confed Bill No.</th>
                        <th>Date</th>
                        <th>Quantity of Paddy <br>(Qtls)</th>
                        <th>Rete / Qtls</th>
                        <th>Value</th>
                        <th><button type="button" class="btn btn-success addAnother"><i class="fa fa-plus"></i></button></th>

                    </tr>

                </thead>

                <tbody id="intro" class="tables">

                <?php

                    $totRt = $totVal = 0.00;
                    foreach($bill_dtls as $list){
                        $totRt  += $list->rate_per_qtls;
                        $totVal += $list->value;
                ?>
                    <tr>
                        <td><input type="text" class="form-control soc_bill_no" name="soc_bill_no[]" value="<?php echo $list->soc_bill_no;?>" required></td>
                        <td><input type="date" class="form-control soc_bill_date" name="soc_bill_date[]" value="<?php echo $list->soc_bill_dt;?>" required></td>
                        <td><input type="text" class="form-control confed_bill_no" name="confed_bill_no[]" value="<?php echo $list->con_bill_no;?>" required></td>
                        <td><input type="date" class="form-control confed_bill_date" name="confed_bill_date[]" value="<?php echo $list->con_bill_dt;?>" required></td>
                        <td><input type="text" class="form-control qty_paddy" name="qty_paddy[]" value="<?php echo $list->paddy_qty;?>" required></td>
                        <td><input type="text" class="form-control rate" name="rate[]" value="<?php echo $list->rate_per_qtls;?>" required></td>
                        <td><input type="text" class="form-control value" name="value[]" value="<?php echo $list->value;?>" ></td>
                        <td><button type="button" class="btn btn-default view"><i class="fa fa-eye"></i></button></td>
                    </tr>

                <?php
                    }
                ?>
                </tbody> 

                <tfoot>
                    <tr>
                    
                        <td colspan="4" style="text-align: right;">Total:</td>
                        <td><input type="text" class="no-border tot_paddy" readonly></td>
                        <td><input type="text" class="no-border tot_rate" value="<?php echo $totRt;?>" readonly></td>
                        <td><input type="text" class="no-border tot_comm" value="<?php echo $totVal;?>" readonly></td>
                        <td></td>

                    </tr>

                    <tr>
                    
                        <td colspan="4" style="text-align: right;">Less: TDS Deduct</td>
                        <td><div class="input-group"><input type="text" class="form-control tds_percentage" name="tds_percentage" value="<?php echo $commission_dtls->tds_percentage; ?>"><span class="input-group-addon">%</span></div></td>
                        <td style="text-align: right;">Rs:</td>
                        <td><input type="text" class="form-control deducted_amt no-border" name="deducted_amt" value="<?php echo $commission_dtls->deducted_amt; ?>" readonly/></td>
                    </tr>
                    
                    <tr>
                        <td colspan="6" style="text-align: right;">Payble Amount:</td>
                        <td colspan="4"><input type="text" class="no-border ultimate_payble" name="ultimate_payble" value="<?php echo $commission_dtls->payble_amt; ?>" readonly></td>
                    </tr>

                </tfoot>
            </table>

            <!-- <div class="form-header">
            
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
 -->
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

        var global_dist = '<?php echo $commission_dtls->dist ?>',
            global_block= '<?php echo $commission_dtls->block ?>';

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

                        if(value.sl_no == '<?php echo $commission_dtls->block ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.block_name + '</option>'

                    });

                    $('#block').html(string);

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

                        if(value.sl_no == '<?php echo $commission_dtls->soc_id; ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                    });

                    $('#soc_name').html(string);

                });

            }

        millGroup('<?php echo $commission_dtls->dist ?>');

        socGroup( '<?php echo $commission_dtls->block ?>');

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
                        '<td><input type="text" class="form-control soc_bill_no" name="soc_bill_no[]"></td>' +
                        '<td><input type="date" class="form-control soc_bill_date" name="soc_bill_date[]"></td>' +
                        '<td><input type="text" class="form-control confed_bill_no" name="confed_bill_no[]"></td>' +
                        '<td><input type="date" class="form-control confed_bill_date" name="confed_bill_date[]"></td>' +
                        '<td><input type="text" class="form-control qty_paddy" name="qty_paddy[]"></td>' +
                        '<td><input type="text" class="form-control rate" name="rate[]"></td>' +
                        '<td><input type="text" class="form-control value" name="value[]"></td>' +
                        '<td><button type="button" class="btn btn-default view"><i class="fa fa-eye"></i></button><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>' +
                      '</tr>';
            
            $('#intro').append(row);

        });

       /*  $('.addAnotherRow').click(function(){

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

        }); */

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
                $('.rate:eq('+indexNo+')').val(data.rate);
                $('.value:eq('+indexNo+')').val(data.comm_soc);

                $('.tot_paddy').val(sumValuesOf('qty_paddy'));
                $('.tot_rate').val(sumValuesOf('rate'));
                $('.tot_comm').val(sumValuesOf('value'));
                $('.less_butta').val(sumValuesOf('value'));
                
            });

        });

        $('.tot_paddy').val(sumValuesOf('qty_paddy'));
        $('.tot_cmr').val(sumValuesOf('qty_cmr'));
        $('.tot_butta').val(sumValuesOf('qty_butta'));
        $('.less_butta').val(sumValuesOf('qty_butta'));

        //Commission Details
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
        
        $('.tds_percentage').change(function(){
            $('.deducted_amt').val((($('.tot_comm').val() * $(this).val()) / 100).toFixed(2));
            $('.ultimate_payble').val($('.tot_comm').val() - $('.deducted_amt').val());
        });
    });

</script>