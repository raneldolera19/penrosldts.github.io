<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Records extends CI_Controller {
	
	public function __construct()
       {
            parent::__construct();
			$this->load->model('modeldts_documents');
			$this->load->model('modeldts_users');
			$this->is_logged_in();
       }
	public function index()	{
		//$this->sections();
		redirect(base_url().'index.php/documents');
	}
	function is_logged_in(){
		$is_logged_in= $this->session->userdata ('logged_in');
		if(!isset($is_logged_in)|| $is_logged_in != true){
			redirect(base_url());
		}
		}
	
	function sections()	{
		$data['fullname']='Stephen R. Pascual';
		if($this->modeldts_documents->get_all_sections()){$data['allsections']= $this->modeldts_documents->get_all_sections();}
		$data['default_office_id']=44; //default- division office id is 44
		$data['offices']=$this->modeldts_users->get_schools();
	//	$this->load->view('dtspages/records_sections_list', $data);
	}
	
	
	function users()	{
		$data['fullname']='Stephen R. Pascual';
		$this->load->view('dtspages/records_users_list', $data);
	}
	
	
	function add_user()	{
		$data['fullname']='Stephen R. Pascual';
		$this->load->view('dtspages/add_user', $data);
	}
	
	
	function _add_section()	{
		$data['fullname']='Stephen R. Pascual';
		//-------
		$this->load->library('form_validation');
		$this->load->helper('security');		
		$this->form_validation->set_rules('section', 'Section', 'required|trim|is_unique[dts_sections.section_description]');			
		$this->form_validation->set_rules('office_id', 'Office', 'required|trim');
		$this->form_validation->set_message('is_unique',"Section Name is already used");
		if($this->form_validation->run()){
		if(	$this->modeldts_documents->add_new_section()){
	    $data['fullname']='Stephen R. Pascual';
		$data['default_office_id']=44; //default- division office id is 44
		$data['offices']=$this->modeldts_users->get_schools();	
		$this->load->view('dtspages/sections_list', $data);
			
		}else{
		echo 'Error';
			
		}
		}
		//echo 'error';
		$data['fullname']='Stephen R. Pascual';
		$data['default_office_id']=44; //default- division office id is 44
		$data['offices']=$this->modeldts_users->get_schools();
		if($this->modeldts_documents->get_all_sections()){$data['allsections']= $this->modeldts_documents->get_all_sections();}
		
		$this->load->view('dtspages/sections_list', $data);
		
		
		
	}
	








	
	function myback_up(){
				// Load the DB utility class
				$this->load->dbutil();

			// Backup your entire database and assign it to a variable
			 $backup = $this->dbutil->backup();
			 $this->load->helper('download');
			 force_download('sdis_backup.gz', $backup);
				
	}


			




	
}//end class
