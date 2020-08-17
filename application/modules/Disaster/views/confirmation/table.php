<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>Yet to Confirm</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

        <h3>

           <!-- <small><a href="<?php //echo site_url("Disaster/addAgentDelivery");?>" class="btn btn-primary" style="width: 100px;">Approve</a></small> --> 
            <span class="confirm-div" style="float:right; color:green;"></span>

        </h3> 

        <table class="table table-striped table-bordered table-hover" id="dataTables-example" >

            <thead>

                <tr>
                
                    <th>Sl No</th>
                    <th>Order No</th>
                    <th>SDO Memo</th>
                    <th>BDO Memo</th>
                    <th>Purchase Bill</th>
                    <th>Sale Bill</th>
                    <th>Confirm</th>
                    
                </tr>

            </thead>

            <tbody>

                <?php 
                    $i = 1;
                    foreach($data as $key)
                    { ?>

                        <tr>
                        
                            <td><?php echo $i; ?></td>
                            <!-- <td><?php echo date("d-m-Y", strtotime($key->del_dt)); ?></td> -->
                            <td><?php echo $key->order_no.' DT '.date("d-m-Y", strtotime($key->order_dt)) ; ?></td>
                            <!-- <td><?php echo $key->order_no; ?></td> -->
                            <td><?php echo $key->sdo_memo; ?></td>
                            <td><?php echo $key->bdo_memo; ?></td>
                            <td><?php echo $key->pb_no.' DT '.date("d-m-Y", strtotime($key->pb_dt)); ?></td>
                            <td><?php echo $key->sb_no.' DT '.date("d-m-Y", strtotime($key->sb_dt)); ?></td>

                            <td><a href="<?php echo site_url('Disaster/confirmDelivery?trans_id='.$key->trans_id.'&trans_dt='.$key->trans_dt.' '); ?>" ><i class="fa fa-eye fa-fw fa-2x"></i></a></td>
                            
                        </tr>

                <?php
                    $i = $i+1;
                    } ?>
               
            </tbody>

            <tfoot>

                

            </tfoot>
        

        </table>

    </div>

</div>

<!-- DataTables JavaScript -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable();
    });
</script>