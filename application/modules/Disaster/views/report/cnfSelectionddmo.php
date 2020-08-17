<div class="wraper">      

    <div class="col-md-7 container form-wraper">
    <!--  -->
        <form role="form" name="approve_form" method="POST" id="form" action="<?php echo site_url("Disaster/Report/show_cnfReport");?>" onsubmit="return validate()" >
        
            <div class="form-header">
            
                <h4>Confirmation Of Delivery</h4>
            
            </div>

            <div class="form-group row">

                <div class="col-sm-4 hidden">

                    <select type="text" name="dist_cd" class="form-control required" id="dist_cd" >
                        <option value="0">Select District</option>
                        <?php
                            foreach($dist_data as $key)
                            { 
                            ?>
                                <option value="<?php echo ($key->district_code); ?>"><?php echo ($key->district_name); ?></option>
                        <?php
                            }
                            ?>

                    </select>
                    <span id= "alert1" ><font color="red">*Please Select District</font></span>

                </div>

                <label for="order_no" class="col-sm-2 col-form-label">Work Order:<font color="red">*</font></label>

                <div class="col-sm-4">

                    <select type="text" name="order_no" class="form-control required" id="order_no" >
                        
                        <option value= "0">Select Order No:</option>

                    </select>
                    <span id= "alert2" ><font color="red">*Please Select Order</font></span>

                </div>

            </div>
            
             
            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Proceed" />

                </div>

            </div>

        </form>
    
    </div>

</div>


<!-- To CHeck empty Field  -->

<script>

    var dist_cd    =   document.forms["approve_form"]["dist_cd"];
    $("#alert1").hide();
    var item    =   document.forms["approve_form"]["order_no"];
    $("#alert2").hide();
    
    /* function validate()
    {

        if(dist_cd.value == "0")
        {
            dist_cd.style.border = "1px solid red";
            $("#alert1").show();

            return false;
        }
        else if(item.value == "0")
        {
            item.style.border = "1px solid red";
            $("#alert2").show();

            return false;
            
        }
        else
        {

            $("#alert1").hide();            
            $("#alert2").hide();    

            return true;

        }

    } */

</script>

<!-- To get WO no as per dist_cd selection -->

<script>

    $(document).ready(function(){
        let dist = <?php echo $this->session->userdata('loggedin')->user_id; ?>;
        $('#dist_cd').val(dist);

        //$('#dist_cd').change(function(){

            $.get( 
                '<?php echo site_url("Disaster/js_get_orderNo_perDist");?>',
                { 
                    dist_cd: <?php echo $this->session->userdata('loggedin')->user_id; ?>
                }
            )
            .done(function(data){

                var string = '<option value="0">Select Order No:</option>';

                $.each(JSON.parse(data), function( index, value ) {
                    
                    var order_dt = value.order_dt; 
                    var parts = order_dt.split('-');
                    var myOrder_dt = parts[2] + '-' + parts[1] + '-' + parts[0]; // to change date formate

                    string += '<option value="' + value.order_no + '">' + value.order_no + ' DT '+ myOrder_dt +'</option>'
                    
                });
                
                var newElement = '<select class="form-control" name="order_no" id="order_no"> '+ string +' </select>'; 

                $("#order_no").html(newElement);
                
            });

        //});

    });

</script>
