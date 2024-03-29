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
                action="<?php echo site_url("report/procurementRep");?>" >

                <div class="form-header">
                
                    <h4>Districtwise & Societywise Paddy Report</h4>
                
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

                        <h3>Districtwise & Societywise Paddy Procurement Report Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?></h3>

                    </div>
                    

                    <br>  

                    <table style="width: 100%;" id="example">

                        <thead>

                            <tr>
                            
                                <th>Sl No.</th>

                                <th>District</th>

                                <th style="width: 25%">Name of Society</th>

                                <th>Total Farmers (Registered)</th>

                                <th>Total No Of Camp</th>
                                
                                <th>Total No of Farmers</th>

                                <th>Progressive of Paddy Procurement (QT)</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                                if($proc_dtls){

                                    //For Sl No.
                                    $i = 1;
                                    
                                    foreach($proc_dtls as $proc_val){

                            ?>

                                        <tr>

                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $proc_val->district_name; ?></td>
                                            <td><?php echo $proc_val->soc_name; ?></td>
                                            <td><?php 
                                                    foreach($farm_dtls as $farm_val){
                                                        if($proc_val->soc_id == $farm_val->soc_id){
                                                            echo $farm_val->farmer_no;
                                                        }
                                                    } 
                                                ?>
                                            </td>
                                            <td><?php echo $proc_val->camp_no; ?></td>
                                            <td><?php echo $proc_val->paddy_farmer_no; ?></td>
                                            <td><?php echo $proc_val->paddy_qty; ?></td>
                            
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
                filename: "Districtwise & Societywise Paddy Procurement Report Between <?php echo date("d-m-Y", strtotime($this->input->post('from_date'))).' To '.date("d-m-Y", strtotime($this->input->post('to_date')));?>.xls"
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