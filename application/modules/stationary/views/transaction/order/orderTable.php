<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />



<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>Supply Order</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

        <h3>

            <small><a href="<?php echo site_url("stationary/addOrder");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
            <span class="confirm-div" style="float:right; color:green;"></span>

        </h3>

        <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="width:100%;">

            <thead>

                <tr>
                
                    <th>Confed Order No.</th>
                    <th hidden>Govt. Order No.</th>
                    <th>Project</th>
                    <th>Supplier</th>
                    <!-- <th>Amount(Rs.)</th> -->
                    <th>Option</th>
                    <th>Option</th>
                    
                </tr>

            </thead>

            <tbody>

                <?php
                    foreach($data as $key)
                    {
                ?>
                    <tr>

                        <td><?php echo $key->c_order_no.' DT '.$key->c_order_dt; ?></td>
                        <td hidden><?php echo $key->g_order_no; ?></td>
                        <td><?php echo $key->project; ?></td>
                        <td><?php echo $key->supplier; ?></td> 
                        <!-- <td><?php //echo $key->tot_amount; ?></td>  -->
            
                        <td><a href="<?php echo site_url('stationary/editOrder?order_no='.$key->c_order_no.'&order_dt='.$key->c_order_dt); ?>" ><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('stationary/deleteOrder?order_no='.$key->c_order_no.'&order_dt='.$key->c_order_dt.'&project='.$key->project_cd); ?>" onclick="return confirm('Are you sure you want to delete this item?');" ><i class="fa fa-trash fa-fw fa-2x"></i></a></td>
                        
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
        $('#dataTables-example').DataTable({
            "columnDefs": [
                { "width": "15%", "targets": 0 },
                { "width": "40%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "30%", "targets": 3 },
                { "width": "5%", "targets": 4 },
                { "width": "5%", "targets": 5 }
            ]
        });
    });
</script>