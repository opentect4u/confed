<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paddys extends MX_Controller {

    protected $sysdate;
    protected $kms_year;

    public function __construct(){

        $this->sysdate  = $_SESSION['sys_date'];

        parent::__construct();

        //For Individual Functions
        $this->load->model('Paddy');

        //For User's Authentication
        if(!isset($this->session->userdata('loggedin')->user_id)){
            
            redirect('User_Login/login');

        }

        // $data       = $this->Paddy->f_get_particulars_in('md_parameters', array(16, 17), array(""));

        // $this->kms_year   = substr($data[0]->param_value, 0,4).'-'.substr($data[1]->param_value, 2,2);
        $this->session->userdata('kms_yr');
        // require_once (BASEPATH."/third_party/Classes/PHPExcel/PHPExcel.php");
        // require_once (BASEPATH."/third_party/Classes/PHPExcel/IOFactory.php");

        // $this->load->library('phpExcel'); // For excel 
    }

    /*********************For KMS Year Screen********************/
    #KMS Year for Paddy is like Financial Year in bank
    #Kms year starts from 1st October to next year September

    //Selecting the kms year
    public function f_kmsyear() {
        
        $kmsyear['kms']   =   $this->kms_year;

        $this->load->view('post_login/main');

        $this->load->view("kmsyear/dashboard", $kmsyear);

        $this->load->view('post_login/footer');
        
    }

    //KMS edit will change the master table md_parameters
    #KMS Year Start date is row no 16
    #KMS Year End date is row no 17

    public function f_kmsyear_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            //For Kms Year start date
            $data_array = array(

                "param_value" =>  $this->input->post('from')

            );

            $where  =   array(

                "sl_no"     =>  16

            );

            $this->Paddy->f_edit('md_parameters', $data_array, $where);

            unset($data_array);
            unset($where);
            
            //For Kms Year end date
            $data_array = array(

                "param_value" =>  $this->input->post('to')

            );

            $where  =   array(

                "sl_no"     =>  17

            );

            $this->Paddy->f_edit('md_parameters', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/kmsyear');

        }
        else {

            $kmsyear['from']   =   $this->Paddy->f_get_particulars("md_parameters", array("param_value"), array("sl_no" => 16), 1)->param_value;
            $kmsyear['to']     =   $this->Paddy->f_get_particulars("md_parameters", array("param_value"), array("sl_no" => 17), 1)->param_value;

            $this->load->view('post_login/main');

            $this->load->view("kmsyear/edit", $kmsyear);

            $this->load->view('post_login/footer');

        }
        
    }

    /*********************For District Screen********************/

    //Fetching the Districts List
    public function f_district() {
        
        //District List
        $district['dist']   =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        $this->load->view('post_login/main');

        $this->load->view("district/dashboard", $district);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //Add new District in the md_district table
    public function f_district_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "district_name"    =>  $this->input->post('dist')

            );

            $this->Paddy->f_insert('md_district', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/district');


        }
        else {

            //District List
            $district['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("district/add", $district);

            $this->load->view('post_login/footer');

        }
        
    }

    //Edit District's name in the md_district table
    public function f_district_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "district_name" =>  $this->input->post('dist')

            );

            $where  =   array(

                "district_code"     =>  $this->input->post('sl_no')

            );

            $this->Paddy->f_edit('md_district', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/district');


        }
        else {

            //District List
            $district['district_dtls']   =   $this->Paddy->f_get_particulars("md_district", NULL, array("district_code" => $this->input->get('slno')), 1);

            $this->load->view('post_login/main');

            $this->load->view("district/edit", $district);

            $this->load->view('post_login/footer');

        }
        
    }


    /*********************For Block Screen********************/
    //Feching Data from table md_block
    public function f_block() {
        
        //District List
        $block['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //Retriving Block Details
        $block['block_dtls']    =   $this->Paddy->f_get_particulars("md_block", NULL, NULL, 0);

        //Counting Blocks District wise
        $select     =   array(

            "dist", "COUNT(*) count"

        );

        $where      =   array(

            "1 GROUP BY dist"     => NULL

        );

        $block['dist_dtls']     =   $this->Paddy->f_get_particulars("md_block", $select, $where, 0);        

        $this->load->view('post_login/main');

        $this->load->view("block/dashboard", $block);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New Block Entry
    public function f_block_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "dist"          =>  $this->input->post('dist'),

                "block_name"    =>  $this->input->post('name'),

                "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_insert('md_block', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/block');


        }
        else {

            //District List
            $block['dist']       =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("block/add", $block);
            
            $this->load->view('post_login/footer');

        }
        
    }

    //Block Name edit
    public function f_block_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "dist"          =>  $this->input->post('dist'),

                "block_name"    =>  $this->input->post('name'),

                "modified_by"   =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "sl_no"     =>  $this->input->post('sl_no')

            );

            $this->Paddy->f_edit('md_block', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/block');


        }
        else {

            //District List
            $block['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //Block Details
            $block['block_dtls']    =   $this->Paddy->f_get_particulars("md_block", NULL, array( "sl_no" => $this->input->get('sl_no')), 1);
            
            $this->load->view('post_login/main');

            $this->load->view("block/edit", $block);

            $this->load->view('post_login/footer');

        }
        
    }

    //Block delete
    public function f_block_delete() {

        $where = array(
            
            "sl_no"    =>  $this->input->get('sl_no')
            
        );

        //Retriving the data row for backup
        $select = array (

            "sl_no", "dist", "block_name"
        );

        $data   =   (array) $this->Paddy->f_get_particulars("md_block", $select, $where, 1);


        $audit  =   array(
            
            'deleted_by'    => $this->session->userdata('loggedin')->user_name,
            
            'deleted_dt'    => date('Y-m-d h:i:s')

        );

        //Inserting Data
        $this->Paddy->f_insert('md_block_deleted', array_merge($data, $audit));
        
        $this->Paddy->f_delete('md_block', $where);
        
        //For notification storing message
        $this->session->set_flashdata('msg', 'Successfully deleted!');

        redirect("paddy/block");

    }


    //Block List for a particular district selected by user
    public function f_blocks() {

        $data   =   $this->Paddy->f_get_particulars("md_block", array("sl_no", "block_name"), array("dist" => $this->input->get('dist')), 0);

        echo json_encode($data);

    }

    /*********************For Society Screen******************/
    #Society List from table md_society
    public function f_society() {

        //Retriving Society Details
        $select     =   array(  "sl_no",
                                "soc_name",
                                "reg_no",
                                "ph_no",
                                "dist" 
                            );

        $society['society_dtls']  =   $this->Paddy->f_get_particulars("md_society", $select, NULL, 0);

        //District List
        $society['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        $this->load->view('post_login/main');

        $this->load->view("society/dashboard", $society);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New Society add in the table md_society
    public function f_society_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $data_array = array (

                "soc_name"      =>  $this->input->post('name'),

                "reg_no"        =>  $this->input->post('reg_no'),

                "reg_date"      =>  $this->input->post('reg_date'),

                "soc_addr"      =>  $this->input->post('addr'),

                "block"         =>  $this->input->post('block'),

                "dist"          =>  $this->input->post('dist'),

                "ph_no"         =>  $this->input->post('ph_no'),

                "email"         =>  $this->input->post('email'),

                "bank_name"     =>  $this->input->post('bnk_name'),

                "branch_name"   =>  $this->input->post('brnch_name'),

                "acc_type"      =>  $this->input->post('acc_type'),

                "acc_no"        =>  $this->input->post('acc_no'),

                "ifsc_code"     =>  $this->input->post('ifsc'),

                "pan_no"        =>  $this->input->post('pan'),

                "gst_no"        =>  $this->input->post('gst_no'),

                "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"    =>  date('Y-m-d')

            );

            $this->Paddy->f_insert('md_society', $data_array);

            $maxId = $this->Paddy->f_get_particulars("md_society", array('sl_no'), array('soc_name' => $this->input->post('name')), 1);
            
            unset($data_array);
            
            //Mills, which are included for this Society, adding in the table md_soc_mill
            for($i = 0; $i < count($this->input->post('sl_no')); $i++){
                
                if(json_decode($this->input->post('sl_no')[$i])->value == 1){
                    
                    $data_array[] = array(
                        
                        "soc_id"       => $maxId->sl_no,

                        "mill_id"      => json_decode($this->input->post('sl_no')[$i])->sl_no,

                        "dist"         => $this->input->post('dist'),

                        "block"        => $this->input->post('block')
                    );
                    
                }
                
            }

            if(isset($data_array))
                $this->Paddy->f_insert_multiple("md_soc_mill", $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/society');

        }

        else {

            //District List
            $society['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //Block List
            $society['block']   =   $this->Paddy->f_get_particulars("md_block", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("society/add", $society); 

            $this->load->view('post_login/footer');

        }

    }

    //Society details edit in the table md_society
    public function f_society_edit(){

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $data_array = array (

                "soc_name"      =>  $this->input->post('name'),

                "reg_no"        =>  $this->input->post('reg_no'),

                "reg_date"      =>  $this->input->post('reg_date'),

                "soc_addr"      =>  $this->input->post('addr'),

                "block"         =>  $this->input->post('block'),

                "dist"          =>  $this->input->post('dist'),

                "ph_no"         =>  $this->input->post('ph_no'),

                "email"         =>  $this->input->post('email'),

                "bank_name"     =>  $this->input->post('bnk_name'),

                "branch_name"   =>  $this->input->post('brnch_name'),

                "acc_type"      =>  $this->input->post('acc_type'),

                "acc_no"        =>  $this->input->post('acc_no'),

                "ifsc_code"     =>  $this->input->post('ifsc'),

                "pan_no"        =>  $this->input->post('pan'),

                "gst_no"        =>  $this->input->post('gst_no'),

                "modified_by"    =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"    =>  date('Y-m-d')

            );

            $where = array(

                "sl_no"        =>  $this->input->post('soc_id')

            );

            $this->Paddy->f_edit('md_society', $data_array, $where);

            //Deleting previous mills which are included for this society
            $this->Paddy->f_delete('md_soc_mill', array("soc_id" => $this->input->post('soc_id')));
            unset($data_array);
            
            //Mills, which are included for this Society, readding in the table md_soc_mill
            for($i = 0; $i < count($this->input->post('sl_no')); $i++){
                
                if(json_decode($this->input->post('sl_no')[$i])->value == 1){
                    
                    $data_array[] = array(
                        
                        "soc_id"       => $this->input->post('soc_id'),

                        "mill_id"      => json_decode($this->input->post('sl_no')[$i])->sl_no,

                        "dist"         => $this->input->post('dist'),

                        "block"        => $this->input->post('block')
                    );
                    
                }
                
            }
            
            if(isset($data_array))
                $this->Paddy->f_insert_multiple("md_soc_mill", $data_array);
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully updated!');

            redirect('paddy/society');

        }

        else {

            $where = array(

                "sl_no"    =>  $this->input->get('sl_no')

            );

            //District List
            $society['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
            
            //Block List
            $society['block']   =   $this->Paddy->f_get_particulars("md_block", NULL, NULL, 0);

            //Society list of latest month
            $society['society_dtls']    =   $this->Paddy->f_get_particulars("md_society", NULL, $where, 1);

            $society['mills']   = $this->Paddy->getMillDtls($this->input->get('sl_no'), $society['society_dtls']->dist);

            $this->load->view('post_login/main');

            $this->load->view("society/edit", $society);

            $this->load->view('post_login/footer');

        }

    }

    //District Wise Blocks And Mills for a particular district selected by user
    public function f_blocksandmills(){

        $data['blocks']   =   $this->Paddy->f_get_particulars("md_block", array("sl_no", "block_name"), array("dist" => $this->input->get('dist')), 0);
        $data['mills']   =   $this->Paddy->f_get_particulars("md_mill", array("sl_no", "mill_name"), array("dist" => $this->input->get('dist')), 0);

        echo json_encode($data);
    }

    //Society Delete
    public function f_society_delete(){

        $where = array(
            
            "sl_no"    =>  $this->input->get('sl_no')
            
        );

        $row = $this->db->get_where('td_work_order', array('soc_id' => $this->input->get('sl_no')))->num_rows();

        if($row > 0){

            $this->session->set_flashdata('msg', 'Data cannot be delete!Already some quantity of Paddy Workorder in this Society.');
            
 
        }else{

            $this->Paddy->f_delete('md_society', $where);
            $this->session->set_flashdata('msg', 'Successfully deleted!');
             
        }
        redirect("paddy/society");
        
    }

    //Societies for a particular block selected by user
    public function f_societies() {

        $data   =   $this->Paddy->f_get_particulars("md_society", array("sl_no", "soc_name"), array( "block" => $this->input->get('block')), 0);

        echo json_encode($data);

    }


    /*********************For Mill Screen******************/
    #Mill List from table md_mill
    public function f_mill() {

        //Retriving mill Details
        $select     =   array(  "sl_no",
                                "mill_name",
                                "reg_no",
                                "ph_no",
                                "dist" );

        $mill['mill_dtls']    =   $this->Paddy->f_get_particulars("md_mill", $select, NULL, 0);

        //District List
        $mill['dist']         =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        $this->load->view('post_login/main');

        $this->load->view("mill/dashboard", $mill);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New Mill add in the table md_mill
    public function f_mill_add() {


        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $data_array = array (

                "mill_name"     =>  $this->input->post('name'),

                "reg_no"        =>  $this->input->post('reg_no'),

                "reg_date"      =>  $this->input->post('reg_date'),

                "mill_addr"     =>  $this->input->post('addr'),

                "block"         =>  $this->input->post('block'),

                "dist"          =>  $this->input->post('dist'),

                "ph_no"         =>  $this->input->post('ph_no'),

                "email"         =>  $this->input->post('email'),

                "bank_name"     =>  $this->input->post('bnk_name'),

                "branch_name"   =>  $this->input->post('brnch_name'),

                "acc_type"      =>  $this->input->post('acc_type'),

                "acc_no"        =>  $this->input->post('acc_no'),

                "ifsc_code"     =>  $this->input->post('ifsc'),

                "pan_no"        =>  $this->input->post('pan'),

                "gst_no"        =>  $this->input->post('gst_no'),

                "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"    =>  date('Y-m-d')

            );

            
            $this->Paddy->f_insert('md_mill', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/mill');

        }

        else {

            //District List
            $mill['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
            
            //Block List
            $mill['block']   =   $this->Paddy->f_get_particulars("md_block", NULL, NULL, 0);


            $this->load->view('post_login/main');

            $this->load->view("mill/add", $mill); 

            $this->load->view('post_login/footer');

        }

    }

    //Mill details edit in the table md_mill
    public function f_mill_edit(){

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $data_array = array (

                "mill_name"     =>  $this->input->post('name'),

                "reg_no"        =>  $this->input->post('reg_no'),

                "reg_date"      =>  $this->input->post('reg_date'),

                "mill_addr"     =>  $this->input->post('addr'),
                
                "block"         =>  $this->input->post('block'),

                "dist"          =>  $this->input->post('dist'),

                "ph_no"         =>  $this->input->post('ph_no'),

                "email"         =>  $this->input->post('email'),

                "bank_name"     =>  $this->input->post('bnk_name'),

                "branch_name"   =>  $this->input->post('brnch_name'),

                "acc_type"      =>  $this->input->post('acc_type'),

                "acc_no"        =>  $this->input->post('acc_no'),

                "ifsc_code"     =>  $this->input->post('ifsc'),

                "pan_no"        =>  $this->input->post('pan'),

                "gst_no"        =>  $this->input->post('gst_no'),

                "modified_by"   =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"   =>  date('Y-m-d')

            );

            $where = array(

                "sl_no"        =>  $this->input->post('sl_no')

            );
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully updated!');

            $this->Paddy->f_edit('md_mill', $data_array, $where);

            redirect('paddy/mill');

        }

        else {

            $where = array(

                "sl_no"    =>  $this->input->get('sl_no')

            );

            //District List
            $mill['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
            
            //Block List
            $mill['block']   =   $this->Paddy->f_get_particulars("md_block", NULL, NULL, 0);

            //Mill list of latest month
            $mill['mill_dtls']    =   $this->Paddy->f_get_particulars("md_mill", NULL, $where, 1);

            $this->load->view('post_login/main');

            $this->load->view("mill/edit", $mill);

            $this->load->view('post_login/footer');

        }

    }

    //Mill Delete
    public function f_mill_delete(){

        $where = array(
            
            "sl_no"    =>  $this->input->get('sl_no')
            
        );

        $row = $this->db->get_where('td_received', array('mill_id' => $this->input->get('sl_no')))->num_rows();

        if($row > 0){

            $this->session->set_flashdata('msg', 'Data cannot be delete!Already some quantity of Paddy received in this Rice Mill.');
            
 
        }else{

            $this->Paddy->f_delete('md_mill', $where);
            $this->session->set_flashdata('msg', 'Successfully deleted!');
             
        }
        
        redirect("paddy/mill");
       
       // For notification storing message
        
    }

    //District wise Mill List
    public function f_mills() {

        $data   =   $this->Paddy->f_get_particulars("md_mill", array("sl_no", "mill_name"), array( "dist" => $this->input->get('dist')), 0);

        echo json_encode($data);

    }


    /*********************For Workorder Screen********************/
    #Work Order List from the table td_work_order
    public function f_workorder() {
        $kms_year=$this->session->userdata('kms_yr');
        //District List
        $workorder['dist']   =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //Retriving Workorder Details
        $select     =   array(

            "t.trans_dt", "t.order_no", "t.dist",
            "m.soc_name", "t.paddy_qty"

        );

        $where      =   array(

            "t.soc_id = m.sl_no"    => NULL
             ,"t.kms_year"=>$kms_year

        );

        $workorder['workorder_dtls']    =   $this->Paddy->f_get_particulars("td_work_order t, md_society m", $select, $where, 0);
        // echo $this->db->last_query();
        // die();
        //Counting Workorders District wise
        unset($select);
        unset($where);

        $select     =   array(

            "dist", "COUNT(*) count"

        );

        $where      =   array( "kms_year"=>$kms_year,

            "1 GROUP BY dist"     => NULL
           
        );

        $workorder['dist_dtls']     =   $this->Paddy->f_get_particulars("td_work_order", $select, $where, 0);        

        $this->load->view('post_login/main');

        $this->load->view("workorder/dashboard", $workorder);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New Workorder Add in the table td_work_order
    public function f_workorder_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
         
            //Previous Work Order
            // $prevOrder = $this->Paddy->f_get_particulars('td_work_order', array('ifnull(SUM(paddy_qty), 0) paddy_qty'), array("soc_id" =>  $this->input->post('soc_name'), "kms_year" => $this->kms_year), 1);
            $prevOrder = $this->Paddy->f_get_particulars('td_work_order', array('ifnull(SUM(paddy_qty), 0) paddy_qty'), array("soc_id" =>  $this->input->post('soc_name'), "kms_year" => $this->session->userdata('kms_yr')), 1);
        
            //Validation For New Workorder
            #In a particlular KMS Year if a society get a workorder
            #It can't get another workorder until it deliver minimmum 90% of CMR
            if($prevOrder->paddy_qty != 0){
               
                $resultant = ($prevOrder->paddy_qty * 66) / 100;

                // $delivered = $this->Paddy->f_get_particulars('td_cmr_delivery', array('SUM(tot_delivery) tot_delivery'), array("soc_id" =>  $this->input->post('soc_name'), "kms_year" => $this->kms_year), 1);
                $delivered = $this->Paddy->f_get_particulars('td_cmr_delivery', array('SUM(tot_delivery) tot_delivery'), array("soc_id" =>  $this->input->post('soc_name'), "kms_year" => $this->session->userdata('kms_yr')), 1);
                $deliveryPercentage= ($resultant * $delivered->tot_delivery) / 100;
                
                if($deliveryPercentage >= 90){

                    $status = true;
                }
                else{

                    $status = false;
                }
            }
            else{
                
                $status = true;
            }

            if($status){

                $data_array = array(

                    "trans_dt"      =>  $this->input->post('trans_dt'),
    
                    // "kms_year"      =>  $this->kms_year,
                    "kms_year"      =>  $this->session->userdata('kms_yr'),

                    "dist"          =>  $this->input->post('dist'),
    
                    "soc_id"        =>  $this->input->post('soc_name'),
    
                    "paddy_qty"     =>  $this->input->post('paddy_qty'),
    
                    "created_by"    =>  $this->session->userdata('loggedin')->user_name,
    
                    "created_dt"    =>  date('Y-m-d h:i:s')
    
                );
    
                $this->Paddy->f_insert('td_work_order', $data_array);
    
                //For notification storing message
                $this->session->set_flashdata('msg', 'Successfully added!');
    
                redirect('paddy/workorder');
    
            }
            else{

                $this->session->set_flashdata('msg', "Sorry, Can not accept");
    
                redirect('paddy/workorder');

            }
            
        }
        else {

            //District List
            $workorder['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("workorder/add", $workorder);

            $this->load->view('post_login/footer');

        }
        
    }

    //Societies for a block selected by user 
    public function f_socmills() {

        $data   =   $this->Paddy->f_get_particulars("md_mill m, md_soc_mill s", array("m.mill_name"), array("m.sl_no = s.mill_id" => null, "s.soc_id" => $this->input->get('soc_id')), 0);

        echo json_encode($data);

    }

    //Workorder edit in the table td_work_order
    public function f_workorder_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "paddy_qty"     =>  $this->input->post('paddy_qty'),

                "modified_by"   =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "order_no"     =>  $this->input->post('order_no')
                
            );

            $this->Paddy->f_edit('td_work_order', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/workorder');


        }
        else {

            //District List
            $workorder['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //Workorder Details
            $select     =   array(

                "t.trans_dt", "t.order_no", "t.dist",
    
                "t.soc_id", "t.paddy_qty", "m.block"
    
            );
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,

                "t.order_no"             => $this->input->get('order_no')
    
            );

            $workorder['workorder_dtls']=   $this->Paddy->f_get_particulars("td_work_order t, md_society m", $select, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("workorder/edit", $workorder);

            $this->load->view('post_login/footer');

        }
        
    }

    /*********************For Farmer registration Screen********************/
    #Total No of registred farmer for individual societies from table td_reg_farmer
    public function f_farmerreg() {
        $kms_year=$this->session->userdata('kms_yr');
        //District List
        $farmerreg['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //Retriving Farmerreg Details
        $select     =   array(

            "t.trans_dt", "t.reg_no", "t.dist",

            "m.soc_name", "t.farmer_no"

        );

        $where      =   array(

            "t.soc_id = m.sl_no"    => NULL,
            "t.kms_year"=>$kms_year 

        );

        $farmerreg['farmerreg_dtls']    =   $this->Paddy->f_get_particulars("td_reg_farmer t, md_society m", $select, $where, 0);
        

        //Counting District Society wise
        unset($select);
        unset($where);

        $select     =   array(

            "dist", "COUNT(*) count"

        );

        $where      =   array(
            "kms_year"=>$kms_year, 
            "1 GROUP BY dist"     => NULL

        );

        $farmerreg['dist_dtls']     =   $this->Paddy->f_get_particulars("td_reg_farmer", $select, $where, 0);



        $this->load->view('post_login/main');

        $this->load->view("farmerreg/dashboard", $farmerreg);

        $this->load->view('search/search');
        
        $this->load->view('post_login/footer');
        
    }

    //New Registered Farmer Registered Add in the table td_reg_farmer
    public function f_farmerreg_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),

                // "kms_year"      =>  $this->kms_year,

                "kms_year"      =>  $this->session->userdata('kms_yr'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "farmer_no"     =>  $this->input->post('farmer_no'),

                "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"    =>  date('Y-m-d h:i:s')

            );
    //  echo $this->db->last_query();
    //  die();
            $this->Paddy->f_insert('td_reg_farmer', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/farmerreg');

        }
        else {

            //District List
            $farmerreg['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("farmerreg/add", $farmerreg);

            $this->load->view('post_login/footer');

        }
        
    }

    //Edit No of registered Farmer in td_reg_farmer
    public function f_farmerreg_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "farmer_no"     =>  $this->input->post('farmer_no'),

                "modified_by"   =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "reg_no"     =>  $this->input->post('reg_no')

            );

            $this->Paddy->f_edit('td_reg_farmer', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/farmerreg');


        }
        else {

            //District List
            $farmerreg['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //Farmerreg Details
            $select     =   array(

                "t.trans_dt", "t.reg_no", "t.dist",
    
                "t.soc_id", "t.farmer_no", "m.block"
    
            );
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,
                
                "t.reg_no" => $this->input->get('reg_no')
                
            );

            $farmerreg['farmerreg_dtls']=   $this->Paddy->f_get_particulars("td_reg_farmer t, md_society m", $select, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("farmerreg/edit", $farmerreg);

            $this->load->view('post_login/footer');

        }
        
    }


    /*********************For Paddy Collection Screen********************/
    #List of Procurement of Paddy, Society wise from table td_collections
    public function f_paddycollection() {
        $kms_year=$this->session->userdata('kms_yr');
        //District List
        $paddycollection['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //Retriving Collection Details
        $select     =   array(

            "t.trans_dt", "t.coll_no", "t.dist", "paddy_qty",

            "m.soc_name", "t.no_of_farmer", "t.no_of_camp", "t.created_by"

        );

        $where      =   array(

            "t.soc_id = m.sl_no"    => NULL,
            "t.kms_year"=>$kms_year 

        );

        $paddycollection['paddycollection_dtls']    =   $this->Paddy->f_get_particulars("td_collections t, md_society m", $select, $where, 0);

        //Counting Collections District wise
        unset($select);
        unset($where);

        $select     =   array(
           
            "dist", "COUNT(*) count"

        );

        $where      =   array(
            "kms_year"=>$kms_year ,
            "1 GROUP BY dist"     => NULL

        );

        $paddycollection['dist_dtls']     =   $this->Paddy->f_get_particulars("td_collections", $select, $where, 0);        

        $this->load->view('post_login/main');

        $this->load->view("paddycollection/dashboard", $paddycollection);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //For Farmer Details Modal
    public function f_getFarmerDetails(){

        $data['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_details_farmer', NULL, array('coll_no' => $this->input->get('coll_no')), 0);
        
        if(empty($data['farmer_dtls'])){
            $data['farmer_dtls'] =   $this->Paddy->f_get_particulars('td_details_farmer_cheque', NULL, array('coll_no' => $this->input->get('coll_no')), 0);
            $this->load->view('paddycollection/farmer_dtls_cheque', $data);
        }
        else{
            $this->load->view('paddycollection/farmer_dtls', $data);
        }

    }

    //For Status Update of Farmer NEFT
    public function f_updateStatus(){

        $value =  ($this->input->get('value') == 1)? 0:1;

        $this->Paddy->f_edit('td_details_farmer', array("status" => $value), array('trans_id' => $this->input->get('trans_id')));

    }

    //For Status Update of Farmer Cheque
    public function f_updateStatusCheque(){

        $value =  ($this->input->get('value') == 1)? 0:1;

        $this->Paddy->f_edit('td_details_farmer_cheque', array("status" => $value), array('trans_id' => $this->input->get('trans_id')));

    }

    //New Paddy Collection Add in table td_collections
    public function f_paddycollection_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $max_trans_no = $this->Paddy->f_get_particulars("td_collections", array("MAX(coll_no) coll_no"), NULL, 1);
            $coll_no      = ($max_trans_no)? ($max_trans_no->coll_no + 1) : 1;

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),                

                // "kms_year"      =>  $this->kms_year,
                "kms_year"      =>  $this->session->userdata('kms_yr'),
                "coll_no"       =>  $coll_no,

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "no_of_camp"    =>  $this->input->post('no_of_camp'),

                "no_of_farmer"  =>  $this->input->post('no_of_farmer'),

                "paddy_qty"     =>  $this->input->post('paddy_qty'),

                "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_insert('td_collections', $data_array);

            //For Excel Upload
            $csvMimes = array('text/x-comma-separated-values',
					   'text/comma-separated-values',
					   'application/octet-stream',
					   'application/vnd.ms-excel',
					   'application/x-csv',
					   'text/x-csv',
					   'text/csv',
					   'application/csv',
					   'application/excel',
					   'application/vnd.msexcel',
                       'text/plain');
            
            //For NEFT Payment uploadation
            if(!empty($_FILES['f_payment']['name']) && in_array($_FILES['f_payment']['type'],$csvMimes)){
					   
                $csvFile = fopen($_FILES['f_payment']['tmp_name'], 'r');
                    
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        
                        $data[] = array(
                                    'coll_no'             =>  $coll_no,
                                    'trans_id'            =>  $line[0],
                                    'trans_dt'            =>  $this->input->post('trans_dt'),
                                    // 'kms_year'            =>  $this->kms_year,
                                    'kms_year'      =>  $this->session->userdata('kms_yr'),
                                    'beneficiary_name'    =>  $line[2],
                                    'ifsc'                =>  $line[3],
                                    'acc_no'              =>  $line[4],
                                    'paddy_qty'           =>  $line[5],
                                    'amount'              =>  $line[6]
                                );
                                    
                    }  
                    
                    unset($data[0]);
                    $data = array_values($data);
                    
                fclose($csvFile);

                $this->Paddy->f_insert_multiple('td_details_farmer', $data);
            }//For Cheque Details uploadation
            else if(!empty($_FILES['f_payment_cheque']['name']) && in_array($_FILES['f_payment_cheque']['type'],$csvMimes)){
					   
                $csvFile = fopen($_FILES['f_payment_cheque']['tmp_name'], 'r');
                    
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        
                        $data[] = array(
                                    'coll_no'             =>  $coll_no,
                                    'trans_id'            =>  $line[1],
                                    'trans_dt'            =>  $this->input->post('trans_dt'),
                                    // 'kms_year'            =>  $this->kms_year,
                                    'kms_year'      =>  $this->session->userdata('kms_yr'),
                                    'beneficiary_name'    =>  $line[3],
                                    'cheque_no'           =>  $line[7],
                                    'address'             =>  $line[9],
                                    'paddy_qty'           =>  $line[4],
                                    'amount'              =>  $line[5]
                                );
                                    
                    }  
                    
                    unset($data[0]);
                    $data = array_values($data);
                    
                fclose($csvFile);

                $this->Paddy->f_insert_multiple('td_details_farmer_cheque', $data);
            }

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/paddycollection');

        }
        else {

            //District List
            $paddycollection['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("paddycollection/add", $paddycollection);

            $this->load->view('post_login/footer');

        }
        
    }

    //Paddy Collection edit in table td_collections
    public function f_paddycollection_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "no_of_camp"    =>  $this->input->post('no_of_camp'),
                
                "paddy_qty"     =>  $this->input->post('paddy_qty'),

                "no_of_farmer"  =>  $this->input->post('no_of_farmer'),

                "modified_by"   =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "coll_no"     =>  $this->input->post('coll_no')

            );

            $this->Paddy->f_edit('td_collections', $data_array, $where);

            //For Excel Upload
            $csvMimes = array('text/x-comma-separated-values',
					   'text/comma-separated-values',
					   'application/octet-stream',
					   'application/vnd.ms-excel',
					   'application/x-csv',
					   'text/x-csv',
					   'text/csv',
					   'application/csv',
					   'application/excel',
					   'application/vnd.msexcel',
					   'text/plain');
            if(!empty($_FILES['f_payment']['name']) && in_array($_FILES['f_payment']['type'],$csvMimes)){
					   
                $csvFile = fopen($_FILES['f_payment']['tmp_name'], 'r');
                    
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        
                        if($this->input->post('bank_statement')){
                            
                            $data_array = array(
                                "status" => ($line[11] == 'Success')? 1 : 0
                            );
                            $where = array(
                                "acc_no" => $line[5],
                                "amount" => $line[9]
                            );
                            
                            $this->Paddy->f_edit('td_details_farmer', $data_array, $where);

                        }
                        else{

                            $data[] = array(
                                'coll_no'             =>  $this->input->post('coll_no'),
                                'trans_id'            =>  $line[0],
                                'trans_dt'            =>  $this->input->post('trans_dt'),
                                // 'kms_year'            =>  $this->kms_year,
                                'kms_year'      =>  $this->session->userdata('kms_yr'),
                                'beneficiary_name'    =>  $line[2],
                                'ifsc'                =>  $line[3],
                                'acc_no'              =>  $line[4],
                                'paddy_qty'           =>  $line[5],
                                'amount'              =>  $line[6]
                            );

                        }
                                    
                    }  

                unset($data[0]);
                $data = array_values($data);    
                
                fclose($csvFile);

                if(isset($data)){
                    //First delete previous datas
                    $this->Paddy->f_delete('td_details_farmer', $where);
                    $this->Paddy->f_delete('td_details_farmer_cheque', $where);
            
                    $this->Paddy->f_insert_multiple('td_details_farmer', $data);
                }
                
            }
            else if(!empty($_FILES['f_payment_cheque']['name']) && in_array($_FILES['f_payment_cheque']['type'],$csvMimes)){
					   
                $csvFile = fopen($_FILES['f_payment_cheque']['tmp_name'], 'r');
                    
                    while(($line = fgetcsv($csvFile)) !== FALSE){
                        
                        $data[] = array(
                                    'coll_no'             =>  $this->input->post('coll_no'),
                                    'trans_id'            =>  $line[1],
                                    'trans_dt'            =>  $this->input->post('trans_dt'),
                                    // 'kms_year'            =>  $this->kms_year,
                                    'kms_year'      =>  $this->session->userdata('kms_yr'),
                                    'beneficiary_name'    =>  $line[3],
                                    'cheque_no'           =>  $line[7],
                                    'address'             =>  $line[9],
                                    'paddy_qty'           =>  $line[4],
                                    'amount'              =>  $line[5]
                                );
                                    
                    }  
                    
                    unset($data[0]);
                    $data = array_values($data);    
                    
                    fclose($csvFile);

                if(isset($data)){
                    //First delete previous datas
                    $this->Paddy->f_delete('td_details_farmer', $where);
                    $this->Paddy->f_delete('td_details_farmer_cheque', $where);
            
                    $this->Paddy->f_insert_multiple('td_details_farmer_cheque', $data);
                }

            }
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/paddycollection');


        }
        else {

            //District List
            $paddycollection['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //Collection Details
            $select     =   array(

                "t.trans_dt", "t.coll_no", "t.dist",

                "t.no_of_camp", "t.no_of_farmer", "t.paddy_qty",
    
                "t.soc_id", "m.block"
    
            );
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,
                
                "t.coll_no" => $this->input->get('coll_no')

            );

            $paddycollection['paddycollection_dtls']=   $this->Paddy->f_get_particulars("td_collections t, md_society m", $select, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("paddycollection/edit", $paddycollection);

            $this->load->view('post_login/footer');

        }
        
    }

    //Paddy Collection Delete from table td_collections
    public function f_paddycollection_delete() {

        $where = array(
            // "kms_year"   =>  $this->kms_year,
            "kms_year"      =>  $this->session->userdata('kms_yr'),
            "coll_no"    =>  $this->input->get('coll_no')
        );

        //Retriving the data row for backup
        $select = array (

            "trans_dt","kms_year","coll_no","dist","soc_id",
            "no_of_camp","no_of_farmer","paddy_qty"

        );

        $data   =   (array) $this->Paddy->f_get_particulars("td_collections", $select, $where, 1);
        
        $audit  =   array(
            
            'deleted_by'    => $this->session->userdata('loggedin')->user_name,
            
            'deleted_dt'    => date('Y-m-d h:i:s')

        );

        //Inserting Data
        $this->Paddy->f_insert('td_collections_deleted', array_merge($data, $audit));

        //Delete Originals
        $this->Paddy->f_delete('td_collections', $where);
        $this->Paddy->f_delete('td_details_farmer', $where);

        //For notification storing message
        $this->session->set_flashdata('msg', 'Successfully deleted!');

        redirect("paddy/paddycollection");

    }

    //Total Number Of Registered Farmer For a Particular Society from table td_reg_farmer
    public function f_regfarmer(){
        $kms_year=$this->session->userdata('kms_yr');
        $data = $this->Paddy->f_get_particulars("td_reg_farmer", array("ifnull(sum(farmer_no), 0) sum"), array("soc_id" => $this->input->get('soc_id'), "kms_year" => $this->session->userdata('kms_yr')), 1);

        echo $data->sum;

    }

    //Sum of Total No Of Farmers Worked for a Particular Society from table td_collections
    public function f_totfarmer(){

        $where      =   array(

            "soc_id"   => $this->input->get('soc_id'),
            "kms_year"      =>  $this->session->userdata('kms_yr')
            // "kms_year" => $this->kms_year

        );

        $data = $this->Paddy->f_get_particulars("td_collections", array("ifnull(sum(no_of_farmer), 0) sum"), $where, 1);

        echo $data->sum;

    }

    //Progressive Paddy Procurement of a Particular Society
    public function f_progressive(){
        $kms_year=$this->session->userdata('kms_yr');
        $where      =   array(

            "soc_id"   => $this->input->get('soc_id'),
            "kms_year"      =>  $this->session->userdata('kms_yr')
            // "kms_year" => $this->kms_year

        );

        $data = $this->Paddy->f_get_particulars("td_collections", array("ifnull(sum(paddy_qty), 0) sum"), $where, 1);

        echo $data->sum;

    }

    //Paddy Quantity, Which are Already Delivered to the Rice Millars
    public function f_alreadyDelivered(){
        // $kms_year=$this->session->userdata('kms_yr');
        $where      =   array(

            "soc_id"   => $this->input->get('soc_id'),
            "kms_year"      =>  $this->session->userdata('kms_yr')
            // "kms_year" => $this->kms_year

        );

        $data = $this->Paddy->f_get_particulars("td_received", array("ifnull(sum(paddy_qty), 0) sum"), $where, 1);

        echo $data->sum;

    }

    //Progressive Work Order for a particular Society
    public function f_totorder(){

        $where      =   array(

            "soc_id"   => $this->input->get('soc_id'),
            "kms_year"      =>  $this->session->userdata('kms_yr')
            // "kms_year" => $this->kms_year

        );

        $data = $this->Paddy->f_get_particulars("td_work_order", array("ifnull(sum(paddy_qty), 0) sum"), $where, 1);

        echo $data->sum;

    }

    /*********************For Paddy Received Screen********************/
    #Paddy Delivered to the Rice Mill List from td_received
    public function f_received() {
        $kms_year=$this->session->userdata('kms_yr');
        //District List
        $paddyreceived['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //Retriving Paddy Received Details from table td_received
        $select     =   array(

            "t.trans_dt", "t.trans_no", "t.dist", "paddy_qty",

            "m.soc_name", "md.mill_name", "t.created_by"

        );

        $where      =   array(

            "t.soc_id = m.sl_no"        => NULL,

            "t.mill_id = md.sl_no"      => NULL,

            "t.kms_year"=>$kms_year
        );

        $paddyreceived['paddyreceived_dtls']    =   $this->Paddy->f_get_particulars("td_received t, md_society m, md_mill md", $select, $where, 0);

        //Counting Receiveds District wise
        unset($select);
        unset($where);

        $select     =   array(

            "dist", "COUNT(*) count"

        );

        $where      =   array(
            "kms_year"=>$kms_year,
            "1 GROUP BY dist"     => NULL

        );

        $paddyreceived['dist_dtls']     =   $this->Paddy->f_get_particulars("td_received", $select, $where, 0);        

        $this->load->view('post_login/main');

        $this->load->view("paddyreceived/dashboard", $paddyreceived);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New Paddy Quantity Delivery to the Rice Mill in table td_received
    public function f_received_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),                

                // "kms_year"      =>  $this->kms_year,
                "kms_year"      =>  $this->session->userdata('kms_yr'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "mill_id"       =>  $this->input->post('mill_name'),

                "paddy_qty"     =>  $this->input->post('paddy_qty'),

                "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_insert('td_received', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/received');

        }
        else {

            //District List
            $paddyreceived['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("paddyreceived/add", $paddyreceived);

            $this->load->view('post_login/footer');

        }
        
    }

    //Delivered Paddy Quantity to the Rice Mill Edit in td_received
    public function f_received_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "mill_id"       =>  $this->input->post('mill_name'),

                "paddy_qty"     =>  $this->input->post('paddy_qty'),

                "modified_by"   =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "trans_no"     =>  $this->input->post('trans_no')

            );

            $this->Paddy->f_edit('td_received', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/received');


        }
        else {

            //District List
            $paddyreceived['dist'] = $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //Received Details
            $select     =   array(

                "t.trans_dt", "t.trans_no", "t.dist",

                "t.mill_id", "t.paddy_qty",
    
                "t.soc_id", "m.block"
    
            );
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,
                
                "t.trans_no" => $this->input->get('trans_no')

            );

            $paddyreceived['paddyreceived_dtls']=   $this->Paddy->f_get_particulars("td_received t, md_society m", $select, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("paddyreceived/edit", $paddyreceived);

            $this->load->view('post_login/footer');

        }
        
    }

    /*********************For Paddy CMR offered Screen********************/
    #After Milling Mill Offer CMR to the DO 
    public function f_offered() {
        $kms_year=$this->session->userdata('kms_yr');
        //District List
        $cmroffered['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //Retriving CMR offered Details from table td_cmr_offered
        $select     =   array(

            "t.trans_dt", "t.trans_no", "t.dist",

            "m.soc_name", "md.mill_name", "t.tot_offered"

        );

        $where      =   array(

            "t.soc_id = m.sl_no"        => NULL,

            "t.mill_id = md.sl_no"      => NULL,
            "t.kms_year"=>$kms_year

        );

        $cmroffered['cmroffered_dtls']    =   $this->Paddy->f_get_particulars("td_cmr_offered t, md_society m, md_mill md", $select, $where, 0);

        //Counting CMR offereds District wise
        unset($select);
        unset($where);

        $select     =   array(

            "dist", "COUNT(*) count"

        );

        $where      =   array(
            "kms_year"=>$kms_year,
            "1 GROUP BY dist"     => NULL

        );

        $cmroffered['dist_dtls']     =   $this->Paddy->f_get_particulars("td_cmr_offered", $select, $where, 0);        

        $this->load->view('post_login/main');

        $this->load->view("cmroffered/dashboard", $cmroffered);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New CMR offere Add for a particular Mill in the table td_cmr_offered
    public function f_offered_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            
            //Previous resultant cmr
            $where = array(

                // "kms_year"      =>  $this->kms_year,
                "kms_year"      => $this->session->userdata('kms_yr'),
                "soc_id"        =>  $this->input->post('soc_name'),

                "mill_id"       =>  $this->input->post('mill_name')

            );

            $resultant = $this->Paddy->f_get_particulars("td_cmr_offered", array("count(1) count"), $where, 1);
            
            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),                

                // "kms_year"      =>  $this->kms_year,
                "kms_year"      => $this->session->userdata('kms_yr'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "mill_id"       =>  $this->input->post('mill_name'),

                "tot_paddy_delivered" => $this->input->post('tot_pdy_delivrd'),

                "milled" => $this->input->post('milled'),

                "rice_type"     =>  $this->input->post('rice_type'),

                "resultant_cmr" =>  ($resultant->count != 0)? 0.000 : $this->input->post('res_cmr'),

                "sp"            =>  $this->input->post('state_pool'),

                "cp"            =>  $this->input->post('central_pool'),

                "fci"           =>  $this->input->post('fci'),

                "tot_offered"   =>  $this->input->post('tot_cmr_offered'),

                "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_insert('td_cmr_offered', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/offered');

        }
        else {

            //District List
            $cmroffered['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("cmroffered/add", $cmroffered);

            $this->load->view('post_login/footer');

        }
        
    }

    //CMR offered edit for a particular Mill in the table td_cmr_offered
    public function f_offered_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                
                "trans_dt"      =>  $this->input->post('trans_dt'),                

                // "kms_year"      =>  $this->kms_year,
                "kms_year"      => $this->session->userdata('kms_yr'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "mill_id"       =>  $this->input->post('mill_name'),

                "tot_paddy_delivered" => $this->input->post('tot_pdy_delivrd'),

                "milled" => $this->input->post('milled'),

                "rice_type"     =>  $this->input->post('rice_type'),

                "sp"            =>  $this->input->post('state_pool'),

                "cp"            =>  $this->input->post('central_pool'),

                "fci"           =>  $this->input->post('fci'),

                "tot_offered"   =>  $this->input->post('tot_cmr_offered'),

                "modified_by"   =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "trans_no"     =>  $this->input->post('trans_no'),
                "kms_year"=>$kms_year

            );

            $this->Paddy->f_edit('td_cmr_offered', $data_array, $where);
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/offered');


        }
        else {

            //District List
            $cmroffered['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //CMR offered Details
            $select     =   array(

                "t.trans_dt", "t.trans_no", "t.dist",

                "t.mill_id", "t.soc_id", "m.block",

                "t.tot_paddy_delivered", "t.rice_type",

                "t.resultant_cmr", "t.sp", "t.cp", "t.fci",

                "t.tot_offered", "t.milled"
    
            );
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,
                
                "t.trans_no" => $this->input->get('trans_no')

            );

            $cmroffered['cmroffered_dtls']=   $this->Paddy->f_get_particulars("td_cmr_offered t, md_society m", $select, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("cmroffered/edit", $cmroffered);

            $this->load->view('post_login/footer');

        }
        
    }

    //Total No of Paddy Quantity Received By a Particular Mill 
    //from a Particular Society from table td_received
    public function f_delivered(){

        $where      =   array(

            "mill_id"  => $this->input->get('mill_id'),

            "soc_id"   => $this->input->get('soc_id'),

            // "kms_year" => $this->kms_year
            "kms_year"      => $this->session->userdata('kms_yr'),
        );

        $data = $this->Paddy->f_get_particulars("td_received", array("ifnull(sum(paddy_qty), 0) sum"), $where, 1);

        echo $data->sum;

    }

    //Total No of Paddy Quantity Offered By a Particular Mill 
    //from a Particular Society from table td_cmr_offered
    public function f_progOffered(){

        $where      =   array(

            "mill_id"  => $this->input->get('mill_id'),

            "soc_id"   => $this->input->get('soc_id'),

            // "kms_year" => $this->kms_year
            "kms_year"      => $this->session->userdata('kms_yr')
        );

        $data = $this->Paddy->f_get_particulars("td_cmr_offered", array("ifnull(sum(tot_offered), 0) sum"), $where, 1);

        echo $data->sum;

    }

    //Rice Type: Par Boiled, Raw Rice
    //Retrive Rice Type md_parameters 
    public function f_ricetype(){

        $where      =   array(

            "sl_no"  => ($this->input->get('type') == 'P')? 18 : 19,

        );

        $data = $this->Paddy->f_get_particulars("md_parameters", array("param_value"), $where, 1);

        echo $data->param_value;

    }

    /*********************For CMR DO Isseue Screen********************/
    #Mill isseus there milled paddy to the DO
    #After approval of DO CMR Delivered to the Govt. Godown
    //Retreving list of date wise CMR quantity isseued by DO from the table td_do_isseued
    public function f_doisseued() {
        $kms_year=$this->session->userdata('kms_yr');
        //District List
        $doisseued['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //Retriving CMR doisseued Details
        $select     =   array(

            "t.trans_dt", "t.trans_no", "t.dist",

            "m.soc_name", "md.mill_name", "t.tot_doisseued"

        );

        $where      =   array(

            "t.soc_id = m.sl_no"        => NULL,

            "t.mill_id = md.sl_no"      => NULL,
            "t.kms_year"=>$kms_year

        );

        $doisseued['doisseued_dtls']    =   $this->Paddy->f_get_particulars("td_do_isseued t, md_society m, md_mill md", $select, $where, 0);

        //Counting CMR doisseueds District wise
        unset($select);
        unset($where);

        $select     =   array(

            "dist", "COUNT(*) count"

        );

        $where      =   array(
            "kms_year"=>$kms_year,
            "1 GROUP BY dist"     => NULL

        );

        $doisseued['dist_dtls']     =   $this->Paddy->f_get_particulars("td_do_isseued", $select, $where, 0);        

        $this->load->view('post_login/main');

        $this->load->view("doisseued/dashboard", $doisseued);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New CMR quantity isseued by DO for a particular Mill in the table td_do_isseued
    public function f_doisseued_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),                

                // "kms_year"      =>  $this->kms_year,
                "kms_year"      =>  $this->session->userdata('kms_yr'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "mill_id"       =>  $this->input->post('mill_name'),

                "tot_cmr_offered" => $this->input->post('tot_cmr_offered'),

                "sp"            =>  $this->input->post('state_pool'),

                "cp"            =>  $this->input->post('central_pool'),

                "fci"           =>  $this->input->post('fci'),

                "tot_doisseued"   =>  $this->input->post('tot_cmr_doisseued'),

                "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_insert('td_do_isseued', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/doisseued');

        }
        else {

            //District List
            $doisseued['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("doisseued/add", $doisseued);

            $this->load->view('post_login/footer');

        }
        
    }

    //Edit CMR quantity isseued by DO for a particular Mill in the table td_do_isseued    
    public function f_doisseued_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                
                "trans_dt"      =>  $this->input->post('trans_dt'),                

                // "kms_year"      =>  $this->kms_year,
                "kms_year"      => $this->session->userdata('kms_yr'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "mill_id"       =>  $this->input->post('mill_name'),

                "tot_cmr_offered" => $this->input->post('tot_cmr_offered'),

                "sp"            =>  $this->input->post('state_pool'),

                "cp"            =>  $this->input->post('central_pool'),

                "fci"           =>  $this->input->post('fci'),

                "tot_doisseued"   =>  $this->input->post('tot_cmr_doisseued'),

                "modified_by"   =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "trans_no"     =>  $this->input->post('trans_no'),
                "kms_year"=>$kms_year
            );

            $this->Paddy->f_edit('td_do_isseued', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/doisseued');

        }
        else {

            //District List
            $doisseued['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //CMR doisseued Details
            $select     =   array(

                "t.trans_dt", "t.trans_no", "t.dist",

                "t.mill_id", "t.soc_id", "m.block",

                "t.tot_cmr_offered", "t.sp", "t.cp",
                
                "t.fci", "t.tot_doisseued"
    
            );
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,
                
                "t.trans_no" => $this->input->get('trans_no')

            );

            $doisseued['doisseued_dtls']=   $this->Paddy->f_get_particulars("td_do_isseued t, md_society m", $select, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("doisseued/edit", $doisseued);

            $this->load->view('post_login/footer');

        }
        
    }

    //Total CMR Offered from a particular mill from table td_cmr_offered
    public function f_totoffer(){

        $select     =   array(
            
            "ifnull(sum(sp), 0) sp",
            "ifnull(sum(cp), 0) cp", 
            "ifnull(sum(fci), 0) fci",
            "ifnull(sum(tot_offered), 0) tot"
        
        );

        $where      =   array(

            "mill_id"  => $this->input->get('mill_id'),

            "soc_id"   => $this->input->get('soc_id'),

            // "kms_year" => $this->kms_year
            "kms_year"      => $this->session->userdata('kms_yr')

        );

        $data = $this->Paddy->f_get_particulars("td_cmr_offered", $select, $where, 1);

        echo json_encode($data);   

    }

    /*********************For Paddy CMR delivery Screen********************/
    #CMR Delivery to the Govt. Godown
    //Retriving List of date wise deliveries for all mill for a particlular KMS Year from the table td_cmr_delivery
    public function f_delivery() {
        $kms_year=$this->session->userdata('kms_yr');
        //District List
        $cmrdelivery['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //Retriving CMR delivery Details
        $select     =   array(

            "t.trans_dt", "t.trans_no", "t.dist",

            "m.soc_name", "md.mill_name", "t.tot_delivery"

        );

        $where      =   array(

            "t.soc_id = m.sl_no"        => NULL,

            "t.mill_id = md.sl_no"      => NULL,
            "t.kms_year"=>$kms_year

        );

        $cmrdelivery['cmrdelivery_dtls']    =   $this->Paddy->f_get_particulars("td_cmr_delivery t, md_society m, md_mill md", $select, $where, 0);

        //Counting CMR deliverys District wise
        unset($select);
        unset($where);

        $select     =   array(

            "dist", "COUNT(*) count"

        );

        $where      =   array(
            "kms_year"=>$kms_year,
            "1 GROUP BY dist"     => NULL

        );

        $cmrdelivery['dist_dtls']     =   $this->Paddy->f_get_particulars("td_cmr_delivery", $select, $where, 0);        

        $this->load->view('post_login/main');

        $this->load->view("cmrdelivery/dashboard", $cmrdelivery);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New CMR quantity delivered to the govt. godown for a particular mill in the table td_cmr_delivery
    public function f_delivery_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "trans_dt"      =>  $this->input->post('trans_dt'),                

                // "kms_year"      =>  $this->kms_year,
                "kms_year"      => $this->session->userdata('kms_yr'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "mill_id"       =>  $this->input->post('mill_name'),

                "tot_doisseued" => $this->input->post('tot_do_isseued'),

                "sp"            =>  $this->input->post('state_pool'),

                "cp"            =>  $this->input->post('central_pool'),

                "fci"           =>  $this->input->post('fci'),

                "tot_delivery"  =>  $this->input->post('tot_cmr_delivery'),

                "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_insert('td_cmr_delivery', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/delivery');

        }
        else {

            //District List
            $cmrdelivery['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("cmrdelivery/add", $cmrdelivery);

            $this->load->view('post_login/footer');

        }
        
    }

    //Edit CMR quantity delivered to the govt. godown for a particular mill in the table td_cmr_delivery    
    public function f_delivery_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                
                "trans_dt"      =>  $this->input->post('trans_dt'),                

                // "kms_year"      =>  $this->kms_year,
                "kms_year"      => $this->session->userdata('kms_yr'),

                "dist"          =>  $this->input->post('dist'),

                "soc_id"        =>  $this->input->post('soc_name'),

                "mill_id"       =>  $this->input->post('mill_name'),

                "tot_doisseued" => $this->input->post('tot_cmr_offered'),

                "sp"            =>  $this->input->post('state_pool'),

                "cp"            =>  $this->input->post('central_pool'),

                "fci"           =>  $this->input->post('fci'),

                "tot_delivery"   =>  $this->input->post('tot_cmr_delivery'),

                "modified_by"   =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "trans_no"     =>  $this->input->post('trans_no')

            );

            $this->Paddy->f_edit('td_cmr_delivery', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/delivery');


        }
        else {

            //District List
            $cmrdelivery['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //CMR delivery Details
            $select     =   array(

                "t.trans_dt", "t.trans_no", "t.dist",

                "t.mill_id", "t.soc_id", "m.block",

                "t.tot_doisseued", "t.sp", "t.cp",
                
                "t.fci", "t.tot_delivery"
    
            );
    
            $where      =   array(
    
                "t.soc_id = m.sl_no"    => NULL,
                
                "t.trans_no" => $this->input->get('trans_no')

            );

            $cmrdelivery['cmrdelivery_dtls']=   $this->Paddy->f_get_particulars("td_cmr_delivery t, md_society m", $select, $where, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("cmrdelivery/edit", $cmrdelivery);

            $this->load->view('post_login/footer');

        }
        
    }
    
    //Total CMR isseued from a particular mill from table td_do_isseued
    public function f_totisseued(){

        $select     =   array(
            
            "ifnull(sum(sp), 0) sp",
            "ifnull(sum(cp), 0) cp", 
            "ifnull(sum(fci), 0) fci",
            "ifnull(sum(tot_doisseued), 0) tot"
        
        );

        $where      =   array(

            "mill_id"  => $this->input->get('mill_id'),

            "soc_id"   => $this->input->get('soc_id'),

            // "kms_year" => $this->kms_year
            "kms_year"      => $this->session->userdata('kms_yr')

        );

        $data = $this->Paddy->f_get_particulars("td_do_isseued", $select, $where, 1);

        echo json_encode($data);   

    }


    /*********************For Bill Screen********************/
    #List of Bill Master Details from table md_comm_params
    public function f_bill_master() {

        $where          = array(

            "kms_yr"    => $this->session->userdata('kms_yr')

        );

        //Retriving Bill Master
        $billmaster['mm_dtls'] =   $this->Paddy->f_get_particulars("md_comm_params", NULL, $where, 0);

        $this->load->view('post_login/main');

        $this->load->view("billmaster/dashboard", $billmaster);

        $this->load->view('post_login/footer');

    }

    //New Bill Master Add in the table md_comm_params
    public function f_billmaster_add() {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            //Max sl_no is having insert
            $max_slno     =    $this->Paddy->f_get_particulars("md_comm_params", array("IFNULL(MAX(sl_no) + 1, 1) sl_no"), array("kms_yr" => $this->session->userdata('kms_yr')), 1);

            $data_array     =   array(

                "sl_no"         =>  $max_slno->sl_no,

                "param_name"    =>  $this->input->post('param_name'),

                "boiled_val"    =>  $this->input->post('boiled'),

                "raw_val"       =>  $this->input->post('raw'),

                "action"        =>  $this->input->post('action'),

                "kms_yr"        =>  $this->session->userdata('kms_yr'),

                "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_insert("md_comm_params", $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully Added!');
    
            redirect("paddy/bill/master");

        }
        else {

            $this->load->view('post_login/main');

            $this->load->view("billmaster/add");

            $this->load->view('search/search');

            $this->load->view('post_login/footer');

        }

    }

    //Edit Bill Master Add in the table md_comm_params    
    public function f_billmaster_edit() {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $data_array     =   array(

                "boiled_val"   =>  $this->input->post('boiled'),

                "raw_val"      =>  $this->input->post('raw'),
                
                "action"       =>  $this->input->post('action')

            );

            $this->Paddy->f_edit("md_comm_params", $data_array, array("sl_no" => $this->input->post('sl_no'),"kms_yr" => $this->input->post('kms_yr')));

            $this->session->set_flashdata('msg', 'Successfully Updated!');
    
            redirect("paddy/bill/master");

        }
        else {

            //Retriving Bill Master
            $billmaster['mm_dtls'] =   $this->Paddy->f_get_particulars("md_comm_params", NULL, array("sl_no" => $this->input->get('sl_no'),"kms_yr" => $this->input->get('kms_yr')), 1);

            $this->load->view('post_login/main');

            $this->load->view("billmaster/edit", $billmaster);

            $this->load->view('post_login/footer');

        }

    }

    //List of Necessary Supporting Documents for Bills from the table md_documents
    public function f_bill_documents() {

        $documents['doc_dtls']     =   $this->Paddy->f_get_particulars("md_documents", array('sl_no', 'documents'), NULL, 0);        

        $this->load->view('post_login/main');

        $this->load->view("documents/dashboard", $documents);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New Supporting Documents Add in the table md_documents
    public function f_billdocuments_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(
                
                "sl_no"         =>  $this->input->post('sl_no'),

                "documents"     =>  $this->input->post('document'),

                "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"    =>  date('Y-m-d h:i:s')

            );

            $this->Paddy->f_insert('md_documents', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/bill/documents');


        }
        else {

            $this->load->view('post_login/main');

            $this->load->view("documents/add");

            $this->load->view('post_login/footer');

        }
        
    }

    //Edit Supporting Documents in the table md_documents
    public function f_billdocuments_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "documents"    =>  $this->input->post('document'),

                "modified_by"   =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"   =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "sl_no"     =>  $this->input->post('sl_no')

            );

            $this->Paddy->f_edit('md_documents', $data_array, $where);

            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/bill/documents');


        }
        else {

            //Retriving Document
            $documents['docs'] = $this->Paddy->f_get_particulars("md_documents", array('documents'), array('sl_no' => $this->input->get('sl_no')), 1);

            $this->load->view('post_login/main');

            $this->load->view("documents/edit", $documents);

            $this->load->view('post_login/footer');

        }
        
    }


    //Bill List for a particlular kms year
    public function f_bill() {
        $kms_year=$this->session->userdata('kms_yr');
        //District List
        $bill['dist']      =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        //Society List
        $bill['soc']       =   $this->Paddy->f_get_particulars("md_society", array("sl_no", "soc_name"), NULL, 0);
            
        //Mill List
        $bill['mill']      =   $this->Paddy->f_get_particulars("md_mill", array("sl_no", "mill_name"), NULL, 0);
           
        //Bill Details
        $bill['bill_dtls'] = $this->Paddy->f_get_particulars("td_bill", NULL, array("approval_status" => 'U',"kms_yr"=>$kms_year), 0);

        $this->load->view('post_login/main');

        $this->load->view("bill/dashboard", $bill);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');

    }

    //New Bill Add
    public function f_bill_add() {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $rice_type = $this->input->post('rice_type');

            // echo $rice_type; die;
            
            //For Rice Type Par Boiled
            if($rice_type == 'P'){
                
                //MSP
                $tot_msp        = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 1,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                //Market fee
                $market_fee     = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 2,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;
                
                //Labour Charge
                $mandi_chrg     = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 3,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;
                
                //Transportation charges distance wise PADDY
                if($this->input->post('trns_distance_paddy') <= 25){

                    $trans_chrg_min = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 4,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $trans_chrg_mid = 0;

                    $trans_chrg_max = 0;
                }
                else if($this->input->post('trns_distance_paddy') >= 26 && $this->input->post('trns_distance_paddy') <= 50){

                    $extra_dist     = $this->input->post('trns_distance_paddy') - 25;

                    $trans_chrg_min = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 4,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $trans_chrg_mid = ($this->input->post('paddy_qty') * $extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 5,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $trans_chrg_max = 0;

                }
                else{

                    $extra_dist     = $this->input->post('trns_distance_paddy') - 50;

                    $trans_chrg_min = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 4,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $trans_chrg_mid = ($this->input->post('paddy_qty') * 25) * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 5,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $trans_chrg_max = ($this->input->post('paddy_qty') * $extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 6,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                }

                //Driage
                $driage         = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 8,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                //Commission to Society
                $soc_comm       = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 9,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;
                
                //Milling charges
                $millng_chrg    = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 10,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;
                
                //CGST Paddy
                $cgst_paddy     = ($millng_chrg * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 11,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val) / 100;

                //SGST Paddy
                $sgst_paddy     = ($millng_chrg * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 12,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val) / 100;
                
                //Administrative Charges
                $admin_chrg     = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 13,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                //Cost of 1 qtl of Milled Paddy (Amount)
                $cost_per_milled_paddy = $this->Paddy->f_get_particulars("md_comm_params", array("SUM(boiled_val) boiled_val"), array("sl_no BETWEEN 1 AND 13" => NULL,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                //Sub-total of CMR
                $sub_tot_cmr    = ($this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 14,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val) / 100;

                //Sub-total of Rate
                $sub_tot_rate   = ($cost_per_milled_paddy * 100) / $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 14,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;


                //Transportation charges distance wise RICE
                if($this->input->post('trns_distance_rice') > 0){

                    $cmr_trans_chrg_min = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 15,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $cmr_trans_chrg_mid = 0;

                    $cmr_trans_chrg_max = 0;
                }
                else if($this->input->post('trns_distance_rice') >= 26 && $this->input->post('trns_distance_rice') <= 50){

                    $cmr_extra_dist     = $this->input->post('trns_distance_rice') - 25;

                    $cmr_trans_chrg_min = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 15,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $cmr_trans_chrg_mid = ($sub_tot_cmr * $cmr_extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 16,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $cmr_trans_chrg_max = 0;

                }
                else{

                    $cmr_extra_dist     = $this->input->post('trns_distance_rice') - 50;

                    $cmr_trans_chrg_min = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 15,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $cmr_trans_chrg_mid = ($sub_tot_cmr * 25) * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 16,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $cmr_trans_chrg_max = ($sub_tot_cmr * $cmr_extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 17,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                }

                //Gunny Usage for Gunny Bags Paddy
                $gunny_bags     = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 16,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                //CGST Paddy
                $cgst_cmr       = ($gunny_bags * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 17,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val) / 100;

                //SGST Paddy
                $sgst_cmr       = ($gunny_bags * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 18,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val ) / 100;

                $data_array =   array(

                    "bill_no"       => $this->input->post('bill_no'),
                    
                    "bill_dt"       => $this->input->post('date'),

                    // "kms_yr"        => $this->kms_year,

                    "kms_yr"      => $this->session->userdata('kms_yr'),

                    "pool_type"     => $this->input->post('pool_type'),
                    
                    "rice_type"     => $this->input->post('rice_type'),

                    "dist"          => $this->input->post('dist'),

                    "block"         => $this->input->post('block'),
                    
                    "soc_id"        => $this->input->post('soc_name'),

                    "mill_id"       => $this->input->post('mill_name'),

                    "paddy_qty"     => $this->input->post('paddy_qty'),
                    
                    "tot_msp"       => round($tot_msp, 0),

                    "market_fee"    => round($market_fee, 0),

                    "mandi_chrg"    => round($mandi_chrg, 0),

                    "transport_dist"   => $this->input->post('trns_distance_paddy'),
                    
                    "transportation1"   => round($trans_chrg_min, 0),

                    "transportation2"   => round($trans_chrg_mid, 0),

                    "transportation3"   => round($trans_chrg_max, 0),

                    "inter_dist_transprt" => $this->input->post('inter_dist_transprt'),
                    
                    "driage"        => round($driage, 0),

                    "comm_soc"      => round($soc_comm, 0),

                    "comm_mill"     => round($millng_chrg, 0),

                    "cgst_milling"  => round($cgst_paddy, 0),
                    
                    "sgst_milling"  => round($sgst_paddy, 0),

                    "admin_chrg"    => round($admin_chrg, 0),

                    "tot_milled_paddy" => $cost_per_milled_paddy,

                    "out_ratio"     => $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 14,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val,

                    "sub_tot_cmr_qty"  => round($sub_tot_cmr, 3),

                    "sub_tot_cmr_rate" => round($sub_tot_rate, 3),

                    "transport_dist1"   => $this->input->post('trns_distance_rice'),
                    
                    "transportation_cmr1"   => round($cmr_trans_chrg_min, 0),

                    "transportation_cmr2"   => $cmr_trans_chrg_mid,

                    "transportation_cmr3"   => $cmr_trans_chrg_max,

                    "gunny_usege"   => round($gunny_bags, 0),
                    
                    "cgst_gunny"    => round($cgst_cmr, 0),

                    "sgst_gunny"    => round($sgst_cmr, 0),

                    "butta_cut"     => round($this->input->post('butta_cut', 0)),
                    
                    "gunny_cut"     => round($this->input->post('gunny_cut'), 0),

                    "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                    "created_dt"   =>  date('Y-m-d h:i:s')

                );

                $this->Paddy->f_insert("td_bill", $data_array);

                //Document Maintenance
                for($i = 0; $i < count($this->input->post('sl_no')); $i++){
                    unset($data_array);
                    
                    if(json_decode($this->input->post('sl_no')[$i])->value == 1){
                        
                        $data_array = array(
                            
                            "bill_no"       => $this->input->post('bill_no'),

                            "pool_type"     => $this->input->post('pool_type'),

                            // "kms_year"      => $this->kms_year,

                            "kms_year"      => $this->session->userdata('kms_yr'),

                            "doc_id"        => json_decode($this->input->post('sl_no')[$i])->sl_no,

                            "status"        => json_decode($this->input->post('sl_no')[$i])->value
                        );
                        
                        $this->Paddy->f_insert("td_doc_maintenance", $data_array);
                    }
                }   

                //For notification storing message
                $this->session->set_flashdata('msg', 'Successfully Added!');
    
                redirect("paddy/bill");

            }//For Rice Type Raw Rice
            else{
                
                //MSP
                $tot_msp        = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 1,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                //Market fee
                $market_fee     = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 2,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;
                
                //Labour Charge
                $mandi_chrg     = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 3,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;
                
                //Transportation charges distance wise PADDY
                if($this->input->post('trns_distance_paddy') <= 25){

                    $trans_chrg_min = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 4,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $trans_chrg_mid = 0;

                    $trans_chrg_max = 0;
                }
                else if($this->input->post('trns_distance_paddy') >= 26 && $this->input->post('trns_distance_paddy') <= 50){

                    $extra_dist     = $this->input->post('trns_distance_paddy') - 25;

                    $trans_chrg_min = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 4,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $trans_chrg_mid = ($this->input->post('paddy_qty') * $extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 5,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $trans_chrg_max = 0;

                }
                else{

                    $extra_dist     = $this->input->post('trns_distance_paddy') - 50;

                    $trans_chrg_min = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 4,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $trans_chrg_mid = ($this->input->post('paddy_qty') * 25) * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 5,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $trans_chrg_max = ($this->input->post('paddy_qty') * $extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 6,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                }

                //Driage
                $driage         = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 8,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                //Commission to Society
                $soc_comm       = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 9,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;
                
                //Milling charges
                $millng_chrg    = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 10,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;
                
                //CGST Paddy
                $cgst_paddy     = ($millng_chrg * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 11,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val) / 100;

                //SGST Paddy
                $sgst_paddy     = ($millng_chrg * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 12,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val) / 100;
                
                //Administrative Charges
                $admin_chrg     = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 13,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                //Cost of 1 qtl of Milled Paddy (Amount)
                $cost_per_milled_paddy = $this->Paddy->f_get_particulars("md_comm_params", array("SUM(raw_val) raw_val"), array("sl_no BETWEEN 1 AND 13" => NULL,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                //Sub-total of CMR
                $sub_tot_cmr    = ($this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 14,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val) / 100;

                //Sub-total of Rate
                $sub_tot_rate   = ($cost_per_milled_paddy * 100) / $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 14,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;


                //Transportation charges distance wise RICE
                if($this->input->post('trns_distance_rice') > 0){

                    $cmr_trans_chrg_min = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 15,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $cmr_trans_chrg_mid = 0;

                    $cmr_trans_chrg_max = 0;
                }
                else if($this->input->post('trns_distance_rice') >= 26 && $this->input->post('trns_distance_rice') <= 50){

                    $cmr_extra_dist     = $this->input->post('trns_distance_rice') - 25;

                    $cmr_trans_chrg_min = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 15,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $cmr_trans_chrg_mid = ($sub_tot_cmr * $cmr_extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 16,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $cmr_trans_chrg_max = 0;

                }
                else{

                    $cmr_extra_dist     = $this->input->post('trns_distance_rice') - 50;

                    $cmr_trans_chrg_min = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 15,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $cmr_trans_chrg_mid = ($sub_tot_cmr * 25) * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 16,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $cmr_trans_chrg_max = ($sub_tot_cmr * $cmr_extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 17,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                }

                //Gunny Usage for Gunny Bags Paddy
                $gunny_bags     = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 16,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                //CGST Paddy
                $cgst_cmr       = ($gunny_bags * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 17,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val) / 100;

                //SGST Paddy
                $sgst_cmr       = ($gunny_bags * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 18,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val ) / 100;

                $data_array =   array(

                    "bill_no"       => $this->input->post('bill_no'),
                    
                    "bill_dt"       => $this->input->post('date'),

                    //"kms_yr"        => $this->kms_year,

                    "kms_yr"      => $this->session->userdata('kms_yr'),

                    "pool_type"     => $this->input->post('pool_type'),
                    
                    "rice_type"     => $this->input->post('rice_type'),

                    "dist"          => $this->input->post('dist'),

                    "block"         => $this->input->post('block'),
                    
                    "soc_id"        => $this->input->post('soc_name'),

                    "mill_id"       => $this->input->post('mill_name'),

                    "paddy_qty"     => $this->input->post('paddy_qty'),
                    
                    "tot_msp"       => round($tot_msp, 0),

                    "market_fee"    => round($market_fee, 0),

                    "mandi_chrg"    => round($mandi_chrg, 0),

                    "transport_dist"   => $this->input->post('trns_distance_paddy'),
                    
                    "transportation1"   => round($trans_chrg_min, 0),

                    "transportation2"   => round($trans_chrg_mid, 0),

                    "transportation3"   => round($trans_chrg_max, 0),

                    "inter_dist_transprt" => $this->input->post('inter_dist_transprt'),
                    
                    "driage"        => round($driage, 0),

                    "comm_soc"      => round($soc_comm, 0),

                    "comm_mill"     => round($millng_chrg, 0),

                    "cgst_milling"  => round($cgst_paddy, 0),
                    
                    "sgst_milling"  => round($sgst_paddy, 0),

                    "admin_chrg"    => round($admin_chrg, 0),

                    "tot_milled_paddy" => $cost_per_milled_paddy,

                    "out_ratio"     => $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 14,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val,

                    "sub_tot_cmr_qty"  => round($sub_tot_cmr, 3),

                    "sub_tot_cmr_rate" => round($sub_tot_rate, 3),
                    
                    "transport_dist1"   => $this->input->post('trns_distance_rice'),

                    "transportation_cmr1"   => $cmr_trans_chrg_min,

                    "transportation_cmr2"   => $cmr_trans_chrg_mid,

                    "transportation_cmr3"   => $cmr_trans_chrg_max,

                    "gunny_usege"   => round($gunny_bags, 0),
                    
                    "cgst_gunny"    => round($cgst_cmr, 0),

                    "sgst_gunny"    => round($sgst_cmr, 0),

                    "butta_cut"     => round($this->input->post('butta_cut'), 0),
                    
                    "gunny_cut"     => round($this->input->post('gunny_cut'), 0),

                    "created_by"    =>  $this->session->userdata('loggedin')->user_name,

                    "created_dt"   =>  date('Y-m-d h:i:s')

                );

                $this->Paddy->f_insert("td_bill", $data_array);
                
                //Document Maintenance
                for($i = 0; $i < count($this->input->post('sl_no')); $i++){
                    unset($data_array);
                    
                    if(json_decode($this->input->post('sl_no')[$i])->value == 1){
                        
                        $data_array = array(
                            
                            "bill_no"       => $this->input->post('bill_no'),

                            "pool_type"     => $this->input->post('pool_type'),

                            // "kms_year"      => $this->kms_year,

                            "kms_year"      => $this->session->userdata('kms_yr'),

                            "doc_id"        => json_decode($this->input->post('sl_no')[$i])->sl_no,

                            "status"        => json_decode($this->input->post('sl_no')[$i])->value
                        );
                        
                        $this->Paddy->f_insert("td_doc_maintenance", $data_array);
                    }
                }   
                
                //For notification storing message
                $this->session->set_flashdata('msg', 'Successfully Added!');
    
                redirect("paddy/bill");

            }

        }
        else{

            //District List
            $bill['dist']         =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
            
            //Retriving Document Details
            $bill['doc_dtls']     =   $this->Paddy->f_get_particulars("md_documents", array('sl_no', 'documents'), NULL, 0);        

            $this->load->view('post_login/main');

            $this->load->view("bill/add", $bill);

            $this->load->view('post_login/footer');

        }

    }

    //Max Bill No
    public function f_maxBillNo(){

        $where = array(
            // "kms_yr" => $this->kms_year,
            "kms_yr"      => $this->session->userdata('kms_yr'),
            "pool_type" => $this->input->get('pool_type')
        );

        $bill   = $this->Paddy->f_get_particulars('td_bill', array('(MAX(CAST(bill_no as unsigned)) + 1) bill_no'), $where, 1);

        if(isset($bill->bill_no)){
            echo $bill->bill_no;
        }
        else{
            echo 1;
        }
    }

    //Mill wise total Paddy Quantity for all bills from the table td_bill
    public function f_generated(){

        $where      =   array(

            "mill_id"  => $this->input->get('mill_id'),

            "soc_id"   => $this->input->get('soc_id'),

            // "kms_yr"   => $this->kms_year

            "kms_yr"      => $this->session->userdata('kms_yr')

        );

        $data = $this->Paddy->f_get_particulars("td_bill", array("ifnull(sum(paddy_qty), 0) sum"), $where, 1);

        echo $data->sum;

    }

    //For Bill Edit
    public function f_bill_edit() {

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

             $rice_type = $this->input->post('rice_type');

         //   die();

            //For Rice Type Par Boiled
            if($rice_type == 'P'){

                //Calculating billing values
                //MSP
                $tot_msp        = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 1,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                //Market fee
                $market_fee     = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 2,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;
                
                //Labour Charge
                $mandi_chrg     = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 3,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;
                
                //Transportation charges distance wise PADDY
                if($this->input->post('trns_distance_paddy') <= 25){

                    $trans_chrg_min = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 4,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $trans_chrg_mid = 0;

                    $trans_chrg_max = 0;
                }
                else if($this->input->post('trns_distance_paddy') >= 26 && $this->input->post('trns_distance_paddy') <= 50){

                    $extra_dist     = $this->input->post('trns_distance_paddy') - 25;

                    $trans_chrg_min = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 4,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $trans_chrg_mid = ($this->input->post('paddy_qty') * $extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 5,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $trans_chrg_max = 0;

                }
                else{

                    $extra_dist     = $this->input->post('trns_distance_paddy') - 50;

                    $trans_chrg_min = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 4,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $trans_chrg_mid = ($this->input->post('paddy_qty') * 25) * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 5,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $trans_chrg_max = ($this->input->post('paddy_qty') * $extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 6,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                }

                //Driage
                $driage         = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 8,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                //Commission to Society
                $soc_comm       = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 9,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;
                
                //Milling charges
                $millng_chrg    = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 10,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;
                
                //CGST Paddy
                $cgst_paddy     = ($millng_chrg * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 11,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val) / 100;

                //SGST Paddy
                $sgst_paddy     = ($millng_chrg * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 12,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val) / 100;
                
                //Administrative Charges
                $admin_chrg     = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 13,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                //Cost of 1 qtl of Milled Paddy (Amount)
                $cost_per_milled_paddy = $this->Paddy->f_get_particulars("md_comm_params", array("SUM(boiled_val) boiled_val"), array("sl_no BETWEEN 1 AND 13" => NULL,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                //Sub-total of CMR
                $sub_tot_cmr    = ($this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 14,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val) / 100;

                //Sub-total of Rate
                $sub_tot_rate   = ($cost_per_milled_paddy * 100) / $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 14,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;


                //Transportation charges distance wise RICE
                if($this->input->post('trns_distance_rice') > 0){

                    $cmr_trans_chrg_min = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 15,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $cmr_trans_chrg_mid = 0;

                    $cmr_trans_chrg_max = 0;
                }
                else if($this->input->post('trns_distance_rice') >= 26 && $this->input->post('trns_distance_rice') <= 50){

                    $cmr_extra_dist     = $this->input->post('trns_distance_rice') - 25;

                    $cmr_trans_chrg_min = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 15,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $cmr_trans_chrg_mid = ($sub_tot_cmr * $cmr_extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 16,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $cmr_trans_chrg_max = 0;

                }
                else{

                    $cmr_extra_dist     = $this->input->post('trns_distance_rice') - 50;

                    $cmr_trans_chrg_min = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 15,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $cmr_trans_chrg_mid = ($sub_tot_cmr * 25) * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 16,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                    $cmr_trans_chrg_max = ($sub_tot_cmr * $cmr_extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 17,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;

                }

                //Gunny Usage for Gunny Bags Paddy
                $gunny_bags     = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 16,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val;
                
                //CGST Paddy
                $cgst_cmr       = ($gunny_bags * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 17,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val) / 100;

                //SGST Paddy
                $sgst_cmr       = ($gunny_bags * $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 18,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val ) / 100;

                $data_array =   array(

                    "bill_no"       => $this->input->post('bill_no'),
                    
                    "bill_dt"       => $this->input->post('date'),

                    // "kms_yr"        => $this->kms_year,

                    "kms_yr"      => $this->session->userdata('kms_yr'),

                    "pool_type"     => $this->input->post('pool_type'),
                    
                    "rice_type"     => $this->input->post('rice_type'),

                    "dist"          => $this->input->post('dist'),

                    "block"         => $this->input->post('block'),
                    
                    "soc_id"        => $this->input->post('soc_name'),

                    "mill_id"       => $this->input->post('mill_name'),

                    "paddy_qty"     => $this->input->post('paddy_qty'),
                    
                    "tot_msp"       => round($tot_msp, 0),

                    "market_fee"    => round($market_fee, 0),

                    "mandi_chrg"    => round($mandi_chrg, 0),

                    "transport_dist"    => $this->input->post('trns_distance_paddy'),
                    
                    "transportation1"   => round($trans_chrg_min, 0),

                    "transportation2"   => round($trans_chrg_mid, 0),

                    "transportation3"   => round($trans_chrg_max, 0),
                    
                    "driage"        => round($driage, 0),

                    "comm_soc"      => round($soc_comm, 0),

                    "comm_mill"     => round($millng_chrg, 0),

                    "cgst_milling"  => round($cgst_paddy, 0),
                    
                    "sgst_milling"  => round($sgst_paddy, 0),

                    "admin_chrg"    => round($admin_chrg, 0),

                    "tot_milled_paddy" => $cost_per_milled_paddy,

                    "out_ratio"     => $this->Paddy->f_get_particulars("md_comm_params", array("boiled_val"), array("sl_no" => 14,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->boiled_val,

                    "sub_tot_cmr_qty"  => round($sub_tot_cmr, 3),

                    "sub_tot_cmr_rate" => round($sub_tot_rate, 3),

                    "transport_dist1"   => $this->input->post('trns_distance_rice'),
                    
                    "transportation_cmr1"   => round($cmr_trans_chrg_min, 0),

                    "transportation_cmr2"   => round($cmr_trans_chrg_mid, 0),

                    "transportation_cmr3"   => round($cmr_trans_chrg_max, 0),

                    "inter_dist_transprt" => $this->input->post('inter_dist_transprt'),

                    "gunny_usege"   => round($gunny_bags, 0),
                    
                    "cgst_gunny"    => round($cgst_cmr, 0),

                    "sgst_gunny"    => round($sgst_cmr, 0),

                    "butta_cut"     => round($this->input->post('butta_cut'), 0),
                    
                    "gunny_cut"     => round($this->input->post('gunny_cut'), 0),

                    "modified_by"    =>  $this->session->userdata('loggedin')->user_name,

                    "modified_dt"   =>  date('Y-m-d h:i:s')

                );

                $this->Paddy->f_edit("td_bill", $data_array, array("bill_no" => $this->input->post('bill_no'), "pool_type" => $this->input->post('pool_type'),"kms_yr" => $this->session->userdata('kms_yr')));

                //Delete Previous Data
                $this->Paddy->f_delete('td_doc_maintenance', array('bill_no' => $this->input->post('bill_no'), "pool_type" => $this->input->post('pool_type'), 'kms_year' => $this->session->userdata('kms_yr')));

                unset($data_array);
                //Document Maintenance
                for($i = 0; $i < count($this->input->post('sl_no')); $i++){
                    
                    if(json_decode($this->input->post('sl_no')[$i])->value == 1){
                        
                        $data_array[] = array(
                            
                            "bill_no"       => $this->input->post('bill_no'),
                            
                            "pool_type"     => $this->input->post('pool_type'),

                            // "kms_year"      => $this->kms_year,
                            "kms_year"      =>  $this->session->userdata('kms_yr'),

                            "doc_id"        => json_decode($this->input->post('sl_no')[$i])->sl_no,

                            "status"        => json_decode($this->input->post('sl_no')[$i])->value
                        );
                        
                    }
                }   
                $this->Paddy->f_insert_multiple("td_doc_maintenance", $data_array);

                //For notification storing message
                $this->session->set_flashdata('msg', 'Successfully Updated!');
    
                redirect("paddy/bill");

            }//For Rice Type Raw Rice
            else{

                //Calculating billing values
                
                //MSP
                $tot_msp        = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 1,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                //Market fee
                $market_fee     = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 2,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;
                
                //Labour Charge
                $mandi_chrg     = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 3,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;
                
                //Transportation charges distance wise PADDY
                if($this->input->post('trns_distance_paddy') <= 25){

                    $trans_chrg_min = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 4,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $trans_chrg_mid = 0;

                    $trans_chrg_max = 0;
                }
                else if($this->input->post('trns_distance_paddy') >= 26 && $this->input->post('trns_distance_paddy') <= 50){

                    $extra_dist     = $this->input->post('trns_distance_paddy') - 25;

                    $trans_chrg_min = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 4,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $trans_chrg_mid = ($this->input->post('paddy_qty') * $extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 5,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $trans_chrg_max = 0;

                }
                else{

                    $extra_dist     = $this->input->post('trns_distance_paddy') - 50;

                    $trans_chrg_min = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 4,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $trans_chrg_mid = ($this->input->post('paddy_qty') * 25) * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 5,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $trans_chrg_max = ($this->input->post('paddy_qty') * $extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 6,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                }

                //Driage
                $driage         = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 8,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                //Commission to Society
                $soc_comm       = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 9,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;
                
                //Milling charges
                $millng_chrg    = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 10,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;
                
                //CGST Paddy
                $cgst_paddy     = ($millng_chrg * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 11,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val) / 100;

                //SGST Paddy
                $sgst_paddy     = ($millng_chrg * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 12,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val) / 100;
                
                //Administrative Charges
                $admin_chrg     = $this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 13,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                //Cost of 1 qtl of Milled Paddy (Amount)
                $cost_per_milled_paddy = $this->Paddy->f_get_particulars("md_comm_params", array("SUM(raw_val) raw_val"), array("sl_no BETWEEN 1 AND 13" => NULL,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                //Sub-total of CMR
                $sub_tot_cmr    = ($this->input->post('paddy_qty') * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 14,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val) / 100;

                //Sub-total of Rate
                $sub_tot_rate   = ($cost_per_milled_paddy * 100) / $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 14,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;


                //Transportation charges distance wise RICE
                if($this->input->post('trns_distance_rice') > 0){

                    $cmr_trans_chrg_min = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 15,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $cmr_trans_chrg_mid = 0;

                    $cmr_trans_chrg_max = 0;
                }
                else if($this->input->post('trns_distance_rice') >= 26 && $this->input->post('trns_distance_rice') <= 50){

                    $cmr_extra_dist     = $this->input->post('trns_distance_rice') - 25;

                    $cmr_trans_chrg_min = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 15,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $cmr_trans_chrg_mid = ($sub_tot_cmr * $cmr_extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 16,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $cmr_trans_chrg_max = 0;

                }
                else{

                    $cmr_extra_dist     = $this->input->post('trns_distance_rice') - 50;

                    $cmr_trans_chrg_min = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 15,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $cmr_trans_chrg_mid = ($sub_tot_cmr * 25) * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 16,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                    $cmr_trans_chrg_max = ($sub_tot_cmr * $cmr_extra_dist) * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 17,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                }

                //Gunny Usage for Gunny Bags Paddy
                $gunny_bags     = $sub_tot_cmr * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 18,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val;

                //CGST Paddy
                $cgst_cmr       = ($gunny_bags * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 19,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val) / 100;

                //SGST Paddy
                $sgst_cmr       = ($gunny_bags * $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 20,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val ) / 100;

                $data_array =   array(

                    "bill_no"       => $this->input->post('bill_no'),
                    
                    "bill_dt"       => $this->input->post('date'),

                    // "kms_yr"        => $this->kms_year,

                    "kms_yr"      => $this->session->userdata('kms_yr'),

                    "pool_type"     => $this->input->post('pool_type'),
                    
                    "rice_type"     => $this->input->post('rice_type'),

                    "dist"          => $this->input->post('dist'),

                    "block"         => $this->input->post('block'),
                    
                    "soc_id"        => $this->input->post('soc_name'),

                    "mill_id"       => $this->input->post('mill_name'),

                    "paddy_qty"     => $this->input->post('paddy_qty'),
                    
                    "tot_msp"       => round($tot_msp, 0),

                    "market_fee"    => round($market_fee, 0),

                    "mandi_chrg"    => round($mandi_chrg, 0),

                    "transport_dist"    => $this->input->post('trns_distance_paddy'),
                    
                    "transportation1"   => round($trans_chrg_min, 0),

                    "transportation2"   => round($trans_chrg_mid, 0),

                    "transportation3"   => round($trans_chrg_max, 0),
                    
                    "driage"        => round($driage, 0),

                    "comm_soc"      => round($soc_comm, 0),

                    "comm_mill"     => round($millng_chrg, 0),

                    "cgst_milling"  => round($cgst_paddy, 0),
                    
                    "sgst_milling"  => round($sgst_paddy, 0),

                    "admin_chrg"    => round($admin_chrg, 0),

                    "tot_milled_paddy" => $cost_per_milled_paddy,

                    "out_ratio"     => $this->Paddy->f_get_particulars("md_comm_params", array("raw_val"), array("sl_no" => 14,"kms_yr"=>$this->session->userdata('kms_yr')), 1)->raw_val,

                    "sub_tot_cmr_qty"  => round($sub_tot_cmr, 3),

                    "sub_tot_cmr_rate" => round($sub_tot_rate, 3),

                    "transport_dist1"    => $this->input->post('trns_distance_rice'),
                    
                    "transportation_cmr1"   => round($cmr_trans_chrg_min, 0),

                    "transportation_cmr2"   => round($cmr_trans_chrg_mid, 0),

                    "transportation_cmr3"   => round($cmr_trans_chrg_max, 0),

                    "inter_dist_transprt" => $this->input->post('inter_dist_transprt'),

                    "gunny_usege"   => round($gunny_bags, 0),
                    
                    "cgst_gunny"    => round($cgst_cmr, 0),

                    "sgst_gunny"    => round($sgst_cmr, 0),

                    "butta_cut"     => round($this->input->post('butta_cut'), 0),
                    
                    "gunny_cut"     => round($this->input->post('gunny_cut'), 0),

                    "modified_by"    =>  $this->session->userdata('loggedin')->user_name,

                    "modified_dt"   =>  date('Y-m-d h:i:s')

                );

                $this->Paddy->f_edit("td_bill", $data_array, array("bill_no" => $this->input->post('bill_no'), "pool_type" => $this->input->post('pool_type'),"kms_yr" => $this->session->userdata('kms_yr')));

                //Delete Previous Data
                $this->Paddy->f_delete('td_doc_maintenances', array('bill_no' => $this->input->post('bill_no'), "pool_type" => $this->input->post('pool_type'), 'kms_year'=> $this->session->userdata('kms_yr')));

                unset($data_array);
                //Document Maintenance
                for($i = 0; $i < count($this->input->post('sl_no')); $i++){
                    
                    if(json_decode($this->input->post('sl_no')[$i])->value == 1){
                        
                        $data_array[] = array(
                            
                            "bill_no"       => $this->input->post('bill_no'),
                            
                            "pool_type"     => $this->input->post('pool_type'),

                            // "kms_year"      => $this->kms_year,

                            "kms_year"      => $this->session->userdata('kms_yr'),

                            "doc_id"        => json_decode($this->input->post('sl_no')[$i])->sl_no,

                            "status"        => json_decode($this->input->post('sl_no')[$i])->value
                        );
                        
                    }
                }   
                $this->Paddy->f_insert_multiple("td_doc_maintenance", $data_array);

                //For notification storing message
                $this->session->set_flashdata('msg', 'Successfully Updated!');
    
                redirect("paddy/bill");

            }    

        }
        else{

            //District List
            $bill['dist']         =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
            
            //Bill Details
            $bill['bill_dtls']    =   $this->Paddy->f_get_particulars("td_bill", NULL, array('bill_no' => $this->input->get('bill_no'), "pool_type" => $this->input->get('pool_type'),"kms_yr"=>$this->session->userdata('kms_yr')), 1);
            
            //Retriving Document Details
            $bill['doc_dtls']     =   $this->Paddy->f_doc_maintenance($this->input->get('bill_no'), $this->input->get('pool_type'),$this->session->userdata('kms_yr'));        
            
            $this->load->view('post_login/main');

            $this->load->view("bill/edit", $bill);

            $this->load->view('post_login/footer');

        }

    }


    //Bill Delete
    public function f_bill_delete(){
        $kms_year=$this->session->userdata('kms_yr');

        $where = array(
            "kms_yr"     =>  $kms_year,
            "bill_no"    =>  $this->input->get('bill_no'),
            "pool_type"  =>  $this->input->get('pool_type')
            
        );

         $wheres = array(
            "kms_year"     =>  $kms_year,
            "bill_no"      =>  $this->input->get('bill_no'),
            "pool_type"    =>  $this->input->get('pool_type')
            
        );

        //Retriving the data row for backup
        $select = array (

            "bill_no","bill_dt","kms_yr","pool_type","rice_type",
            "dist","block","soc_id","mill_id","paddy_qty","tot_msp",
            "market_fee","mandi_chrg","transport_dist","transportation1",
            "transportation2","transportation3","driage","comm_soc",
            "comm_mill","cgst_milling","sgst_milling","admin_chrg",
            "tot_milled_paddy","out_ratio","sub_tot_cmr_qty",
            "sub_tot_cmr_rate","transport_dist1","transportation_cmr1",
            "transportation_cmr2","transportation_cmr3","gunny_usege",
            "cgst_gunny","sgst_gunny","butta_cut","gunny_cut"

        );

        $data   =   (array) $this->Paddy->f_get_particulars("td_bill", $select, $where, 1);
        
        $audit  =   array(
            
            'deleted_by'    => $this->session->userdata('loggedin')->user_name,
            
            'deleted_dt'    => date('Y-m-d h:i:s')

        );

       
        //Inserting Data
        $this->Paddy->f_insert('td_bill_deleted', array_merge($data, $audit));

        //Delete Previous Data
        $this->Paddy->f_delete('td_doc_maintenance', $wheres);

        //For notification storing message
        $this->session->set_flashdata('msg', 'Successfully deleted!');

        $this->Paddy->f_delete('td_bill', $where);

        redirect("paddy/bill");

    }

    /*********************For Bill Submit Screen********************/
    
    //List of Submitted Bills from table td_bill_submit
    public function f_bill_submit() {
        $kms_year=$this->session->userdata('kms_yr');
        //Retrive Submited Bills
        $select = array(
            "submit_no", "submit_date", 
            "tot_amt"
        );

        $where = array(
            
            "kms_year"=>$kms_year
            
        );

        $bill_submit['submit']     =   $this->Paddy->f_get_particulars("td_bill_submit", $select, $where, 0);        

        $this->load->view('post_login/main');

        $this->load->view("submit/dashboard", $bill_submit);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New Submitted Bill Nos entry in the table td_bill_submit
    public function f_submit_add() {
        $kms_year=$this->session->userdata('kms_yr');
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $max_trans_no = $this->Paddy->f_get_particulars("td_bill_submit", array("MAX(submit_no) submit_no"), NULL, 1);
            
            $data_array = array(

                "submit_date"          =>  $this->input->post('trans_dt'),

                "submit_no"            =>  ($max_trans_no)? ($max_trans_no->submit_no + 1) : 1,
                
                // "kms_year"             =>  $this->kms_year,

                "kms_year"      => $this->session->userdata('kms_yr'),

                "pool_type"            =>  $this->input->post('pool_type'),
                
                "tot_amt"              =>  $this->input->post('submit_amt'),

                "created_by"           =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"           =>  date('Y-m-d h:i:s')

            );
            
            $this->Paddy->f_insert('td_bill_submit', $data_array);

            
            $bills = explode(',', $this->genBills($this->input->post('bill_nos')));
           
            unset($data_array);

            for($i = 0; $i < count($bills); $i++){
            
                $data_array[] = array(

                    "submit_no"    =>  ($max_trans_no)? ($max_trans_no->submit_no + 1) : 1,
                    "bill_no"      =>  $bills[$i],
                    //  "kms_year"     =>  $this->kms_year,
                    "kms_year"      => $this->session->userdata('kms_yr'),
                    "pool_type"    =>  $this->input->post('pool_type'),
                    
                );
            
            }
            $this->Paddy->f_insert_multiple("td_submitted_bill_dtls", $data_array);
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/bill_submit');
        }
        else {

            $this->load->view('post_login/main');

            $this->load->view("submit/add");

            $this->load->view('post_login/footer');

        }
        
    }

    //Total Amount of all bills for a particular KMS Year from table bill_no
    public function f_billamount(){
        echo $this->Paddy->f_allBillAmount($this->genBills($this->input->get('bill_nos')), $this->input->get('pool_type'), $this->session->userdata('kms_yr')); 
        
    }

    //Checking Which Bill no are valid
    public function f_billexsists(){
        
        echo  json_encode($this->Paddy->f_exsists('td_submitted_bill_dtls', $this->genBills($this->input->get('bill_nos')), $this->input->get('pool_type'),$this->session->userdata('kms_yr'))); 
        // echo $this->db->last_query();
        // die();
    }
    
    //Edit Submitted Bill Nos entered in the table td_bill_submit    
    public function f_submit_edit() {
        $kms_year=$this->session->userdata('kms_yr');
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "submit_date"          =>  $this->input->post('trans_dt'),

                "modified_by"          =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"          =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "submit_no"     =>  $this->input->post('submit_no'),
                "kms_year"=>$kms_year  
            );

            $this->Paddy->f_edit('td_bill_submit', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/bill_submit');


        }
        else {

            $bill_submit['submit_dtls']     =   $this->Paddy->f_get_particulars('td_bill_submit', NULL, array('submit_no' => $this->input->get('submit_no'),'kms_year'=>$kms_year), 1);
            
            $data                     =   $this->Paddy->f_get_particulars("td_submitted_bill_dtls", array('bill_no'), array('submit_no' => $this->input->get('submit_no'), 'kms_year' => $this->kms_year), 0);			
            
            $bill_submit['bills']     =   array_map(function($data){ return $data->bill_no;}, $data);

            $this->load->view('post_login/main');

            $this->load->view("submit/edit", $bill_submit);

            $this->load->view('post_login/footer');

        }
        
    }


    /*********************For Millers Bill Payment Screen********************/
    #CONFED Paid Mills based on the bill no
    //New Payment Entry
    public function f_payment() {
        $kms_year=$this->session->userdata('kms_yr');
        //Retriving Bill Payment Details
        $payment['payment_dtls']    =   $this->Paddy->f_get_payments();

        $this->load->view('post_login/main');

        $this->load->view("payment/dashboard", $payment);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New Bill Payment Add
    public function f_payment_add() {
        $kms_year=$this->session->userdata('kms_yr');
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $pmt_bill_no = 0;

            // $max_trans_no = $this->Paddy->f_get_particulars("td_payment_bill", array("MAX(pmt_bill_no) pmt_bill_no"), array('kms_year' => $this->kms_year), 1);
              $max_trans_no = $this->Paddy->f_get_particulars("td_payment_bill", array("MAX(pmt_bill_no) pmt_bill_no"), array('kms_year' =>$this->session->userdata('kms_yr')), 1);

            if($max_trans_no){

                $pmt_bill_no = $max_trans_no->pmt_bill_no + 1;

            }
            else {

                $pmt_bill_no = 1;

            }

            for($i = 0; $i < count($this->input->post('confed_bill_no')); $i++){

                $data_array = array(

                    "pmt_bill_no"           =>  $pmt_bill_no,
    
                    "trans_dt"              =>  $this->input->post('trans_dt'),

                    "kms_year"              => $this->session->userdata('kms_yr'),
    
                    "soc_id"                =>  $this->input->post('soc_name'),

                    "mill_id"               =>  $this->input->post('mill_name'),
    
                    "dist"                  =>  $this->input->post('dist'),

                    "tot_paddy"             =>  $this->input->post('totPaddy'),
                    
                    "tot_cmr"               =>  $this->input->post('totCmr'),
    
                    "con_bill_no"           =>  $this->input->post('confed_bill_no')[$i],

                    "con_bill_dt"           =>  $this->input->post('confed_bill_date')[$i],
    
                    "mill_bill_no"          =>  $this->input->post('mill_bill_no')[$i],
    
                    "mill_bill_dt"          =>  $this->input->post('mill_bill_date')[$i],
    
                    "paddy_qty"             =>  $this->input->post('qty_paddy')[$i],
    
                    "paddy_cmr"             =>  $this->input->post('qty_cmr')[$i],
    
                    "paddy_butta"           =>  $this->input->post('qty_butta')[$i],
                    
                    "extra_delivery"        =>  $this->input->post('extra_delivery'),

                    "rice_type"             =>  $this->input->post('rice_type'),
                    
                    "pool_type"             =>  $this->input->post('pool_type'),
    
                    "created_by"            =>  $this->session->userdata('loggedin')->user_name,
    
                    "created_dt"            =>  date('Y-m-d h:i:s')
    
                );
                
                
                $this->Paddy->f_insert('td_payment_bill', $data_array);
    

            }

            for($i = 0; $i < count($this->input->post('particulars')); $i++){

                $data_array = array(

                    "pmt_bill_no"           =>  $pmt_bill_no,
    
                    "trans_dt"              =>  $this->input->post('trans_dt'),
    
                    "account_type"          =>  $this->input->post('particulars')[$i],
    
                    "per_unit"              =>  $this->input->post('rate_per_qtls')[$i],

                    "total_amt"             =>  $this->input->post('amounts')[$i],
    
                    "tds_amt"               =>  $this->input->post('tds_amount')[$i],
    
                    "cgst_amt"              =>  $this->input->post('cgst')[$i],

                    "sgst_amt"              =>  $this->input->post('sgst')[$i],
    
                    "payble_amt"            =>  $this->input->post('paybel')[$i],
    
                    "created_by"            =>  $this->session->userdata('loggedin')->user_name,
    
                    "created_dt"            =>  date('Y-m-d h:i:s'),

                    "kms_year"              =>$this->session->userdata('kms_yr')
    
                );
                
                
                $this->Paddy->f_insert('td_payment_bill_dtls', $data_array);

            }

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/payment');

        }
        else {

            //District List
            $payment['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //Bill Master Details
            $payment['bill_master']   =   $this->Paddy->f_get_particulars("md_comm_params", array('sl_no', 'param_name'), array('kms_yr' =>$this->session->userdata('kms_yr')), 0);

            $this->load->view('post_login/main');

            $this->load->view("payment/add", $payment);

            $this->load->view('post_login/footer');

        }
        
    }

    //Total No  of Farmer Yet to be paid
    public function f_farmer() {

        //Farmer from Transaction
        $farmer_trans   =   $this->Paddy->f_get_particulars("td_transaction", array("IFNULL(SUM(farmer_no), 0) farmer_no"), array("soc_id" => $this->input->get('society')), 1);

        //Farmer from Bill Payment
        $farmer_pey     =   $this->Paddy->f_get_particulars("td_payment", array("IFNULL(SUM(far_no), 0) farmer_no"), array("soc_id" => $this->input->get('society')), 1);
        
        echo $farmer_trans->farmer_no-$farmer_pey->farmer_no;

    }

    //Total No  of Paddy Yet to be paid
    public function f_paddy() {

        //Paddy from Transaction
        $paddy_trans   =   $this->Paddy->f_get_particulars("td_transaction", array("IFNULL(SUM(progressive), 0) progressive"), array("soc_id" => $this->input->get('society')), 1);

        //Paddy from Bill Payment
        $paddy_pey     =   $this->Paddy->f_get_particulars("td_payment", array("IFNULL(SUM(paddy_qty), 0) progressive"), array("soc_id" => $this->input->get('society')), 1);
        
        echo $paddy_trans->progressive-$paddy_pey->progressive;

    }

    //Bill Payment edit
    public function f_payment_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $kms_year = $this->session->userdata('kms_yr');

            $where1 = array('pmt_bill_no='=> $this->input->post('pmt_bill_no'),'kms_year' => $kms_year);
            $where = array('pmt_bill_no='=> $this->input->post('pmt_bill_no'));

            $this->Paddy->f_delete('td_payment_bill', $where1);
            $this->Paddy->f_delete('td_payment_bill_dtls', $where);

            for($i = 0; $i < count($this->input->post('confed_bill_no')); $i++){

                $data_array = array(

                    "pmt_bill_no"           =>  $this->input->post('pmt_bill_no'),
    
                    "trans_dt"              =>  $this->input->post('trans_dt'),
    
                    // "kms_year"              =>  $this->kms_year,

                    "kms_year"             => $this->session->userdata('kms_yr'),

                    "soc_id"                =>  $this->input->post('soc_name'),

                    "mill_id"               =>  $this->input->post('mill_name'),
    
                    "dist"                  =>  $this->input->post('dist'),

                    "tot_paddy"             =>  $this->input->post('totPaddy'),
                    
                    "tot_cmr"               =>  $this->input->post('totCmr'),
    
                    "con_bill_no"           =>  $this->input->post('confed_bill_no')[$i],

                    "con_bill_dt"           =>  $this->input->post('confed_bill_date')[$i],
    
                    "mill_bill_no"          =>  $this->input->post('mill_bill_no')[$i],
    
                    "mill_bill_dt"          =>  $this->input->post('mill_bill_date')[$i],
    
                    "paddy_qty"             =>  $this->input->post('qty_paddy')[$i],
    
                    "paddy_cmr"             =>  $this->input->post('qty_cmr')[$i],
    
                    "paddy_butta"           =>  $this->input->post('qty_butta')[$i],
                    
                    "extra_delivery"        =>  $this->input->post('extra_delivery'),

                    "rice_type"             =>  $this->input->post('rice_type'),

                    "pool_type"             =>  $this->input->post('pool_type'),
    
                    "created_by"            =>  $this->session->userdata('loggedin')->user_name,
    
                    "created_dt"            =>  date('Y-m-d h:i:s')
    
                );
                
                $this->Paddy->f_insert('td_payment_bill', $data_array);

            }

            for($i = 0; $i < count($this->input->post('particulars')); $i++){

                $data_array = array(

                    "pmt_bill_no"           =>  $this->input->post('pmt_bill_no'),
    
                    "trans_dt"              =>  $this->input->post('trans_dt'),
    
                    "account_type"          =>  $this->input->post('particulars')[$i],
    
                    "per_unit"              =>  $this->input->post('rate_per_qtls')[$i],

                    "total_amt"             =>  $this->input->post('amounts')[$i],
    
                    "tds_amt"               =>  $this->input->post('tds_amount')[$i],
    
                    "cgst_amt"              =>  $this->input->post('cgst')[$i],

                    "sgst_amt"              =>  $this->input->post('sgst')[$i],
    
                    "payble_amt"            =>  $this->input->post('paybel')[$i],
    
                    "created_by"            =>  $this->session->userdata('loggedin')->user_name,
    
                    "created_dt"            =>  date('Y-m-d h:i:s'),
                  "kms_year"               =>$this->session->userdata('kms_yr')
                );
                
                $this->Paddy->f_insert('td_payment_bill_dtls', $data_array);
    
            }    

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/payment');

        }
        else {

            //District List
            $payment['dist']            =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
            
            //Bill Master Details
            $payment['bill_master']     =   $this->Paddy->f_get_particulars("md_comm_params", array('sl_no', 'param_name'), array('kms_yr' =>$this->session->userdata('kms_yr')), 0);

            //Retriving Bill Payment Details
            $payment['payment_dtls']    =   $this->Paddy->f_get_payment($this->input->get('pmt_bill_no'),$this->input->get('pool_type'));

            //Bill Details
            $select =  array(
                "con_bill_no", "con_bill_dt", "mill_bill_no",
                "mill_bill_dt", "paddy_qty", "paddy_cmr","paddy_butta","kms_year"

            );

            $where1  =   array(
                "pmt_bill_no"   => $this->input->get('pmt_bill_no'),
                "kms_year"      =>  $this->session->userdata('kms_yr')
            );

            $where  =   array(
                "pmt_bill_no"   => $this->input->get('pmt_bill_no'),
                "kms_year"      =>  $this->session->userdata('kms_yr')
            );
            $payment['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill", $select, $where1, 0);
            
            //Charges for Bill Payment
            unset($select);
            $select =  array(

                "account_type", "per_unit", "total_amt",
                "tds_amt", "cgst_amt", "sgst_amt",
                "payble_amt"

            );
            
            $payment['charges']    =   $this->Paddy->f_get_particulars("td_payment_bill_dtls", $select, $where, 0);

            $this->load->view('post_login/main');

            $this->load->view("payment/edit", $payment);

            $this->load->view('post_login/footer');

        }
        
    }

    //Bill Payment delete
    public function f_payment_delete() {

        $where = array(
            
            "pmt_bill_no"    =>  $this->input->get('sl_no'),
            "kms_year"      =>  $this->session->userdata('kms_yr')
            
        );
        // $where1 = array(
            
        //     "pmt_bill_no"    =>  $this->input->get('sl_no'),
        //     "kms_year"      =>  $this->session->userdata('kms_yr')
            
        // );
        $this->Paddy->f_delete('td_payment_bill', $where);
        $this->Paddy->f_delete('td_payment_bill_dtls', $where);

        $this->session->set_flashdata('msg', 'Successfully Deleted!');

        redirect("paddy/payment");

    }

    //Total Paddy and CMR
    public function f_totPdyNdCMR(){

        //Retrive Bill Details
        $select =   array(
            
            'SUM(paddy_qty) paddy_qty',
            'SUM(sub_tot_cmr_qty) cmr_qty'

        );

        $where  =   array(

            // 'kms_yr'    => $this->kms_year,
            "kms_yr"      => $this->session->userdata('kms_yr'),

            'soc_id'    => $this->input->get('soc_id'),

            'mill_id'   => $this->input->get('mill_id')

        );

        $data = $this->Paddy->f_get_particulars("td_bill", $select, $where, 1);

        echo json_encode($data);

    }
    // Confed Bill List
    public function f_confedbilllist(){

        $select =   array(
            
            'bill_no'

        );
                  
        $where  =   array(

            "kms_yr"     => $this->session->userdata('kms_yr'),

            'pool_type'  => $this->input->get('pool_type'),

            'rice_type'  => $this->input->get('rice_type'),

            "dist"      => $this->input->get('dist'),

            'block'     => $this->input->get('block'),

            'soc_id'    => $this->input->get('soc_id'),

            'mill_id'   => $this->input->get('mill_id')

        );

        $data = $this->Paddy->f_get_particulars("td_bill", $select, $where, 0);

        echo json_encode($data);

    }

    //Bill Details
    public function f_billDetails(){

       // $rice = $this->Paddy->f_get_particulars('td_bill', array('rice_type'), array('kms_yr' => $this->kms_year, 'pool_type' => $this->input->get('pool_type'), 'bill_no' => $this->input->get('billNo')), 1);

         $rice = $this->Paddy->f_get_particulars('td_bill', array('rice_type'), array('kms_yr' => $this->session->userdata('kms_yr'), 'pool_type' => $this->input->get('pool_type'), 'bill_no' => $this->input->get('billNo')), 1);
        
        if($rice->rice_type == 'P'){
            //Retrive Bill Details
            $select =   array(
                
                'bill_dt', 'paddy_qty', 'sub_tot_cmr_qty',
                
                'butta_cut', 'bill_no', 'comm_soc'
            
            );
        }
        else{
            $select =   array(
            
                'bill_dt', 'paddy_qty', 'sub_tot_cmr_qty',
                
                'butta_cut', 'bill_no', 'comm_soc'
            
            );
        }        

        $where  =   array(

            'rice_type' => $rice->rice_type,

            'pool_type' => $this->input->get('pool_type'),

            // 'kms_yr'    => $this->kms_year,
            'kms_yr'     => $this->session->userdata('kms_yr'),

            'bill_no'   => $this->input->get('billNo')

        );

        $data = (array) $this->Paddy->f_get_particulars("td_bill", $select, $where, 1);

        if($rice->rice_type == 'P'){
            unset($select);
            $select = array('boiled_val rate');
        }
        else{
            unset($select);
            $select = array('raw_val rate');
        }
        
        $res = (array) $this->Paddy->f_get_particulars("md_comm_params", $select, array('sl_no' => 8,"kms_yr"=>$this->session->userdata('kms_yr')), 1);

        echo json_encode((object) array_merge($data, $res));

    }
      //Bill Details
    public function f_billDetailscom(){

       // $rice = $this->Paddy->f_get_particulars('td_bill', array('rice_type'), array('kms_yr' => $this->kms_year, 'pool_type' => $this->input->get('pool_type'), 'bill_no' => $this->input->get('billNo')), 1);

         $rice = $this->Paddy->f_get_particulars('td_bill', array('rice_type'), array('kms_yr' => $this->session->userdata('kms_yr'), 'pool_type' => $this->input->get('pool_type'), 'bill_no' => $this->input->get('billNo')), 1);
        
        if($rice->rice_type == 'P'){
            //Retrive Bill Details
            $select =   array(
                
                'bill_dt', 'paddy_qty', 'sub_tot_cmr_qty',
                
                'butta_cut', 'bill_no', 'comm_soc'
            
            );
        }
        else{
            $select =   array(
            
                'bill_dt', 'paddy_qty', 'sub_tot_cmr_qty',
                
                'butta_cut', 'bill_no', 'comm_soc'
            
            );
        }        

        $where  =   array(

            'rice_type' => $rice->rice_type,

            'pool_type' => $this->input->get('pool_type'),

            // 'kms_yr'    => $this->kms_year,
            'kms_yr'     => $this->session->userdata('kms_yr'),

            'bill_no'   => $this->input->get('billNo')

        );

        $data = (array) $this->Paddy->f_get_particulars("td_bill", $select, $where, 1);

        if($rice->rice_type == 'P'){
            unset($select);
            $select = array('boiled_val rate');
        }
        else{
            unset($select);
            $select = array('raw_val rate');
        }
        
        $res = (array) $this->Paddy->f_get_particulars("md_comm_params", $select, array('sl_no' => 9,"kms_yr"=>$this->session->userdata('kms_yr')), 1);

        echo json_encode((object) array_merge($data, $res));

    }

    //Bill Master Details
    public function f_billMasterDetails(){

        if($this->input->get('riceType') == 'P'){
            
            $select = array('boiled_val val', 'action');


        }
        else{

            $select = array('raw_val val', 'action');

        }

        $where = array(
            'sl_no'  => $this->input->get('sl_no'),

            'kms_yr' =>$this->session->userdata('kms_yr')
        );

        $data = $this->Paddy->f_get_particulars("md_comm_params", $select, $where, 1);

        echo json_encode($data);
    }

    //Bill Master Details
    public function f_getDocuments(){

        //Retriving Document Details
        $data['doc_dtls']     =   $this->Paddy->f_doc_maintenance($this->input->get('bill_no'));        
            
        $this->load->view('payment/documents', $data);
        
    }

    /*********************For Society Commission Screen********************/
    #Society get commission from CONFED
    #This amounts are payble to Society
    //Retriving Society Commission from table td_commission_bill
    public function f_commission() {

        $commission['commission_dtls']    =   $this->Paddy->f_get_commissions();

        $this->load->view('post_login/main');

        $this->load->view("commission/dashboard", $commission);
        
        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

      // Confed Bill List
    public function f_confedbilllists(){

        $select =   array(
            
            'bill_no'

        );
                  
        $where  =   array(

            "kms_yr"     => $this->session->userdata('kms_yr'),

            'pool_type'  => $this->input->get('pool_type'),

            // 'rice_type'  => $this->input->get('rice_type'),

            "dist"      => $this->input->get('dist'),

            'block'     => $this->input->get('block'),

            'soc_id'    => $this->input->get('soc_id'),

            // 'mill_id'   => $this->input->get('mill_id')

        );

        $data = $this->Paddy->f_get_particulars("td_bill", $select, $where, 0);

        echo json_encode($data);

    }

    //New Commission Add in the table td_commission_bill
    public function f_commission_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $pmt_commission_no = 0;

            $max_trans_no = $this->Paddy->f_get_particulars("td_commission_bill", array("MAX(pmt_commission_no) pmt_commission_no"), array('kms_year'=>  $this->session->userdata('kms_yr')), 1);

            if($max_trans_no){

                $pmt_commission_no = $max_trans_no->pmt_commission_no + 1;

            }
            else {

                $pmt_commission_no = 1;

            }

            for($i = 0; $i < count($this->input->post('confed_bill_no')); $i++){

                $data_array[] = array(

                    "pmt_commission_no"     =>  $pmt_commission_no,
    
                    "trans_dt"              =>  $this->input->post('trans_dt'),
    
                    // "kms_year"              =>  $this->kms_year,
                    "kms_year"              => $this->session->userdata('kms_yr'),

                    "soc_id"                =>  $this->input->post('soc_name'),
    
                    "dist"                  =>  $this->input->post('dist'),

                    "tot_paddy"             =>  $this->input->post('totPaddy'),
    
                    "con_bill_no"           =>  $this->input->post('confed_bill_no')[$i],

                    "con_bill_dt"           =>  $this->input->post('confed_bill_date')[$i],
    
                    "soc_bill_no"           =>  $this->input->post('soc_bill_no')[$i],
    
                    "soc_bill_dt"           =>  $this->input->post('soc_bill_date')[$i],
    
                    "paddy_qty"             =>  $this->input->post('qty_paddy')[$i],
    
                    "rate_per_qtls"         =>  $this->input->post('rate')[$i],
    
                    "value"                 =>  $this->input->post('value')[$i],
                    
                    "pool_type"             =>  $this->input->post('pool_type'),
    
                    "created_by"            =>  $this->session->userdata('loggedin')->user_name,
    
                    "created_dt"            =>  date('Y-m-d h:i:s')
    
                );

            }

            $this->Paddy->f_insert_multiple('td_commission_bill', $data_array);

            unset($data_array);

            $data_array = array(

                "pmt_commission_no"     =>  $pmt_commission_no,

                "trans_dt"              =>  $this->input->post('trans_dt'),

                "tds_percentage"        =>  $this->input->post('tds_percentage'),

                "deducted_amt"          =>  $this->input->post('deducted_amt'),

                "payble_amt"            =>  $this->input->post('ultimate_payble'),

                "kms_year"              => $this->session->userdata('kms_yr')

            );

            $this->Paddy->f_insert('td_commission_bill_dtls', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/commission');

        }
        else {

            //District List
            $commission['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //Bill Master Details
            $commission['bill_master']   =   $this->Paddy->f_get_particulars("md_comm_params", array('sl_no', 'param_name'), array('kms_year' =>$this->session->userdata('kms_yr')), 0);

            $this->load->view('post_login/main');

            $this->load->view("commission/add", $commission);

            $this->load->view('post_login/footer');

        }
        
    }

    //Commission edit in the td_commission_bill
    public function f_commission_edit() {
     
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $where = array('pmt_commission_no' => $this->input->post('pmt_commission_no'),'kms_year' =>$this->session->userdata('kms_yr'));

            $this->Paddy->f_delete('td_commission_bill', $where);
            $this->Paddy->f_delete('td_commission_bill_dtls', $where);

            for($i = 0; $i < count($this->input->post('confed_bill_no')); $i++){

                $data_array[] = array(
                    
                    "pmt_commission_no"     =>  $this->input->post('pmt_commission_no'),
                    
                    "trans_dt"              =>  $this->input->post('trans_dt'),
    
                    // "kms_year"              =>  $this->kms_year,
                    "kms_year"              => $this->session->userdata('kms_yr'),

                    "soc_id"                =>  $this->input->post('soc_name'),
    
                    "dist"                  =>  $this->input->post('dist'),

                    "tot_paddy"             =>  $this->input->post('totPaddy'),
    
                    "con_bill_no"           =>  $this->input->post('confed_bill_no')[$i],

                    "con_bill_dt"           =>  $this->input->post('confed_bill_date')[$i],
    
                    "soc_bill_no"           =>  $this->input->post('soc_bill_no')[$i],
    
                    "soc_bill_dt"           =>  $this->input->post('soc_bill_date')[$i],
    
                    "paddy_qty"             =>  $this->input->post('qty_paddy')[$i],
    
                    "rate_per_qtls"         =>  $this->input->post('rate')[$i],
    
                    "value"                 =>  $this->input->post('value')[$i],
                    
                    "pool_type"             =>  $this->input->post('pool_type'),
    
                    "modified_by"            =>  $this->session->userdata('loggedin')->user_name,
    
                    "modified_dt"            =>  date('Y-m-d h:i:s')
    
                );
                
            }

            $this->Paddy->f_insert_multiple('td_commission_bill', $data_array);

            unset($data_array);

            $data_array = array(

                "pmt_commission_no"     =>  $this->input->post('pmt_commission_no'),

                "trans_dt"              =>  $this->input->post('trans_dt'),

                "tds_percentage"        =>  $this->input->post('tds_percentage'),

                "deducted_amt"          =>  $this->input->post('deducted_amt'),

                "payble_amt"            =>  $this->input->post('ultimate_payble'),

                "kms_year"              => $this->session->userdata('kms_yr')

            );


            $this->Paddy->f_insert('td_commission_bill_dtls', $data_array);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/commission');


        }
        else {

            //District List
            $commission['dist']            =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //Retriving Bill Commission Details
            $commission['commission_dtls']    =   $this->Paddy->f_get_commission($this->input->get('pmt_commission_no'));

            //Bill Details
            $select =  array(

                "con_bill_no", "con_bill_dt", 
                "paddy_qty", "soc_bill_no", "soc_bill_dt",
                "paddy_qty", "rate_per_qtls", "value"

            );

            $where  =   array(
             
                "pmt_commission_no"   => $this->input->get('pmt_commission_no'),
                "kms_year"      => $this->session->userdata('kms_yr')
            );

            $commission['bill_dtls']    =   $this->Paddy->f_get_particulars("td_commission_bill", $select, $where, 0);
            
            //Charges for Bill Commission
            unset($select);
            $select =  array(

                "tds_percentage", "deducted_amt", "payble_amt"

            );
            
            $commission['charges']    =   $this->Paddy->f_get_particulars("td_commission_bill_dtls", $select, $where, 0);

            $this->load->view('post_login/main');

            $this->load->view("commission/edit", $commission);

            $this->load->view('post_login/footer');

        }
        
    }

    //Commission delete
    public function f_commission_delete() {

        $where = array(
            
            "pmt_commission_no"    =>  $this->input->get('sl_no'),
            "kms_year"      => $this->session->userdata('kms_yr')
            
        );

        $this->Paddy->f_delete('td_commission_bill', $where);
        $this->Paddy->f_delete('td_commission_bill_dtls', $where);

        $this->session->set_flashdata('msg', 'Successfully Deleted!');

        redirect("paddy/commission");

    }

    /*********************For Paid Screen********************/
    #Final Payment against bill(s) 

    //Retriving Paid List against bill(s) from table td_paid_dtls
    public function f_paid() {
        
        //Retrive Unapprove Pay
        $select = array(
            "paid_no", "payment_dt", 
            "total_payble", "amount", "MAX(paid_no)"
        );

        $where  = array(

            "approval_status = 'U' GROUP BY paid_no, payment_dt, total_payble, amount" => NULL
        );

        $paid['pay_dtls']     =   $this->Paddy->f_get_particulars("td_paid_dtls", $select, $where, 0);        
        // echo $this->db->last_query();
        // die();
        $this->load->view('post_login/main');

        $this->load->view("paid/dashboard", $paid);

        $this->load->view('post_login/footer');
        
    }

    //New Paid amount Add in the table td_paid_dtls against Bill(s)
    public function f_paid_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $max_trans_no = $this->Paddy->f_get_particulars("td_paid_dtls", array("MAX(paid_no) paid_no"), NULL, 1);
            
            $data_array = array(

                "payment_dt"           =>  $this->input->post('trans_dt'),

                "paid_no"              =>  ($max_trans_no)? ($max_trans_no->paid_no + 1) : 1,
                
                // "kms_year"             =>  $this->kms_year,

                "kms_year"      => $this->session->userdata('kms_yr'),

                // "pool_type"            =>  $this->input->post('pool_type'),
                
                "total_payble"         =>  $this->input->post('payble_amt') - $this->input->post('paid_amt'),

                "amount"               =>  $this->input->post('paid_amt'),

                "trans_type"           =>  $this->input->post('trans_type'),

                "chq_no"               =>  $this->input->post('chq_no'),

                "chq_dt"               =>  $this->input->post('chq_dt'),

                "bank"                 =>  $this->input->post('bank'),

                "created_by"           =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"           =>  date('Y-m-d h:i:s')

            );
            
            $this->Paddy->f_insert('td_paid_dtls', $data_array);

            
            $bills = explode(',', $this->genBills($this->input->post('bill_nos')));
           
            unset($data_array);

            for($i = 0; $i < count($bills); $i++){
            
                $data_array[] = array(

                    "paid_no"      =>  ($max_trans_no)? ($max_trans_no->paid_no + 1) : 1,
                    "bill_no"      =>  $bills[$i],
                    // "kms_year"     =>  $this->kms_year,
                    "kms_year"      => $this->session->userdata('kms_yr'),
                    "pool_type"    =>  $this->input->post('pool_type'),

                );
            
            }
            $this->Paddy->f_insert_multiple("td_paid_bill_dtls", $data_array);
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/paid');
        }
        else {

            //District List
            $paid['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            //Bank List
            $paid['bank']	 =   $this->Paddy->f_get_particulars("md_bank", NULL, NULL, 0);			
        
            $this->load->view('post_login/main');

            $this->load->view("paid/add", $paid);

            $this->load->view('search/search');

            $this->load->view('post_login/footer');

        }
        
    }
    

    //Payble Amount against Bill(s)
    public function f_payble(){

        $select =   array(
            
            'tm.paid_no, tm.total_payble 
             FROM td_paid_dtls tm, td_paid_bill_dtls td 
             WHERE tm.paid_no = td.paid_no
             AND td.pool_type =  "'.$this->input->get("pool_type").'"
             AND td.bill_no IN ('.$this->genBills($this->input->get("bill_nos")).') 
             ORDER BY tm.paid_no DESC LIMIT 0,1'

        );

        $data = $this->Paddy->f_get_particulars(NULL, $select, NULL, 1);

        if(!$data){
            unset($select);
            
            $select =   array(
            
                '(SELECT SUM(payble_amt) FROM (SELECT pb.pmt_bill_no, SUM(pd.payble_amt) payble_amt
                    FROM td_payment_bill pb, td_payment_bill_dtls pd, td_bill tb
                    WHERE pb.pmt_bill_no = pd.pmt_bill_no
                    AND pb.con_bill_no = tb.bill_no
                    AND tb.pool_type = "'.$this->input->get("pool_type").'"
                    AND pb.con_bill_no IN ('.$this->genBills($this->input->get("bill_nos")).')
                    GROUP BY pb.pmt_bill_no) t) - (SELECT SUM(paddy_butta)
                    FROM `td_payment_bill` WHERE `con_bill_no` IN ('.$this->genBills($this->input->get("bill_nos")).')) total_payble'
    
            );
        
            $data = $this->Paddy->f_get_particulars(NULL, $select, NULL, 1);

            echo $data->total_payble;

        }
        else{
            echo $data->total_payble;
        }

    }

    //Check Bill No Present or Not
    public function f_checkbills() {
        $kms_year=$this->session->userdata('kms_yr');
        $true_bills = $this->Paddy->f_check_bill_no($this->genBills($this->input->get("bill_nos")), $this->input->get("pool_type"),$this->session->userdata('kms_yr'));

        echo json_encode(array_map(function($data){ return $data->bill_no;}, $true_bills));

    }

    //Payble Bill NO
    public function f_paybleChekBills(){
        
        $true_bills = $this->Paddy->f_payble_bill_no($this->genBills($this->input->get("bill_nos")), $this->input->get("pool_type"), $this->session->userdata('kms_yr'));
        // echo $this->db->last_query();
        // die();
        echo json_encode(array_map(function($data){ return $data->bill_no;}, $true_bills));
        
    }

    //Paid amount edit
    public function f_paid_edit() {
        $kms_year=$this->session->userdata('kms_yr');
        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "payment_dt"           =>  $this->input->post('trans_dt'),

                "amount"               =>  $this->input->post('paid_amt'),

                "trans_type"           =>  $this->input->post('trans_type'),

                "chq_no"               =>  $this->input->post('chq_no'),

                "chq_dt"               =>  $this->input->post('chq_dt'),

                "bank"                 =>  $this->input->post('bank'),

                "modified_by"          =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"          =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "paid_no"     =>  $this->input->post('paid_no'),
                "kms_year"      => $this->session->userdata('kms_yr')
                
            );

            //For notification storing message
            $this->Paddy->f_edit('td_paid_dtls', $data_array, $where);

            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/paid');

        }
        else {

            $paid['paid_dtls']     =   $this->Paddy->f_get_paids($this->input->get('paid_no'));
            // echo $this->db->last_query();
            // die();
            $data                  =   $this->Paddy->f_get_particulars("td_paid_bill_dtls", array('bill_no'), array('paid_no' => $this->input->get('paid_no'), 'kms_year' => $this->session->userdata('kms_yr')), 0);			
            
            $paid['bills']         =   array_map(function($data){ return $data->bill_no;}, $data);

            //Bank List
            $paid['bank']	       =   $this->Paddy->f_get_particulars("md_bank", NULL, NULL, 0);			
        
            $this->load->view('post_login/main');

            $this->load->view("paid/edit", $paid);

            $this->load->view('post_login/footer');

        }
        
    }

    //Generate Bill nos
    public function genBills($bill_nos){

        if(strpos($bill_nos, '-') !== false) {
            $bill_nos = explode('-', $bill_nos);
            $bills = $bill_nos[0];
            for($i = 1; $i <= $bill_nos[1] - $bill_nos[0]; $i++){
                $bills .= ','.($bill_nos[0] + $i);
            }
        }
        else{
            $bills = $bill_nos;
        }

        return $bills;
    }

    //Paid Delete
    public function f_paid_delete(){
        
        $where  =   array(

            "paid_no"        =>  $this->input->get('paid_no')
            
        );
        
        $this->Paddy->f_delete('td_paid_dtls', $where);

        //For notification storing message
        $this->session->set_flashdata('msg', 'Successfully deleted!');

        redirect("paddy/paid");
        
    }

    /*********************For Payment Received Screen********************/
    #Finally CONFED get there commission for monitaring paddy procurement to cmr delivery to govt. godown
    //List of payment received from govt. from the table td_payment_received
    public function f_payment_received() {
        
        //Retrive Submited Bills
        $select = array(
            "received_no", "received_date", 
            "receivable_amt", "tot_amt"
        );

        $payment_received['received']     =   $this->Paddy->f_get_particulars("td_payment_received", $select, NULL, 0);        

        $this->load->view('post_login/main');

        $this->load->view("received/dashboard", $payment_received);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');
        
    }

    //New Payment Received Add in the table 
    public function f_paymentreceived_add() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $max_trans_no = $this->Paddy->f_get_particulars("td_payment_received", array("MAX(received_no) received_no"), NULL, 1);
            
            $data_array = array(

                "received_date"        =>  $this->input->post('trans_dt'),

                "received_no"          =>  ($max_trans_no)? ($max_trans_no->received_no + 1) : 1,
                
                // "kms_year"             =>  $this->kms_year,

                "kms_year"      => $this->session->userdata('kms_yr'),
                
                "pool_type"            =>  $this->input->post('pool_type'),
                
                "payment_type"         =>  $this->input->post('payment_type'),
                
                "payment_for"          =>  $this->input->post('payment_for'),
                
                "receivable_amt"       =>  $this->input->post('receivable_amt') - $this->input->post('received_amt'),

                "tot_amt"              =>  $this->input->post('received_amt'),

                "created_by"           =>  $this->session->userdata('loggedin')->user_name,

                "created_dt"           =>  date('Y-m-d h:i:s')

            );
            
            $this->Paddy->f_insert('td_payment_received', $data_array);
            
            $payments = ($this->input->post('bill_nos') != '')? explode(',', $this->genBills($this->input->post('bill_nos'))) : NULL;

            unset($data_array);

            for($i = 0; $i < count($payments); $i++){
            
                $data_array[] = array(

                    "received_no"    =>  ($max_trans_no)? ($max_trans_no->received_no + 1) : 1,
                    "bill_no"      =>  $payments[$i],
                    // "kms_year"     =>  $this->kms_year,
                    "kms_year"      => $this->session->userdata('kms_yr'),
                    "pool_type"    =>  $this->input->post('pool_type'),
                    
                );
            
            }

            if(isset($data_array)){
                $this->Paddy->f_insert_multiple("td_received_bill_dtls", $data_array);
            }
            
            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully added!');

            redirect('paddy/payment_received');
        }
        else {

            //District List
            $received['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("received/add", $received);

            $this->load->view('post_login/footer');

        }
        
    }

    //Bill Existance for payment received
    public function f_received_billexsists(){
        $data['submit'] = array_map(function($value){return $value->bill_no;}, $this->Paddy->f_exsists('td_submitted_bill_dtls', $this->genBills($this->input->get('bill_nos')), $this->input->get('pool_type'), $this->session->userdata('kms_yr')));
        
        echo  json_encode($data); 
    }

    //Total Recevable after billing
    public function f_receivable(){
        $data = $this->Paddy->f_getReceivable($this->genBills($this->input->get('bill_nos')), $this->kms_year);
        if($data){
            echo $data->receivable_amt;
        }
        else{
            echo $this->f_billamount();
        }
    }

    //Received Payment edit
    public function f_paymentreceived_edit() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {

            $data_array = array(

                "received_date"        =>  $this->input->post('trans_dt'),
                
                "payment_type"         =>  $this->input->post('payment_type'),
                
                "payment_for"          =>  $this->input->post('payment_for'),

                "modified_by"          =>  $this->session->userdata('loggedin')->user_name,

                "modified_dt"          =>  date('Y-m-d h:i:s')

            );

            $where  =   array(

                "received_no"     =>  $this->input->post('received_no')
                
            );

            $this->Paddy->f_edit('td_payment_received', $data_array, $where);

            //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully edited!');

            redirect('paddy/payment_received');

        }
        else {

            $where = array(
                'kms_year'      =>  $this->session->userdata('kms_yr'),
                // 'kms_year'    => $this->kms_year,
                'received_no' => $this->input->get('received_no')
            
            );

            $received['received_dtls'] = $this->Paddy->f_get_particulars("td_payment_received", NUll, $where, 1);        

            $received['bills']    = array_map(function($val){return $val->bill_no;}, $this->Paddy->f_get_particulars("td_received_bill_dtls", array('bill_no'), $where, 0));        

            //District List
            $received['dist']    =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("received/edit", $received);

            $this->load->view('post_login/footer');

        }
    }

    /*************************REPORTS**************************/

    //Individual Society Report
    public function f_socindvidual_report(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Transaction Details
            $select = array (

                "trans_cd", "trans_dt", "mill_id",
                "dist", "block", "camp_no", "farmer_no",
                "progressive", "delivared_to_mill","resultant_cmr",
                "cmr_offered", "do_isseue", "cmr_delivered"
                
            );

            $where  =   array( 
                
                "soc_id" => $this->input->post('soc_id'),

                "trans_dt BETWEEN '". $this->input->post('from_date')."' AND '". $this->input->post('to_date'). "'" => NULL,

                "approval_status"   => 'A'
                
            );

            $socindvidual['socdata']    =   $this->Paddy->f_get_particulars("td_transaction", $select, $where, 0);

            //Retriving Society Details
            unset($select);
            $select     =   array( "sl_no", "soc_name" );

            $socindvidual['soc_names']  =   $this->Paddy->f_get_particulars("md_society", $select, NULL, 0);

            //Mill List
            $socindvidual['mill']       =   $this->Paddy->f_get_particulars("md_mill", array("sl_no", "mill_name"), NULL, 0);
            
            //District List
            $socindvidual['dist']       =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
            
            //Block List
            $socindvidual['block']      =   $this->Paddy->f_get_particulars("md_block", NULL, NULL, 0);
           
            $this->load->view('post_login/main');

            $this->load->view("reports/socindvidual", $socindvidual);

            $this->load->view('post_login/footer');

        }
        else{

            //For Current Date
            $socindvidual['sys_date']   =   $_SESSION['sys_date'];

            //Retriving Society Details
            $select     =   array( "sl_no", "soc_name" );

            $socindvidual['soc_names']  =   $this->Paddy->f_get_particulars("md_society", $select, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/socindvidual", $socindvidual);

            $this->load->view('post_login/footer');

        }

    }
//paddy declaretion


    //District Wise Paddy Report
    public function f_distwise_report(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            

            $from_date = $this->input->post('year').'-'.date('m', strtotime($this->input->post('month'))).'-01';

            $to_date   = $this->input->post('year').'-'.date('m', strtotime($this->input->post('month'))).'-31';

            //Dist Group Count
            $distwise['dist_grp_cnt']       =   $this->Paddy->f_get_dist_group_count($from_date, $to_date);

            //Distinct Society Name
            $distwise['soc_names']          =   $this->Paddy->f_get_distinct("td_collections", array("soc_id", "dist"), array( "trans_dt BETWEEN '$from_date' AND '$to_date'" => NULL, "approval_status"   =>  'A'), 0);
            
            //Society name wist paddy details
            $distwise['distwise_dtls']      =   $this->Paddy->f_get_distwise($from_date, $to_date);

            //Society List
            $distwise['soc']                =   $this->Paddy->f_get_particulars("md_society", array("sl_no", "soc_name"), NULL, 0);
                
            //Mill List
            $distwise['mill']               =   $this->Paddy->f_get_particulars("md_mill", array("sl_no", "mill_name"), NULL, 0);
            
            //District List
            $distwise['dist']               =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
            
            $this->load->view('post_login/main');

            $this->load->view("reports/distwise", $distwise);

            $this->load->view('post_login/footer');

        }

        else {

            //Month List
            $distwise['month_list'] =   $this->Paddy->f_get_particulars("md_month",NULL, NULL, 0);

            //For Current Date
            $distwise['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("reports/distwise", $distwise);

            $this->load->view('post_login/footer');

        }

    }


    //Block Wise Paddy Report
    public function f_blockwise_report(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $from_date = $this->input->post('year').'-'.date('m', strtotime($this->input->post('month'))).'-01';

            $to_date   = $this->input->post('year').'-'.date('m', strtotime($this->input->post('month'))).'-31';

            //Dist Group Count
            $blockwise['block_grp_cnt']         =   $this->Paddy->f_get_block_group_count($from_date, $to_date);

            //Distinct Society Name
            $blockwise['soc_names']             =   $this->Paddy->f_get_distinct("td_transaction", array("soc_id", "block"), array( "trans_dt BETWEEN '$from_date' AND '$to_date'" => NULL, "approval_status"   =>  'A'), 0);
            
            //Society name wist paddy details
            $blockwise['blockwise_dtls']        =   $this->Paddy->f_get_blockwise($from_date, $to_date);

            //Society List
            $blockwise['soc']                   =   $this->Paddy->f_get_particulars("md_society", array("sl_no", "soc_name"), NULL, 0);
                
            //Mill List
            $blockwise['mill']                  =   $this->Paddy->f_get_particulars("md_mill", array("sl_no", "mill_name"), NULL, 0);
            
            //Block List
            $blockwise['block']                 =   $this->Paddy->f_get_particulars("md_block", NULL, NULL, 0);
           
            $this->load->view('post_login/main');

            $this->load->view("reports/blockwise", $blockwise);

            $this->load->view('post_login/footer');

        }

        else {

            //Month List
            $blockwise['month_list'] =   $this->Paddy->f_get_particulars("md_month", NULL, NULL, 0);

            //For Current Date
            $blockwise['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("reports/blockwise", $blockwise);

            $this->load->view('post_login/footer');

        }

    }

    //Date Wise Paddy Report With Rice Mill
    public function f_datewiseprocurement_report(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Count Distinct Society group by Society
            $select =   array(

                "t.dist", "m.district_name", "SUM(t.count) count"

            );  

            $sql = "SELECT dist, soc_id, count(DISTINCT mill_id) count FROM td_received WHERE trans_dt BETWEEN '".$this->input->post('from_date')."' AND '".$this->input->post('to_date')."' GROUP BY dist, soc_id"; 

            $where  =   array(

                "m.district_code = t.dist GROUP BY t.dist" => NULL,

            );

            $data['dist_dtls'] =   $this->Paddy->f_mill_count($this->input->post('from_date'), $this->input->post('to_date'));
            
            //Society Name wise collection
            unset($select);
            unset($where);
            unset($sql);

            $select =   array(

                "t.dist", "r.soc_id", "m.soc_name", "r.farmer_no", "t.no_of_camp",

                "t.no_of_farmer", "t.paddy_qty", "d.count"

            );

            //Total Register Farmer
            $sql  = "SELECT soc_id, SUM(farmer_no) farmer_no FROM td_reg_farmer GROUP BY soc_id";

            //Total camp, farmer, paddy collection
            $sql1 = "SELECT soc_id,
                           dist,
                           SUM(no_of_camp) no_of_camp,
                           SUM(no_of_farmer) no_of_farmer,
                           SUM(paddy_qty) paddy_qty
                                                    FROM td_collections WHERE trans_dt BETWEEN '".$this->input->post('from_date')."' AND '".$this->input->post('to_date')."' 
                                                    GROUP BY soc_id, dist";
            //Mill Id Society wise
            $sql2 = "SELECT dist, soc_id, count(DISTINCT mill_id) count FROM td_received WHERE trans_dt BETWEEN '".$this->input->post('from_date')."' AND '".$this->input->post('to_date')."' GROUP BY dist, soc_id"; 

            $where = array(

                "m.sl_no = r.soc_id"    => NULL,

                "m.sl_no = t.soc_id"    => NULL,

                "m.sl_no = d.soc_id"    => NULL,

            );

            $data['soc_dtls'] =   $this->Paddy->f_get_particulars("md_society m, ($sql) r, ($sql1) t, ($sql2) d", $select, $where, 0);

            //Society wise Paddy Distribution
            unset($select);
            unset($where);
            unset($sql);

            $select =   array(

                "t.soc_id", "m.mill_name", "t.count"

            );

            $where  =   array(

                "t.mill_id = m.sl_no" =>  NULL

            );

            $sql = "SELECT soc_id, mill_id, SUM(paddy_qty) count FROM td_received GROUP BY soc_id, mill_id ORDER BY soc_id";

            $data['mill_dtls'] =   $this->Paddy->f_get_particulars("md_mill m, ($sql) t", $select, $where, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/dtWiseProcurement", $data);

            $this->load->view('post_login/footer');

        }

        else {

            //For Current Date
            $blockwise['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("reports/dtWiseProcurement", $blockwise);

            $this->load->view('post_login/footer');

        }

    }

    //Districtwise & Societywise Total Procurement Report
    /*public function f_procurement_report(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $from_date  =   $this->input->post('from_date');

            $to_date    =   $this->input->post('to_date');

            $data['proc_dtls'] =   $this->Paddy->f_get_procurements($from_date,$to_date);

            $data['farm_dtls'] =   $this->Paddy->f_get_registered_farmer($from_date,$to_date);
            
            $this->load->view('post_login/main');

            $this->load->view("reports/procurement", $data);

            $this->load->view('post_login/footer');

        }

        else {

            //For Current Date
            $blockwise['sys_date']   =   $_SESSION['sys_date'];

            $blockwise['kms']        =   $this->Paddy->f_get_particulars("mm_kms_yr",Null, Null, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/procurement", $blockwise);

            $this->load->view('post_login/footer');

        }

    }*/
//Wqsc details report (billno wise)
//Procurement to Delivery Report
/*public function f_wqscdetails_report(){

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $poolType       =   $this->input->post('pool_type');

        $billNo         =   $this->input->post('bill_no');

        $select         =   array(
            "pool_type","dis_cd","wqsc_no","analysis_no",
            "bill_no","trn_dt","no_bags","qty","remarks",
            "kms_yr"
        );

        $where          =   array(
            "pool_type"     =>  $poolType,

            "bill_no"       =>  $billNo

        );

        $select1        =   array(
            "district_code","district_name"
        );

        $data['wqsc']   =   $this->Paddy->f_get_particulars('td_wqsc_sheet',$select,$where,0);

        $data['dist']   =   $this->Paddy->f_get_particulars('md_district',$select1,NULL,0);

      
        $this->load->view('post_login/main');

        $this->load->view("reports/wqscdetails", $data);

        $this->load->view('post_login/footer');

    }

    else {

        //For Current Date
        $blockwise['sys_date']   =   $_SESSION['sys_date'];

        $this->load->view('post_login/main');

        $this->load->view("reports/wqscdetails", $blockwise);

        $this->load->view('post_login/footer');

    }

}*/

    //Procurement to Delivery Report
    /*public function f_proctodelivery_report(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Count Distinct Society group by Society
            $select =   array(

                "t.dist", "m.district_name", "SUM(t.count) count"

            );  

            $sql = "SELECT dist, soc_id, count(DISTINCT mill_id) count FROM td_received WHERE trans_dt BETWEEN '".$this->input->post('from_date')."' AND '".$this->input->post('to_date')."' GROUP BY dist, soc_id"; 

            $where  =   array(

                "m.district_code = t.dist GROUP BY t.dist" => NULL,

            );


            $data['dist_dtls'] =   $this->Paddy->f_mill_count($this->input->post('from_date'), $this->input->post('to_date'));
            
            //Society Name wise collection
            unset($select);
            unset($where);
            unset($sql);

            $select =   array(

                "t.dist", "r.soc_id", "m.soc_name", "r.farmer_no", "t.no_of_camp",

                "t.no_of_farmer", "t.paddy_qty", "d.count"

            );

            //Total Register Farmer
            $sql  = "SELECT soc_id, SUM(farmer_no) farmer_no FROM td_reg_farmer GROUP BY soc_id";

            //Total camp, farmer, paddy collection
            $sql1 = "SELECT soc_id,
                            dist,
                            SUM(no_of_camp) no_of_camp,
                            SUM(no_of_farmer) no_of_farmer,
                            SUM(paddy_qty) paddy_qty
                                                    FROM td_collections WHERE trans_dt BETWEEN '".$this->input->post('from_date')."' AND '".$this->input->post('to_date')."' 
                                                    GROUP BY soc_id, dist";
            //Mill Id Society wise
            $sql2 = "SELECT dist, soc_id, count(DISTINCT mill_id) count FROM td_received WHERE trans_dt BETWEEN '".$this->input->post('from_date')."' AND '".$this->input->post('to_date')."' GROUP BY dist, soc_id"; 
            
            $where = array(

                "m.sl_no = r.soc_id"    => NULL,

                "m.sl_no = t.soc_id"    => NULL,

                "m.sl_no = d.soc_id"    => NULL,

            );

            $data['soc_dtls'] =   $this->Paddy->f_get_particulars("md_society m, ($sql) r, ($sql1) t, ($sql2) d", $select, $where, 0);

            
            //Society wise Paddy Distribution
            unset($select);
            unset($where);
            unset($sql);
            unset($sql1);
            unset($sql2);

            $select =   array(

                "dist.soc_id", "dist.mill_id", "m.mill_name",
                
                "dist.distribute"

            );

            $where  =   array(

                "m.sl_no = dist.mill_id" =>  NULL
                
            );

            //Paddy distribution
            $sql = "SELECT soc_id, mill_id, ifnull(SUM(paddy_qty), 0) distribute FROM td_received WHERE trans_dt BETWEEN '".$this->input->post('from_date')."' AND '".$this->input->post('to_date')."'
                    GROUP BY soc_id, mill_id ORDER BY soc_id";

            $data['mill_dtls']   =   $this->Paddy->f_get_particulars("md_mill m, ($sql) dist", $select, $where, 0);


            foreach($data['mill_dtls'] as $key => $list){

                $details = $this->Paddy->f_get_paddy_dtls($list->soc_id, $list->mill_id);

                $data['mill_dtls'][$key] = (object)array_merge((array)$data['mill_dtls'][$key], $details);
                
            }

            $this->load->view('post_login/main');

            $this->load->view("reports/proctodelivery", $data);

            $this->load->view('post_login/footer');

        }

        else {

            //For Current Date
            $blockwise['sys_date']   =   $_SESSION['sys_date'];

            $this->load->view('post_login/main');

            $this->load->view("reports/proctodelivery", $blockwise);

            $this->load->view('post_login/footer');

        }

    }*/

    //Procurement to Delivery Report
    /*public function f_proctodelivery_report(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $from_date  =   $this->input->post('from_date');

            $to_date    =   $this->input->post('to_date');

            $data['mill_dtls']      =  $this->Paddy->f_get_paddy_dtls($from_date,$to_date);

            $data['reg_farm']       =  $this->Paddy->f_get_registered_farmer($from_date,$to_date);

            $data['paddy_proc']     =  $this->Paddy->f_get_proc_paddy($from_date,$to_date);

            $data['cmr_offer']      =  $this->Paddy->f_get_cmr_offered($from_date,$to_date);

            $data['do_issue']       =  $this->Paddy->f_get_do_issued($from_date,$to_date);

            $data['cmr_deliver']    =  $this->Paddy->f_get_cmr_deliver($from_date,$to_date);

            $data['to_deliver']     =  $this->Paddy->f_get_to_deliver($from_date,$to_date);

            $this->load->view('post_login/main');

            $this->load->view("reports/proctodelivery", $data);

            $this->load->view('post_login/footer');

        }

        else {

            //For Current Date
            $blockwise['sys_date']   =   $_SESSION['sys_date'];

            $blockwise['kms']        =   $this->Paddy->f_get_particulars("mm_kms_yr",Null, Null, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/proctodelivery", $blockwise);

            $this->load->view('post_login/footer');

        }

    }*/

    public function f_kms(){

        $where      =   array(

            "sl_no"  => $this->input->get('kms_yr')
        );

        $kms       =   $this->Paddy->f_get_particulars("mm_kms_yr",Null, $where, 0);

        echo json_encode($kms);
        
    }


    /**Mandi Labour charge -- Anex - IV */
    /*public function f_labour_charge(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $where  =   array(

              "bill_no"    =>  $this->input->post('bill_no'),

              "pool_type"  =>  $this->input->post('pool_type'),
                           
              "kms_yr"     => $this->session->userdata('kms_yr')
            );

             $wheres  =   array(

              "sl_no"    =>  "3"

             );


            $bill['bill_dtls']   =  $this->Paddy->f_get_particulars("td_bill",NULL, $where, 1); 

            $bill['mandi_chrg'] = $this->Paddy->f_get_particulars("md_comm_params",NULL,$wheres, 1);


            $this->load->view('post_login/main');

            $this->load->view("reports/mandi_labour_charge", $bill);

            $this->load->view('post_login/footer');

        }
        else{

            $this->load->view('post_login/main');

            $this->load->view("reports/mandi_labour_charge");

            $this->load->view('post_login/footer');

        }

    }*/

    /**Society Commission Anex - VI A */            
    /*public function f_society_commision(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
             $select = array (
                "s.soc_name",
                "t.*"

            );
            
            $where  =   array(

              "t.soc_id = s.sl_no" => NULL,    

              "t.bill_no"    =>  $this->input->post('bill_no'),

              "t.pool_type"  =>  $this->input->post('pool_type'),
                           
              "t.kms_yr"     => $this->session->userdata('kms_yr')
            );

             $wheres  =   array(

              "sl_no"    =>  "9"

             );

            $bill['bill_dtls']   =  $this->Paddy->f_get_particulars("td_bill t,md_society s",NULL, $where, 1);    

            $bill['mandi_chrg'] = $this->Paddy->f_get_particulars("md_comm_params",NULL,$wheres, 1);

            $this->load->view('post_login/main');

            $this->load->view("reports/society_commision", $bill);

            $this->load->view('post_login/footer');

        }
        else{

            $this->load->view('post_login/main');

            $this->load->view("reports/society_commision");

            $this->load->view('post_login/footer');

        }

    }*/

    /**Milling charges Anex - VII */
     /*public function f_mill_commision(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Retriving Bill Details
             $select = array (
                "s.mill_name","s.mill_addr",
                "t.*"

            );
            
            $where  =   array(

              "t.mill_id = s.sl_no" => NULL,    

              "t.bill_no"    =>  $this->input->post('bill_no'),

              "t.pool_type"  =>  $this->input->post('pool_type'),
                           
              "t.kms_yr"     => $this->session->userdata('kms_yr')
            );

             $wheres  =   array(

              "sl_no"    =>  "10"

             );

             $selectWqsc    =   array(
                "max(wqsc_no)wqsc_no"
            );


            $whereWqsc     =   array(

               "bill_no"   =>  $this->input->post('bill_no'),
                
               "pool_type" =>  $this->input->post('pool_type'),

               "kms_yr"     => $this->session->userdata('kms_yr')
            );

            $bill['bill_dtls']   =  $this->Paddy->f_get_particulars("td_bill t,md_mill s",NULL, $where, 1);    

            $bill['mandi_chrg'] = $this->Paddy->f_get_particulars("md_comm_params",NULL,$wheres, 1);

            $bill['wqsc']       = $this->Paddy->f_get_particulars("td_wqsc_sheet",$selectWqsc,$whereWqsc, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("reports/mill_commision", $bill);

            $this->load->view('post_login/footer');

        }
        else{

            $this->load->view('post_login/main');

            $this->load->view("reports/mill_commision");

            $this->load->view('post_login/footer');

        }

    }*/

    /**Gunny Bag charges Anex - VIII */
    /*public function f_claim_gunny(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Retriving Bill Details
             $select = array (
                "s.mill_name","s.mill_addr",
                "t.*"

            );
            
            $where  =   array(

              "t.mill_id = s.sl_no" => NULL,    

              "t.bill_no"    =>  $this->input->post('bill_no'),

              "t.pool_type"  =>  $this->input->post('pool_type'),
                           
              "t.kms_yr"     => $this->session->userdata('kms_yr')
            );

             $wheres  =   array(

              "sl_no"    =>  "16"

             );

             $selectWqsc    =   array(
                 "max(wqsc_no)wqsc_no"
             );


             $whereWqsc     =   array(

                "bill_no"   =>  $this->input->post('bill_no'),
                 
                "pool_type" =>  $this->input->post('pool_type'),

                "kms_yr"     => $this->session->userdata('kms_yr')
             );

            $bill['bill_dtls']   =  $this->Paddy->f_get_particulars("td_bill t,md_mill s",NULL, $where, 1); 

            $bill['mandi_chrg'] = $this->Paddy->f_get_particulars("md_comm_params",NULL,$wheres, 1);

            $bill['wqsc']       = $this->Paddy->f_get_particulars("td_wqsc_sheet",$selectWqsc,$whereWqsc, 1);

            

            
            $this->load->view('post_login/main');

            $this->load->view("reports/claim_gunny", $bill);

            $this->load->view('post_login/footer');

        }
        else{

            $this->load->view('post_login/main');

            $this->load->view("reports/claim_gunny");

            $this->load->view('post_login/footer');

        }

    }*/

    /**Transport charges Anex - V */
    /*public function f_claim_transportch(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Retriving Bill Details
             $select = array (
                "s.mill_name","s.mill_addr",
                "t.*"

            );
            
            $where  =   array(

              "t.mill_id = s.sl_no" => NULL,    

              "t.bill_no"    =>  $this->input->post('bill_no'),

              "t.pool_type"  =>  $this->input->post('pool_type'),
                           
              "t.kms_yr"     => $this->session->userdata('kms_yr')
            );

             $wheres1  =   array(

              "sl_no"  =>    "4",

             );

             $wheres2  =   array(

                "sl_no"  =>    "5",
  
             );

             $wheres3  =   array(

                "sl_no"  =>    "6",
  
             );

             $wheres4  =   array(

                "sl_no"  =>    "7",
  
             );

             $wheres5  =   array(

                "sl_no"  =>    "15",
  
             );

            $bill['bill_dtls']   =  $this->Paddy->f_get_particulars("td_bill t,md_mill s",NULL, $where, 1);    
            
            $bill['trans1_chrg'] = $this->Paddy->f_get_particulars("md_comm_params",NULL,$wheres1, 1);

            $bill['trans2_chrg'] = $this->Paddy->f_get_particulars("md_comm_params",NULL,$wheres2, 1);

            $bill['trans3_chrg'] = $this->Paddy->f_get_particulars("md_comm_params",NULL,$wheres3, 1);

            $bill['trans4_chrg'] = $this->Paddy->f_get_particulars("md_comm_params",NULL,$wheres4, 1);

            $bill['trans_cmr'] = $this->Paddy->f_get_particulars("md_comm_params",NULL,$wheres5, 1);
            
            $this->load->view('post_login/main');

            $this->load->view("reports/claim_transport", $bill);

            $this->load->view('post_login/footer');

        }
        else{

            $this->load->view('post_login/main');

            $this->load->view("reports/claim_transport");

            $this->load->view('post_login/footer');

        }

    }*/

    //Payment Report
    /*public function f_payment_report(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Retriving Payment No
            $billNo = $this->Paddy->f_get_particulars("td_payment_bill", array('pmt_bill_no'),  array('pool_type' => $this->input->post('pool_type')), array('con_bill_no' => $this->input->post('pmt_bill_no')), 1);
           
            //Retriving Bill Payment Details
            $payment['payment_dtls']    =   $this->Paddy->f_payment( $this->input->post('pmt_bill_no'), $this->input->post('pool_type'));
            // echo $this->db->last_query();
            // die();
            //Bill Details
            $select =  array(

                "con_bill_no", "con_bill_dt", "mill_bill_no","pool_type",
                "mill_bill_dt", "paddy_qty", "paddy_cmr",
                "paddy_butta"

            );

            $where  =   array(

                "pmt_bill_no"   => $this->input->post('pmt_bill_no'),
                "pool_type"     => $this->input->post('pool_type')

            );
       
            $payment['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill", $select, $where, 0);
            
            //Charges for Bill Payment
            unset($select);
            unset($where);
            $select =  array(

                "m.param_name", "t.per_unit", "t.total_amt",
                "t.tds_amt", "t.cgst_amt", "t.sgst_amt",
                "t.payble_amt"

            );
            
            $where  =   array(

                "t.account_type = m.sl_no" => NULL,
                "t.pmt_bill_no"   => $this->input->post('pmt_bill_no')

            );


            $payment['charges']    =   $this->Paddy->f_get_particulars("td_payment_bill_dtls t, md_comm_params m", $select, $where, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/payment", $payment);

            $this->load->view('post_login/footer');

        }
        else{

            //For Current Date
            $payment['sys_date']   =   $_SESSION['sys_date'];

            //District List
            $payment['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/payment", $payment);

            $this->load->view('post_login/footer');

        }

    }*/

     // Payment Bill List
    /*public function f_paymentbilllist(){
                

            $dist      = $this->input->get('dist');
        
            $soc_id    = $this->input->get('soc_id');

            $mill_id   = $this->input->get('mill_id');

            $pool_type = $this->input->get('pool_type');

            $data = $this->Paddy->f_get_paymentslist($dist,$soc_id,$mill_id,$pool_type);
        
        echo json_encode($data);

    }*/

//Payment Voucher
/*public function f_payment_voucher(){

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Retriving Payment No
            $billNo = $this->Paddy->f_get_particulars("td_payment_bill", array('pmt_bill_no'),  array('pool_type' => $this->input->post('pool_type')), array('con_bill_no' => $this->input->post('pmt_bill_no')), 1);
           
            //Retriving Bill Payment Details
            $payment['payment_dtls']    =   $this->Paddy->f_payment( $this->input->post('pmt_bill_no'), $this->input->post('pool_type'));
            // echo $this->db->last_query();
            // die();
            //Bill Details
            $select =  array(

                "con_bill_no", "con_bill_dt", "mill_bill_no","pool_type",
                "mill_bill_dt", "paddy_qty", "paddy_cmr",
                "paddy_butta"

            );

            $where  =   array(

                "pmt_bill_no"   => $this->input->post('pmt_bill_no'),
                "pool_type"     => $this->input->post('pool_type')

            );
       
            $payment['bill_dtls']    =   $this->Paddy->f_get_particulars("td_payment_bill", $select, $where, 0);
            
            //Charges for Bill Payment
            unset($select);
            unset($where);
            $select =  array(

                "m.param_name", "t.per_unit", "t.total_amt","m.sl_no",
                "t.tds_amt", "t.cgst_amt", "t.sgst_amt",
                "t.payble_amt"

            );
            
            $where  =   array(

                "t.account_type = m.sl_no" => NULL,
                "t.pmt_bill_no"   => $this->input->post('pmt_bill_no')

            );
            $ptm_no     = $this->input->post('pmt_bill_no');
            $pool_type  = $this->input->post('pool_type');


            $payment['charges']         =   $this->Paddy->f_get_particulars("td_payment_bill_dtls t, md_comm_params m", $select, $where, 0);
            //$payment['tottransport']    =   $this->Paddy->f_tottransport($ptm_no,$pool_type);

            $this->load->view('post_login/main');

            $this->load->view("reports/payment_voucher", $payment);

            $this->load->view('post_login/footer');

        }
        else{

            //For Current Date
            $payment['sys_date']     =   $_SESSION['sys_date'];

            //District List
            $payment['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

            $this->load->view('post_login/main');

            $this->load->view("reports/payment_voucher", $payment);

            $this->load->view('post_login/footer');

        }

    }*/

/////////////////////////////////
public function js_get_bill()
		{

			$product = $this->input->get('district_code');
			// 	echo "pre";
			// var_dump($product);die;
			$result = $this->Process->js_get_bill($dist);
 			echo json_encode($result);

		} 
        public function f_wqsc() {
        
            //District List
          //  $wqsc['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
         //KMS YEAR
        // $data   = $this->Paddy->f_get_particulars_in('md_parameters', array(16, 17), array(""));
        // $kms_year=$this->kms_year   = substr($data[0]->param_value, 0,4).'-'.substr($data[1]->param_value, 2,2);
        $kms_year=$this->session->userdata('kms_yr');
            //Retriving Collection Details
            // $select = array( "m.district_name",   
            //                  "t.dis_cd","t.pool_type","t.bill_no",   "t.wqsc_no",
            //                  "t.analysis_no",  "t.trn_dt", "t.no_bags","t.qty","t.remarks"
            //                 );
           
            $select= array( "m.district_name",
                            "t.dis_cd","t.pool_type","t.bill_no", "t.wqsc_no", "t.trn_dt"    );
           
                             
            //                 $sql=(" m.district_name, 
            //                 t.dis_cd,t.pool_type,t.bill_no,t.wqsc_no,
            //                 t.analysis_no,  t.trn_dt, t.no_bags,t.qty
            //                  FROM td_wqsc_sheet t, md_district m 
            //                 where t.dis_cd = m.district_code" ) ;
             
            $where  = array( "t.dis_cd = m.district_code"    => NULL ,
                            "t.kms_yr"=>$kms_year );
            
                            
                            // die() ;           
                                          
            $wqsc['wqc_dtls']    =   $this->Paddy->f_get_distinct("td_wqsc_sheet t, md_district m", $select, $where, 0);
            
           
       
            // $wqsc['dist_dtls']     =   $this->Paddy->f_get_particulars("td_wqsc_sheet", $select, null, null);        
    
            $this->load->view('post_login/main');
           
            $this->load->view("wqsc/dashboard", $wqsc);
            
            $this->load->view('search/search');
    
            // $this->load->view('post_login/footer');
            
        }

        public function f_wqsc_add(){
            // $data       = $this->Paddy->f_get_particulars_in('md_parameters', array(16, 17), array(""));

            // $kms_year=$this->kms_year   = substr($data[0]->param_value, 0,4).'-'.substr($data[1]->param_value, 2,2);
            $kms_year=  $this->session->userdata('kms_yr');
                if($_SERVER['REQUEST_METHOD']=="POST"){
                
                    $this->load->helper('string');
                                     
                    $dis_cd         = $_POST['dist'];
                    $bill_no        = $_POST['bill_no'];
                    $pool_type      = $_POST['pool_type'];
                    $wqsc_no        = $_POST['wqsc_no'];
                    $analysis_no    = $_POST['analysis_no'];
                    $trn_dt         = $_POST['trn_dt'];
                    $no_bags	    = $_POST['no_bags'];
                    $qty	        = $_POST['qty'];
                    $remarks        = $_POST['remarks'];
                    $Unit_count     = count($wqsc_no);  
                        
                    

                    $query = $this->db->get_where('td_bill', array('bill_no =' => $this->input->post("bill_no")));
                    // echo $this->db->last_query();
                    // die();
                    if ($query->num_rows() == 0)
                    {
                    $this->session->set_flashdata('msg', 'Bill Not Exist!');
                //    echo "<script> alert('Bill Not Exist!');
                //    </script>";
                      redirect('paddy/wqsc/add');
                    }
                    else
                    {
                   
                    $this->Paddy->insert_wqsc($dis_cd,$bill_no,$pool_type,$wqsc_no,$analysis_no,$trn_dt,$no_bags,$qty,$remarks,$kms_year,$Unit_count);
                    // echo $this->db->last_query();
                   redirect('paddy/wqsc');
                    }  
                }
                else {
                    $district['dist']   =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
            
                    $this->load->view('post_login/main');
            
                    $this->load->view("wqsc/add",$district);
                             
                    $this->load->view('search/search');
            
                    $this->load->view('post_login/footer');
            
                }
            
        }


        public function f_wqsc_delete() {
            $kms_year=$this->session->userdata('kms_yr');
            $where = array(
                "bill_no"  =>  $this->input->get('bill_no'),
                // "pool_cd"  =>  $this->input->get('pool_type'),
                "dis_cd"   =>  $this->input->get('dis_cd'),
                "kms_yr"=>$kms_year

                
            );
            
            //Retriving the data row for backup
            $select = array (    
                "dis_cd","pool_type","wqsc_no","analysis_no","bill_no",
                "trn_dt","no_bags","qty","remarks"
    
            );
           
            $data   =   (array) $this->Paddy->f_get_particulars("td_wqsc_sheet", $select, $where, 1);
          
            $audit  =   array(
                
                'deleted_by'    => $this->session->userdata('loggedin')->user_name,
                
                'deleted_dt'    => date('Y-m-d h:i:s')
    
            );
            $this->Paddy->f_insert('td_wqsc_sheet_deleted', array_merge($data, $audit));
              //Delete Originals
            $this->Paddy->f_delete('td_wqsc_sheet', $where);
              //For notification storing message
            $this->session->set_flashdata('msg', 'Successfully deleted!');
    
            redirect("paddy/wqsc");
    
        }

        public function f_wqsc_edit() {

            if($_SERVER['REQUEST_METHOD'] == "POST") {
    
                $data_array = array(
                    "bill_no"     =>  $this->input->post('bill_no'),
                    "trn_dt"      =>  $this->input->post('trn_dt'),
                    "dist"        =>  $this->input->post('dist'),
                    "wqsc_no"     =>  $this->input->post('wqsc_no'),
                    "analysis_no" =>  $this->input->post('analysis_no'),
                    "no_bags"     =>  $this->input->post('no_bags'),
                    "qty"         => $this->input->post('qty') );
    
                $where  =   array(   
                    "bill_no"     =>  $this->input->get('bill_no'),
                    "dis_cd"   =>  $this->input->get('dis_cd')
                );
    
                $this->Paddy->f_edit('td_wqsc_sheet', $data_array, $where);
    
                //For notification storing message
                $this->session->set_flashdata('msg', 'Successfully edited!');
    
                redirect('paddy/wqsc');
    
    
            }
            else {
    
                //District List
                $wqsc['dist']          =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);
    
                //Workorder Details
                //Retriving the data row for backup
            $select = array (  "bill_no","dis_cd","pool_type","wqsc_no","analysis_no",
                                "trn_dt","no_bags","qty","remarks" );
        
                $where = array("bill_no"     =>  $this->input->get('bill_no'),
                                "pool_type"  =>  $this->input->get('pool_type'),
                                "dis_cd"     =>  $this->input->get('dis_cd'));
                $select1 = array ( "wqsc_no","analysis_no",
                                        "trn_dt","no_bags","qty","remarks" );
                $wqsc['lonkesh']=     $this->Paddy->f_get_particulars("td_wqsc_sheet t, md_district m", $select, $where,1);
                $wqsc['wqsc_dtls']=   $this->Paddy->f_get_particulars("td_wqsc_sheet t", $select1, $where,0);
                // echo $this->db->last_query();
            //    print_r( $wqsc);
            //    die();
             
                $this->load->view('post_login/main');
    
                $this->load->view("wqsc/edit", $wqsc);
                // $this->paddy->updatewqsc($dis_cd,$bill_no,$pool_type,$wqsc_no,$analysis_no,$trn_dt,$no_bags,$qty,$remarks,$Unit_count );
                $this->load->view('post_login/footer');
    
            }
            
        }
    
        public function updatewqsc()
        {

        if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $dis_cd         = $_POST['dist'];
                $bill_no        = $_POST['bill_no'];
                $pool_type      = $_POST['pool_type'];
                $wqsc_no        = $_POST['wqsc_no'];
                $analysis_no    = $_POST['analysis_no'];
                $trn_dt         = $_POST['trn_dt'];
                $no_bags	    = $_POST['no_bags'];
                $qty	        = $_POST['qty'];
                $remarks        = $_POST['remarks'];
                $Unit_count     = count($wqsc_no);  
                                                      
                $this->Paddy->updatewqsc($dis_cd,$bill_no,$pool_type,$wqsc_no,$analysis_no,$trn_dt,$no_bags,$qty,$remarks,$Unit_count );
                // echo $this->db->last_query();
                // die();
                echo "<script> alert('Successfully Updated');
                 </script>";
                redirect('paddy/wqsc');
            }
            else
            {
                echo "<script> alert('Sorry! Select Again.');
                </script>";
            }

        }

public function f_wqsc_add_bk() {

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Max sl_no is having insert
        // $max_slno     =    $this->Paddy->f_get_particulars("md_comm_params", array("IFNULL(MAX(sl_no) + 1, 1) sl_no"), NULL, 1);

        $data_array     =   array(  "dis_cd"	     =>$this->input->post('dis_cd'),
                                    "wqsc_no"	     =>$this->input->post('wqsc_no'),
                                    "analysis_no"	 =>$this->input->post('analysis_no'),
                                    "trn_dt"	     =>$this->input->post('trn_dt'),
                                    "no_bags"	     =>$this->input->post('no_bags'),
                                    "qty"	         =>$this->input->post('qty'),
                                    "remarks"        =>$this->input->post('remarks')
          );

        // $this->Paddy->f_insert("md_comm_params", $data_array);

        //For notification storing message
        $this->session->set_flashdata('msg', 'Successfully Added!');

        // redirect("paddy/bill/master");

    }
    else {
        $district['dist']   =   $this->Paddy->f_get_particulars("md_district", NULL, NULL, 0);

        $this->load->view('post_login/main');

        $this->load->view("wqsc/add",$district);

        $this->load->view('search/search');

        $this->load->view('post_login/footer');

    }

}
//     public function raja()
//     {
// echo "raja";
//     }



}    


