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
                action="<?php echo site_url("paddy/payment/voucher");?>" >

                <div class="form-header">
                
                    <h4>Payment Voucher</h4>
                
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

                <label for="mill_name" class="col-sm-2 col-form-label">Mill Name:</label>

                <div class="col-sm-4">

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

                        <h2>WEST BENGAL STATE CONSUMERS' CO-OPERATIVE FEDERATION LTD.</h2>
                         <h4>P1 HiderLane,Akabar Mansion,Kolkata-700073</h4>

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

                   <!--  <p style="text-align: justify;">In Connection with the Procurement during <strong>KMS-<?php //echo $payment_dtls->kms_year; ?></strong> on <?php //if(isset($pool)){echo $pool_type; } ?> Our
                       tagged Rice Mill <u><?php //echo $payment_dtls->mill_name; ?></u> has submitted <u><?php //echo count($bill_dtls); ?></u> bills which delivered 
                       the following quantity of CMR on behalf of <u><?php //echo $payment_dtls->soc_name; ?></u>
                       for payment against supply of <u><?php //echo $payment_dtls->tot_cmr; ?></u> Qtls CMR after milling <u><?php //echo $payment_dtls->tot_paddy; ?></u> Qtls
                       Paddy to D.C F&S <u><?php //echo $payment_dtls->district_name; ?></u> in which CONFED-WB has submitted sale bill with F&S
                       department for payment as per(Cost Sheet).
                    </p> -->
                    <div class="col-lg-12" style="margin-bottom: 20px;">

                        <div class="col-lg-4">No...............</div>
                        <div class="col-lg-4" style="text-align:center;"></div>
                        <div class="col-lg-4" style="text-align:center;">Dated:<?php echo date("d/m/Y"); ?></div>

                    </div>
                    
                    <div class="col-lg-12" style="margin-bottom: 20px;">

                        <div class="col-lg-4"></div>
                        <div class="col-lg-4" style="text-align:center;">TRANSFER</div>
                        <div class="col-lg-4" style="text-align:center;"><?=$pool_type?></div>

                    </div>

                    <div class="col-lg-12" style="margin-bottom: 20px;">

                        <div class="col-lg-4">DEBIT Mandy Labour Charge</div>
                       
                       
                        <div class="col-lg-4" style="text-align:center;">A/c 
                               <?php foreach($charges as $c_list) 

                                  { 
                                if($c_list->sl_no== "3"){ ?>

                            <?php echo $c_list->total_amt; ?>

                                 <?php }}?>
                        </div>

                        
                        <div class="col-lg-4" style="text-align:center;"></div>

                    </div>

                    <div class="col-lg-12" style="margin-bottom: 20px;">

                        <div class="col-lg-4">DEBIT Transportation Charge</div>
                        <div class="col-lg-4" style="text-align:center;">A/c  <?php $transport_crg = 0;

                        foreach($charges as $c_list) 

                                  { 
                                if($c_list->sl_no== "4" or $c_list->sl_no== "5" or $c_list->sl_no== "6" or $c_list->sl_no== "15" ){ ?>

                            <?php $transport_crg += $c_list->total_amt; ?>

                                 <?php }


                             }
                             echo $transport_crg;

                             ?></div>
                        <div class="col-lg-4" style="text-align:center;"></div>

                    </div>

                    <div class="col-lg-12" style="margin-bottom: 20px;">

                        <div class="col-lg-4">DEBIT Milling Charge</div>
                        <div class="col-lg-4" style="text-align:center;">A/c  <?php foreach($charges as $c_list) 

                                  { 
                                if($c_list->sl_no== "10"){ ?>

                            <?php echo $c_list->total_amt; ?>

                                 <?php }}?></div>
                        <div class="col-lg-4" style="text-align:center;"></div>

                    </div>

                    <div class="col-lg-12" style="margin-bottom: 20px;">

                        <div class="col-lg-4">DEBIT Other Charge<br>(GunnyUseges Charges)</div>
                          <?php   

                                $tot_paddy = $tot_cmr = $tot_butta = 0;


                            
                                
                                foreach($bill_dtls as $b_dtls){

                                    $tot_paddy += $b_dtls->paddy_qty;
                                    $tot_cmr   += $b_dtls->paddy_cmr;
                                    $tot_butta += $b_dtls->paddy_butta;
                                  
                                      
                                }

                              
                                
                                
                            ?>
                        <div class="col-lg-4" style="text-align:center;">A/c  <?php foreach($charges as $c_list) 
                                            $gunny = 0;
                                  { 
                                if($c_list->sl_no== "16"){ ?>

                            <?php $gunny = $c_list->total_amt; 

                              

                            ?>

                                 <?php }
                                     echo $tg = $gunny-$tot_butta ;

                                   // if ($tg > 0){
                                   //      echo $tg;
                                   // }
                                // echo $c_list->total_amt;
                               
                             } 
                                $tds = $totpayble = $total = 0;

                                foreach($charges as $c_list) {

                                    $tds       += $c_list->tds_amt;
                                    $totpayble += $c_list->payble_amt;

                                }

                                $total = $tds+$totpayble;
                                         $sundry_crg = 0;
                                    foreach($charges as $c_list) 

                                  { 
                                if($c_list->sl_no== "4" or $c_list->sl_no== "5" or $c_list->sl_no== "6" or $c_list->sl_no== "15" or $c_list->sl_no== "16"
                                    or $c_list->sl_no== "3" or $c_list->sl_no== "10"){

                                $sundry_crg += $c_list->total_amt;
                              
                                } }
                            
                                ?></div>
                        <div class="col-lg-4" style="text-align:center;"></div>

                    </div>

                     <div class="col-lg-12" style="margin-bottom: 20px;">

                        <div class="col-lg-4">CREDIT TDS<br></div>
                        <div class="col-lg-4" style="text-align:center;"></div>
                        <div class="col-lg-4" style="text-align:center;">A/c 
                            <?php echo $tds; ?></div>

                    </div>
                     <div class="col-lg-12" style="margin-bottom: 20px;">

                        <div class="col-lg-4">CREDIT Sundry Creditors</div>
                        <div class="col-lg-4" style="text-align:center;"></div>
                        <div class="col-lg-4" style="text-align:center;">A/c <?php echo $sundry_crg-$tot_butta-$tds; ?></div>

                    </div>
                   
                    
                    <br>
                  
                    <div class="col-lg-12">

                   
                        
                        <p><u><?php echo $tot_cmr; ?></u> Qntls.<?php if($payment_dtls->rice_type == "P"){
                            echo "Common Boiled";}else{
                                 echo "Raw Rice";
                             }?> supplied by <?php echo $payment_dtls->mill_name; ?> On behalf of <?php echo $payment_dtls->soc_name; ?>
                            </p>
                        <br>
                        <p>
                             Vide Bill No. <?php  
                                foreach($bill_dtls as $b_dtls){ 

                                echo $b_dtls->mill_bill_no."," ;
                                      
                                };  ?> Dated..................Confed Bill No 
                             <?php  
                                foreach($bill_dtls as $b_dtls){ 

                                echo $b_dtls->con_bill_no."," ;
                                      
                                };  ?>
                        Dated..........................against <?php echo $tot_paddy; ?> Qntls paddy for KMS -<?php echo $payment_dtls->kms_year; ?>


                        </p>
                           <br><br>
                    </div>
                    <div class="col-lg-12">
                        
                        <p style="text-align:center;font-size: 18px">(Original Bill of Society Kept in Bill Files)</p>
                          <br>

                    </div>

                   
                    
                    
                    <div  class="col-lg-12">
                        
                      <p>Rupees: <?php echo getIndianCurrency(round($sundry_crg,0));?></p>
                      <p>Rs.<?php echo $sundry_crg;?></p>
                    </div>
                    

                   <div  class="bottom">
                    <div class="col-lg-12">
                        <div class="col-md-3">Prepared</div><div class="col-md-3">Cashier</div><div class="col-md-3">(DM) Accountant</div><div class="col-md-3">Chief Executive Officer</div>
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
    $('#mill_name').change(function(){

            //For District wise Block
            $.get( 

                '<?php echo site_url("paddy/paymentbilllist");?>',

                { 
                    dist: $('#dist').val(),
                    
                    soc_id: $('#soc_name').val(),
                   
                    mill_id: $(this).val(),
                  
                }

            ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.pmt_bill_no + '">' + value.pmt_bill_no + '  ('+value.confed_bill_no+')</option>'

                });

                $('#pmt_bill_no').html(string);
               
                

            })

        });
</script>
