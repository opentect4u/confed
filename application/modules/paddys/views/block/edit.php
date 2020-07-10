    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST" 
                action="<?php echo site_url("paddy/block/edit");?>" >

                <div class="form-header">
                
                    <h4>Block Edit</h4>
                
                </div>

                <input type="hidden"
                        name = "sl_no"
                        id   = "sl_no"
                        value="<?php echo $block_dtls->sl_no;?>"
                    />

                <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">District:</label>

                    <div class="col-sm-10">

                        <select name="dist" class="form-control required">

                            <option value="">Select</option>

                            <?php

                                foreach($dist as $dlist){

                            ?>

                                <option value="<?php echo $dlist->district_code;?>"
                                    <?php echo ($dlist->district_code == $block_dtls->dist)?'selected':'';?>
                                    ><?php echo $dlist->district_name;?></option>

                            <?php

                                }

                            ?>     

                        </select>

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="name" class="col-sm-2 col-form-label">Block Name:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class= "form-control required"
                            name = "name"
                            id   = "name"
                            value="<?php echo $block_dtls->block_name;?>"
                        />

                    </div>

                </div> 

                <div class="form-group row">

                    <div class="col-sm-10">

                        <button type="submit" class="btn btn-info">Save</button>

                    </div>

                </div>

            </form>

        </div>

    </div>    