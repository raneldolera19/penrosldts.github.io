<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documents extends CI_Controller {
	
	public function __construct()
       {
            parent::__construct();
			$this->load->model('modeldts_documents');
			$this->load->model('modeldts_users');
		    $this->load->library('excel');
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->is_logged_in();
			$this->is_receiver();
       }
	public function index()	{
	// echo $this->modeldts_documents->is_not_acted_route(650);
	 $this->encode_mydocs();
	
	}
	
	
	function is_logged_in(){
		$is_logged_in= $this->session->userdata ('logged_in');
		if(!isset($is_logged_in)|| $is_logged_in != true){
			redirect(base_url());
		}
		}
		function is_receiver(){
			$receiver= $this->modeldts_documents->is_receiving_sections($this->modeldts_users->get_my_rowdetail('dts_section_id'));
		//	$dts_admin= $this->modeldts_documents->is_receiving_sections($this->modeldts_users->get_my_rowdetail('dts_section_id'));
			if(!$receiver){
			redirect(base_url().'mydocuments');
				}
		}	
		function is_dtsadmin(){
			$dts_admin=$this->modeldts_users->get_my_rowdetail('dts_admin');
			if($dts_admin!=1){
			redirect(base_url().'documents');
				}
		}

	function receiving($newid=""){
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
		$mytempdocs=$this->modeldts_documents->get_my_tempdocs($mysectionID);
		if($mytempdocs){
			$data['mytempdocs']=$mytempdocs;
			$data['count_forreceipt']=count($mytempdocs);
				}
		if($this->modeldts_documents->get_trackingcode($newid)){
		$data['track_code']=$this->modeldts_documents->get_trackingcode($newid);	
		$data['doc_details']=$this->modeldts_documents->get_docdetail($newid);
		}
		$this->load->view('documents/doc_for_receipt', $data);
		
	}	
	function edit_document($doc_id){
		$this->is_dtsadmin();
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
		$this->load->view('documents/doc_editdoc', $data);
		

	}	
	
	
	function incoming(){
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
		$routeddocs=$this->modeldts_documents->get_docroutes($mysectionID);
		
		if($routeddocs){
			$data['routeddocs']=$routeddocs;
			$data['count_routed']=count($routeddocs);
		}
		
		$this->load->view('documents/doc_incoming', $data);
		
	}
	function pending(){
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
		$routeddocs=$this->modeldts_documents->get_pendingroutes($mysectionID);
		if($routeddocs){
			$data['routeddocs']=$routeddocs;
			$data['count_routed']=count($routeddocs);
		}
		
		$this->load->view('documents/doc_pending', $data);
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
		
		$this->load->view('documents/doc_deferred', $data);
	}
	
	function forwarded($newid=""){
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
		$fwdrouteddocs=$this->modeldts_documents->get_docforwarded($mysectionID);
		$data['all_othersections']=$this->modeldts_documents->get_othersections($mysectionID);
		$countfwdrouteddocs=$this->modeldts_documents->get_nonRec_docforwarded($mysectionID);
		if($fwdrouteddocs){
			$data['forwardeddocs']=$fwdrouteddocs;
			$data['count_fwdroute']=$countfwdrouteddocs;
		}
		if($this->modeldts_documents->get_trackingcode($newid)){
		$data['track_code']=$this->modeldts_documents->get_trackingcode($newid);	
		$data['doc_details']=$this->modeldts_documents->get_docdetailB($newid);
		}
		$this->load->view('documents/doc_forwarded', $data);
		
	}
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
	 
	function all_list(){
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
		$alldoc_list=$this->modeldts_documents->get_allrouted_docs();
		if($alldoc_list){
			$data['alldocs']=$alldoc_list;
			$data['count_alldocs']=count($alldoc_list);	
		}
		
		$this->load->view('documents/doc_all_list', $data);
	}
	
	function re_entry($route){
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
		$data['docs_types']=$this->modeldts_documents->get_docstype_public();
		//$data['doc_details']=$this->modeldts_documents->get_docsdetails_bytrack($track);
		$data['doc_details']=$this->modeldts_documents->get_docsdetailby_route($route);
		$this->load->view('documents/doc_re_enterdoc', $data);
		
	}
	
	function get_users(){
     //set selected sections id from POST  
      $section_id = $this->input->post('unit_id',TRUE);//jquery post@ unit_id
	  if($section_id){
	//  echo $section_id;
	  $usersData['usersDrop']=$this->modeldts_users->getUserBySection($section_id);  
		$output='<option style="visibility: hidden; display: none;"  >Select Personnel </option>';
      foreach ($usersData['usersDrop'] as $row)   {  
	      $output .= "<option value='".$row->users_id."'>".$row->fullname."</option>";  		 
      } echo $output; } else { 
	  redirect(base_url());
	  }
	}		

 function duplicate_route($routeid="")	{
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
		if($routeid!=""){
		$data['route_details']=$this->modeldts_documents->get_routedetailby_id($routeid);
		}
		
		$this->load->view('documents/doc_routeduplicate', $data);
	}
	
	
	function encode_mydocs($newid="")	{
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
		if($this->modeldts_documents->get_trackingcode($newid)){
		$data['track_code']=$this->modeldts_documents->get_trackingcode($newid);	
		$data['doc_details']=$this->modeldts_documents->get_docdetailB($newid);
		}
		
		$this->load->view('documents/doc_submitdoc', $data);
	}
	
	function entry_voucher()	{
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
		
		$this->load->view('documents/doc_voucher', $data);
	}
	function entry_memo()	{
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
		$this->load->view('documents/doc_memo', $data);
	}
	
	
	function submit_document(){ // to any sections generates tracking code after sumbmission
	    $this->load->library('form_validation');
		$this->load->helper('security');		
		$this->form_validation->set_rules('submitted_by', 'Name', 'required|trim');			
		$this->form_validation->set_rules('submitter_id', 'Submitter ID', 'required|trim');
		$this->form_validation->set_rules('document_type_id', 'Document Type', 'required|trim');
		$this->form_validation->set_rules('submitter_section_id', 'Submitter Unit ID', 'required|trim');
		$this->form_validation->set_rules('tempdoc_description', 'Description', 'required|trim');
		$this->form_validation->set_rules('section_id', 'Section To', 'required|trim');
		
		if($this->form_validation->run()){
			$data=array(
			 'doc_type_id'=> $this->input->post('document_type_id'),
			 'tempdocs_id'=> '',
			'docs_description'=> $this->input->post('tempdoc_description'),//
			 'origin_fname'=> $this->input->post('submitted_by'),//
			'origin_userid'=> $this->input->post('submitter_id'),//
			'origin_school_id'=> $this->input->post('school_id'),
			'origin_school'=> $this->input->post('school'),//
			 'origin_section'=> $this->input->post('submitter_section_id'),//
			 'receiving_section'=> $this->input->post('section_id'),
			 'actions_needed'=> $this->input->post('actions_needed'),
			 'datetime_posted'=> date("Y-m-d H:i:s"),
			 'track_issuedby_userid'=> $this->input->post('submitter_id'),
		//	 'acceptedby_userid'=> $this->input->post('acceptedby_userid'),
			 'active'=> 1
			);
			
		$insertdoc=$this->modeldts_documents->add_and_routedoc($data);
		if(	$insertdoc){
	  		redirect(base_url().'documents/forwarded/'.$insertdoc);
		
		}else{
		echo 'Error';
					
		}
		}else{
		echo validation_errors();
	
	}
	}
	
	function submit_voucher(){ // to any sections generates tracking code after sumbmission
	      $this->load->library('form_validation');
		$this->load->helper('security');		
		$this->form_validation->set_rules('submitted_by', 'Name', 'required|trim');			
		$this->form_validation->set_rules('submitter_id', 'Submitter ID', 'required|trim');
		$this->form_validation->set_rules('document_type_id', 'Document Type', 'required|trim');
		$this->form_validation->set_rules('submitter_section_id', 'Submitter Unit ID', 'required|trim');
		$this->form_validation->set_rules('dv_number', 'Description', 'required|trim');
		$this->form_validation->set_rules('payee', 'Payee', 'required|trim');
		$this->form_validation->set_rules('particulars', 'Particulars', 'required|trim');
		$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
		$this->form_validation->set_rules('section_id', 'Section To', 'required|trim');
		
		if($this->form_validation->run()){
			$voucher_detail= $this->input->post('dv_number'). ' Payee: '. $this->input->post('payee'). ' for ' . $this->input->post('particulars').', Amount : '.$this->input->post('amount');
			$data=array(
			 'doc_type_id'=> 12,
			 'tempdocs_id'=> '',
			'docs_description'=> 'Disbursement Voucher : ' . $voucher_detail  ,//
			 'origin_fname'=> $this->input->post('submitted_by'),//
			'origin_userid'=> $this->input->post('submitter_id'),//
			'origin_school_id'=> $this->input->post('school_id'),
			'origin_school'=> $this->input->post('school'),//
			 'origin_section'=> $this->input->post('submitter_section_id'),//
			 'receiving_section'=> $this->input->post('section_id'),
			 'actions_needed'=> $this->input->post('actions_needed'),
			 'datetime_posted'=> date("Y-m-d H:i:s"),
			 'track_issuedby_userid'=> $this->input->post('submitter_id'),
			 'acct_dvnum'=> $this->input->post('dv_number'),
			 'acct_payee'=> $this->input->post('payee'),
			 'acct_particulars'=> $this->input->post('particulars'),
			 'acct_amount'=> $this->input->post('amount'),
		
			 'active'=> 1
			);
			
		$insertdoc=$this->modeldts_documents->add_and_routedoc($data);
		if(	$insertdoc){
	  		redirect(base_url().'documents/forwarded/'.$insertdoc);
		
		}else{
		echo 'Error';
					
		}
		}else{
		echo validation_errors();
	
	}
	}
	
	function submit_editdocument(){// going to the receiving sections only
	    $this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules('doc_id', 'Document ID', 'required|trim');
		$this->form_validation->set_rules('origin_school', 'Office or School', 'required|trim');			
		$this->form_validation->set_rules('origin_fname', 'Submitter Name', 'required|trim');
		$this->form_validation->set_rules('document_type_id', 'Document Type', 'required|trim');
		$this->form_validation->set_rules('user_id', 'Updater ID', 'required|trim');
		$this->form_validation->set_rules('docs_description', 'Description', 'required|trim');
		$this->form_validation->set_rules('actions_needed', 'Purpose / Actions to be Taken', 'required|trim');
		
		if($this->form_validation->run()){
		$update_doc=$this->modeldts_documents->edit_docby_id();
		if($update_doc){	
		redirect(base_url().'index.php/documents/incoming'); 
		}
		
		}else{
		echo validation_errors();
	
	}
	}
	
	function submit_document2(){// going to the receiving sections only
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
		redirect(base_url().'index.php/documents'); 
		
		}else{
		echo 'Error';
					
		}
		}else{
		echo validation_errors();
	
	}
	}
	
	function remove_tempdocument(){// going to the receiving sections only
	    $this->load->library('form_validation');
		$this->load->helper('security');		
		$this->form_validation->set_rules('tempdoc_id', ' Temporary Document ID', 'required|trim');			
				
		if($this->form_validation->run()){
		$remove_tempdoc=$this->modeldts_documents->remove_temp_docs();
		if(	$remove_tempdoc){
	  
		redirect(base_url().'index.php/documents/receiving/'); 
		
		}else{
		echo 'Error';
					
		}
		}else{
		echo validation_errors();
	
	}
	}
	
	function accept_tempdocument(){//for the documents encoded by others
		$this->load->library('form_validation');
				$this->load->helper('security');
				$this->form_validation->set_rules('docs_description', 'Document Description', 'required|trim');
				$this->form_validation->set_rules('actions_needed', 'Actions Needed', 'required|trim');
			if($this->form_validation->run()){
			$insertdoc=$this->modeldts_documents->receive_tempdocument();
			if($insertdoc){
			// $route=$this->modeldts_documents-> get_docdetail_array($insertdoc);
			redirect(base_url().'documents/receiving/'.$insertdoc);				
			}else { echo 'Error';}		
			}else{ echo validation_errors();}
		
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
			//echo $acceptdoc;
			
			}else { echo 'Error';}
		
			}else{ echo validation_errors();}
		
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
			redirect(base_url().'documents/pending/'. $routedoc);
				
			}else { echo 'Error';}
		} else {
			redirect(base_url().'documents/error/43');
		}
			}else{ echo validation_errors();}
		
	}
	function forwarding_reentry (){ //routing documents 
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
		  $actdoc = $this->modeldts_documents->acted_docroutes();
		  $routedoc =  $this->modeldts_documents->fwd_docroutes();
		  if($actdoc){
			redirect(base_url().'index.php/documents/pending/'. $routedoc);
				
			}else { echo 'Error';}
		
			}else{ echo validation_errors();}
		
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
		$alldoc_list= $this->modeldts_documents->get_docroutes_searched($track);
		if($alldoc_list){
		//	$data['alldocs']=$alldoc_list;
		//	$data['count_alldocs']=count($alldoc_list);	
		
		}
       if($track !==''){
		$data['track_code']= $track;
		if($this->modeldts_documents->get_docsdetails_bytrack($track)){
		$data['doc_detail']= $this->modeldts_documents->get_docsdetails_bytrack($track);
		}
		if($this->modeldts_documents->get_docroutes_searched($track)){
			$data['track_data']= $this->modeldts_documents->get_docroutes_searched($track);
			}
		 }
		
		 $this->load->view('documents/doc_trackview', $data);

		
	//	$this->load->view('documents/doc_search_list', $data);		  	  
	 }	
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
		
		$this->load->view('documents/doc_forward_error', $data);
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
			redirect(base_url().'index.php/documents/pending/');
				
			}else { echo 'Error';}
		
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
			redirect(base_url().'index.php/documents/pending/');
				
			}else { echo 'Error';}
		
		}else{ 
		
	//	echo validation_errors();
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
		$data['all_othersections']=$this->modeldts_documents->get_othersections($mysectionID);
		$routeddocs=$this->modeldts_documents->get_deferredroutes($mysectionID);
		$data['all_othersections']=$this->modeldts_documents->get_othersections($mysectionID);
		$routeddocs=$this->modeldts_documents->get_pendingroutes($mysectionID);
		if($routeddocs){
			$data['routeddocs']=$routeddocs;
			$data['count_routed']=count($routeddocs);
		}
		
		$this->load->view('documents/doc_pending', $data);
		}
	 
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
			redirect(base_url().'index.php/documents/pending/');
				
			}else { echo 'Error';}
		
		}else{ echo validation_errors();}


	}	
		
		
	function barcode($tracking) {
		$this->load->library('zend');
		$this->zend->load('Zend/Barcode');
		Zend_Barcode::render('code39', 'image', array('text' => $tracking), array());
 
 } //End of Barcode generation function
	
	
	function dts_backup(){
	$this->load->dbutil();
			$time = time();
			$newtime= gmdate("mdy_is", $time);
			$dbname= $newtime.'_dts_backup.gz';
			// Backup your entire database and assign it to a variable
			 $backup = $this->dbutil->backup();
			 $this->load->helper('download');
			 force_download($dbname, $backup);
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
			redirect(base_url().'index.php/documents/forwarded');
				
			}else { echo 'Error';}
		
			}else{ echo validation_errors();}
		
	}



