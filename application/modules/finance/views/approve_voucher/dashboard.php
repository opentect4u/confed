<div class="wraper">      
        
        <div class="row">
            
            <div class="col-lg-9 col-sm-12">

                <h1><strong>Unapproved Vouchers</strong></h1>

            </div>

        </div>

        <div class="col-lg-12 container contant-wraper">    

           <!-- <h3>
                <a href="<?php echo site_url("finance/addBankVoucher");?>" class="btn btn-primary" style="width: 100px;">Add</a>
                    <span class="confirm-div" style="float:right; color:green;"></span>
            </h3>-->

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>
			<th>Date</th>
			<th>Voucher No.</th>
			<th>Type</th>
                        <th>Mode</th>
			<th>Amount</th>
			<th>Option</th>
                    </tr>

                </thead>

                <tbody> 

                    <?php 
                    
                    if($row) {
                            foreach($row as $value) {
		    ?>

                            <tr>
				<td><?php echo date('d/m/Y',strtotime($value->voucher_date)); ?></td>
				<td><?php echo $value->voucher_id; ?></td> 
				<td><?php $type = $value->voucher_type;
					  if($type=="P"){
					     $type = "Payment";
					  }else{
					     $type = "Receipt";		   
					  }
				        echo $type;			    
				     ?></td>
				<td><?php $mode = $value->voucher_mode;
					  If($mode=="C"){
					     $val ="Cash";	
					  }elseif($mode=="B"){
					     $val = "Bank"; 		   	
					  }else{
					     $val = "Transfer";	
					  }
		   			   echo $val; 
				     ?></td>
				<td><?php echo $value->amount;?></td>
				<td>
				    <a href="aproveVoucher/aproveVou?date=<?php echo $value->voucher_date;?>&
								       id=<?php echo $value->voucher_id;?>" 
                                        data-toggle="tooltip" data-placement="bottom" title="Edit">

                                        <i class="fa fa-edit fa-2x" style="color: #007bff"></i>
				    </a>
		

				  <!--  <button type="button" class="delete"
  					    date ="<?php echo $value->voucher_date; ?>" id="<?php echo $value->voucher_id; ?>"
                                    	    data-toggle="tooltip" data-placement="bottom" title="Delete">

                                    <i class="fa fa-trash-o fa-2x" style="color: #bd2130"></i>

                                </button>-->		 
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
                    
			<th>Date</th>
			<th>Voucher No.</th>
                        <th>Type</th>
                        <th>Mode</th>
			<th>Amount</th>
			<th>Option</th>
                    </tr>
                
                </tfoot>

            </table>
            
        </div>

    </div>

<script>

    $(document).ready(function() {

    <?php if($this->session->flashdata('msg')){ ?>
	window.alert("<?php echo $this->session->flashdata('msg'); ?>");
    });

    <?php } ?>
</script>


