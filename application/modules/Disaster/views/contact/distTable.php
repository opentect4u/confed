<link rel = "stylesheet" href= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src= "https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" ></script>
<script src= "https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" ></script>
<link rel = "stylesheet" href= "https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />


<div class="wraper">      
        
    <div class="row">
        
        <div class="col-lg-9 col-sm-12">

            <h1><strong>District Contacts</strong></h1>

        </div>

    </div>

    <div class="col-lg-12 container contant-wraper">    

        <h3>

            <small><a href="<?php echo site_url("Disaster/addDistContact");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
            <span class="confirm-div" style="float:right; color:green;"></span>

        </h3>

        <table class="table table-striped table-bordered table-hover" id="dataTables-example" >

            <thead>

                <tr>
                
                    <th>District</th>
                    <th>OC</th>
                    <th>Contact</th>
                    <th>DDMO</th>
                    <th>Contact</th>
                    <th>Option</th>

                </tr>

            </thead>

            <tbody>

                <?php
                    foreach($data as $key)
                    {
                ?>
                    <tr>

                        <td><?php echo $key->district_name; ?></td>
                        <td><?php echo $key->oc_name; ?></td>
                        <td><?php echo $key->oc_phn; ?></td>
                        <td><?php echo $key->ddmo_name; ?></td>
                        <td><?php echo $key->ddmo_phn; ?></td>
                        <td><a href="<?php echo site_url('Disaster/editDistContact/'.$key->sl_no.' '); ?>"><i class="fa fa-edit fa-fw fa-2x"></i></a></td>

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