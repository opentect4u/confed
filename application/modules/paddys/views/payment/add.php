<div class="wraper">      

    <div class="col-md-12 container form-wraper" style="margin-left: 0px;">

        <form method="POST" 
            id="form"
            action="<?php echo site_url("paddy/payment/add");?>" >

            <div class="form-header">
            
                <h4>Millers Payment Entry</h4>
            
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
                            name="dedede"
                            id="totPaddys" readonly="" 
                        />
                    <input type="hidden"
                            class="form-control required"
                            name="totPaddy"
                            id="totPaddy"
                        />

                </div>

                <label for="totCmr" class="col-sm-1 col-form-label">Total CMR:</label>

                <div class="col-sm-5">
                     <input type="text"
                            class="form-control required"
                            name="dededess"
                            id="totCmrs" readonly
                        />
                   
                    <input type="hidden"
                            class="form-control required"
                            name="totCmr"
                            id="totCmr"
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

                <label for="rice_type" class="col-sm-1 col-form-label">Rice Type:</label>

                <div class="col-sm-5">

                    <select class="form-control required"
                            name="rice_type"
                            id="rice_type"
                        >

                        <option value="">Select</option>

                        <option value="P">Par Boiled Rice</option>

                        <option value="R">Raw Rice</option>

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
                        
                        <th>Millers <br> Bill No.</th>
                        <th>Date</th>
                        <th>Confed Bill No.</th>
                        <th>Date</th>
                        <th>Quantity of Paddy <br>(Qtls)</th>
                        <th>Quantity of CMR<br>(Qtls)</th>
                        <th>Total Butta(RS)</th>
                        <th><button type="button" class="btn btn-success addAnother"><i class="fa fa-plus"></i></button></th>

                    </tr>

                </thead>

                <tbody id="intro" class="tables">
                    <tr>
                        <td><input type="text" class="form-control mill_bill_no" name="mill_bill_no[]" required></td>
                        <td><input type="date" class="form-control mill_bill_date" name="mill_bill_date[]" required></td>
                        <td>
                           <select type="text" class="form-control confed_bill_no required" name="confed_bill_no[]" id="confed_bill_no">
                           <option value="">Select</option>    
                           </select>
                        <!--     <input type="text" class="form-control confed_bill_no" name="confed_bill_no[]" required> -->
                        </td>
                        <td><input type="date" class="form-control confed_bill_dates" name="confed_bill_dates[]" readonly>
                                    <input type="hidden" class="form-control confed_bill_date" name="confed_bill_date[]" value="">
                        </td>
                        <td><input type="text" class="form-control qty_paddys" name="qty_paddys[]" readonly>
                            <input type="hidden" class="form-control qty_paddy" name="qty_paddy[]" ></td>
                        <td><input type="text" class="form-control qty_cmrs" name="qty_cmrs[]" readonly>
                            <input type="hidden" class="form-control qty_cmr" name="qty_cmr[]" >
                        </td>
                        <td><input type="text" class="form-control qty_butta" name="qty_butta[]"></td>
                        <td></td>
                    </tr>
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
                        <td><input type="text" class="form-control extra_delivery" name="extra_delivery"></td>
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
                    
                        <td colspan="6" style="text-align: right;">Net Payble Amount:</td>
                        <td><input type="text" class="form-control payble_amount" readonly></td>

                    </tr>

                </tfoot>
            </table>

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
            
            //For District wise Mill
            $.get( 

                '<?php echo site_url("paddy/mills");?>',

                { 

                    dist: $(this).val()

                }

                ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.sl_no + '">' + value.mill_name + '</option>'

                });

                $('#mill_name').html(string);

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
    $('#pool_type').change(function(){

            //For District wise Block
            $.get( 

                '<?php echo site_url("paddy/confedbilllist");?>',

                { 
                    dist: $('#dist').val(),
                    block: $('#block').val(),
                    soc_id: $('#soc_name').val(),
                    mill_id: $('#mill_name').val(),
                    pool_type: $(this).val(),
                    rice_type: $('#rice_type').val()
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

         var inc = 0;

        $('.addAnother').click(function(){
                inc++;

            $.get( 

                '<?php echo site_url("paddy/confedbilllist");?>',

                { 
                    dist: $('#dist').val(),
                    block: $('#block').val(),
                    soc_id: $('#soc_name').val(),
                    mill_id: $('#mill_name').val(),
                    pool_type: $('#pool_type').val(),
                    rice_type: $('#rice_type').val()
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
                        '<td><input type="text" class="form-control mill_bill_no" name="mill_bill_no[]"></td>' +
                        '<td><input type="date" class="form-control mill_bill_date" name="mill_bill_date[]"></td>' +
                        '<td><select type="text" class="form-control confed_bill_no required" name="confed_bill_no[]" id="confed_bill_nos'+inc+'"><option value="">Select</option></select></td>' +
                        '<td><input type="date" class="form-control confed_bill_dates" name="confed_bill_dates[]" readonly><input type="hidden" class="form-control confed_bill_date" name="confed_bill_date[]"></td>' +
                        '<td><input type="text" class="form-control qty_paddys" name="qty_paddys[]" readonly><input type="hidden" class="form-control qty_paddy" name="qty_paddy[]"></td>' +
                        '<td><input type="text" class="form-control qty_cmrs" name="qty_cmrs[]" readonly><input type="hidden" class="form-control qty_cmr" name="qty_cmr[]"></td>' +
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
                $('.confed_bill_dates:eq('+indexNo+')').val(data.bill_dt);
                // $('.qty_paddy:eq('+indexNo+')').val(data.paddy_qty * 10);
                $('.qty_paddy:eq('+indexNo+')').val(data.paddy_qty );
                $('.qty_paddys:eq('+indexNo+')').val(data.paddy_qty );
                // $('.qty_cmr:eq('+indexNo+')').val(data.sub_tot_cmr_qty * 10);
                $('.qty_cmr:eq('+indexNo+')').val(data.sub_tot_cmr_qty );
                 $('.qty_cmrs:eq('+indexNo+')').val(data.sub_tot_cmr_qty );
                $('.qty_butta:eq('+indexNo+')').val(data.butta_cut);
                $('.view:eq('+indexNo+')').attr('id', data.bill_no);

                $('.tot_paddy').val(sumValuesOf('qty_paddy').toFixed(0));
                $('#totPaddy').val(sumValuesOf('qty_paddy').toFixed(0));
                $('#totPaddys').val(sumValuesOf('qty_paddy').toFixed(0));
                $('.tot_cmr').val(sumValuesOf('qty_cmr').toFixed(0));
                $('#totCmr').val(sumValuesOf('qty_cmr').toFixed(0));
                $('#totCmrs').val(sumValuesOf('qty_cmr').toFixed(0));
                $('.tot_butta').val(sumValuesOf('qty_butta'));
                $('.less_butta').val(sumValuesOf('qty_butta'));
                
                // $('.extra_delivery').val($('.tot_cmr').val() - $('#totCmr').val());
            });

        });

        //Millers Payment Details
        $('#intro1').on('change', '.particulars', function(){
            let row          = $(this).closest('tr');
            let indexNo = $('.particulars').index(this);
            var sl          = row.find('td:eq(0) .particulars').val();
            // console.log(sl);
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

                ////for auto calculate of tds and gst % 
                if(sl=='10'||sl=='16'){
                  
                    var gst         = parseFloat(row.find('td:eq(2) .amounts ').val()*(2.5/100));
                    var tot         = parseFloat(row.find('td:eq(2) .amounts ').val());
                    var gr_tot      = parseFloat(tot +  gst+gst).toFixed('2');
                    
                    row.find('td:eq(3)  input').val(0);
                    row.find('td:eq(4)  input').val(gst);
                    row.find('td:eq(5)  input').val(gst);
                    row.find('td:eq(6)  input').val(gr_tot);
                    $('.payble_amount').val(sumValuesOf('tot_payble'));
                    $('.less_butta').val(sumValuesOf('qty_butta'));
                    var tot_butta  = $('.less_butta ').val();
                     $('.payble_amount').val(sumValuesOf('paybel')- $('.less_butta ').val());
                     $('.tot_payble').val(sumValuesOf('paybel'));
                } else if (sl=='3'||sl=='4'||sl=='5'||sl=='6'||sl=='7'||sl=='15'){
                  
                    var tds         = parseFloat(row.find('td:eq(2) .amounts ').val()*(2/100));
                    var tot         = parseFloat(row.find('td:eq(2) .amounts ').val());
                    var gr_tot      = parseFloat(tot -tds ).toFixed('2');

                    row.find('td:eq(3)  input').val(tds);
                    row.find('td:eq(4)  input').val(0);
                    row.find('td:eq(5)  input').val(0);
                    row.find('td:eq(6)  input').val(gr_tot);
                    $('.payble_amount').val(sumValuesOf('tot_payble'));
                    
                    $('.less_butta').val(sumValuesOf('qty_butta'));
                    var tot_butta  = $('.less_butta ').val();
                     $('.payble_amount').val(sumValuesOf('paybel')- $('.less_butta ').val());
                     $('.tot_payble').val(sumValuesOf('paybel'));
                 } else{
                    var gst         = parseFloat(row.find('td:eq(2) .amounts ').val()*(2.5/100));
                    var tot         = parseFloat(row.find('td:eq(2) .amounts ').val());
                    var gr_tot      = parseFloat(tot ).toFixed('2');

                    row.find('td:eq(3)  input').val(0);
                    row.find('td:eq(4)  input').val(0);
                    row.find('td:eq(5)  input').val(0);
                    row.find('td:eq(6)  input').val(gr_tot);
                    $('.payble_amount').val(sumValuesOf('tot_payble'));
                    $('.less_butta').val(sumValuesOf('qty_butta'));
                    var tot_butta  = $('.less_butta ').val();
                     $('.payble_amount').val(sumValuesOf('paybel')- $('.less_butta ').val());
                     $('.tot_payble').val(sumValuesOf('paybel'));
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

        $("#intro").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();

            $('.tot_paddy').val(sumValuesOf('qty_paddy').toFixed(0));
            $('.tot_cmr').val(sumValuesOf('qty_cmr').toFixed(0));
            $('.tot_butta').val(sumValuesOf('qty_butta'));
            
        });

        $('#intro').on('change', '.qty_butta', function(){
        
            $('.tot_butta').val(sumValuesOf('qty_butta'));
            $('.less_butta').val(sumValuesOf('qty_butta'));
        });

        $("#intro1").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();
          
            $('.tot_payble').val(sumValuesOf('paybel'));
            $('.payble_amount').val(sumValuesOf('paybel'));
            $('.less_butta').change();
            
        });

        $('#intro').on('click', '.view', function(){

            let billNo = $(this).attr('id');

            $.get('<?php echo site_url("paddy/getDocuments"); ?>',
                {
                    bill_no: billNo
                }
            )
            .done(function(data){
                $('#doc-view').html(data);
                $('#viewModal').modal('show');
            });

        });

    });

</script>