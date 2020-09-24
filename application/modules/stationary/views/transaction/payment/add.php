<!-- <?php print_r($bank);?> -->
<div class="wraper">      

<div class="col-md-9 container form-wraper">

    <form method="POST" id="form" role="form" name="add_form" action="<?php echo site_url("stationary/addNewPayment");?>" onsubmit="return validate()" >
        

    <div class="form-header">
            
            <h4>Bank & File Details</h4>
        
        </div>
    <div class="form-group row">

<label for="file_name." class="col-sm-1 col-form-label">File No.<font color="red">*</font></label>

<div class="col-sm-3">

    <input  type="text" name="file_name" class="form-control file_name" id="file_file_nameno" >
        
</div>
<label for="page_no" class="col-sm-1 col-form-label">Page No.<font color="red">*</font></label>

<div class="col-sm-2">

    <input type="text" name="page_no" class="form-control page_no" id="page_no" >
        
</div>

<label for="bank" class="col-sm-1 col-form-label">Bank<font color="red">*</font></label>

<div class="col-sm-3">
<select name="bank" id="bank" class="form-control bank">
                                            <option value="0">Select Bank</option>
                                            <?php foreach($bank as $row){ ?>
                                                <option value="<?php echo $row->bank_name; ?>"><?php echo $row->bank_name; ?></option>
                                            <?php } ?>
                                        </select>                           
 </div>
 <input type="hidden"class="form-control trans_cd"      style="width:80px"  name="trans_cd"      ></td>
</div>

        <div class="form-header">
            
                <h4>Payment Entry</h4>
            
            </div>

            
            <table class="table">

                <thead>

                    <tr>
                        <!-- <th>Trans Cd.</th> -->
                        <th>Supply To.</th>
                        <th>Order Details.</th>
                        <th><button type="button" class="btn btn-success addAnother"><i class="fa fa-plus"></i></button></th>

                    </tr>

                </thead>
                <tbody id="intro1" class="tables" >
                    <tr>
                    <!-- <td> -->
                    <input type="hidden" class="form-control ref_no" style="width:80px" name="ref_no[]" id="ref_no" readonly>
                    
                    <!-- </td>  -->
 
                <td> 
                 <select name="project[]" id="project" style="width:200px"class="form-control required" >
                <option value="">Select Project</option>
                <?php
                    foreach($projects as $key1)
                    { ?>
                        <option value="<?php echo $key1->project_cd; ?>"><?php echo $key1->name; ?></option>
                    <?php
                    } ?>
              </select>
            </td>
            <td><input type="text" class="form-control order_no" name="order_no[]" required></td>
                        <!-- <td><button type="button" class="btn btn-default view"><i class="fa fa-eye"></i></button></td> -->
                    </tr>
                </tbody> 
                </table>
                <div class="form-header">
            
            <h4>Bills</h4>
        
        </div>
        
        <table class="table">

            <thead>

                <tr>
                    
                    <th>S Bill No.</th>
                    <th>Date</th>
                    <th>Value</th>
                    <th>P Bill No.</th>
                    <th>Date</th>
                    <th>Value</th>
                    <th><button type="button" class="btn btn-success addAnotherrow"><i class="fa fa-plus"></i></button></th>

                </tr>

            </thead>

            <tbody id="intro2" class="tables">
                <tr>
                    <td><input type="text"  class="form-control s_bill_no"  id="s_bill_no" style="width:100px"  name="s_bill_no[]"  required></td>
                    <td><input type="date"  class="form-control s_bill_dt"   style="width:150px" name="s_bill_dt[]"   required></td>
                    <td><input type="text"  class="form-control s_bill_amt"  style="width:85px"  name="s_bill_amt[]"  required></td>
                    <td><input type="text"  class="form-control p_bill_no"   style="width:100px" name="p_bill_no[]"   required></td>
                    <td><input type="date"  class="form-control p_bill_dt"   style="width:150px" name="p_bill_dt[]"   required></td>
                    <td><input type="text"  class="form-control p_bill_amt"  style="width:85px"  name="p_bill_amt[]"  required></td>
                    <td><input type="hidden"class="form-control ref_no"      style="width:80px"  name="ref_no[]"      required></td>
                   
                </tr>
            </tbody> 

            <tfoot>
                <tr>
                <tr>
                    
                    <td colspan="2" style="text-align: right;">Less Amount:</td>
                    <td><input type="text" id=s_bill_less_amt class="form-control s_bill_less_amt" name="s_bill_less_amt" value="0"></td>
                                       <td></td>
                    <td></td>
                    <td><input  colspan="5" type="text" class="form-control p_bill_less_amt" name="p_bill_less_amt" value="0"></td>
                </tr>
                <tr>
                <td colspan="2" style="text-align: right;">Add Amount:</td>
                    <td><input type="text" id=s_bill_add_amt class="form-control s_bill_add_amt" name="s_bill_add_amt" value="0"></td>
                    <td></td>
                    <td></td>
                    <td><input  colspan="5" type="text" class="form-control p_bill_add_amt" name="p_bill_add_amt" value="0"></td>

                </tr>
                <tr>
                <td colspan="2" style="text-align: right;">Less Round Off:</td>
                    <td><input type="text" id=s_bill_round_off class="form-control s_bill_round_off" name="s_bill_round_off" value="0"></td>
                    <td></td>
                    <td></td>
                    <td><input  colspan="5" type="text" class="form-control p_bill_round_off" name="p_bill_round_off" value="0"></td>

                </tr>
                <tr>
                <td colspan="2" style="text-align: right;">Add Round Off:</td>
                    <td><input type="text" id=s_bill_add_rnd_off class="form-control s_bill_add_rnd_off" name="s_bill_add_rnd_off" value="0"></td>
                    <td></td>
                    <td></td>
                    <td><input  colspan="5" type="text" class="form-control p_bill_add_rnd_off" name="p_bill_add_rnd_off" value="0"></td>

                </tr>
                    <td>Total:</td>
                    <td colspan="1">
                    <td ><input type="text" style="width:100px;text-align: left;" class="form-control tot_s_bill" id="tot_s_bill" name="tot_s_bill" readonly>
                    </td>
                     </td>
                     <td colspan="2" >
                    <td><input type="text" style="width:100px;text-align: left;" class="form-control tot_p_bill" id="tot_p_bill" name="tot_p_bill" readonly></td>
                   
                    <td></td></td>

                <!-- </tr>

                <tr> -->
                   
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                </tr>

            </tfoot>
        </table>
