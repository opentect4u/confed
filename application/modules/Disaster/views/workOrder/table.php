<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>Work Order</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

        <h3>

            <small><a href="<?php echo site_url("Disaster/addWorkOrder");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
            <span class="confirm-div" style="float:right; color:green;"></span>

        </h3>

        <table class="table table-striped table-bordered table-hover" id="dataTables-example" >

            <thead>

                <tr>
                
                    <th>Order No</th>
                    <th>District</th>
                    <!-- <th>Item</th>
                    <th>Quantity</th>
                    <th>Unit</th> -->
                    <th>Edit</th>
                    <th>Delete</th>
                    
                </tr>

            </thead>

            <tbody>

                <?php
                    foreach($orderData as $key)
                    {
                ?>
                    <tr>

                        <td><?php echo $key->order_no.' DT '.date("d-m-Y", strtotime($key->order_dt)); ?></td> 
                        <!-- <td><?php //echo date("d-m-Y", strtotime($key->order_dt)); ?></td>                         -->
                        <td><?php echo $key->district_name; ?></td>
                        
                        <!-- <td><?php echo $key->item_name; ?></td>
                        <td><?php echo $key->allot_qty; ?></td>
                        <td><?php echo $key->unit; ?></td> -->
                        
                        <td><a href="<?php echo site_url('Disaster/editWorkOrderEntry?dist_cd='.$key->dist_cd.'&order_no='.$key->order_no.' '); ?>"><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('Disaster/deleteWorkOrderEntry?dist_cd='.$key->dist_cd.'&order_no='.$key->order_no.' '); ?>" onclick="return confirm('Are you sure you want to delete this item?');" ><i class="fa fa-trash fa-fw fa-2x"></i></a></td>

                    </tr> 

                <?php
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