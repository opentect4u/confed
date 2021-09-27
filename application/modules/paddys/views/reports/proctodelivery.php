<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid #dddddd;

    padding: 6px;

    font-size: 14px;
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
            '                                          table { border-collapse: collapse; font-size: 12px;}' +
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
                action="<?php echo site_url("report/proctodelivery");?>" >

                <div class="form-header">
                
                    <h4>Procurement To Delivery Report</h4>
                
                </div>

                <div class="form-group row">

                    <label for="from_date" class="col-sm-2 col-form-label">KMS Year:</label>

                    <div class="col-sm-10">

                        <select type="text"
                                class="form-control required sch_cd"
                                name="kms_year"
                                id="kms_year"
                        >

                            <option value="0">Select KMS Year</option>    

                            <?php 
                                 foreach($kms as $value){

                            ?>
                                <option value="<?php echo $value->sl_no;?>"><?php echo $value->kms_yr;?></option>  
                            <?php
                                 }
                            ?>  

                        </select>    

                    </div>

                </div>

                <div class="form-group row">

                    <label for="from_date" class="col-sm-2 col-form-label">From Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               name="from_date"
                               id  ="from_date"
                               class="form-control required"
                               value="<?php echo $sys_date;?>"
                               readonly
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="to_date" class="col-sm-2 col-form-label">To Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                               name="to_date"
                               id  ="to_date"
                               class="form-control required"
                               value="<?php echo $sys_date;?>"
                               readonly
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

                    <div style="text-align:center;">

                        <h2><?php echo $orgname->param_value; ?></h2>

                        <h3>P-1, Hide Lane, Akbar Mansion, 3rd Floor, Kolkata-700073</h3>

                        <h3>Procurement To Delivery Report Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h3>

                    </div>
                    

                    <br>  

                    <table style="width: 100%;" id="example">

                        <thead>

                            <tr>
                            
                                <th rowspan="2">Sl No.</th>

                                <th rowspan="2">District</th>

                                <th style="width: 25%" rowspan="2">Name of Society</th>

                                <th rowspan="2">Total Farmers (Registered)</th>

                                <th rowspan="2">Total No Of Camp</th>
                                
                                <th rowspan="2">Total No of Farmers</th>

                                <th rowspan="2">Progressive of Paddy Procurement (QT)</th>

                                <th style="width: 25%" rowspan="2">Name of the Rice Mill</th>

                                <th rowspan="2">Total quantity of paddy delivered to Rice Mill as per Receipt (QT)</th>

                                <th rowspan="2">Resultant CMR (QT)</th>

                                <th colspan="4">CMR Offered (QT)</th>

                                <th colspan="4">D.O. Issued From D.C. F&S (QT)</th>

                                <th colspan="4">Quantity of CMR delivered (QT)</th>
                               
                                <th rowspan="2">Yet to be delivered (QT)</th>

                            </tr>


                            <tr>
                                <th>Total</th>
                                <th>SP</th>
                                <th>CP</th>
                                <th>FCI</th>
                                
                                <th>Total</th>
                                <th>SP</th>
                                <th>CP</th>
                                <th>FCI</th>

                                <th>Total</th>
                                <th>SP</th>
                                <th>CP</th>
                                <th>FCI</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($mill_dtls){

                                    //For Sl No.
                                    $i = 1;
                                    
                                    foreach($mill_dtls as $mill_received){

                            ?>

                                        <tr>

                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $mill_received->district_name; ?></td>
                                            <td><?php echo $mill_received->soc_name; ?></td>
                                            <td><?php 
                                                    foreach($reg_farm as $farm_no){
                                                        if($mill_received->soc_id == $farm_no->soc_id){
                                                            echo $farm_no->farmer_no;
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td><?php
                                                    foreach($paddy_proc as $paddy_collc){
                                                        if($mill_received->soc_id == $paddy_collc->soc_id){
                                                            echo $paddy_collc->camp_no;
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td><?php
                                                    foreach($paddy_proc as $paddy_collc){
                                                        if($mill_received->soc_id == $paddy_collc->soc_id){
                                                            echo $paddy_collc->paddy_farmer_no;
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td><?php
                                                    foreach($paddy_proc as $paddy_collc){
                                                        if($mill_received->soc_id == $paddy_collc->soc_id){
                                                            echo $paddy_collc->paddy_qty;
                                                        }
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $mill_received->mill_name; ?></td>
                                            <td><?php echo $mill_received->paddy_qty; ?></td>
                                            <td><?php
                                                    foreach($cmr_offer as $offer){
                                                        if($mill_received->soc_id == $offer->soc_id && $mill_received->mill_id == $offer->mill_id){
                                                            echo $offer->resultant_cmr;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($cmr_offer as $offer){
                                                        if($mill_received->soc_id == $offer->soc_id && $mill_received->mill_id == $offer->mill_id){
                                                            echo $offer->tot_offered;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($cmr_offer as $offer){
                                                        if($mill_received->soc_id == $offer->soc_id && $mill_received->mill_id == $offer->mill_id){
                                                            echo $offer->sp;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($cmr_offer as $offer){
                                                        if($mill_received->soc_id == $offer->soc_id && $mill_received->mill_id == $offer->mill_id){
                                                            echo $offer->cp;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($cmr_offer as $offer){
                                                        if($mill_received->soc_id == $offer->soc_id && $mill_received->mill_id == $offer->mill_id){
                                                            echo $offer->fci;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($do_issue as $issue){
                                                        if($mill_received->soc_id == $issue->soc_id && $mill_received->mill_id == $issue->mill_id){
                                                            echo $issue->tot_doisseued;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($do_issue as $issue){
                                                        if($mill_received->soc_id == $issue->soc_id && $mill_received->mill_id == $issue->mill_id){
                                                            echo $issue->sp;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($do_issue as $issue){
                                                        if($mill_received->soc_id == $issue->soc_id && $mill_received->mill_id == $issue->mill_id){
                                                            echo $issue->cp;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($do_issue as $issue){
                                                        if($mill_received->soc_id == $issue->soc_id && $mill_received->mill_id == $issue->mill_id){
                                                            echo $issue->fci;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($cmr_deliver as $deliver){
                                                        if($mill_received->soc_id == $deliver->soc_id && $mill_received->mill_id == $deliver->mill_id){
                                                            echo $deliver->tot_delivery;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($cmr_deliver as $deliver){
                                                        if($mill_received->soc_id == $deliver->soc_id && $mill_received->mill_id == $deliver->mill_id){
                                                            echo $deliver->sp;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($cmr_deliver as $deliver){
                                                        if($mill_received->soc_id == $deliver->soc_id && $mill_received->mill_id == $deliver->mill_id){
                                                            echo $deliver->cp;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($cmr_deliver as $deliver){
                                                        if($mill_received->soc_id == $deliver->soc_id && $mill_received->mill_id == $deliver->mill_id){
                                                            echo $deliver->fci;
                                                        }
                                                    }
                                                ?>
                                            </td>

                                            <td><?php
                                                    foreach($to_deliver as $remain){
                                                        if($mill_received->soc_id == $remain->soc_id && $mill_received->mill_id == $remain->mill_id){
                                                            echo round(($remain->resultant_cmr - $remain->tot_delivery),2);
                                                        }
                                                    }
                                                ?>
                                            </td>
                                                    

                                        </tr>

                                    <?php    
                                            
                                        }
                                        
                                    }
                                    else{

                                        echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                    }   

                            ?>

                        </tbody>

                    </table>

                    <div  class="bottom">
                        
                        <p style="display: inline;">Prepared By</p>

                        <p style="display: inline; margin-left: 8%;">Establishment, Sr. Asstt.</p>

                        <p style="display: inline; margin-left: 8%;">Assistant Manager-II</p>

                        <p style="display: inline; margin-left: 8%;">Chief Executive officer</p>

                    </div>

                </div>   
                
                <div style="text-align: center;">

                    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

                    <button class="btn btn-primary" type="button" id="btnExport" >Excel</button>

                </div>

            </div>
            
        </div>
        
    <?php

    }

    ?> 
<script type="text/javascript">
    $(function () {
        $("#btnExport").click(function () {
            $("#example").table2excel({
                filename: "Procurement To Delivery Report Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
            });
        });
    });
</script>

<script>
    $(document).ready(function(){

        $("#kms_year").change(function(){

            $.get('<?php echo site_url("paddy/kms"); ?>',

                {
                    kms_yr:  $("#kms_year").val()
                }
            )

            .done(function(data){

                var data     = JSON.parse(data);

                var from_kms =  data[0].from_date;

                var to_kms   =  data[0].to_date;

                //var date = from_kms; //"2013-05-03";
                // var newdate = from_kms.split("-").reverse().join("/");
                //alert(newdate);

                $("#from_date").val(from_kms);

                $("#to_date").val(to_kms);


            });
				 

        });
    });
     
</script>