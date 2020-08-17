    <div class="wraper">      

        <div class="row">

            <!-- <form method="POST" 
                id="form"
             action="<?php echo site_url("paddys/addwqsc");?>" > -->
                <form method="POST" id="form" action="<?php echo site_url("paddy/wqsc/add");?>" >
                <div class="col-md-7 container form-wraper" style="margin-left: 0px;">
                
                    <div class="form-header">
                    
                        <h4>WQSC Sheet Entry</h4>
                    
                    </div>

                    <div class="form-group row">

                        <label for="dist" class="col-sm-2 col-form-label">District:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <select name="dist" id="dis_cd" class="form-control required" required>

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
                      
                    </div>

                   
                    <div class="form-group row">

                        <label for="pool_type" class="col-sm-2 col-form-label">Pool Type:<font color="red">*</font></label>

                        <div class="col-sm-4">

                            <select class="form-control required"
                                    name="pool_type"
                                    id="pool_type" required
                                >

                                <option value="">Select</option>

                                <option value="S">State Pool</option>

                                <option value="C">Central Pool</option>

                                <option value="F">FCI</option> 

                            </select>    
                       
                        </div>
                 
                    <div class="form-group row">
                    <span class="col-sm-2 confirm-div" style="float:right; color:red;"></span>
                        <label for="bill_no" class="col-sm-2 col-form-label">Bill No.:<font color="red">*</font></label>
          
                        <div class="col-sm-2">

                            <input type="text" style="width: 150px"
                                    class="form-control required"
                                    name="bill_no"
                                    id="bill_no" required
                                />

                        </div>
                      
                    </div>       
                    <div class="">
                    <table id= "prodTable" class="table table-bordered saleTable">
                   <thead>
                    <tr>
                        <th width="80"  style="font-weight:bold;text-align:center">WQSC No<font color="red">*</font></th>
                        <th width="80"  style="font-weight:bold;text-align:center">Analysis No.</th>
                        <th width="150" style="font-weight:bold;text-align:center">Date<font color="red">*</font></th>
                        <th width="100" style="font-weight:bold;text-align:center">No. Of Bags<font color="red">*</font></th>
                        <th width="80"  style="font-weight:bold;text-align:center">Quantity<br>(in qtls)</th>
                        <th width="100" style="font-weight:bold;text-align:center">MSP/INS<br>/Bonus</th>
                    <th><button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                    </tr>
                        </thead>
                        <tbody id="intro">
              <tr>
                 <td><input type="text" class="form-control"  style="width:80px"     name="wqsc_no[]" id="wqsc_no" required/></td>          
                <td><input type="text" class="form-control"   style="width:110px"    name="analysis_no[]" id="analysis_no" /></td>
                <td><input type="date" class="form-control"   style="width:150px "   name="trn_dt[]" /></td>
                <td><input type="text" class="form-control"   style="width:60px"     name="no_bags[]" id="no_bags" required/></td>
                <td><input type="text" class="form-control"   style="width:80px"    name="qty[]" id="qty" required/></td>
                <td><input type="text" class="form-control"   style="width:80px"    name="remarks[]" id="remarks" /></td>
                 <td></td>
              </tr>
            </tbody>
         </table>
    </div>
        <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <!-- <button class="btn btn-primary" id="save" type="submit"  onclick="return confirm('Are you sure you want to Save this item?');">Save</button> -->
        <button class="btn btn-primary" id="save" type="submit"  onclick="return doAlert();">Save</button>
        </div>
    </div> 

   
   <script>
     $(document).ready(function(){
    $('#pname').hide();
    $('#prps').hide();
    var total = 0;

   // $('.livesearch').select2();
    
    $("#addrow").click(function(){
        $("#intro").append('<tr><td><input type="text" class="form-control" style="width:80px" class="form-control" name="wqsc_no[]" ></td><td> <input type="text" class="form-control" style="width:110px" name="analysis_no[]" id="analysis_no" /></td><td><input type="date" class="form-control"  style="width:150px"  name="trn_dt[]" /></td><td><input type="text" class="form-control" style="width:80px" name="no_bags[]" id="no_bags" /></td><td><input type="text" class="form-control" style="width:80px"  name="qty[]" id="qty"/></td><td><input type="text" class= "form-control" style="width:80px"  name="remarks[]" id="remarks" /></td><td><button class="btn btn-danger" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>');
    
     // $('.livesearch').select2();
      // $('.preferSelect').change();
      $('[data-toggle="tooltip"]').tooltip({trigger: "hover"});
     
    });
   
    $(document).ready( function () {
    $('#td_wqsc_sheet').DataTable();
} );

    $("#intro").on('click','#removeRow',function(){
        $(this).parent().parent().remove();
        $('#totamt').change();
        $('.preferSelect').find('option[value ="' + this.value + '"]').attr("disabled", false);
        var sum    = 0;
          var sumqty = 0;
          var sums   = 0;
       

            $("#totamt").val("0");
            $("#totamt").val(sum);

   
            $("#totqty").val("0");
            $("#totqty").val(sumqty);
    });
   
    
    $("#total").on('mouseover mouseenter mouseleave mouseup mousedown', function(){
        return false;
      });
    $("#total").val("");
    $('.preferSelect').change();
    $('#intro').trigger('change');
    $('[data-toggle="tooltip"]').tooltip({trigger: "hover"});
  });



  $('#intro').trigger('change');

  
  $('#intro').on("change", ".preferSelect", function() {
    
    $('.preferSelect').each(function(){
        $('.preferSelect').find('option[value ="' + this.value + '"]').attr("disabled", true);
    
      });
  });

////////////////////////
</script>

<script>
$(document).ready(function() {
    // $("#bill_no").change(function(){
$('.confirm-div').hide();

<?php if($this->session->flashdata('msg')){ ?>

$('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();
});
// });

<?php } ?>

</script>


