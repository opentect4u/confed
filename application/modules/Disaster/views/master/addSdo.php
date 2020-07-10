<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" action="<?php echo site_url("Disaster/addSdo");?>" >
            

            <div class="form-header">
            
                <h4>Add SDO</h4>
            
            </div>

            <div class="form-group row">

                <label for="unit" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                <div class="col-sm-10">

                    <select class="form-control" name="dist_cd" id="dist_cd" required >
                        <option value= "">Select District</option>                                              
                        <?php foreach($dist as $key){ ?>   
                            <option value="<?php echo $key->district_code; ?>"><?php echo $key->district_name; ?></option>
                        <?php } ?>                                            
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
                                <th> <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button> </th>
                            </tr>

                        </thead>
                            
                        <tbody id= "intro">

                            <tr>

                                <td>
                                    <input type="text" name="sdo_name[]" class="form-control sdo_name_cls" id="sdo_name"/>
                                    
                                </td>
                                <td>
                                    <input type="text" name="qty[]" class="form-control qty_cls" id="qty"/>
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


<!-- for addrow in table -->
<script>

    $(document).ready(function(){

        $("#addrow").click(function()
        {

            var newElement= '<tr><td><input type="text" name="sdo_name[]" class="form-control sdo_name_cls" id="sdo_name"/></td><td><input type="text" name="qty[]" class="form-control qty_cls" id="qty"/></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';

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

</script>