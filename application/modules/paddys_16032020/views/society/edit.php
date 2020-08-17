  
    <div class="wraper">      

        <form method="POST" 
            id="form"
            action="<?php echo site_url("paddy/society/edit");?>" >
            
            <div class="col-md-6 container form-wraper" style="margin-left: 0px;">

                <div class="form-header">
                
                    <h4>Society Details</h4>
                    
                </div>

                <div class="form-group row">

                    <label for="name" class="col-sm-2 col-form-label">Society Name:</label>

                    <div class="col-sm-10">

                        <input type="hidden" name="soc_id" value="<?php echo $society_dtls->sl_no;?>" />
                        <input
                            class="form-control required"
                            name="name"
                            id="name"
                            value="<?php echo $society_dtls->soc_name; ?>"
                        />

                    </div>

                </div>

                <div class="form-group row">
                
                    <label for="reg_no" class="col-sm-2 col-form-label">Registration No.:</label>

                    <div class="col-sm-4">

                        <input type = "text"
                            class= "form-control required"
                            name = "reg_no"
                            id   = "reg_no"
                            value="<?php echo $society_dtls->reg_no; ?>"
                        />

                    </div>

                    <label for="reg_date" class="col-sm-2 col-form-label">Ragistration Date:</label>

                    <div class="col-sm-4">

                        <input type="date"
                                name="reg_date"
                                class="form-control required"
                                id="reg_date" 
                                value="<?php echo $society_dtls->reg_date; ?>"
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="ph_no" class="col-sm-2 col-form-label">Ph No.:</label>

                    <div class="col-sm-4">

                        <input type = "text"
                            class= "form-control required"
                            name = "ph_no"
                            id   = "ph_no"
                            value="<?php echo $society_dtls->ph_no; ?>"
                        />

                    </div>

                    <label for="email" class="col-sm-2 col-form-label">Email:</label>

                    <div class="col-sm-4">

                        <input type = "text"
                            class= "form-control"
                            name = "email"
                            id   = "email"
                            value="<?php echo $society_dtls->email;?>"
                        />

                    </div>


                </div>

                <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">District:</label>

                    <div class="col-sm-4">

                        <select name="dist" id="dist" class="form-control required">

                            <option value="">Select</option>

                            <?php

                                foreach($dist as $dlist){

                            ?>

                                <option value="<?php echo $dlist->district_code;?>"
                                                <?php echo ($dlist->district_code == $society_dtls->dist)?"selected":"";?>
                                        ><?php echo $dlist->district_name;?></option>

                            <?php

                                }

                            ?>     

                        </select>

                    </div>

                    <label for="gst_no" class="col-sm-2 col-form-label">GST No.:</label>

                    <div class="col-sm-4">

                        <input type = "text"
                            class= "form-control"
                            name = "gst_no"
                            id   = "gst_no"
                            value="<?php echo $society_dtls->gst_no;?>"
                        />

                    </div>

                </div>  

                <div class="form-group row">

                    <label for="block" class="col-sm-2 col-form-label">Block:</label>

                    <div class="col-sm-4">

                        <select name="block" id="block" class="form-control required">

                        </select>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="addr" class="col-sm-2 col-form-label">Address:</label>

                    <div class="col-sm-10">

                        <textarea type = "text"
                            class= "form-control"
                            name = "addr"
                            id   = "addr"
                        ><?php echo $society_dtls->soc_addr;?></textarea>

                    </div>

                </div>

                <hr>
                
                <div class="form-header">

                    <h4>Bank Details</h4>
                
                </div>

                <div class="form-group row">

                    <label for="bnk_name" class="col-sm-2 col-form-label">Bank Name:</label>

                    <div class="col-sm-10">

                        <input type = "text"
                            class= "form-control"
                            name = "bnk_name"
                            id   = "bnk_name"
                            value="<?php echo $society_dtls->bank_name;?>"
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="brnch_name" class="col-sm-2 col-form-label">Branch Name:</label>

                    <div class="col-sm-10">

                        <input type = "text"
                            class= "form-control"
                            name = "brnch_name"
                            id   = "brnch_name"
                            value="<?php echo $society_dtls->branch_name;?>"
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="acc_type" class="col-sm-2 col-form-label">Account Type:</label>

                    <div class="col-sm-4">

                        <select type = "text"
                            class= "form-control"
                            name = "acc_type"
                            id   = "acc_type"
                        >

                            <option value="Current Account" <?php echo ($society_dtls->acc_type == 'Current Account')?'selected':''; ?>>Current Account</option>

                            <option value="Savings Account" <?php echo ($society_dtls->acc_type == 'Savings Account')?'selected':''; ?>>Savings Account</option>
                        
                        </select>

                    </div>

                    <label for="acc_no" class="col-sm-2 col-form-label">Acc No.:</label>

                    <div class="col-sm-4">

                        <input type = "text"
                            class= "form-control"
                            name = "acc_no"
                            id   = "acc_no"
                            value="<?php echo $society_dtls->acc_no;?>"
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <label for="ifsc" class="col-sm-2 col-form-label">IFSC Code.:</label>

                    <div class="col-sm-4">

                        <input type = "text"
                            class= "form-control"
                            name = "ifsc"
                            id   = "ifsc"
                            value="<?php echo $society_dtls->ifsc_code;?>"
                        />

                    </div>

                    <label for="pan" class="col-sm-2 col-form-label">PAN No.:</label>

                    <div class="col-sm-4">

                        <input type = "text"
                            class= "form-control"
                            name = "pan"
                            id   = "pan"
                            value="<?php echo $society_dtls->pan_no;?>"
                        />

                    </div>

                </div>

                <div class="form-group row">

                    <div class="col-sm-10">

                        <input type="submit" class="btn btn-info" value="Save" />

                    </div>

                </div>
                
            </div>

            <div class="col-md-5 container form-wraper" style="margin-left: 10px; width: 48%;">
                        
                <div class="form-header">
                    
                    <h4>Mills</h4>
                
                </div>

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th><input type="checkbox" class="form-check-input" id="all-check"> All</th>
                            <th>Sl. No.</th>
                            <th>Documents</th>

                        </tr>

                    </thead>
                        
                    <tbody> 
                            <?php
                                if($mills){
                                    $i = 1;
                                    
                                    foreach($mills as $list){

                                    ?>
                                        <tr>
                                            <td><input type="checkbox" class="form-check-input checkbox" name="status" <?php echo ($list->checkId)? "checked" : ""; ?>></td>
                                            <td><input type="hidden" class="sl_no" name="sl_no[]" value='{"sl_no":"<?php echo $list->sl_no; ?>", "value":"<?php echo ($list->checkId)? 1: 0 ?>"}'><?php echo $i++; ?></td>
                                            <td><?php echo $list->mill_name; ?></td>
                                        </tr>
                                    <?php
                                    }
                                }
                            ?>
                    </tbody>

                    <tfoot>

                        <tr>
                        
                            <th>All</th>
                            <th>Sl. No.</th>
                            <th>Documents</th>

                        </tr>
                    
                    </tfoot>

                </table>

            </div>

        </form>

    </div>

