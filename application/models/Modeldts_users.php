<?php
class Modeldts_users extends CI_Model{
	
	function add_temp_user($key){
		if ($this->secure_signups()){
		$data= array(
			'email'=>$this->input->post('email'), 
			'password'=>$this->hassed_passphrase($this->input->post('password')), 
		    'actkey'=>$key,
			'fullname '=>$this->input->post('name')
			 );
		$query = $this->db->insert('temp_users', $data);
		if($query){
			return true;
		}else{
			return false;
		}
		}else{
		return false;}	
	}
	
	//secure sign ups- LIMIT application
	function secure_signups(){
		$query = $this->db->query("SELECT * FROM temp_users");
		$rows=$query->num_rows();
		if ($rows<100){
		return TRUE;
		} else {return FALSE;}
	}	
	
	function get_userdata_by_email($email){
		if(isset($email)){
		$this->db->select();
		$this->db-> from ('users');
		$this->db->where ('email',$email);
		$this->db->where ('active',1);
	    $query= $this->db->get();
		return $query->row();
		} 
		else
		{ return NULL;}
	}
	
	function is_user_approved(){
		$userID=$this->session->userdata ('userID');
		$query = $this->db->query("SELECT * FROM users WHERE users_id='{$userID}' AND active='1'");
		$row = $query->row();
		if (isset($row)){
			$approve= $row->approved;
			if ($approve==1){return TRUE;}else{return FALSE;}			
			} else { return FALSE;}
	}
	
	function is_user_record_admin(){
		$userID=$this->session->userdata ('userID');
		$this->db->select();
		$this->db-> from ('users');
		$this->db->where ('users_id',$userID);
		$this->db->where ('dts_admin',1);
		$this->db->where ('active',1);
	    $query= $this->db->get();
		$row = $query->row();
		if ($row){
			return TRUE;
		}else { return FALSE;
		
		}	
	}
	
	function is_user_admin(){
		$userID=$this->session->userdata ('userID');
		$this->db->select();
		$this->db-> from ('users');
		$this->db->where ('users_id',$userID);
		$this->db->where ('user_type','System Administrator');
		$this->db->where ('active',1);
	    $query= $this->db->get();
		$row = $query->row();
		if ($row){
			return TRUE;
		}else { return FALSE;}
		
	}
	// for super admin userID
	function is_user_superadmin(){
		$userID=$this->session->userdata ('userID');
		if ($userID==1){// stephen userID is 1
			return TRUE;
		}else { return FALSE;}
	}
	// for system admin protection (etc. from deletion)
	function is_protected_account($userID){
		$this->db->select();
		$this->db-> from ('system_config');
		$this->db->where ('super_adminuser_id',$userID);
	    $query= $this->db->get();
		$row = $query->row();
		if ($row){
			return TRUE;
		}else { return FALSE;}	
	}
	//-- for dropdown  form add inventory form-- 	 
	function get_subcategories($category = null){
		 $this->db->select('subcategory_id, subcat_description');
		 if($category != NULL){
		 $this->db->where('category_id', $category);
		 }
		 $query = $this->db->get('inv_asset_subcategory');
		 $subcategories = array();
		 if($query->result()){
		 foreach ($query->result() as $subcategory) {
		 $subcategories[$subcategory->subcategory_id] = $subcategory->subcat_description;
		 }
		 return $subcategories;
		 }else{
		 return FALSE;
		 }
		}	 
		 
	//-- for dropdown  form add document form-- 	 
	function get_usersname($unit = null){
		 $this->db->select('users_id, fullname');
		 if($unit != NULL){
		
		 $this->db->where('dts_section_id', $unit);
		 }
		 $query = $this->db->get('users');
		 $users = array();
		 if($query->result()){
		 foreach ($query->result() as $user) {
		 $users[$user->users_id] = $user->fullname;
		 }
		 return $users;
		 }else{
		 return FALSE;
		 }
		}	
	
