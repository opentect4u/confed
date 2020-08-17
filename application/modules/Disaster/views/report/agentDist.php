<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="report_form" action="<?php echo site_url("Disaster/Report/view_agentDistReport");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Agent Distribution Report</h4>
            
            </div>

            <div class="form-group row">

                <label for="order_no" class="col-sm-2 col-form-label">Order No:<font color="red">*</font></label>
                <div class="col-sm-6">

                 <!--   <input type="text" name="order_no" class="form-control required" id="order_no" /> --> 
                    <select type="text" name="order_no" class="form-control required" id="order_no" >
                        <option value= "0">Select Order No</option>
                        <?php
                            foreach($data1 as $key)
                           { 
                            ?>
                                <option value="<?php echo ($key->order_no); ?>"><?php echo ($key->order_no).' DT '.date("d-m-y", strtotime($key->order_dt)); ?></option>
                        <?php
                            }
                            ?>

                    </select> 
                    <span id= "alert1" ><font color="red">*Please Select Order No</font></span>                    

                </div>

            </div>

            <div class="form-group row">

                <label for="dist_cd" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                <div class="col-sm-6">

                    <select type="text" name="dist_cd" class="form-control required" id="dist_cd" >
                        <option value= "0">Select District</option>
                        <?php
                            foreach($data as $key)
                           { 
                            ?>
                                <option value="<?php echo ($key->district_code); ?>"><?php echo ($key->district_name); ?></option>
                        <?php
                            }
                            ?>

                    </select> 
                    <span id= "alert2" ><font color="red">*Please Select DIstrict</font></span>                                        

                </div>

            </div>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Go" />

                </div>

            </div>

        </form>

    </div>

</div>


<!-- To check blank Field  -->
 
<script>

    var order_no    =   document.forms["report_form"]["order_no"];
    $("#alert1").hide();
    var dist_cd     =   document.forms["report_form"]["dist_cd"];
    $("#alert2").hide();

    function validate()
    {

        if(order_no.value == "0")
        {
            order_no.style.border = "1px solid red";
            $("#alert1").show();

            return false;
        }
        else if(dist_cd.value == "0")
        {
            dist_cd.style.border = "1px solid red";
            $("#alert2").show();

            return false;
        }
        else
        {
            return true;
        }

    }

</script> 