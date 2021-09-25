<style>
table {
    border-collapse: collapse;
    width: 100%;
}

table, td, th {
    border: 1px solid #dddddd;

    padding: 6px;

    font-size: 12px;

    text-align: right;
}

th {

    text-align: center;

}

tr:hover {background-color: #f5f5f5;}

</style>

<script>
  function printDiv() {

        var divToPrint = document.getElementById('divToPrint');

        var WindowObject = window.open('', 'Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
            '                                          table { border-collapse: collapse; font-size: 12px; width: 100%;}' +
            '                                          th, td { border: 1px solid black; border-collapse: collapse; padding: 6px;}' +
            '                                           th, td { }' +
            '                                         .border { border: 1px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed ' +
            '                                       ' +
            '                                   } } </style>');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function () {
            WindowObject.close();
        }, 10);

  }
</script>


<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

?>        
    <div class="wraper">      

        <div class="col-md-6 container form-wraper">
    
            <form method="POST" 
                id="form"
                action="<?php echo site_url("report/paymentsociety");?>" >

                <div class="form-header">
                
                    <h4>Payment Society </h4>
                
                </div>

                 <div class="form-group row">

                <label for="dist" class="col-sm-2 col-form-label">District:</label>

                <div class="col-sm-4">

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

                <label for="block" class="col-sm-2 col-form-label">Block:</label>

                <div class="col-sm-4">

                    <select name="block" id="block" class="form-control required">

                        <option value="">Select</option>    

                        <option value="">Select District First</option>    

                    </select>

                </div>

            </div>

             <div class="form-group row">

                <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>

                <div class="col-sm-4">

                    <select type="text"
                        class="form-control required sch_cd"
                        name="soc_name"
                        id="soc_name"
                    >

                        <option value="">Select</option>    

                        <option value="">Select Block First</option>    

                    </select>    

                </div>

              <!--   <label for="mill_name" class="col-sm-2 col-form-label">Mill Name:</label> -->

               <!--  <div class="col-sm-4">

                    <select type="text"
                        class="form-control required sch_cd"
                        name="mill_name"
                        id="mill_name"
                    >

                        <option value="">Select</option>    

                        <option value="">Select District First</option>    


                    </select>

                </div> -->

              </div>  

                 <!-- <div class="form-group row"> -->
                   <div class="form-group row">
                    <label for="pool_type" class="control-lebel col-sm-2 col-form-label">Pool Type:</label>
            
                    <div class="col-sm-10">

                        <select class="form-control" 
                                name="pool_type"
                                id="pool_type"
                            >

                            <option value="">Select</option>

                            <option value="S">State Pool</option>

                            <option value="C">Central Pool</option>
                            
                            <option value="F">FCI</option>

                        </select>    

                    </div>

                <!-- </div> -->

                </div>

                <div class="form-group row">

                    <label for="pmt_bill_no" class="control-lebel col-sm-2 col-form-label">Payment No:</label>

                    <div class="col-sm-10">


                           <select type="text"
                        class="form-control required sch_cd"
                        name="pmt_bill_no"
                        id="pmt_bill_no"
                    >

                        <option value="">Select</option>    

                      


                    </select>

                  
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

    <?php

    }
    
    else if($_SERVER['REQUEST_METHOD'] == 'POST') { 
        function getIndianCurrency($number){

            $decimal = round($number - ($no = floor($number)), 2) * 100;
            $hundred = null;
            $digits_length = strlen($no);
            $i = 0;
            $str = array();
            $words = array(0 => '', 1 => 'One', 2 => 'Two',
                3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
                7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
                10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
                13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
                16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
                19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
                40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
                70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
            $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
            while( $i < $digits_length ) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += $divider == 10 ? 1 : 2;
                if ($number) {
                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                    $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
                } else $str[] = null;
            }
            $Rupees = implode('', array_reverse($str));
            $paise = ($decimal) ? "and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
            return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise .' Only';
        }
    ?>

        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div style="text-align:center;">

                        <h2><?php echo $orgname->param_value; ?></h2>

                    </div>
                    
                    <hr> 

                    <?php if(!$payment_dtls) {

                            echo "No Data Found";
                            exit();

                          }
                          $pool_type ="";
                          $pool = $this->input->post('pool_type');
                          if($pool == "S"){ $pool_type = "State Pool" ;}
                          elseif ($this->input->post('pool_type') == "C") {
                            $pool_type = "Central Pool" ;
                          }else{
                            $pool_type = "FCI" ;
                          }
                    ?>

                    <p style="text-align: justify;">In Connection with the Procurement during <strong>KMS-<?php echo $payment_dtls->kms_year; ?></strong> on <?php if(isset($pool)){echo $pool_type; } ?> Our
                       agent society <u><?php //echo $payment_dtls->mill_name; ?></u><?php echo $payment_dtls->soc_name; ?> has submitted <u>
                        <?php echo count($bill_dtls); ?></u> bills  for commission payment against procurement of <u></u><?php echo $payment_dtls->paddy_qty; ?>
                       qtls  paddy in the district of <u><?php echo $payment_dtls->district_name; ?></u>
                    </p>

                    <h3><u>Details of bills as follows-:</u></h3>

                    <table>

                        <thead>

                            <tr>
                    
                                <th>Con. Bill No</th>

                                <th>Date</th>

                                <th>Soc. Bill No</th>

                                <th>Date</th>

                                <th>Quantity in Qtls</th>

                                <th>Rate / (Qtls)</th>

                                <th>Value (Rs)</th>

                            </tr>

                        </thead>

                        <tbody> 

                            <?php 

                            if($bill_dtls) {

                                $tot_paddy = $tot_cmr = $tot_amt = 0;
                                
                                foreach($bill_dtls as $b_dtls){

                            ?>
                                    <tr>

                                        <td><?php echo $b_dtls->con_bill_no; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($b_dtls->con_bill_dt)); ?></td>
                                        <td><?php echo $b_dtls->soc_bill_no; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($b_dtls->soc_bill_dt)); ?></td>
                                        <td><?php echo $b_dtls->paddy_qty; ?></td>
                                        <td><?php echo $b_dtls->rate_per_qtls; ?></td>
                                        <td><?php echo ($b_dtls->paddy_qty*$b_dtls->rate_per_qtls); ?></td>
                                        
                                    </tr>
                                    
                            <?php    

                                    $tot_paddy += $b_dtls->paddy_qty;
                                    $tot_amt   += ($b_dtls->paddy_qty*$b_dtls->rate_per_qtls);
                                  
                                      
                                }

                            }

                            else {

                                echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";
                            }

                            ?>  
                        
                        </tbody>

                        <tfoot>
                    
                            <tr>
                            
                                <td colspan="6" style="text-align: right;">Total:</td>
                                <td><?php echo $tot_amt; ?></td>
                               

                            </tr>


                        </tfoot>

                    </table>
                    
                    <br>
                    <div class="col-lg-12">
                    <p style="float: right;">
                        <?php  foreach($charges as $charge);?>
                        Less TDS deduct @ 5% (-) Rs <?php echo $charge->deducted_amt; ?>
                    </p>
                </div>

 <div class="col-lg-12">
                    <p style="float: right;">
                        Payable Amount: <?php echo $charge->payble_amt; ?>
                    </p>
                    
                    </div>
                    <div  class="bottom">
                        
                        <p>Rs <u><?php echo $charge->payble_amt; ?></u> ( <?php echo getIndianCurrency(round($charge->payble_amt,0));?> ) only
                        may be realesed from ............................. Bank, A/C-No 915010065341726 in favour of
                        <u><?php echo $payment_dtls->soc_name; ?></u> througn Online.
                        </p>
                        <br><p>Put up to C.E.O through AM-I D.M,C.D.O & A.R.C.S for Necessary order pls.</p>

                    </div>
                   <br><br>
                     <div  class="bottom">
                        
                        <p>Preapred Payment for Rs <u><?php echo $charge->payble_amt; ?></u> ( Rupees <?php echo getIndianCurrency(round($charge->payble_amt,0));?> ) only in favour <?php echo $payment_dtls->soc_name; ?> through online ..................Bank, A/C-No .....................
                      
                      

                    </div>

                </div>   
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

                </div>

            </div>
            
        </div>
        
    <?php

    }

    ?> 

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
   // $('#soc_name').change(function(){

        $('#pool_type').change(function(){

            //For District wise Block
            $.get( 

                '<?php echo site_url("report/paymentsocietylist");?>',

                { 
                    dist: $('#dist').val(),
                    
                    soc_id: $('#soc_name').val(),

                    pool_type: $(this).val()
                   
                }

            ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.pmt_commission_no + '">' + value.pmt_commission_no + '  ('+value.con_bill_no+')</option>'

                });

                $('#pmt_bill_no').html(string);
               

            })

        });
</script>