	function reset_userpassword(){
		$userID=$this->input->post('newuser_id');
		//$newpass=$this->hassed_passphrase($this->input->post('newpassword'));
		$newpass=$this->input->post('newpassword');
		$data= array('password'=>$newpass, 'secured_pass'=>0);
		$this->db->where('users_id', $userID);			
		 if($this->db->update('users', $data))
		 {return TRUE;}else {return FALSE;}
	}
	
	function is_current_password(){
		$userID=$this->session->userdata ('userID');
		//$currentpass= $this->hassed_passphrase($this->input->post('currentpassword'));
		$currentpass=$this->input->post('currentpassword');
		$this->db->select();
		$this->db-> from ('users');
		$this->db->where ('users_id',$userID);
		$this->db->where ('password',$currentpass);
		$this->db->where ('active',1);
	    $query= $this->db->get();
		$row = $query->row();
		if ($row){
			return TRUE;
		}else { return FALSE;}
		
	}
	function get_mypersonal_details(){ // for dts only
		$userID=$this->session->userdata ('userID');
		$this->db->select();
		$this->db-> from ('users');
		$this->db->where ('users_id',$userID);
		$this->db->where ('users.active',1);
		$this->db->join('dts_sections', 'dts_sections.section_id = users.dts_section_id');
	    $query= $this->db->get();
		//return $query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
		
	}
    function get_myco_users($unitID){// co-users in i unit
		$this->db->select();
		$this->db-> from ('users');
		$this->db->where ('dts_section_id',$unitID);
		$this->db->where ('users.active',1);
		$query= $this->db->get();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
	}
	
	 function get_myco_usersCount($unitID){// co-users in i unit
		$this->db->select();
		$this->db-> from ('users');
		$this->db->where ('dts_section_id',$unitID);
		$this->db->where ('users.active',1);
		$query= $this->db->get();
		if($query->num_rows()>0){
		return $query->num_rows();
		} else {return FALSE;}
	}
	
	
	
	function get_my_rowdetail($col){ // for dts only
		$userID=$this->session->userdata ('userID');
		$this->db->select();
		$this->db-> from ('users');
		$this->db->join('dts_sections', 'dts_sections.section_id = users.dts_section_id');
		$this->db->where ('users_id',$userID);
		$this->db->where ('users.active',1);
	    $query= $this->db->get();
		$row = $query->row();
		//return $query->result_array();
		if($query->num_rows()>0){
		return $row->$col;
		} else {return FALSE;}
		
	}
		
	
	function user_station(){
		$userID=$this->session->userdata ('userID');
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users_id',$userID);
		$this->db->join('schools', 'schools.sch_id = users.station_id');
		$query = $this->db->get();
		$row = $query->row();
		if (isset($row)){
			return $row->school_name;
				} 
		else
		{ return NULL;}
		}
	
	
	function get_logged_userdata(){
		$userID=$this->session->userdata ('userID');
		return $this->get_userdata_by_id($userID);
	}
	
	function get_userdata_by_id($id=0){
		 $this->db->select();
		$this->db-> from ('users');
		$this->db->where ('users_id',$id);
		$this->db->join('schools', 'schools.sch_id = users.station_id');
	//	$this->db->order_by ('description','ASC');
		$query= $this->db->get();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
	
	}
	function get_userlist(){
		$this->db->select('users_id, fullname, sex, email, contact_number, last_name, first_name, approved, station_id, dts_section_id, users.active, schools.school_name');
		//$this->db->select();
		$this->db-> from ('users');
		$this->db->where ('users.active',1);
		$this->db->join('schools', 'schools.sch_id = users.station_id');
		$this->db->order_by ('users.last_name','ASC');
		$query= $this->db->get();
		//return $query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
	}
	
	function getUserBySection($section_id) {  
      $this->db->select('users_id,fullname');  
      $this->db->from('users');  
      $this->db->where('dts_section_id',$section_id);  
      $query = $this->db->get();  
     if($query->num_rows()>0){
	 return $query->result(); //not array
	 } else {return FALSE;}
   }   
	
	
	function get_schools(){
		$this->db->select();
		$this->db-> from ('schools');
		$this->db->where ('active',1);
		$this->db->order_by ('school_name','ASC');
		$query= $this->db->get();
		$query->result_array();
		if($query->num_rows()>0){
		return $query->result_array();
		} else {return FALSE;}
					
		}
		function get_schoolname_byid($sch_id=0){
		$query = $this->db->query("SELECT * FROM schools WHERE sch_id='{$sch_id}' AND active='1'");
		$row = $query->row();
		if (isset($row)){
			return $row->school_name;
			} else { return FALSE; }
					
		}
	
