
<style>

    table, td, th {
        text-align: center;
        border: 1px solid gray;
        }

    table {
        border-collapse: collapse;
        width: 80%;
        }

    th {
        height: 50px;
        }
    td {
        height: 50px;
    }

</style>

<div class="wraper">      

    <div class="col-md-7 container form-wraper">
    <!--  -->
        <form role="form" name="agent_delForm" method="POST" id="form" action="<?php echo site_url("Disaster/approveDeliveryRecord");?>" onsubmit="return validate()" >
        
            <div class="form-header">
            
                <h4>Add New Delivery</h4>
            
            </div>

            <?php
                foreach($data1 as $key1)
                { ?>

                <input type="hidden" name="sl_no" value= "<?php echo $sl_no; ?>" class="form-control required" id="sl_no" />

            
                <div class="form-group row">

                    <label for="dist_cd" class="col-sm-2 col-form-label">District:</label>

                    <div class="col-sm-4">

                        <select type="text" name="dist_cd" class="form-control required" id="dist_cd" readonly>
                            <option value= "<?php echo $key1->dist_cd; ?>"><?php echo $key1->district_name; ?></option>

                        </select>

                    </div>

                    <label for="point_no" class="col-sm-2 col-form-label">Agent:</label>

                    <div class="col-sm-4">

                        <select class="form-control" name="point_no" id="point_no" readonly >
                                        
                            <option value= ""><?php echo $key1->agent; ?></option>                                              
                                    
                        </select>
                    
                    </div>
                
                </div>

                <div class="form-group row">

                    <label for="address" class="col-sm-2 col-form-label">Agent Address:</label>

                    <div class="col-sm-8">

                        <textarea name="address" id="address" cols="30" rows="2" readonly><?php echo $key1->agent_adr; ?></textarea>

                    </div>

                </div>

                <div class="form-group row">

                    <label for="order_no" class="col-sm-2 col-form-label">W.O No:</label>

                    <div class="col-sm-4">

                        <select type="text" name="order_no" class="form-control required" id="order_no" readonly >
                            
                            <option value= ""><?php echo $key1->order_no ?></option>
                                
                        </select>        

                    </div>

                    <label for="sdo_memo" class="col-sm-2 col-form-label">Memo No:</label>

                    <div class="col-sm-4">

                        <select type="text" name="sdo_memo" class="form-control" id="sdo_memo" readonly>
                            
                            <option value= ""><?php echo $key1->sdo_memo; ?></option>
                                
                        </select>

                    </div>

                </div>

            <?php
                } ?>


                <div class="form-group row">

                    <?php 
                        foreach($allot_qty as $key2)
                        { ?>
                
                            <label for="qty_bal" class="col-sm-2 col-form-label">Alloted Balance(M.T):</label>
                    
                            <div class="col-sm-4">

                                <input type="text" name="qty_bal" value= "<?php echo $key2->allot_qty; ?>" class="form-control required" id="qty_bal" readonly/>
                    
                            </div>
                        
                    <?php 
                        } ?>


                    <label for="qty_bal" class="col-sm-2 col-form-label">Delivered Balance(M.T):</label>

                    <div class="col-sm-4">

                        <input type="text" name="del_bal" value= "<?php echo $tot_qty->tot_qty; ?>" class="form-control required" id="del_bal" readonly/>
            
                    </div>

                </div>
            
            
            <div class="form-group row">

                <label for="data" class="col-sm-4 col-form-label">Delivery Needs Confirmation:<font color="red">*</font></label>                
                <br><br>
                <table class="table table-striped" >
                    
                    <thead>
                        <tr>
                            <td><strong>Date</strong></td>
                            <td><strong>Challan NO.</strong></td>
                            <td><strong>Amount(M.T)</strong></td>
                        </tr>
                    </thead>

                    <?php
                        foreach($data1 as $key1)
                        { ?>

                            <tbody>
                                <tr>
                                    <td><?php echo date("d-m-Y", strtotime($key1->del_dt)) ; ?></td>
                                    <td><?php echo $key1->challan_no ; ?></td>
                                    <td><?php echo $key1->qty ; ?></td>
                                </tr>
                            </tbody>

                    <?php 
                        } ?>
                
                </table>
                
            </div>

            <div class="form-group row">

                <label for="message" class="col-sm-2 col-form-label">Confirmation Message:</label>

                <div class="form-group row">

                    <textarea name="message" id="message" cols="50" rows="5" required></textarea>

                </div>

            </div>
             

            <div class="form-group row">

                <div class="col-sm-10">

                    <input type="submit" class="btn btn-info" value="Approve" />

                </div>

            </div>

        </form>

    </div>

</div>