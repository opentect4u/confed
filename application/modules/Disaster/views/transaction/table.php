<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>Agent Distribution</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

        <h3>

            <small><a href="<?php echo site_url("Disaster/addAgentDistribution");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
            <span class="confirm-div" style="float:right; color:green;"></span>

        </h3>

        <table class="table table-striped table-bordered table-hover" id="dataTables-example" >

            <thead>

                <tr>
                
                    <th>Sl No</th>
                    <th>District</th>                    
                    <th>Order No</th>
                    <th>SDO Memo</th>
                    <th>BDO Memo</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    
                </tr>

            </thead>

            <tbody>

                <?php
                    $i = 1;
                    foreach($data as $key)
                    { 
                ?>
                    <tr>

                        <td><?php echo $i; ?></td>
                        <td><?php echo $key->district_name; ?></td> 
                        <td><?php echo $key->order_no.' DT '.date("d-m-Y", strtotime($orderDt->order_dt)); ?></td>
                        <td><?php echo $key->sdo_memo; ?></td>
                        <td><?php echo $key->bdo_memo; ?></td>
                     <!--   <td><?php //echo $key->sdo_memo.'<br>'.$key->bdo_memo; ?></td> -->
                        <!-- <td><?php echo $key->allot_qty; ?></td> -->
                        
                        <td><a href="<?php echo site_url('Disaster/editAgentDistribution?order_no='.$key->order_no.'&dist_cd='.$key->dist_cd.'&sl_no='.$key->sl_no.' '); ?>"><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('Disaster/deleteAgentDistribution?order_no='.$key->order_no.'&dist_cd='.$key->dist_cd.'&sl_no='.$key->sl_no.' '); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash fa-fw fa-2x"></i></a></td>

                    </tr> 

                <?php
                    $i = $i+1;    
                }
                ?>

            </tbody>

        </table>

    </div>

</div>

<!-- DataTables JavaScript -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable();
    });
</script>