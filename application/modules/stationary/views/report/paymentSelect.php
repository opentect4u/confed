<!--/// jquery links for data range ///  dateRange picker //-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<div class="wraper">      

    <div class="col-md-6 container form-wraper">

        <form role="form" method="POST" action= "<?php echo site_url('stationary/getPaymentReport') ?>" >
            <div class="form-header">
                
                <h4>Date Wise Payment Report</h4>
                    
            </div>
            <div class="form-group row">

<label for="vendor_cd" class="col-sm-2 col-form-label">Supplier:<font color="red">*</font></label>
<div class="col-sm-8">

    <select name="vendor_cd" id="vendor_cd" class= "form-control required" required>
        <option value="0">Select Supplier</option>
        <?php
            foreach($data as $key)
            { 
            ?>
                <option value="<?php echo ($key->sl_no); ?>"><?php echo ($key->name); ?></option>
        <?php
            }
            ?>
    </select>
      
</div>
</div>
<div class="form-group row">

<label for="soc_name" class="col-sm-2 col-form-label">Society Name:</label>

<div class="col-sm-4">

    <select type="text"
        class="form-control required sch_cd"
        name="soc_name"
        id="soc_name"
    >

        <option value="">Select</option>    

        <?php
            foreach($project as $key1)
            { 
            ?>
                <option value="<?php echo ($key1->project_cd); ?>"><?php echo ($key1->name); ?></option>
        <?php
            }
            ?>    </select>    

</div>


</div>  

            <div class="form-group row">
                <label for="order_dt" class="col-sm-2 col-form-label">Select Date Range:<font color="red">*</font></label>
                
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="datefilter" value="" />
                </div>
            </div>

            <div class="form-group row">

                <div class="col-sm-10">

                    <button type="submit" class="btn btn-primary" >GO<i class="fa fa-angle-double-right fa-fw "></i></button>

                </div>

            </div>

        </form>

            
    </div>

</div>



<!-- JS for dateRange picker calender -->

<script type="text/javascript">

    $(function(){

        $('input[name="datefilter"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + '  ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

    });

    //var startDate =  picker.startDate.format('DD/MM/YYYY');
    //var endDate =  picker.endDate.format('DD/MM/YYYY');

    //console.log(startDate); 

</script>

