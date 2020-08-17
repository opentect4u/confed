<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form method="POST" 
            id="form"
            action="<?php echo site_url("paddy/delivery/edit");?>" >

            <div class="form-header">
            
                <h4>CMR Delivery Edit</h4>
            
            </div>

            <input type="hidden"
                    name="trans_no"
                    value="<?php echo $cmrdelivery_dtls->trans_no;?>"
                />

            <div class="form-group row">

                <label for="dist" class="col-sm-2 col-form-label">District:</label>

                <div class="col-sm-4">

                    <select name="dist" id="dist" class="form-control required">

                        <option value="">Select</option>

                        <?php

                            foreach($dist as $dlist){

                        ?>

                            <option value="<?php echo $dlist->district_code;?>"
                            <?php echo ($dlist->district_code == $cmrdelivery_dtls->dist)?'selected':'';?>
                            ><?php echo $dlist->district_name;?></option>

                        <?php

                            }

                        ?>    

                    </select>

                </div>

                <label for="block" class="col-sm-2 col-form-label">Block:</label>

                <div class="col-sm-4">

                    <select name="block" id="block" class="form-control required">

                        <option value="">Select</option>    

                        <option value="">Select District First</option>    

                    </select>

                </div>

            </div>

            <div class="form-group row">

                <label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>

                <div class="col-sm-10">

                    <select type="text"
                        class="form-control required sch_cd"
                        name="soc_name"
                        id="soc_name"
                        >

                        <option value="">Select</option>    

                        <option value="">Select Block First</option>    

                    </select>    

                </div>

            </div>  

            <div class="form-group row">

                <label for="mill_name" class="col-sm-2 col-form-label">Mill Name:</label>

                <div class="col-sm-10">

                    <select type="text"
                        class="form-control required sch_cd"
                        name="mill_name"
                        id="mill_name"
                    >

                        <option value="">Select</option>    

                        <option value="">Select District First</option>    


                    </select>

                </div>

            </div>  

            <div class="form-group row">

                <label for="tot_do_isseued" class="col-sm-2 col-form-label">Total DO Isseued Including This:</label>

                <div class="col-sm-10">
                
                    <input type="text"
                            class="form-control"
                            name="tot_do_isseued"
                            id="tot_do_isseued"
                            readonly
                        />

                </div>

            </div>

            <div class="form-group row">

                <label for="state_pool_isseued" class="col-sm-2 col-form-label">State Pool:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control"
                        name="state_pool_isseued"
                        id="state_pool_isseued"
                        readonly
                    />   

                </div>

                <label for="central_pool_isseued" class="col-sm-2 col-form-label">Central Poll:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control"
                        name="central_pool_isseued"
                        id="central_pool_isseued"
                        readonly
                    />

                </div>   

                <label for="fci_isseued" class="col-sm-2 col-form-label">FCI:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control"
                        name="fci_isseued"
                        id="fci_isseued"
                        readonly
                    />

                </div>                 

            </div>

            <div class="form-group row">

                <label for="trans_dt" class="col-sm-2 col-form-label">Transaction Date:</label>

                <div class="col-sm-10">

                    <input type="date"
                            class="form-control required"
                            name="trans_dt"
                            id="trans_dt"
                            value="<?php echo $cmrdelivery_dtls->trans_dt; ?>"
                        />

                </div>

            </div>     

            <div class="form-header">

                <h4>CMR Delivery</h4>

            </div>

            <div class="form-group row">

                <label for="state_pool" class="col-sm-2 col-form-label">State Pool:</label>

                <div class="col-sm-2">

                    <input type="text"
                            class="form-control delivery_type"
                            name="state_pool"
                            id="state_pool"
                            value="<?php echo $cmrdelivery_dtls->sp; ?>"
                    />   

                </div>

                <label for="central_pool" class="col-sm-2 col-form-label">Central Poll:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control delivery_type"
                        name="central_pool"
                        id="central_pool"
                        value="<?php echo $cmrdelivery_dtls->cp; ?>"
                    />

                </div>   

                <label for="fci" class="col-sm-2 col-form-label">FCI:</label>

                <div class="col-sm-2">

                    <input type="text"
                        class="form-control delivery_type"
                        name="fci"
                        id="fci"
                        value="<?php echo $cmrdelivery_dtls->fci; ?>"
                    />

                </div>                 

            </div>
            
            <div class="form-group row">

                <label for="tot_cmr_delivery" class="col-sm-2 col-form-label">Total CMR delivery:</label>

                <div class="col-sm-10">

                    <input type="text"
                        class="form-control"
                        name="tot_cmr_delivery"
                        id="tot_cmr_delivery"
                        style="text-align: center"
                        value="<?php echo $cmrdelivery_dtls->tot_delivery; ?>"
                        readonly
                    />

                </div>                    

            </div>

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" id="submit" class="btn btn-info" value="Save" />

                </div>

            </div>

        </form>

    </div>

