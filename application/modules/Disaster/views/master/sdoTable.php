<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>SDO</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

        <h3>

            <small><a href="<?php echo site_url("Disaster/addSdo");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
            <span class="confirm-div" style="float:right; color:green;"></span>

        </h3>

        <table class="table table-striped table-bordered table-hover" id="dataTables-example" >

            <thead>

                <tr>
                
                    <th>Sl No.</th>
                    <th>SDO Name</th>
                    <th>QTY</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>

            </thead>

            <tbody>

                <?php
                    foreach($data as $key)
                    {
                ?>
                    <tr>

                        <td><?php echo $key->sl_no; ?></td>
                        <td><?php echo $key->sdo_name; ?></td>
                        <td><?php echo $key->qty; ?></td>
                        <td><a href="<?php echo site_url('Disaster/editSDOentry?slNo='.$key->sl_no.'&dist='.$key->dist_cd.' '); ?>"><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                        <td><a href="<?php echo site_url('Disaster/deleteSDOentry?slNo='.$key->sl_no.'&dist='.$key->dist_cd.' '); ?>" onclick="return confirm('Are you sure you want to delete this item?');" ><i class="fa fa-trash fa-fw fa-2x"></i></a></td>

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