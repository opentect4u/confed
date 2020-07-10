<div class="wraper">      

<div class="col-md-6 container form-wraper">

    <form method="POST" 
        id="form"
        action="<?php echo site_url("paddy/received/edit");?>" >

        <div class="form-header">
        
            <h4>Delivery Edit</h4>
        
        </div>

        <input type="hidden"
                name="trans_no"
                value="<?php echo $paddyreceived_dtls->trans_no;?>"
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
                        <?php echo ($dlist->district_code == $paddyreceived_dtls->dist)?'selected':'';?>
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

            <label for="trans_dt" class="col-sm-2 col-form-label">Received Date:</label>

            <div class="col-sm-10">

                <input type="date"
                        class="form-control required"
                        name="trans_dt"
                        id="trans_dt"
                        value="<?php echo $paddyreceived_dtls->trans_dt ;?>"
                    />

            </div>

        </div> 

        <div class="form-group row">

            <label for="paddy_qty" class="col-sm-2 col-form-label">Paddy Delivered:</label>

            <div class="col-sm-4">

                <input type="number"
                        class="form-control"
                        name="paddy_qty"
                        id="paddy_qty"
                        min="0"
                        value="<?php echo $paddyreceived_dtls->paddy_qty ;?>"
                    />

            </div>

            <label for="progressive" class="col-sm-2 col-form-label">Progressive of Paddy Procurement:</label>

            <div class="col-sm-4">

                <input type="text"
                    class="form-control"
                    id="progressive"
                    readonly
                />

            </div>                    

        </div> 

        <div class="form-group row">

            <label for="trans_dt" class="col-sm-2 col-form-label">Already Delivered:</label>

            <div class="col-sm-4">

                <input type="text"
                        class="form-control"
                        id="already_delivered"
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

    var global_dist = '<?php echo $paddyreceived_dtls->dist ?>',
        global_block= '<?php echo $paddyreceived_dtls->block ?>';

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

                    if(value.sl_no == '<?php echo $paddyreceived_dtls->block ?>'){
                        
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

                    if(value.sl_no == '<?php echo $paddyreceived_dtls->mill_id ?>'){
                        
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

                    if(value.sl_no == '<?php echo $paddyreceived_dtls->soc_id ?>'){
                        
                        selected = 'selected';

                    }else{

                        selected = '';

                    }

                    string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                });

                $('#soc_name').html(string);

            });

        }

    millGroup('<?php echo $paddyreceived_dtls->dist ?>');

    socGroup( '<?php echo $paddyreceived_dtls->block ?>');

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

        function progressive(val){

            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddy/progressive"); ?>',

                {

                    soc_id: val

                }
            
            )
            .done(function(data){

                $('#progressive').val(data);

                if(data == '0.000'){

                    $('#submit').attr('type', 'button');

                }
                else{
    
                    $('#submit').attr('type', 'submit');

                }

            });

        }

        function alreadyDelivered(val){

            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddy/alreadyDelivered"); ?>',

                {

                    soc_id: val

                }

            )
            .done(function(data){

                $('#already_delivered').val(data);

                if(parseFloat(data) > parseFloat($('#progressive').val())){
                    
                    $('#submit').attr('type', 'button');

                }
                else{

                    $('#submit').attr('type', 'submit');

                }

            });

        }

        $('#soc_name').change(function(){
            
            progressive($(this).val());
            alreadyDelivered($(this).val());

        });

        alreadyDelivered('<?php echo $paddyreceived_dtls->soc_id; ?>');
        progressive('<?php echo $paddyreceived_dtls->soc_id; ?>');

        $('#paddy_qty').change(function(){
            
            if($('#already_delivered').val((parseFloat($(this).val()) + parseFloat($('#already_delivered').val()))) > parseFloat($('#progressive').val())){
                $('#submit').attr('type', 'button');
            }

        });
        
    });

</script>