// excel

	function excel_download(){
			$dbrecords= $this->modeldts_documents->get_routesExcel();		
			$rcount= count($dbrecords);
			if ($rcount>1){ // zero is 1 in count function
			//$this->_export_excel	
		//echo $rcount;
			}else {
			redirect(base_url().'index.php/documents/');	
			}
	}
	
	function _export_excel(){
	
		
	         $this->excel->setActiveSheetIndex(0);
			 $dbrecords= $this->modeldts_documents->get_routesExcel();		
			$rcount= count($dbrecords);// count the number row array in the database
			
                //name the worksheet
				
				//$tabname='Lists of Assets';
                $this->excel->getActiveSheet()->setTitle('Doc_Routes');
				$this->excel->getActiveSheet()->setShowGridlines(false);
				$this->excel->getDefaultStyle()->getFont()->setName('Arial Narrow');					  
			//	$this->excel->getDefaultStyle()->applyFromArray($styleArray);
						
                //set cell A1 content with some text
				$nametitle= 'All Routes ';
                $this->excel->getActiveSheet()->setCellValue('A1', 'Document Routes');
                $this->excel->getActiveSheet()->setCellValue('A2', 'Tracking');
                $this->excel->getActiveSheet()->setCellValue('B2', 'Category');
                $this->excel->getActiveSheet()->setCellValue('C2', 'Details/Subject');
				$this->excel->getActiveSheet()->setCellValue('D2', 'School/Office');
				$this->excel->getActiveSheet()->setCellValue('E2', 'Owner/Proponent');
				$this->excel->getActiveSheet()->setCellValue('F2', 'FWD From');
				$this->excel->getActiveSheet()->setCellValue('G2', 'FWD Date');
				$this->excel->getActiveSheet()->setCellValue('H2', 'FWD to');
				$this->excel->getActiveSheet()->setCellValue('I2', 'Main Purpose');
				$this->excel->getActiveSheet()->setCellValue('J2', 'FWD/Route Purpose');
				$this->excel->getActiveSheet()->setCellValue('K2', 'RCV by');
				$this->excel->getActiveSheet()->setCellValue('L2', 'RCV date');
				$this->excel->getActiveSheet()->setCellValue('M2', 'Actions Taken');
				$this->excel->getActiveSheet()->setCellValue('N2', 'Date Action Taken');
				$this->excel->getActiveSheet()->setCellValue('O2', 'Remarks');
                //merge cell A1 until C1
                $this->excel->getActiveSheet()->mergeCells('A1:F1');
                //set aligment to center for that merged cell (A1 to C1)
				$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				$this->excel->getActiveSheet()->getRowDimension('1')->setRowHeight(50);
						
				// FOR colum Titles
				$this->excel->getActiveSheet()->getRowDimension('2')->setRowHeight(25);
				$this->excel->getActiveSheet()->getStyle('A2:O2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $this->excel->getActiveSheet()->getStyle('A2:O2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle('A2:O2')->getFont()->setSize(10);
				$this->excel->getActiveSheet()->getStyle('A2:O2')->getFont()->setBold(true);
				$this->excel->getActiveSheet()->getStyle('A2:O2')->getAlignment()->setWrapText(true);
			//	$this->excel->getActiveSheet()->getStyle('A2:J2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFE8E5E5');
			
				$this->excel->getActiveSheet()->setAutoFilter('A2:N2');
			
						  $row_style = array(
						  						  
									'fill' => array(
										'type' => PHPExcel_Style_Fill::FILL_SOLID,
										'color' => array('rgb' => '02C7BD')
									),
									'borders' => array(
										'allborders' => array(
											'style' => PHPExcel_Style_Border::BORDER_THIN,
											'color' => array('rgb' => '000000')
										)
									)
								); 
								
				$this->excel->getActiveSheet()->getStyle('A2:O2')->applyFromArray($row_style);				
			   
			   //end column titles
	$rstyleArray = array(
						'font' => array(
										'size' => 10,
										'color' => array('rgb' => '000000')
									),
						'alignment' => array(
										'horizontal' =>PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
										'vertical' =>PHPExcel_Style_Alignment::VERTICAL_TOP,
										'wrap' => 1					
									),				
						'borders' => array(
									  'allborders' => array(
										  'style' => PHPExcel_Style_Border::BORDER_THIN,
										  'color' => array('rgb' => '000000')
									  )
								  )
							  );
	$rowcount=$rcount+2;// number of rows
	$allcell='A3:O'.$rowcount;
	$icells='O3:O'.$rowcount;
	$this->excel->getActiveSheet()->getStyle($allcell)->applyFromArray($rstyleArray); 
     $this->excel->getActiveSheet()->getStyle($icells)->getNumberFormat()->setFormatCode('#,##0.00');  

	 //------ for Title 
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
                $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);	
				$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Candara');	
			
			
			//----------------
 //      for($col = ord('A'); $col <= ord('S'); $col++){ //
		for($col = ord('A'); $col <= ord('M'); $col++){ 
                 //change the font size
		
             //   $this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(10);
              //  $this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);  
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setWidth(15);
				$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
				$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(22);
				$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
				$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(18);
				$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(22);
				$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(22);
	  }

		//		$rs= $this->model_inventories->get_mystation_inventory4excel();
				
                $exceldata="";

     //   foreach ($rs->result_array() as $row){
		foreach ($dbrecords as $row){
				if($row !='00/00/00 @ 12:00 AM'){$newrow = $row;} else {$newrow= '';} // display blank when datetime is 0000-00-00 00:00:00
                $exceldata = $newrow;
        }
                //Fill data
                $this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');
               $this->excel->getActiveSheet()->setSelectedCell('A1');// setting the active cell
			   //META DATA
				$this->excel->getProperties()->setCreator("Division Information System");
				$this->excel->getProperties()->setLastModifiedBy("Stephen Pascual");
				$this->excel->getProperties()->setTitle("Office 2007 XLSX Test Document");
				$this->excel->getProperties()->setSubject("Office 2007 XLSX Test Document");
				$this->excel->getProperties()->setDescription("Asset Registration Form.");
				$this->excel->getProperties()->setKeywords("office 2007 openxml php");
		 
		   $time = time();
			$newtime= gmdate("mdy_i", $time);
		 
			    $filename= 'DocRoutes_'.$newtime.'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache
                  //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');
                 

    }
			




	
}//end class
