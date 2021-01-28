<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url("/confed.jpg"); ?>">
        <title>CONFED</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url("/assets/css/sb-admin.css");?>">
        <link rel="stylesheet" href="<?php echo base_url("/assets/css/select2.css");?>">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url("/assets/js/validation.js")?>"></script>
        <script type="text/javascript" src="<?php echo base_url("/assets/js/select2.js")?>"></script>

    </head>  
    <style>
        .hr {
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        }

        .transparent_tag {

            background: transparent; 
            border: none;

        }

        .no-border {
            border: 0;
            box-shadow: none;
            width: 75px;
        }
    </style>

    <body id="page-top" style="background-color: #eff3f6;">
    
        <header style="background-color: #353746; border:none; padding: 6px; border-radius: 0; color: #fff; width: 100%;">

            <div style="margin-left: 35px; display: inline; margin-right: 35px; padding: 3px; font-family: 'Courier New', Courier, monospace;">

                <span styele="display: inline; width: 200px;"><strong>Date:</strong> <?php echo date("d-m-Y");?></span>
                <strong>KMS Year: </strong><?php { echo $this->session->userdata('kms_yr');}?>
            </div>
            
            <div style="display: inline; margin-right: 35px; padding: 3px; font-family: 'Courier New', Courier, monospace; float: right;">

                <span styele="display: inline;"><strong>User: </strong> <?php echo $this->session->userdata('loggedin')->user_name;?></span>
                &nbsp;&nbsp; <a href="<?php echo site_url("profile") ?>" style="color: white; text-decoration: none;"><i class="fa fa-cog fa-spin fa-fw" aria-hidden="true"></i></a>
            </div>

        </header>
        
        <header style="background-color: #fff;">

            <div style="margin-left: 35px; padding: 3px; font-family: 'Courier New', Courier, monospace;">

                <img src="<?php echo base_url("/confed.jpg");?>" style="display: inline; height: 65px;" />
                
            </div>
            
        </header>

        <nav class="navbar navbar-inverse bg-primary" style="background-color: #424854; border:none; border-radius: 0; color: #9194a0;">

            <div style="margin-left: 20px;">

                <div class="col-lg-9 col-xs-8">

                    <?php if($this->session->userdata('loggedin')->ddmo == 0){ ?>
                    <div class="navbar-header">

                        <a class="navbar-brand" href="<?php echo site_url("User_Login/main");?>"><i class="fa fa-home"></i> Home</a>

                    </div>
                    
                    <!-- <div class="dropdown">

                        <div class="dropbtn">
                            <i class="fa fa-university" aria-hidden="true"></i>
                                Accounts & Finance
                            <i class="fa fa-angle-down"></i>
                        </div>
                        </div>

                    </div> -->

                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i>
                                Payroll
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                        <?php if($this->session->userdata('loggedin')->payroll == 1){?>
                            <!--<a href="<?php echo site_url('payroll/addemp');?>">Upload Employee</a>-->    
                            <a href="<?php echo site_url('payroll/employee');?>">Employee</a>
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Salary<i class="fa fa-angle-right" style="float: right;"></i></a>
                                 <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('payroll/deduction');?>">Deduction</a>
                                    <a href="<?php echo site_url('payroll/attendance');?>">Attendance for Daily Wages</a>
                                    <a href="<?php echo site_url('payroll/doublesal');?>">Double Salary</a>
                                    <a href="<?php echo site_url('payroll/generation');?>">Payslip Generation</a>
                                  </div>
                            </div>
                           
                           <div class="sub-dropdown">
                               <a class="sub-dropbtn">Others <i class="fa fa-angle-right" style="float: right;"></i></a> 
                               <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('payroll/bonus');?>">Advance/Bonus for Puja</a>
                                    <a href="<?php echo site_url('payroll/incentive');?>">Incentive for Puja</a>
                                    <a href="<?php echo site_url('payroll/increment');?>">Periodic Increment</a>
                                    <a href="<?php echo site_url('payroll/stopsalary');?>">Stop Salary</a>
                                </div>
                            </div> 
                            <a href="<?php echo site_url('payroll/approve');?> ">Approve</a>
                            <a href="<?php echo site_url('payroll/parameter');?> ">Salary Parameter</a>
                            <?php } ?>
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Reports <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                <a href="<?php echo site_url('payroll/salaryold/report'); ?>">Old Category wise Salary List</a>
                                    <a href="<?php echo site_url('payroll/salary/report'); ?>">Category wise Salary List</a>
                                    <a href="<?php echo site_url('payroll/payslipold/report'); ?>">Old Payslip</a>
                                    <a href="<?php echo site_url('payroll/payslip/report'); ?>">Payslip</a>
                                    <!-- <a href="<?php echo site_url('payroll/statementold/report'); ?>">Old Salary Statement Month Wise</a> -->
                                    <a href="<?php echo site_url('payroll/statement/report'); ?>">Salary Statement Month Wise</a>
                                    <a href="<?php echo site_url('payroll/bonus/report'); ?>">Bonus</a>
                                    <a href="<?php echo site_url('payroll/incentive/report'); ?>">Incentive</a>
                                    <a href="<?php echo site_url('payroll/pfcontribution/report'); ?>">PF Contribution</a>
                                    <a href="<?php echo site_url('payroll/totaldeduction/report'); ?>">Total Deduction</a>
                                </div>
                            </div>    
                        </div>

                    </div>

                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-group" aria-hidden="true"></i>
                                Leave
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                            <!-- <a href="<?php //echo site_url('leave/applyLeave');?>">Leave Apply</a> -->
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Leave Apply<i class="fa fa-angle-right" style="float: right;"></i></a>
                                    <div class="sub-dropdown-content">
                                        <a href="<?php echo site_url('leave/applyLeave');?>">General Leave</a>
                                        <a href="<?php echo site_url('leave/applyMatLeave');?>">Maternity Leave</a>
                                        
                                    </div>
                            </div>
                        
                        <?php if($this->session->userdata('loggedin')->payroll == 1){
                            if($this->session->userdata('loggedin')->user_type == 'A'){?>

                                <div class="sub-dropdown">
                                    <a class="sub-dropbtn">Leave Approve<i class="fa fa-angle-right" style="float: right;"></i></a>
                                    <div class="sub-dropdown-content">
                                        <a href="<?php echo site_url('leave/firstApproval');?>">General Leave</a>
                                        <a href="<?php echo site_url('leave/matLeaveApproval');?>">Maternity Leave</a>
                                        
                                    </div>
                                </div>

                                <!-- <a href="<?php //echo site_url('leave/firstApproval');?>">Leave Approve</a> -->
                            
                            <?php } ?>
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Leave Management<i class="fa fa-angle-right" style="float: right;"></i></a>
                                    <div class="sub-dropdown-content">
                                        <a href="<?php echo site_url('leave/leaveType');?>">Leave Master</a>
                                        <a href="<?php echo site_url('leave/leaveAllocation');?>">Leave Allocation</a>
                                        <a href="<?php echo site_url('leave/deduction');?>">Deduction</a>
                                        <a href="<?php echo site_url('leave/rollBack');?>">Roll Back</a>
                                    </div>
                            </div>

                        <?php } ?>
                        
                           <div class="sub-dropdown">
                               <a class="sub-dropbtn">Report <i class="fa fa-angle-right" style="float: right;"></i></a> 
                               <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('leave/personalLedger');?>">Personal Ledger</a>
                                    
                                    <?php if($this->session->userdata('loggedin')->payroll == 1 || $this->session->userdata('loggedin')->user_type == 'A'){ ?>
                                        
                                        <a href="<?php echo site_url('leave/employeeLedger');?>">Employee Ledger</a>
                                    
                                    <?php }?>

                                </div>
                            </div> 
                            
                        </div>

                    </div>

                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-industry" aria-hidden="true"></i>
                                Paddy
                            <i class="fa fa-angle-down"></i>
                        </div>

                        <div class="dropdown-content">
                        <?php if($this->session->userdata('loggedin')->paddy == 1){?>

                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Add New <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                <!-- <a href="<?php echo site_url('paddy/kmsyear');?>">Change KMS Year</a> -->
                                    <a href="<?php echo site_url('paddy/district');?>">District</a>
                                    <a href="<?php echo site_url('paddy/block');?>">Block</a>
                                    <a href="<?php echo site_url('paddy/mill');?>">Mill</a>
                                    <a href="<?php echo site_url('paddy/society');?>">Society</a>
                                    <a href="<?php echo site_url('paddy/societymill');?>">Society Mill Connection</a>
                                </div>
                            </div>
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Transactions <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('paddy/workorder'); ?>">Work Order</a>
                                    <a href="<?php echo site_url('paddy/farmerreg'); ?>">No of Farmer Registered</a>
                                    <a href="<?php echo site_url('paddy/paddycollection'); ?>">Paddy Procurement</a>
                                    <a href="<?php echo site_url('paddy/received'); ?>">Paddy Delivered to Rice Mill</a>
                                    <a href="<?php echo site_url('paddy/offered');?>">CMR offered</a>
                                    <a href="<?php echo site_url('paddy/doisseued');?>">DO Issue</a>
                                    <a href="<?php echo site_url('paddy/delivery');?>">CMR Delivery</a>
                                </div>
                            </div>
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Bill <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('paddy/bill/master'); ?>">Bill Master</a>
                                    <a href="<?php echo site_url('paddy/bill/documents'); ?>">Supporting Documents</a>
                                    <a href="<?php echo site_url('paddy/bill'); ?>">Bill Entry</a>
                                    <a href="<?php echo site_url('paddy/bill/submit'); ?>">Bill Submit</a>
                                   
                                </div>
                            </div>
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Payment <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('paddy/payment'); ?>">Millers Bill Payment</a>
                                    <a href="<?php echo site_url('paddy/commission'); ?>">Societies Commission</a>
                                    <a href="<?php echo site_url('paddy/paid'); ?>">Paid</a>
                                    <a href="<?php echo site_url('paddy/payment/received'); ?>">Payment Received</a>
                                </div>
                            </div>
                            <!-- <div class="sub-dropdown">
                                <a class="sub-dropbtn">WQSC <i class="fa fa-angle-right" style="float: right;"></i></a>     -->
                                <div >
                                    <a href="<?php echo site_url('paddy/wqsc'); ?>">WQSC</a>
                                    <!-- <a href="<?php echo site_url('paddy/approve/payment'); ?>">Payments</a> -->
                                </div>
                            <!-- </div>  -->
                            <?php } ?>
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Reports <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                <a href="<?php echo site_url('report/procurementRep'); ?>">Society Wise Total Procurement</a>
                                    <!--<a href="<?php //echo site_url('paddy/distwise/report'); ?>">District Wise</a>-->
                                <!--<a href="<?php //echo site_url('paddy/datewiseprocurement/report'); ?>">Date Wise Procurement</a>-->
                                <a href="<?php echo site_url('report/proctodelivery'); ?>">Procurement to Delivery</a>
                                <a href="<?php echo site_url('report/wqscdetailsReport'); ?>">WQSC Details</a>
                                    <!--<a href="<?php echo site_url('paddy/blockwise/report'); ?>">Block Wise</a>-->
                                <a href="<?php echo site_url('report/billreport'); ?>">Bill</a>
                                <a href="<?php echo site_url('report/labourCharge'); ?>">Mandi Labour Charge</a>
                                <a href="<?php echo site_url('report/societyComm'); ?>">Society Comission</a>
                                <a href="<?php echo site_url('report/claimTransport'); ?>">Transport Charge</a>
                                <a href="<?php echo site_url('report/millComm'); ?>">Milling Charge</a>
                                <a href="<?php echo site_url('report/gunnyRep'); ?>">Claim For Gunny Bag</a>
                                <a href="<?php echo site_url('report/billdetailsReport'); ?>">Bill Details</a>
                                <a href="<?php echo site_url('report/millPayment'); ?>">Miller's Payment</a>
                                <a href="<?php echo site_url('report/paymentVoucher'); ?>">Payment Voucher</a>
                                <a href="<?php echo site_url('report/paymentsociety'); ?>">Society's Payment</a>
                                <a href="<?php echo site_url('report/paddydeclr'); ?>">Declaration</a>
                                </div>
                            </div>    
                        </div>

                    </div>

                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-medkit " aria-hidden="true"></i>
                                DM
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                        <?php if($this->session->userdata('loggedin')->dm == 1){?>
                            
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Add New <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('Disaster/itemEntry'); ?>">Items</a>
                                    <a href="<?php echo site_url('Disaster/distContact'); ?>">District Contacts</a>
                                    <a href="<?php echo site_url('Disaster/workOrderEntry'); ?>">Work Order</a> 
                                    <a href="<?php echo site_url('Disaster/sdoEntry'); ?>">SDO</a>
                                    <a href="<?php echo site_url('Disaster/bdoEntry'); ?>">BDO/Municipality</a>
                                    <a href="<?php echo site_url('Disaster/distPointEntry'); ?>">Distribution Points</a>
                                </div>
                            </div>
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Transactions <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <!-- <a href="<?php echo site_url('Disaster/workOrderEntry'); ?>">Work Order</a>  -->
                                    <a href="<?php echo site_url('Disaster/agentDistribution'); ?>">Distribution</a>
                                    <a href="<?php echo site_url('Disaster/agentDelivery'); ?>">Delivery & Purchase</a> 
                                    <a href="<?php echo site_url('Disaster/agentSale'); ?>">Sale</a>
                                </div>
                            </div>
                            
                            <div>
                                <a href="<?php echo site_url("Disaster/confirmation");?>">Confirmation</a>
                            </div>

                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Payment <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('Disaster/billPay_record'); ?>">Bill Receipt</a> 
                                    <a href="<?php echo site_url('Disaster/paymentDetails'); ?>">Payment Details</a>
                                    <!-- <a href="  //echo site_url('Disaster/agentDelivery');">Agent Delivery</a>  
                                    <a href=" // echo site_url('paddy/bill');">xyz</a> -->
                                </div>
                            </div>
                            <?php } ?>
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Reports <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('Disaster/Report/workOrderReport'); ?>">Work Order</a> 
                                    <a href="<?php echo site_url('Disaster/Report/agentDistribution'); ?>">Agent Distribution</a>
                                    <a href="<?php echo site_url('Disaster/Report/agentDel_report'); ?>">Agent Delivery</a>
                                    <a href="<?php echo site_url('Disaster/Report/confirmation'); ?>">Confirmation Reports</a>
                                    <a href="<?php echo site_url('Disaster/Report/dateWise_billPay'); ?>">Date Wise Collection And Payment</a>
                                    <!-- <a href="<?php echo site_url('Disaster/Report/dateWise_vendorPay'); ?>">Date Wise Vendor Payment</a> -->
                                    <!-- <a href="<?php echo site_url('Disaster/Report/dateWise_revenew'); ?>">Date Wise Revenew</a> -->
                                </div>
                            </div>

                        </div>    
                    </div>

                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-handshake-o" aria-hidden="true"></i>
                                SW
                            <i class="fa fa-angle-down"></i>
                        </div>
                        <div class="dropdown-content">
                        <?php if($this->session->userdata('loggedin')->sw == 1){?>

                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Add New <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('sw/itemEntry'); ?>">Items</a>
                                    <a href="<?php echo site_url('sw/projectEntry'); ?>">Projects</a>
                                    <a href="<?php echo site_url('sw/rateEntry'); ?>">Rate Chart</a>
                                    <a href="<?php echo site_url('sw/vendorEntry'); ?>">Vendors</a>
                                </div>
                            </div>
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Transactions <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('sw/supplyOrderEntry'); ?>">Supply Order</a> 
                                    <a href="<?php echo site_url('sw/projectDelivery'); ?>">Delivery / Purchase</a> 
                                    <a href="<?php echo site_url('sw/sale'); ?>">Sale</a> 
                                    
                                </div>
                            </div>
                            <div>
                                <a href="<?php echo site_url('sw/billCollection'); ?>">Payment</a>
                            </div>
                            <div>
                                <a href="<?php echo site_url('sw/billShortage'); ?>">Payment Details & Shortage</a>
                            </div>
                            
                            <?php } ?>
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Report <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('sw/dwDeliveryReport'); ?>">Date Wise Delivery Report</a> 
                                    <a href="<?php echo site_url('sw/pwDeliveryReport'); ?>">Project Wise Delivery Report</a> 
                                    <a href="<?php echo site_url('sw/swDeliveryReport'); ?>">Supplier Wise Delivery Report</a> 
                                    <a href="<?php echo site_url('sw/purchaseReport'); ?>">Date Wise Purchase Report</a> 
                                    <a href="<?php echo site_url('sw/saleReport'); ?>">Date Wise Sale Report</a> 
                                    <a href="<?php echo site_url('sw/oilPaymentReport'); ?>">OIL Payment Report</a> 
                                    <!-- <a href="<?php echo site_url('sw/oilSheetSelection'); ?>">OIL Payment Sheet</a>  -->
                                    <!-- <a href="<?php //echo site_url('sw/nonGstPaymentReport'); ?>">NON-GST Payment Report</a>  -->
                                    <!-- <a href="<?php echo site_url('sw/dwRevenew'); ?>">Date Wise Revenue</a>  -->
                                    <!-- <a href="<?php echo site_url('sw/pwRevenew'); ?>">Project Wise Revenue</a>  -->
                                    <!-- <a href="<?php echo site_url('sw/dwShortageReport'); ?>">Date Wise Shortage</a>  -->
                                    <!-- <a href="<?php echo site_url('sw/pwShortageReport'); ?>">Project Wise Shortage</a>  -->
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    

                    <div class="dropdown">
                        <div class="dropbtn">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> 
                                Stationary
                            <i class="fa fa-angle-down"></i>
                        </div>

                        <?php if($this->session->userdata('loggedin')->st == 1){?>

                        <div class="dropdown-content">
                        
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Add New <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <!-- <a href="<?php //echo site_url('stationary/units'); ?>">Unit</a> -->
                                    <a href="<?php echo site_url('stationary/suppliers'); ?>">Suppliers</a>
                                    <a href="<?php echo site_url('stationary/projects'); ?>">Projects</a>
                                    
                                </div>
                            </div>
                            
                            <div>
                                <a href="<?php echo site_url('stationary/supplyOrder'); ?>">Order</a>
                            </div>

                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Bill <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <a href="<?php echo site_url('stationary/purchaseBill'); ?>">Purchase Bill</a> 
                                    <a href="<?php echo site_url('stationary/saleBill'); ?>">Sale Bill</a> 
                                </div>
                            </div>

                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Transactions <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">
                                    <!-- <a href="<?php //echo site_url('stationary/supplyOrder'); ?>">Order</a>  -->
                                    <a href="<?php echo site_url('stationary/collection'); ?>">Collection</a>
                                    <a href="<?php echo site_url('stationary/payment'); ?>">Payment</a>
                                </div>
                            </div>
                    
                            <div class="sub-dropdown">
                                <a class="sub-dropbtn">Report <i class="fa fa-angle-right" style="float: right;"></i></a>    
                                <div class="sub-dropdown-content">

                                    <a href="<?php echo site_url('stationary/supplierReport'); ?>">Supplier Details</a> 
                                    <!-- <a href="<?php //echo site_url('stationary/renewalReport'); ?>">Supplier's Renewal Status</a>  -->
                                    <a href="<?php echo site_url('stationary/byDateRenReport'); ?>">Date Wise Renewal Status</a> 
                                    <a href="<?php echo site_url('stationary/projectReport'); ?>">Project Details</a> 
                                    <a href="<?php echo site_url('stationary/orderReport'); ?>">Order Report</a> 
                                    <a href="<?php echo site_url('stationary/billReport'); ?>">Bill Report</a> 
                                    <a href="<?php echo site_url('stationary/collectionReport'); ?>">Collection Report</a> 
                                    <a href="<?php echo site_url('stationary/paymentReport'); ?>">Payment Report</a> 
                                    
                                </div>
                            </div>
                            
                        </div>

                        <?php } ?>

                    </div>
                    <?php } ?>
                </div>
                
                <div class="col-lg-3 col-xs-4" >
                    
                    <div class="dropdown">

                        <div class="dropbtn">
                        <?php if($this->session->userdata('loggedin')->user_type == 'A'){?>

                            <a href="<?php echo site_url("admin/user") ?>" style="color: white; text-decoration: none;"><i class="fa fa-user" aria-hidden="true"></i> Admin</a>

                        <?php } ?>

                        </div>

                    </div>
                    <div class="dropdown">

                        <div class="dropbtn">

                            <a href="<?php echo site_url("User_Login/logout") ?>" style="color: white; text-decoration: none;"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>

                        </div>    

                    </div>    

                </div>

            </div>

        </nav>

        <section>
