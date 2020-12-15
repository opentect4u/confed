  
    <div class="wraper">  
        
        <form method="POST" 
                id="form"
                action="<?php echo site_url("paddy/society/mill");?>" >

            <div class="col-md-6 container form-wraper" style="margin-left: 0px;">

                <div class="form-header">
                
                    <h4>Society Details</h4>
                    
                </div>

                 <div class="form-group row">

                    <label for="dist" class="col-sm-2 col-form-label">District:</label>

                    <div class="col-sm-4">

                        <select name="dist" id="dist" class="form-control required">

                            <option value="">Select</option>

                            <?php

                                foreach($dist as $dlist){

                            ?>

                                <option value="<?php echo $dlist->district_code;?>"><?php echo $dlist->district_name;?></option>

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
                                    id="soc_name">

                                <option value="">Select</option>    

                                <option value="">Select Block First</option>    

                                </select>    

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

        var i = 0;

        $('#dist').change(function(){

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

        var i = 0;

        $('#block').change(function(){

            $.get( 

                '<?php echo site_url("paddy/societies");?>',

                { 

                    block: $(this).val()

                }

            ).done(function(data){

                var string = '<option value="">Select</option>';

                $.each(JSON.parse(data), function( index, value ) {

                    string += '<option value="' + value.sl_no + '">' + value.soc_name + '</option>'

                });

                $('#soc_name').html(string);

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