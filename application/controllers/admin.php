<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

/*
| -----------------------------------------------------
| PRODUCT NAME: 	DIGI ONLINE EXAMINITION SYSTEM (DOES)
| -----------------------------------------------------
| AUTHER:			DIGITAL VIDHYA TEAM
| -----------------------------------------------------
| EMAIL:			digitalvidhya4u@gmail.com
| -----------------------------------------------------
| COPYRIGHTS:		RESERVED BY DIGITAL VIDHYA
| -----------------------------------------------------
| WEBSITE:			http://digitalvidhya.com
|                   http://codecanyon.net/user/digitalvidhya      
| -----------------------------------------------------
|
| MODULE: 			Admin
| -----------------------------------------------------
| This is admin module controller file.
| -----------------------------------------------------
*/

	/***Authenticate Admin for each function by calling the Parent Method 
	validate_admin() in Constructor***/
	function __construct()
    {
        parent::__construct();
		
		$this->load->library('form_validation');
		
    }
	
	/***Admin Dashboard (Default Function. If no function is called, this function
	 will be called)***/
	public function index()
	{
		redirect('admin/dashboard');
	}

	/***Admin Dashboard***/
	function dashboard()
	{
		$this->validate_admin();
		
		$table = $this->db->dbprefix('users');
		
		//Records of Latest Users
		$latestUsers = $this->base_model->run_query(
		"SELECT u.* FROM users u, users_groups g WHERE u.id=g.user_id
		and g.group_id=2 and u.id!=1 ORDER BY u.id desc LIMIT 5"
		);
		
		//Records of Users who has taken quizzes recently
		$recentUserQuizzes = $this->base_model->run_query(
		"SELECT * FROM(SELECT qh.*,q.name,u.image FROM "
		.$this->db->dbprefix('user_quiz_results_history')." qh,"
		.$this->db->dbprefix('quiz')." q, "
		.$this->db->dbprefix('users')." u where q.quizid=qh.quiz_id and 
		u.id=qh.userid ORDER BY qh.dateoftest DESC ) as recent 
		GROUP BY quiz_id  LIMIT 6"
		);
		
		//Records of Top Rankers
		$topRankers = $this->base_model->run_query(
		"select qr.*,u.image,q.name from "
		.$this->db->dbprefix('user_quiz_results')." qr,"
		.$this->db->dbprefix('users')." u,"
		.$this->db->dbprefix('quiz')." q where u.id=qr.userid and 
		q.quizid=qr.quiz_id ORDER BY (qr.score*100/qr.total_questions) DESC LIMIT 6"
		);
		
		//Data For Chart
		$activeUsers = $this->base_model->run_query(
		"select * from ".$table." where id!=1 and active=1 
		ORDER BY date_of_registration"
		);
		
		$inactiveUsers = $this->base_model->run_query(
		"select * from ".$table." where id!=1 and active=0 
		ORDER BY date_of_registration"
		);
		
		$this->data['activeUsersCount'] 	= count($activeUsers);
		$this->data['inactiveUsersCount'] 	= count($inactiveUsers);
		
		
		$this->data['exam_data'] = $this->base_model->run_query(
		"SELECT q.name, r.total_attempts as cnt FROM "
		.$this->db->dbprefix('user_quiz_results')." r, "
		.$this->db->dbprefix('quiz')." q where q.quizid=r.quiz_id 
		group by quiz_id order by cnt desc limit 5"
		);
		
		$this->data['payments_data'] = $this->base_model->run_query(
		"SELECT s.quizid,q.name,count(*) as cnt FROM  "
		.$this->db->dbprefix('quizsubscriptions')." s, "
		.$this->db->dbprefix('quiz')." q where s.quizid=q.quizid 
		group by s.quizid"
		);
		
		$this->data['latestUsers'] 			= $latestUsers;
		$this->data['recentUserQuizzes'] 	= $recentUserQuizzes;
		$this->data['topRankers'] 			= $topRankers;
		$this->data['title'] 				= 'Admin Paneli';
		$this->data['active_menu'] 			= 'dashboard';
		$this->data['content'] 				= 'admin/index';
		$this->_render_page('temp/admintemplate', $this->data);
	
	}
	
	//View All Users
	function viewAllUsers()
	{
		$this->validate_admin();

		$allUsers 	= $this->base_model->run_query(
		"SELECT u.* FROM users u, users_groups g WHERE u.id=g.user_id
		and g.group_id=2 and u.id!=1 ORDER BY u.id desc "
		);
		$this->data['allUsers'] 	= $allUsers;
		$this->data['title'] 		= 'Genel Üyeler';
		$this->data['active_menu'] 	= 'users';
		$this->data['content'] 		= 'admin/view_all_users';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//Delete User
	function deleteUser()
	{
		$this->validate_admin();
	
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('users'), 
			$where
			);
			$this->prepare_flashmessage("Kayıt başarıyla silindi", 0);
			if($this->uri->segment(4) != '' && $this->uri->segment(4) == 'admin')
				redirect('admin/admins');
			elseif($this->uri->segment(4) != '' && $this->uri->segment(4) == 'moderator')
				redirect('admin/moderators');
			else
				redirect('admin/viewAllUsers');
		}
	
	}
	
	
	//View All Admins
	function moderators()
	{
		$this->validate_admin();
		
		$moderators =	$this->base_model->run_query("SELECT u.* FROM users u, users_groups g WHERE u.id=g.user_id and g.group_id=4 ORDER BY u.id desc ");
		$this->data['users'] = $moderators;
		
		$this->data['active_menu']='users';
		$this->data['title'] = 'Moderatör - Super Admin Paneli';
		$this->data['heading'] = 'Moderators';
		
		$this->data['content'] = 'admin/moderators';
		$this->data['user_type'] = 'moderator';
		
		$this->_render_page('temp/admintemplate',$this->data);
	}
	
	
	public function _image_check($image = '', $param2 = '')
	{
		
		$name = explode('.',$param2);
		
		if(count($name)>2 || count($name)<= 0) {
           $this->form_validation->set_message('_image_check', 'Only jpg / jpeg / png images are accepted.');
            return FALSE;
        }
		
		$ext = $name[1];
		
		$allowed_types = array('jpg','jpeg','png');
		
		if (!in_array($ext, $allowed_types)) {			
			$this->form_validation->set_message('_image_check', 'Only jpg / jpeg / png images are accepted.');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	
	
	//Create User
	function create_user($user_type = '')
	{
		$this->validate_admin();
		
		$this->data['title'] = "Yeni üye";
	
		//$this->load->config('ion_auth');
		$this->config->load('ion_auth', TRUE);
		$tables = $this->config->item('tables','ion_auth');
		
		if($this->input->post('submit')!='') {
			//validate form input
			$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required|xss_clean');
			$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required|xss_clean');
			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
			$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|xss_clean|integer');

			$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
			$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');			
			
			if(!empty($_FILES['image']['name'])) {
			
				$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			
			
			}

			if ($this->form_validation->run() == true)
			{
				$username = $this->input->post('first_name') . ' ' . $this->input->post('last_name');
				$email    = strtolower($this->input->post('email'));
				$password = $this->input->post('password');
				$image = $_FILES['image']['name'];

				$additional_data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'phone'      => $this->input->post('phone'),
					'date_of_registration'      => date('Y-m-d')
				);
				
				if(!empty($image))
					$additional_data['image'] = $image;
				
				$id = $this->ion_auth->register($username, $password, $email, $additional_data);
				
				if($this->input->post('user_type') == "admin") {
					$empdata['group_id'] = "3";
					$redirect_path = "admin/admins";
				}
				else {
					$empdata['group_id'] = "4";
					$redirect_path = "admin/moderators";
				}
				
				$this->db->where('user_id', $id);
				if($this->db->update('users_groups',$empdata)) {
				
					$this->prepare_flashmessage($this->ion_auth->messages(),2);
					redirect($redirect_path, 'refresh');
				
				}
			}
			else
			{
				//display the create user form
				//set the flash data error message if there is one
				$this->prepare_flashmessage((validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))),1);
				redirect("admin/create_user", 'refresh');
				
			}
		}

			$this->data['first_name'] = array(
				'name'  => 'first_name',
				'class'=>'form-control',
				'placeholder'=>'Ad',
				'id'    => 'first_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array(
				'name'  => 'last_name',
				'class'=>'form-control',
				'placeholder'=>'Soyad',
				'id'    => 'last_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['email'] = array(
				'name'  => 'email',
				'class'=>'form-control',
				'placeholder'=>'Kullanıcı E-Posta',
				'id'    => 'email',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array(
				'name'  => 'company',
				'class'=>'form-control',
				'placeholder'=>'Firma',
				'id'    => 'company',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone'] = array(
				'name'  => 'phone',
				'class'=>'form-control',
				'placeholder'=>'Telefon',
				'id'    => 'phone',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('phone'),
			);
			$this->data['password'] = array(
				'name'  => 'password',
				'class'=>'form-control',
				'placeholder'=>'Şifre',
				'id'    => 'password',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'class'=>'form-control',
				'placeholder'=>'Şifre Tekrar',
				'id'    => 'password_confirm',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);
			
			$this->data['user_type'] = $user_type;
			
			$this->data['content'] = 'admin/create_user';
			$this->_render_page('temp/admintemplate', $this->data);
	}

	//edit a user
	function edit_user($id = '', $user_type = '')
	{
		$this->validate_admin();
		
		$this->data['title'] = "Üye Düzenle";

		if($id == "") {
		
			$id = $this->input->post('id');
		
		}
		
		if(!is_numeric($id)){
		return;
		}
		
		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');
		
		if(!empty($_FILES['image']['name'])) {
			
			$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			
		
		}

		if (isset($_POST) && !empty($_POST))
		{
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
				'username'      => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
			);
			
			$image = $_FILES['image']['name'];
			
			//update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

				$data['password'] = $this->input->post('password');
			}

			if ($this->form_validation->run() === TRUE)
			{
				
				if(!empty($image)) {
				
					if (file_exists('assets/uploads/images/'. $user->image)) {
						unlink('assets/uploads/images/'. $user->image);
					}
					if(file_exists('assets/uploads/images(200x200)/'. $user->image)) {
						unlink('assets/uploads/images(200x200)/'. $user->image);
					}
						
					if(file_exists('assets/uploads/images(50x50)/'. $user->image)) {
						unlink('assets/uploads/images(50x50)/'. $user->image);
					}
					
					$ext = explode('.', $image);
					
					if(count($ext)>2 || count($ext)<= 0) {
					   $this->form_validation->set_message('_image_check', 'Only jpg / jpeg / png images are accepted.');
						return FALSE;
					}
					
					$img = $ext[0]."_".$user->id.".".$ext[1];
					
					$data['image'] = $img;
				
				}
				
				$this->ion_auth->update($user->id, $data);

				if($this->input->post('user_type') == "admin") {
					$redirect_path = "admin/admins";
				}
				else {
					$redirect_path = "admin/moderators";
				}
				
				$this->prepare_flashmessage('User Updated Successfully.', 0);
				redirect($redirect_path, 'refresh');
			}
		}

		//display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		//set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'class'=>'form-control',
			'placeholder'=>'Ad',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'class'=>'form-control',
			'placeholder'=>'Soyad',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'class'=>'form-control',
			'placeholder'=>'Firma',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'class'=>'form-control',
			'placeholder'=>'Telefon',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['email'] = array(
			'name'  => 'email',
			'class'=>'form-control',
			'placeholder'=>'Kullanıcı E-Posta',
			'id'    => 'email',
			'type'  => 'text',
			'readonly'  => 'readonly',
			'value' => $this->form_validation->set_value('email', $user->email),
		);
		$this->data['password'] = array(
			'name' => 'password',
			'class'=>'form-control',
			'placeholder'=>'Şifre',
			'id'   => 'password',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'class'=>'form-control',
			'placeholder'=>'Şifre Tekrar',
			'id'   => 'password_confirm',
			'type' => 'password'
		);
		
			$this->data['user_type'] = $user_type;
			$this->data['content']='admin/edit_user';
			$this->_render_page('temp/admintemplate',$this->data);
		//$this->_render_page('auth/edit_user', $this->data);
	}
	
	
	//Admin Profile
	function profile()
	{
		$this->validate_admin();
		
		$userid = $this->session->userdata('user_id');
		if (isset($userid) && $userid != '' && is_numeric($userid)) {
			$table = $this->db->dbprefix('users');
			$condition['id'] = $userid;
			$records = $this->base_model->fetch_records_from(
			$table, 
			$condition,
			$select = 'id, username, first_name, last_name, email, phone, 
			image, active', 
			$order_by = '' 
			);
			$this->data['details'] 	= $records;
			$this->data['content'] 	= 'admin/profile';
			$this->data['title'] 	= 'Yönetici Profili';
			$this->_render_page('temp/admintemplate', $this->data);
		}
		else {
			$this->prepare_flashmessage('Oturum Süresi Doldu!', 2);
			redirect('auth/login', 'refresh');
		}
	}
	
	//View User Profile
	function viewUserProfile()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 				= $this->uri->segment(3);
			$table 					= $this->db->dbprefix('users');
			$condition['id'] 		= $userid;
			$records 				= $this->base_model->fetch_records_from(
			$table, 
			$condition,
			$select 				= 'id, username, email, phone, image, active', 
			$order_by = '' 
			);
			$this->data['details'] 	= $records;
			$this->data['content'] 	= 'admin/view_user_profile';
			$this->data['title'] 	= 'Üye Profili';
			$this->_render_page('temp/admintemplate', $this->data);
		}
		else {
			redirect('admin', 'refresh');
		}
	}
	
	
	//View User Quiz History
	function userQuizHistory()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 						= $this->uri->segment(3);
			$records 						= $this->base_model->run_query(
			"select qr.*,q.* from ".$this->db->dbprefix('user_quiz_results')
			." qr,".$this->db->dbprefix('quiz')
			." q where q.quizid=qr.quiz_id and qr.userid=".$userid
			);
			if (count($records)>0) {
				$this->data['quiz_history'] = $records;
				$this->data['username'] 	= $records[0]->username;
				$this->data['title'] 		= 'Kullanıcı Sınav Tarihi';
				$this->data['content'] 		= 'admin/user_quiz_history';
				$this->_render_page('temp/admintemplate', $this->data);
			}
			else {
				$this->prepare_flashmessage(
				"Sınav yok sınav tarihi kullanıcı bulunmadığı 
				için sınav kaldırıldı.", 2
				);
				redirect('admin/viewAllUsers', 'refresh');
			}
		}
		else {
			$this->prepare_flashmessage(
			"Sınav yok sınav tarihi kullanıcı bulunmadığı 
				için sınav kaldırıldı.", 2
			);
			redirect('admin/viewAllUsers', 'refresh');
		}
	}
	
	//View Performance of User Quiz
	function userQuizPerformance()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(4) && is_numeric($this->uri->segment(4))) {
			$quizId 					= $this->uri->segment(4);
			
			if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
				$userId 				= $this->uri->segment(3);
				$records 				= $this->base_model->run_query(
				"select qh.*,q.* from "
				.$this->db->dbprefix('user_quiz_results_history')
				." qh,".$this->db->dbprefix('quiz')
				." q where q.quizid=qh.quiz_id and qh.userid = "
				.$userId." and qh.score > 0 and qh.quiz_id = "
				.$quizId." ORDER BY dateoftest DESC LIMIT 10"
				);
				
				if (count($records)>0) {
					$this->data['info'] = "Performance Report of"
					.$records[0]->username." in ".$records[0]->name;
					$result 			= array( );
					$temp 				= array();
					array_push($temp, "Date","Score","Total Questions");
					array_push($result, $temp);
					
					foreach ($records as $d) {
						$temp 			= array();
						array_push(
						$temp,$d->dateoftest, 
						$d->score,$d->total_questions
						);
						array_push($result, $temp);
					}
					
				
					$str = "";
					$cnt = 0;
					foreach ($result as $r) {
						if ($cnt++ == 0){
							$str = $str . "['".$r[0]."','".$r[1]."','".$r[2]."'],";
						}
						else{
							$str = $str . "['".$r[0]."',".$r[1].",".$r[2]."],";
						}
					}
							
					$this->data['result'] 	= $str;
					$this->data['title'] 	= "Kullanıcı Sınav Performans";
					$this->load->view('user/exam/performance', $this->data);
				}
				else {
					$this->prepare_flashmessage(
					"Sınav yok sınav tarihi kullanıcı bulunmadığı 
					için sınav kaldırıldı", 2
					);
					redirect('admin/viewAllUsers', 'refresh');
				}
			}
			else {
				$this->prepare_flashmessage(
				"Sınav yok sınav tarihi kullanıcı bulunmadığı 
				için sınav kaldırıldı.", 2
				);
				redirect('admin/viewAllUsers', 'refresh');
			}
		}
		elseif ($this->uri->segment(3)) {
			redirect('admin/userQuizHistory/'.$this->uri->segment(3), 'refresh');
		}
		else {
			$this->prepare_flashmessage(
			"Sınav yok sınav tarihi kullanıcı bulunmadığı için sınav kaldırıldı", 2
			);
			redirect('admin/viewAllUsers', 'refresh');
		}
	}
	
	
	//Update Admin Profile
	function updateProfile()
	{
		$this->validate_admin();
		
		$this->form_validation->set_rules('first_name', 'First Name', 
		'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 
		'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 
		'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 
		'required|xss_clean|integer');
		
		if(!empty($_FILES['image']['name'])) {

			$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			

		}
		
		if ($this->form_validation->run() == true) {
			$userid = $this->input->post('user');
			if ($this->input->post('submit')!='' && isset($userid) && $userid!='') {
				$data['first_name'] 	= $this->input->post('first_name');
				$data['last_name'] 		= $this->input->post('last_name');
				$data['username'] 		= $this->input->post('first_name')
				." ".$this->input->post('last_name');
				$data['phone'] 			= $this->input->post('phone');
				$data['email'] 			= $this->input->post('email');
				
				//Unset User Name
				$this->session->unset_userdata('username');
				//Set User Name
				$this->session->set_userdata('username',$data['username']);
				
				$image = $_FILES['image']['name'];
				
				//Upload User Photo
				if (!empty($image)) {	
					$r = $this->base_model->run_query(
					'select image from '.$this->db->dbprefix('users')
					.' where image != "" and id = '.$userid
					);
					if (count($r) > 0) {
					
						if (file_exists('assets/uploads/images/'.$r[0]->image)) {
							unlink('assets/uploads/images/'.$r[0]->image);
						}
						if(file_exists('assets/uploads/images(200x200)/'
						.$r[0]->image)) {
							unlink('assets/uploads/images(200x200)/'.$r[0]->image);
						}
							
						if(file_exists('assets/uploads/images(50x50)/'
						.$r[0]->image)) {
							unlink('assets/uploads/images(50x50)/'.$r[0]->image);
						}
					}
					
					//Unset User Image 
					$this->session->unset_userdata('image');
					
					$ext = explode('.',$image);
					
					$img = $ext[0]."_".$userid.".".$ext[1];
					
					$data['image'] = $img;
					move_uploaded_file(
					$_FILES['image']['tmp_name'], 
					'assets/uploads/images/'.$img
					);
					$this->create_thumbnail(
					'assets/uploads/images/'. $img, 
					'assets/uploads/images(200x200)/'. $img,200,200
					);
					$this->create_thumbnail(
					'assets/uploads/images/'. $img, 
					'assets/uploads/images(50x50)/'. $img,
					50,50
					);
					
					//Set User Image
					$this->session->set_userdata('image',$img);
					
				}
				
				$table 					= $this->db->dbprefix('users');
				$where['id'] 			= $userid;
				$this->base_model->update_operation($data, $table, $where);
				
				$this->prepare_flashmessage(
				'Profiliniz Başarıyla Güncellendi.', 0
				);
				redirect('admin/profile', 'refresh');
			}
			else {
				$this->prepare_flashmessage('Session Expired!', 2);
				redirect('auth/login', 'refresh');
			}
		}
		else {
			$this->prepare_flashmessage(validation_errors(), 1);
			redirect('admin/profile', 'refresh');
		}
	}
	
	
	//Block User
	function blockUser()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 					= $this->uri->segment(3);
			$table 						= $this->db->dbprefix('users');
			$data['active'] 			= 0;
			$where['id'] 				= $userid;
			if ($this->base_model->update_operation($data, $table, $where)) {
				$this->prepare_flashmessage("Kullanıcı engellendi.", 2);
				if($this->uri->segment(4) != '' && $this->uri->segment(4) == 'admin')
					redirect('admin/admins', 'refresh');
				elseif($this->uri->segment(4) != '' && $this->uri->segment(4) == 'moderator')
					redirect('admin/moderators', 'refresh');
				else
					redirect('admin/viewUserProfile/'.$userid, 'refresh');
			}
		}
		else {
			redirect('admin', 'refresh');
		}
	}
		
	
	//Activate User
	function activateUser()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) && is_numeric($this->uri->segment(3))) {
			$userid 					= $this->uri->segment(3);
			$table 						= $this->db->dbprefix('users');
			$data['active'] 			= 1;
			$where['id'] 				= $userid;
			if ($this->base_model->update_operation($data, $table, $where)) {
				$this->prepare_flashmessage("Kullanıcı aktif edildi.", 2);
				if($this->uri->segment(4) != '' && $this->uri->segment(4) == 'admin')
					redirect('admin/admins', 'refresh');
				elseif($this->uri->segment(4) != '' && $this->uri->segment(4) == 'moderator')
					redirect('admin/moderators', 'refresh');
				else
					redirect('admin/viewUserProfile/'.$userid, 'refresh');
			}
		}
		else {
			redirect('admin', 'refresh');
		}
	}
	
	
	//CRUD Operations for Categories
	function categories()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['catid'] 			= $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('categories'), 
			$where
			);
			$this->prepare_flashmessage("Kayıt başarıyla silindi", 0);
			redirect('admin/categories', 'refresh');		
		}
		$this->data['title'] 			= 'Kategoriler';
		$this->data['active_menu'] 		= 'categories';
		$this->data['records'] 			= $this->base_model->fetch_records_from(
		$this->db->dbprefix('categories')
		);
		$this->data['content'] 			= 'admin/categories/categories';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditCategories()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
		'name', 
		'Category Name', 
		'trim|required'
		);
		
		if ($this->form_validation->run() == true) {
			$inputdata['name'] 			= $this->input->post('name');
			$inputdata['status'] 		= $this->input->post('status');
			
			if ($this->input->post('id') == '' ) {
				$this->base_model->insert_operation(
				$inputdata,
				$this->db->dbprefix('categories')
				);
				$msg = "Kayıt Başarıyla Eklendi";
			}
			else {
				$where['catid'] 		= $this->input->post('id');
				$this->base_model->update_operation(
				$inputdata,
				$this->db->dbprefix('categories'), 
				$where
				);
				$msg = "Kayıt Başarıyla Güncellendi";
			}
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/categories', 'refresh');
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] = $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('categories')
			." where catid=".$this->uri->segment(3)
			);
			$this->data['id'] 		= $this->uri->segment(3);
			$this->data['title'] 	= 'Güncel Kategori';
		}
		else {
			$this->data['data']		= array();
			$this->data['id']		= '';
			$this->data['title']	= 'Kategori Ekle';
		}
		$Options['Active'] 			= 'Aktif';
		$Options['Inactive'] 		= 'Pasif';
		$this->data['element'] 		= $Options;
		$this->data['active_menu'] 	= 'Kategoriler';
		$this->data['content'] 		= 'admin/categories/addeditCategories';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//CRUD Operations for Sub Categories
	function subcategories()
	{
	    $this->validate_admin();
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['subcatid'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('subcategories'), 
			$where
			);
			$this->prepare_flashmessage("Kayıt başarıyla silindi", 0);
			redirect('admin/subcategories', 'refresh');		
		}
		$this->data['title'] 		= 'Alt Kategoriler';
		$this->data['active_menu'] 	= 'subcategories';
		$this->data['records'] 		= $this->base_model->run_query(
		"select s.*,c.name as catname from "
		.$this->db->dbprefix('subcategories')." s,"
		.$this->db->dbprefix('categories')." c where c.catid=s.catid"
		);
		$this->data['content']		='admin/categories/subcategories';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditSubCategories()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('catid', 'Category Name', 'trim|required');
		$this->form_validation->set_rules(
		'name', 
		'Sub Category Name', 
		'trim|required'
		);
		
		if ($this->form_validation->run() == true) {
			$inputdata['catid'] 	= $this->input->post('catid');
			$inputdata['name'] 		= $this->input->post('name');
			$inputdata['status'] 	= $this->input->post('status');
			if ($this->input->post('id') == '' ) {
				$this->base_model->insert_operation(
				$inputdata,
				$this->db->dbprefix('subcategories')
				);
				$msg = "Kayıt Başarıyla Eklendi.";
			}
			else {
				$where['subcatid'] = $this->input->post('id');
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('subcategories'), 
				$where );
				$msg = "Kayıt Başarıyla Eklendi.";
			}
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/subcategories', 'refresh');
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] 	= $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('subcategories')
			." where subcatid=".$this->uri->segment(3)
			);
			$this->data['id'] 		= $this->uri->segment(3);
			$this->data['title'] 	= 'Alt Kategori Güncelle';
		}
		else {
			$this->data['data'] 	= array();
			$this->data['id'] 		= '';
			$this->data['title'] 	= 'Alt Kategori Ekle';
		}
		
		$Options['Active'] 			= 'Aktif';
		$Options['Inactive'] 		= 'Pasif';
		$this->data['element'] 		= $Options;
		$catOptions[''] 			= 'Kategori Seç';
		$catRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('categories')
		);
		foreach ($catRecords as $key => $val) {
		    $catOptions[$val->catid]=$val->name;	
		}
		$this->data['categories'] 	= $catOptions;
		$this->data['active_menu'] 	= 'subcategories';
		$this->data['content'] 		= 'admin/categories/addeditSubCategories';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//CRUD Operations for Subjects
	function subjects()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['subjectid'] 	= $this->uri->segment(3);
			$this->base_model->delete_record($this->db->dbprefix('subjects'), $where);
			$this->prepare_flashmessage("Kayıt başarıyla silindi", 0);
			redirect('admin/subjects');		
		}
				
		$this->data['title'] 		= 'Konular';
		$this->data['active_menu'] 	= 'subjects';
		$this->data['records'] 		= $this->base_model->fetch_records_from(
		$this->db->dbprefix('subjects')
		);
		$this->data['content'] 		= 'admin/subjects/subjects';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditSubjects()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Subject Name', 'trim|required');
		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['name'] 		= $this->input->post('name');
				$inputdata['status'] 	= $this->input->post('status');
				
				if ($this->input->post('id') == '' ) {
					$this->base_model->insert_operation(
					$inputdata,
					$this->db->dbprefix('subjects')
					);
					
					$msg = "Kayıt başarıyla eklendi";
				}
				else {
					$where['subjectid'] = $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata, 
					$this->db->dbprefix('subjects'), 
					$where
					);
					$msg = "Kayıt başarıyla güncellendi";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/subjects', 'refresh');
			}
			else {
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditSubjects', 'refresh');
			}
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] 	= $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('subjects')
			." where subjectid=".$this->uri->segment(3)
			);
			$this->data['id'] 		= $this->uri->segment(3);
			$this->data['title'] 	= 'Güncel Konu';
		}
		else {
			$this->data['data'] 	= array();
			$this->data['id'] 		= '';
			$this->data['title'] 	= 'Konu Ekle';
		}
		$Options['Active'] 			= 'Aktif';
		$Options['Inactive'] 		= 'Pasif';
		$this->data['element'] 		= $Options;
		$this->data['active_menu'] 	= 'subjects';
		$this->data['content'] 		= 'admin/subjects/addeditSubjects';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	function questionsindex()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("Bu modüle erişim yok",1);
				redirect('user', 'refresh');		
		}
		
		$this->data['title'] 		= 'Soruların İndexi';
		$this->data['active_menu'] 	= 'questions';
		$this->data['records'] 		= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('subjects')
		);
		$this->data['content'] 		= 'admin/questions/questionsindex';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	//CRUD Operations for Questions
	function questions()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("Bu modüle erişim yok",1);
				redirect('user', 'refresh');		
		}
		
		if ($this->uri->segment(3)!='' && is_numeric($this->uri->segment(4))) {
			if ($this->uri->segment(3) == "delete" && $this->uri->segment(4) != '') {
				$where['questionid'] = $this->uri->segment(4);
				$this->base_model->delete_record(
				$this->db->dbprefix('questions'), 
				$where
				);
				$this->prepare_flashmessage("Kayıt başarıyla silindi", 0);
				redirect('admin/questions', 'refresh');
			}
			elseif (
			$this->uri->segment(3) == "subject_wise" && 
			$this->uri->segment(4)!='' &&
			is_numeric($this->uri->segment(4)
			)) {				
				$records = $this->base_model->run_query(
				"select q.*,s.name as subjectname from "
				.$this->db->dbprefix('questions')." q,"
				.$this->db->dbprefix('subjects')." s 
				where s.subjectid=q.subjectid and q.subjectid="
				.$this->uri->segment(4)
				);
				$this->data['subject_name']="";
				$where['subjectid'] = $this->uri->segment(4);
				$subject_details = $this->base_model->fetch_records_from('subjects', $where);
				if (count($subject_details) > 0) {
				    $subject_details 			= $subject_details[0];
					$this->data['subject_name'] = $subject_details->name;
				}
				$this->data['records'] 			= $records;
				$this->data['subject_id'] 		= $this->uri->segment(4);				
			}
			else {
				$this->data['records'] = $this->base_model->run_query(
				"select q.*,s.name as subjectname from "
				.$this->db->dbprefix('questions')." q,"
				.$this->db->dbprefix('subjects')." s where s.subjectid=q.subjectid"
				);
			}
		}
		else {
			$this->data['records'] = $this->base_model->run_query(
			"select q.*,s.name as subjectname from "
			.$this->db->dbprefix('questions')." q,"
			.$this->db->dbprefix('subjects')." s where s.subjectid=q.subjectid"
			);
		}
		$this->data['title'] 		= 'Sorular';
		$this->data['active_menu'] 	= 'questions';
		$this->data['content'] 		= 'admin/questions/questions';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	function addeditQuestions()
	{	
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("Bu modüle erişim yok",1);
				redirect('user', 'refresh');		
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subjectid', 'Subject', 'trim|required');
		$this->form_validation->set_rules(
		'questiontype', 
		'Question Type', 
		'trim|required'
		);
		$this->form_validation->set_rules(
		'totalanswers', 
		'Total Answers', 
		'trim|required'
		);
		$this->form_validation->set_rules('question', 'Question', 'trim|required');
		$this->form_validation->set_rules('answer1', 'Answer1', 'trim|required');
		$this->form_validation->set_rules('answer2', 'Answer2', 'trim|required');
		$this->form_validation->set_rules('answer3', 'Answer3', 'trim|required');
		$this->form_validation->set_rules('answer4', 'Answer4', 'trim|required');
		$this->form_validation->set_rules(
		'correctanswer', 
		'Correct Answer', 
		'trim|required'
		);
		$this->form_validation->set_rules(
		'difficultylevel', 
		'Difficulty Level', 
		'trim|required'
		);
		
		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				
				$inputdata['subjectid'] 	= $this->input->post('subjectid');
				$inputdata['questiontype'] 	= $this->input->post('questiontype');
				$inputdata['totalanswers'] 	= $this->input->post('totalanswers');
				$inputdata['question'] 		= $this->input->post('question');
				$inputdata['answer1'] 		= $this->input->post('answer1');
				$inputdata['answer2'] 		= $this->input->post('answer2');
				$inputdata['answer3'] 		= $this->input->post('answer3');
				$inputdata['answer4'] 		= $this->input->post('answer4');
				$inputdata['answer5'] 		= $this->input->post('answer5');
				$inputdata['correctanswer'] = $this->input->post('correctanswer');
				$inputdata['hint'] 			= "";
				$inputdata['difficultylevel'] = $this->input->post('difficultylevel');
				$inputdata['status'] = $this->input->post('status');
				
				if ($this->input->post('id') == '' ) {
					$this->base_model->insert_operation($inputdata, 
					$this->db->dbprefix('questions')
					);
					$msg = "Kayıt başarıyla eklendi.";
				}
				else {
					$where['questionid'] = $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata, 
					$this->db->dbprefix('questions'), 
					$where
					);
					$msg = "Kayıt başarıyla güncellendi.";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect(
				'admin/questions/subject_wise/'.$inputdata['subjectid'], 
				'refresh'
				);
			}
			else {
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditQuestions');
			}
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			
			$record = $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('questions')
			." where questionid=".$this->uri->segment(3)
			);
			$this->data['data'] 		= $record;
			$this->data['subject_id'] 	= $record[0]->subjectid;
			$this->data['id'] 			= $this->uri->segment(3);
			$this->data['title'] 		= 'Güncel Soru';
		}
		else {
			$this->data['data'] 		= array();
			$this->data['id'] 			= '';
			$this->data['title'] 		= 'Soru Ekle';
		}
		
		//Options for Status
		$Options['Active'] 				= 'Aktif';
		$Options['Inactive'] 			= 'Pasif';
		$this->data['element'] 			= $Options;
		
		//Options for Total Answers
		$ans['4'] 						= '4';
		$ans['5'] 						= '5';
		$this->data['totans'] 			= $ans;
		
		//Options for Question Types
		$qtype['SingleAnswer'] 			= 'Tek Cevap';
		//$qtype['MultiAnswer'] 			= 'Multi Answer';
		$this->data['questtypes'] 		= $qtype;
		
		//Options for Difficulty Level
		$dlevel['Easy'] 				= 'Kolay';
		$dlevel['Medium'] 				= 'Orta';
		$dlevel['High'] 				= 'Zor';
		$this->data['difficultylevels'] = $dlevel;
		
		//Options for Subjects
		$subjOptions[''] 				= 'Konu Seçin';
		$subjRecords 					= $this->base_model->fetch_records_from(
		$this->db->dbprefix('subjects')
		);
		
		foreach ($subjRecords as $key=>$val)
		$subjOptions[$val->subjectid] 	= $val->name;
		$this->data['subjects'] 		= $subjOptions;
		$this->data['active_menu'] 		= 'questions';
		$this->data['content'] 			= 'admin/questions/addeditQuestions';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	
	//CRUD Operations for Quiz
	function quiz()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("Bu modüler erişim yok",1);
				redirect('user', 'refresh');		
		}
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['quizid'] 			= $this->uri->segment(3);
			if ($this->base_model->delete_record(
			$this->db->dbprefix('quiz'), 
			$where)
			)
			{
				$this->base_model->delete_record(
				$this->db->dbprefix('quizquestions'), 
				$where
				);
				$this->prepare_flashmessage("Kayıt başarıyla silindi", 0);
				redirect('admin/quiz');
			}
					
		}				
		$this->data['title'] 			= 'Quizzes';
		$this->data['active_menu'] 		= 'quiz';
		$this->data['records'] 			= $this->base_model->run_query(
		"select q.*,c.name as catname,s.name as subcatname from "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
		." c,".$this->db->dbprefix('subcategories')." s 
		where c.catid=q.catid and s.subcatid=q.subcatid"
		);
		$this->data['content'] 			= 'admin/quiz/quiz';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	
	
	//function to add quiz 
	function addeditQuiz()
	{	
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("Bu modüle erişim yok",1);
				redirect('user', 'refresh');		
		}
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('catid', 'Category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('subcatid', 'Sub Category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('validityvalue', 'Validity Value', 'trim|required|xss_clean');
		$this->form_validation->set_rules('quizcost', 'Price ', 'trim|required|xss_clean');
		if ($this->input->post('negativemarkstatus') == "Active") {
			$this->form_validation->set_rules(
			'negativemark', 
			'Negative Mark', 
			'trim|required'
			);
		}
		$this->form_validation->set_rules('startdate', 'Start Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules('enddate', 'End Date', 'trim|required|xss_clean');
		$this->form_validation->set_rules(
		'deauration', 
		'Duration', 
		'trim|required|integer'
		);
		$this->form_validation->set_rules('qq', 'Subjects', 'trim|required|xss_clean');
		
		
		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				
				$inputdata['quiztype'] 			= $this->input->post('quiztype');
				
				$quiz_grp = array();
				if($this->input->post('for_all') == ""){
					$quizgrp = implode(',',$this->input->post('quizfor'));
					$quiz_grp = explode(',',$quizgrp);
					$inputdata['quiz_for'] = "*";
				} else {
					$inputdata['quiz_for'] = 0; 
				}
						
				$inputdata['name'] 				= $this->input->post('name');
				$inputdata['catid'] 			= $this->input->post('catid');
				$inputdata['subcatid'] 			= $this->input->post('subcatid');
				$inputdata['negativemarkstatus'] = $this->input->post('negativemarkstatus');
				$inputdata['negativemark'] 		= "";
				
				if ($this->input->post('negativemarkstatus') == "Active") 
					$inputdata['negativemark'] 	= $this->input->post('negativemark');
				
				$inputdata['difficultylevel'] 	= $this->input->post('difficultylevel');
				$inputdata['hint'] 				= "Inactive";
				$inputdata['startdate'] 		= date(
				'Y-m-d', 
				strtotime($this->input->post('startdate'))
				);
				$inputdata['enddate'] 			= date('Y-m-d', 
				strtotime($this->input->post('enddate'))
				);
				$inputdata['deauration'] 		= $this->input->post('deauration');
				$inputdata['quiztype'] 			= $this->input->post('quiztype');
				$inputdata['validitytype'] 		= $this->input->post('validitytype');
				$inputdata['validityvalue'] 	= $this->input->post('validityvalue');
				$inputdata['quizcost'] 	= $this->input->post('quizcost');
				$inputdata['status'] 		= $this->input->post('status');
				
				if ($this->input->post('id') == '' ) {
					
					$insertid 					= $this->base_model->insert_operation_id(
					$inputdata,$this->db->dbprefix('quiz')
					);
					
					for($i=0;$i<count($quiz_grp);$i++)
					{
						$quiz_for['quizid'] = $insertid;
						$quiz_for['groupid'] = $quiz_grp[$i];
						$this->base_model->insert_operation($quiz_for,$this->db->dbprefix('quiz_for'));
						
					}
					
					$qq 						= $this->input->post('qq');
					$values 					= explode("^", $qq);
					$len 						= count($values);
					$result 					= array_filter($values, 
					 create_function('$a','return preg_match("#\S#", $a);')
					 );
					$i = 0;
					foreach ($result as $v) {
						if ($i++ < $len) {
							$values1 				= explode(",",$v);
							$data['subjectid'] 		= $values1[0];
							$data['totalquestion'] 	= $values1[1];
							$data['quizid'] 		= $insertid;
							$this->base_model->insert_operation(
							$data, 
							$this->db->dbprefix('quizquestions')
							);
						}
					}
					$msg = "Kayıt başarıyla eklendi.";
				}
				else {
					
					$where['quizid'] 			= $this->input->post('id');
					
					
					$updateid = $this->input->post('id');
					
					//step 1
					$this->base_model->delete_record(
					$this->db->dbprefix('quiz_for'), 
					$where);
					
					//step 2
					for($i=0;$i<count($quiz_grp);$i++)
					{
						$quiz_for['quizid'] = $updateid;
						$quiz_for['groupid'] = $quiz_grp[$i];
						$this->base_model->insert_operation($quiz_for,$this->db->dbprefix('quiz_for'));
						
					}
					
					//step 3
					$this->base_model->update_operation(
					$inputdata, 
					$this->db->dbprefix('quiz'), 
					$where
					);
					
					
					
					if (
					$this->base_model->delete_record(
					$this->db->dbprefix('quizquestions'), 
					$where
					)
					) {
						$qq 				= $this->input->post('qq');
						$values 			= explode("^", $qq);
						$len 				= count($values);
						 $result 			= array_filter(
						 $values, 
						 create_function('$a','return preg_match("#\S#", $a);')
						 );
						 
						$i = 0;
						foreach ($result as $v) {
							if ($i++ < $len) {
								$values1 				= explode(",", $v);
								$data['subjectid'] 		= $values1[0];
								$data['totalquestion'] 	= $values1[1];
								$data['quizid'] 		= $where['quizid'];
								$this->base_model->insert_operation(
								$data, 
								$this->db->dbprefix('quizquestions')
								);
							}
						}
						$msg = "Kayıt başarıyla güncellendi.";
					}		
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/quiz','refresh');
			}
			else {
				
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditQuiz','refresh');
			}
		}
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			
			$this->data['data'] = $this->base_model->run_query(
			"select q.*,c.name as catname,s.name as subcatname from "
			.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
			." c,".$this->db->dbprefix('subcategories')." s 
			where c.catid=q.catid and s.subcatid=q.subcatid and quizid="
			.$this->uri->segment(3)
			);
			
			$this->data['qqdata'] 		= $this->base_model->run_query(
			"select qq.*,s.name as subjectname from "
			.$this->db->dbprefix('quizquestions')." qq,"
			.$this->db->dbprefix('subjects')." s 
			where s.subjectid=qq.subjectid and qq.quizid="
			.$this->uri->segment(3)
			);
			
			$groups = $this->base_model->run_query("SELECT groupid FROM quiz_for WHERE quizid=".$this->uri->segment(3) );
			
			//echo "<pre>"; print_r($groups); 
			
			$groups_opts = array();$i=-1;
			foreach($groups as $key=>$val)
			{	$i++;
				$groups_opts[$i] = $val->groupid;
				
			}
			
			// echo "<pre>"; print_r($groups_opts); die();
			
			$this->data['groups'] = $groups_opts;
			$this->data['id'] 			= $this->uri->segment(3);
			$this->data['title'] 		= 'Sınav Güncelle';
		}
		else
		{
			$this->data['data'] 		= array();
			$this->data['groups'] 		= array();
			$this->data['qqdata'] 		= array();
			$this->data['id'] 			= '';
			$this->data['title'] 		= 'Sınav Ekle';
		}
		
		
		
		//Options for Status
		$Options['Active'] 				= 'Aktif';
		$Options['Inactive'] 			= 'Pasif';
		$this->data['element'] 			= $Options;
		
		//Options for Quiz Type
		$qztype['Free'] 				= 'Parasız';
		$this->data['quiztypes'] 		= $qztype;
		
		
		//Options for Quiz For
		//$Quizforoptions['0']='All groups'; 
		$Quizforoptions = array(); 
		$QuizforRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('group_settings')
		);
		foreach ($QuizforRecords as $key=>$val) {
		    $Quizforoptions[$val->id]	= $val->group_name;	
		}
		$this->data['quizfor'] 		= $Quizforoptions;
		
		
		//Options for Negative Mark Status
		$nmstatus['Active'] 			= 'Aktif';
		$nmstatus['Inactive'] 			= 'Pasif';
		$this->data['negativemarksstatus'] = $nmstatus;
		
		//Options for Difficulty Level
		$dlevel['Easy'] 				= 'Kolay';
		$dlevel['Medium'] 				= 'Orta';
		$dlevel['High'] 				= 'Zor';
		$this->data['difficultylevels'] = $dlevel;
		
		//Options for Categories
		$catOptions['']='Select Category';
		$catRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('categories')
		);
		foreach ($catRecords as $key=>$val) {
		    $catOptions[$val->catid]	= $val->name;	
		}
		$this->data['categories'] 		= $catOptions;
		
		//Options for Subjects
		$subjOptions[''] 				= 'Konu Seçin';
		$subjRecords 					= $this->base_model->fetch_records_from(
		$this->db->dbprefix('subjects')
		);
		foreach ($subjRecords as $key => $val) {
		    $subjOptions[$val->subjectid] = $val->name;	
		}
		
		$this->data['subjects'] 		= $subjOptions;
		$this->data['active_menu'] 		= 'quiz';
		$this->data['content'] 			= 'admin/quiz/addeditQuiz';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	//function to add quiz END
	
	
	
	
	//Fetch Sub Categories for Category id
	function getSubCategories()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("Bu modüle erişim yok",1);
				redirect('user', 'refresh');		
		}
		
		$id 	= $this->input->post('catid');
		$sub 	= $this->base_model->run_query(
		"select subcatid,name from ".$this->db->dbprefix('subcategories')
		." where catid=".$id
		);
		echo json_encode($sub); 
	}
	
	
	//CRUD Operations for Notifications
	function notifications()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '') {
			$where['nid'] = $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('notifications'), 
			$where
			);
			$this->prepare_flashmessage("Kayıt başarıyla silindi", 0);
			redirect('admin/notifications');		
		}
				
		$this->data['title'] 			= 'Bildirimler';
		$this->data['active_menu'] 		= 'notifications';
		$this->data['records'] 			= $this->base_model->fetch_records_from(
		$this->db->dbprefix('notifications')
		);
		$this->data['content'] 			= 'admin/notifications/notifications';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditNotifications()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules(
		'description', 
		'Description', 
		'trim|required'
		);
		$this->form_validation->set_rules('post_date', 'Post Date', 'trim|required');
		$this->form_validation->set_rules('last_date', 'Last Date', 'trim|required');
		if($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['title'] 		= $this->input->post('title');
				$inputdata['description'] 	= $this->input->post('description');
				$inputdata['post_date'] 	= date(
				'Y-m-d', 
				strtotime($this->input->post('post_date'))
				);
				$inputdata['last_date'] 	= date(
				'Y-m-d', 
				strtotime($this->input->post('last_date'))
				);
				$inputdata['status'] 		= $this->input->post('status');
				
				if ($this->input->post('id') == '') {
					$this->base_model->insert_operation(
					$inputdata, 
					$this->db->dbprefix('notifications')
					);
					
					$msg 					= "Kayıt başarıyla eklendi";
				}
				else {
					$where['nid'] 			= $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata,
					$this->db->dbprefix('notifications'), 
					$where
					);
					$msg 					= "Kayıt başarıyla güncellendi";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/notifications');
			}
			else {
			$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditNotifications');
			}
		}
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] 		= $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('notifications')
			." where nid=".$this->uri->segment(3)
			);
			$this->data['id'] 			= $this->uri->segment(3);
			$this->data['title'] 		= 'Güncel Bildirimler';
		}
		else {
			$this->data['data'] 		= array();
			$this->data['id'] 			= '';
			$this->data['title'] 		= 'Bildirim Ekle';
		}
				
		$Options['Active'] 				= 'Aktif';
		$Options['Inactive'] 			= 'Pasif';
		$this->data['element'] 			= $Options;
		
		$this->data['active_menu'] 		= 'notifications';
		$this->data['content'] 			= 'admin/notifications/addeditNotifications';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//CRUD Operations for Testimonials
	function testimonials()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '') {
			$where['tid'] 			= $this->uri->segment(3);
			$this->base_model->delete_record(
			$this->db->dbprefix('testimonials'), 
			$where
			);
			$this->prepare_flashmessage("Kayıt Başarıyla Silindi", 0);
			redirect('admin/testimonials');		
		}
				
		$this->data['title'] 			= 'Övgüler';
		$this->data['active_menu'] 		= 'testimonials';
		$this->data['records'] 			= $this->base_model->fetch_records_from(
		$this->db->dbprefix('testimonials')
		);
		$this->data['content'] 			= 'admin/testimonials/testimonials';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	function addeditTestimonials()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('author', 'Author', 'trim|required');
		$this->form_validation->set_rules(
		'description', 
		'Description', 
		'trim|required'
		);
		
		if(!empty($_FILES['author_photo']['name'])) {

			$this->form_validation->set_rules('author_photo',"Author Photo", 'callback__image_check['.$_FILES['author_photo']['name'].']');			

		}
		
		if($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['author'] 		= $this->input->post('author');
				$inputdata['description'] 	= $this->input->post('description');			
				$inputdata['status'] 		= $this->input->post('status');
				$inputdata['added_date'] 	= date('Y-m-d');
				$image 						= $_FILES['author_photo']['name'];
				
				//Upload Website Logo
				if (!empty($image)) {

					if($this->input->post('id') != '') {
						$r = $this->base_model->run_query(
						"select author_photo from ".$this->db->dbprefix('testimonials')." 
						where author_photo!='' and status = 'Active' and tid=".$this->input->post('id')
						);
						unlink('assets/uploads/testimony_images/'.$r[0]->author_photo);
					}
					
					$ext = explode('.', $_FILES['author_photo']['name']);
					$inputdata['author_photo'] = $image;
					move_uploaded_file(
					$_FILES['author_photo']['tmp_name'], 
					'assets/uploads/testimony_images/'.$image
					);	
					$this->create_thumbnail(
					'assets/uploads/testimony_images/'. $image, 
					'assets/uploads/testimony_images/images(98x98)/'. $image,98,98);
				}
				
				if ($this->input->post('id') == '') {
					$this->base_model->insert_operation(
					$inputdata, 
					$this->db->dbprefix('testimonials')
					);
					
					$msg="Kayıt Başarıyla Güncellendi";
				}
				else {
					$where['tid'] = $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata,
					$this->db->dbprefix('testimonials'), 
					$where
					);
					$msg = "Kayıt başarıyla güncellendi";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/testimonials');
			}
			else {
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/addeditTestimonials','refresh');
			}		
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data']=$this->base_model->run_query(
			"select * from ".$this->db->dbprefix('testimonials')
			." where tid=".$this->uri->segment(3)
			);
			$this->data['id'] 			= $this->uri->segment(3);
			$this->data['title'] 		= 'Övgüleri Güncelle';
		}
		else {
			$this->data['data'] 		= array();
			$this->data['id'] 			= '';
			$this->data['title'] 		= 'Övgü Ekle';
		}
				
		$Options['Active'] 				= 'Aktif';
		$Options['Inactive'] 			= 'Pasif';
		$this->data['element'] 			= $Options;
		
		$this->data['active_menu'] 		= 'testimonials';
		$this->data['content'] 			= 'admin/testimonials/addeditTestimonials';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	

	//Update General Settings
	function settings()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('site_title', 'Site Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules(
		'site_description', 
		'Site Description', 
		'trim|required'
		);
		$this->form_validation->set_rules(
		'site_keywords', 
		'Site Keywords', 
		'trim|required'
		);
		$this->form_validation->set_rules('site_url', 'Site URL', 'trim|required');
		$this->form_validation->set_rules('copy_right', 'Copy Right', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|integer');
		$this->form_validation->set_rules(
		'passing_score', 
		'Passing Score', 
		'trim|required|integer'
		);
		$this->form_validation->set_rules(
		'contact_email',
		'Contact Email',
		'trim|required|valid_email'
		);
		$this->form_validation->set_rules(
		'google_analytics',
		'Google Analytics',
		'trim|required'
		);
		$this->form_validation->set_rules(
		'certificate_content', 
		'Certificate Content', 
		'trim|required'
		);
		$this->form_validation->set_rules(
		'certificate_sign_text', 
		'Text for Signature', 
		'trim|required'
		);
		
		if(!empty($_FILES['site_logo']['name'])) {

			$this->form_validation->set_rules('site_logo',"Site Logo", 'callback__image_check['.$_FILES['site_logo']['name'].']');			

		}
		if(!empty($_FILES['certificate_logo']['name'])) {

			$this->form_validation->set_rules('certificate_logo',"Certificate Logo", 'callback__image_check['.$_FILES['certificate_logo']['name'].']');			

		}
		if(!empty($_FILES['certificate_sign']['name'])) {

			$this->form_validation->set_rules('certificate_sign',"Certificate Sign", 'callback__image_check['.$_FILES['certificate_sign']['name'].']');			

		}
		
		if ($this->form_validation->run() == true) {
			$image 		= $_FILES['site_logo']['name'];
			$image2 	= $_FILES['certificate_logo']['name'];
			$image3 	= $_FILES['certificate_sign']['name'];
			
			//Upload Website Logo
			if (!empty($image)) {	
				$r = $this->base_model->run_query(
				"select * from ".$this->db->dbprefix('general_settings').""
				);
				unlink('assets/designs/images/'.$r[0]->site_logo);
				unlink('assets/uploads/'.$r[0]->site_logo);
				
				$ext = explode('.', $_FILES['site_logo']['name']);
				$inputdata['site_logo'] = $image;
				move_uploaded_file(
				$_FILES['site_logo']['tmp_name'], 
				'assets/uploads/'.$image
				);	
				$this->create_thumbnail(
				'assets/uploads/'. $image, 
				'assets/designs/images/'. $image,360,64
				);
			}
			//Upload Logo on Certificate
			if (!empty($image2)) {	
				$r = $this->base_model->run_query(
				"select * from ".$this->db->dbprefix('general_settings').""
				);
				unlink('assets/uploads/certificate/'.$r[0]->certificate_logo);
				
				$inputdata['certificate_logo'] = $image2;
				move_uploaded_file(
				$_FILES['certificate_logo']['tmp_name'], 
				'assets/uploads/certificate/'.$image2
				);
			}
			//Upload Signature on Certificate
			if (!empty($image3)) {	
				$r = $this->base_model->run_query(
				"select * from ".$this->db->dbprefix('general_settings').""
				);
				unlink('assets/uploads/certificate/'.$r[0]->certificate_sign);
				$inputdata['certificate_sign'] = $image3;
				move_uploaded_file(
				$_FILES['certificate_sign']['tmp_name'], 
				'assets/uploads/certificate/'.$image3
				);
			}
			
			
			$inputdata['site_title'] 		= $this->input->post('site_title');
			$inputdata['site_description'] 	= $this->input->post('site_description');
			$inputdata['site_keywords'] 	= $this->input->post('site_keywords');
			$inputdata['site_url'] 			= $this->input->post('site_url');
			$inputdata['copy_right'] 		= $this->input->post('copy_right');
			$inputdata['address'] 			= $this->input->post('address');
			$inputdata['phone'] 			= $this->input->post('phone');
			$inputdata['passing_score'] 	= $this->input->post('passing_score');

			$inputdata['is_performance_report_for'] = $this->input->post('is_performance_report_for');
			$inputdata['quizzes_for'] 		= $this->input->post('quizzes_to_display');
			$inputdata['contact_email'] 	= $this->input->post('contact_email');
			$inputdata['google_analytics'] 	= $this->input->post('google_analytics');
			$inputdata['certificate_content'] = trim($this->input->post(
			'certificate_content')
			);
			$inputdata['certificate_sign_text'] = trim($this->input->post(
			'certificate_sign_text')
			);
			
			$inputdata['updated_date'] 		= date('Y-m-d');
			$this->base_model->update_operation(
			$inputdata, 
			$this->db->dbprefix('general_settings')
			);
			$msg = "Kayıt Başarıyla Güncellendi";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/settings');
		}
		
		$this->data['data'] 			= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('general_settings').""
		);
		$this->data['title'] 			= 'Güncel Ayarlar';
	
		$this->data['active_menu'] 		= 'settings';
		$this->data['content'] 			= 'admin/settings/settings';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	//Update Email Settings
	function emailSettings()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('smtp_host', 'Smtp Host', 'trim|required');
		$this->form_validation->set_rules('smtp_user', 'Smtp User', 'trim|required|xss_clean');
		$this->form_validation->set_rules('smtp_pass', 'Smtp Password', 'trim|required');
		$this->form_validation->set_rules('smtp_port', 'Smtp Port', 'trim|required');
		if($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['smtp_host'] 		= $this->input->post('smtp_host');
				$inputdata['smtp_user'] 		= $this->input->post('smtp_user');
				$inputdata['smtp_pass'] 		= $this->input->post('smtp_pass');
				$inputdata['smtp_port'] 		= $this->input->post('smtp_port');
				$this->base_model->update_operation(
				$inputdata, 
				$this->db->dbprefix('email_setting')
				);
				$msg = "Kayıt Başarıyla Güncellendi";
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/emailSettings');
			}
			else {				
					$this->prepare_flashmessage(validation_errors(), 1);
					redirect('admin/emailSettings');
			}
		}
		$this->data['data'] 			= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('email_setting').""
		);
		$this->data['title'] 			= 'E-Posta Ayarları';
	
		$this->data['active_menu'] 		= 'email-settings';
		$this->data['content'] 			= 'admin/settings/email_settings';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//Load View for Uploading Questions in Excel Format
	function uploadexcel()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("Bu Module erişim Yok",1);
				redirect('user', 'refresh');		
		}
		
		$this->data['title'] 			= 'Soruları Yükle';
		$this->data['active_menu'] 		= 'questions';
		$this->data['content'] 			= 'admin/questions/upload_question_excel';
		if($this->ion_auth->is_moderator())
			$template = "moderatortemplate";
		else
			$template = "admintemplate";
			
		$this->_render_page('temp/'.$template, $this->data);
	}
	
	//Read Excel Format Questions and Insert into DB
	function readquestionexcel()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("Bu Module erişim Yok",1);
				redirect('user', 'refresh');		
		}
		
		include(FCPATH.'/assets/excelassets/PHPExcel/IOFactory.php');
		$inputFileName 					= $_FILES['questionsfile']['tmp_name'];
		$objReader 						= new PHPExcel_Reader_Excel5();
		$objPHPExcel 					= $objReader->load($inputFileName);
		echo '<hr />';
		$sheetData 						= $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$i								= 0;
		$j 								= 0;
		$data 							= array();
		$valid 							= 1;
		foreach ($sheetData as $r) {
			if ($i++ != 0) {			
			    if ($valid == 1) {
					$data[$j++] = array(
										'subjectid' 	=> $r['A'], 
										'questiontype' 	=> $r['B'],
										'totalanswers' 	=> $r['C'],
										'question' 		=> $r['D'],
										'answer1' 		=> $r['E'], 
										'answer2' 		=> $r['F'],
										'answer3' 		=> $r['G'],
										'answer4' 		=> $r['H'],
										'answer5' 		=> $r['I'],
										'correctanswer' => $r['J'],
										'difficultylevel' => $r['K'],
										'status' 		=> $r['L']
										);
				}
				else {
					break;
				}
			}
		
		}
			if ($valid == 1) {
				$this->db->insert_batch($this->db->dbprefix('questions'), $data);
			}
			else {
				$msg 	= "Excel içinde geçersiz Veri";
				 $this->prepare_flashmessage($msg, 1);
				 redirect('admin/uploadexcel', 'refresh');
			}
			
			if ($this->db->affected_rows() > 0) {
				$msg = "Soru Başarıyla Eklendi";
				$this->prepare_flashmessage($msg, 0);
			}
			else {
				 $msg = "Soru Başarıyla Eklenemedi";
				 $this->prepare_flashmessage($msg, 1);
			}
				redirect('admin/uploadexcel', 'refresh');
	}
	
	
	//About Us Content Updation
	function aboutusContent()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
		'content', 
		'Content for Aboutus', 
		'trim|required'
		);
		
		if ($this->form_validation->run() == true) {		
			$inputdata['content'] = trim($this->input->post('content'));
			$inputdata['date_modified'] = date('Y-m-d');
			$this->base_model->update_operation(
			$inputdata, 
			$this->db->dbprefix('aboutus_content')
			);
			$msg = "Kayıt Başarıyla Güncellendi";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/aboutusContent');
		}
		
		$this->data['data'] = $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('aboutus_content').""
		);
		$this->data['title'] 			= 'PDF içeriği Güncelle';
		$this->data['active_menu'] 		= 'aboutus_content';
		$this->data['content'] 			= 'admin/aboutus_content';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	//Get availabile questions according to subject and difficulty level.
	function get_available_questions()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage(" 	Bu modüle erişim yok ",1);
				redirect('user', 'refresh');		
		}
		
		$subjectid 						= $this->input->post('subjectid');
		$difficultylevel 				= $this->input->post('difficultylevel');		
		$available_questions_cnt 		= $this->base_model->run_query(
		"select count(*) as cnt from questions where subjectid="
		.$subjectid." and difficultylevel = '".$difficultylevel."' 
		and answer1!='' and answer2 != '' and correctanswer!='' "
		);
		echo $available_questions_cnt[0]->cnt;
	}
	
	
	//Validation for checking duplicates when performing add operation
	function check_duplicates()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("Bu modüle erişim yok",1);
				redirect('user', 'refresh');		
		}
		
		$table 							= $this->input->post('table');
		$cond 							= $this->input->post('condition');
		$cond_val 						= $this->input->post('condition_value');
		$condition[$cond] 				= $cond_val;
		if ($this->base_model->check_duplicates($table,$condition)) {
		    echo "false";//No Availability	
		}
		else {
			echo "true";
		}
	}
	
	
	//Validation for checking duplicates when performing update operation. Here will check the availability except with the updating one.
	function check_duplicates_with_not_cond()
	{
		if(!$this->ion_auth->logged_in() || !($this->ion_auth->is_admin() || $this->ion_auth->is_moderator()))		
		{				
			$this->prepare_flashmessage("Bu modüle erişim yok",1);
				redirect('user', 'refresh');		
		}
		
		$table 							= $this->input->post('table');
		$cond 							= $this->input->post('condition');
		$cond_val 						= $this->input->post('condition_value');
		$not_cond 						= $this->input->post('not_condition');
		$not_cond_val 					= $this->input->post('not_condition_value');
		$duplicates 					= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix($table)." where "
		.$cond."='".$cond_val."' and ".$not_cond."!=".$not_cond_val
		);
	
		if (count($duplicates)>0) {
			echo "false";//No Availability
		}
		else {
			echo "true";
		}
	}
	
	function paypal_settings()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('paypal_email', 'Paypal Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('currency_code', 'currency_code', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() == true) {
			$inputdata['paypal_email'] 		= $this->input->post('paypal_email');
			$inputdata['currency_code'] 		= $this->input->post('currency_code');
			$inputdata['status'] 			= $this->input->post('status');
			$inputdata['account_type'] 			= $this->input->post('account_type');
			$this->base_model->update_operation(
			$inputdata, 
			$this->db->dbprefix('paypal')
			);
			$msg = "Kayıt başarıyla güncellendi";
			$this->prepare_flashmessage($msg, 0);
			redirect('admin/paypal_settings');
		}
		else
		{
			if(validation_errors())
			$this->prepare_flashmessage(validation_errors(), 1);
		}
		
		$this->data['data'] 			= $this->base_model->run_query(
		"select * from ".$this->db->dbprefix('paypal').""
		);
		
		$Options['Active'] 				= 'Aktif';
		$Options['Inactive'] 			= 'Pasif';
		$this->data['status'] 			= $Options;
		unset($Options);
		$Options['Sandbox'] 			= 'Havuz';
		$Options['Production'] 			= 'Üretim';
		$this->data['account_type'] 	= $Options;
		
		$currency[''] 		= 'Para Birimi Seç';
		$cRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('currencies')
		);
		foreach ($cRecords as $key=>$val) {
		    $currency[$val->code]=$val->country;	
		}
		$this->data['currency'] 		= $currency;
		
		$this->data['title'] 			= 'Paypal Ayarları';
	
		$this->data['active_menu'] 		= 'paypal';
		$this->data['content'] 			= 'admin/settings/paypal_settings';
		$this->_render_page('temp/admintemplate', $this->data);
		
	}
	
	//Function for Payments Reports
	function payreport()
	{
		$this->validate_admin();
		
		$this->data['title'] 			= 'Ödeme Raporları';
		$this->data['active_menu'] 		= 'payment_report'; 
		$this->data['records'] 			= $this->base_model->run_query(
		"SELECT s.user_id,s.transaction_id, s.payer_email, s.payer_name, 
		q.name as quizname, q.quizcost as cost, u.username,s.dateofsubscription FROM "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('quizsubscriptions')
		." s,".$this->db->dbprefix('users')." u  where
		 s.quizid=q.quizid and s.user_id=u.id"
		);
		$this->data['content'] 			= 'admin/reports/payment_reports';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	 
	
	// Function For Logout
	function logout()
	{
		$this->session->sess_destroy();
		$this->prepare_flashmessage("Başarıyla çıkış yapıldı.", 0);
		redirect('welcome');
	
	}
	// function for Uploading Logo
	function do_upload()
	{
		$this->validate_admin();
		
		$config['upload_path'] 			= './assets/uploads/paypal_logo';
		$config['allowed_types'] 		= 'jpg';
		$config['max_size']				= '1000';
		$config['max_width']  			= '400';
		$config['max_height'] 			= '100';
		$config['file_name'] 			= 'logo.jpg';
		$config['overwrite'] 			= TRUE;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload())
		{
			$this->prepare_flashmessage($this->upload->display_errors(), 1);
			redirect('admin/paypal_settings');
		}
		else
		{
			$this->prepare_flashmessage("Logo Başarıyla Yüklendi", 0);
			redirect('admin/paypal_settings');
			
		}
	}
	
	function group_settings()
	{
		$this->validate_admin();
		
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$where['id'] 	= $this->uri->segment(3);
			$this->base_model->delete_record($this->db->dbprefix('group_settings'), $where);
			$this->prepare_flashmessage("Kayıt başarıyla silindi", 0);
			redirect('admin/group_settings');		
		}
				
		$this->data['title'] 		= 'Grup Ayarları';
		$this->data['active_menu'] 	= '';
		$this->data['records'] 		= $this->base_model->fetch_records_from(
		$this->db->dbprefix('group_settings')
		);
		$this->data['content'] 		= 'admin/settings/group_settings';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
	function add_group()
	{
		$this->validate_admin();
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('group_name', 'Group Name', 'trim|required');
		
		if ($this->input->post()) {
			if ($this->form_validation->run() == true) {
				$inputdata['group_name'] 		= $this->input->post('group_name');
				$inputdata['status'] 	= $this->input->post('status');
				
				if ($this->input->post('id') == '') {
					$this->base_model->insert_operation(
					$inputdata,
					$this->db->dbprefix('group_settings')
					);
					
					$msg = "Kayıt Başarıyla Eklendi";
				}
				else {
					$where['id'] = $this->input->post('id');
					$this->base_model->update_operation(
					$inputdata, 
					$this->db->dbprefix('group_settings'), 
					$where
					);
					$msg = "Kayıt Başarıyla Güncellendi";
				}
				$this->prepare_flashmessage($msg, 0);
				redirect('admin/group_settings', 'refresh');
			}
			else {
				$this->prepare_flashmessage(validation_errors(), 1);
				redirect('admin/add_group', 'refresh');
			}
		}
		if ($this->uri->segment(3) != '' && is_numeric($this->uri->segment(3))) {
			$this->data['data'] 	= $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('group_settings')
			." where id=".$this->uri->segment(3)
			);
			$this->data['id'] 		= $this->uri->segment(3);
			$this->data['title'] 	= 'Grup Güncelle';
		}
		else {
			$this->data['data'] 	= array();
			$this->data['id'] 		= '';
			$this->data['title'] 	= 'Grup Ekle';
		}
		$Options['Active'] 			= 'Aktif';
		$Options['Inactive'] 		= 'Pasif';
		$this->data['element'] 		= $Options;
		$this->data['active_menu'] 	= '';
		$this->data['content'] 		= 'admin/settings/add_group_settings';
		$this->_render_page('temp/admintemplate', $this->data);
	}
	
	
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */