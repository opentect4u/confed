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

<!-- <?php

    // function getIndianCurrency($number)
    //     {
    //         $decimal = round($number - ($no = floor($number)), 2) * 100;
    //         $hundred = null;
    //         $digits_length = strlen($no);
    //         $i = 0;
    //         $str = array();
    //         $words = array(0 => '', 1 => 'One', 2 => 'Two',
    //             3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
    //             7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
    //             10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
    //             13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
    //             16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
    //             19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
    //             40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
    //             70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    //         $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    //         while( $i < $digits_length ) {
    //             $divider = ($i == 2) ? 10 : 100;
    //             $number = floor($no % $divider);
    //             $no = floor($no / $divider);
    //             $i += $divider == 10 ? 1 : 2;
    //             if ($number) {
    //                 $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
    //                 $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
    //                 $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
    //             } else $str[] = null;
    //         }
    //         $Rupees = implode('', array_reverse($str));
    //         $paise = ($decimal) ? "and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    //         return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise .' Only.';
    //     }

?>  -->

<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET') {

?>        
    <div class="wraper">      

        <div class="col-md-6 container form-wraper">
    
            <form method="POST" 
                id="form"
                action="<?php echo site_url("report/paddydeclr");?>" >

                <div class="form-header">
                
                    <h4>Declaration of Procurement Report</h4>
                
                </div>


                <div class="form-group row">

<!-- <label for="dist" class="col-sm-2 col-form-label">District:</label>

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

</div> -->

<!-- <label for="block" class="col-sm-2 col-form-label">Block:</label>

<div class="col-sm-4">

    <select name="block" id="block" class="form-control required">

        <option value="">Select</option>    

        <option value="">Select District First</option>    

    </select>

</div> -->

</div>

<!-- <div class="form-group row">

<label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>

<div class="col-sm-10">

    <select type="text"
            class="form-control required sch_cd"
            id="soc_id"
            name="soc_name"
            
        >

        <option value="">Select</option>    

        <option value="">Select Block First</option>    

    </select>    

</div>

</div>  -->
                <div class="form-group row">

                    <label for="pool_type" class="col-sm-2 col-form-label">Pool Type:</label>

                    <div class="col-sm-10">

                        <select class="form-control required"
                                name="pool_type"
                                id="pool_type"
                            >

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

    <input type="text"  class="form-control"   name="bill_no"  id="bill_no"      />

</div>

</div>



<div class="form-group row">
    <label for="milled_paddy" class="col-sm-2 col-form-label">Milled Paddy:</label>

    <div class="col-sm-10">

        <input type="text"  class="form-control"   name="milled_paddy" id="milled_paddy" />

    </div>

