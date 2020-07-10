
<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>Bill Payment</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

        <h3>

            <small><a href="<?php echo site_url("stationary/addPaymentBill");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
            <span class="confirm-div" style="float:right; color:green;"></span>

        </h3>

        <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="width:100%;">

            <thead>

                <tr>
                    <th>Trans Cd</th>
                    <th>File Name</th>
                    <th>Page No.</th>
                    <th>Bank</th>
                     <th>S Bill Amt(Rs)</th> 
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

                        <td><?php echo $key->ref_no; ?></td>
                        <td><?php echo $key->file_name; ?></td>
                        <td><?php echo $key->page_no; ?></td>
                        <td><?php echo $key->bank; ?></td>
                        <td><?php echo $key->tot_s_bill; ?></td> 
                        <td><a href="<?php echo site_url('stationary/editBillPayment/'.$key->ref_no); ?>" ><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('stationary/deleteBillPayment/'.$key->ref_no); ?>" onclick="return confirm('Are you sure you want to delete this item?');" ><i class="fa fa-trash fa-fw fa-2x"></i></a></td> 
                        
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