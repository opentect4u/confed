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

                        <h4>Bill Details From: <?php echo date("d-m-y",strtotime($startDt)).' To: '.date("d-m-y",strtotime($endDt)) ; ?> </h4>
                        
                    </div>

                </div>

            </div>

            <br>
            
            <div>

                <table class="table table-striped" style="width: 100%;">
                    <!-- <caption><hr><?php //echo 'Order No.: '.$order_no.' DT '.date("d-m-y",strtotime($order_dt)); ?></caption>
                    <caption><?PHP //echo 'Item: '.strtoupper($item); ?><hr></caption> -->
                    <thead style = "text-align: center">
                        <tr>
                              
                            <td><strong>Order No</strong></td>
                            <td><strong>Purchase Date</strong></td>  
                            <td><strong>Purchase Bill</strong></td>  
                            <td><strong>Purchase CGST</strong></td>  
                            <td><strong>Purchase SGST</strong></td>  
                            <td><strong>Purchase Amount</strong></td>
                            <td><strong>Sale Bill</strong></td>  
                            <td><strong>Sale CGST</strong></td>  
                            <td><strong>Sale SGST</strong></td>  
                            <td><strong>Sale Amount</strong></td>
                            
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                    <?php

                        $i = '';
                        $j = '';
                        $k = '';

                    ?>

                    <?php 
                        foreach($data as $key)
                        {
                        ?>

                            <tr>
                                <?php if($i == $key->order_no){ ?>
                                    <td></td>
                                <?php }
                                else{ ?>
                                    <td><?php echo($key->order_no); ?></td>
                                <?php }
                                if($j == $key->pb && $k == $key->pB_dt){ ?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <?php }else{ ?>
                                    <td><?php echo date("d-m-y",strtotime($key->pB_dt)); ?></td> 
                                    <td><?php echo($key->pb); ?></td>
                                    <td><?php echo($key->tot_p_cgst); ?></td>
                                    <td><?php echo($key->tot_p_sgst); ?></td>
                                    <td><?php echo($key->p_total); ?></td>
                                <?php } ?>
                                    
                                     
                                    <td><?php echo($key->sb); ?></td> 
                                    <td><?php echo($key->tot_s_cgst); ?></td>
                                    <td><?php echo($key->tot_s_sgst); ?></td>
                                    <td><?php echo($key->s_total); ?></td>
                                
                            </tr>

                            <?php   

                                $i = $key->order_no;
                                $j = $key->pb;
                                $k = $key->pB_dt;

                            ?>

                    <?php
                        }
                        ?>
                    
                    </tbody>

                    <tfoot style = "text-align: center">

                        <tr>
                            <td colspan="1" style="text-align: left;">
                                <strong>TOTAL:</strong>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <?php //foreach($pb_amount as $data1){ ?>

                                <td  style="text-align: center;">
                                    <strong><?php echo $pb_amount->pb_tot; ?></strong>
                                </td>

                            <?php //} ?>

                                <td></td>
                                <td></td>
                                <td></td>

                            <?php //foreach($totSb_amount as $data2){ ?>
                                <td style="text-align: center;">
                                    <strong><?php echo $totSb_amount->sb_tot; ?></strong>
                                </td>
                            <?php //} ?>

                        </tr> 

                    </tfoot>

                </table>

            </div>

        </div>
    
    </div>


</div>


<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/stationary/billReport');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>
