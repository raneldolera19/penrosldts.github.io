<?php
class Modeldts_documents extends CI_Model{
	
	
	
	function add_new_section(){ 
			$data= array(
			 'section_description'=> $this->input->post('section_description'),
			 'office_id'=> $this->input->post('office_id'),
			 'initial_receipt' =>$this->input->post('allow_receipt'),
			 'active'=>1
			);		
			$did_add_section=$this->db->insert('dts_sections', $data);
			if ($did_add_section){
			return $this->db->insert_id();	
			//return TRUE;	
			}else {
				return FALSE;
			}
		}	
	function add_temp_docs(){
			$data= array(
			 'tempdoc_description'=> $this->input->post('tempdoc_description'),
			 'temp_doctype_id'=> $this->input->post('document_type_id'),
			 'fromsection_id'=> $this->input->post('submitter_section_id'),
			 'school_id'=> $this->input->post('school_id'),
			 'school'=> $this->input->post('school'),
			 'submitted_by' =>$this->input->post('submitted_by'),
			  'submitter_id' =>$this->input->post('submitter_id'),
			  'receiving_section_id' =>$this->input->post('section_id'),
			  'actions_needed' =>$this->input->post('actions_needed'),
			  'datetime_posted' =>date("Y-m-d H:i:s"),
			 'active'=>1
			);		
			$did_add_section=$this->db->insert('dts_tempdocs', $data);
			if ($did_add_section){
			return $this->db->insert_id();	
			//return TRUE;	
			}else {
				return FALSE;
			}
	
	}	
	
	function remove_temp_docs(){
		$tempdoc_id = $this->input->post('tempdoc_id');
		 $data= array(		 
		 'updatedby_id' => $this->input->post('removeby_id'),
		 'active' => 0	 
		 );
		 
		 $this->db->where('tempdoc_id', $tempdoc_id);
		 if($this->db->update('dts_tempdocs', $data))
		 {return TRUE;}else {return FALSE;}
	
	
	}
		
