<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" action="<?php echo site_url("Disaster/updateItemEntry");?>" >
            

            <div class="form-header">
            
                <h4>Edit Item</h4>
            
            </div>

            <?php foreach($data as $key){ ?>

                <div class="form-group row">

                    <label for="item_name" class="col-sm-2 col-form-label">Item Name:<font color="red">*</font></label>

                    <div class="col-sm-4">

                            <input type="hidden" name="item_no" class="form-control required" value= "<?php echo $no; ?>" />
                            <input type="hidden" name="modified_dt" class="form-control required" value= "<?php echo $date; ?>" />

                        <input type="text" name="item_name" class="form-control required" id="item_name" value= "<?php echo $key->item_name; ?>" />
                                
                    </div>

                    <label for="unit" class="col-sm-2 col-form-label">Unit:<font color="red">*</font></label>

                    <div class="col-sm-4">

                        <select class="form-control" name="unit" id="unit" required >
                            <option value= "<?php echo $key->unit; ?>"><?php echo $key->unit; ?></option>                                              
                            <option value= "MT">MT</option>                                              
                            <option value= "Qnt">Qnt</option>                                              
                            <option value= "Kg">Kg</option>                                              
                            <option value= "Lit">Lit</option>                                                
                            <option value= "Packet">Packet</option>                                                
                            <option value= "Piece">Piece</option>                                                
                        </select>
                    
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