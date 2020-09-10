<div class="wraper">      

        <div class="col-md-6 container form-wraper">   

            <form method="POST"
                id="form"
                enctype="multipart/form-data"
                action="<?php echo site_url("paddy/paddycollection/edit");?>" >

                <div class="form-header">
                
                    <h4>Paddy Collection Edit</h4>
                
                </div>
                
                <input type="hidden"
                        name = "coll_no"
                        id   = "coll_no"
                        value="<?php echo $paddycollection_dtls->coll_no;?>"
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
                                <?php echo ($dlist->district_code == $paddycollection_dtls->dist)?'selected':'';?>
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

                    <label for="trans_dt" class="col-sm-2 col-form-label">Date:</label>

                    <div class="col-sm-10">

                        <input type="date"
                            class="form-control required"
                            name="trans_dt"
                            id="trans_dt"
                            value="<?php echo $paddycollection_dtls->trans_dt ;?>"
                        />

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="paddy_qty" class="col-sm-2 col-form-label">Paddy Qty:</label>

                    <div class="col-sm-10">

                        <input type="text"
                            class="form-control required"
                            name="paddy_qty"
                            id="paddy_qty"
                            value="<?php echo $paddycollection_dtls->paddy_qty ;?>"

                        />

                    </div>

                </div> 

                <div class="form-group row">

                    <label for="no_of_camp" class="col-sm-2 col-form-label">No of Camp:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="no_of_camp"
                            id="no_of_camp"
                            value="<?php echo $paddycollection_dtls->no_of_camp ;?>"

                        />

                    </div>

                    <label for="no_of_farmer" class="col-sm-2 col-form-label">No of Farmers:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control required"
                            name="no_of_farmer"
                            id="no_of_farmer"
                            value="<?php echo $paddycollection_dtls->no_of_farmer ;?>"

                        />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="registered" class="col-sm-2 col-form-label">Registered Farmers No:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control"
                            id="registered"
                            readonly
                        />

                    </div>

                    <label for="totnofarmer" class="col-sm-2 col-form-label">Total No of Farmer:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control"
                            id="totnofarmer"
                            readonly
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="progressive" class="col-sm-2 col-form-label">Progressive of Paddy Procurement:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control"
                            id="progressive"
                            readonly
                        />

                    </div> 

                    <label for="workorder" class="col-sm-2 col-form-label">Work order:</label>

                    <div class="col-sm-4">

                        <input type="text"
                            class="form-control"
                            id="workorder"
                            readonly
                        />

                    </div>                   

                </div> 

                <div class="form-group row">

                    <div class="col-md-4">
                            
                        <label for="" class="control-label">Choose Payment Type:</label>

                        <div class="demo-radio-button">
                            
                            <input name="group" class="type" id="radio_1" type="radio" checked />
                            <label for="radio_1">NEFT</label>
                            <input name="group" class="type" id="radio_2" type="radio" />
                            <label for="radio_2">Cheque</label>

                        </div>

                    </div>

                </div>

                <div class="form-group row neft">

                    <label for="f_payment" class="col-sm-2 col-form-label">Farmer Payment NEFT:</label>

                    <div class="col-sm-10">

                        <input type="file" 
                               name="f_payment" 
                               class="form-control"  
                        />

                    </div>
                
                </div>

                <div class="form-group row cheque">

                    <label for="f_payment_cheque" class="col-sm-2 col-form-label">Farmer Payment Cheque:</label>

                    <div class="col-sm-10">

                        <input type="file" 
                               name="f_payment_cheque" 
                               class="form-control"  
                        />

                    </div>
                
                </div>

                <div class="form-group row">
                    
                    <label class="col-sm-2 col-form-label">Bank Statement:</label>

                    <div class="col-sm-4">

                        <input type="checkbox" name="bank_statement">

                    </div>

                    <label class="col-sm-2 col-form-label">Dummy Report:</label>

                    <div class="col-sm-4">

                        <a href="<?php echo base_url('downloads/dummy.csv'); ?>" title="Download" class="btn btn-success" download><i class="fa fa-file-text-o fa-lg" aria-hidden="true"></i></a>

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <button type="submit" id="submit" class="btn btn-info">Save</button>

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

        var global_dist = '<?php echo $paddycollection_dtls->dist ?>',
            global_block= '<?php echo $paddycollection_dtls->block ?>';

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

                        if(value.sl_no == '<?php echo $paddycollection_dtls->block; ?>'){
                            
                            selected = ' selected ';

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

                    var string = '<option value="">Select</option>',
                        selected = '';

                    $.each(JSON.parse(data), function( index, value ) {

                        if(value.sl_no == '<?php echo $paddycollection_dtls->soc_id ?>'){
                            
                            selected = 'selected';

                        }else{

                            selected = '';

                        }

                        string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.soc_name + '</option>'

                    });
                    
                    $('#soc_name').html(string);

                });

            }

        
        socGroup('<?php echo $paddycollection_dtls->block; ?>');
        millGroup('<?php echo $paddycollection_dtls->dist; ?>');
        
        $('#block').change(function(){
            
            socGroup($(this).val());

        });

    });