</div>

                <div class="form-group row">

                    <label for="from_dt" class="col-sm-2 col-form-label">From Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                            class="form-control required"
                            name="from_dt"
                            value="<?php echo $_SESSION['sys_date'];?>"
                            />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="to_dt" class="col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                            class="form-control required"
                            name="to_dt"
                            value="<?php echo $_SESSION['sys_date'];?>"
                            />

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Proceed" />

                    </div>

                </div>

                <!-- <div class="form-group row">

                    <div class="col-sm-10">

                        <a href="">
                            <button class="btn btn-primary" type="button"><i class="fa fa-download"></i>Download Excle</button>                                
                        </a>  

                    </div>

                </div> -->

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
    
                        <div style="text-align:center;">
    
                            <h4><?php echo $orgname->param_value; ?></h4>
                            <h5>P-1, Hide Lane, Akbar Mansion,(3rd Floor), Kolkata-73,Gram: STAFECON<br>Ph No:(0)33-22377012/7013,033-22368942<br>e-mailId: confedwb.org@gmail.com,Wesite :www.confedwb.org.in</h5>
                            <!-- <h5>Ph NO:(0)33-22377012/7013,033-22368942</h5> -->
                            <!-- <h5>e-mailId: confedw.org@gmail.com,Wesite :www.confedwb.org.in</h5> -->

                        <?php if($bill_dtls){ ?>
                            
                            <span >----------------------------------------------------------------------------------------------------------------------------</span>
                            <h4>Declaration of Procurement of paddy & Delivery of CMR For the KMS <?php echo $bill_dtls->kms_yr; ?></h4>
                            <!-- <h4>Paddy & Delivery of CMR For the KMS <?php //echo $kms->kms_year; ?></h4> -->
                            <span >-----------------------------------------------------------------------------------------------------------------------------</span>
                            <!-- <h3><?php if($this->input->post('pool_type') == 'S'){
                                        echo 'State Pool';
                                      }
                                      else if($this->input->post('pool_type') == 'C'){ 
                                        echo 'Central Pool';
                                      }
                                      else if($this->input->post('pool_type') == 'F'){
                                        echo 'FCI';
                                      }
                                ?>
                            </h3> -->
                        </div>
    
                        <br>  
    
                        <!-- <table style="width: 100%;"> -->
    
                            <!-- <thead>
    
                                <tr> -->
                                
                                    <!-- <th>Bill No.</th> -->
    
                                    <span style="font-weight:bold;padding-RIGHT: 220px;">1. Date Of Purchase</span><?php echo ': '.date('d-m-Y', strtotime($this->input->post('from_dt'))). ' To '. date('d-m-Y', strtotime($this->input->post('to_dt'))); ?>
                                    <br>  
                                    <br>
                                    <br> 
                                    <span style="font-weight:bold;padding-RIGHT: 90px;">2. Name of Paddy Procurement Centre</span><?php echo ': '.$bill_dtls->centr_nm; ?>
                                    <br> 
                                    <br> 
                                    <br> 
                                    <span style="font-weight:bold ;padding-RIGHT: 145px;">3. Name of the Soceity through</span><?php echo ': '.$bill_dtls->skus_nm; ?><br>
                                    <span style="font-weight:bold ;align=center">&nbsp;&nbsp;&nbsp;which Paddy was procured</span>
                                    <br>
                                    <br> 
                                    <br> 
                                    
                                    <span style="font-weight:bold ;padding-RIGHT: 110px;">4. Total quantity of paddy procured </span><?php echo ': '.$bill_dtls->tot_qty.' QTL';?>
                                    <br>
                                    <br> 
                                    <br> 
                                    
                                    <span style="font-weight:bold;padding-RIGHT:68px;">5. Name of the farmers from whom paddy</span><?php echo ': '.'MSP Certificate Enclosed With This bill'?><br>
                                    <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;was procured by the soceity by issuing </span><br>
                                    <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;A/C payee cheque No., Date & Amount </span>
                                    <br>
                                    <br> 
                                    <br> 
                                    <span style="font-weight:bold ;padding-RIGHT:35px;">6. Name Of Rice Mill where from the procured</span> <?php echo ': '.$bill_dtls->mill_nm;?><br>
                                    <span style="font-weight:bold ;padding-RIGHT:60px;">&nbsp;&nbsp;&nbsp; paddy was milled specifying the quantity </span><?php echo $this->input->post('milled_paddy').' QTL';?><br>
                                    <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;of paddy milled</span>
                                    <br>
                                    <br> 
                                    <br> 
                                    <span style="font-weight:bold ;padding-RIGHT:55px;">7. Quantity of Rice delivered to DCF&S vide</span><?php echo ': '.$bill_dtls->cmr_qty.' QTL'?><br> 
                                    <span style="font-weight:bold">&nbsp;&nbsp;&nbsp;WQSC No. & date.MSP Value</span>
                                    <br>
                                    <br> 
                                    <br>
                                    <span style="font-weight:bold ;padding-RIGHT:160px;">8. Remaining paddy Balance</span><?php echo ': '.($bill_dtls->tot_qty - $this->input->post('milled_paddy')); ?>
                                    
                                    <br>
                                    <br>

                    <?php } ?> 
                                   
<!--     
                                </tr>
    
                            </thead> -->
    
                           
    
                        <!-- </table> -->
    
                        <div  class="bottom">
                            
                            <p style="display: inline;font-weight:bold">Prepared By</p>
    
                            <!-- <p style="display: inline; margin-left: 8%;">Establishment, Sr. Asstt.</p>
    
                            <p style="display: inline; margin-left: 8%;">Assistant Manager-II</p> -->
                          
                            <p style="display: inline; margin-left: 50%;font-weight:bold">Assistant Manager/ Deputy Manager</p>
    
                        </div>
    
                    </div>   
                    
                    <div style="text-align: center;">
    
                        <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>
    
                    </div>
<!-- 
                    <div style="text-align: center;">
                        <a class="btn btn-success" href="<?php echo site_url('paddy/downloadExcel'); ?>" id="downloadExcel"><i class="fa fa-download"></i>Download Excle</a>                                  
                    </div> -->

                </div>

                
                
            </div>
            
        <?php
    
        }
    
        ?> 
<script>

$(document).ready(function(){

    var i = 0;

    $('#bill_no').change(function(){

        //For District wise Block
        $.get( 

            '<?php echo site_url("report/verifyBill");?>',

            { 

                pool_type:$("#pool_type").val(),
                
                bill_no: $(this).val()

            }

        ).done(function(data){

            $.each(JSON.parse(data), function( index, value ) {

                $('#milled_paddy').val(value.paddy_qty);

            });

        });

    });

});
</script>