<div class="wraper">      

<div class="col-md-8 container form-wraper">
<!-- <div class="row"> -->
        
       <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("paddys/updatewqsc");?>" onsubmit="return validate()" >
       <!-- <div class="form-header"> -->

                <div class="form-header">
                
                    <h4>WQSC EDIT</h4>
                
                </div>
             
                <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select name="dist" id="dist" class="form-control required" readonly>

                            <option value="">Select</option>

                            <?php

                                foreach($dist as $dlist){

                            ?>

                                <option value="<?php echo $dlist->district_code;?>"
                                <?php echo ($dlist->district_code == $lonkesh->dis_cd)?'selected':'';?>
                                ><?php echo $dlist->district_name;?></option>

                            <?php

                                }

                            ?>     

                        </select>

                    </div>
                   
                </div>

               
                <div class="form-group row">

                    <label for="bill_no" class="col-sm-2 col-form-label">Bill No.:<font color="red">*</font></label>

                    <div class="col-sm-10">

                        <input type="text"
                                class="form-control"
                                name="bill_no"
                                id="bill_no"
                                value="<?php echo $lonkesh->bill_no; ?> "  readonly
                                
                            />
                    </div>

                </div>  
                <div class="form-group row">

<!-- <label for="wqsc_no" class="col-sm-2 col-form-label">WQSC No.:<font color="red">*</font></label>

<div class="col-sm-10">

    <input type="text"
            class="form-control"
            name="wqsc_no"
            id="wqsc_no"
            value="<?php echo $lonkesh->wqsc_no; ?> "  
            
        />
</div>

</div>   -->

                <div class="form-group row">

                    <label for="pool_type" class="col-sm-2 col-form-label">Pool Type:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select class="form-control"
                                name="pool_type"
                                id="pool_type" readonly>

                            <option>Select</option>

                            <option value="S" <?php echo ($lonkesh->pool_type == 'S')?'selected':''; ?>>State Pool</option>

                            <option value="C" <?php echo ($lonkesh->pool_type == 'C')?'selected':''; ?>>Central Pool</option>

                            <option value="F" <?php echo ($lonkesh->pool_type == 'F')?'selected':''; ?>>FCI</option> 

                        </select>    

                    </div>

                       </div>     

<div class="row" style ="margin: 10px;">

<div class="form-group">

    <table class="table table-striped table-bordered table-hover">

<thead>

    <tr>

        <th width="15%">Wqsc<br>No</th>
        <th width="18%">Analysis<br>no.</th>
        <th  width="22%">Trn Date</th>
        <th width="15%">No <br>Bags</th>
        <th width="13%">Qty</th>
        <th width="11%">MSP/INS<br>/Bonus</th>
        <!-- <th><button type="button" class="btn btn-success addAnother"><i class="fa fa-plus"></i></button></th> -->

    </tr>
    <div class="row">

<div class="form-group">

    <table class="table table-striped table-bordered table-hover">
            
</thead>

<tbody id= "intro">

  <?php
     
foreach($wqsc_dtls  as $data)
    { 
      //  print_r($data);
       
    ?>
        <tr>

            <td>
            <input type="text" class="form-control"  style="width:110px" id="wqsc_no" name="wqsc_no[]"  value="<?php if(isset($data->wqsc_no)){ echo $data->wqsc_no ; } ?>"  />
            </td>
            
            <td>
            <input type="text" class="form-control" style="width:140px" id="analysis_no" name="analysis_no[]"  value="<?php if(isset($data->analysis_no)){ echo $data->analysis_no ; } ?>"  />
            </td>

            <td>
            <input type="date" class="form-control" style="width:175px" name="trn_dt[]" id="trn_dt" value= "<?php if(isset($data->trn_dt)){ echo $data->trn_dt ; } ?>"  />
            </td>

            <td>
            <input type="text" name="no_bags[]" id="no_bags	" style="width:110px" value= "<?php if(isset($data->no_bags)){ echo $data->no_bags ; } ?>" class="form-control"  />
            </td>

            <td>
            <input type="text" name="qty[]" id="qty	" style="width:90px" value= "<?php if(isset($data->qty)){ echo $data->qty ; } ?>" class="form-control"  />
            </td>
            <td>
            <input type="text" name="remarks[]" style="width:85px" id="remarks	" value= "<?php if(isset($data->remarks)){ echo $data->remarks ; } ?>" class="form-control"  />
            </td>
        </tr>
    

            <?php
             } ?>

     </tbody>   
</table>
</div>

</div>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save" />

                    </div>

                </div>

            
        
        </form>

    </div>
    

</div>



