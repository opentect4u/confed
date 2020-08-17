    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Date Wise Registered Farmers</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>

                <small><a href="<?php echo site_url("paddy/farmerreg/add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>
                
                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>
            </h3>

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                    
                        <th>Sl. No.</th>
                        <th>District</th>
                        <th>Date</th>
                        <th>Society</th>
                        <th>No of Farmer</th>
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
                    if($farmerreg_dtls) {

                        $i = 1;

                        foreach($dist_dtls as $blk_count) {

                            $j = 1;

                            foreach($dist as $d_list) {

                                if($d_list->district_code == $blk_count->dist) {
                        
                    ?>

                            <tr>

                                <td rowspan="<?php echo $blk_count->count;?>"><?php echo $i++; ?></td>
                                <td rowspan="<?php echo $blk_count->count;?>"><?php echo $d_list->district_name; ?></td>

                                <?php

                                    foreach($farmerreg_dtls as $b_dtls) {

                                        if($b_dtls->dist == $blk_count->dist){

                                            if($j == 1){

                                ?>
                                                <td><?php echo date('d-m-Y', strtotime($b_dtls->trans_dt)); ?></td>
                                                <td><?php echo $b_dtls->soc_name; ?></td>
                                                <td><?php echo $b_dtls->farmer_no; ?></td>

                                                <td>
                                
                                                    <a href="farmerreg/edit?reg_no=<?php echo $b_dtls->reg_no; ?>" 
                                                        data-toggle="tooltip"
                                                        data-placement="bottom" 
                                                        title="Edit"
                                                    >

                                                        <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                                        
                                                    </a>
                                                    
                                                </td>

                                            </tr>                    

                                            <?php
                                            
                                            }

                                            else {

                                            ?>

                                                <tr>

                                                    <td><?php echo $b_dtls->soc_name; ?></td>
                                                    <td><?php echo $b_dtls->farmer_no; ?></td>

                                                    <td>
                                
                                                        <a href="farmerreg/edit?order_no=<?php echo $b_dtls->order_no; ?>" 
                                                            data-toggle="tooltip"
                                                            data-placement="bottom" 
                                                            title="Edit"
                                                        >

                                                            <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                                            
                                                        </a>
                                                        
                                                    </td>

                                                <tr>

                                <?php

                                            }
                            
                                        }

                                    }
                                }
                            }        

                        }

                    }

                    else {

                        echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td></tr>";

                    }

                    ?>
                
                </tbody>

                <tfoot>

                    <tr>
                    
                        <th>Sl. No.</th>
                        <th>District</th>
                        <th>Date</th>
                        <th>Society</th>
                        <th>No of Farmer</th>
                        <th>Option</th>

                    </tr>
                
                </tfoot>

            </table>
            
        </div>

    </div>

<script>

    $(document).ready( function (){

        $('.delete').click(function () {

            var id = $(this).attr('id');

            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('paddy/farmerreg/delete?sl_no="+id+"');?>";

            }
            
        });

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
