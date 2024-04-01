	<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
	
	public function __construct()
       {
            parent::__construct();
			$this->load->model('modeldts_documents');
			$this->load->model('modeldts_users');
			$this->load->library('form_validation');
			$this->load->helper('security');
			
       }
	public function index()	{
		$this->is_logged_in();
		$data['sections']=$this->modeldts_documents->get_publicreceiving_sections();
		$data['defaultsection']=3; //records section
		$data['docstypes']=$this->modeldts_documents->get_docstype_public();
		$this->load->view('dtspages/main', $data);
	}
	 function is_logged_in(){
		$is_logged_in= $this->session->userdata ('logged_in');
		if(isset($is_logged_in)){
			redirect(base_url().'index.php/mydocuments');
			
		} 
		
	}
	function advance_search (){
		$this->load->view('dtspages/advance_search_form');
		
		
		
	}
	
	function login(){
		$this->is_logged_in();
		$this->load->model('modeldts_users');	
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback__validate_credentials');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|sha1');
		
		if($this->form_validation->run()){
		$data = array(
        'logged_in' => TRUE, 
		'session_id'=> session_id(), 
	    'userID'=>$this->modeldts_users->get_userID_by_email($this->input->post('email'))
	
			);
			
			$data['userdata']=$this->modeldts_users->get_userfullname_by_email($this->input->post('email'));
			$this->session->set_userdata($data);//getting data for session
			 redirect(base_url().'index.php/documents');		
		
		}else {
		
		$this->load->view('dtspages/main');
		
		
		}
	
	}
	function _validate_credentials(){ //for login
			$this->load->library('form_validation');
			$this->load->helper('security');
		if($this->modeldts_users->can_log_in()){
		return TRUE;
		} else {
			$this->form_validation->set_message('_validate_credentials', 'Incorrect Email and/or Password !');
			return FALSE;
		}
		
	}	
		
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}	
	
	function submit_docs(){
		$this->load->library('form_validation');
		$this->load->helper('security');		
		$this->form_validation->set_rules('submitted_by', 'Name', 'required|trim');			
		$this->form_validation->set_rules('submitter_id', 'Submitter ID', 'required|trim');
		$this->form_validation->set_rules('document_type_id', 'Document Type', 'required|trim');
		$this->form_validation->set_rules('tempdoc_description', 'Subject Matter', 'required|trim');
		$this->form_validation->set_rules('school', 'School / Office', 'required|trim');
		$this->form_validation->set_rules('submitter_section_id', 'Submitter Unit ID', 'required|trim');
		$this->form_validation->set_rules('tempdoc_description', 'Description', 'required|trim');
		$this->form_validation->set_rules('section_id', 'Section To', 'required|trim');
		
		if($this->form_validation->run()){
		$insertsection=$this->modeldts_documents->add_temp_docs();
		if(	$insertsection){
	   	if($this->modeldts_documents->get_all_sections()){$data['allsections']= $this->modeldts_documents->get_all_sections();}
		$data['sections']=$this->modeldts_documents->get_receiving_sections();
		$data['defaultsection']=1; //records section
		$data['submission_success']='Doc_ID:'. $insertsection.' Submitted succesfully.';
		$data['docstypes']=$this->modeldts_documents->get_docstype_public();
		$this->load->view('dtspages/main', $data);
			
		}else{
		echo 'Error';
		
			
		}
		}else{
		echo validation_errors();
	
		
	}
		
		
	}
	
	function search_track(){
		$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('qtrack', 'Tracking Code', 'required|trim');
	 if($this->form_validation->run()){
		$track= $this->input->post('qtrack');
	//end basicpage data
		 if($track !==''){
			 $data['track_code']= $track;
			$data['doc_detail']= $this->modeldts_documents->get_docsdetails_bytrack($track);
			$data['track_data']= $this->modeldts_documents->get_docroutes_searched($track);
		 }
		$this->load->view('dtspages/search_result', $data);
	//	 $this->load->view('mydocuments/mydoc_trackview', $data);
	} else {
		$this->index();
	}
	 
	}
	
	

	
	
	

			




	
}//end class
