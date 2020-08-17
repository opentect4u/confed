    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Paddy Procurement</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>

                <small><a href="<?php echo site_url("paddy/paddycollection/add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>
                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>
            </h3>

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
                    
                        <th width="25px">Sl. No.</th>
                        <th width="50px">District</th>
                        <th>Date</th>
                        <th>Society</th>
                        <th width="25px">Camp No</th>
                        <th width="25px">Farmer No</th>
                        <th>Paddy</th>
                        <th width="50px">Farmer Details</th>
                        <th width="70px">Created By</th>
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
                    if($paddycollection_dtls) {

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

                                    foreach($paddycollection_dtls as $b_dtls) {

                                        if($b_dtls->dist == $blk_count->dist){

                                            if($j == 1){

                                ?>
                                                <td><?php echo date('d-m-Y', strtotime($b_dtls->trans_dt)); ?></td>
                                                <td><?php echo $b_dtls->soc_name; ?></td>
                                                <td><?php echo $b_dtls->no_of_camp; ?></td>
                                                <td><?php echo $b_dtls->no_of_farmer; ?></td>
                                                <td><?php echo $b_dtls->paddy_qty; ?></td>
                                                <td style="text-align: center;"><button class="btn btn-primary view" id="<?php echo $b_dtls->coll_no; ?>"><i class="fa fa-eye"></i></button></td>
                                                <td><?php echo $b_dtls->created_by; ?></td>

                                                <td>
                                
                                                    <a href="paddycollection/edit?coll_no=<?php echo $b_dtls->coll_no; ?>" 
                                                        data-toggle="tooltip"
                                                        data-placement="bottom" 
                                                        title="Edit"
                                                    >

                                                        <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                                        
                                                    </a>

                                                    <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->

                                                    <button 
                                                        type="button"
                                                        class="delete"
                                                        id="<?php echo $b_dtls->coll_no; ?>"
                                                        data-toggle="tooltip"
                                                        data-placement="bottom" 
                                                        title="Delete"
                                                        
                                                    >

                                                        <i class="fa fa-trash-o fa-2x" style="color: #bd2130"></i>

                                                    </button>
                                                    
                                                </td>

                                            </tr>                    

                                            <?php
                                            
                                            }

                                            else {

                                            ?>

                                                <tr>

                                                    <td><?php echo date('d-m-Y', strtotime($b_dtls->trans_dt)); ?></td>
                                                    <td><?php echo $b_dtls->soc_name; ?></td>
                                                    <td><?php echo $b_dtls->no_of_camp; ?></td>
                                                    <td><?php echo $b_dtls->no_of_farmer; ?></td>
                                                    <td><?php echo $b_dtls->paddy_qty; ?></td>
                                                    <td style="text-align: center;"><button class="btn btn-primary view"><i class="fa fa-eye"></i></button></td>
                                                    <td><?php echo $b_dtls->created_by; ?></td>

                                                    <td>
                                
                                                        <a href="paddycollection/edit?coll_no=<?php echo $b_dtls->coll_no; ?>" 
                                                            data-toggle="tooltip"
                                                            data-placement="bottom" 
                                                            title="Edit"
                                                        >

                                                            <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                                            
                                                        </a>

                                                        <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->

                                                        <button 
                                                            type="button"
                                                            class="delete"
                                                            id="<?php echo $b_dtls->coll_no; ?>"
                                                            data-toggle="tooltip"
                                                            data-placement="bottom" 
                                                            title="Delete"
                                                            
                                                        >

                                                            <i class="fa fa-trash-o fa-2x" style="color: #bd2130"></i>

                                                        </button>
                                                        
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
                        <th>Camp No</th>
                        <th>Farmer No</th>
                        <th>Paddy</th>
                        <th>Farmer Details</th>
                        <th>Created By</th>
                        <th>Option</th>

                    </tr>
                
                </tfoot>

            </table>
            
        </div>
        
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="width: 980px;" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Farmer Details</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="doc-view">
                    
                    </div>
                </div>
            </div>
        </div>
            
    </div>

<script>

    $(document).ready( function (){

        $('.delete').click(function () {

            var id = $(this).attr('id');

            var result = confirm("Do you really want to delete this record?");

            if(result) {

                window.location = "<?php echo site_url('paddy/paddycollection/delete?coll_no="+id+"');?>";

            }
            
        });

    });

</script>

<script>
   
    $(document).ready(function() {

    $('.confirm-div').hide();

        <?php if($this->session->flashdata('msg')){ ?>

            $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

        <?php } ?>

        $('.view').click(function(){
            
            $.get('<?php echo site_url("paddy/getFarmerDetails"); ?>',
                {
                    coll_no: $(this).attr('id')
                }
            )
            .done(function(data){
                $('#doc-view').html(data);
                $('#viewModal').modal('show');
            });
        })

    });

</script>
