<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Myprofile extends CI_Controller {
	
	public function __construct()
       {
            parent::__construct();
			$this->load->model('modeldts_documents');
			$this->load->model('modeldts_users');
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->is_logged_in();
			
       }
	public function index()	{
		//	echo 'PAGE UNDER CONSTRUCTION!';
		$this->change_password();
	}
	function is_logged_in(){
		$is_logged_in= $this->session->userdata ('logged_in');
		if(!isset($is_logged_in)|| $is_logged_in != true){
			redirect(base_url());
		}
		}
	
	
	function change_password($note=""){
		$mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
		$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
		$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
		$data['docsroute_count']=$this->modeldts_documents->get_docroutes_count($mysectionID);
		$data['pendingroute_count']=$this->modeldts_documents->get_pendingroutes_count($mysectionID);
		$data['tempdocs_count']=$this->modeldts_documents->get_my_tempdocs_count($mysectionID);
		$data['myschool']= $this->modeldts_users->user_station();
		$data['co_users']=$this->modeldts_users->get_myco_users($mysectionID);
		$data['co_users_count']=$this->modeldts_users->get_myco_usersCount($mysectionID);
		$data['count_fwdroute']= $this->modeldts_documents->get_nonRec_docforwarded($mysectionID);
		$data['message']=$note;
		//end basicpage data	
		
		
		$this->load->view('dts_staff/resetpass', $data);
	
	
	
	}
	
    function change_password_validation(){
		$data['fullname']=$this->modeldts_users->get_userfullname_by_id($this->session->userdata ('userID'));
		$this->is_logged_in();
		//$this->load->model('model_users');	
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules('newuser_id', 'User ID', 'required|trim');
		$this->form_validation->set_rules('currentpassword', 'Current Password', 'required|trim|xss_clean|callback__validate_currentpassword');
		$this->form_validation->set_rules('newpassword', 'New Password', 'required|trim');
		$this->form_validation->set_rules('cnewpassword', 'Confirm New Password', 'required|trim|matches[newpassword]');
		
		$this->form_validation->set_message('required',"Please fill-up the form completely !");
		if($this->form_validation->run()){
		$insert=$this->modeldts_users->reset_userpassword();
			if(isset($insert)){
				$note="ok";
				redirect(base_url().'myprofile/change_password/'.$note);
				}else{
				echo "error";
				}	
			} else {
				$mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
				$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
				$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
				$data['docsroute_count']=$this->modeldts_documents->get_docroutes_count($mysectionID);
				$data['pendingroute_count']=$this->modeldts_documents->get_pendingroutes_count($mysectionID);
				$data['tempdocs_count']=$this->modeldts_documents->get_my_tempdocs_count($mysectionID);
				$data['myschool']= $this->modeldts_users->user_station();
				$data['co_users']=$this->modeldts_users->get_myco_users($mysectionID);
				$data['co_users_count']=$this->modeldts_users->get_myco_usersCount($mysectionID);
				$data['count_fwdroute']= $this->modeldts_documents->get_nonRec_docforwarded($mysectionID);
				
		//end basicpage data	
		
		
		$this->load->view('dts_staff/resetpass', $data);
			}
	 }
		
	
		function _validate_currentpassword(){
			$this->load->library('form_validation');
			if($this->modeldts_users->is_current_password()){
			return TRUE;
			} else {
				$this->form_validation->set_message('_validate_currentpassword', 'Wrong Current Password');
				return FALSE;
			}
			
		}
		
	
	




	
}//end class