</div>

<script>

    $("#form").validate();

    $( ".sch_cd" ).select2();

</script>

<script>

    $(document).ready(function(){

        var global_dist = '<?php echo $cmrdelivery_dtls->dist ?>',
            global_block= '<?php echo $cmrdelivery_dtls->block ?>';

        function millGroup(dist) {

            //District Wise Block
            $.get( 

                '<?php echo site_url("paddy/blocks");?>',

                { 

                    dist: dist

                }

                ).done(function(data){

                    var string = '<option value="">Select</option>',
                        selected= '';

                    $.each(JSON.parse(data), function( index, value ) {

                        if(value.sl_no == '<?php echo $cmrdelivery_dtls->block ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.block_name + '</option>'

                    });

                    $('#block').html(string);

                });    


                //For District wise Mill
                $.get( 

                    '<?php echo site_url("paddy/mills");?>',

                    { 

                        dist: dist

                    }

                    ).done(function(data){

                    var string = '<option value="">Select</option>',
                        selected = '';

                    $.each(JSON.parse(data), function( index, value ) {

                        if(value.sl_no == '<?php echo $cmrdelivery_dtls->mill_id ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.mill_name + '</option>'

                    });

                    $('#mill_name').html(string);

                });
                
            

            } 

            function socGroup(block) { 

                //For Block wise Society
                $.get( 

                    '<?php echo site_url("paddy/societies");?>',

                    { 

                        block: block

                    }

                    ).done(function(data){

                    var string = '<option value="">Select</option>',
                        selected = '';

                    $.each(JSON.parse(data), function( index, value ) {

                        if(value.sl_no == '<?php echo $cmrdelivery_dtls->soc_id ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                    });

                    $('#soc_name').html(string);

                });

            }

        millGroup('<?php echo $cmrdelivery_dtls->dist ?>');

        socGroup( '<?php echo $cmrdelivery_dtls->block ?>');

        $('#dist').change(function(){

            millGroup($(this).val());

            socGroup('');

        });

        $('#block').change(function(){
            
            socGroup($(this).val());

        });

    });
</script>

<script>

    $(document).ready(function(){

        $('#mill_name').change(function(){
            
            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddy/delivered"); ?>',

                {

                    soc_id:  $('#soc_name').val(),

                    mill_id: $(this).val()

                }
            
            )
            .done(function(data){
                
                $('#tot_pdy_delivrd').val(data);

                if(data == '0.000'){

                    $('#submit').attr('type', 'button');

                }
                else{
    
                    $('#submit').attr('type', 'submit');

                }
                
            });

        });

    });

</script>

<script>

    $(document).ready(function(){

        function prevIsseued(soc_id, mill_id){

            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddy/totisseued"); ?>',

                {

                    soc_id:  soc_id,

                    mill_id: mill_id

                }

            )
            .done(function(data){
                
                let temp = JSON.parse(data);

                $('#tot_do_isseued').val(temp.tot);

                $('#state_pool_isseued').val(temp.sp);
                $('#central_pool_isseued').val(temp.cp);
                $('#fci_isseued').val(temp.fci);

                if(temp.tot == '0.000'){

                    $('#submit').attr('type', 'button');

                }
                else{

                    $('#submit').attr('type', 'submit');

                }
                
            });

        }

        prevIsseued('<?php echo $cmrdelivery_dtls->soc_id; ?>', '<?php echo $cmrdelivery_dtls->mill_id; ?>');

        $('#mill_name').change(function(){

            prevIsseued($('#soc_name'), $(this).val());

        });

        $('.delivery_type').change(function(){
            
            let total = 0;

            $("#tot_cmr_delivery").val('');
  
            $('.delivery_type').each(function(){
                
                total += +$(this).val();
                
            });

            if(total <= $('#tot_do_isseued').val()){

                $("#tot_cmr_delivery").val(total);

                $('#submit').attr('type', 'submit');

            }
            else{

                $('#submit').attr('type', 'button');

            }

        });

    });

</script>