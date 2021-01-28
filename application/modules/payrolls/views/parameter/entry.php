<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" action="<?php echo site_url("Disaster/entryNewItem");?>" >
            

            <div class="form-header">
            
                <h4>Add New Item</h4>
            
            </div>

            <div class="form-group row">

                <label for="item_name" class="col-sm-2 col-form-label">Item Name:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <input type="hidden" name="item_no" class="form-control required" value= "<?php echo ($data->item_no) + 1; ?>" />
                    <input type="hidden" name="created_dt" class="form-control required" value= "<?php echo $date; ?>" />

                    <input type="text" name="item_name" class="form-control required" id="item_name" />
                            
                </div>

                <label for="unit" class="col-sm-2 col-form-label">Unit:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select class="form-control" name="unit" id="unit" required >
                        <option value= "">Select Unit</option>                                              
                        <option value= "MT">MT</option>                                              
                        <option value= "Qnt">Qnt</option>                                              
                        <option value= "Kg">Kg</option>                                              
                        <option value= "Lit">Lit</option>                                                
                        <option value= "Packet">Packet</option>                                                
                        <option value= "Piece">Piece</option>                                                
                    </select>
                
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