	function get_all_sections(){//include hidden
		$this->db->select();
		$this->db-> from ('dts_sections');
		$this->db->join('schools', 'schools.sch_id = dts_sections.office_id');
		$this->db->where ('dts_sections.active',1);
		$this->db->order_by ('section_description','ASC');
		
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	function get_sections(){//exclude hidden
		$this->db->select();
		$this->db-> from ('dts_sections');
		$this->db->join('schools', 'schools.sch_id = dts_sections.office_id');
		$this->db->where ('dts_sections.hidden',0);
		$this->db->where ('dts_sections.active',1);
		$this->db->order_by ('section_description','ASC');
		
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	function get_othersections($mysection){//exclude hidden
		$this->db->select();
		$this->db-> from ('dts_sections');
		$this->db->join('schools', 'schools.sch_id = dts_sections.office_id');
		$this->db->where ('dts_sections.hidden',0);
		$this->db->where ('dts_sections.active',1);
		$this->db->where ('dts_sections.section_id !=', $mysection);
		$this->db->order_by ('section_description','ASC');
		
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
		
	
	function get_receiving_sections(){
		$this->db->select();
		$this->db-> from ('dts_sections');
		$this->db->join('schools', 'schools.sch_id = dts_sections.office_id');
		$this->db->where ('dts_sections.active',1);
		$this->db->where ('initial_receipt',1);
		$this->db->order_by ('section_description','ASC');
		
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	
	function get_publicreceiving_sections(){
		$this->db->select();
		$this->db-> from ('dts_sections');
		$this->db->join('schools', 'schools.sch_id = dts_sections.office_id');
		$this->db->where ('dts_sections.active',1);
		$this->db->where ('initial_receipt',1);
		$this->db->where ('public_view',1);
		$this->db->order_by ('section_description','ASC');
		
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	
	
	function get_docstype(){
		$this->db->select();
		$this->db-> from ('dts_docstype');
		$this->db->where ('active',1);
		$this->db->order_by ('display_sequence','ASC');
		$this->db->order_by ('doctype_description','ASC');
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	
	function get_docsdetails_bytrack($track){ //for search by tracking code
		$this->db->select();
		$this->db-> from ('dts_docs');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('doc_tracking',$track);
		$this->db->where ('dts_docs.active',1);
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	function get_docsdetailby_route($routeid){ //for search by tracking code
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docroutes.action_id',$routeid);
		$this->db->where ('dts_docroutes.active',1);
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	
	function get_docsdetails_byid($doc_id){ //for search by tracking code
		$this->db->select();
		$this->db-> from ('dts_docs');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docs.doc_id',$doc_id);
		$this->db->where ('dts_docs.active',1);
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	
	



	
	
	function get_docstype_public(){
		$this->db->select();
		$this->db-> from ('dts_docstype');
		$this->db->where ('public_display',1);
		$this->db->where ('active',1);
		$this->db->order_by ('display_sequence','ASC');
		$this->db->order_by ('doctype_description','ASC');
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	
	function get_docroutes($sectionID){//routes not yet accepted
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docroutes.route_tosection_id',$sectionID);
		$this->db->where ('dts_docroutes.datetime_route_accepted',0);
		$this->db->where ('dts_docroutes.active',1);
		$this->db->order_by ('dts_docroutes.datetime_route_accepted','DESC');
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
	}
	
	function get_routedetailby_id($routeid){
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docroutes.action_id',$routeid);
		$this->db->where ('dts_docroutes.active',1);
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
	}
		
	
	
	
	function get_docroutes_searched($track){//routes not yet accepted
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docs.doc_tracking',$track);
		$this->db->where ('dts_docroutes.active',1);
		$this->db->order_by ('dts_docroutes.action_id', 'ASC');
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
	}
	
	
	
	function get_docforwarded($sectionID){//routes forwarded 
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docroutes.route_fromsection_id',$sectionID);
		$this->db->where ('dts_docroutes.active',1);
		$this->db->order_by ('dts_docroutes.datetime_route_accepted','ASC');
		$this->db->order_by ('dts_docroutes.datetime_forwarded','DESC');
		$this->db->limit(500);
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
	}
	
	function get_nonRec_docforwarded($sectionID){//routes forwarded not received
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docroutes.route_fromsection_id',$sectionID);
		$this->db->where ('dts_docroutes.received_by','');
		$this->db->where ('dts_docroutes.active',1);
		$this->db->order_by ('dts_docroutes.action_id','DESC');
		$this->db->limit(200);
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->num_rows();
		} else {return FALSE;}
	}
	
	function get_routesExcel(){
		$this->db->select('dts_docs.doc_tracking, dts_docstype.doctype_description , dts_docs.docs_description, dts_docs.origin_school,  route_from, route_fromsection, 
		DATE_FORMAT(datetime_forwarded, "%m/%d/%y @ %h:%i %p"), route_tosection, route_purpose, fwd_remarks, received_by, datetime_route_accepted, 
        actions_taken, actions_datetime, end_remarks 
		');
		$this->db-> from ('dts_docroutes');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docroutes.active',1);
		$this->db->order_by ('dts_docroutes.document_id','DESC');
	//	$this->db->limit(800);
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	
	function get_docroutes_count($sectionID){//routes not yet accepted
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->where ('dts_docroutes.route_tosection_id',$sectionID);
		$this->db->where ('dts_docroutes.datetime_route_accepted',0);
		$this->db->where ('dts_docroutes.active',1);
		$this->db->order_by ('dts_docroutes.datetime_route_accepted','DESC');
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->num_rows();
		} else {return FALSE;}
	}
	
	function get_pendingroutes($sectionID){//routes accepted but not yet acted
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('users', 'users.users_id = dts_docroutes.receivedby_id');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docroutes.route_tosection_id',$sectionID);
		$this->db->where ('dts_docroutes.actions_taken',"");
		$this->db->where ('dts_docroutes.datetime_route_accepted >',0); //is not 0 or blank
		$this->db->where ('dts_docroutes.active',1);
		$this->db->order_by ('dts_docroutes.datetime_route_accepted','DESC');
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
	}
	function get_pendingroutes_count($sectionID){//routes accepted but not yet acted
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docroutes.route_tosection_id',$sectionID);
		$this->db->where ('dts_docroutes.actions_taken',"");
		$this->db->where ('dts_docroutes.datetime_route_accepted >',0); //is not 0 or blank
		$this->db->where ('dts_docroutes.active',1);
		$this->db->order_by ('dts_docroutes.datetime_route_accepted','DESC');
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->num_rows();
		} else {return FALSE;}
	}
	
	function get_deferredroutes($sectionID){
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('users', 'users.users_id = dts_docroutes.receivedby_id');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docroutes.route_tosection_id',$sectionID);
		$this->db->where ('dts_docroutes.route_accomplished',4);
		$this->db->where ('dts_docroutes.datetime_route_accepted >',0); //is not 0 or blank
		$this->db->where ('dts_docroutes.active',1);
		$this->db->order_by ('dts_docroutes.datetime_route_accepted','DESC');
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
	}
	
function get_deferredroutes_count($sectionID){
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('users', 'users.users_id = dts_docroutes.receivedby_id');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docroutes.route_tosection_id',$sectionID);
		$this->db->where ('dts_docroutes.route_accomplished',4);
		$this->db->where ('dts_docroutes.datetime_route_accepted >',0); //is not 0 or blank
		$this->db->where ('dts_docroutes.active',1);
		$this->db->order_by ('dts_docroutes.datetime_route_accepted','DESC');
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->num_rows();
		} else {return FALSE;}
	}	
		
	
	
	function get_allrouted_docs(){ //limit to 1800
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docroutes.active',1);
		$this->db->order_by ('dts_docs.doc_tracking','DESC');
		$this->db->order_by ('dts_docroutes.datetime_route_accepted','ASC');
		$this->db->limit(1800);
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	
	function get_allacted_docs($sectionID){//limit to 1800
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->join('dts_docs', 'dts_docs.doc_id = dts_docroutes.document_id');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docroutes.route_fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docroutes.route_accomplished >',0);
		$this->db->where ('dts_docroutes.route_tosection_id',$sectionID);
		$this->db->where ('dts_docroutes.active',1);
		$this->db->order_by ('dts_docroutes.actions_datetime','DESC');
		$this->db->order_by ('dts_docroutes.datetime_route_accepted','ASC');
		$this->db->limit(1800);
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	
	function is_receiving_sections($id){
		$this->db->select();
		$this->db-> from ('dts_sections');
		$this->db->where ('section_id',$id);
		$this->db->where ('active',1);		
		$query= $this->db->get();
		$row = $query->row();
		if($row->initial_receipt==1){
		return TRUE;
		} else {
		return FALSE;
			}
	}
	function get_section_row($sectID,$col){ // for dts only
		$this->db->select();
		$this->db-> from ('dts_sections');
		$this->db->where ('section_id',$sectID);
		$this->db->where ('active',1);
	    $query= $this->db->get();
		$row = $query->row();
		if($query->num_rows()>0){
		return $row->$col;
		} else {return FALSE;}
		
	}
	
	
	function get_my_tempdocs($sectID){ //joins table
		$this->db->select();
		$this->db-> from ('dts_tempdocs');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_tempdocs.fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_tempdocs.temp_doctype_id');
		$this->db->where ('accepted',0);
		$this->db->where ('dts_tempdocs.active',1);
		$this->db->where ('receiving_section_id',$sectID);
		$this->db->order_by ('datetime_posted','DESC');
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
	function get_my_tempdocs_count($sectID){ //joins table
		$this->db->select();
		$this->db-> from ('dts_tempdocs');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_tempdocs.fromsection_id');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_tempdocs.temp_doctype_id');
		$this->db->where ('accepted',0);
		$this->db->where ('dts_tempdocs.active',1);
		$this->db->where ('receiving_section_id',$sectID);
		$this->db->order_by ('datetime_posted','DESC');
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->num_rows();
		} else {return FALSE;}
		
	}
	function get_trackingcode($doc_id){
		$this->db->select('doc_tracking');
		$this->db-> from ('dts_docs');
		$this->db->where ('doc_id',$doc_id);
		$this->db->where ('active',1);
		$query= $this->db->get();
		$row = $query->row();
		if($row){
		return $row->doc_tracking;
		}else{			
		return FALSE;
			}
		}
	
	function get_docdetail($doc_id){// for receiving documnets
		$this->db->select();
		$this->db-> from ('dts_docs');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docs.origin_section');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docs.doc_id',$doc_id);
		$this->db->where ('dts_docs.active',1);
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
		}
		
	function get_docdetailB($doc_id){// for forwarded documents
		$this->db->select();
		$this->db-> from ('dts_docs');
		$this->db->join('dts_sections', 'dts_sections.section_id = dts_docs.receiving_section');
		$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('dts_docs.doc_id',$doc_id);
		$this->db->where ('dts_docs.active',1);
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
		}
	function get_usernameby_id($id){// for the next
		$this->db->select();
		$this->db-> from ('users');
		$this->db->where ('users_id',$id);
		$this->db->where ('active',1);
	    $query= $this->db->get();
		$row = $query->row();
		if($query->num_rows()>0){
		return $row->fullname;
		} else {return "";}
	}	
	function search_track(){
		
		
		
	}
	
	function get_docdetail_array($doc_id){// for fetching array data for insert to docroute table
		$this->db->select();
		$this->db-> from ('dts_docs');
	//	$this->db->join('dts_sections', 'dts_sections.section_id = dts_docs.origin_section');
	//	$this->db->join('dts_docstype', 'dts_docstype.doctype_id = dts_docs.doc_type_id');
		$this->db->where ('doc_id',$doc_id);
		$this->db->where ('active',1);
		$query= $this->db->get();
		$row = $query->row();
		if($row){
		$data= $data=array(
		'document_id'=> $row->doc_id,
		'route_fromuser_id'=> $row->origin_userid,
		'route_from'=> $row->origin_fname,
		'route_fromsection_id'=> $row->origin_section,
		'route_fromsection'=> $this->get_sectionnameby_id($row->origin_section),
		'route_tosection_id'=> $row->receiving_section,
		'route_tosection'=> $this->get_sectionnameby_id($row->receiving_section),
		'receivedby_id'=> $row->acceptedby_userid,
		'received_by'=> $this->get_usernameby_id($row->acceptedby_userid),
		'route_purpose'=> $row->actions_needed,
		'datetime_forwarded'=> $row->datetime_posted,
		'datetime_route_accepted'=> $row->datetime_accepted,
		'active'=>1
		);
		return $data;
		}else{			
		return FALSE;
			}
		}
		
		
	function add_and_routedoc($data){// submission of docs from receiving sections self Receiving & Routing
			 
		$this->db->insert('dts_docs', $data);
		$newid=$this->db->insert_id();
		$intracking=$this->insert_doc_tracking($newid);
		if ($intracking){
			//route the document
			$route= $this->route_doc($newid);
			if($route){
			return $newid;	
			}else {
				return FALSE;
			}
			}else {
				return FALSE;
			}
		
			
	}
		
		
		
//	function route_tempdoc($doc_id){
	function route_doc($doc_id){	
		$data=$this->get_docdetail_array($doc_id);
    	$this->db->insert('dts_docroutes', $data);
		$newid=$this->db->insert_id();
		if ($newid){			
			return $newid;			
			}else {
			return FALSE;
			}
	}	
	
	function accept_routedoc(){
		$userID= $this->input->post('acceptedby_userid');
		$routed_id = $this->input->post('action_id');
		$doc_id=  $this->input->post('document_id');
		 $data= array(
		 'datetime_route_accepted' => date("Y-m-d H:i:s"),
		 'receivedby_id' => $this->input->post('acceptedby_userid'),
		 'received_by' => $this->input->post('acceptedby_fname'),
		 'accepting_remarks' => $this->input->post('accepting_remarks')
		 );
		
		 $this->db->where('action_id', $routed_id);
		 $upd=$this->db->update('dts_docroutes', $data);
		 if ($upd) {
			  if($this->check_ifnoreceived($this->input->post('document_id'))){
		 $this->update_doc_receiver($doc_id, $this->input->post('acceptedby_userid'));
			return TRUE;
		 } else {return TRUE;}	
	} else { return FALSE; }
	}
	function check_ifnoreceived($doc_id){ // it happens when receiving section submit docs, needs to be accepted when received by others
		$this->db->select();
		$this->db-> from ('dts_docs');
		$this->db->where ('doc_id',$doc_id);
		$this->db->where ('acceptedby_userid',0);
		$this->db->where ('active',1);
		$query= $this->db->get();
		$row = $query->row();
		if($query->num_rows()>0){
		return TRUE;
		} else {
			return FALSE;}
		
	}
	function is_not_acted_route($routeID){
		$this->db->select();
		$this->db-> from ('dts_docroutes');
		$this->db->where ('action_id',$routeID);
		$this->db->where ('route_accomplished' , 1);
		$this->db->where ('active',1);
		$query= $this->db->get();
		$row = $query->row();
		if($query->num_rows()>0){
		return FALSE; // kung naa na action return false
		} else {
			return TRUE;}
		
	}
	
	function update_doc_receiver($doc_id,$userID){
		$data= array(
		'acceptedby_userid'=> $userID,
		'datetime_accepted'=> date("Y-m-d H:i:s")
		);
		 $this->db->where('doc_id', $doc_id);
		 if($this->db->update('dts_docs', $data)){
			return TRUE; 
		 }else { return FALSE; }
	}	
	
	
	function receive_tempdocument(){
		
	  $data=array(
			 'doc_type_id'=> $this->input->post('doc_type_id'),
			 'tempdocs_id'=> $this->input->post('tempdocs_id'),
			'docs_description'=> $this->input->post('docs_description'),
			 'origin_fname'=> $this->input->post('origin_fname'),
			'origin_userid'=> $this->input->post('origin_userid'),
			'origin_school_id'=> $this->input->post('school_id'),
			'origin_school'=> $this->input->post('school'),
			 'origin_section'=> $this->input->post('origin_section'),
			 'receiving_section'=> $this->input->post('receiving_section'),
			 'actions_needed'=> $this->input->post('actions_needed'),
			 'datetime_posted'=> $this->input->post('datetime_posted'),
			 'datetime_accepted'=> date("Y-m-d H:i:s"),
			 'acceptedby_userid'=> $this->input->post('acceptedby_userid'),
			 'track_issuedby_userid'=> $this->input->post('acceptedby_userid'),
			 'active'=> 1
			);
		$this->db->insert('dts_docs', $data);
		$newid=$this->db->insert_id();
		$intracking=$this->insert_doc_tracking($newid);
		$tempdoc_id=$this->input->post('tempdocs_id');
		if ($intracking){
			if($this->accept_tempdoc($tempdoc_id)){
			//	$this->route_tempdoc($newid);
				$this->route_doc($newid);
			return $newid;	
			}
			}else {
				return FALSE;
			}
		
	}
	
	function acted_docroutes(){
		$routed_id = $this->input->post('action_id');
		 $data= array(
		 'actions_datetime' => date("Y-m-d H:i:s"),
		  'actions_taken' => $this->input->post('actions'),
		 'actedby_id' => $this->input->post('fwdby_userid'),
		  'acted_by' => $this->input->post('fwdby_fname'),
		 'doc_copy' => $this->input->post('doc_copy'),
		 'route_accomplished' => 1 ,   // No. 1 if forwarded, 2 if copy received no forwarding, 3 released to persons w/o users acct.
		 'end_remarks' => 'Forwarded to '. $this->get_sectionnameby_id($this->input->post('office_id')) 
		 );
		 
		 $this->db->where('action_id', $routed_id);
		 if($this->db->update('dts_docroutes', $data))
		 {return TRUE;}else {return FALSE;}
		
	}
	 function edit_docby_id(){
		 $doc_id = $this->input->post('doc_id');
		 $data= array(
		 'origin_fname' =>$this->input->post('origin_fname'),		 
		 'origin_school' =>$this->input->post('origin_school'),
		 'doc_type_id'=>$this->input->post('document_type_id'),
		 'docs_description' =>$this->input->post('docs_description') ,
		  'actions_needed' => $this->input->post('actions_needed'),
		 'updatedby_id'=> $this->input->post('user_id')	 
		 );
		 
		 $this->db->where('doc_id', $doc_id);
		 if($this->db->update('dts_docs', $data))
		 {return TRUE;}else {return FALSE;}
		
		 
	 }
	
	function edit_docroutes(){
		$routed_id = $this->input->post('action_id');
		 $data= array(
		 'route_tosection_id' => $this->input->post('office_id'),
		 'route_tosection' => $this->get_sectionnameby_id($this->input->post('office_id')),
		 'fwd_remarks' => $this->input->post('fwd_remarks'),
		 'datetime_forwarded'=> date("Y-m-d H:i:s"),		 
		 );
		 
		 $this->db->where('action_id', $routed_id);
		 if($this->db->update('dts_docroutes', $data))
		 {return TRUE;}else {return FALSE;}
		
	}
	
	// for deactivating 
	
	 function deactivate_docby_id($data){
		 $doc_id= $this->input->post('doc_id');
		 $this->db->where('doc_id', $doc_id);
		 if($this->db->update('dts_docs', $data))
		 {return TRUE;}else {return FALSE;}
		 
	 }
	function deactivate_routesby_docid($data){
		$doc_id= $this->input->post('doc_id');
		 $this->db->where('document_id', $doc_id);
		 if($this->db->update('dts_docroutes', $data))
		 {return TRUE;}else {return FALSE;}
		 
	 }
	
	
	
	///----------
	
	
	
	function get_sectionnameby_id($sectID){
		$this->db->select();
		$this->db-> from ('dts_sections');
		$this->db->where ('section_id',$sectID);
		$this->db->where ('active',1);
	    $query= $this->db->get();
		$row = $query->row();
		if($query->num_rows()>0){
		return $row->section_description;
		} else {return "";}
		
	}
	function fwd_docroutes(){
		$from = $this->input->post('fwdby_section_id');
		$to = $this->input->post('office_id');
		
		$data= array(
		 'document_id' => $this->input->post('document_id'),
		 'previous_route_id' => $this->input->post('action_id'),
		 'route_fromuser_id'=> $this->input->post('fwdby_userid'),
		 'route_from'=> $this->input->post('fwdby_fname'),
		'route_fromsection_id'=> $this->input->post('fwdby_section_id'),
		'route_fromsection'=> $this->get_sectionnameby_id($from),
		'route_tosection_id'=> $this->input->post('office_id'),
		'route_tosection'=> $this->get_sectionnameby_id($to),
		'route_touser_id'=> $this->input->post('users_id'),
		'route_purpose'=> $this->input->post('route_purpose'),
		'fwd_remarks'=> $this->input->post('fwd_remarks'),
		'datetime_forwarded' => date("Y-m-d H:i:s")
		
		
		
		 );
		$this->db->insert('dts_docroutes', $data);
		$newroute_id=$this->db->insert_id();
		if ($newroute_id){			
			return $newroute_id;			
			}else {
			return FALSE;
			}
		
	}
	
	function re_enter_docroutes(){
		$from = $this->input->post('fwdby_section_id');
		$to = $this->input->post('office_id');
		
		$data= array(
		 'document_id' => $this->input->post('document_id'),
		 'previous_route_id' => $this->input->post('action_id'),
		 'route_fromuser_id'=> $this->input->post('fwdby_userid'),
		 'route_from'=> $this->input->post('fwdby_fname'),
		'route_fromsection_id'=> $this->input->post('fwdby_section_id'),
		'route_fromsection'=> $this->get_sectionnameby_id($from),
		'route_tosection_id'=> $this->input->post('office_id'),
		'route_tosection'=> $this->get_sectionnameby_id($to),
		'route_touser_id'=> $this->input->post('users_id'),
		'route_purpose'=> $this->input->post('route_purpose'),
		'fwd_remarks'=> $this->input->post('fwd_remarks'),
		'datetime_forwarded' => date("Y-m-d H:i:s"),
		'duplicate'=> $this->input->post('duplicate'),
		
		
		 );
		$this->db->insert('dts_docroutes', $data);
		$newroute_id=$this->db->insert_id();
		if ($newroute_id){			
			return $newroute_id;			
			}else {
			return FALSE;
			}
		
	}
	
	function kept_docroutes(){
		$routed_id = $this->input->post('action_id');
		 $data= array(
		 'actions_datetime' => date("Y-m-d H:i:s"),
		 'actions_taken' => $this->input->post('actions'),
		 'actedby_id' => $this->input->post('keptby_userid'),
		  'acted_by' => $this->input->post('acted_by'),
		 'doc_copy' => 1,
		 'route_accomplished' => 2,     // No. 1 if forwarded, 2 if copy received no forwarding, 3 released to persons w/o users acct.
		 'end_remarks' => $this->input->post('end_remarks') 
		 );
		 
		 $this->db->where('action_id', $routed_id);
		 if($this->db->update('dts_docroutes', $data))
		 {return TRUE;}else {return FALSE;}
		
	}
	
	function release_docroutes(){
		$routed_id = $this->input->post('action_id');
		 $data= array(
		 'actions_datetime' => date("Y-m-d H:i:s"),
		 'actions_taken' => $this->input->post('actions'),
		 'actedby_id' => $this->input->post('fwdby_userid'),
		 'doc_copy' => $this->input->post('doc_copy'),
		 'out_released_to' => $this->input->post('release_to'),
		 'logbook_page' => $this->input->post('logbookpage'),
		 'route_accomplished' => 3,    // No. 1 if forwarded, 2 if copy received no forwarding, 3 released to persons w/o users acct.
		 'end_remarks' =>  'Released to '.  $this->input->post('release_to'). '. Refer to logbook page : '. $this->input->post('logbookpage')
		 );
		 
		 $this->db->where('action_id', $routed_id);
		 if($this->db->update('dts_docroutes', $data))
		 {return TRUE;}else {return FALSE;}
		
	}
	
	function deferred_docroutes(){
		$routed_id = $this->input->post('action_id');
		 $data= array(
		 'actions_datetime' => date("Y-m-d H:i:s"),
		 'actions_taken' => $this->input->post('actions'),
		 'actedby_id' => $this->input->post('defby_userid'),
		  'acted_by' => $this->input->post('defby_fname'),
		 'route_accomplished' => 4,     // No. 1 if forwarded, 2 if copy received no forwarding, 3 released to persons w/o users acct, 4 deferred documents.
		 'end_remarks' => $this->input->post('end_remarks'),
		  'def_reason' => $this->input->post('def_reason'),
		  'def_datetime' => date("Y-m-d H:i:s")
		 );
		 
		 $this->db->where('action_id', $routed_id);
		 if($this->db->update('dts_docroutes', $data))
		 {return TRUE;}else {return FALSE;}
		
	}
	
	function insert_doc_tracking($doc_id){//inserting continous tracking number
		$pre=date("y");
		 $data= array('doc_tracking'=>$pre.'-'.$doc_id	);
		 $this->db->where('doc_id', $doc_id);
		 if($this->db->update('dts_docs', $data))
		 {return TRUE;}else {return FALSE;}
	}
	
	function insert_doc_tracking_2($doc_id){//inserting tracking number, resetting each year
	    $prevtracking= $this->get_trackingcode($doc_id-1);
		//split tracking code then check if year is this year
		
		$yr = 17;
		$track = 1;		
		$pre=date("y");
		
		if($yr==$pre){
			$newtrack = $track +1;
		}else {
			$newtrack = 1;
		}
		return $prevtracking;
	//	$data= array('doc_tracking'=>$pre.'-'.$newtrack	);
	//	 $this->db->where('doc_id', $doc_id);
	//	 if($this->db->update('dts_docs', $data))
	//	 {  
			// return TRUE;
	//		 }else {return FALSE;}
	}
	
	function accept_tempdoc($tempdoc_id){ //connected add_tempdocument
		 $data= array('accepted'=>1	);
		 $this->db->where('tempdoc_id', $tempdoc_id);
		 if($this->db->update('dts_tempdocs', $data))
		 {return TRUE;}else {return FALSE;}
	}	

	
	
	
	function update_section(){
	   	$data= array(
		'section_description'=>$this->input->post('section_description'),
		'office_id' =>$this->input->post('office_id'),
		'initial_receipt' =>$this->input->post('allow_receipt'),
		'active'=>1
		);
		$this->db->where('section_id', $this->input->post('section_id'));			
		 if($this->db->update('dts_sections', $data))
		 {return TRUE;}else {return FALSE;}
	
	}
	
	
	
	
	
	
	
	
	function has_my_section_name(){ // check section has other duplicate with in my office
		$this->db->select();
		$this->db-> from ('dts_sections');
		$this->db->where ('section_description', $this->input->post('section_description'));
		$this->db->where('office_id', $this->input->post('office_id') );
		$this->db->where('section_id !=', $this->input->post('section_id'));
		$query= $this->db->get();
		$row = $query->row();
		if ($row){
			return TRUE;
		}else { return FALSE;}	
		}
	
	
	
	

	
}// end class