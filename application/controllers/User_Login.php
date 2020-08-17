<?php

	class User_Login extends MX_Controller{

		public function __construct(){
			parent::__construct();
			$this->load->model('Login_Process');
		}
		
		public function index(){

			if($_SERVER['REQUEST_METHOD']=="POST"){
				$user_id = $_POST['user_id'];
				$user_pw = $_POST['user_pwd'];
				$module_type = $_POST['module_type'];
				$kms_yr  = $_POST['kms_yr'];
			
				$result  = $this->Login_Process->f_select_password($user_id);
				$match	 = password_verify($user_pw,$result->password);
				if($match){
					$user_data = $this->Login_Process->f_get_user_inf($user_id);
					$this->session->set_userdata('loggedin',$user_data);
					$this->Login_Process->f_insert_audit_trail($user_id);
					$this->session->set_userdata('sl_no',$this->Login_Process->f_audit_trail_value($user_id));

              
					$this->session->set_userdata('kms_yr',$kms_yr);
					$kms_data 	 = $this->Login_Process->f_get_kms_inf($kms_yr);
					// $loggedin['kms_id']  			= $kms_data->sl_no;
					// $loggedin['kms_yr']   			= $kms_data->kms_yr;
					
				    if( $module_type!='Paddy'){
				
				$this->session->set_userdata('kms_yr',"");
				   }
					if($this->session->userdata('loggedin')->ddmo == 1){
						redirect('Disaster/Report/confirmationddmo');
					}
					else{

						redirect('User_Login/main');
					}
				}else{
					redirect('User_Login/login');
				}
			}else{
				redirect('User_Login/login');
			}
			
		}


		public function login(){

			if($this->session->userdata('loggedin')){

				redirect('User_Login/main');

			}else{
			   $data["kms_yr"]		 = $this->Login_Process->f_get_kms_yr();
			  
				$this->load->view('login/login',$data);

			}
		}

		public function main(){

			if($this->session->userdata('loggedin')){

				//$this->session->set_userdata('sysdate',$this->Login_Process->f_get_parameters(4));
				$_SESSION['sys_date']= date('Y-m-d');

				$this->session->set_userdata('cashcode', $this->Login_Process->f_get_parameters(13));
				$_SESSION['cash_code']=$this->session->userdata('cashcode')->param_value;

				$this->load->view('post_login/main');
				$this->load->view('post_login/home');
				$this->load->view('post_login/footer');

			}
			else{

				redirect('User_Login/login');

			}
			
		}	

		public function logout(){

			if($this->session->userdata('loggedin')){

				$user_id    =   $this->session->userdata('loggedin')->user_id;
				
				$this->Login_Process->f_update_audit_trail($user_id);

				$this->session->unset_userdata('loggedin');

				$this->session->unset_userdata('sl_no');
				
				redirect('User_Login/login');

			}else{

				redirect('User_Login/login');

			}
		}
	}
?>
