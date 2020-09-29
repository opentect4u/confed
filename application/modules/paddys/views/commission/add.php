<div class="wraper">      

    <div class="col-md-12 container form-wraper" style="margin-left: 0px;">

        <form method="POST" 
            id="form"
            action="<?php echo site_url("paddy/commission/add");?>" >

            <div class="form-header">
            
                <h4>Commission Entry</h4>
            
            </div>

            <div class="form-group row">

                <label for="dist" class="col-sm-1 col-form-label">District:</label>

                <div class="col-sm-5">

                    <select name="dist" id="dist" class="form-control required">

                        <option value="">Select</option>

                        <?php

                            foreach($dist as $dlist){

                        ?>

                            <option value="<?php echo $dlist->district_code;?>"><?php echo $dlist->district_name;?></option>

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
                            value="<?php echo date('Y-m-d');?>"
                        />

                </div>

                <label for="pool_type" class="col-sm-1 col-form-label">Pool Type:</label>

                <div class="col-sm-5">

                    <select class="form-control required"
                            name="pool_type"
                            id="pool_type"
                        >

                        <option value="">Select</option>

                        <option value="S">State Pool</option>

                        <option value="C">Central Pool</option>

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
                    <tr>
                        <td><input type="text" class="form-control soc_bill_no" name="soc_bill_no[]" required></td>
                        <td><input type="date" class="form-control soc_bill_date" name="soc_bill_date[]" required></td>
                        <td>
                            <select type="text" class="form-control confed_bill_no required" name="confed_bill_no[]" id="confed_bill_no">
                           <option value="">Select</option>    
                           </select>

                            <!-- <input type="text" class="form-control confed_bill_no" name="confed_bill_no[]" required> --></td>
                        <td><input type="date" class="form-control confed_bill_date" name="confed_bill_date[]" required></td>
                        <td><input type="text" class="form-control qty_paddy" name="qty_paddy[]" required></td>
                        <td><input type="text" class="form-control rate" id="rate" name="rate[]" required></td>
                        <td><input type="text" class="form-control value" name="value[]"></td>
                        <td><button type="button" class="btn btn-default view"><i class="fa fa-eye"></i></button></td>
                    </tr>
                </tbody> 

                <tfoot>
                    <tr>
                    
                        <td colspan="4" style="text-align: right;">Total:</td>
                        <td><input type="text" class="no-border tot_paddy" id="tot_paddy" readonly></td>
                        <td><input type="text" class="no-border tot_rate" readonly></td>
                        <td><input type="text" class="no-border tot_comm" readonly></td>
                        <td></td>

                    </tr>

                    <tr>
                    
                        <td colspan="4" style="text-align: right;">Less: TDS Deduct</td>
                        <td><div class="input-group"><input type="text" class="form-control tds_percentage" name="tds_percentage"><span class="input-group-addon">%</span></div></td>
                        <td style="text-align: right;">Rs:</td>
                        <td><input type="text" class="form-control deducted_amt no-border" name="deducted_amt" readonly/></td>
                        <td></td>

                    </tr>
                    
                    <tr>
                        <td colspan="6" style="text-align: right;">Payble Amount:</td>
                        <td colspan="4"><input type="text" class="no-border ultimate_payble" name="ultimate_payble" readonly></td>
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
                    
                    <tr>
                        <td><select class="form-control particulars required" name="particulars[]">

                                <option value="">Select</option>

                                <?php
                                    foreach($bill_master as $b_list){

                                        ?>

                                        <option value="<?php echo $b_list->sl_no; ?>"><?php echo $b_list->param_name; ?></option>

                                        <?php
                                    }
                                ?>
                            </select>
                        
                        </td>

                        <td><input type="text" class="no-border rate_per_qtls" name="rate_per_qtls[]" readonly></td>
                        <td><input type="text" class="form-control amounts" name="amounts[]" required></td>
                        <td><input type="text" class="form-control tds_amount" name="tds_amount[]"></td>
                        <td><input type="text" class="form-control cgst" name="cgst[]"></td>
                        <td><input type="text" class="form-control sgst" name="sgst[]"></td>
                        <td><input type="text" class="form-control paybel" name="paybel[]"></td>
                    </tr>

                </tbody> 

                <tfoot>
                    <tr>
                    
                        <td colspan="6" style="text-align: right;">Total Amount:</td>
                        <td><input type="text" class="no-border tot_payble" readonly></td>

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
            </table> -->

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>

    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Supporting Documents</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="doc-view">
           
          </div>
        </div>
      </div>
    </div>

</div>

<script>

    $("#form").validate();

    $( ".sch_cd" ).select2();

</script>

<script>
    $('#pool_type').change(function(){

            //For District wise Block
            $.get( 

                '<?php echo site_url("paddy/confedbilllists");?>',

                { 
                    dist: $('#dist').val(),
                    block: $('#block').val(),
                    soc_id: $('#soc_name').val(),
                    pool_type: $(this).val()
                   
                }

            ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.bill_no + '">' + value.bill_no + '</option>'

                });

                $('#confed_bill_no').html(string);
               
                

            })

        });
</script>

<script>

    $(document).ready(function(){

        var i = 0;

        $('#dist').change(function(){

            //For District wise Block
            $.get( 

                '<?php echo site_url("paddy/blocks");?>',

                { 

                    dist: $(this).val()

                }

            ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.sl_no + '">' + value.block_name + '</option>'

                });

                $('#block').html(string);

            });

        });

    });