	function get_userfullname_by_email($email=""){
		$query = $this->db->query("SELECT * FROM users WHERE email='{$email}'");
		$row = $query->row();
		if (isset($row)){
			return $row->first_name.' '.$row->last_name;
			} else { return FALSE; }
					
		}
	function get_userfullname_by_id($userID=""){
		$query = $this->db->query("SELECT * FROM users WHERE users_id='{$userID}'");
		$row = $query->row();
		if (isset($row)){
			return $row->first_name.' '.$row->last_name;
			} else { return FALSE; }
					
		}	
		
		
	function get_userID_by_email($email=""){
		$query = $this->db->query("SELECT * FROM users WHERE email='{$email}'");
		$row = $query->row();
		if (isset($row)){
			return $row->users_id;
			} else { return FALSE; }
					
		}
	function can_log_in(){
	//	$hasspass=$this->hassed_passphrase ($this->input->post('password'));
		$this->db->where('email', $this->input->post('email'));
	//	$this->db->where('password',$this->hassed_passphrase ($this->input->post('password')));
		$this->db->where('password',$this->input->post('password'));
		$query=$this->db->get('users');
		
	   if($query->num_rows()==1){
		   return TRUE;
	   }else {
		   return FALSE;
	   }
	
	}

	function hassed_passphrase($password=""){ 
		$saltkey='qW3Mr4mL3Az51fOsvKV7W7Li6vBfpPtj';
		$salt_a='5ae7U467wqH';
		$salt_b='$G$'.substr(sha1($password.$saltkey),-4).'J.';
		$salt_c='.'.substr(sha1($password.$salt_b."xsi3"),-8).substr(sha1($salt_a.$salt_b),-3);
	if ($password!=""){
		$hassed_password=$salt_b. md5($saltkey.$password).$salt_c;	
		return $hassed_password;	
		} else {
			$hassed_password="";
			return $hassed_password;
		}
}	
	function random_password($length = 8) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZh123456789&";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}
	function validation_key(){ 
	    $chars = "abcdefghijkmnopABCDEFGHIJKLMNqrstuvwxyzABCDEFGHIJKLMNP
		QRuvSTUVWXYZ0123456789xabcdefghijkmABCDEFGHIJKLMNnopqrstuvwxyzAB
		CDEFGHIJKuvLMNPQRSTUVWXYZ0123456789";
		$longkey = substr( str_shuffle( $chars ), 0, 100 );	
		$key1="o5dei94n".time();
		$key2= 'kliW';//uniqid();
		$key4=substr(sha1($key2.$key1."xsi3"),-rand(8,25));
		return sha1($key2.$key1).$key4.$longkey;	
}	
	
	function is_key_valid($key){		
		$this->db->where('actkey', $key);
		$query=$this->db->get('temp_users');
		if($query->num_rows()==1){
			return TRUE;			
		}else{ 
		return FALSE;
		}		
	}
	
	
	
	function email_not_duplicate($key){
		// Sub Query
		$this->db->select('email')->from('temp_users')->where('actkey',$key);
		$subQuery =  $this->db->get_compiled_select();
 	// Main Query
	$mainQuery=	$this->db->select('*')
				->from('users')
				->where("email IN ($subQuery)", NULL, FALSE)
				->get()
				->num_rows();
		if ($mainQuery>0){
			return FALSE;
		}else { 
			return TRUE;
		}		
	}
	
