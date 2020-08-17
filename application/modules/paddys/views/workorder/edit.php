    <div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST" 
                action="<?php echo site_url("paddy/workorder/edit");?>" >

                <div class="form-header">
                
                    <h4>Workorder Edit</h4>
                
                </div>

                <input type="hidden"
                        name = "order_no"
                        id   = "order_no"
                        value="<?php echo $workorder_dtls->order_no;?>"
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
                                <?php echo ($dlist->district_code == $workorder_dtls->dist)?'selected':'';?>
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
                            class="form-control sch_cd"
                            name="soc_name"
                            id="soc_name"
                        >

                            <option value="">Select</option>    

                            <option value="">Select Block First</option>    

                        </select>    

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="mills" class="col-sm-2 col-form-label">Mill Names:</label>

                    <div class="col-sm-10">

                        <textarea id="mill_name" class="form-control" readonly></textarea>  

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>

                    <div class="col-sm-4">

                        <input type="date"
                            class="form-control required"
                            name="trans_dt"
                            id="trans_dt"
                            value="<?php echo $workorder_dtls->trans_dt;?>"
                        />

                    </div>

                    <label for="paddy_qty" class="col-sm-2 col-form-label">Paddy Qty:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="paddy_qty"
                            id="paddy_qty"
                            value="<?php echo $workorder_dtls->paddy_qty;?>"
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

<script>

    $("#form").validate();

    $( ".sch_cd" ).select2();

</script>

<script>

$(document).ready(function(){

    var global_dist = '<?php echo $workorder_dtls->dist ?>',
        global_block= '<?php echo $workorder_dtls->block ?>';

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

                    if(value.sl_no == '<?php echo $workorder_dtls->block; ?>'){
                        
                        selected = 'selected';

                    }else{

                        selected = '';

                    }

                    string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.block_name + '</option>'

                });

                $('#block').html(string);

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

                    var string   = '<option value="">Select</option>',
                        selected = '';

                $.each(JSON.parse(data), function( index, value ) {

                    if(value.sl_no == '<?php echo $workorder_dtls->soc_id; ?>'){
                        
                        selected = ' selected ';

                    }else{

                        selected = '';

                    }

                    string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                });

                $('#soc_name').html(string);

            });

        }

    socGroup('<?php echo $workorder_dtls->block ?>');
    millGroup('<?php echo $workorder_dtls->dist ?>');
    
    $('#block').change(function(){
        
        socGroup($(this).val());

    });

    $('#dist').change(function(){
        millGroup($(this).val());
    });


});
</script>

<script>

    $(document).ready(function(){

        function millList(val){

            $.get( 

                '<?php echo site_url("paddy/socmills");?>',

                { 

                    soc_id: val

                }

                ).done(function(data){

                    var string = '';

                    $.each(JSON.parse(data), function( index, value ) {

                    string += value.mill_name + ', ';

                });

                    $('#mill_name').html(string);

                });


        }

        millList('<?php echo $workorder_dtls->soc_id; ?>');

        $('#soc_name').change(function(){

            millList($(this).val());

        });

    });

</script>