<div class="form-header">
            
<h4>MR Entry</h4>
        
 </div>
<div class="form-group">

<table class= "table table-striped table-bordered table-hover">

<thead>
     
    <th style= "text-align: center">MR No.</th>  
    <th style= "text-align: center">MR Date</th>  
    <th style= "text-align: center">Pay Type</th>
    <th style= "text-align: center">Pay Date.</th>
    <th style= "text-align: center">Amount.</th>
    <th style="visibility:hidden;">Sl no.</th> 
    <th>
        <button class="btn btn-success" type="button" id="addrow" style= "border-left: 10px" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
    </th>

</thead>
<hr>
<tbody id= "intro">
<tr>

    <td>
        <input type="text" name="mr_no[]" id="mr_no" style="width:80px" class="form-control mr_no"  required>                            
    </td>

    <td>
        <input type="date" name="mr_dt[]" id="mr_dt" style="width:150px" class="form-control required"  required>                            
    </td>
     
    <td>
                <select name="chq_type[]" id="chq_type" style="width:70px" class="form-control required"  >
                        <option value="0">Select mode</option>
                        <option value="cash">Cash</option>
                        <option value="neft">NEFT</option>
                        <option value="cheque">Cheque</option>
                </select>

   </td>

   <td>
        <input type="date" name="chq_dt[]"  style="width:150px" class="form-control required" id="chq_dt" required>                            
   </td>

   <td>
        <input type="text" name="amt[]"  style="width:80px" class="form-control mramt" id="amt" required>                            
   </td>
   <td>
        <input type="hidden" name="ref_no[]" id="ref_no" style="width:80px" class="form-control required"  required>                            
    </td>
</tr>

</tbody>
<tfoot>
<!-- <tr> -->
<!-- <td colspan="4" style="text-align: right;">Less Amount:</td>
                    <td><input type="text" style="width:100px"id= mr_bill_less_amt class="form-control mr_bill_less_amt" name="mr_bill_less_amt"></td> -->
