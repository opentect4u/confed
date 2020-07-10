<div class="wraper">  

    <div class="row">

        <div class="col-md-8 container form-wraper" style="margin-left: 210px;">

            <form method="POST" id="form" action="<?php echo site_url("Disaster/updateAgentEtntry");?>" >
            
                <div class="form-header">
                
                    <h4>Edit Agent</h4>
                
                </div>

                <?php
                    foreach($data as $key)
                    { 
                    ?>

                        <div class="form-group row">

                            <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                            <div class="col-sm-4">

                                <select type="text" name="dist_cd" class="form-control required" id="dist_cd" readonly>
                                <!--    <option value= "">Select District</option> -->
                                    
                                    <option value="<?php echo ($key->dist_cd); ?>"><?php echo ($key->district_name); ?></option>
                                

                                </select>

                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="sdo" class="col-sm-2 col-form-label">SDO:</label>

                            <div class="col-sm-4">

                                <input type="text" name="sdo" value="<?php echo ($key->sdo_name); ?>" class="form-control " id="sdo" readonly/>
                    
                            </div>

                            <label for="bdo" class="col-sm-2 col-form-label">BDO:</label>

                            <div class="col-sm-4">

                                <input type="text" name="bdo" value="<?php echo ($key->bdo_name); ?>" class="form-control " id="bdo" readonly/>
                    
                            </div>

                            <input type="hidden" name="sl_no" value="<?php echo ($key->sl_no); ?>" class="form-control " id="sl_no" readonly/>

                        </div>

                    <?php } ?>

                        <div class="row" style ="margin: 5px;">

                            <div class="form-group">

                                <table class="table table-striped table-bordered table-hover">
                                        
                                    <thead>
                                        
                                        <tr>
                                            <th>Point No</th>
                                            <th>Agent Name</th>
                                            <th>Contact No</th>
                                            <th>Address</th>

                                            <!-- <th> <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button> </th> -->
                                        </tr>

                                    </thead>

                                    <tbody id= "intro">

                                    <?php foreach($data1 as $key1){ ?>

                                        <tr>

                                            <td>
                                                
                                                <input type="text" name="point_no[]" value= "<?php echo $key1->point_no; ?>" class="form-control" id="point_no" readonly/>                                    

                                            </td>
                                            
                                            <td>
                                            
                                                <input type="text" name="agent[]" value= "<?php echo $key1->agent; ?>" class="form-control" id="agent" required/>                                    

                                            </td>
                                            
                                            <td>
                                                
                                                <input type="text" name="agent_phn[]" value= "<?php echo $key1->agent_phn; ?>" class="form-control" id="agent_phn"/>
                                                    
                                            </td>

                                            <td>

                                                <input type="text" name="agent_adr[]" value= "<?php echo $key1->agent_adr; ?>" class="form-control" id="agent_adr" />

                                            </td>

                                        </tr>

                                        <?php } ?>
                                        
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

</div>


<!-- For add row table -->
<!-- <script>

    $(document).ready(function(){

        $("#addrow").click(function()
        {

            var newElement= '<tr><td><input type="text" name="agent[]" class="form-control" id="agent" required/></td><td><input type="text" name="agent_phn[]" class="form-control" id="agent_phn"/></td><td><input type="text" name="agent_adr[]" class="form-control" id="agent_adr" /></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';

            $("#intro").append($(newElement));
                                                                
        });

        // to change the value of total field as per fees field selected by adding rows
        
        $("#intro").on("click","#removeRow", function(){
            $(this).parent().parent().remove();
            $('.amount_cls').change();
        });

    })

</script> -->