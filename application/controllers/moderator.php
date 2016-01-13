<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moderator extends MY_Controller {

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
| MODULE: 			Moderator
| -----------------------------------------------------
| This is moderator module controller file.
| -----------------------------------------------------
*/

	/***Authenticate Moderator for each function by calling the Parent Method 
	validate_moderator() in Constructor***/
	function __construct()
    {
        parent::__construct();
		$this->validate_moderator();
    }
	
	/***Moderator Dashboard (Default Function. If no function is called, this function
	 will be called)***/
	public function index()
	{
		redirect('moderator/dashboard');
	}

	/***Moderator Dashboard***/
	function dashboard()
	{
		$table = $this->db->dbprefix('users');
		
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
		
		$this->data['recentUserQuizzes'] 	= $recentUserQuizzes;
		$this->data['topRankers'] 			= $topRankers;
		$this->data['title'] 				= 'Moderator Dashboard';
		$this->data['active_menu'] 			= 'dashboard';
		$this->data['content'] 				= 'moderator/index';
		$this->_render_page('temp/moderatortemplate', $this->data);
	
	}
	
	
	//Moderator Profile
	function profile()
	{
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
			$this->data['content'] 	= 'moderator/profile';
			$this->data['title'] 	= 'Moderator Profile';
			$this->_render_page('temp/moderatortemplate', $this->data);
		}
		else {
			$this->prepare_flashmessage('Oturum Süresi Doldu!', 2);
			redirect('auth/login', 'refresh');
		}
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
	
	//Update Moderator Profile
	function updateProfile()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 
		'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 
		'trim|required|xss_clean');
		$this->form_validation->set_rules('phone', 'Phone', 
		'required|xss_clean|integer');
		
		if(!empty($_FILES['image']['name'])) {

			$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			

		}
		
		if ($this->form_validation->run() == true) {
			$userid = $this->input->post('user');
			if ($this->input->post('submit')!='' 
			&& isset($userid) 
			&& $userid!='' 
			&& is_numeric($userid)
			) {
				$data['first_name'] 	= $this->input->post('first_name');
				$data['last_name'] 		= $this->input->post('last_name');
				$data['username'] 		= $this->input->post('first_name')
				." ".$this->input->post('last_name');
				$data['phone'] 			= $this->input->post('phone');
				
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
					if(!empty($_FILES['image']['name'])) {

			$this->form_validation->set_rules('image',"Profile Image", 'callback__image_check['.$_FILES['image']['name'].']');			

					}
					else {
						$this->prepare_flashmessage(validation_errors(), 1);
						redirect('moderator/profile', 'refresh');
					}
					
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
				'Profiliniz başarıyla güncellendi.', 0
				);
				redirect('moderator/profile', 'refresh');
			}
			else {
				$this->prepare_flashmessage('Session Expired!', 2);
				redirect('auth/login', 'refresh');
			}
		}
		else {
			$this->prepare_flashmessage(validation_errors(), 1);
			redirect('moderator/profile', 'refresh');
		}
	}
	
	
}

/* End of file moderator.php */
/* Location: ./application/controllers/moderator.php */