<script>

    $("#form").validate();


</script>


<script>

$(document).ready(function(){

    function blockGroup(dist) {

        $.get( 

            '<?php echo site_url("paddy/blocks");?>',

            { 

                dist: dist

            }

            ).done(function(data){

            var string = '<option value="">Select</option>',
                selected= '';

            $.each(JSON.parse(data), function( index, value ) {

                if(value.sl_no == '<?php echo $society_dtls->block ?>'){
                    
                    selected = 'selected';

                }else{

                    selected = '';

                }

                string += '<option value="' + value.sl_no + '"'+ selected +'>' + value.block_name + '</option>'

            });

            $('#block').html(string);

        });

    }  

    blockGroup('<?php echo $society_dtls->dist ?>');

    $('#dist').change(function(){
        
        blockGroup($(this).val());

        $.get( 

            '<?php echo site_url("paddy/blocksandmills");?>',

            { 

                dist: $(this).val()

            }

        ).done(function(data){

            var string = '<option value="">Select</option>';
            //For Blocks
            $.each(JSON.parse(data).blocks, function( index, value ) {

                string += '<option value="' + value.sl_no + '">' + value.block_name + '</option>'

            });

            $('#block').html(string);

            string  = '';
            //For Blocks
            $.each(JSON.parse(data).mills, function( index, value ) {

                string += `<tr>
                            <td><input type="checkbox" class="form-check-input checkbox" name="status"></td>
                            <td><input type="hidden" class="sl_no" name="sl_no[]" value='{"sl_no":"${value.sl_no}", "value":"0"}'>${index + 1}</td>
                            <td>${value.mill_name}</td>
                          </tr> 
                        `;

            });

            $('tbody').html(string);

        });

    });

});
</script>

<script>
    $(document).ready(function(){

        $('tbody').on('click', '.checkbox', function(){
            
            let indexNo = $('.checkbox').index(this),
                
            value   = JSON.parse($('.sl_no:eq('+indexNo+')').val());
            value.value = 1;

            if($(this).prop("checked") == true){
                $('.sl_no:eq('+indexNo+')').val(JSON.stringify(value))
            }
            else{
                value.value = 0;
                $('.sl_no:eq('+indexNo+')').val(JSON.stringify(value))
            }

        });

        $('#all-check').click(function(){

            if($(this).prop("checked") == true){

                $('.checkbox').each(function(){
                    $(this).prop("checked", true);
                    let indexNo = $('.checkbox').index(this);
                    value   = JSON.parse($('.sl_no:eq('+indexNo+')').val());
                    value.value = 1;
                    $('.sl_no:eq('+indexNo+')').val(JSON.stringify(value));
                });
            }
            else{
                
                $('.checkbox').each(function(){
                    
                    let indexNo = $('.checkbox').index(this),
                    value   = JSON.parse($('.sl_no:eq('+indexNo+')').val());

                    value.value = 0;
                    $('.sl_no:eq('+indexNo+')').val(JSON.stringify(value))

                    $(this).prop('checked', false);
                });
            }

        });
    });
</script> 