</script>

<script>

    $(document).ready(function(){

        function soc_dtls(val){

            //Registered Farmer
            $.get('<?php echo site_url("paddy/regfarmer"); ?>',

                {

                    soc_id: val

                }
            
            )
            .done(function(data){

                $('#registered').val(data);

            });

            //Progressive Paddy Procurement
            $.get('<?php echo site_url("paddy/progressive"); ?>',

                {

                    soc_id: val

                }
            
            )
            .done(function(data){

                $('#progressive').val(data);

                // if(data == '0'){

                //     $('#submit').attr('type', 'button');

                // }
                // else{
                //     $('#submit').attr('type', 'submit');
                // }

            });

            //Total Work order
            $.get('<?php echo site_url("paddy/totorder"); ?>',

                {

                    soc_id: val

                }
            
            )
            .done(function(data){

                $('#workorder').val(data);

            });

        }

        $('#soc_name').change(function(){

            soc_dtls($(this).val());
            
        });

        soc_dtls('<?php echo $paddycollection_dtls->soc_id ?>');
        
    });

</script>

<script>

    $(document).ready(function(){

        function farmer_no(val){

            $.get('<?php echo site_url("paddy/totfarmer"); ?>',

                {

                    soc_id: val

                }
            
            )
            .done(function(data){
                
                $('#totnofarmer').val(parseInt(data) + parseInt($('#no_of_farmer').val()));

            });

        }

        function farmer_no_prev(val){

            $.get('<?php echo site_url("paddy/totfarmer"); ?>',

                {

                    soc_id: val

                }

            )
            .done(function(data){
                
                $('#totnofarmer').val(data);

            });

            }

        $('#no_of_farmer').change(function(){

            farmer_no($('#soc_name').val());

        });

        farmer_no_prev('<?php echo $paddycollection_dtls->soc_id ?>');

        $('form').submit(function(event){

            var data = $('#registered').val();
                

            if(data == '0'){

                alert("Number of register farmer Can not be Zero");
                event.preventDefault();
            }
            else if(parseFloat($('#paddy_qty').val()) > parseFloat($('#workorder').val())){

                alert("Paddy Qty Can not be Greater Than Work Order");
                event.preventDefault();
            }
            else if(parseFloat($('#progressive').val()) > parseFloat($('#workorder').val())){

                alert("Progressive Qty Can not be Greater Than Work Order");
                event.preventDefault();
            }
            else if(parseInt($('#no_of_farmer').val()) > parseInt($('#registered').val())){
                
                alert("No of farmer Can not be Greater Than Work Order");
                event.preventDefault();
            }
            else{
                $('#submit').attr('type', 'submit');
            }

        });

    });

</script>

<script>

    $(document).ready(function(){
        
        $('.cheque').hide();

        $('.type').change(function(){
            
            if(!$('.cheque').is(":visible")){
                $('#emp_code').val('');
                $('.neft').hide();
                $('.cheque').show();
            }
            else{
                $('#attndances').val('');
                $('.neft').show();
                $('.cheque').hide();

            }
            
        });

    });

</script>
