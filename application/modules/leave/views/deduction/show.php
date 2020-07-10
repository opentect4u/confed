<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("leave/adjustLeaveApplication");?>" >
            
            <div class="form-header">
            
                <h4>Add Leave Type</h4>
            
            </div>

            <?php foreach($data as $key){ ?>

                <input type="hidden" name= "trans_dt" id= "trans_dt" class= "form-control required" value= "<?php echo $key->trans_dt; ?>" readonly/>
                <input type="hidden" name= "trans_cd" id= "trans_cd" class= "form-control required" value= "<?php echo $key->trans_cd; ?>" readonly/>
                <input type="hidden" name= "emp_no" id= "emp_no" class= "form-control required" value= "<?php echo $key->emp_no; ?>" readonly/>

                <div class="form-group row">

                    <label for="docket_no" class="col-sm-2 col-form-label">Docket:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="text" name= "docket_no" value= "<?php echo $key->docket_no; ?>" id= "docket_no" class= "form-control required" readonly>

                    </div>


                    <label for="leave_type" class="col-sm-2 col-form-label">Leave:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <select name="leave_type" id="leave_type" class= "form-control required" readonly>
                        
                            <option value="<?php echo $key->leave_type; ?>"><?php echo $key->leave_type; ?></option>
                            
                        </select>
                        
                    </div>

                </div>

                <div class="form-group row">

                    <label for="from_dt" class="col-sm-2 col-form-label">From:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="date" name= "from_dt" id= "from_dt" value= "<?php echo $key->from_dt; ?>" class= "form-control required" value= "" readonly>

                    </div>

                    <label for="to_dt" class="col-sm-2 col-form-label">To:<font color="red">*</font></label>
                    <div class="col-sm-4">

                        <input type="date" name= "to_dt" id= "to_dt" value= "<?php echo $key->to_dt; ?>" class= "form-control required" value= "" readonly>

                    </div>

                </div>

                <div class="form-group row">

                <label for="no_of_days" class="col-sm-2 col-form-label">Total Days:</label>
                <div class="col-sm-4">

                    <input type="text" name= "no_of_days" id= "no_of_days" value= "<?php echo $key->no_of_days; ?>" class= "form-control required" value= "" readonly />

                </div>

            </div>

            <div class="form-group row">

                <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>
                <div class="col-sm-10">

                    <textarea name="remarks" id="remarks" class= "form-control required" cols="30" rows="2" readonly><?php echo $key->remarks; ?></textarea>

                </div>

            </div>

            <?php } ?>

            <div class="form-group row">

                <div class="col-sm-4">

                    <input type="submit" class="btn btn-success" id= "adjust" value="Adjust" />

                </div>

            </div>

        </form>

    </div>

</div>
