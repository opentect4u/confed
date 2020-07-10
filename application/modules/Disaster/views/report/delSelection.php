<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" id="form" role="form" name="report_form" action="<?php echo site_url("Disaster/Report/view_agentDel_report");?>" onsubmit="return validate()" >
            

            <div class="form-header">
            
                <h4>Agent Distribution Report</h4>
            
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
                    <span id= "alert1" ><font color="red">*Please Select Dostrict</font></span>                                        

                </div>

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
                    <span id= "alert2" ><font color="red">*Please Select Order No</font></span>                    

                </div>

            </div>

            <div class="form-group row">

                <label for="sdo_memo" class="col-sm-2 col-form-label">Memo No:<font color="red">*</font></label>

                <div class="col-sm-6">

                    <select type="text" name="sdo_memo" class="form-control required" id="sdo_memo" >
                        <option value= "0">Select Memo</option>

                    </select> 
                    <span id= "alert3" ><font color="red">*Please Select Memo</font></span>                                        

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
    $("#alert2").hide();
    var dist_cd     =   document.forms["report_form"]["dist_cd"];
    $("#alert1").hide();
    var sdo_memo    =   document.forms["report_form"]["sdo_memo"];
    $("#alert3").hide();

    function validate()
    {

        if(dist_cd.value == "0")
        {
            console.log("1");
            
            dist_cd.style.border = "1px solid red";
            $("#alert1").show();

            return false;
        }
        else if(order_no.value == "0")
        {
            console.log("2");

            order_no.style.border = "1px solid red";
            $("#alert2").show();

            return false;
        }
        else if(sdo_memo.value == "0")
        {
            console.log("3");

            sdo_memo.style.border = "1px solid red";
            $("#alert3").show();

            return false;

        }
        else
        {
            console.log("true");

            return true;
        }

    }

</script> 


<!-- To get sdo_memo as per WO selected  -->

<script>

    $(document).ready(function(){

       
        $('#order_no').change(function(){

            $.get( 

                '<?php echo site_url("Disaster/js_getMemo_perDist_perWO");?>',
                { 

                    order_no: $(this).val(),
                    dist_cd : $('#dist_cd').val()

                }

            ).done(function(data){

                var string1 = '<option value="0">Select Memo</option>';
                //var string2 = '<option value="">Select Memo</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string1 += '<option value="' + value.sdo_memo + '">' + value.sdo_memo + '</option>';
                    //string2 += '<option value="' + value.bdo_memo + '">' + value.bdo_memo + '</option>';

                });

                
                $('#sdo_memo').html(string1);
                //$('#bdo_memo').html(string2);

            });

        });


    });

</script>