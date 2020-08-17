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

        <form method="POST" id="form" action="<?php echo site_url("Disaster/updateDistContact");?>" >
            

            <div class="form-header">
            
                <h4>Add New Contacts</h4>
            
            </div>

            <?php foreach($data as $key) { ?>

                    <div class="form-group row">

                        <label for="item_name" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <select type="text" name="dist_cd" class="form-control required" id="dist_cd" required>
                                <option value= "<?php echo $key->dist_cd; ?>"><?php echo $key->district_name; ?></option>
                                
                            </select>

                        </div>
                    
                    </div>

                    <input type="hidden" name= "sl_no" id= "sl_no" value= "<?php echo $key->sl_no; ?>" class="form-control required" >

                    <div class="form-group row">

                        <label for="oc_name" class="col-sm-2 col-form-label">OC Name:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="text" name= "oc_name" value= "<?php echo $key->oc_name; ?>" id= "oc_name" class="form-control required"  >

                        </div>

                        <label for="oc_phn" class="col-sm-2 col-form-label">OC Phn No:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="text" name= "oc_phn" value= "<?php echo $key->oc_phn; ?>" id= "oc_phn" class="form-control required"  >

                        </div>

                    </div>

                    <div class="form-group row">

                        <label for="ddmo_name" class="col-sm-2 col-form-label">DDMO Name:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="text" name= "ddmo_name" value= "<?php echo $key->ddmo_name; ?>" id= "ddmo_name" class="form-control required" required >

                        </div>

                        <label for="ddmo_phn" class="col-sm-2 col-form-label">DDMO Phn No:<font color="red">*</font></label>
                        <div class="col-sm-4">

                            <input type="text" name= "ddmo_phn" value= "<?php echo $key->ddmo_phn; ?>" id= "ddmo_phn" class="form-control required" required >

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
                                    
                                        <input type="text" name="sddmo_name" value= "<?php echo $key->sddmo_name; ?>" class="form-control required" id="sddmo_name" />
                                        
                                    </td>
                                    
                                    <td>
                                        
                                        <input type="text" name="sddmo_phn" value= "<?php echo $key->sddmo_phn; ?>" class="form-control required" id="sddmo_phn" />
                                            
                                    </td>

                                </tr>

                            </tbody>

                        </table>

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