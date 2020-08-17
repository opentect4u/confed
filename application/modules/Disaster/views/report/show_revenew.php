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

                        <h4>Date Wise Revenew In Disaster Management From <?php echo date("d-m-y",strtotime($start_dt)).' To '.date("d-m-y",strtotime($end_dt)); ?></h4>

                    </div>

                </div>

            </div>

            <br>
            
            <div>

                <table class="table table-striped" style="width: 100%;">
                    <!-- <caption><hr><?php //echo 'Order No.: '.$order_no.' DT '.date("d-m-y",strtotime($order_dt)); ?></caption> -->
                    <!-- <caption><?PHP //echo 'Item: '.strtoupper($item); ?><hr></caption> -->
                    <thead style = "text-align: center">
                        <tr>
                            
                            <td>Collection</td>  
                            <td>Payment</td>  
                            <td>Commission</td>
                            <td>Profit</td>
                            
                        </tr>
                    </thead>

                    <tbody style = "text-align: center">

                        <tr>
                    
                            <td><?php echo($income); ?></td> 
                            <td><?php echo($expense); ?></td> 
                            <td><?php echo($commission); ?></td>
                            <td><strong><?php echo($profit); ?></strong></td>
                            
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>
    
    </div>


</div>


<div class="modal-footer">

    <button class="btn btn-primary" type="button" onclick="location.href='<?php echo base_url('index.php/Disaster/Report/agentDistribution');?>'">Back</button>

    <button class="btn btn-primary" type="button" onclick="printDiv();">Print</button>

</div>
