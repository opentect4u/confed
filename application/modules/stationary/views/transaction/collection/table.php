<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>Cash Memo</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

        <h3>

            <small><a href="<?php echo site_url("stationary/addCollectionBill");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
            <span class="confirm-div" style="float:right; color:green;"></span>

        </h3>

        <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="width:100%;">

            <thead>

                <tr>
                    <th>Sl No</th>
                    <th>Date</th>
                    <th>Supplier.</th> 
                    <th>Mr.No.</th>
                    <th>Amount(Rs)</th>
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

                        <td><?php echo $key->lnk_sl_no; ?></td>
                        <td><?php echo date('d/m/Y',strtotime($key->trans_dt)); ?></td>
                        <td><?php echo $key->supplier; ?></td> 
                        <td><?php 
                                foreach($mrno as $key1){
                                    if($key1->lnk_sl_no == $key->lnk_sl_no){
                                        echo $key1->mr_no.',';
                                    }

                                }
                            ?>
                        </td>
                        <td><?php echo $key->amount; ?></td> 
                        
                        <td><a href="<?php echo site_url('stationary/editBillCollection/'.$key->lnk_sl_no); ?>" ><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('stationary/deleteBillCollection/'.$key->lnk_sl_no); ?>" onclick="return confirm('Are you sure you want to delete this item?');" ><i class="fa fa-trash fa-fw fa-2x"></i></a></td>
                        
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

<script>
   
    $(document).ready(function() {

    $('.confirm-div').hide();

    <?php if($this->session->flashdata('msg')){ ?>

    $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

    });

    <?php } ?>
</script>


