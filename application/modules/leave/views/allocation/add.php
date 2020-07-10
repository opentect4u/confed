<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("leave/leaveAllocationEntry");?>" >
            

            <div class="form-header">
            
                <h4>New Leave Allocation</h4>
            
            </div>
            
            <div class="form-group row">

                <label for="type" class="col-sm-2 col-form-label">Allocate To:<font color="red">*</font></label>

                <div class="col-sm-8">

                    <select name="emp_no" id="emp_no" class= "form-control required" required>
                        <option value="">Select Employee</option>
                        <?php foreach($data as $key){ ?>
                            <option value="<?php echo $key->emp_code; ?>"><?php echo $key->emp_name; ?></option>
                        <?php } ?>
                        
                    </select>
                            
                </div>

            </div>
            <br>
            <div class="row" style ="margin: 5px;">

                <div class="form-group">

                    <table class="table table-striped table-bordered table-hover">
                            
                        <thead>
                            
                            <tr>
                                <th style= "text-align: center;">CL</th>
                                <th style= "text-align: center;">EL</th>
                                <th style= "text-align: center;">ML</th>
                                <th style= "text-align: center;">Off Day</th>
                            </tr>

                        </thead>
                            
                        <tbody id= "intro">

                            <tr>

                                <td>
                                    <input type="text" name= "cur_cl_bal" id= "cur_cl_bal" class= "form-control" readonly/>
                                </td>
                                
                                <td>                                 
                                    <input type="text" name="cur_el_bal" class="form-control" id="cur_el_bal" readonly/>                                       
                                </td>

                                <td>
                                    <input type="text" name="cur_ml_bal" class="form-control" id="cur_ml_bal" readonly/>
                                </td>

                                <td>
                                    <input type="text" name="cur_od_bal" class="form-control" id="cur_od_bal" readonly/>
                                </td>

                            </tr>

                            <tr>

                                <td>
                                    <input type="text" name= "cl_bal" id= "cl_bal" class= "form-control" />
                                </td>
                                
                                <td>                                 
                                    <input type="text" name="el_bal" class="form-control" id="el_bal" />                                       
                                </td>

                                <td>
                                    <input type="text" name="ml_bal" class="form-control" id="ml_bal" />
                                </td>

                                <td>
                                    <input type="text" name="od_bal" class="form-control" id="od_bal" />
                                </td>

                            </tr>

                        </tbody>   

                    </table>

                </div>
                
            </div>

            

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" id= "submit" value="Save" />

                </div>

            </div>

        </form>


    </div>

</div>



<!-- Getting current balance of leave by selecting  -->
<script>

    $(document).ready(function(){

        $('#emp_no').on('change', function(){

            var empId = $(this).val();
            
            $.get('<?php echo site_url("Leave/js_get_currentBal_forAllocation"); ?>', {emp_cd:empId})
            .done(function(data){

                var result = JSON.parse(data);
                if(result.length == 0)
                {
                    var cur_cl_bal = 0.0;
                    var cur_el_bal = 0.0;
                    var cur_ml_bal = 0.0;
                    var cur_od_bal = 0.0;
                }
                else
                {
                    var cur_cl_bal = result[0].cl_bal;
                    var cur_el_bal = result[0].el_bal;
                    var cur_ml_bal = result[0].ml_bal;
                    var cur_od_bal = result[0].od_bal;
                }

                $('#cur_cl_bal').val(cur_cl_bal);
                $('#cur_el_bal').val(cur_el_bal);
                $('#cur_ml_bal').val(cur_ml_bal);
                $('#cur_od_bal').val(cur_od_bal);

            })

        })

    })

</script>