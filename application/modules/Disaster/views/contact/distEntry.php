<style>

    table, td, th {
        text-align: center;
        border: 1px solid gray;
        }

    table {
        border-collapse: collapse;
        width: 100%;
        }

    th {
        height: 40px;
        width: 50px;
        }
    td {
        height: 40px;
        width: 50px;        
    }

</style>


<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" action="<?php echo site_url("Disaster/NewDistContact");?>" >
            

            <div class="form-header">
            
                <h4>Add New Contacts</h4>
            
            </div>

            <div class="form-group row">

                <label for="item_name" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select type="text" name="dist_cd" class="form-control required" id="dist_cd" required>
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

                <label for="oc_name" class="col-sm-2 col-form-label">OC Name:<font color="red">*</font></label>
                <div class="col-sm-4">

                    <input type="text" name= "oc_name" id= "oc_name" class="form-control "  >

                </div>

                <label for="oc_phn" class="col-sm-2 col-form-label">OC Phn No:<font color="red">*</font></label>
                <div class="col-sm-4">

                    <input type="text" name= "oc_phn" id= "oc_phn" class="form-control "  >

                </div>

            </div>

            <div class="form-group row">

                <label for="ddmo_name" class="col-sm-2 col-form-label">DDMO Name:<font color="red">*</font></label>
                <div class="col-sm-4">

                    <input type="text" name= "ddmo_name" id= "ddmo_name" class="form-control required" required >

                </div>

                <label for="ddmo_phn" class="col-sm-2 col-form-label">DDMO Phn No:<font color="red">*</font></label>
                <div class="col-sm-4">

                    <input type="text" name= "ddmo_phn" id= "ddmo_phn" class="form-control required" required >

                </div>

            </div>

            <div class="form-group row">
                    
                <table class="table table-striped">
                    
                    <thead>
                        
                        <tr>
                            <th>SDO Name</th>
                            <th>Phn No</th>

                            <th> <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button> </th>
                        </tr>

                    </thead>
                        
                    <tbody id= "intro">
                        <tr>

                            <td>
                            
                                <input type="text" name="sddmo_name[]" class="form-control required" id="sddmo_name" />
                                
                            </td>
                            
                            <td>
                                
                                <input type="text" name="sddmo_phn[]" class="form-control required" id="sddmo_phn" />
                                    
                            </td>

                        </tr>
                    </tbody>

                </table>

            </div>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>


    </div>

</div>


<!-- To add row in table -->

<script>

    $(document).ready(function(){

        $("#addrow").click(function()
        {

            var newElement= '<tr><td><input type="text" name="sddmo_name[]" class="form-control required" id="sddmo_name" /></td><td><input type="text" name="sddmo_phn[]" class="form-control required" id="sddmo_phn" /></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';

            $("#intro").append($(newElement));
                                                                
        });

        
        $("#intro").on("click","#removeRow", function(){
            $(this).parent().parent().remove();
            //$('.amount_cls').change();
        });


    });

</script>