<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" action="<?php echo site_url("Disaster/updateBdo");?>" >
            

            <div class="form-header">
            
                <h4>Add BDO/Municipality</h4>
            
            </div>

            <?php foreach($data1 as $key1){ ?>

                <input type="hidden" name="sl_no" class="form-control" value= "<?php echo $key1->sl_no; ?>" />
                <input type="hidden" name="prev_sdo_cd" class="form-control" value= "<?php echo $key1->sdo_cd; ?>" />
                <input type="hidden" name="prev_dist_cd" class="form-control" value= "<?php echo $key1->dist_cd; ?>" />

            
            <div class="form-group row">

                <label for="dist" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>
                
                <div class="col-sm-4">

                    <select class="form-control" name="dist_cd" id="dist_cd" required >
                        <option value= "">Select District</option>                                              
                        <?php foreach($dist as $key){ ?>   
                            <option value="<?php echo $key->district_code; ?>" <?php if($key1->dist_cd == $key->district_code){echo "selected";} ?> >
                                <?php echo $key->district_name; ?>
                            </option>
                        <?php } ?>                                            
                    </select>
                
                </div>

                <label for="sdo" class="col-sm-2 col-form-label">SDO:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select class="form-control" name="sdo_cd" id="sdo_cd" required >
                        <option value= "<?php echo $key1->sdo_cd ?>"><?php echo $key1->sdo_name ?></option>                                              
                                                                    
                    </select>
                
                </div>

            </div>

            <div class="row" style ="margin: 5px;">

                <div class="form-group">

                    <table class="table table-striped table-bordered table-hover">
                            
                        <thead>
                            
                            <tr>
                                <th>BDO/Municipality</th>
                                <th>QTY</th>
                            </tr>

                        </thead>
                            
                        <tbody id= "intro">

                            <tr>

                                <td>
                                    <input type="text" name="bdo_name" class="form-control bdo_name_cls" value= "<?php echo $key1->bdo_name; ?>" id="bdo_name"/>
                                </td>
                                <td>
                                    <input type="text" name="qty" class="form-control qty_cls" value= "<?php echo $key1->qty; ?>" id="qty"/>
                                </td>
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


<!-- for addrow in table -->
<script>

    $(document).ready(function(){

        $("#addrow").click(function()
        {

            var newElement= '<tr><td><input type="text" name="bdo_name[]" class="form-control bdo_name_cls" id="bdo_name"/></td><td><input type="text" name="qty[]" class="form-control qty_cls" id="qty"/></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';

            $("#intro").append($(newElement));
                                                                
        });

        $("#intro").on("click","#removeRow", function(){
            $(this).parent().parent().remove();
        });
    
    });

</script>


<!-- For adding select2() function to first row -->
<script>

    $("#dist_cd").select2();
    $("#sdo_cd").select2();

</script>



<!-- Getting SDO name as per District selected -->
<script>

    $(document).ready(function(){

        $('#dist_cd').on('change', function(){

            var dist_cd = $(this).val();
            //console.log(dist_cd);
            $.get('<?php echo site_url("Disaster/js_get_sdo_forDist"); ?>', {dist_cd:dist_cd})
            .done(function(data){

                var string = '<option>Select SDO</option>';
                $.each(JSON.parse(data), function(index, value){

                    string += '<option value= "'+value.sl_no+'">'+value.sdo_name+'</option>';  

                })
                $('#sdo_cd').html(string);

            })

        })

    })

</script>