<style>
table {
    
    border-collapse: collapse;
}

table, td, th {

    border: 1px solid #dddddd;

    padding: 6px;

    font-size: 12px;
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
            '                                          table { border-collapse: collapse; font-size: 10px;}' +
            '                                          th, td { border: 1px solid black; border-collapse: collapse; padding: 5px;}' +
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

    function getIndianCurrency($number)
        {
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
            return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise .' Only.';
        }

?> 

<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

?>        
    <div class="wraper">      

        <div class="col-md-6 container form-wraper">
    
            <form method="POST" 
                id="form"
                action="<?php echo site_url("report/millComm");?>" >

                <div class="form-header">
                
                    <h4>Mill Commission</h4>
                
                </div>
                    <div class="form-group row">

                    <label for="pool_type" class="col-sm-2 col-form-label">Pool Type:</label>

                    <div class="col-sm-10">

                        <select class="form-control required"
                                name="pool_type"
                                id="pool_type">

                            <option value="">Select</option>

                            <option value="S">State Pool</option>

                            <option value="C">Central Pool</option>
                            
                            <option value="F">FCI</option>

                        </select>    

                    </div>

                </div>
             

                

                <div class="form-group row">

                    <label for="bill_no" class="col-sm-2 col-form-label">Bill No.:</label>

                    <div class="col-sm-10">

                        <input type="text"
                               name="bill_no"
                               class="form-control required"
                               id="bill_no"
                            />

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
        
    ?>

        <div class="wraper"> 

            <div class="col-lg-12 container contant-wraper">
                
                <div id="divToPrint">

                    <div style="display: inline; margin: 0;">
                    
                        <div style="float:left;  margin-right: 10%; display: inline; margin-bottom: -10px;">

                            <h4>WEST BENGAL STATE MULTIPURPOSE <br> CONSUMERS' CO-OPERATIVE FEDERATION LTD.</h4> 

                        </div>

                        <div style="display: inline; margin-left: 15%; margin-right: 35px;">

                            <img src="<?php echo base_url("/confed.jpg");?>" style="height: 40px;" />

                        </div>

                    </div>

                    <hr style="width: 100%; margin: 0;">

                    <div style="text-align: center; height: 65px; font-size: 12px;">

                        <div style="text-align: center;">

                            <h5>ANNEXURE-VII</h5>

                        </div>

                        <div style="text-align: center; height: 65px; font-size: 12px;">

                            <h4>Claim For Milling Charge</h4>

                        </div>

                    </div>

                    <div>
                        <h5 style="display: inline;">Bill No: <?php echo $this->input->post("bill_no"); ?></h5>

                        <h5 style="margin-left: 65%; display: inline;">Date: <?php echo date('d-m-Y', strtotime(@$bill_dtls->bill_dt)); ?></h5>
                        
                    </div>

                    <br>

                    <div>
                        <?php if($bill_dtls) { ?>
                            <h5>Name Of Rice Mill: <?php echo $bill_dtls->mill_name; ?></h5>

                            <h5>Address: <?php echo $bill_dtls->mill_addr; ?></h5>
                        <?php } ?>
                    </div>
                   
                    <div>

                        <p>
                            Claimed towards Milling Charges to the F&S for KMS-<?php echo @$bill_dtls->kms_yr; ?>
                        </p>
                        
                    </div>

                    <table style="width: 100%;">

                        <thead>

                            <tr>
                                <th colspan="2">WQSC</th>
                                <th style="text-align: center;" colspan="2">Quantity </th>
                                <th rowspan="2">Rate Per qtl.Of Milling</th>
                                <th rowspan="2">Amt Claimed[Rs]</th>
                                <th rowspan="2">CGST @ 2.5% on Milling Charge</th>
                                <th rowspan="2">SGST @ 2.5% on Milling Charge</th>
                                <th rowspan="2">Total Amount Claimed[Rs]</th>
                            </tr>
                            <tr>
                                <th >No.</th>
                                <th style="text-align: center;">Variety of Rice </th>
                                <th>Bags(No.)</th>
                                <th>Quantity(Qtl)</th>  
                            </tr>

                        </thead>

                        <tbody> 

                            <?php 
                          
                                if($bill_dtls) {
                              
                            ?>
                                <tr>
                                    <td style="text-align:center;">(1)</td>
                                    <td style="text-align:center;">(2)</td>
                                    <td style="text-align:center;">(3)</td>
                                    <td style="text-align:center;">(4)</td>
                                    <td style="text-align:center;">(5)</td> 
                                    <td style="text-align:center;">(6)</td>
                                    <td style="text-align:center;">(7)</td>
                                    <td style="text-align:center;">(8)</td>
                                    <td style="text-align:center;">(9)</td>
                                </tr> 
                           
                                 <tr>
                                   <td style="text-align:center;">
                                        <?php 
                                            if(empty($wqsc->wqsc_no)){
                                                echo "0";
                                            }else{    
                                                echo $wqsc->wqsc_no;    
                                            }
                                        ?>    
                                   </td>
                                   <td style="text-align:center;">
                                            <?php
                                                if($bill_dtls->rice_type=='P'){
                                                    echo 'Par Boiled Rice';
                                                }else{
                                                    echo 'Raw Rice';
                                                }
                                            ?>
                                   </td>
                                   <td style="text-align:center;"></td>
                                   <td style="text-align:center;"><?=$bill_dtls->paddy_qty?></td>
                                    <td style="text-align:center;">
                                        <?php 
                                            if($bill_dtls->rice_type=='P'){
                                                echo $mandi_chrg->boiled_val;
                                            }else{
                                                echo $mandi_chrg->raw_val; 
                                            }             
                                        ?>   
                                    </td>
                                   <td style="text-align:center;"><?=$bill_dtls->comm_mill?></td>
                                    <td style="text-align:center;"><?=$bill_dtls->cgst_milling?></td>
                                   <td style="text-align:center;"><?=$bill_dtls->sgst_milling?></td>
                                 
                                   <td style="text-align:center;"><?php echo $totMillCrg = ($bill_dtls->comm_mill)+($bill_dtls->cgst_milling)+($bill_dtls->sgst_milling) ?></td>
                                 
                                    </tr>  
                                  
                                  
                            <?php

                                }else {

                                    echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";
                                }

                            ?>
                        
                        </tbody>

                    </table>
                    
                    <div style="font-size: 12px;">
                        <br>
                        <?php 
                            if($bill_dtls) { ?>
                                <p style="display:inline;">Rupees in Words: <?php echo getIndianCurrency($totMillCrg); ?>
                                <p style="display:inline; float:right;">GSTIN : 19AAAAW1196J1Z3</p>
                        <?php } ?>
                    </div>

                    <div  class="bottom">
                        
                        <p style="display: inline;">Prepared By</p>

                        <p style="display: inline; margin-left:45%;">Assistant Manager/Deputy Manager<br><span style="margin-left: 58%;">CONFED-WB</span></p>

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

        $("#form").validate();

    </script>