<!-- </tr> -->
<tr>
                <td colspan="4" style="text-align: right;">Add GST:</td>
                    <td><input type="text" style="width:100px" id=mr_add_gst class="form-control mr_add_gst" name="mr_add_gst"  value="0"></td>
                    </tr>
                    <tr>
                    <td colspan="4" style="text-align: right;">Less GST:</td>
                    <td><input type="text" style="width:100px" id=mr_less_gst class="form-control mr_less_gst" name="mr_less_gst"  value="0"></td>
                    </tr>
                    </tr>
                    <td colspan="4" style="text-align: right;">Less Cofed Margin:</td>
                    <td><input type="text" style="width:100px"  id=confed_margin class="form-control confed_margin" name="confed_margin"  value="0"></td>
                    </tr>
                    <tr>
                    <td colspan="4" style="text-align: right;">Add GST:</td>
                    <td><input type="text"  style="width:100px" id=margin_add_gst class="form-control margin_add_gst" name="margin_add_gst"  value="0"></td>
                    </tr>
                    <tr>
                    <td colspan="4" style="text-align: right;">Less GST:</td>
                    <td><input type="text" style="width:100px" id=margin_less_gst class="form-control margin_less_gst" name="margin_less_gst" value="0"></td>
                    </tr>
                <tr>
                
                    <td colspan="4" style="text-align: right;">Total:</td>
                    <td><input type="text" style="width:110px" class="form-control tot_mr_amt" id=tot_mr_amt readonly></td>

                </tr>

                <tr>
                                   
                </tr>

            </tfoot>
</table>
<!-- <div class="form-header">
            
            <h4>Payment Details</h4>
        
        </div> -->
</div> 
        
        <div class="form-group row">

            <div class="col-sm-10">

                <input type="submit" class="btn btn-info" value="Save" />

            </div>

        </div>

    </form>


 </div>

</div>


<script>

$(document).ready(function()
{


    
    $('#refNo').hide();
    
    // <!-- To get Order No as per Project Selected  -->

    $('#project_cd').on( "change", function()
    {
        //console.log($(this).val());
        $.get('<?php echo site_url("stationary/js_get_collection_orderForProject");?>',{ project_cd: $(this).val() })
                                                
        .done(function(data)
        {
            //console.log(data);
            var string = '<option value="0">Select Order</option>';

            $.each(JSON.parse(data), function( index, value ) {

                string += '<option value="'+value.order_no +'">'+value.order_no+'</option>'

            });
            
            $('#order_no').html(string);            

        });

    });

    // To show or hide the Ref No section -->  
    $('#mode').on( "change", function()
    {

        var mode = $(this).val();
        if(mode == "neft" || mode == "cheque")
        {
            $('#refNo').show();
        }
        else if(mode == "cash" || mode == "0" )
        {
            $('#refNo').hide();
        }

    });


});

</script> 

<!-- for addrow in table -->
<script>

$(document).ready(function(){

    $("#addrow").click(function()
    {
       
            var newElement= '<tr>'
            
                            +'<td><input type="text" name="mr_no[]" id="mr_no" style="width:80px" class="form-control mr_no " id="mr_no" required>'
                            +'</td>'
                            +'<td><input type="date" name="mr_dt[]" id="mr_dt" style="width:150px" class="form-control required " id="mr_dt" required>'
                            +'</td>'
                            +'<td>'
                                +'<select name="chq_type[]" style="width:70px" id="chq_type" class= "form-control required " required>'
                                +'<option value="0">Select mode</option>'
                        +'<option value="cash">Cash</option>'
                        +'<option value="neft">NEFT</option>'
                        +'<option value="cheque">Cheque</option>'
                                +'<select>'
                            +'</td>'
                            +'<td><input type="date" name="chq_dt[]"  style="width:150px" class="form-control required " id="chq_dt" required>'
                            +'</td>'
                            +'<td><input type="text" name="amt[]"  style="width:80px" class="form-control mramt " id="amt" required>'
                            +'</td>'
                             +'<td>'
                                +'<button class="btn btn-danger removeRow" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>'
                            +'</td>'
                        +'</tr>';
                        
            $("#intro").append($(newElement)); 
        });  

$('.addAnother').click(function(){

let row = '<tr>' +
          
           
          '<td>'+ 
        '<select name="project[]" id="project" style="width:200px"class="form-control required" ><option value="">Select Project</option>'+
        
        '<?php foreach($projects as $key1){ ' +

'?> ' +

    ' <option value="<?php echo $key1->project_cd; ?>">'+'"<?php echo $key1->name; ?>"'+'</option> ' +

'<?php } ' +
'?> ' +
        '</select>'+
         '</td>'+
          '<td><input type="text" class="form-control order_no" name="order_no[]" required></td>'
          +'<td>'
          +'<button class="btn btn-danger removeRow" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button>'
          +'</td>'
          '</tr>';

$('#intro1').append(row);

});

$('.addAnotherrow').click(function(){

let row = '<tr>' +
            '<td><input type="text" class="form-control s_bill_no"    style="width:100px"    name="s_bill_no[]" id="s_bill_no"></td>' +
            '<td><input type="date" class="form-control s_bill_dt"    style="width:150px"    name="s_bill_dt[]"></td>' +
            '<td><input type="text" class="form-control s_bill_amt"   style="width:85px"     name="s_bill_amt[]"></td>' +
            '<td><input type="text" class="form-control p_bill_no"    style="width:100px"    name="p_bill_no[]"></td>' +
            '<td><input type="date" class="form-control p_bill_dt"    style="width:150px"    name="p_bill_dt[]"></td>' +
            '<td><input type="text" class="form-control p_bill_amt"   style="width:85px"     name="p_bill_amt[]"></td>' +
            '<td><button type="button" class="btn btn-danger removeRow"><i class="fa fa-remove"></i></button></td>' +
          '</tr>';

$('#intro2').append(row);

});
                            
});


  $("#intro").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();

        });

  $("#intro1").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();
           
        });

        $("#intro2").on('click', '.removeRow',function(){
            
            $(this).parents('tr').remove();
 
        });

