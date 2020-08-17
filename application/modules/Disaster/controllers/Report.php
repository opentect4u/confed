<?php

    class Report extends MX_Controller
    {
        public function __construct()
        {
			parent::__construct();
            $this->load->model('Disaster_m');
            
            if(!isset($this->session->userdata('loggedin')->user_id)){
            
                redirect('User_Login/login');
    
            }
        }
        

        // *********************** For DM/ Report/ Work Order Tab ******************//


        public function workOrderReport()
        {

            $this->load->view('post_login/main');

            $wo['data'] = $this->Disaster_m->f_get_woDtls();
            $this->load->view('report/workOrder', $wo);

            $this->load->view('post_login/footer'); 

        }


        public function viewReport()
        {

            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $order_no       =       $_POST['order_no'];
                
                $reportDtls['data'] = $this->Disaster_m->f_get_reportDtls($order_no);

                $get_item = $this->Disaster_m->f_get_item_no($order_no); 
                $item_no = $get_item->item; 

                $get_itemName['item_dtls'] = $this->Disaster_m->f_get_itemName($item_no);
                //$item_name = $item_dtls[0]->item_name; 

                $itemDtls_data = $get_itemName['item_dtls'][0];
                //echo $itemDtls_data->item_name; die;

                $reportDtls['order_dt'] = $this->Disaster_m->f_get_orderDt($order_no);
                $reportDtls['order_no'] = $order_no;
                $reportDtls['item'] = $itemDtls_data->item_name;
                $reportDtls['unit'] = $itemDtls_data->unit;

                $get_totalQty = $this->Disaster_m->f_get_totalAllotQty($order_no);
                $totalAllotQty = $get_totalQty->allot_qty;

                $reportDtls['tot_allotQty'] = $totalAllotQty;
                
                $this->load->view('post_login/main');
                $this->load->view('report/wo_modal', $reportDtls);
                $this->load->view('post_login/footer');

            }

        }


        // *********************** For DM/ Report/ Distribution Tab ******************//

        public function agentDistribution()
        {

            $this->load->view('post_login/main');

            $reportEntry['data'] = $this->Disaster_m->f_get_districtCode();
            $reportEntry['data1'] = $this->Disaster_m->f_get_dist_WoNo();

            $this->load->view('report/agentDist', $reportEntry);

            $this->load->view('post_login/footer'); 

        }


        public function view_agentDistReport()
        {

            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $order_no       =       $_POST['order_no'];
                $dist_cd        =       $_POST['dist_cd'];

                $get_orderDt = $this->Disaster_m->f_get_dist_orderDt($order_no);
                $order_dt = $get_orderDt->order_dt;

                $get_item = $this->Disaster_m->f_get_item_no($order_no);
                $item_no = $get_item->item;

                $get_itemName['item_dtls'] = $this->Disaster_m->f_get_itemName($item_no);
                $itemDtls_data = $get_itemName['item_dtls'][0];

                //$item_name = $get_itemName->item_name;

                $get_distName = $this->Disaster_m->f_get_distName($dist_cd);
                $dist_name = $get_distName->district_name;

                $get_distQty = $this->Disaster_m->f_get_totDistAllot_Qty($dist_cd, $order_no);
                $tot_qty = $get_distQty->allot_qty;

                $reportDtls['order_no'] = $order_no;
                $reportDtls['order_dt'] = $order_dt;                
                $reportDtls['item'] = $itemDtls_data->item_name;

                //$reportDtls['unit'] = $itemDtls_data->unit;
                $check_unit = $itemDtls_data->unit;
                if($check_unit == 'MT')
                {
                    $reportDtls['unit'] = "Qnt";
                }
                else
                {
                    $reportDtls['unit'] = $itemDtls_data->unit;
                }

                $reportDtls['dist'] = $dist_name;
                $reportDtls['totQty'] = $tot_qty;
                
                $reportDtls['data'] = $this->Disaster_m->f_get_agentDistReport_data($dist_cd, $order_no);

                $reportDtls['tot_distQty'] = $this->Disaster_m->f_get_tot_agentDistQty($order_no, $dist_cd);

                $this->load->view('post_login/main');
                $this->load->view('report/dist_modal', $reportDtls);
                $this->load->view('post_login/footer');

            }

        }


        ////// *************** FOR DELIVERY REPORT ********** ///////////

        public function agentDel_report()
        {

            $this->load->view('post_login/main');

            $reportEntry['data'] = $this->Disaster_m->f_get_districtCode();
            $reportEntry['data1'] = $this->Disaster_m->f_get_dist_WoNo();

            $this->load->view('report/delSelection', $reportEntry);

            $this->load->view('post_login/footer');


        }


        public function view_agentDel_report()
        {

            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $order_no       =       $_POST['order_no'];
                $dist_cd        =       $_POST['dist_cd'];
                $sdo_memo       =       $_POST['sdo_memo'];

                $reportDtls['data'] = $this->Disaster_m->f_get_agentDel_report_data($dist_cd, $order_no, $sdo_memo);
                $reportDtls['data_tot_allot'] = $this->Disaster_m->f_get_agentDel_totAlloted($dist_cd, $order_no, $sdo_memo);
                $reportDtls['data_DelQty'] = $this->Disaster_m->f_get_agentDel_totDelivered($dist_cd, $order_no, $sdo_memo);
                
                $get_orderDt = $this->Disaster_m->f_get_dist_orderDt($order_no);
                $order_dt = $get_orderDt->order_dt;

                $get_item = $this->Disaster_m->f_get_item_no($order_no);
                $item_no = $get_item->item;

                $get_itemName['item_dtls'] = $this->Disaster_m->f_get_itemName($item_no);
                //$item_name = $get_itemName->item_name;
                $itemDtls_data = $get_itemName['item_dtls'][0];

                $get_distName = $this->Disaster_m->f_get_distName($dist_cd);
                $dist_name = $get_distName->district_name;
                
                $reportDtls['order_no'] = $order_no;
                $reportDtls['order_dt'] = $order_dt;
                $reportDtls['sdo_memo'] = $sdo_memo;
                $reportDtls['item_name'] = $itemDtls_data->item_name;

                $check_unit = $itemDtls_data->unit;
                if($check_unit == 'MT')
                {
                    $reportDtls['unit'] = "Qnt";
                }
                else
                {
                    $reportDtls['unit'] = $itemDtls_data->unit;
                }

                $reportDtls['dist_name'] = $dist_name;
                
                
                //echo "<pre>";
                //var_dump($reportDtls);

                $this->load->view('post_login/main');
                $this->load->view('report/agentDel', $reportDtls);
                $this->load->view('post_login/footer');

            }

        }



        ///// ******* FOR CONFIRMATION REPORT ********** ///////

        public function confirmation()
        {

            $this->load->view('post_login/main');

            $entryData['dist_data'] = $this->Disaster_m->f_get_districtCode();
            //$entryData['item_data'] = $this->Disaster_m->f_get_itemList();

            $this->load->view('report/cnfSelection', $entryData);
            
            $this->load->view('post_login/footer');

        }

        public function confirmationddmo()
        {

            $this->load->view('post_login/main');

            $entryData['dist_data'] = $this->Disaster_m->f_get_districtCode();
            //$entryData['item_data'] = $this->Disaster_m->f_get_itemList();

            $this->load->view('report/cnfSelectionddmo', $entryData);
            
            $this->load->view('post_login/footer');

        }


        public function show_cnfReport()
        {

            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $dist_cd        =           $_POST['dist_cd'];
                $order_no       =           $_POST['order_no'];

                $this->load->view('post_login/main');

                $reportData['data1']        =   $this->Disaster_m->f_get_deliveryData($dist_cd, $order_no);
                
                $reportData['district']     =   $this->Disaster_m->f_get_distName($dist_cd);
                $reportData['order_dt']     =   $this->Disaster_m->f_get_dist_orderDt($order_no);
                $reportData['order_no']     =   $order_no;

                $get_item = $this->Disaster_m->f_get_item_no($order_no);
                $item_no = $get_item->item;

                $get_itemName['item_dtls'] = $this->Disaster_m->f_get_itemName($item_no);
                $itemDtls_data = $get_itemName['item_dtls'][0];

                $reportData['item_name'] = $itemDtls_data->item_name;

                $check_unit = $itemDtls_data->unit;
                if($check_unit == 'MT')
                {
                    $reportData['unit'] = "Qnt";
                }
                else
                {
                    $reportData['unit'] = $itemDtls_data->unit;
                }

                $reportData['tot_data']     =   $this->Disaster_m->f_get_cnfReport_totalData($dist_cd, $order_no);

                //echo "<pre>";
                //var_dump($reportData['data1'][0]); die;
                //$array = $reportData['data1'][0];
                //echo($array->cnf_memo); die;

                $this->load->view('report/show_cnfReport', $reportData);

                $this->load->view('post_login/footer');


            }

        }

        // *********** FOR Date wise Bill payment Section // Accounts *********//

        public function dateWise_billPay()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/payDate_selection');
            
            $this->load->view('post_login/footer');

        }


        public function show_dw_billPay()
        {

            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);

                $startDt = $splittedstring[0];
                $endDt   = $splittedstring[1];
                // echo $startDt; 
                // echo $endDt; die;

                $this->load->view('post_login/main');

                $showData['data'] = $this->Disaster_m->f_get_dateWise_billPay_record($startDt, $endDt);
                $showData['total'] = $this->Disaster_m->f_get_dw_tot_billPay_amount($startDt, $endDt);
                $showData['start_dt'] =  $startDt;
                $showData['end_dt'] =  $endDt;

                $this->load->view('report/show_dw_billPay', $showData);

                $this->load->view('post_login/footer');

            }

        }

        // ****************** For date wise vendor payment ****************** //

        public function dateWise_vendorPay()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/vendorPay_dateSelection');
            
            $this->load->view('post_login/footer');


        }


        public function show_dw_vendorPay()
        {

            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);

                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];
                // echo $startDt; 
                // echo $endDt; die;

                $this->load->view('post_login/main');

                $showData['data'] = $this->Disaster_m->f_get_dateWise_vendorPay_record($startDt, $endDt);
                $showData['total'] = $this->Disaster_m->f_get_dw_tot_vendorPay_amount($startDt, $endDt);
                $showData['start_dt'] =  $startDt;
                $showData['end_dt'] =  $endDt;
                $this->load->view('report/show_dw_vendorPay', $showData);
                $this->load->view('post_login/footer');

            }

        }


        public function dateWise_revenew()
        {

            $this->load->view('post_login/main');
            $this->load->view('report/revenew_dateSelection');
            $this->load->view('post_login/footer');

        }


        public function show_revenew()
        {

            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);

                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                $this->load->view('post_login/main');

                $showData['incomeData'] = $this->Disaster_m->f_get_dateWise_revenewIncome($startDt, $endDt);
                $showData['data'] = $this->Disaster_m->f_get_dateWise_revenewExpense($startDt, $endDt);
                
                $incomeData = $showData['incomeData'];
                // var_dump($incomeData); die;
                // echo $incomeData; die;

                if($showData['incomeData'] && $showData['data'])
                {
                    
                    $expense_data = $showData['data']['0'];   
                    $incomeData = $showData['incomeData']['0'];

                    $repData['income'] = $showData['incomeData'];
                    $repData['expense'] = $expense_data->expense;
                    $repData['commission'] = $expense_data->commission;
                    $repData['profit'] = NUMBER_FORMAT(( $incomeData - ($expense_data->expense) ),2);

                }
                else
                {
                    
                    $repData['income'] = 0;
                    $repData['expense'] = 0;
                    $repData['commission'] = 0;
                    $repData['profit'] = NUMBER_FORMAT(($showData['incomeData']),2);

                }

                $repData['start_dt'] = $startDt;
                $repData['end_dt'] = $endDt;
                
                $this->load->view('report/show_revenew', $repData);

                $this->load->view('post_login/footer');

            }

        }







    }

?>