</script>

<script>

    $(document).ready(function(){

        var i = 0;

        $('#block').change(function(){

            $.get( 

                '<?php echo site_url("paddy/societies");?>',

                { 

                    block: $(this).val()

                }

            ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.sl_no + '">' + value.soc_name + '</option>'

                });

                $('#soc_name').html(string);

            });

        });

    });

</script>

<script>
    /* $(document).ready(function(){

        $('#soc_name').change(function(){

            $.get('<?php echo site_url("paddy/totPdyNdCMR"); ?>',
                {
                    soc_id:  $('#soc_name').val(),
                    mill_id: $(this).val()
                }
            ).done(function(data){

                let value = JSON.parse(data);

                $('#totPaddy').val(value.paddy_qty * 10);
                $('#totCmr').val(value.cmr_qty * 10);
            })

        });

    }); */
</script>

<script>
    $(document).ready(function(){

          var inc = 0;

        $('.addAnother').click(function(){


              inc++;

            $.get( 

                '<?php echo site_url("paddy/confedbilllists");?>',

                { 
                    dist: $('#dist').val(),
                    block: $('#block').val(),
                    soc_id: $('#soc_name').val(),
                    pool_type:$('#pool_type').val()
                }

            ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.bill_no + '">' + value.bill_no + '</option>'

                });
                console.log('confed_bill_nos'+inc);

               
               $('#confed_bill_nos'+inc).html(string);
                

            })

            let row = '<tr>' +
                        '<td><input type="text" class="form-control soc_bill_no" name="soc_bill_no[]"></td>' +
                        '<td><input type="date" class="form-control soc_bill_date" name="soc_bill_date[]"></td>' +
                        '<td><select type="text" class="form-control confed_bill_no required" name="confed_bill_no[]" id="confed_bill_nos'+inc+'"><option value="">Select</option></select></td>' +
                        '<td><input type="date" class="form-control confed_bill_date" name="confed_bill_date[]"></td>' +
                        '<td><input type="text" class="form-control qty_paddy" name="qty_paddy[]"></td>' +
                        '<td><input type="text" class="form-control rate" id="rate" name="rate[]"></td>' +
                        '<td><input type="text" class="form-control value" name="value[]"></td>' +
                        '<td><button type="button" class="btn btn-default view"><i class="fa fa-eye"></i></button><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>' +
                      '</tr>';
            
            $('#intro').append(row);

        });

        /* $('.addAnotherRow').click(function(){

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

            $.get('<?php echo site_url("paddy/billDetailscom"); ?>',{

                billNo: $(this).val(),
                pool_type: $('#pool_type').val()

            }).done(function(data){
                
                data = JSON.parse(data);

                $('.confed_bill_date:eq('+indexNo+')').val(data.bill_dt);
                $('.qty_paddy:eq('+indexNo+')').val(data.paddy_qty * 10);
                $('.rate:eq('+indexNo+')').val(data.rate);
                //$('.value:eq('+indexNo+')').val(data.comm_soc);
                $('.value:eq('+indexNo+')').val(data.paddy_qty * 10 * data.rate);

                $('.tot_paddy').val(sumValuesOf('qty_paddy'));
               // $('.tot_rate').val(sumValuesOf('rate'));
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

        // $('.rate').change(function(){
        //     // $('.deducted_amt').val((($('.tot_comm').val() * $(this).val()) / 100).toFixed(2));
        //     $('.value').val($('.qty_paddy').val() * $('.rate').val());
        // });


        $("#intro").on('change','#rate',function(){
            console.log(tot);
      var row     = $(this).closest('tr');
      var rate   = row.find("td:eq(4) input[type='text']").val();
      var qty    = row.find("td:eq(5) input[type='text']").val();

    //   var gross_amt   = parseFloat(prate)*qty/unit;
    //   var net_amt     = (gross_amt - damt);
    //   var cgst        = parseFloat(net_amt)*parseFloat(cgstrt)/100;
      var tot        = parseFloat(qty)*parseFloat(rate);

      console.log(tot);


    //    row.find("td:eq(1) input[type='text']").prop('readonly', true);
    //    row.find("td:eq(2) input[type='text']").prop('readonly', true);
    //    row.find("td:eq(4) input[type='text']").prop('readonly', true);
    //    row.find("td:eq(5) input[type='text']").prop('readonly', true);
    //    row.find("td:eq(6) input[type='text']").prop('readonly', true);
    //    row.find("td:eq(7) input[type='text']").prop('readonly', true);
    //    row.find("td:eq(8) input[type='text']").prop('readonly', true);
    //    row.find("td:eq(9) input[type='text']").prop('readonly', true);

    //   row.find("td:eq(10) input[type='text']").val((parseFloat(cgst)).toFixed(2));
    //   row.find("td:eq(11) input[type='text']").val((parseFloat(sgst)).toFixed(2));
      row.find("td:eq(6) input[type='text']").val((parseFloat(tot)).toFixed(2));
      var sum = 0;
      $('.value').each(function(){
        sum += parseFloat(this.value);
      });
      var net = parseFloat(sum) ;
      $("#tot_paddy").val(parseFloat(net).toFixed(2));
    });



    });

</script>