</script>

<script>

$('#intro').on('change', '#mr_no', function(){

    var row = $(this).closest('tr');
    var mr_no = row.find('td:eq(0) :input').val();

    $.get('<?php echo site_url("stationary/js_get_mrno");?>',{ mr_no: mr_no })
    .done(function(data)
    {
        var result=JSON.parse(data);
        var mr_dt=result.mr_dt;
        var chq_type=result.mode;
        var chq_dt=result.mr_dt;
        var amt=result.amount;

        row.find('td:eq(1) :input').val(mr_dt);
        row.find('td:eq(2) :input').val(chq_type);
        row.find('td:eq(3) :input').val(chq_dt);
        row.find('td:eq(4) :input').val(amt);
        var sum_mr = 0;
$('.mramt').each(function(){
   
    sum_mr += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
    // sum += $('#amt').val();
});

$('.mr_add_gst').change(function(){

$('#tot_mr_amt').val(sum_mr + parseFloat($('.mr_add_gst').val()) -  parseFloat($('.mr_less_gst').val()) );
console.log('hi');
$tot_mr_amt=$("#tot_mr_amt").val();
$con_margin = $tot_mr_amt*.06;
console.log($con_margin);
$('.confed_margin').val($con_margin);
});

$('.mr_less_gst').change(function(){

$('#tot_mr_amt').val(sum_mr + parseFloat($('.mr_add_gst').val()) -  parseFloat($('.mr_less_gst').val()) );
// console.log('hi');
});

$("#tot_mr_amt").val(sum_mr);  

    });
 
  
 })

//  $(document).ajaxComplete(function() {

//     $('#intro').on('change', '#mr_no', function(){
//     var sum = 0;
// $('.mramt').each(function(){
//     sum += $(this).val();  // Or this.innerHTML, this.innerText
//     // sum += $('#amt').val();
// });
// console.log(sum);


//        $("#tot_mr_amt").val(sum);
//     })
//  })
    </script>


<script>

