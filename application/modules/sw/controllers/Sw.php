<?php

    class Sw extends MX_Controller
    {
        public function __construct()
        {
			parent::__construct();
            $this->load->model('SocialW');
            
            if(!isset($this->session->userdata('loggedin')->user_id)){
            
                redirect('User_Login/login');
    
            }
        }

    // ********************** For Product Master ********************* //

        public function itemEntry()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->SocialW->f_get_item_table();
            $this->load->view('add/itemTable', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addItem()
        {

            $this->load->view('post_login/main');

            $this->load->view('add/addItem');

            $this->load->view('post_login/footer');

        }

        public function js_check_duplicateItem()
        {

            $hsn_no = $this->input->get('hsn_no');
            $result = $this->SocialW->js_get_check_duplicateItem($hsn_no);
            echo json_encode($result); 

        }

        public function addNewItem()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $item_name = $_POST['item_name'];
                $hsn_no = $_POST['hsn_no'];
                $unit = $_POST['unit'];
                
                $this->SocialW->addNewItem($hsn_no, $item_name, $unit, $created_by, $created_dt);

                echo "<script> alert('Successfully Submitted');
                document.location= 'itemEntry' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addItem' </script>";

            }


        }

        public function editItemEntry($hsn_no)
        {

            $this->load->view('post_login/main');

            $editData['data'] = $this->SocialW->f_get_item_editData($hsn_no);
            $this->load->view('add/editItem', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateNewItem()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $item_name = $_POST['item_name'];
                $hsn_no = $_POST['hsn_no'];
                $unit = $_POST['unit'];

                $this->SocialW->updateNewItem($hsn_no, $item_name, $unit, $modified_by, $modified_dt);

                echo "<script> alert('Successfully Updated');
                document.location= 'itemEntry' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addItem' </script>";

            }

        }

        // ***************** For Project Master ****************** //

        public function projectEntry()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->SocialW->f_get_projectData();
            $this->load->view('add/projectTable', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addProject()
        {

            $this->load->view('post_login/main');

            $distData['dist'] = $this->SocialW->f_get_distData();
            $this->load->view('add/addProject', $distData);

            $this->load->view('post_login/footer');

        }

        public function addNewProject()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $slNo = $this->SocialW->f_get_projectSlNo_max();
                $sl_no = $slNo->sl_no + 1;
                //echo $sl_no; die;

                $cdpo = $_POST['cdpo'];
                $dist_cd = $_POST['dist_cd'];
                $contact_no = $_POST['contact_no'];
                $address = $_POST['address'];
                
                $this->SocialW->addNewProject($sl_no, $cdpo, $dist_cd, $contact_no, $address, $created_by, $created_dt);

                echo "<script> alert('Successfully Submitted');
                document.location= 'projectEntry' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addProject' </script>";

            }


        }

        public function editProjectEntry()
        {

            $sl_no = $this->input->get('sl_no');
            $cdpo = $this->input->get('cdpo');
            
            $this->load->view('post_login/main');

            $editData['data'] = $this->SocialW->f_get_project_distData($sl_no, $cdpo);
            $this->load->view('add/editProject', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateNewProject()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                
                $sl_no = $_POST['sl_no'];
                //echo $sl_no; die;
                $cdpo = $_POST['cdpo'];
                $dist_cd = $_POST['dist_cd'];
                $contact_no = $_POST['contact_no'];
                $address = $_POST['address'];
                
                $this->SocialW->updateNewProject($sl_no, $cdpo, $dist_cd, $contact_no, $address, $modified_by, $modified_dt);

                echo "<script> alert('Successfully Updated');
                document.location= 'projectEntry' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'projectEntry' </script>";

            }



        }

    //**************** For Rate Master ********************//

        public function rateEntry()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->SocialW->f_get_rateChartData();
            $this->load->view('add/rateTable', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addRate()
        {

            $this->load->view('post_login/main');

            $productData['data'] = $this->SocialW->f_get_rateChart_productData();
            $this->load->view('add/addRate', $productData);

            $this->load->view('post_login/footer');

        }

        public function js_get_productUnit() // For JS
        {

            $hsn_no      =      $this->input->get('hsn_no');

            $result = $this->SocialW->js_get_productUnit($hsn_no);
            echo json_encode($result);

        }

        public function addNewRate()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $slNo = $this->SocialW->f_get_rateChartSlNo_max();
                $sl_no = $slNo->sl_no + 1;

                $from_dt        =       $_POST['from_dt'];
                $to_dt          =       $_POST['to_dt'];
                $hsn_no         =       $_POST['hsn_no'];
                $unit           =       $_POST['unit'];
                $rate           =       $_POST['rate'];
                $margin         =       $_POST['margin'];
                $gst            =       $_POST['gst'];

                $rate_count         =     count($rate);

                $this->SocialW->addNewRate($sl_no, $from_dt, $to_dt, $hsn_no, $unit, $rate, $margin, $gst, $created_by, $created_dt, $rate_count);

                echo "<script> alert('Successfully Submitted');
                document.location= 'rateEntry' </script>";
            
            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addRate' </script>";

            }

        }

        public function editRateEntry()
        {

            $sl_no = $this->input->get('sl_no');
            $hsn_no = $this->input->get('hsn_no');

            $this->load->view('post_login/main');

            $editData['data'] = $this->SocialW->f_get_rate_editData($sl_no, $hsn_no);
            //echo "<pre>";
            //var_dump($editData['data']); die;
            $this->load->view('add/editRate', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateNewRate()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $sl_no          =       $_POST['sl_no'];

                $from_dt        =       $_POST['from_dt'];
                $to_dt          =       $_POST['to_dt'];
                $hsn_no         =       $_POST['hsn_no'];
                $unit           =       $_POST['unit'];
                $rate           =       $_POST['rate'];
                $margin         =       $_POST['margin'];
                $gst            =       $_POST['gst'];

                //$rate_count         =     count($rate);

                $this->SocialW->updateNewRate($sl_no, $from_dt, $to_dt, $hsn_no, $unit, $rate, $margin, $gst, $modified_by, $modified_dt);

                echo "<script> alert('Successfully Updated');
                document.location= 'rateEntry' </script>";
            
            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'rateEntry' </script>";

            }


        }


    // ****************** For Vendor Master ***************** //

        public function vendorEntry()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->SocialW->f_get_vendorData();
            $this->load->view('add/vendorTable', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addVendor()
        {

            $this->load->view('post_login/main');

            $this->load->view('add/addVendor');

            $this->load->view('post_login/footer');

        }

        public function addNewVendor()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $slNo = $this->SocialW->f_get_vendorSlNo_max();
                $sl_no = $slNo->sl_no + 1;
                //echo $sl_no; die;

                $vendor_name = $_POST['vendor_name'];
                $contact_no = $_POST['contact_no'];
                $email_id = $_POST['email_id'];
                $address = $_POST['address'];
                
                $this->SocialW->addNewVendor($sl_no, $vendor_name, $contact_no, $email_id, $address, $created_by, $created_dt);

                echo "<script> alert('Successfully Submitted');
                document.location= 'vendorEntry' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addVendor' </script>";

            }

        }

        public function editVendorEntry()
        {

            $sl_no = $this->input->get('sl_no');
            $this->load->view('post_login/main');

            $editData['data'] = $this->SocialW->f_get_vendor_editData($sl_no);
            //echo "<pre>";
            //var_dump($editData['data']); die;
            $this->load->view('add/editVendor', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateNewVendor()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                
                $sl_no = $_POST['sl_no'];
                
                $vendor_name = $_POST['vendor_name'];
                $contact_no = $_POST['contact_no'];
                $email_id = $_POST['email_id'];
                $address = $_POST['address'];
                
                $this->SocialW->updateNewVendor($sl_no, $vendor_name, $contact_no, $email_id, $address, $modified_by, $modified_dt);

                echo "<script> alert('Successfully Updated');
                document.location= 'vendorEntry' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'vendorEntry' </script>";

            }


        }



    /////////////////////////////////////////////////////////////////////////////////
    // *********************** For Transaction Part ****************************** //
    /////////////////////////////////////////////////////////////////////////////////

        public function supplyOrderEntry()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->SocialW->f_get_supplyOrder_tableData();
            $this->load->view('transaction/orderTable', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addSupplyOrder()
        {

            $this->load->view('post_login/main');

            $addData['dist'] = $this->SocialW->f_get_distData();
            $addData['item'] = $this->SocialW->f_get_rateChart_productData();
            $this->load->view('transaction/addOrder', $addData);

            $this->load->view('post_login/footer');

        }

        public function js_get_order_projectName() //FOR JS
        {

            $order_no      =      $this->input->get('order_no');

            $result = $this->SocialW->js_get_order_projectName($order_no);
            echo json_encode($result);

        }

        public function js_get_orderNo_forNewOrderEntry() // For JS
        {

            $order_no = $this->input->get('order_no');

            $result = $this->SocialW->js_get_orderNo_forNewOrderEntry($order_no);
            echo json_encode($result);

        }

        public function js_get_order_details_forexistOrder_entry() // For JS
        {

            $order_no = $this->input->get('order_no');
            $result = $this->SocialW->js_get_order_details_forexistOrder_entry($order_no);
            echo json_encode($result);

        }

        public function addNewOrder()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');

            $modified_by = '';
            $modified_dt = '';
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $slNo = $this->SocialW->f_get_orderSlNo_max();
                $sl_no = $slNo->sl_no + 1;                

                $order_dt    =  $_POST['order_dt'];
                $order_no    =  $_POST['order_no'];
                $dist_cd     =  $_POST['dist_cd'];
                $project_no  =  $_POST['project_no'];

                $hsn_no      =  $_POST['hsn_no'];
                $unit        =  $_POST['unit'];
                $allot_qty   =  $_POST['allot_qty'];

                $item_count         =     count($hsn_no);

                $this->SocialW->addNewOrder($sl_no, $order_dt, $order_no, $dist_cd, $project_no, $hsn_no, $allot_qty, $item_count, $created_by, $created_dt, $modified_by, $modified_dt);

                echo "<script> alert('Successfully Updated');
                document.location= 'supplyOrderEntry' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'addSupplyOrder' </script>";

            }

        }

        public function editOrderEntry()
        {

            $order_no   =   $this->input->get('order_no');
            $order_dt   =   $this->input->get('order_dt');
            $project_no   =   $this->input->get('project_no');

            $this->load->view('post_login/main');

            $editData['data1'] = $this->SocialW->f_get_orderEditData($order_no, $order_dt, $project_no);
            $editData['data2'] = $this->SocialW->f_get_orderEdit_allotment($order_no, $order_dt, $project_no);
            $this->load->view('transaction/editOrder', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateNewOrder()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');

            $created_by = '';
            $created_dt = '';
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $slNo = $this->SocialW->f_get_orderSlNo_max();
                $sl_no = $slNo->sl_no + 1;                

                $order_dt    =  $_POST['order_dt'];
                $order_no    =  $_POST['order_no'];
                $dist_cd     =  $_POST['dist_cd'];
                $project_no  =  $_POST['project_no'];

                $hsn_no      =  $_POST['hsn_no'];
                $unit        =  $_POST['unit'];
                $allot_qty   =  $_POST['allot_qty'];

                $item_count         =     count($hsn_no);

                
                $this->SocialW->deleteOrderEntry($order_no, $order_dt, $project_no);
            
                $this->SocialW->addNewOrder($sl_no, $order_dt, $order_no, $dist_cd, $project_no, $hsn_no, $allot_qty, $item_count, $created_by, $created_dt, $modified_by, $modified_dt);

                $this->supplyOrderEntry();

            }

        }

        public function deleteOrderEntry()
        {

            $order_no       =       $this->input->get('order_no');
            $order_dt       =       $this->input->get('order_dt');
            $project_no     =       $this->input->get('project_no');
            
            $this->SocialW->deleteOrderEntry($order_no, $order_dt, $project_no);
            $this->supplyOrderEntry();

        }


    // ******************* For Delivery Section ********************* //

        public function projectDelivery()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->SocialW->f_get_delivery_tableData();
            $this->load->view('transaction/deliveryTable', $tableData);

            $this->load->view('post_login/footer');

        }


        public function addDelivery()
        {

            $this->load->view('post_login/main');

            $addData['dist'] = $this->SocialW->f_get_distData();
            $addData['item'] = $this->SocialW->f_get_rateChart_productData();
            $addData['vendor'] = $this->SocialW->f_get_vendor_deliveryData();

            $this->load->view('transaction/addDelivery', $addData);

            $this->load->view('post_login/footer');

        }

        public function js_get_delivery_orderNo() // For JS
        {

            $dist_cd      =      $this->input->get('dist_cd');
            $project_no   =      $this->input->get('project_no');

            $result = $this->SocialW->js_get_delivery_orderNo($dist_cd, $project_no);
            echo json_encode($result);

        }

        public function js_get_delivery_orderDetailsData() // For JS 
        {

            $order_no = $this->input->get('order_no');

            $result = $this->SocialW->js_get_delivery_orderDetailsData($order_no);
            echo json_encode($result);

        }

        public function js_get_delivery_previousDeliveryDetailsData() // For JS 
        {

            $dist_cd = $this->input->get('dist_cd');
            $project_no = $this->input->get('project_no');
            $order_no = $this->input->get('order_no');

            $result = $this->SocialW->js_get_delivery_previousDeliveryDetailsData($order_no);
            echo json_encode($result);

        }

        public function js_get_price_asSBillNo() // For js
        {

            $sBill_data           =       $this->input->get('sBill_data');
            $order_no             =       $this->input->get('order_no');  
            //$challanData        =       explode(',',$challans);
            //$challan_no         =       count($challanData);
            
            $value = $this->SocialW->js_get_price_asSBillNo($sBill_data, $order_no);

            echo json_encode($value);

        }


        public function js_get_salePrice_asChallanNo() // For JS
        {

            $challan_data           =       $this->input->get('challan_data');

            $value = $this->SocialW->js_get_salePrice_asChallanNo($challan_data);
            echo json_encode($value);

        }

        public function js_get_item_asPer_orderPorject() // For js
        {

            $order_no    =   $this->input->get('order_no');

            $result = $this->SocialW->js_get_item_asPer_orderPorject($order_no);
            echo json_encode($result);

        }


        public function js_get_delivery_allotQty() // FOR JS
        {

            $order_no       =      $this->input->get('order_no');
            $hsn_no         =      $this->input->get('hsn_no');
            $cdpo_no        =      $this->input->get('cdpo_no');

            $result = $this->SocialW->js_get_delivery_allotQty($order_no, $cdpo_no, $hsn_no);
            echo json_encode($result);

        }

        public function js_get_deliveredQty_asPer_orderItem() // For JS
        {

            $order_no       =      $this->input->get('order_no');
            $cdpo_no       =      $this->input->get('cdpo_no');
            $hsn_no         =      $this->input->get('hsn_no');

            $result = $this->SocialW->js_get_deliveredQty_asPer_orderItem($order_no, $cdpo_no, $hsn_no);
            echo json_encode($result);

        }

        public function js_get_marginGST_forProduct_priceCalculation() // For JS 
        {

            $hsn_no = $this->input->get('hsn_no');
            $del_dt = $this->input->get('del_dt');

            $result = $this->SocialW->js_get_marginGST_forProduct_priceCalculation($hsn_no, $del_dt);
            echo json_encode($result);

        }

        public function addNewDelivery()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $created_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $slNo = $this->SocialW->f_get_deliverySlNo_max();
                $sl_no = $slNo->sl_no + 1;
                
                $trans_dt       =       $_POST['trans_dt'];

                $transCd = $this->SocialW->f_get_deliveryTransCd_max($trans_dt);
                $trans_cd = $transCd->trans_cd + 1;
                //echo $trans_cd; die;

                $dist_cd        =       $_POST['dist_cd'];
                $cdpo_no        =       $_POST['project_no'];
                $order_no       =       $_POST['order_no'];
                $hsn_no         =       $_POST['hsn_no'];
                $challan_no     =       $_POST['challan_no'];
                $del_qty        =       $_POST['del_qty'];
                $purchase_dt    =       $_POST['purchase_dt'];
                $vendor_cd      =       $_POST['vendor_cd'];
                $pb_no          =       $_POST['pb_no'];
                $cgst           =       $_POST['cgst'];
                $sgst           =       $_POST['sgst'];
                $tax_val        =       $_POST['tax_val'];
                $tot_amnt       =       $_POST['tot_amnt'];

                $this->SocialW->addNewDelivery( $sl_no, $trans_dt, $trans_cd, $dist_cd, $order_no, $cdpo_no, $challan_no, $hsn_no, $del_qty, $vendor_cd, $purchase_dt, $pb_no, $tax_val, $cgst, $sgst, $tot_amnt, $created_by, $created_dt );

                echo "<script> alert('Successfully Submitted');
                document.location= 'projectDelivery' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Try Again.');
                document.location= 'addDelivery' </script>";

            }

        }

        public function editDeliveryEntry()
        {

            $sl_no      =   $this->input->get('sl_no');
            $trans_dt   =   $this->input->get('trans_dt');
            $trans_cd   =   $this->input->get('trans_cd');
            //echo $sl_no; echo $trans_cd; die;
            
            $editData['data'] = $this->SocialW->f_get_delivery_editData($sl_no, $trans_dt, $trans_cd);
            $editData['allotQty'] = $this->SocialW->f_get_delivery_allotQtyData($sl_no, $trans_dt, $trans_cd);
            $editData['tot_delQty'] = $this->SocialW->f_get_delivery_tot_delQtyData($sl_no, $trans_dt, $trans_cd);
            //var_dump($editData['tot_delQty']); die;

            $undeliveredData['details'] = $this->SocialW->f_get_edit_undeliveredDetails($sl_no, $trans_dt, $trans_cd);
            $getData = $undeliveredData['details'][0];
            $order_no = $getData->order_no;
            $dist_cd = $getData->dist_cd;
            $cdpo_no = $getData->cdpo_no;
            $hsn_no = $getData->hsn_no;
            $undeliveredData['totDelQty'] = $this->SocialW->f_get_edit_alreadyDelivered_qTy($order_no, $dist_cd, $cdpo_no, $hsn_no, $trans_dt, $trans_cd);
            $already_del_qty = $undeliveredData['totDelQty']->del_qty;
            if($already_del_qty)
            {
                $editData['already_del_qty'] = $already_del_qty;
            }
            else
            {
                $editData['already_del_qty'] = 0 ;
            }

            $this->load->view('post_login/main');

            $this->load->view('transaction/editDelivery', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateNewDelivery()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            if($_SERVER['REQUEST_METHOD']=="POST")
            {            

                $trans_dt       =       $_POST['trans_dt'];
                $trans_cd       =       $_POST['trans_cd'];
                $sl_no          =       $_POST['sl_no'];

                $del_qty        =       $_POST['del_qty'];
                $purchase_dt    =       $_POST['purchase_dt'];
                $pb_no          =       $_POST['pb_no'];
                $cgst           =       $_POST['cgst'];
                $sgst           =       $_POST['sgst'];
                $tax_val        =       $_POST['tax_val'];
                $tot_amnt       =       $_POST['tot_amnt'];

                $this->SocialW->updateNewDelivery( $sl_no, $trans_dt, $trans_cd, $del_qty, $purchase_dt, $pb_no, $tax_val, $cgst, $sgst, $tot_amnt, $modified_by, $modified_dt );

                echo "<script> alert('Successfully Updated');
                document.location= 'projectDelivery' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Try Again.');
                document.location= 'projectDelivery' </script>";

            }

        }

        public function deleteDeliveryEntry()
        {

            $sl_no      =   $this->input->get('sl_no');
            $trans_dt   =   $this->input->get('trans_dt');
            $trans_cd   =   $this->input->get('trans_cd');

            $this->SocialW->f_delete_delivery($trans_dt, $trans_cd);
            $this->projectDelivery();

        }



    // ********************* For Sale Section ********************* //

        public function sale()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->SocialW->f_get_sale_tableData();
            $this->load->view('transaction/saleTable', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addSale()
        {

            $this->load->view('post_login/main');

            $addData['dist'] = $this->SocialW->f_get_distData();
            $addData['item'] = $this->SocialW->f_get_rateChart_productData();
            $this->load->view('transaction/addSale', $addData);

            $this->load->view('post_login/footer');

        }

        public function js_get_sale_challanNo() // For JS
        {

            $dist_cd        =      $this->input->get('dist_cd');
            $project_no     =      $this->input->get('project_no');
            $order_no       =      $this->input->get('order_no');

            $result = $this->SocialW->js_get_sale_challanNo($dist_cd, $project_no, $order_no );
            echo json_encode($result);

        }

        public function js_get_item_forSale_orderChallan() // For JS
        {

            $dist_cd = $this->input->get('dist_cd');
            $project_no = $this->input->get('project_no');
            $order_no = $this->input->get('order_no');
            $challan = $this->input->get('challan');

            $result = $this->SocialW->js_get_item_forSale_orderChallan($dist_cd, $project_no, $order_no, $challan );
            echo json_encode($result);

        }

        public function js_get_sale_delQty() // For JS
        {

            $dist_cd        =      $this->input->get('dist_cd');
            $project_no     =      $this->input->get('project_no');
            $order_no       =      $this->input->get('order_no');
            $challan_no     =      $this->input->get('challan_no');
            $hsn_no         =      $this->input->get('hsn_no');

            $result = $this->SocialW->js_get_sale_delQty($dist_cd, $project_no, $order_no, $challan_no, $hsn_no );
            echo json_encode($result);

        }

        public function js_get_sale_deliveryInfoTableData_challan() // For JS 
        {

            $order_no = $this->input->get('order_no');
            
            $result = $this->SocialW->js_get_sale_deliveryInfoTableData_challan($order_no);
            echo json_encode($result);

        }

        public function js_get_sale_calculation_perChallan() // For JS
        {

            $challan_no = $this->input->get('challan_no');
            $order_no = $this->input->get('order_no');
            $result = $this->SocialW->f_get_transDt_hsnNo_perChallanNo($challan_no, $order_no);
            $trans_dt = $result[0]->trans_dt;
            $hsn_no = $result[0]->hsn_no;
            $del_qty = $result[0]->del_qty;
            
            $result1 = $this->SocialW->js_get_marginGST_forProduct_priceCalculation($hsn_no, $trans_dt);
            $sendData['details'] = $result1;
            $sendData['delQty'] = $del_qty;

            echo json_encode($sendData);

        }

        public function js_check_sale_duplicate_billEntry() // For JS
        {

            $challan_no = $this->input->get('challan_no');
            $order_no = $this->input->get('order_no');
            $bill_no = $this->input->get('bill_no');
            $result = $this->SocialW->js_check_sale_duplicate_billEntry($order_no, $challan_no, $bill_no);
            echo json_encode($result);

        }

        public function js_get_sale_challan_nos() // For JS
        {

            $order_no = $this->input->get('order_no');
            // $dist_cd = $this->input->get('dist_cd');
            // $project_no = $this->input->get('project_no');
            $result = $this->SocialW->js_get_sale_challan_nos($order_no);
            echo json_encode($result);

        }

        public function js_get_sale_itemPer_challan()// For JS
        {

            $challan_no = $this->input->get('challan_no');
            $order_no = $this->input->get('order_no');
            
            $result = $this->SocialW->js_get_sale_itemPer_challan($challan_no, $order_no);
            echo json_encode($result);

        }

        public function js_get_sale_delQty_perChallan() // For JS 
        {

            $challan_no = $this->input->get('challan_no');
            $order_no = $this->input->get('order_no');

            $result = $this->SocialW->js_get_sale_delQty_perChallan($challan_no, $order_no);
            echo json_encode($result);

        }

        public function js_get_payment_saleBillDtls() // For JS
        {

            $order_no = $this->input->get('order_no');
            $result = $this->SocialW->js_get_payment_saleBillDtls($order_no);
            echo json_encode($result);

        }

        public function js_get_payment_purchaseBillDtls() // For JS
        {

            $order_no = $this->input->get('order_no');
            $result = $this->SocialW->js_get_payment_purchaseBillDtls($order_no); 
            echo json_encode($result);

        }

        public function js_get_payment_districtProject_forOrder()
        {

            $order_no = $this->input->get('order_no');
            $result = $this->SocialW->js_get_payment_districtProject_forOrder($order_no);
            echo json_encode($result);

        }

        public function addSaleEntry()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                
                $slNo = $this->SocialW->f_get_saleSlNo_max();
                $sl_no = $slNo->sl_no + 1;
                
                $trans_dt       =       $_POST['trans_dt'];

                $transCd = $this->SocialW->f_get_saleTransCd_max($trans_dt);
                $trans_cd = $transCd->trans_cd + 1;

                $dist_cd       =       $_POST['dist_cd'];
                $cdpo_no       =       $_POST['project_no'];
                $order_no      =       $_POST['order_no'];
                $challan_no    =       $_POST['challan_no'];
                $hsn_no        =       $_POST['hsn_no'];
                $del_qty       =       $_POST['del_qty'];
                $sale_dt       =       $_POST['sale_dt'];
                $bill_no       =       $_POST['bill_no'];
                $cgst          =       $_POST['cgst'];
                $sgst          =       $_POST['sgst'];
                $tax_val       =       $_POST['tax_val'];
                $tot_amnt      =       $_POST['tot_amnt'];
               

                $this->SocialW->addSaleEntry( $sl_no, $trans_dt, $trans_cd, $dist_cd, $cdpo_no, $order_no, $challan_no, $hsn_no, $sale_dt, $bill_no, $cgst, $sgst, $tax_val, $tot_amnt, $created_by, $created_dt );

                echo "<script> alert('Successfully Submitted');
                document.location= 'sale' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Try Again.');
                document.location= 'addSale' </script>";

            }

        }

        public function editSaleEntry()
        {

            $sl_no  =   $this->input->get('sl_no');
            $trans_dt  =   $this->input->get('trans_dt');
            $trans_cd  =   $this->input->get('trans_cd');

            $this->load->view('post_login/main');

            $editData['data'] = $this->SocialW->f_get_sale_editData($sl_no, $trans_dt, $trans_cd);
            // $delQty = $this->SocialW->f_get_sale_delQty_editData($sl_no, $trans_dt, $trans_cd);
            // $editData['data1'] = $delQty->del_qty;
            $editData['data1'] = $this->SocialW->f_get_sale_delQty_editData($sl_no, $trans_dt, $trans_cd);
            //echo $editData['data1']; die;
            $this->load->view('transaction/saleEdit', $editData);

            $this->load->view('post_login/footer');
            
        }

        public function deleteSaleEntry()
        {

            $sl_no  =   $this->input->get('sl_no');
            $trans_dt  =   $this->input->get('trans_dt');
            $trans_cd  =   $this->input->get('trans_cd');

            $this->SocialW->f_delete_saleData($sl_no, $trans_dt, $trans_cd);
            $this->sale();

        }

    // **************** For Report Section **************************** //

        public function saleReport()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/saleDateSelection');

            $this->load->view('post_login/footer');

        }

        public function f_get_dw_SaleReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);
                //echo $splittedstring[1];
                //echo $splittedstring[0];
                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                //echo $startDt.' $ '.$endDt; die;
               
                $this->showDWSaleReport($startDt, $endDt);
                
            }

        }


        public function showDWSaleReport($startDt, $endDt)
        {

            $reportData['data']  = $this->SocialW->showDWSaleReport($startDt, $endDt);
            $reportData['startDt'] = $startDt;
            $reportData['endDt'] = $endDt;
            $reportData['total']  = $this->SocialW->show_total_saleReport($startDt, $endDt);

            //var_dump($reportData['data']); die;

            $this->load->view('post_login/main');

            $this->load->view('report/saleDWReport', $reportData);
            
            $this->load->view('post_login/footer');

        }

        public function oilPaymentReport()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/oilPaymentSelection');

            $this->load->view('post_login/footer');

        }

        public function f_get_dateRange_oilPayment()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);
                
                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                $report_data['data'] = $this->SocialW->f_get_dw_oilPayment_repData($startDt, $endDt);
                $report_data['startDt'] = $startDt;
                $report_data['endDt'] = $endDt;

                $this->load->view('post_login/main');
                
                $this->load->view('report/oilPaymentReport', $report_data);

                $this->load->view('post_login/footer');

            
            }

        }

        public function oilSheetSelection()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/oilSheetSelection');

            $this->load->view('post_login/footer');

        }

        public function f_get_oil_paymentSheet()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $payment_key = $_POST['payment_key'];

                $hsn_no = '1514';
                $result['payment_key'] = $payment_key;
                $result['table1_data'] = $this->SocialW->f_get_oil_payment_dtls($payment_key, $hsn_no);
                $result['table1_footer_data'] = $this->SocialW->f_get_oil_payment_shortage_dtls($payment_key);
                $result['table1_footer_totData'] = $this->SocialW->f_get_oil_payment_total($payment_key, $hsn_no);
                
                // For Table-2
                $result['table2_Data'] = $this->SocialW->f_get_oil_paymentDtls_data($payment_key);

                // For Table-3:
                $get_paymentSheet_gstDt = $this->SocialW->get_paymentSheet_gstDt($payment_key);
                $trans_dt = $get_paymentSheet_gstDt->trans_dt;
                $result['table3_gstRate'] = $this->SocialW->f_get_oil_payment_gstRate($trans_dt, $hsn_no);
                $result['table3_Data'] = $this->SocialW->f_get_oil_payment_gstDtls($payment_key, $hsn_no, $trans_dt);


                $this->load->view('post_login/main');

                $this->load->view('report/oilPaymentSheet', $result);

                $this->load->view('post_login/footer');

            } 

        }


        public function purchaseReport()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/purchaseDateSelection');

            $this->load->view('post_login/footer');

        }

        public function f_get_dw_purchaseReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);
                //echo $splittedstring[1];
                //echo $splittedstring[0];
                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                //echo $startDt.' $ '.$endDt; die;
               
                $this->showDWPurchaseReport($startDt, $endDt);
                
            }

        }

        public function showDWPurchaseReport($startDt, $endDt)
        {

            $reportData['data']  = $this->SocialW->showDWPurchaseReport($startDt, $endDt);
            $reportData['startDt'] = $startDt;
            $reportData['endDt'] = $endDt;
            $reportData['total']  = $this->SocialW->show_total_purchaseReport($startDt, $endDt);

            // echo "<pre>";
            // var_dump($reportData['data']); die;

            $this->load->view('post_login/main');

            $this->load->view('report/purchaseDWReport', $reportData);
            
            $this->load->view('post_login/footer');

        }

    ////// *************************** Bill / Collection Section ****************************** /////
        
        public function billCollection()
        {
            
            $this->load->view('post_login/main');

            $tableData['data'] = $this->SocialW->get_bill_tableData();
            $this->load->view('bill/paymentTable', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addPayment()
        {

            $this->load->view('post_login/main');
            $entryData['dist']     = $this->SocialW->f_get_distData();
            $entryData['item']     = $this->SocialW->f_get_rateChart_productData();
            $entryData['projects'] = $this->SocialW->js_get_project();
            $this->load->view('bill/newPayment', $entryData);

            $this->load->view('post_login/footer');

        }

        public function js_get_pb_details()
        {

            $pb_no   =  $this->input->get('pb_no');
            $dist_cd   =  $this->input->get('dist_cd');

            $result = $this->SocialW->get_pb_detail($pb_no);

            echo json_encode($result);

        }
        public function js_get_sb_details()
        {

            $bill_no   =  $this->input->get('bill_no');
            $dist_cd   =  $this->input->get('dist_cd');

            $result = $this->SocialW->get_sb_detail($bill_no);

            echo json_encode($result);

        }

        public function addPaymentEntry()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $trans_dt               =       $_POST['trans_dt'];

                $slNo = $this->SocialW->f_get_paymentTransCd_max($trans_dt);
                $sl_no = $slNo->sl_no + 1;

                $currYear = date("Y");
                $transCd = $this->SocialW->f_get_payment_paymentKey($currYear);
                $paymentKeyVal = $transCd->payment_key;
                if($paymentKeyVal)
                {
                    $maxTransId = substr($paymentKeyVal,4);
                }
                else
                {
                    $maxTransId = 0;
                }

                //echo $maxTransId; die;

                $paymentKey = $currYear.($maxTransId+1);
                //echo $paymentKey; die;

                $dist_cd                =           $_POST['dist_cd'];
                $entry_type             =           $_POST['entry_type'];

                $pb_no                  =           $_POST['pb_no'];
                $pb_dt                  =           $_POST['pb_dt'];
                $pb_amnt                =           $_POST['pb_amnt'];

                $hsn_no                 =           $_POST['hsn_no'];
                $sb_no                  =           $_POST['sb_no'];
                $sb_dt                  =           $_POST['sb_dt'];
                //var_dump($sb_dt); die;
                $sb_amnt                =           $_POST['sb_amnt'];
                $mr_no                  =           $_POST['mr_no'];
                $cdpo                   =           $_POST['cdpo'];
                $cdpo_no                =           $_POST['cdpo'];
                $order_no               =           $_POST['order_no'];
                $remarks                =           $_POST['remarks'];

                $row = count($pb_no);
                //var_dump($cdpo); die;
                          
                $this->SocialW->addPaymentEntry($row, $sl_no, $trans_dt, $paymentKey, $entry_type, $dist_cd, $cdpo, $cdpo_no, $order_no, $pb_no, $pb_dt, $pb_amnt, $hsn_no, $sb_no, $sb_dt, $sb_amnt, $mr_no, $remarks, $created_by, $created_dt);
                                  
                echo "<script> alert('Successfully Submitted');
                document.location= 'billCollection' </script>";

            }   
            else
            {
                echo "<script> alert('Sorry! Try Again.');
                document.location= 'addPayment' </script>";

            }


        }
        
        public function editPaymentEntry()
        {

            $this->load->view('post_login/main');

            $trans_dt = $this->input->get('trans_dt');
            $sl_no = $this->input->get('sl_no');
            $payment_key = $this->input->get('key');
            $editData['dist']    = $this->SocialW->f_get_distData();
            $editData['data']     = $this->SocialW->f_get_editPaymentData($trans_dt, $sl_no, $payment_key);
            $editData['item']     = $this->SocialW->f_get_rateChart_productData();
            $editData['projects'] = $this->SocialW->js_get_project();
            $this->load->view('bill/editPayment', $editData);

            $this->load->view('post_login/footer');

        }

        public function UpdatePaymentEntry()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $modified_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $trans_dt               =       $_POST['trans_dt'];
                $sl_no                  =       $_POST['sl_no'];
                $payment_key            =       $_POST['payment_key'];
                $dist_cd                =       $_POST['dist_cd'];
                $pb_no                  =       $_POST['pb_no'];
                $pb_dt                  =       $_POST['pb_dt'];
                $pb_amnt                =       $_POST['pb_amnt'];
                $hsn_no                 =       $_POST['hsn_no'];
                $cdpo_no                =       $_POST['cdpo'];
                $sb_no                  =       $_POST['sb_no'];
                $sb_dt                  =       $_POST['sb_dt'];
                $sb_amnt                =       $_POST['sb_amnt'];
                $mr_no                  =       $_POST['mr_no'];
                $remarks                =       $_POST['remarks'];

                          
                $this->SocialW->UpdatePaymentEntry( $trans_dt, $sl_no, $payment_key,$dist_cd,$pb_no, $pb_dt, $pb_amnt,$hsn_no,$cdpo_no,$sb_no, $sb_dt, $sb_amnt, $mr_no, $remarks, $modified_by, $modified_dt );
                                  
                echo "<script> alert('Successfully Updated');
                document.location= 'billCollection' </script>";

            }   
            else
            {
                echo "<script> alert('Sorry! Try Again.');
                document.location= 'editPaymentEntry' </script>";

            }

        }

        public function deletePaymentEntry()
        {

            $trans_dt = $this->input->get('trans_dt');
            $sl_no = $this->input->get('sl_no');
            $payment_key = $this->input->get('key');

            $this->SocialW->deletePaymentEntry($trans_dt, $sl_no, $payment_key);
            $this->billCollection();
            //$route['sw/deletePaymentEntry?trans_dt=:any&sl_no=:any&key=:any'] = 'sw/billCollection';

        }


        public function js_get_project_perDistCd() // For JS
        {

            $dist_cd = $this->input->get('dist_cd');
            $result = $this->SocialW->js_get_project_perDistCd($dist_cd);
            echo json_encode($result);

        }

        public function js_get_Payment_purchaseAmount_forbillNo_date()
        {

            $pb_no = $this->input->get('pb_no');
            $pb_dt = $this->input->get('pb_dt');

            $challanDtls['result'] = $this->SocialW->f_get_challan_forPBNO($pb_no, $pb_dt);
            $data = $challanDtls['result'][0];

            $challan_no = $data->challan_no;
            $cdpo_no = $data->cdpo_no;
            $order_no = $data->order_no;
            $dist_cd = $data->dist_cd;

            //var_dump($challan_no); die;

            $result = $this->SocialW->js_get_Payment_purchaseSaleAmount_forBillNoDate($challan_no, $cdpo_no, $order_no);
            echo json_encode($result);
            

        }


    ///////////////////////////////// For Shortage ///////////////////////////////////////////////
        public function billShortage()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->SocialW->f_get_shortageDtls_tableData();
            $this->load->view('bill/shortageTable', $tableData);

            $this->load->view('post_login/footer');            

        }

        public function newShortage()
        {
            $this->load->view('post_login/main');

            $bank['data'] = $this->SocialW->f_get_bankName();
            $this->load->view('bill/addShortage', $bank);

            $this->load->view('post_login/footer');

        }

        public function js_get_mrNo_perPaymentKey() // For JS
        {

            $payment_key = $this->input->get('payment_key');
            $result = $this->SocialW->js_get_mrNo_perPaymentKey($payment_key);
            echo json_encode($result);

        }

        public function js_get_shortage_bankName_for_addRow() // For JS
        {

            $result = $this->SocialW->f_get_bankName();
            echo json_encode($result);

        }

        public function js_get_billAmounts_for_paymentKey()
        {

            $payment_key = $this->input->get('payment_key');
            $result = $this->SocialW->js_get_billAmounts_for_paymentKey($payment_key);
            echo json_encode($result);

        }

        public function addPaymentDetails()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $created_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $trans_dt       =       $_POST['trans_dt'];

                $slNo = $this->SocialW->f_get_maxSlNo_paymentDtls($trans_dt);
                $sl_no = $slNo->sl_no + 1;

                $payment_key        =        $_POST['payment_key'];
                $shortage           =        $_POST['shortage'];
                $oil_shortage       =        $_POST['oil_shortage'];
                $tot_payable        =        $_POST['tot_payable'];
                $tot_rcv            =        $_POST['tot_rcv'];
                $remarks            =        $_POST['remarks'];
                $commission         =        $_POST['commission'];

                $mr_no              =        $_POST['mr_no'];
                $bank               =        $_POST['bank'];
                $amnt_cr            =        $_POST['amnt_cr'];
                $amnt_oil           =        $_POST['amnt_oil'];
                $cr_dt              =        $_POST['cr_dt'];
                $row                =        count($mr_no);

                $this->SocialW->addPaymentDetails($sl_no, $payment_key, $trans_dt, $mr_no, $bank, $amnt_cr, $amnt_oil, $cr_dt, $created_by, $created_dt, $row);

                $this->SocialW->addShortageDtls($trans_dt, $payment_key, $shortage, $oil_shortage, $tot_payable, $tot_rcv, $remarks, $commission, $created_by, $created_dt);

                echo "<script> alert('Successfully Submitted');
                document.location= 'billShortage' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Try again..');
                document.location= 'billShortage' </script>";
            }

        }


        public function editShortageEntry()
        {

            $trans_dt = $this->input->get('trans_dt');
            $payment_key = $this->input->get('key');

            $editData['data1'] = $this->SocialW->f_get_shortageDtls_editData($trans_dt, $payment_key);
            $editData['data2'] = $this->SocialW->f_get_shortageDtls_totAmnt_editData($payment_key);
            $editData['data3'] = $this->SocialW->f_get_paymentDtls_editData($trans_dt, $payment_key);
            $editData['data4'] = $this->SocialW->f_get_bankName();
            
            $this->load->view('post_login/main');

            $this->load->view('bill/editShortage', $editData);

            $this->load->view('post_login/footer');

        }


        public function updateShortageEntry()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $modified_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $trans_dt           =       $_POST['trans_dt'];
                $payment_key        =        $_POST['payment_key'];

                $shortage           =        $_POST['shortage'];
                $oil_shortage       =        $_POST['oil_shortage'];
                $tot_payable        =        $_POST['tot_payable'];
                $tot_rcv            =        $_POST['tot_rcv'];
                $commission         =        $_POST['commission'];
                $remarks            =        $_POST['remarks'];

                $sl_no              =        $_POST['sl_no'];
                $mr_no              =        $_POST['mr_no'];
                $amnt_cr            =        $_POST['amnt_cr'];
                $amnt_oil           =        $_POST['amnt_oil'];
                $cr_dt              =        $_POST['cr_dt'];
                $bank               =        $_POST['bank'];
                $row                =        count($sl_no);

                $this->SocialW->updateShortageEntry($payment_key, $trans_dt, $shortage, $oil_shortage, $tot_payable, $tot_rcv, $commission, $remarks, $modified_by, $modified_dt );
                $this->SocialW->updatePaymentDtlsEntry($sl_no, $payment_key, $trans_dt, $mr_no, $amnt_cr, $amnt_oil, $cr_dt, $bank, $modified_by, $modified_dt, $row );

                echo "<script> alert('Successfully Updated');
                document.location= 'billShortage' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Try again..');
                document.location= 'billShortage' </script>";
            }

        }


        public function deleteShortageEntry()
        {

            $trans_dt       =       $this->input->get('trans_dt');
            $payment_key    =       $this->input->get('key');
            
            $this->SocialW->deleteShortageEntry($trans_dt, $payment_key);
            $this->SocialW->deletePaymentDtlsEntry($trans_dt, $payment_key);

            redirect('sw/billShortage');

        }

    ///////////////////////////////// Report/ Date Wise Delivery Report ///////////////////////////

        public function dwDeliveryReport()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/deliveryDateSelection');

            $this->load->view('post_login/footer');

        }

        public function f_get_dw_deliveryReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);
                
                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                //echo $startDt.' $ '.$endDt; die;
               
                $this->showDWDdeliveryReport($startDt, $endDt);
                
            }

        }

        public function showDWDdeliveryReport($startDt, $endDt)
        {

            $this->load->view('post_login/main');

            $showData['data'] = $this->SocialW->f_get_deliveryRepData($startDt, $endDt);
            $showData['startDt'] = $startDt;
            $showData['endDt'] = $endDt;

            $this->load->view('report/deliveryDWreport', $showData);
            $this->load->view('post_login/footer');

        }


       // For Project Wise Delivery Report //

        public function pwDeliveryReport()
        {

            $this->load->view('post_login/main');

            $entryData['dist'] = $this->SocialW->f_get_distData();
            $this->load->view('report/deliveryProjectSelection', $entryData);

            $this->load->view('post_login/footer');

        }


        public function js_get_projectName() // For JS
        {

            $disCd = $this->input->get('dist_cd');

            $dist_data = $this->SocialW->js_get_projectName($disCd);

            echo json_encode($dist_data);


        }

        public function showPWdeliveryReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $dist_cd    =   $_POST['dist_cd'];
                $cdpo_no    =   $_POST['cdpo_no'];

                $showData['data'] = $this->SocialW->f_get_pwDeliveryData($dist_cd, $cdpo_no);
                $showData['dist'] = $this->SocialW->f_get_pwDeliveryDist($dist_cd);
                $showData['project'] = $this->SocialW->f_get_pwDeliveryProject($dist_cd, $cdpo_no);

                $this->load->view('post_login/main');
                $this->load->view('report/deliveryPwReport', $showData);
                $this->load->view('post_login/footer');

            }

        }


    // For Supplier wise delivery report -- 
    public function swDeliveryReport()
    {

        $this->load->view('post_login/main');

        $entryData['data'] = $this->SocialW->f_get_supplierData();
        $this->load->view('report/deliveryVendorSelection', $entryData);

        $this->load->view('post_login/footer');

    }

    public function showDeliveryPWreport()
    {

        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $datefilter     =       $_POST['datefilter'];
            $vendor_cd      =       $_POST['vendor_cd'];

            $splittedstring = explode("  ",$datefilter);
            
            $startDt = $splittedstring[0];
            $endDt = $splittedstring[1];

            $reportData['data1'] = $this->SocialW->f_get_deliveryReport_dtls($startDt, $endDt, $vendor_cd);
            $reportData['vendor'] = $this->SocialW->f_get_delRep_supplierName($vendor_cd);
            $reportData['start_dt'] = $startDt;
            $reportData['end_dt'] = $endDt;
            
            $this->load->view('post_login/main');
            $this->load->view('report/deliverySWreport', $reportData);
            $this->load->view('post_login/footer');
            
        }


    }


    // For Date Wise Shortage Report //

        public function dwShortageReport()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/shortageDateSelection');

            $this->load->view('post_login/footer');

        }


        public function f_get_dw_shortageReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);
                
                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                $this->load->view('post_login/main');

                $showData['data'] = $this->SocialW->f_get_dwShortageRepData($startDt, $endDt);
                $showData['tot'] = $this->SocialW->f_get_dwTotShortageData($startDt, $endDt);
                $showData['startDt'] = $startDt;
                $showData['endDt'] = $endDt;
                $this->load->view('report/shortageDWreport', $showData);

                $this->load->view('post_login/footer');


            }

        }


    // For Project Wise Shortage Report //
       
        public function pwShortageReport()
        {

            $this->load->view('post_login/main');

            $entryData['dist'] = $this->SocialW->f_get_distData();
            $this->load->view('report/shortageProjectSelection', $entryData);

            $this->load->view('post_login/footer');

        }


        public function showPWshortageReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $dist_cd    =   $_POST['dist_cd'];
                $cdpo_no    =   $_POST['cdpo_no'];

                $showData['data'] = $this->SocialW->f_get_pwShortageData($dist_cd, $cdpo_no);
                $showData['total'] = $this->SocialW->f_get_pwShortageTotData($dist_cd, $cdpo_no);
                $showData['dist'] = $this->SocialW->f_get_pwDeliveryDist($dist_cd); // reuse
                $showData['project'] = $this->SocialW->f_get_pwDeliveryProject($dist_cd, $cdpo_no); // reuse

                $this->load->view('post_login/main');
                $this->load->view('report/shortagePwReport', $showData);
                $this->load->view('post_login/footer');

            }

        }


    // For Date Wise Revenew Report //

        public function dwRevenew()
        {

            $this->load->view('post_login/main');

            $this->load->view('report/revenewDateSelection');

            $this->load->view('post_login/footer');

        }

        
        public function f_get_dw_revenewReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);
                
                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                $this->load->view('post_login/main');

                $showData['data'] = $this->SocialW->f_get_dwRevenewRepData($startDt, $endDt);
                $showData['total'] = $this->SocialW->f_get_dwTotRevenewData($startDt, $endDt);
                $showData['startDt'] = $startDt;
                $showData['endDt'] = $endDt;
                $this->load->view('report/revenewDWreport', $showData);

                $this->load->view('post_login/footer');


            }

        }

    // Project Wise Revenew //

        public function pwRevenew()
        {

            $this->load->view('post_login/main');

            $entryData['dist'] = $this->SocialW->f_get_distData();
            $this->load->view('report/revenewProjectSelection',$entryData);

            $this->load->view('post_login/footer');


        }

        public function showPWrevenewReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $dist_cd    =   $_POST['dist_cd'];
                $cdpo_no    =   $_POST['cdpo_no'];

                $showData['data'] = $this->SocialW->f_get_pwRevenewData($dist_cd, $cdpo_no);
                $showData['total'] = $this->SocialW->f_get_pwRevenewTotData($dist_cd, $cdpo_no);
                $showData['dist'] = $this->SocialW->f_get_pwDeliveryDist($dist_cd); // reuse
                $showData['project'] = $this->SocialW->f_get_pwDeliveryProject($dist_cd, $cdpo_no); // reuse

                $this->load->view('post_login/main');
                $this->load->view('report/revenewPwReport', $showData);
                $this->load->view('post_login/footer');

            }

        }



    }

?>