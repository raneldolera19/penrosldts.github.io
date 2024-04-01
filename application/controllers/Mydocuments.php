	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mydocuments extends CI_Controller {
	
	public function __construct()
       {
            parent::__construct();
			$this->load->model('modeldts_documents');
			$this->load->model('modeldts_users');
			$this->load->library('form_validation');
			$this->is_logged_in();
			$this->is_receiver();
       }
	public function index()	{
		$this->encode_mydocs();
		//echo $myschId= $this->modeldts_users->get_my_rowdetail('office_id');
		
	}
	
	
	function is_logged_in(){
		$is_logged_in= $this->session->userdata ('logged_in');
		if(!isset($is_logged_in)|| $is_logged_in != true){
			redirect(base_url());
		}
		}
	function is_receiver(){
			$receiver= $this->modeldts_documents->is_receiving_sections($this->modeldts_users->get_my_rowdetail('dts_section_id'));
			if($receiver){
			redirect(base_url().'documents');
				}
		}	
	
	
	function incoming(){
		// basic page data
		$mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
		$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
		$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
		$data['docsroute_count']=$this->modeldts_documents->get_docroutes_count($mysectionID);
		$data['pendingroute_count']=$this->modeldts_documents->get_pendingroutes_count($mysectionID);
		$data['tempdocs_count']=$this->modeldts_documents->get_my_tempdocs_count($mysectionID);
		$myschId= $this->modeldts_users->get_my_rowdetail('office_id');
		$data['myschool']= $this->modeldts_users->user_station();
		$data['co_users']=$this->modeldts_users->get_myco_users($mysectionID);
		$data['co_users_count']=$this->modeldts_users->get_myco_usersCount($mysectionID);
		$data['count_fwdroute']= $this->modeldts_documents->get_nonRec_docforwarded($mysectionID);
		$data['count_deferredroute']= $this->modeldts_documents->get_deferredroutes_count($mysectionID);
		//end basicpage data
		$routeddocs=$this->modeldts_documents->get_docroutes($mysectionID);
		
		if($routeddocs){
			$data['routeddocs']=$routeddocs;
			$data['count_routed']=count($routeddocs);
		}		
		$this->load->view('mydocuments/mydoc_incoming', $data);
		
	}
	 function all_acted(){
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
		$alldoc_list=$this->modeldts_documents->get_allacted_docs($mysectionID);
		if($alldoc_list){
			$data['alldocs']=$alldoc_list;
			$data['count_alldocs']=count($alldoc_list);	
		}
		
		$this->load->view('documents/doc_allacted_list', $data);
	} 
	function pending(){
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
		$data['count_deferredroute']= $this->modeldts_documents->get_deferredroutes_count($mysectionID);
		//end basicpage data
		$data['all_othersections']=$this->modeldts_documents->get_othersections($mysectionID);
		$routeddocs=$this->modeldts_documents->get_pendingroutes($mysectionID);
		if($routeddocs){
			$data['routeddocs']=$routeddocs;
			$data['count_routed']=count($routeddocs);
		}
		
		$this->load->view('mydocuments/mydoc_pending', $data);
	}
	
	function deferred(){
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
		$data['all_othersections']=$this->modeldts_documents->get_othersections($mysectionID);
		$routeddocs=$this->modeldts_documents->get_deferredroutes($mysectionID);
		if($routeddocs){
			$data['routeddocs']=$routeddocs;
			$data['count_routed']=count($routeddocs);
		}
		
		$this->load->view('mydocuments/mydoc_deferred', $data);
	}
	
	function forwarded(){
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
		$data['count_deferredroute']= $this->modeldts_documents->get_deferredroutes_count($mysectionID);
		//end basicpage data
		$data['all_othersections']=$this->modeldts_documents->get_othersections($mysectionID);
		$fwdrouteddocs=$this->modeldts_documents->get_docforwarded($mysectionID);
		if($fwdrouteddocs){
			$data['forwardeddocs']=$fwdrouteddocs;
			//$data['count_fwdroute']=count($fwdrouteddocs);
		}
		
		$this->load->view('mydocuments/mydoc_forwarded', $data);
		
	} 
	
	function track_view($track){
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
		$data['count_deferredroute']= $this->modeldts_documents->get_deferredroutes_count($mysectionID);
		//end basicpage data
		$data['all_othersections']=$this->modeldts_documents->get_othersections($mysectionID);
		$fwdrouteddocs=$this->modeldts_documents->get_docforwarded($mysectionID);
		if($track !==''){
			 $data['track_code']= $track;
			$data['doc_detail']= $this->modeldts_documents->get_docsdetails_bytrack($track);
			$data['track_data']= $this->modeldts_documents->get_docroutes_searched($track);
			
		 }
		
		 $this->load->view('mydocuments/mydoc_trackview', $data);
		
	}  
	
	
	function encode_mydocs()	{
		$mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
		$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
		$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
		$data['docsroute_count']=$this->modeldts_documents->get_docroutes_count($mysectionID);
		$data['pendingroute_count']=$this->modeldts_documents->get_pendingroutes_count($mysectionID);
		$data['tempdocs_count']=$this->modeldts_documents->get_my_tempdocs_count($mysectionID);
		$myschId= $this->modeldts_users->get_my_rowdetail('office_id');
		$data['myschool']= $this->modeldts_users->user_station();
		$data['co_users']=$this->modeldts_users->get_myco_users($mysectionID);
		$data['co_users_count']=$this->modeldts_users->get_myco_usersCount($mysectionID);
		$data['count_fwdroute']= $this->modeldts_documents->get_nonRec_docforwarded($mysectionID);
		$data['count_deferredroute']= $this->modeldts_documents->get_deferredroutes_count($mysectionID);
		//end basicpage data
		$data['docstypes']=$this->modeldts_documents->get_docstype();
		$data['receiving_sections']=$this->modeldts_documents->get_receiving_sections();
		
		$this->load->view('mydocuments/mydoc_submitdoc', $data);
	}
	
	
	
	function submit_document(){
	    $this->load->library('form_validation');
		$this->load->helper('security');		
		$this->form_validation->set_rules('submitted_by', 'Name', 'required|trim');			
		$this->form_validation->set_rules('submitter_id', 'Submitter ID', 'required|trim');
		$this->form_validation->set_rules('document_type_id', 'Document Type', 'required|trim');
		$this->form_validation->set_rules('submitter_section_id', 'Submitter Unit ID', 'required|trim');
		$this->form_validation->set_rules('tempdoc_description', 'Description', 'required|trim');
		$this->form_validation->set_rules('section_id', 'Section To', 'required|trim');
		
		if($this->form_validation->run()){
		$insert_tempdoc=$this->modeldts_documents->add_temp_docs();
		if(	$insert_tempdoc){
	   	if($this->modeldts_documents->get_all_sections()){$data['allsections']= $this->modeldts_documents->get_all_sections();}
		
		$data['submission_success']='Doc_ID:'. $insert_tempdoc.' Submitted succesfully.';
		$data['docstypes']=$this->modeldts_documents->get_docstype();
		//$this->load->view('documents', $data);
		redirect(base_url().'index.php/mydocuments'); 
		
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
		
		 $this->load->view('mydocuments/mydoc_trackview', $data);
	}
	}
	
	
	
	function get_users(){
     //set selected sections id from POST  
      $section_id = $this->input->post('unit_id',TRUE);//jquery post@ unit_id
	  if($section_id){
	  echo $section_id;
	  $usersData['usersDrop']=$this->modeldts_users->getUserBySection($section_id);  
		$output='<option style="visibility: hidden; display: none;"  >Select Personnel (Optional)</option>';
      foreach ($usersData['usersDrop'] as $row)   {  
	      $output .= "<option value='".$row->users_id."'>".$row->fullname."</option>";  		 
      } echo $output; } else { 
	  redirect(base_url());
	  }
	}		 
	
	function accept_routes (){
	       $this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('action_id', 'Route Id', 'required|trim');
			$this->form_validation->set_rules('accepting_remarks', 'Receiving Remarks', 'trim');
			if($this->form_validation->run()){
		$acceptdoc=$this->modeldts_documents->accept_routedoc();
		 if($acceptdoc){
			redirect(base_url().'documents/incoming/');
				
			}else { echo 'Error';}
		
			}else{ echo validation_errors();}
		
	}
	
	function error($error="")	{
		$mysectionID=$this->modeldts_users->get_my_rowdetail('dts_section_id');
		$data['mydetails']=$this->modeldts_users->get_mypersonal_details();
		$data['mysectionname']=$this->modeldts_documents->get_section_row($mysectionID,'section_description');
		$data['docsroute_count']=$this->modeldts_documents->get_docroutes_count($mysectionID);
		$data['pendingroute_count']=$this->modeldts_documents->get_pendingroutes_count($mysectionID);
		$data['tempdocs_count']=$this->modeldts_documents->get_my_tempdocs_count($mysectionID);
		$myschId= $this->modeldts_users->get_my_rowdetail('office_id');
		$data['myschool']= $this->modeldts_users->user_station();
		$data['co_users']=$this->modeldts_users->get_myco_users($mysectionID);
		$data['co_users_count']=$this->modeldts_users->get_myco_usersCount($mysectionID);
		$data['count_fwdroute']= $this->modeldts_documents->get_nonRec_docforwarded($mysectionID);
		$data['count_deferredroute']= $this->modeldts_documents->get_deferredroutes_count($mysectionID);
		//end basicpage data
		$data['docstypes']=$this->modeldts_documents->get_docstype();
		//$data['receiving_sections']=$this->modeldts_documents->get_receiving_sections();
		$data['receiving_sections']=$this->modeldts_documents->get_othersections($mysectionID);
		$data['error']=$error;
		
		$this->load->view('mydocuments/mydoc_forward_error', $data);
	}
	
	function forwarding_actions (){ //routing documents 
		    $this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('action_id', 'Route Id', 'required|trim');
			$this->form_validation->set_rules('actions', 'Actions Taken', 'required|trim');
			$this->form_validation->set_rules('document_id', 'Document Id', 'required|trim');
			$this->form_validation->set_rules('office_id', 'Section', 'required|trim');
			$this->form_validation->set_rules('users_id', 'Personnel', 'required|trim');
			$this->form_validation->set_rules('doc_copy', 'Document Copy', 'required|trim');
			$this->form_validation->set_rules('route_purpose', 'Original Route Purpose', 'required|trim');
			$this->form_validation->set_rules('fwd_remarks', 'FWD Remarks', 'trim');
			if($this->form_validation->run()){
		 $routeID= $this->input->post('action_id');
		if($this->modeldts_documents->is_not_acted_route($routeID))	{	
		  $actdoc = $this->modeldts_documents->acted_docroutes();
		  $routedoc =  $this->modeldts_documents->fwd_docroutes();
		  
		  if($actdoc){
			redirect(base_url().'mydocuments/pending/'. $routedoc);
				
			}else { echo 'Error';}
		} else {
			redirect(base_url().'mydocuments/error/43');
		}
			}else{ echo validation_errors();}
		
	}
	
	function fordeferred_actions(){
	 $this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('action_id', 'Route Id', 'required|trim');
			$this->form_validation->set_rules('actions', 'Actions Taken', 'required|trim');	
            $this->form_validation->set_rules('defby_userid', 'Your user ID', 'required|trim');	
			 $this->form_validation->set_rules('def_reason', 'Reasons to defer', 'required|trim');	
		if($this->form_validation->run()){
			$keepdoc = $this->modeldts_documents->deferred_docroutes();		  
			if($keepdoc){
			redirect(base_url().'index.php/mydocuments/pending/');
				
			}else { echo 'Error';}
		
		}else{ echo validation_errors();}
	 
	 
 }
	function edit_route(){
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('action_id', 'Route Id', 'required|trim');
			$this->form_validation->set_rules('office_id', 'Unit', 'required|trim');
			$this->form_validation->set_rules('users_id', 'Users', 'required|trim');
			if($this->form_validation->run()){
		  $editRoute = $this->modeldts_documents->edit_docroutes();
		if($editRoute){
			redirect(base_url().'index.php/mydocuments/forwarded');
				
			}else { echo 'Error';}
		
			}else{ echo validation_errors();}
		
	}

 function keepfile_actions(){
	 $this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('action_id', 'Route Id', 'required|trim');
			$this->form_validation->set_rules('actions', 'Actions Taken', 'required|trim');	
            $this->form_validation->set_rules('keptby_userid', 'Your user ID', 'required|trim');				
		if($this->form_validation->run()){
			$keepdoc = $this->modeldts_documents->kept_docroutes();		  
			if($keepdoc){
			redirect(base_url().'index.php/mydocuments/pending/');
				
			}else { echo 'Error';}
		
		}else{ echo validation_errors();}
	 
	 
 }
			
function forrelease_actions (){
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules('action_id', 'Route Id', 'required|trim');
			$this->form_validation->set_rules('actions', 'Actions Taken', 'required|trim');	
			$this->form_validation->set_rules('doc_copy', 'Document Copy', 'required|trim');
            $this->form_validation->set_rules('release_to', 'Released to', 'required|trim');	
			 $this->form_validation->set_rules('logbookpage', 'Logbook page', 'required|trim');
		if($this->form_validation->run()){
			$keepdoc = $this->modeldts_documents->release_docroutes();		  
			if($keepdoc){
			redirect(base_url().'mydocuments/pending/');
				
			}else { echo 'Error';}
		
		}else{ echo validation_errors();}


	}	
		



	
}//end class