$('#intro2').on('change', '#s_bill_no', function(){

    var row = $(this).closest('tr');
    var s_bill_no = row.find('td:eq(0) :input').val();

    $.get('<?php echo site_url("stationary/js_get_s_p_data");?>',{s_bill_no:s_bill_no })
    .done(function(data)
    {
        // console.log('ok');
        var result=JSON.parse(data);
        var s_bill_dt=result.s_bill_dt;
        var s_bill_amt=result.s_bill_amt;
        var p_bill_no=result.p_bill_no;
        var p_bill_dt=result.p_bill_dt;
        var p_bill_amt=result.p_bill_amt
       
        

        row.find('td:eq(1) :input').val(s_bill_dt);
        row.find('td:eq(2) :input').val(s_bill_amt);
        row.find('td:eq(3) :input').val(p_bill_no);
        row.find('td:eq(4) :input').val(p_bill_dt);
        row.find('td:eq(5) :input').val(p_bill_amt);
        var sum_sale = 0;
        var sum_pur = 0;
        $('.s_bill_amt').each(function(){
            
            sum_sale += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
   // sum += $('#amt').val();
});

// $("#tot_s_bill").val(sum_sale);  
// $s_bill_add_amt=parseFloat($('.s_bill_add_amt').val());
// console.log($s_bill_add_amt);
$('.s_bill_less_amt').change(function(){
    $s_add_amt =parseFloat($('.s_bill_add_amt').val());
    $s_add_rnd_amt =parseFloat($('.s_bill_add_rnd_off').val());
// $('.tot_s_bill').val(sum_sale - $(this).val() - $('.s_bill_round_off').val() + $('.s_bill_add_amt').val() + $('.s_bill_add_rnd_off').val());
$('.tot_s_bill').val(sum_sale - $(this).val() - parseFloat($('.s_bill_round_off').val()) + parseFloat($('.s_bill_add_amt').val()) + $s_add_amt + $s_add_rnd_amt);

});

$('.s_bill_round_off').change(function(){
    $s_add_amt =parseFloat($('.s_bill_add_amt').val());
    $s_add_rnd_amt =parseFloat($('.s_bill_add_rnd_off').val());
$('.tot_s_bill').val(sum_sale - parseFloat($('.s_bill_less_amt').val()) - parseFloat($('.s_bill_round_off').val()) + $s_add_amt + $s_add_rnd_amt);

});

$('.s_bill_add_amt').change(function(){

$s_add_amt =parseFloat($(this).val());
$s_add_rnd_amt =parseFloat($('.s_bill_add_rnd_off').val());

$('.tot_s_bill').val(sum_sale + $s_add_amt - parseFloat($('.s_bill_less_amt').val()) - parseFloat($('.s_bill_round_off').val()) + $s_add_rnd_amt );

});

$('.s_bill_add_rnd_off').change(function(){

$s_add_amt =parseFloat($('.s_bill_add_amt').val());
$s_add_rnd_amt =parseFloat($(this).val());

$('.tot_s_bill').val(sum_sale + $s_add_amt - parseFloat($('.s_bill_less_amt').val()) - parseFloat($('.s_bill_round_off').val()) + $s_add_rnd_amt);

});

parseFloat($("#tot_s_bill").val(sum_sale)); 

$('.p_bill_amt').each(function(){
    // console.log(s_bill_less_amt);         
    sum_pur += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
   // sum += $('#amt').val();
});
$("#tot_p_bill").val(sum_pur);  

$('.p_bill_less_amt').change(function(){
    $p_add_amt =parseFloat($('.p_bill_add_amt').val());
    $p_add_rnd_amt =parseFloat($('.p_bill_add_rnd_off').val());
$('.tot_p_bill').val(sum_pur - $(this).val() - parseFloat($('.p_bill_round_off').val())+ $p_add_amt + $p_add_rnd_amt);

// $('.tot_p_bill').val(sum_sale - $(this).val() - parseFloat($('.p_bill_round_off').val()) + parseFloat($('.p_bill_add_amt').val()) + $p_add_amt + $p_add_rnd_amt);

});

$('.p_bill_round_off').change(function(){
    $p_add_amt =parseFloat($('.p_bill_add_amt').val());
    $p_add_rnd_amt =parseFloat($('.p_bill_add_rnd_off').val());
$('.tot_p_bill').val(sum_pur - parseFloat($('.p_bill_less_amt').val()) - parseFloat($('.p_bill_round_off').val()) + $p_add_amt + $p_add_rnd_amt);

});

$('.p_bill_add_amt').change(function(){
    $p_add_amt =parseFloat($('.p_bill_add_amt').val());
    $p_add_rnd_amt =parseFloat($('.p_bill_add_rnd_off').val());
$('.tot_p_bill').val(sum_pur - parseFloat($('.p_bill_less_amt').val()) - parseFloat($('.p_bill_round_off').val()) + $p_add_amt + $p_add_rnd_amt);

});

$('.p_bill_add_rnd_off').change(function(){
    $p_add_amt =parseFloat($('.p_bill_add_amt').val());
    $p_add_rnd_amt =parseFloat($('.p_bill_add_rnd_off').val());
$('.tot_p_bill').val(sum_pur - parseFloat($('.p_bill_less_amt').val()) - parseFloat($('.p_bill_round_off').val()) + $p_add_amt + $p_add_rnd_amt);

});


    });
})
 </script>

