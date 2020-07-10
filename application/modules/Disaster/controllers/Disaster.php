<?php

    class Disaster extends MX_Controller
    {
        public function __construct()
        {
			parent::__construct();
            $this->load->model('Disaster_m');
            
            if(!isset($this->session->userdata('loggedin')->user_id)){
            
                redirect('User_Login/login');
    
            }
        }
        


    // **********************  For DM/ Add Item Tab  ****************************** //

        public function itemEntry()
        {

            $this->load->view('post_login/main');

            $item_dtls['items'] = $this->Disaster_m->f_get_items();
            $this->load->view('item/table', $item_dtls);

            $this->load->view('post_login/footer'); 

        }

        public function addItem()
        {

            $this->load->view('post_login/main');

            $item_no['data'] = $this->Disaster_m->f_get_itemNo(); // to get max item no
            $item_no['date'] = date('y-m-d : h-i-s');
            //echo $item_no->item_no; die;

            $this->load->view('item/entry',$item_no);

            $this->load->view('post_login/footer'); 

        }


        public function entryNewItem()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            
            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $item_no       =       $_POST['item_no'];
                $item_name     =       $_POST['item_name'];
                $unit          =       $_POST['unit'];
                $created_dt    =       $_POST['created_dt'];

                $this->Disaster_m->entryNewItem($item_no, $item_name, $unit, $created_by, $created_dt );
                
                $this->session->set_flashdata('msg', 'Successfully added!');
                redirect('Disaster/itemEntry');

            }

        }


        public function editItemEntry($item_no )
        {

            $this->load->view('post_login/main');
        
            $edit_dtls['no']    =   $item_no;
            $edit_dtls['data']  =   $this->Disaster_m->f_get_itemEdit_data($item_no);
            $edit_dtls['date'] = date('y-m-d : h-i-s');

            $this->load->view('item/edit',$edit_dtls);

            $this->load->view('post_login/footer'); 

        }

        public function updateItemEntry()
        {
            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $item_no       =       $_POST['item_no'];
                $item_name     =       $_POST['item_name'];
                $unit          =       $_POST['unit'];
                $modified_dt    =      $_POST['modified_dt'];

                $this->Disaster_m->updateItemEntry($item_no, $item_name, $unit, $modified_by, $modified_dt );
                
                $this->session->set_flashdata('msg', 'Successfully Editted!');
                redirect('Disaster/itemEntry');

            }


        }

    
    // ********************* For DM/ "District Contact" Section ****************** //

        public function distContact()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->Disaster_m->f_get_distContact();
            $this->load->view('contact/distTable', $tableData);

            $this->load->view('post_login/footer'); 

        }

        public function addDistContact()
        {

            $this->load->view('post_login/main');

            $entryDtls['dist_data'] = $this->Disaster_m->f_get_districtCode();
            $this->load->view('contact/distEntry', $entryDtls);

            $this->load->view('post_login/footer'); 

        }

        public function NewDistContact()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $created_dt       =  date('y-m-d : h-i-s');
            
            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $dist_cd       =       $_POST['dist_cd'];
                $oc_name     =       $_POST['oc_name'];
                $oc_phn     =       $_POST['oc_phn'];
                $ddmo_name     =       $_POST['ddmo_name'];
                $ddmo_phn     =       $_POST['ddmo_phn'];
                $sddmo_name     =       $_POST['sddmo_name'];
                $sddmo_phn     =       $_POST['sddmo_phn'];

                $count_sddmo    =       count($sddmo_name);

                $this->Disaster_m->NewDistContact($dist_cd, $oc_name, $oc_phn, $ddmo_name, $ddmo_phn, $sddmo_name, $sddmo_phn, $count_sddmo, $created_by, $created_dt );
                
                echo "<script> alert('Successfully Submitted');
                document.location= 'distContact' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Try Again.');
                document.location= 'addDistContact' </script>";
            }

        }

        public function editDistContact($sl_no)
        {

            $editData['data'] = $this->Disaster_m->f_get_editDistContact($sl_no);
            
            $this->load->view('post_login/main');

            $this->load->view('contact/distEdit', $editData);            

            $this->load->view('post_login/footer'); 

        }

        public function updateDistContact()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $modified_dt       =  date('y-m-d : h-i-s');
            
            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $sl_no          =       $_POST['sl_no'];
                $dist_cd        =       $_POST['dist_cd'];
                $oc_name        =       $_POST['oc_name'];
                $oc_phn         =       $_POST['oc_phn'];
                $ddmo_name      =       $_POST['ddmo_name'];
                $ddmo_phn       =       $_POST['ddmo_phn'];
                $sddmo_name     =       $_POST['sddmo_name'];
                $sddmo_phn      =       $_POST['sddmo_phn'];
                
                
                $this->Disaster_m->updateDistContact($sl_no, $dist_cd, $oc_name, $oc_phn, $ddmo_name, $ddmo_phn, $sddmo_name, $sddmo_phn, $modified_by, $modified_dt );
                
                echo "<script> alert('Successfully Updated');
                document.location= 'distContact' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Try Again.');
                document.location= 'editDistContact' </script>";
            }

        }


    // ****************** For DM/ "SDO master" ************************************ //
        public function sdoEntry()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->Disaster_m->f_get_sdoTableDtls();
            $this->load->view('master/sdoTable', $tableData);

            $this->load->view('post_login/footer'); 

        }


        public function addSdo()
        {

            $this->load->view('post_login/main');

            $entryData['dist'] = $this->Disaster_m->f_get_districtCode();
            $this->load->view('master/addSdo', $entryData);

            $this->load->view('post_login/footer');



            if($_SERVER['REQUEST_METHOD'] == "POST")
            {

                $slNo = $this->Disaster_m->f_get_sdo_tableSlNo();
                $sl_no = $slNo->sl_no+1;
                
                $dist_cd        =       $_POST['dist_cd'];
                $sdo_name       =       $_POST['sdo_name'];
                $qty            =       $_POST['qty'];
                $row            =       count($sdo_name);

                if($this->session->userdata('loggedin'))
                {
                    $created_by = $this->session->userdata('loggedin')->user_name;
                }
                $created_dt = date('y-m-d : h-i-s');
                
                $this->Disaster_m->addSdo($sl_no, $dist_cd, $sdo_name,$qty, $created_by, $created_dt, $row);
                // echo $this->db->last_query();
                // die();
                echo "<script> alert('Successfully Saved');
                document.location= 'sdoEntry' </script>";

            }
            

        }


        public function editSDOentry()
        {

            $sl_no = $this->input->get('slNo');
            $dist_cd = $this->input->get('dist');

            $editdata['data'] = $this->Disaster_m->f_get_sdo_editData($sl_no, $dist_cd);
            $editdata['dist'] = $this->Disaster_m->f_get_districtCode();

            $this->load->view('post_login/main');

            $this->load->view('master/editSdo', $editdata);

            $this->load->view('post_login/footer');


        }

        public function updateSdo()
        {

            if($_SERVER['REQUEST_METHOD'] == "POST")
            {

                $sl_no          =       $_POST['sl_no'];
                $dist_cd        =       $_POST['dist_cd'];
                $prev_dist_cd   =       $_POST['prev_dist_cd'];
                $sdo_name       =       $_POST['sdo_name'];
                $qty            =       $_POST['qty'];
                //$row            =       count($sdo_name);

                if($this->session->userdata('loggedin'))
                {
                    $modified_by = $this->session->userdata('loggedin')->user_name;
                }
                $modified_dt = date('y-m-d : h-i-s');


                $this->Disaster_m->editSdo($sl_no, $dist_cd, $prev_dist_cd, $sdo_name,$qty, $modified_by, $modified_dt);

                echo "<script> alert('Successfully updated');
                document.location= 'sdoEntry' </script>";

            }

        }

        public function deleteSDOentry()
        {

            $sl_no = $this->input->get('slNo');
            $dist_cd = $this->input->get('dist');

            $this->Disaster_m->f_delete_sdoEntry($sl_no, $dist_cd);

            redirect('disaster/sdoEntry');

        }


    // ****************** For BDO / Municipality Entry ************************** //
        public function bdoEntry()
        {

            $this->load->view('post_login/main');

            $tableData['data1'] = $this->Disaster_m->f_get_bdoDtls();
           
            $this->load->view('master/bdoTable', $tableData);

            $this->load->view('post_login/footer');

        }


        public function addBdo()
        {

            $this->load->view('post_login/main');

            $entryData['dist'] = $this->Disaster_m->f_get_districtCode();
           
            $this->load->view('master/addBdo', $entryData);

            $this->load->view('post_login/footer');


            if($_SERVER['REQUEST_METHOD'] == "POST")
            {

                $dist_cd        =           $_POST['dist_cd'];
                $sdo_cd         =           $_POST['sdo_cd'];
                $bdo_name       =           $_POST['bdo_name'];
                $qty            =           $_POST['qty'];
                $row            =           count($bdo_name);

                $slNo = $this->Disaster_m->f_get_maxSlNo_forBdoTable();
                $sl_no = $slNo->sl_no+1;

                if($this->session->userdata('loggedin'))
                {
                    $created_by = $this->session->userdata('loggedin')->user_name;
                }
                $created_dt = date('y-m-d : h-i-s');

                $this->Disaster_m->insert_newBdo($sl_no, $dist_cd, $sdo_cd, $bdo_name,$qty, $row, $created_by, $created_dt);  

                echo "<script> alert('Successfully Saved');
                    document.location= 'bdoEntry' </script>";

            }

        }

        public function js_get_sdo_forDist()// For JS
        {

            $dist_cd = $this->input->get('dist_cd');
            $result = $this->Disaster_m->js_get_sdo_forDist($dist_cd);
            echo json_encode($result);

        }


        public function js_get_bdo_forSdo()
        {

            $sdo_cd = $this->input->get('sdo_cd');
            $dist_cd = $this->input->get('dist_cd');
            $result = $this->Disaster_m->js_get_bdo_forSdo($sdo_cd, $dist_cd);
            echo json_encode($result);
        }

        public function editBDOentry()
        {

            $sl_no = $this->input->get('slNo');
            $dist_cd = $this->input->get('dist');
            $sdo_cd = $this->input->get('sdo');

            $editData['data1'] = $this->Disaster_m->f_get_bdo_editDtls($sl_no, $dist_cd, $sdo_cd);
            $editData['dist'] = $this->Disaster_m->f_get_districtCode();

            $this->load->view('post_login/main');

            $this->load->view('master/editBdo', $editData);

            $this->load->view('post_login/footer');

        }

        public function updateBdo()
        {

            if($_SERVER['REQUEST_METHOD'] == "POST")
            {

                $sl_no                  =           $_POST['sl_no'];
                $prev_dist_cd           =           $_POST['prev_dist_cd'];
                $prev_sdo_cd            =           $_POST['prev_sdo_cd'];
                $dist_cd                =           $_POST['dist_cd'];
                $sdo_cd                 =           $_POST['sdo_cd'];
                $bdo_name               =           $_POST['bdo_name'];
                $qty                    =           $_POST['qty'];
                
                if($this->session->userdata('loggedin'))
                {
                    $modified_by = $this->session->userdata('loggedin')->user_name;
                }
                $modified_dt = date('y-m-d : h-i-s');

                $this->Disaster_m->f_update_bdoEntry($sl_no, $prev_dist_cd, $prev_sdo_cd, $dist_cd, $sdo_cd, $bdo_name,$qty, $modified_by, $modified_dt);

                echo "<script> alert('Successfully Updated');
                    document.location= 'bdoEntry' </script>";

            }

        }


        public function deleteBDOentry()
        {

            $sl_no = $this->input->get('slNo');
            $dist_cd = $this->input->get('dist');
            $sdo_cd = $this->input->get('sdo');

            $this->Disaster_m->f_delete_bdoEntry($sl_no, $dist_cd, $sdo_cd);

            redirect('disaster/bdoEntry');

        }

    // ******************  For DM/ "Distribution Points" Tab  *********************//

        public function distPointEntry()
        {

            $this->load->view('post_login/main');

            $distPoint_dtls['distPoints'] = $this->Disaster_m->f_get_distPoints();
            //$distPoint_dtls['pointNo'] = $this->Disaster_m->f_get_pointNo();

            $this->load->view('distribution/table', $distPoint_dtls);

            $this->load->view('post_login/footer');

        }

        public function addDistPoint()
        {

            $this->load->view('post_login/main');
            
            $entryDtls['dist_data'] = $this->Disaster_m->f_get_districtCode();

            $this->load->view('distribution/entry', $entryDtls);

            $this->load->view('post_login/footer');

        }

        public function entryNewPoint()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $created_dt  =       date('y-m-d : h-i-s');

            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $entryDtls = $this->Disaster_m->f_get_pointNo();
                $point_no = $entryDtls->point_no+1;

                $slNo = $this->Disaster_m->f_get_max_distPoint_slNo();
                $sl_no = $slNo->sl_no + 1;

                //$point_no    =       $_POST['point_no'];
                $dist_cd        =       $_POST['dist_cd'];
                $sdo            =       $_POST['sdo'];
                $bdo            =       $_POST['bdo'];
                $agent          =       $_POST['agent'];
                $agent_phn      =       $_POST['agent_phn'];
                $agent_adr      =       $_POST['agent_adr'];
                
                $row = count($agent);

                $this->Disaster_m->entryNewPoint($sl_no, $point_no, $dist_cd, $sdo, $bdo, $agent, $agent_phn, $agent_adr, $row, $created_by, $created_dt );
                
                //$this->session->set_flashdata('msg', 'Successfully added!');
                redirect('Disaster/distPointEntry');

            }

        }

        public function editDistPointEntry()
        {

            $sl_no = $this->input->get('sl_no');
            
            $this->load->view('post_login/main');
        
            //$edit_dtls['point_no']    =   $item_no;
            $edit_dtls['data'] = $this->Disaster_m->f_get_distPointDtls($sl_no);
            $edit_dtls['data1'] = $this->Disaster_m->f_get_distPoint_agentDtls($sl_no);

            $this->load->view('distribution/edit',$edit_dtls);

            $this->load->view('post_login/footer'); 

        }


        public function updateAgentEtntry()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $modified_dt  =       date('y-m-d : h-i-s');
            
            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $sl_no          =       $_POST['sl_no'];
                $point_no       =       $_POST['point_no'];
                $dist_cd        =       $_POST['dist_cd'];
                $sdo            =       $_POST['sdo'];
                $bdo            =       $_POST['bdo'];
                $agent          =       $_POST['agent'];
                $agent_phn      =       $_POST['agent_phn'];
                $agent_adr      =       $_POST['agent_adr'];
                
                $row = count($agent);
                // Firstly deleting previous entry---
                $this->Disaster_m->f_delete_agent($sl_no);
                // Then re entry the details --- 
                $this->Disaster_m->updateAgentEtntry($sl_no, $point_no, $dist_cd, $sdo, $bdo, $agent, $agent_phn, $agent_adr, $modified_by, $modified_dt, $row );
                
                //$this->session->set_flashdata('msg', 'Successfully added!');
                redirect('Disaster/distPointEntry');

            }

        }

    

    // ******************  For "DM/Transaction/Work Order" Tab  *********************//


        public function workOrderEntry()
        {

            $this->load->view('post_login/main');

            $workOrder_dtls['orderData'] = $this->Disaster_m->f_get_workOrder();
            //$workOrder_dtls['itemData'] = $this->Disaster_m->f_get_item();

            $this->load->view('workOrder/table', $workOrder_dtls);

            $this->load->view('post_login/footer');

        }


        public function addWorkOrder()
        {

            $this->load->view('post_login/main');
            
            $entryData['data'] = $this->Disaster_m->f_get_districtCode();
            $entryData['itemData'] = $this->Disaster_m->f_get_item();
            $entryData['max_slNo'] = $this->Disaster_m->f_get_max_slNo(); // to get max sl_no

            $this->load->view('workOrder/entry', $entryData);

            $this->load->view('post_login/footer');

        }

        public function js_get_itemUnit()
        {

            $item_no = $this->input->get('item');

            $data = $this->Disaster_m->f_js_get_itemUnit($item_no);
            echo json_encode($data);

        }

        public function entryNewOrder()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $created_dt     =       date('y-m-d : h-i-s');

            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $sl_no          =       $_POST['sl_no'];
                $order_no       =       trim($_POST['order_no'], " ");
                $order_dt       =       $_POST['order_dt'];
                $dist_cd        =       $_POST['dist_cd'];
                $item           =       $_POST['item'];
                $allot_qty      =       $_POST['allot_qty'];
                //$allot_qty_qnt  =       $_POST['allot_qty_qnt']; 
                
                $row = count($item);

                $this->Disaster_m->entryNewOrder( $sl_no ,$order_no, $order_dt, $dist_cd, $item, $allot_qty, $created_by, $created_dt, $row );
                
                $this->session->set_flashdata('msg', 'Successfully added!');
                redirect('Disaster/workOrderEntry');

            }

        }


        public function editWorkOrderEntry()
        {
            $dist_cd    =   $this->input->get('dist_cd');
            $order_no   =   $this->input->get('order_no');
            //$sl_no      =   $this->input->get('sl_no');

            $order_check_result = $this->Disaster_m->f_get_check_orderAllocation($dist_cd, $order_no);
            $checkVal = $order_check_result->num_row;

            if($checkVal == 0)
            {

                $this->load->view('post_login/main');
        
                $edit_dtls['data1'] = $this->Disaster_m->f_get_workOrderDtls($dist_cd, $order_no);
                $edit_dtls['data2'] = $this->Disaster_m->f_get_workOrder_itemDtls($dist_cd, $order_no);

                $this->load->view('workOrder/edit',$edit_dtls);

                $this->load->view('post_login/footer');

            }
            else
            {
                echo "<script> alert('Sorry! Already distributed.');
                document.location= 'workOrderEntry' </script>";
                
                //redirect('Disaster/workOrderEntry');
            }


        }

        public function updateWorkOrder()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $modified_dt        =       date('y-m-d : h-i-s');

            if($_SERVER['REQUEST_METHOD'] == "POST") 
            {

                $order_no           =       $_POST['order_no'];
                $order_dt           =       $_POST['order_dt'];
                $dist_cd            =       $_POST['dist_cd'];
                $item               =       $_POST['item'];
                $allot_qty          =       $_POST['allot_qty'];
                $allot_qty_qnt      =       $_POST['allot_qty_qnt'];
                
                $row = count($item);

                // Deleting previous entry -- 
                $this->Disaster_m->deleteWorkOrder($dist_cd, $order_no);

                // Inserting freshly --
                $this->Disaster_m->entryNewOrder( $sl_no ,$order_no, $order_dt, $dist_cd, $item, $allot_qty, $modified_by, $modified_dt, $row );                

                //$this->Disaster_m->updateWorkOrder( $sl_no, $order_no, $order_dt, $dist_cd, $item, $allot_qty, $allot_qty_qnt, $modified_by, $modified_dt );
                
                //$this->session->set_flashdata('msg', 'Successfully updated!');
                redirect('Disaster/workOrderEntry');

            }

        }


        public function deleteWorkOrderEntry()
        {

            $dist_cd    =   $this->input->get('dist_cd');
            $order_no   =   $this->input->get('order_no');
            //$sl_no      =   $this->input->get('sl_no');

            $order_check_result = $this->Disaster_m->f_get_check_orderAllocation($dist_cd, $order_no);
            $checkVal = $order_check_result->num_row;

            if($checkVal == 0)
            {

                $this->Disaster_m->deleteWorkOrder($dist_cd, $order_no);

                redirect('Disaster/workOrderEntry');

            }
            else
            {
                echo "<script> alert('Sorry! Already distributed.');
                document.location= 'workOrderEntry' </script>";
                //redirect('Disaster/workOrderEntry');
            }

        }


    // ***************************** For DM/ Transaction / Distribution Tab **************************** //

        public function agentDistribution()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->Disaster_m->f_get_agentDistributionDtls();
            $tableData['orderDt'] = $this->Disaster_m->f_get_agentDistribution_WOdt();

            $this->load->view('transaction/table', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addAgentDistribution()
        {

            $this->load->view('post_login/main');

            $distEntryData['dist_data'] = $this->Disaster_m->f_get_districtCode();
            //$distEntryData['agent_data'] = $this->Disaster_m->f_get_agentDist_agentDtls();
            //$distEntryData['order_data'] = $this->Disaster_m->f_get_agentDistributionDtls();
            $distEntryData['slNo_data'] = $this->Disaster_m->f_get_agentDist_maxSlNo();

            $this->load->view('transaction/entry', $distEntryData);

            $this->load->view('post_login/footer');

        }

        // For JS -- > to get order no as per dist_cd selected 

        public function js_get_orderNo_perDist()
        {

            $dist_cd = $this->input->get('dist_cd');

            $data = $this->Disaster_m->f_get_orderNo_perDist($dist_cd);
            echo json_encode($data);

        }


        // For Jquery dependent agent fields as per dist_cd -->
        public function js_agent()
        {

            $dist_cd = $this->input->get('dist_cd');

            $data = $this->Disaster_m->f_get_agentDist_agentDtls($dist_cd);
            echo json_encode($data);

        }

        // For Jquery to get sdo and bdo memo no as per dist_cd and WO No --> 

        public function js_getMemo_perDist_perWO()
        {

            $order_no = $this->input->get('order_no');
            $dist_cd = $this->input->get('dist_cd');

            $data = $this->Disaster_m->f_getMemo_perDist_perWO($order_no, $dist_cd);
            echo json_encode($data);

        }

        // For Jquery to get sdo and bdo memo no as per dist_cd and WO No --> 

        public function js_get_sdoMemo_perDist_WO_sdo()
        {

            $order_no = $this->input->get('order_no');
            $dist_cd = $this->input->get('dist_cd');
            $sdo_memo = $this->input->get('sdo_memo');

            $data = $this->Disaster_m->js_get_sdoMemo_perDist_WO_sdo($order_no, $dist_cd, $sdo_memo);
            echo json_encode($data);

        }


        public function js_dist_allotQty()
        {

            $order_no = $this->input->get('order_no');
            $dist_cd = $this->input->get('dist_cd');
            $data = $this->Disaster_m->f_get_dist_allotQty($order_no, $dist_cd);
            echo json_encode($data);

        }


        public function js_duplicatePoint()
        {

            $order_no   =   $this->input->get('order_no');
            $dist_cd    =   $this->input->get('dist_cd');
            $point_no   =   $this->input->get('point_no');
            
            $data = $this->Disaster_m->js_duplicatePoint($order_no, $dist_cd, $point_no);
            echo json_encode($data);

            

        }


        public function entryAgentDistribution()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $sl_no          =       $_POST['sl_no'];
                $dist_dt        =       $_POST['dist_dt'];
                $dist_cd        =       $_POST['dist_cd'];
                $order_no       =       $_POST['order_no'];
                $point_no       =       $_POST['point_no'];
                $allot_qty      =       $_POST['allot_qty'];
                $sdo_memo       =       $_POST['sdo_memo'];
                $bdo_memo       =       $_POST['bdo_memo'];
                
                $count_point     =        count($point_no); 
        

                $this->Disaster_m->entryAgentDistribution( $sl_no, $dist_dt, $dist_cd, $order_no, $point_no, $allot_qty, $sdo_memo, $bdo_memo, $count_point, $created_by, $created_dt );
                
                    //$this->session->set_flashdata('msg', 'Successfully added!');
                    //redirect('Disaster/agentDistribution');

                echo "<script> alert('Successfully Submitted');
                    document.location= 'agentDistribution' </script>";
                
            
            }
            else
            {

                echo "<script> alert('Sorry! Try Again.');
                    document.location= 'agentDistribution' </script>";

            }

        }

        public function editAgentDistribution()
        {

            $order_no = $this->input->get('order_no');
            $dist_cd = $this->input->get('dist_cd');
            $sl_no = $this->input->get('sl_no');
            
            $this->load->view('post_login/main');

            $edit_dtls['data1'] = $this->Disaster_m->f_get_agentDist_editData($order_no, $sl_no);
            $edit_dtls['data2'] = $this->Disaster_m->f_get_agentDist_edit_tableDtls($order_no, $dist_cd, $sl_no);
            $edit_dtls['total'] = $this->Disaster_m->f_get_agentDist_edit_totQty($order_no, $dist_cd, $sl_no);

            //$edit_dtls['orderDt'] = $this->Disaster_m->f_get_agentDist_edit_WOdt_data($order_no);

            $edit_dtls['sl_no'] = $sl_no;

            // $dist_code = $this->Disaster_m->f_get_editDistCode($sl_no, $point_no);
            // $dist_cd = $dist_code->dist_cd;

            $edit_dtls['totalQty'] = $this->Disaster_m->f_get_totQty($dist_cd, $order_no);

            $this->load->view('transaction/edit', $edit_dtls);

            $this->load->view('post_login/footer');

        }

        public function updateAgentDistribution()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $modified_dt     =       date('y-m-d : h-i-s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $sl_no          =       $_POST['sl_no'];
                $dist_dt        =       $_POST['dist_dt'];
                $dist_cd        =       $_POST['dist_cd'];
                $order_no       =       $_POST['order_no'];
                $sdo_memo       =       $_POST['sdo_memo'];
                $bdo_memo       =       $_POST['bdo_memo'];
                $point_no       =       $_POST['point_no'];
                $allot_qty      =       $_POST['allot_qty'];

                $row = count($point_no);

                //Deleting previous entry first thn re-entry -- 
                $this->Disaster_m->f_delete_agent_distribution($sl_no, $dist_cd, $order_no);

                $this->Disaster_m->updateAgentDistribution($sl_no, $dist_dt, $dist_cd, $order_no, $sdo_memo, $bdo_memo, $point_no, $allot_qty, $row, $modified_by, $modified_dt );
                
                echo "<script> alert('Successfully Updated');
                    document.location= 'agentDistribution' </script>";
            }
            else
            {
                echo "<script> alert('Sorry! Try Again.');
                    document.location= 'agentDistribution' </script>";

            }


        }


        public function deleteAgentDistribution()
        {

            $order_no = $this->input->get('order_no');
            $dist_cd = $this->input->get('dist_cd');
            $sl_no = $this->input->get('sl_no');

            $Result = $this->Disaster_m->f_get_distribution_memoNo($order_no, $dist_cd, $sl_no);
            $sdo_memo = $Result[0]->sdo_memo;
            $bdo_memo = $Result[0]->bdo_memo;
            
            $checkResult = $this->Disaster_m->f_check_distribution_memoNos($order_no, $dist_cd, $sdo_memo, $bdo_memo);
            //echo $checkResult->num_row; die;
            if($checkResult->num_row == '0')
            {

                $this->Disaster_m->f_delete_agent_distribution($sl_no, $dist_cd, $order_no);
                redirect('Disaster/agentDistribution');

            }
            else
            {
                echo "<script> alert('Sorry! Delivery has been done. Can not delete it. ');
                    document.location= 'agentDistribution' </script>";
            }
            

        }

    // ***************************** For DM/ Transaction / Agent Delivery Tab **************************** //


        public function agentDelivery()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->Disaster_m->f_get_agentDeliveryDtls();
            //$tableData['order_dt'] = $this->Disaster_m->f_get_agentDeliveryDtls_orderDt();

            $this->load->view('delivery/table', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addAgentDelivery()
        {

            $this->load->view('post_login/main');

            $entryData['dist_data'] = $this->Disaster_m->f_get_districtCode();
            $entryData['vendor'] = $this->Disaster_m->f_get_vendor_forDelivery();
            $entryData['sl_no'] = $this->Disaster_m->f_get_deliverySlNo();

            $this->load->view('delivery/entry', $entryData);

            $this->load->view('post_login/footer');


        }

        public function js_get_deliveryTransId() // For JS --> 
        {

            $del_dt = $this->input->get('del_dt');
            $slData = $this->Disaster_m->js_get_deliveryTransId($del_dt);
            echo json_encode($slData);

        }

        public function js_agent_allotQtyBal() // For JS --> 
        {
            $order_no = $this->input->get('order_no');
            $dist_cd = $this->input->get('dist_cd');
            $point_no = $this->input->get('point_no');
            $sdo_memo = $this->input->get('sdo_memo');

            $data1 = $this->Disaster_m->js_agent_allotAmount($order_no, $dist_cd, $point_no, $sdo_memo);
            $alloted_qty = $data1->allot_qty;

            $data2 = $this->Disaster_m->js_agent_delQty($order_no, $dist_cd, $point_no, $sdo_memo);
            $total_del_qty = $data2->tot_qty;

            $result_data = ($alloted_qty - $total_del_qty); // remaining undelivered amount in (M.T)

            echo json_encode($result_data);

        }

        public function js_get_prev_deliveryDtls() // For JS -> info-table 
        {

            $distCd     =   $this->input->get('distCd');
            $pointNo    =   $this->input->get('pointNo');
            $orderNo    =   $this->input->get('orderNo');
            $sdoMemo    =   $this->input->get('sdoMemo');

            $result = $this->Disaster_m->js_get_prev_deliveryDtls($distCd, $pointNo, $orderNo, $sdoMemo);
            echo json_encode($result);

        }

        public function entryAgentDelivery()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $sl_no          =       $_POST['sl_no'];
                $bill_dt        =       $_POST['bill_dt'];

                $transDt = date('Y-m-d');

                $transId = $this->Disaster_m->f_get_maxTransId_deliveryTable($transDt);

                $trans_id = $transId->trans_id+1;
                $trans_dt = $transDt;

                //$trans_id       =       $_POST['trans_id'];
                

                $dist_cd        =       $_POST['dist_cd'];
                $order_no       =       $_POST['order_no'];
                $point_no       =       $_POST['point_no'];
                $sdo_memo       =       $_POST['sdo_memo'];
                $bdo_memo       =       $_POST['bdo_memo'];
                $bill_no        =       $_POST['bill_no'];
                $challan_from   =       $_POST['challan_from'];
                $challan_to     =       $_POST['challan_to'];
                // $truck          =       $_POST['truck'];
                $rate           =       $_POST['rate'];
                $vendor         =       $_POST['vendor'];
                $tot_qty        =       $_POST['tot_qty'];
                $amount         =       $_POST['amount'];
                $remarks        =       $_POST['remarks'];

                //$challan_count = count($challan_no);
                //var_dump($challan_no); die;
                
                //$cnf_status     =       0;

                //echo $sdo_memo; die; 

                $this->Disaster_m->insertAgentDelivery($sl_no, $trans_id, $trans_dt, $bill_dt, $dist_cd, $order_no, $point_no, $sdo_memo, $bdo_memo, $bill_no, $tot_qty, $vendor, $challan_from, $challan_to, $rate, $amount, $remarks, $created_by, $created_dt );
                
                $this->session->set_flashdata('msg', 'Successfully updated!');
                redirect('Disaster/agentDelivery');

            }
            
        }

        public function editdeliveryEntry()
        {
            
            $sl_no          =       $this->input->get('sl_no');
            $trans_dt       =       $this->input->get('trans_dt');
            $trans_id       =       $this->input->get('trans_id');
            

            $this->load->view('post_login/main');

            $memo_no = $this->Disaster_m->get_delivery_memoNo($sl_no);
            $sdo_memo = $memo_no->sdo_memo; 

            $editData['data1'] = $this->Disaster_m->get_deliveryEdit_dtls($sl_no, $trans_id, $trans_dt);

            $getBillDtls = $this->Disaster_m->get_deliveryEdit_agentSdoBdoOrder($sl_no, $trans_id, $trans_dt);
            $purchaseBillDtls = $getBillDtls[0];
            $sdo_memo   =   $purchaseBillDtls->sdo_memo;
            $bdo_memo   =   $purchaseBillDtls->bdo_memo;
            $order_no   =   $purchaseBillDtls->order_no;
            $point_no   =   $purchaseBillDtls->point_no;
            $dist_cd    =   $purchaseBillDtls->dist_cd;
            
            //$editData['data3'] = $this->Disaster_m->get_challanEdit_dtls($bill_dt, $getBillNo->bill_no);
            
            $totDelivered_qty = $this->Disaster_m->get_deliveryEdit_qtyBal($sl_no, $dist_cd, $order_no, $point_no, $sdo_memo);
            $totAllocated_qty = $this->Disaster_m->js_agent_allotAmount($order_no, $dist_cd, $point_no, $sdo_memo);
            //var_dump($totAllocated_qty); die;

            $editData['data2'] = ($totAllocated_qty->allot_qty) - ($totDelivered_qty->totQty);
            
            $editData['order_dt'] = $this->Disaster_m->f_get_agentDist_edit_WOdt_data($order_no);

            $this->load->view('delivery/edit', $editData);

            $this->load->view('post_login/footer');

        }


        public function updateAgentDelivery()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $modified_dt     =       date('y-m-d : h-i-s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                //$sl_no          =       $_POST['sl_no'];
                $trans_id       =       $_POST['trans_id'];
                $trans_dt       =       $_POST['trans_dt'];
                //$del_dt         =       $_POST['del_dt'];
                $dist_cd        =       $_POST['dist_cd'];
                $order_no       =       $_POST['order_no'];
                $point_no       =       $_POST['point_no'];
                $sdo_memo       =       $_POST['sdo_memo'];
                $bdo_memo       =       $_POST['bdo_memo'];
                $challan_from   =       $_POST['challan_from'];
                $challan_to     =       $_POST['challan_to'];
                $bill_no        =       $_POST['bill_no'];
                $bill_dt        =       $_POST['bill_dt'];
                // $truck          =       $_POST['truck'];
                // $qty            =       $_POST['qty'];
                $tot_qty        =       $_POST['tot_qty'];
                $vendor         =       $_POST['vendor'];
                $rate           =       $_POST['rate'];
                $amount         =       $_POST['amount'];
                $remarks        =       $_POST['remarks'];

                //$challan_count = count($challan_no);
                //var_dump($challan_no); die;

                $this->Disaster_m->updateAgentDelivery($trans_id, $trans_dt, $dist_cd, $order_no, $point_no, $sdo_memo, $bdo_memo, $bill_no, $bill_dt, $challan_from, $challan_to, $rate, $tot_qty, $vendor, $amount, $remarks, $modified_by, $modified_dt );
                
                $this->session->set_flashdata('msg', 'Successfully updated!');
                redirect('Disaster/agentDelivery');

            }   

        }


        public function deleteDeliveryEntry()
        {
    
            $sl_no = $this->input->get('sl_no');
            $del_dt = $this->input->get('trans_dt');
            $trans_id = $this->input->get('trans_id');

            $this->Disaster_m->f_delete_deliveryEntry($sl_no, $del_dt, $trans_id);
           // echo $this->db->last_query();
            //die();
           // $this->Disaster_m->f_delete_deliveryDtls($del_dt, $trans_id);
            //$this->agentDelivery();
            redirect('Disaster/agentDelivery');

        }


        /////////////// ***************** DM / transaction -> sale ***************** ////////////////

        public function agentSale()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->Disaster_m->f_get_agentSaleDtls();
            $this->load->view('sale/table', $tableData);

            $this->load->view('post_login/footer');

        }

        public function addSale()
        {

            $this->load->view('post_login/main');

            $entryData['dist_data'] = $this->Disaster_m->f_get_districtCode();
            $this->load->view('sale/entry', $entryData);

            $this->load->view('post_login/footer');

        }


        public function js_check_pBillNo_forSale()
        {

            $p_bill_no = $this->input->get('p_bill_no');
            $p_bill_dt = $this->input->get('p_bill_dt');

            $result = $this->Disaster_m->js_check_pBillNo_forSale($p_bill_no, $p_bill_dt);
            echo json_encode($result);

        }

        public function js_get_details_byPBill()
        {

            $p_bill_no = $this->input->get('p_bill_no');
            $p_bill_dt = $this->input->get('p_bill_dt');

            $result = $this->Disaster_m->js_get_details_byPBill($p_bill_no, $p_bill_dt);
            echo json_encode($result);

        }

        public function js_check_duplicate_PBillNo()
        {

            $pb_no = $this->input->get('pb_no');
            $dist_cd = $this->input->get('dist_cd');
            $order_no = $this->input->get('order_no');

            $result = $this->Disaster_m->js_check_duplicate_PBillNo($pb_no, $dist_cd, $order_no);
            echo json_encode($result);

        }

        public function entryAgentSale()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $created_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $trans_dt = date('Y-m-d');
                $transId = $this->Disaster_m->f_get_max_transId_for_saleTable($trans_dt);
                $trans_id = $transId->trans_id+1;

                $dist_cd        =       $_POST['dist_cd'];
                $order_no       =       $_POST['order_no'];

                //echo $order_no; die;

                $pb_no          =       $_POST['p_bill_no'];
                //$p_bill_dt        =       $_POST['p_bill_dt'];
                $point_no       =       $_POST['point_no'];
                $sdo_memo       =       $_POST['sdo_memo'];
                $bdo_memo       =       $_POST['bdo_memo'];
                $challan_from   =       $_POST['challan_from'];
                $challan_to     =       $_POST['challan_to'];
                $bill_no        =       $_POST['s_bill_no'];
                $bill_dt        =       $_POST['s_bill_dt'];
                $rate           =       $_POST['sale_rate'];
                $amount         =       $_POST['s_amount'];
                $remarks        =       $_POST['remarks'];

                $value = array('trans_dt' => $trans_dt,
                                'trans_id' => $trans_id,
                                'order_no' => $order_no,
                                'sdo_memo' => $sdo_memo,
                                'bdo_memo' => $bdo_memo,
                                'dist_cd' => $dist_cd,
                                'point_no' => $point_no,
                                'challan_from'=> $challan_from,
                                'challan_to' => $challan_to,
                                'bill_no' => $bill_no,
                                'bill_dt' => $bill_dt,
                                'pb_no' => $pb_no,
                                'rate' => $rate,
                                'amount' => $amount,
                                'remarks' => $remarks,
                                'created_by' => $created_by,
                                'created_dt' =>$created_dt );

                $this->Disaster_m->saleBillEntry($value);

                redirect('Disaster/agentSale');                

            }

        }


        public function editSaleEntry()
        {

            $trans_id = $this->input->get('trans_id');
            $trans_dt = $this->input->get('trans_dt');

            $editData['data'] = $this->Disaster_m->f_get_saleEdit($trans_id, $trans_dt);

            // echo "<pre>";
            // var_dump($editData['data']); die;

            $this->load->view('post_login/main');

            $this->load->view('sale/edit', $editData);

            $this->load->view('post_login/footer');

        }


        public function updateAgentSale()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $modified_dt     =       date('y-m-d : h-i-s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $trans_id       =       $_POST['trans_id'];
                $trans_dt       =       $_POST['trans_dt'];
                
                $bill_no        =       $_POST['s_bill_no'];
                $bill_dt        =       $_POST['s_bill_dt'];
                $rate           =       $_POST['sale_rate'];
                $amount         =       $_POST['s_amount'];
                $remarks        =       $_POST['remarks'];

                $value = array('bill_no' => $bill_no,
                                'bill_dt' => $bill_dt,
                                'rate' => $rate,
                                'amount' => $amount,
                                'remarks' => $remarks );

                $this->Disaster_m->updateAgentSale($value, $trans_dt, $trans_id);

                redirect('Disaster/agentSale');

            }

        }


        public function deleteSaleEntry()
        {

            $trans_id = $this->input->get('trans_id');
            $trans_dt = $this->input->get('trans_dt');

            $this->Disaster_m->f_delete_saleEntry($trans_id, $trans_dt);

            redirect('Disaster/agentSale');

        }

        //////////////// ************ DM/ For Confirmation Tab *************** //////////////

        
        public function confirmation()
        {

            $this->load->view('post_login/main');

            $entryData['data'] = $this->Disaster_m->f_get_confirmation_tableData();
            $this->load->view('confirmation/table', $entryData);

            $this->load->view('post_login/footer');

        }


        public function confirmDelivery()
        {

            $trans_id = $this->input->get('trans_id');
            $trans_dt = $this->input->get('trans_dt');

            $this->load->view('post_login/main');

            $entryData['data'] = $this->Disaster_m->f_get_confirmation_entryDtls($trans_id, $trans_dt);
            $this->load->view('confirmation/entry', $entryData);

            $this->load->view('post_login/footer');

        }


        public function confirmationEntry()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $trans_id       =       $_POST['trans_id'];
                $trans_dt       =       $_POST['trans_dt'];
                $cnf_memo       =       $_POST['cnf_memo'];

                $value = array('cnf_status' => 1,
                                'cnf_memo' => $cnf_memo );
                $this->Disaster_m->f_confirmationEntry($value, $trans_id, $trans_dt);

                echo "<script> alert('Successfully Confirmed');
                document.location= 'confirmation' </script>";

            }

        }

        public function js_get_unapproved_data() // FOR JS
        {

            $dist_cd = $this->input->get('dist_cd');
            
            $check_data = $this->Disaster_m->js_get_unapproved_data($dist_cd);

            echo json_encode($check_data);

        }


        public function show_confirmationTable()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $dist_cd        =       $_POST['dist_cd'];
                $order_no       =       $_POST['order_no'];
                $sdo_memo       =       $_POST['sdo_memo'];
                $bill_from      =       $_POST['bill_from'];
                $bill_to        =       $_POST['bill_to'];
                //$allot_qty      =       $_POST['allot_qty'];
                //$del_qty        =       $_POST['del_qty'];
                //$rate           =       $_POST['rate'];
                $cnf_dt         =       $_POST['cnf_dt'];
                $cnf_memo       =       $_POST['cnf_memo'];
                $cnf_qty        =       $_POST['cnf_qty'];

                //$this->approvementTable($dist_cd);

                $this->Disaster_m->confirmation_entry($dist_cd, $order_no, $sdo_memo, $bill_from, $bill_to, $cnf_dt, $cnf_memo, $cnf_qty, $created_by, $created_dt );
                
                echo "<script> alert('Successfully Confirmed The Record');
                    document.location= 'confirmation' </script>";
            
            }
            else
            {
                echo "<script> alert('Sorry! Try Again.');
                document.location= 'confirmation' </script>";

            }

        }

    /*    public function approvementTable($dist_cd)
        {

            $tableData['data'] = $this->Disaster_m->f_get_unconfirmedDtls($dist_cd);
            //$tableData['data'] = $this->Disaster_m->f_get_confirmationDist($dist_cd);
            
            $this->load->view('post_login/main');
            $this->load->view('confirmation/table', $tableData);
            $this->load->view('post_login/footer');

        }
        
        public function approveDelivery($sl_no, $dist_cd)
        {
            //echo $dist_cd; die;
            $this->load->view('post_login/main');
            
            $show_data['data1'] = $this->Disaster_m->f_get_showDeliveryRecord($sl_no);
            $show_data['sl_no'] = $sl_no;
            $show_data['allot_qty'] = $this->Disaster_m->f_get_quantityDetails($sl_no);
            $show_data['order_no, sdo_memo, point_no'] = $this->Disaster_m->f_get_deliveryDetails($sl_no);

            //var_dump($show_data['order_no, sdo_memo, point_no ']); die;
            //echo '<pre>';
            $array = $show_data['order_no, sdo_memo, point_no'][0];
            //echo "<pre>";
            //var_dump($array); die;

            $order_no = $array->order_no;
            $sdo_memo = $array->sdo_memo;
            $point_no = $array->point_no;

            $show_data['tot_qty'] = $this->Disaster_m->f_get_totDeliveryQty($order_no, $sdo_memo, $point_no);

            $this->load->view('confirmation/showRecord', $show_data);
            
            $this->load->view('post_login/footer');


        }

        public function approveDeliveryRecord()
        {

            if($this->session->userdata('loggedin'))
            {
                $cnf_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $cnf_dt     =       date('y-m-d');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $sl_no          =       $_POST['sl_no'];
                $message        =       $_POST['message'];
                $dist_cd        =       $_POST['dist_cd'];

                //echo $dist_cd; die;
            }

            $this->Disaster_m->approveDelivery($sl_no, $message, $cnf_by, $cnf_dt);

            //$this->approvementTable($dist_cd);
            redirect('Disaster/approvementTable/'.$dist_cd.' ');

        } */


        //////////////////////////////////////////////////////////////////////////


        public function js_get_sdoMemo_perOrder() // for js
        {

            $order_no = $this->input->get('order_no');
            $dist_cd = $this->input->get('dist_cd');

            $memo_data = $this->Disaster_m->js_get_sdoMemo_perOrder($dist_cd, $order_no);
            echo json_encode($memo_data);

        }
        
        public function js_get_billNo_perMemo() // for js
        {

            $order_no = $this->input->get('order_no');
            $dist_cd = $this->input->get('dist_cd');
            $sdo_memo = $this->input->get('sdo_memo');

            $bill_data = $this->Disaster_m->js_get_billNo_perMemo($dist_cd, $order_no, $sdo_memo);
            echo json_encode($bill_data);


        }

        public function js_get_agent_asPer_billNo() // for JS
        {

            $order_no = $this->input->get('order_no');
            $dist_cd = $this->input->get('dist_cd');
            $sdo_memo = $this->input->get('sdo_memo');
            $bill_no = $this->input->get('bill_no');

            $agent_data = $this->Disaster_m->js_get_agent_asPer_billNo($dist_cd, $order_no, $sdo_memo, $bill_no);
            echo json_encode($agent_data);

        }

        public function js_agent_allotQty() // For JS
        {

            $order_no = $this->input->get('order_no');
            $dist_cd = $this->input->get('dist_cd');
            $sdo_memo = $this->input->get('sdo_memo');
            $point_no = $this->input->get('point_no');

            $allotQty_data = $this->Disaster_m->js_agent_allotQty($dist_cd, $order_no, $sdo_memo, $point_no);
            echo json_encode($allotQty_data);

        }

        public function js_agent_del_totQty() // for JS
        {

            $bill_from = $this->input->get('bill_from');
            $bill_to = $this->input->get('bill_to');
            $order_no = $this->input->get('order_no');
            $sdo_memo = $this->input->get('sdo_memo');
            $dist_cd = $this->input->get('dist_cd');

            $tot_delQty_data = $this->Disaster_m->js_agent_del_totQty($bill_from, $bill_to, $order_no, $sdo_memo, $dist_cd);
            echo json_encode($tot_delQty_data);

        }

        public function js_agent_del_rate() // FOR JS
        {

            $order_no = $this->input->get('order_no');
            $bill_no = $this->input->get('bill_no');
            $sdo_memo = $this->input->get('sdo_memo');
            $point_no = $this->input->get('point_no');

            $rate_data = $this->Disaster_m->js_agent_del_rate($bill_no, $order_no, $sdo_memo, $point_no);
            echo json_encode($rate_data);

        }
    
        public function js_get_previous_cnfDtls() // For Js
        {

            $order_no = $this->input->get('order_no');
            $bill_no = $this->input->get('bill_no');
            $sdo_memo = $this->input->get('sdo_memo');
            $dist_cd = $this->input->get('dist_cd');

            $cnfDtls = $this->Disaster_m->js_get_previous_cnfDtls($order_no, $bill_no, $sdo_memo, $dist_cd );
            echo json_encode($cnfDtls);

        }       


    // ***************** Accounts Section *************** //
    // ##           For Bill Payment            ## //
    // **************************************************** //

        public function billPayment()
        {

            $this->load->view('post_login/main');

            $entryData['dist_data'] = $this->Disaster_m->f_get_districtCode();
            $this->load->view('accounts/billPay', $entryData);

            $this->load->view('post_login/footer');

        }

        public function js_get_bill_districtCode()
        {

            $result = $this->Disaster_m->js_get_bill_districtCode();
            echo json_encode($result);

        }

        // public function js_get_challanNo_perBill() // for js
        // {

        //     $dist_cd = $this->input->get('dist_cd');
        //     $order_no = $this->input->get('order_no');
        //     $sdo_memo = $this->input->get('sdo_memo');
        //     $bill_no = $this->input->get('bill_no');
            
        //     $challanNo = $this->Disaster_m->js_get_challanNo_perBill($dist_cd, $order_no, $sdo_memo, $bill_no );
        //     echo json_encode($challanNo);

        // }

        // public function js_get_cnfQty_Rate() // for Js
        // {

        //     $dist_cd = $this->input->get('dist_cd');
        //     $order_no = $this->input->get('order_no');
        //     $sdo_memo = $this->input->get('sdo_memo');
        //     $bill_no = $this->input->get('bill_no');
            
        //     $data = $this->Disaster_m->js_get_cnfQty_Rate($dist_cd, $order_no, $sdo_memo, $bill_no );
        //     echo json_encode($data);

        // }

        // public function js_get_previous_paymentDtls()
        // {

        //     $dist_cd = $this->input->get('dist_cd');
        //     $order_no = $this->input->get('order_no');
        //     $sdo_memo = $this->input->get('sdo_memo');
        //     $bill_no = $this->input->get('bill_no');

        //     $data = $this->Disaster_m->js_get_previous_paymentDtls($dist_cd, $order_no, $sdo_memo, $bill_no );
        //     echo json_encode($data);

        // }

        public function js_get_payment_saleBillDtls() // for JS
        {

            $dist_cd = $this->input->get('distCd');
            $order_no = $this->input->get('orderNo');
            $pb_no = $this->input->get('pbNo');
            $pb_dt = $this->input->get('pbDt');

            $result = $this->Disaster_m->js_get_payment_saleBillDtls($dist_cd, $order_no, $pb_no, $pb_dt);

            echo json_encode($result);

        }

        public function paymentEntry()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $memo_no        =       $_POST['memo_no'];

                $slNo = $this->Disaster_m->f_get_max_slNo_forPayment($memo_no);
                $sl_no = $slNo->sl_no+1;
                
                $dist_cd        =       $_POST['dist_cd'];
                $order_no       =       $_POST['order_no'];
                $pb_no          =       $_POST['pb_no'];
                $pb_dt          =       $_POST['pb_dt'];
                $pb_amnt        =       $_POST['pb_amnt'];
                $sb_no          =       $_POST['sb_no'];
                $sb_dt          =       $_POST['sb_dt'];
                $sb_amnt        =       $_POST['sb_amnt'];
                $entry_type     =       $_POST['entry_type'];
                //$remarks       =       $_POST['remarks'];
                $modified_by    =       '';
                $modified_dt    =       '';
                $row = count($pb_no);

                // echo "<pre>";
                // var_dump($dist_cd);
                // var_dump($order_no);
                // var_dump($pb_dt);
                // die;

                $this->Disaster_m->paymentEntry($sl_no, $memo_no, $dist_cd, $order_no, $pb_no, $pb_dt, $pb_amnt, $sb_no, $sb_dt, $sb_amnt, $created_by, $created_dt, $modified_by, $modified_dt, $entry_type,$row );
                
                echo "<script> alert('Successfully Submitted');
                    document.location= 'billPay_record' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'billPayment' </script>";

            }


        }

        public function billPay_record()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->Disaster_m->f_get_billPayment_record();
            $this->load->view('accounts/billPay_table', $tableData);

            $this->load->view('post_login/footer');

        }

        public function editBillPayment()
        {

            $memo_no = $this->input->get('memo_no');

            $editData['memo_no'] = $memo_no;

            $editData['data'] = $this->Disaster_m->f_get_payment_editDtls($memo_no);

            $this->load->view('post_login/main');
            $this->load->view('accounts/editBillPay', $editData);
            $this->load->view('post_login/footer');

        }

        public function updatePayment()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $memo_no        =       $_POST['memo_no'];

                $dist_cd        =       $_POST['dist_cd'];
                $order_no       =       $_POST['order_no'];
                $pb_no          =       $_POST['pb_no'];
                $pb_dt          =       $_POST['pb_dt'];
                $pb_amnt        =       $_POST['pb_amnt'];
                $sb_no          =       $_POST['sb_no'];
                $sb_dt          =       $_POST['sb_dt'];
                $sb_amnt        =       $_POST['sb_amnt'];

                $row = count($dist_cd);
                $created_by     =       '';
                $created_dt     =       '';

                // Firstly deleting previous entry--
                $this->Disaster_m->f_delete_billPay($memo_no);

                //Getting Max sl_no of this memo --
                $slNo = $this->Disaster_m->f_get_max_slNo_forPayment($memo_no);
                $sl_no = $slNo->sl_no+1;

                // re entry... 
                $this->Disaster_m->paymentEntry($sl_no, $memo_no, $dist_cd, $order_no, $pb_no, $pb_dt, $pb_amnt, $sb_no, $sb_dt, $sb_amnt, $created_by, $created_dt, $modified_by, $modified_dt, $row );
                
                echo "<script> alert('Successfully Updated');
                    document.location= 'billPay_record' </script>";


            }
            echo "<script> alert('Sorry! Try again..');
                    document.location= 'billPay_record' </script>";

        }

        public function deleteBillPayment()
        {

            $memo_no = $this->input->get('memo_no');

            $this->Disaster_m->f_delete_billPay($memo_no);
            $this->billPay_record();

        }

        // For payment details entry -- 
        public function paymentDetails()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->Disaster_m->f_get_PaymentDtls();
            $this->load->view('accounts/paymentDtls', $tableData);

            $this->load->view('post_login/footer');

        }


        public function addPaymentDetails()
        {

            $this->load->view('post_login/main');

            $entryData['bank'] = $this->Disaster_m->f_get_bankDtls();
            $entryData['memo'] = $this->Disaster_m->f_get_paymentMemo();
            $entryData['vendor'] = $this->Disaster_m->f_get_vendor_forDelivery();
            $this->load->view('accounts/payment', $entryData);

            $this->load->view('post_login/footer');

        }

        public function js_get_billAmnt_formemoNo()
        {

            $memo_no = $this->input->get('memo_no');
            $result= $this->Disaster_m->js_get_billAmnt_formemoNo($memo_no);
            echo json_encode($result);

        }
        
        public function js_check_duplicateMrNo()
        {

            $mr_no = $this->input->get('mr_no');
            $result = $this->Disaster_m->js_check_duplicateMrNo($mr_no);
            echo json_encode($result);

        }

        public function js_check_duplicateMemoNo()
        {

            $memo_no = $this->input->get('memo_no');
            $result = $this->Disaster_m->js_check_duplicateMemoNo($memo_no);
            echo json_encode($result);

        }

        public function paymentDtlsEntry()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $mr_no              =       $_POST['mr_no'];
                $date               =       $_POST['date'];
                $memo_no            =       $_POST['memo_no'];
                $bank               =       $_POST['bank'];
                $bill_amnt          =       $_POST['bill_amnt'];
                $tot_credited       =       $_POST['tot_credited'];
                $cr_dt              =       $_POST['cr_dt'];
                $commission         =       $_POST['commission'];
                $less               =       $_POST['less'];
                $naration           =       $_POST['naration'];
                $tot_payable        =       $_POST['tot_payable'];
                $vendor             =       $_POST['vendor'];
                $remarks            =       $_POST['remarks'];

                $modified_by        =       '';
                $modified_dt        =       '';

                $value = array('memo_no' => $memo_no,
                                'date' => $date,
                                'mr_no' => $mr_no,
                                'cr_dt' => $cr_dt,
                                'bank' => $bank,
                                'bill_amount' => $bill_amnt,
                                'tot_credited' => $tot_credited,
                                'commission' => $commission,
                                'less' => $less,
                                'naration' => $naration,
                                'tot_payable' => $tot_payable,
                                'vendor' => $vendor, 
                                'remarks' => $remarks,
                                'created_by' => $created_by,
                                'created_dt' => $created_dt,
                                'modified_by' => $modified_by,
                                'modified_dt' => $modified_dt );

                $this->Disaster_m->f_insert_paymentDtls($value);

                echo "<script> alert('Successfully Saved');
                    document.location= 'paymentDetails' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Try Again....');
                    document.location= 'addPaymentDetails' </script>";
            }

        }


        public function editPaymentDtls()
        {

            $memo_no = $this->input->get('memo_no');
            $editData['data'] = $this->Disaster_m->f_get_edit_paymentDtls($memo_no);
            $editData['bank'] = $this->Disaster_m->f_get_bankDtls();
            $editData['vendor'] = $this->Disaster_m->f_get_vendor_forDelivery();
            $editData['pb_amount'] = $this->Disaster_m->f_get_pbAmount_forpaymentEdit($memo_no);

            $this->load->view('post_login/main');
            $this->load->view('accounts/paymentEdit', $editData);
            $this->load->view('post_login/footer');

        }

        public function paymentDtlsUpdate()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $modified_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $mr_no              =       $_POST['mr_no'];
                $date               =       $_POST['date'];
                $memo_no            =       $_POST['memo_no'];
                $bank               =       $_POST['bank'];
                $bill_amnt          =       $_POST['bill_amnt'];
                $tot_credited       =       $_POST['tot_credited'];
                $cr_dt              =       $_POST['cr_dt'];
                $commission         =       $_POST['commission'];
                $less               =       $_POST['less'];
                $naration           =       $_POST['naration'];
                $tot_payable        =       $_POST['tot_payable'];
                $remarks            =       $_POST['remarks'];

                $created_by        =       '';
                $created_dt        =       '';

                $value = array(
                                'date' => $date,
                                'mr_no' => $mr_no,
                                'cr_dt' => $cr_dt,
                                'bank' => $bank,
                                'bill_amount' => $bill_amnt,
                                'tot_credited' => $tot_credited,
                                'commission' => $commission,
                                'less' => $less,
                                'naration' => $naration,
                                'tot_payable' => $tot_payable,
                                'remarks' => $remarks,
                                'created_by' => $created_by,
                                'created_dt' => $created_dt,
                                'modified_by' => $modified_by,
                                'modified_dt' => $modified_dt );

                $this->Disaster_m->f_update_paymentDtls($value, $memo_no);

                echo "<script> alert('Successfully Updated');
                    document.location= 'paymentDetails' </script>";

            }
            else
            {
                echo "<script> alert('Sorry! Try Again....');
                    document.location= 'paymentDetails' </script>";
            }

        }


        public function deletePaymentDtls()
        {

            $memo_no = $this->input->get('memo_no');
            $this->Disaster_m->f_delete_paymentDtlsEntry($memo_no);

            redirect('Disaster/paymentDetails');

        }

        public function vendor_payment()
        {

            $this->load->view('post_login/main');

            $tableData['data'] = $this->Disaster_m->f_get_vendorPayment_record();
            $this->load->view('accounts/vendorPay_table', $tableData);

            $this->load->view('post_login/footer');

        }

        public function add_vendorPayment()
        {

            $this->load->view('post_login/main');

            $entryData['dist_data'] = $this->Disaster_m->f_get_districtCode();
            $this->load->view('accounts/vendorPay', $entryData);

            $this->load->view('post_login/footer');

        }

        public function js_get_billNo_for_vendorPay()
        {

            $order_no = $this->input->get('order_no');
            $dist_cd = $this->input->get('dist_cd');

            $data = $this->Disaster_m->js_get_billNo_for_vendorPay($dist_cd, $order_no);
            echo json_encode($data);

        }

        public function js_get_Qty_for_vendorPay()
        {

            $order_no = $this->input->get('order_no');
            $dist_cd = $this->input->get('dist_cd');
            $bill_no = $this->input->get('bill_no');

            $data = $this->Disaster_m->js_get_Qty_for_vendorPay($dist_cd, $order_no, $bill_no);
            echo json_encode($data);

        }

        public function vendorPayment_entry()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $trans_dt        =       $_POST['trans_dt'];
                //echo $trans_dt; die;
                $transCd = $this->Disaster_m->f_get_vendorPay_transId($trans_dt);
                //var_dump($transCd); die;
                $trans_id       =       ($transCd->trans_id + 1);
                //echo $trans_id; die;
                
                $dist_cd = $_POST['dist_cd'];
                $order_no = $_POST['order_no'];
                $bill_no = $_POST['bill_no'];
                $rate = $_POST['rate'];
                $price = $_POST['price'];
                $cgst = $_POST['cgst'];
                $sgst = $_POST['sgst'];
                $commission = $_POST['commission'];
                $amount = $_POST['amount'];

                $bank = $_POST['bank'];
                $mode = $_POST['mode'];
                $ref_no = $_POST['ref_no'];
                $payment_dt = $_POST['payment_dt'];
                $vendor = $_POST['vendor'];
                $remarks = $_POST['remarks'];

                $this->Disaster_m->vendorPayment_entry($trans_dt, $trans_id, $dist_cd, $order_no, $bill_no, $rate, $price, $cgst, $sgst, $amount, $commission, $mode, $bank, $ref_no, $payment_dt, $vendor, $remarks, $created_by, $created_dt );
                
                echo "<script> alert('Successfully Submitted');
                    document.location= 'vendor_payment' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Select Again.');
                document.location= 'vendor_payment' </script>";

            }

        }

        public function delete_vendorPay( $trans_dt, $trans_id, $bill_no )
        {
            // echo $trans_dt; echo '/n';
            // echo $trans_id; echo '/n';
            // echo $bill_no; echo '/n';
            // die;
            
            $this->Disaster_m->f_delete_vendorPay($trans_dt, $trans_id, $bill_no);
            
            // $this->load->view('post_login/main');

            // $tableData['data'] = $this->Disaster_m->f_get_vendorPayment_record();
            // $this->load->view('accounts/vendorPay_table', $tableData);

            // $this->load->view('post_login/footer');

            redirect('/Disaster/vendor_payment');
            
        }





    }

?>