	function add_dts_user (){ // manual adding from system admin
		if($this->input->post('sex')=='female'){ $img='assets/dist/img/avatar3.png';}else{$img='assets/dist/img/avatar5.png';}
		$data= array(
		 'email'=> $this->input->post('user_email'),
		 'fullname'=>$this->input->post('firstname') .' '. $this->input->post('lastname'),
		 'contact_number'=>$this->input->post('contactnumber'),
		// 'password'=> $this->hassed_passphrase($this->input->post('password')), 
		 'password'=>$this->input->post('password'),
		// 'default_password'=> $this->input->post('default_password'), 
		 'first_name'=> $this->input->post('firstname'),
		 'middle_name'=> $this->input->post('middlename'),
		 'last_name'=> $this->input->post('lastname'),
		 'sex'=> $this->input->post('sex'),
		 'designation'=> $this->input->post('designation'),
		 'dts_section_id'=> $this->input->post('section_id'),
		 'dts_image_url'=> $img,
		 'station_id'=> $this->input->post('office_id'),
		 'school_head'=>$this->input->post('schoolhead'),
		 'ict_coordinator'=>$this->input->post('ictcoordinator'),
		 'property_custodian'=>$this->input->post('propertycustodian'),
		 'approved'=>1,
		 'active'=>1
		);
		
		$did_add_user=$this->db->insert('users', $data);
		if ($did_add_user){
		return TRUE;	
		}else {
			return FALSE;
		}
	}

	function get_user_stationid_by_userid($id){
		$query = $this->db->query("SELECT * FROM users WHERE users_id='{$id}'");
		$row = $query->row();
		if (isset($row)){
			return $row->station_id;
			} else { return FALSE; }
					
		}
	function has_my_email(){ // check email has other duplicate
		$usermail=$this->input->post('user_email');
		$usrID=$this->input->post('user_id');
		$this->db->select();
		$this->db-> from ('users');
		$this->db->where ('email', $usermail);
		$this->db->where('users_id !=', $usrID );
		$query= $this->db->get();
		$row = $query->row();
		if ($row){
			return TRUE;
		}else { return FALSE;}	
		}	
	
     
	function update_dts_user(){ //from system admin
		$userID=$this->input->post('user_id'); // from hidden input
		if($this->input->post('sex')=='male'){$img='assets/dist/img/avatar5.png';}else {$img='assets/dist/img/avatar3.png';}
		$data= array(
		'fullname'=> $this->input->post('firstname').' '. $this->input->post('lastname'), 
		'email'=> $this->input->post('user_email'),
		'first_name'=> $this->input->post('firstname'),
		'middle_name'=> $this->input->post('middlename'),
		'last_name'=> $this->input->post('lastname'),
		'contact_number'=> $this->input->post('contactnumber'),
		'sex'=> $this->input->post('sex'),
		'designation'=> $this->input->post('designation'),
		//'dts_image_url'=> $img,
		'station_id'=> $this->input->post('station'),
		'dts_section_id'=> $this->input->post('section_id')
		);
		$this->db->where('users_id', $userID);			
		 if($this->db->update('users', $data)){
		if($this->db->affected_rows()>0){	 
		return TRUE;} else {
		return FALSE;
		}
		 } 
		 else {return FALSE;}
		
	}	
	
	
	function approve_the_user(){
		$userID=$this->input->post('newuser_id');
		$data= array('approved'=>'1');
		$this->db->where('users_id', $userID);			
		 if($this->db->update('users', $data))
		 {return TRUE;}else {return FALSE;}
		
	}

	function disapprove_the_user(){
		$is_protected=$this->is_protected_account($this->input->post('newuser_id'));
		if(!isset($is_protected)|| $is_protected != true){
		$userID=$this->input->post('newuser_id');
		$data= array('approved'=>'0');
		$this->db->where('users_id', $userID);			
		 if($this->db->update('users', $data))
		 {return TRUE;}else {return FALSE;}
		}  else {return FALSE;} 
	}
	function deactivate_the_user(){
		$is_protected=$this->is_protected_account($this->input->post('newuser_id'));
		if(!isset($is_protected)|| $is_protected != true){
		$userID=$this->input->post('newuser_id');
		$data= array('approved'=>'0', 'active'=>'0' );
		$this->db->where('users_id', $userID);			
		 if($this->db->update('users', $data))
		 {return TRUE;}else {return FALSE;}		
	}  else {return FALSE;} 
	}

	
}// end class