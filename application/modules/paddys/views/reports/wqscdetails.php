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
                action="<?php echo site_url("report/wqscdetailsReport");?>" >

                <div class="form-header">
                
                    <h4>Bill Details</h4>
                
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
                               id  = "bill_no"
                               class="form-control required"
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

                        <h3>WEST BENGAL STATE CONSUMERS' CO-OPERATIVE FEDERATION LTD.</h3>

                        <h3>P-1, Hide Lane, Akbar Mansion, 3rd Floor, Kolkata-700073</h3>

                        <h3>WQSC Report</h3>

                    </div>
                    

                    <br>  

                    <table style="width: 100%;">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th>District</th>

                                <th>Pool Type</th>

                                <th>Date</th>

                                <th>Bill No.</th>

                                <th>WQSC No.</th>

                                <th>Analysis No.</th>

                                <th>No.of Bags</th>
                               
                                <th>Quantity</th>

                                <th>MSP/INS/Bonus</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($wqsc){

                                    foreach($wqsc as $wqscDtls){

                                        $i = 1;
                            ?>

                                        <tr>

                                            <td><?php echo $i++; ?></td>

                                            <td>
                                                <?php 

                                                    foreach($dist   as  $distDtls){

                                                        if($distDtls->district_code == $wqscDtls->dis_cd){
                                                            
                                                            echo $distDtls->district_name; 
                                                        }    
                                                    }    
                                                ?>
                                            </td>

                                            <td><?php if($wqscDtls->pool_type == 'S'){
                                                            echo "State Pool";
                                                        }elseif($wqscDtls->pool_type == 'C'){
                                                            echo "Central Pool";
                                                        }else{
                                                            echo "FCI";
                                                        }
                                                ?>
                                            </td>

                                            <td><?php echo date('d/m/Y',strtotime($wqscDtls->trn_dt)); ?></td>

                                            <td><?php echo $wqscDtls->bill_no; ?></td>

                                            <td><?php echo $wqscDtls->wqsc_no; ?></td>

                                            <td><?php echo $wqscDtls->analysis_no; ?></td>

                                            <td><?php echo $wqscDtls->no_bags; ?></td>

                                            <td><?php echo $wqscDtls->qty; ?></td>

                                            <td><?php echo $wqscDtls->remarks; ?></td>

                            <?php  

                                    }

                                }else{

                                        echo "<tr><td colspan='14' style='text-align:center;'>No Data Found</td></tr>";

                                }   

                            ?>

                        </tbody>

                    </table>

                    <div><br></div>

                    <div  class="bottom">
                        
                        <p style="display: inline;">Prepared By</p>

                        <p style="display: inline; margin-left: 8%;">Establishment, Sr. Asstt.</p>

                        <p style="display: inline; margin-left: 8%;">Assistant Manager-II</p>

                        <p style="display: inline; margin-left: 8%;">Chief Executive officer</p>

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