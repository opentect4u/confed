<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<div class="wraper">      

    <div class="col-md-6 container form-wraper">
    
        <form role="form" name="payment_form" method="POST" id="form" action="<?php echo site_url("Disaster/Report/show_revenew");?>" onsubmit="return validate()" >
        
            <div class="form-header">
            
                <h4>Select Transaction Date Range</h4>
            
            </div>

            <div class="form-group row">

                <label for="agent" class="col-sm-2 col-form-label">Date:<font color="red">*</font></label>
                <div class="col-sm-6">
 
                    <input type="text" name="datefilter" value="" class="form-control required" />

                </div>

                    <button type="submit" class="btn btn-primary" >GO<i class="fa fa-angle-double-right fa-fw "></i></button>

            </div>

            
        </form>

    </div>

</div>





<!-- JS for dateRange picker calender -->

<script type="text/javascript">

    $(function() {

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
