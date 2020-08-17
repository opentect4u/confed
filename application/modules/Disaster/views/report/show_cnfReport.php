<style>

    .header{
        padding: 10px;
    }

    .sticky{
        position: fixed;
    }

</style>

<script>

    function printDiv() {
        var divToPrint=document.getElementById('divToPrint');

        var WindowObject=window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;}' +
            '                                         .inline { display: inline; }' +
            '                                         .underline { text-decoration: underline; }' +
            '                                         .left { margin-left: 315px;} ' +
            '                                         .right { margin-right: 375px; display: inline; }' +
            '                                          table, th, td { border: 1px solid black; border-collapse: collapse; }' +
            '                                           th, td { padding: 5px; }' +
            '                                         .border { border: 1px solid black; } ' +
            '                                         .bottom { bottom: 5px; width: 100%; position: fixed; ' +
            '                                       ' +
            '                                   } } </style>');
        // WindowObject.document.writeln('<style type="text/css">@media print{p { color: blue; }}');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function(){ WindowObject.close();},10);

    }

</script>


<div id="divToPrint">

    <div class="wraper"> 

        <div class="col-lg-12 container contant-wraper">

            <div class="panel-heading">

                <div class="item_body">

                    <div style="text-align:center;">

                        <h3>WEST BENGAL STATE MULTIPURPOSE CONSUMERS' CO-OPERATIVE FEDERATION LTD.</h3>

                        <h3>P-1, Hide Lane, Akbar Mansion, 3rd Floor, Kolkata-700073</h3>

                        <h4>Confirmation Details FOR: <?php echo $district->district_name; ?></h4>

                    </div>

                </div>

            </div>

            <br>
            
            <div>

                <table class="table table-striped" style="width: 100%;">
                    <caption><hr><?php echo 'Order No: '.$order_no.' DT '.date("d-m-y",strtotime($order_dt->order_dt)) ; ?>
                   <?PHP echo ' | Item: '.strtoupper($item_name); ?><hr></caption> 
                    <thead style = "text-align: center" class= "header" id= "myHeader">
                        <tr>
                            
                            <td><strong>Memo No</strong></td>  
                            <td><strong>Bill No</strong></td>
                            <td><strong>Delivered <br> Qty(<?php echo $unit; ?>)</strong></td>  
                            <td><strong>Confirmed <br> Qty(<?php echo $unit; ?>)</strong></td>
                            <td><strong>Due <br> Qty(<?php echo $unit; ?>)</strong></td>
                         <!--   <td><strong>Rate <br> (Rs)</strong></td>  --> 
                            <!-- <td style="text-align: right;"><strong>Delivered <br> Amount(Rs)</strong></td> -->
                          <!--  <td><strong>Authority</strong></td> --> 
                          <!-- <td style="text-align: right;"><strong>Confirmed <br> Amount(Rs)</strong></td> -->
                          <!-- <td style="text-align: right;"><strong>Due <br> Amount(Rs)</strong></td> -->
                           <td><strong>Confirmation</strong></td> 

                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php 
                        foreach($data1 as $key)
                        {
                        ?>
                            <tr>
                             
                                <td><?php echo($key->sdo_memo); ?></td> 
                                <td><?php echo $key->bill_no.' DT '.date("d-m-Y", strtotime($key->bill_dt)) ; ?></td>
                                <td ><?php echo($key->del_qty); ?></td>
                                <td ><?php echo($key->cnf_qty); ?></td>
                                <td ><?php echo($key->due_qty); ?></td>

                             <!--   <td ><?php //echo ($key->rate); ?></td>   --> 

                                <!-- <td style="text-align: right;"><?php echo($key->del_amount); ?></td>  -->
                                <!-- <td style="text-align: right;"><?php echo($key->cnf_amount); ?></td>  -->
                                <!-- <td style="text-align: right;"><?php echo(($key->del_amount) - ($key->cnf_amount)); ?></td>  -->
                                
                            <?php if($key->cnf_memo == 0)
                                { ?>
                                
                                    <td>NC</td>
                                <?php
                                } 
                                else
                                { ?>

                                    <td ><?php echo 'CONFIRMATION RECD <br> VIDE MEMO NO '.$key->cnf_memo.'<br> DT '.date("d-m-y",strtotime($key->cnf_dt)) ; ?></td>
                                <?php
                                } ?>

                            </tr>

                    <?php
                        }
                        ?>
                    
                    </tbody>

                    <tfoot style = "text-align: center">
                       
                        <tr>
                            
                            <td colspan="2" style="text-align: left;">
                                
                                <strong>TOTAL:</strong>
                            </td>

                            <?php 
                            foreach($tot_data as $key1)
                            { ?>
                                <td colspan="1" style="text-align: center;">
                                    <?php echo $key1->delQty_tot; ?>
                                </td>
                
                                <td colspan="1" style="text-align: center;">
                                    <?php echo $key1->cnfQty_tot; ?>
                                </td>

                                <td colspan="1" style="text-align: center;">
                                    <?php echo $key1->dueQty_tot; ?>
                                </td>

                                <!-- <td colspan="1" style="text-align: right;">
                                    <?php echo $key1->delAmnt_tot; ?>
                                </td>

                                <td colspan="1" style="text-align: right;">
                                    <?php echo $key1->cnfAmnt_tot; ?>
                                </td>

                                <td colspan="1" style="text-align: right;">
                                    <?php echo ($key1->delAmnt_tot) - ($key1->cnfAmnt_tot); ?>
                                </td> -->

                                <td></td>

                            <?php
                            } ?>
                            
                        </tr> 

                    </tfoot>

                </table>

            </div>

        </div>
    
    </div>

</div>


<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php if($this->session->userdata('loggedin')->ddmo == 1){ echo base_url('index.php/Disaster/Report/confirmationddmo'); } else { echo base_url('index.php/Disaster/Report/confirmation');} ?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>

