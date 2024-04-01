<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dts_admin extends CI_Controller {
	
	public function __construct()
       {
            parent::__construct();
			$this->load->model('modeldts_documents');
			$this->load->model('modeldts_users');
			$this->load->library('form_validation');
			$this->is_logged_in();
			$this->is_admin();
       }
	public function index()	{
		$this->sections();
	
	}
	function is_logged_in(){
		$is_logged_in= $this->session->userdata ('logged_in');
		if(!isset($is_logged_in)|| $is_logged_in != true){
			redirect(base_url());
		}
		}
	function is_admin(){
		$is_admin= $this->modeldts_users->is_user_superadmin();
          if(!isset($is_admin)|| $is_admin != true){
			redirect(base_url().'documents');  
		  }
	}	
	function sections()	{
		$mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
		$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
		$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
		
		///------------------
		//------
		if($this->modeldts_documents->get_all_sections()){$data['allsections']= $this->modeldts_documents->get_all_sections();}
		$data['default_office_id']=44; //default- division office id is 44
		$data['offices']=$this->modeldts_users->get_schools();
		
		$this->load->view('dts_admin/admin_sections_list', $data);
	}
	
	
	function users()	{
		$mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
		$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
		$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
		
		///------------------;
		if($this->modeldts_users->get_userlist()){$data['userlist']=$this->modeldts_users->get_userlist();}
		$data['default_office_id']=44; //default- division office id is 44
		$data['offices']=$this->modeldts_users->get_schools();
		$data['random_password']=$this->modeldts_users->random_password(8);
		$data['schools']=$this->modeldts_users->get_schools();
		$data['offices']=$this->modeldts_users->get_schools();
		if($this->modeldts_documents->get_all_sections()){
			$data['sections']= $this->modeldts_documents->get_all_sections();}
		$data['defaultsection']=0; //
		$data['otherfields']=0; //
		$this->load->view('dts_admin/admin_users_list', $data);
	}
	
	function edit_document($doc_id){
		//$this->is_dtsadmin();
		// basic page data
		$mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
		$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
		$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
		$data['docsroute_count']=$this->modeldts_documents->get_docroutes_count($mysectionID);
		$data['pendingroute_count']=$this->modeldts_documents->get_pendingroutes_count($mysectionID);
		$data['tempdocs_count']=$this->modeldts_documents->get_my_tempdocs_count($mysectionID);
		$data['co_users']=$this->modeldts_users->get_myco_users($mysectionID);
		$data['co_users_count']=$this->modeldts_users->get_myco_usersCount($mysectionID);
		$data['count_fwdroute']= $this->modeldts_documents->get_nonRec_docforwarded($mysectionID);
		$data['count_deferredroute']= $this->modeldts_documents->get_deferredroutes_count($mysectionID);
		//end basicpage data
		$data['docstypes']=$this->modeldts_documents->get_docstype();
		$data['doc_details']=$this->modeldts_documents->get_docsdetails_byid($doc_id);
		$this->load->view('dts_admin/admin_editdoc', $data);
		

	}	
	
	function add_section()	{
		$mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
		$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
		$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
		
		///------------------
		//-------
		$this->load->library('form_validation');
		$this->load->helper('security');		
		$this->form_validation->set_rules('section_description', 'Section Name', 'required|trim|is_unique[dts_sections.section_description]');			
		$this->form_validation->set_rules('office_id', 'Office', 'required|trim');
		$this->form_validation->set_rules('allow_receipt', 'Receiving Unit', 'required|trim');
		$this->form_validation->set_message('is_unique',"Section Name is already used!");
		if($this->form_validation->run()){
		$insertsection=$this->modeldts_documents->add_new_section();
		if(	$insertsection){
	   	if($this->modeldts_documents->get_all_sections()){$data['allsections']= $this->modeldts_documents->get_all_sections();}
		$data['default_office_id']=44; //default- division office id is 44
		$data['offices']=$this->modeldts_users->get_schools();	
		$data['submission_success']='New Section ID '. $insertsection.' has beed added';
		if($this->modeldts_documents->get_all_sections()){
			$data['sections']= $this->modeldts_documents->get_all_sections();}
		$data['defaultsection']=0; //
		$data['otherfields']=0; //
		$this->load->view('dts_admin/admin_sections_list', $data);
			
		}else{
		//echo 'Error';
		if($this->modeldts_documents->get_all_sections()){$data['allsections']= $this->modeldts_documents->get_all_sections();}
		$data['default_office_id']=44; //default- division office id is 44
		$data['offices']=$this->modeldts_users->get_schools();	
		$this->load->view('dts_admin/admin_sections_list', $data);
			
		}
		}
		if(validation_errors()){
		if($this->modeldts_documents->get_all_sections()){$data['allsections']= $this->modeldts_documents->get_all_sections();}
		$data['default_office_id']=44; //default- division office id is 44
		$data['offices']=$this->modeldts_users->get_schools();	
		$this->load->view('dts_admin/admin_sections_list', $data);
		}
		
		
		
	}
	
	function edit_section(){
		$mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
		$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
		$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
		
		///------------------
		//-------
		$this->load->library('form_validation');
		$this->load->helper('security');		
		$this->form_validation->set_rules('section_description', 'Section Name', 'required|trim|callback__validate_sectionname');			
		$this->form_validation->set_rules('office_id', 'Office', 'required|trim');
		$this->form_validation->set_rules('section_id', 'Section ID', 'required|trim');
		$this->form_validation->set_rules('allow_receipt', 'Receiving Unit', 'required|trim');
		
		if($this->form_validation->run()){
		if(	$this->modeldts_documents->update_section()){
	   
		if($this->modeldts_documents->get_all_sections()){$data['allsections']= $this->modeldts_documents->get_all_sections();}
		$data['default_office_id']=44; //default- division office id is 44
		$data['offices']=$this->modeldts_users->get_schools();	
		
		$this->load->view('dts_admin/admin_sections_list', $data);
			
		}else{
		echo 'Error';
			
		}
		}
		//echo 'error';
		
		
		
		
		
	}
	
	function submit_delete_document(){// going to the receiving sections only
	    $this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules('doc_id', 'Document ID', 'required|trim');
		$this->form_validation->set_rules('del_reason', 'Reason', 'required|trim');
		$this->form_validation->set_rules('myuser_id', 'My User ID', 'required|trim');	
		
		if($this->form_validation->run()){
		 $data_doc= array(
		// 'doc_id' =>$this->input->post('doc_id'),
		 'deactivate_reason' =>$this->input->post('del_reason') ,
		 'active' => 0, 
		 'updatedby_id'=> $this->input->post('myuser_id')	 
		 );
		 $data_route= array(
		// 'document_id' =>$this->input->post('doc_id'),
		 'del_reason' =>$this->input->post('del_reason') ,
		 'active' => 0,
		 'updatedby_id'=> $this->input->post('myuser_id')	 
		 );
		$deactivate_doc=$this->modeldts_documents->deactivate_docby_id( $data_doc);
		$deactivate_docroutes=$this->modeldts_documents->deactivate_routesby_docid($data_route);
		if($deactivate_doc && $deactivate_docroutes ){	
	
	//echo 'OK';
		redirect(base_url().'dts_admin');  
	
		} else { echo 'Error in the Data'; }
	//echo 'not Ok';
		}else{
		echo validation_errors();
	
	}
	}
	
	
	
		function _validate_sectionname(){
				
				if($this->modeldts_documents->has_my_section_name()){	
				$this->form_validation->set_message('_validate_sectionname', 'The section name  has duplicate.');
				//$this->form_validation->set_message('_validate_sectionname', 'Unable to update: The Email  has duplicate.');
					return FALSE;
				} else {
					
					return TRUE;
				}
				
			} 
// users  
function add_newuser (){ /// form processing from modal
		$mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
		$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
		$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
		
		///------------------
		$this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
		$this->form_validation->set_rules('user_email', 'Email', 'required|is_unique[users.email]|trim');
		$this->form_validation->set_rules('contactnumber', 'Contact Number', 'required|trim');
		$this->form_validation->set_rules('designation', 'Designation', 'required|trim');
		$this->form_validation->set_rules('office_id', 'Station', 'required|trim');
		$this->form_validation->set_rules('section_id', 'Section', 'required|trim');
		
		$this->form_validation->set_message('required',"Please fill-up the form completely !");
		if($this->form_validation->run()){
		$insert=$this->modeldts_users->add_dts_user();
			if(isset($insert)){
				//echo 'added';
				$data['logmessage']='Adding new user successful!';
			
				$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
				if($this->modeldts_users->get_userlist()){$data['userlist']=$this->modeldts_users->get_userlist();}
				$data['random_password']=$this->modeldts_users->random_password(8);
				$data['schools']=$this->modeldts_users->get_schools();
				
				//$this->load->view('dts_admin/admin_users_list', $data);
				redirect(base_url().'dts_admin/users'); 
				}	
			
	}else{
		//	echo 'Error';
		echo validation_errors();
			
		}
	}
			 
			 


function deactivate_user(){
				$this->load->library('form_validation');
				$this->load->helper('security');
				$this->form_validation->set_rules('newuser_id', 'User', 'required|trim');
			if($this->form_validation->run()){
				if($this->modeldts_users->deactivate_the_user()){
				redirect(base_url().'admin');
				}else{
				$data['user_fullname']=$this->modeldts_users->get_userfullname_by_id($this->session->userdata ('userID'));
				$data['title']='Administrator';
				$data['schools']=$this->modeldts_users->get_schools();
				$data['allusers']=$this->modeldts_users->get_userlist();
				$this->load->view('dtspages/admin_users_list', $data);
					
				}
			}
				
			}
			
			
			 function reset_userpassword(){ //self submitting form
			//	 $data['user_fullname']=$this->model_users->get_userfullname_by_id($this->session->userdata ('userID'));
			//	$data['title']='Administrator';
			//	$data['schools']=$this->modeldts_users->get_schools();
			//	$data['allusers']=$this->modeldts_users->get_userlist();
				 
				// echo "Test Ok";
				$this->load->library('form_validation');
				$this->load->helper('security');
				$this->form_validation->set_rules('newuser_id', 'User ID', 'required|trim');
				$this->form_validation->set_rules('newpassword', 'New Password', 'required|trim');
				
				$this->form_validation->set_message('required',"Please fill-up the form completely !");
				if($this->form_validation->run()){
				$insert=$this->modeldts_users->reset_userpassword();
					if(isset($insert)){
						$data['logmessage']='Reset Password Successfull! ';
						
					//	$data['email']=$insert;
					//	$this->load->view('superadmin/manage_users', $data);
					//$this->load->view('superadmin/sa_reset_user_password', $data);
						redirect(base_url().'dts_admin/users');
						}else{
						echo	$data['logmessage']="Password cannot be reset" ;
						echo validation_errors();
					//	$this->load->view('superadmin/sa_reset_user_password', $data);
						}	
					} else {
						echo "Wrong";
						echo validation_errors();
						//$data['logmessage']="Password cannot be reset" ;
						//$this->load->view('superadmin/sa_reset_user_password', $data);
					}
			 }
			

			
			 function edit_user($usrid){
				 $mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
				$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
				$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
				 
			//	print_r ($this->modeldts_users->get_userdata_by_id($usrid));
				$data['user_data']=$this->modeldts_users->get_userdata_by_id($usrid);
			//	$data['default_office_id']=44; //default- division office id is 44
				$data['random_password']=$this->modeldts_users->random_password(8);
				$data['offices']=$this->modeldts_users->get_schools();
				$data['sections']=$this->modeldts_documents->get_all_sections();
				//$data['defaultsection']=0; //
				$data['otherfields']=0; //
				
				$this->load->view('dts_admin/edit_user_page', $data);
				 
			 }
			 
			 
			 function update_user(){
				$this->load->model('modeldts_users');	
					$this->load->library('form_validation');
					$this->load->helper('security');
					$this->form_validation->set_rules('user_id', 'User ID', 'required|trim');
					$this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
					$this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
					$this->form_validation->set_rules('user_email', 'Email', 'required|trim|callback__validate_my_email');
					$this->form_validation->set_rules('contactnumber', 'Contact Number', 'required|trim');
					$this->form_validation->set_rules('station', 'School or Office', 'required|trim');
					$this->form_validation->set_rules('designation', 'Designation', 'required|trim');
					$this->form_validation->set_message('required',"Please fill-up the form completely !");
					if($this->form_validation->run()){
					$update_urecord=$this->modeldts_users->update_dts_user();
													
						redirect(base_url().'dts_admin/users');			
						
							
						
				}else{
						echo validation_errors();		
					} 
							 
			 }
	function _validate_my_email(){
				$this->load->model('modeldts_users');
				$this->load->library('form_validation');
				if($this->modeldts_users->has_my_email()){
				$this->form_validation->set_message('_validate_my_email', 'Unable to update: The Email  has duplicate.');
					return FALSE;
				} else {
					
					return TRUE;
				}
				
			} 

/// - overides activities

 
	 function track_view($track){
		 $mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
		$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
		$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
		$data['docsroute_count']=$this->modeldts_documents->get_docroutes_count($mysectionID);
		$data['pendingroute_count']=$this->modeldts_documents->get_pendingroutes_count($mysectionID);
		$data['tempdocs_count']=$this->modeldts_documents->get_my_tempdocs_count($mysectionID);
		$data['co_users']=$this->modeldts_users->get_myco_users($mysectionID);
		$data['co_users_count']=$this->modeldts_users->get_myco_usersCount($mysectionID);
		$data['count_fwdroute']= $this->modeldts_documents->get_nonRec_docforwarded($mysectionID);
		$data['count_deferredroute']= $this->modeldts_documents->get_deferredroutes_count($mysectionID);
		//end basicpage data
		 
		 
		 if($track !==''){
			 $data['track_code']= $track;
			$data['doc_detail']= $this->modeldts_documents->get_docsdetails_bytrack($track);
			$data['track_data']= $this->modeldts_documents->get_docroutes_searched($track);
			
		 }
		
		 $this->load->view('documents/doc_trackview', $data);
		 
	 }

	 
	function search_track(){
		
	$this->load->library('form_validation');
	$this->load->helper('security');
	$this->form_validation->set_rules('qtrack', 'Tracking Code', 'required|trim');
	 if($this->form_validation->run()){
		$track= $this->input->post('qtrack');
		$mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
		$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
		$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
		$data['docsroute_count']=$this->modeldts_documents->get_docroutes_count($mysectionID);
		$data['pendingroute_count']=$this->modeldts_documents->get_pendingroutes_count($mysectionID);
		$data['tempdocs_count']=$this->modeldts_documents->get_my_tempdocs_count($mysectionID);
		$data['co_users']=$this->modeldts_users->get_myco_users($mysectionID);
		$data['co_users_count']=$this->modeldts_users->get_myco_usersCount($mysectionID);
		$data['count_fwdroute']= $this->modeldts_documents->get_nonRec_docforwarded($mysectionID);
		//end basicpage data
		if($track !==''){
		$data['track_code']= $track;
		if($this->modeldts_documents->get_docsdetails_bytrack($track)){
		$data['doc_detail']= $this->modeldts_documents->get_docsdetails_bytrack($track);
		}
		if($this->modeldts_documents->get_docroutes_searched($track)){
			$data['track_data']= $this->modeldts_documents->get_docroutes_searched($track);
			}
		 }
		 $this->load->view('dts_admin/admin_trackview', $data);
  	  
	 }	
	}
 










// back_ups
			
	function myback_up(){
				// Load the DB utility class
				$this->load->dbutil();

			// Backup your entire database and assign it to a variable
			 $backup = $this->dbutil->backup();
			 $this->load->helper('download');
			 force_download('edts_backup.gz', $backup);
				
	}


			




	
}//end class
