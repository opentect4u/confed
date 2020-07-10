<div class="wraper">      

    <div class="col-md-7 container form-wraper">

        <form method="POST" id="form" action="<?php echo site_url("Disaster/entryNewPoint");?>" >
        
            <div class="form-header">
            
                <h4>Add New Agent</h4>
            
            </div>

            <div class="form-group row">

                <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select type="text" name="dist_cd" class="form-control required" id="dist_cd" >
                        <option value= "">Select District</option>
                        <?php
                            foreach($dist_data as $data)
                            { 
                            ?>
                                <option value="<?php echo ($data->district_code); ?>"><?php echo ($data->district_name); ?></option>
                        <?php
                            }
                            ?>

                    </select>

                </div>

            </div>

            <div class="form-group row">

                <label for="sdo" class="col-sm-2 col-form-label">SDO:</label>

                <div class="col-sm-4">

                    <!-- <input type="text" name="sdo" class="form-control " id="sdo" /> -->
                    <select name="sdo" id="sdo" class="form-control" >
                        <option value="">Select SDO</option>
                    </select>
        
                </div>

                <label for="bdo" class="col-sm-2 col-form-label">BDO:</label>

                <div class="col-sm-4">

                    <!-- <input type="text" name="bdo" class="form-control " id="bdo" /> -->
                    <select name="bdo" id="bdo" class="form-control" >
                        <option value="">Select BDO</option>
                    </select>
        
                </div>

            </div>

            <div class="row" style ="margin: 5px;">

                <div class="form-group">

                    <table class="table table-striped table-bordered table-hover">
                            
                        <thead>
                            
                            <tr>
                                <th>Agent Name</th>
                                <th>Contact No</th>
                                <th>Address</th>

                                <th> <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button> </th>
                            </tr>

                        </thead>
                            
                        <tbody id= "intro">

                            <tr>

                                <td>
                                
                                    <input type="text" name="agent[]" class="form-control" id="agent" required/>                                    

                                </td>
                                
                                <td>
                                    
                                    <input type="text" name="agent_phn[]" class="form-control" id="agent_phn"/>
                                        
                                </td>

                                <td>

                                    <input type="text" name="agent_adr[]" class="form-control" id="agent_adr" />

                                </td>

                            </tr>

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


<!-- For add row table -->
<script>

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
    
    });

</script>


<!-- For getting Sdo by selecting district AND bdo by selecting sdo -->
<script>

    $(document).ready(function(){

        $('#dist_cd').on('change', function(){

            var dist_cd = $(this).val();
            
            $.get('<?php echo site_url("Disaster/js_get_sdo_forDist"); ?>', {dist_cd:dist_cd})
            .done(function(data){

                var string = '<option>Select SDO</option>';
                $.each(JSON.parse(data), function(index, value){

                    string += '<option value= "'+value.sl_no+'">'+value.sdo_name+'</option>';  

                })
                $('#sdo').html(string);

            })

        })


        // For bdo 
        $('#sdo').on('change', function(){

            var sdo_cd = $(this).val();
            var dist_cd = $('#dist_cd').val();
            $.get('<?php echo site_url("Disaster/js_get_bdo_forSdo"); ?>', {sdo_cd:sdo_cd, dist_cd:dist_cd})
            .done(function(data){

                var string = '<option>Select BDO</option>';
                $.each(JSON.parse(data), function(index, value){

                    string += '<option value= "'+value.sl_no+'">'+value.bdo_name+'</option>';  

                })
                $('#bdo').html(string);

            })

        })


    })

</script>

<!-- For adding select2() function to first row -->
<script>

    $("#dist_cd").select2();
    $("#sdo").select2();
    $("#bdo").select2();

</script>