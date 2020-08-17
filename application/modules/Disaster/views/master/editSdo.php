<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" action="<?php echo site_url("Disaster/updateSdo");?>" >
            

            <div class="form-header">
            
                <h4>Add SDO</h4>
            
            </div>

            <?php foreach($data as $key){ ?>

            <div class="form-group row">

                <label for="unit" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                <input type="hidden" value= "<?php echo $key->sl_no; ?>" name= "sl_no" >
                <input type="hidden" value= "<?php echo $key->dist_cd; ?>" name= "prev_dist_cd" >

                <div class="col-sm-10">

                    <select class="form-control" name="dist_cd" id="dist_cd" required >
                        <option value= "">Select District</option>                                              
                        <?php foreach($dist as $key1){ 
                            
                            ?> 
                                <option value="<?php echo $key1->district_code; ?>" <?php if($key1->district_code == $key->dist_cd) echo "selected"; ?> >
                                    <?php echo $key1->district_name; ?>
                                </option>
                            <?php 
                            } ?>                                            
                    </select>
                
                </div>

            </div>

            <div class="row" style ="margin: 5px;">

                <div class="form-group">

                    <table class="table table-striped table-bordered table-hover">
                            
                        <thead>
                            
                            <tr>
                                <th>SDO</th>
                                <th>QTY</th>
                                <!-- <th> <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button> </th> -->
                            </tr>

                        </thead>
                            
                        <tbody id= "intro">

                            <tr>

                                <td>
                                    <input type="text" name="sdo_name" class="form-control sdo_name_cls" value= "<?php echo $key->sdo_name; ?>" id="sdo_name"/>
                                </td>
                                <td>
                                <input type="text" name="qty" class="form-control qty_cls" value= "<?php echo $key->qty; ?>" id="qty"/>
                            </td>
                            </tr>
                            <tr>

                           

                            </tr>
                        </tbody>   

                    </table>

                </div>

            </div>

            <?php } ?>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>


    </div>

</div>



<!-- For adding select2() function to first row -->
<script>

    $("#dist_cd").select2();

</script>