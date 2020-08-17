    <div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>WQSC</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

            <h3>

                <small><a href="<?php echo site_url("paddy/wqsc/add");?>" class="btn btn-primary" style="width: 100px;">Add</a></small>
                <span class="confirm-div" style="float:right; color:green;"></span>
                <div class="input-group" style="margin-left:75%;">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." id="search" style="z-index: 0;">
                </div>
            </h3>

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>District.</th>
                        <th>Pool.</th>
                        <th>Bill No.</th>
                        <th>WQSC No.</th>
                        <th>Trn Date</th>
                        <th>Option</th>

                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
                    if($wqc_dtls) {

                        $i = 1;

                        foreach($wqc_dtls as $b_list) {
                            // print_r($b_list);

                    ?>

                            <tr>
                                <td><?php echo $b_list->district_name; ?></td>
                                <td><?php echo $b_list->pool_type; ?></td>
                                
                               
                                <td><?php echo $b_list->bill_no; ?></td>
                               
                                <td><?php echo $b_list->wqsc_no; ?></td>
                                <!-- <td><?php echo $b_list->analysis_no; ?></td> -->
                               
                                <td><?php echo date('d-m-Y',strtotime($b_list->trn_dt)); ?></td>
                                <!-- <td><?php echo $b_list->no_bags; ?></td>
                                <td><?php echo $b_list->qty; ?></td>
                                <td><?php echo $b_list->remarks; ?></td> -->
                                <td>
                                
                                    <a href="wqsc/edit?bill_no=<?php echo $b_list->bill_no."&pool_type=".$b_list->pool_type."&dis_cd=".$b_list->dis_cd."{"; ?>" 
                                        data-toggle="tooltip"
                                        data-placement="bottom" 
                                        title="Edit"
                                    >

                                        <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
                                        
                                    </a>

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                     <button 
                                        type="button"
                                        class="delete"
                                        id="<?php echo $b_list->bill_no."&dis_cd=".$b_list->dis_cd."{";?>"
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

                    }

                    else {

                        echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td></tr>";

                    }

                    ?>
                
                </tbody>

                <tfoot>

                    <tr>
                       <th>District.</th>
                       <th>Pool.</th>
                       <th>Bill No.</th>
                       <th>WQSC No.</th>
                       <th>Trn Date</th>
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

                window.location = "<?php echo site_url('paddy/wqsc/delete?bill_no="+id+"');?>";

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
