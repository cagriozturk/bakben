<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

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
| MODULE: 			User
| -----------------------------------------------------
| This is user module controller file.
| -----------------------------------------------------
*/

	 //Authenticate User for each function by calling the Parent Method validate_normaluser() in Constructor.
	function __construct()
    {
        parent::__construct();
		
		$this->validate_normaluser();
    } 
	
	//User Dashboard (Default Function. If no function is called, this function will be called)
	public function index()
	{
		$this->data['active_menu'] 		= 'dashboard';
		$this->data['content'] 			= 'user/index';
		$table 							= $this->db->dbprefix('quiz');
		$userId 						= $this->session->userdata('user_id');
		
		//Get the User Quiz wise Performance to Display in the user dashboard in Chart.
		$userPerformance 				= $this->base_model->run_query(
		"select qr.*,q.* from ".$this->db->dbprefix('user_quiz_results')." qr, "
		.$this->db->dbprefix('quiz')." q where q.quizid=qr.quiz_id and qr.userid="
		.$userId." ORDER BY rand() LIMIT 4"
		);
		
		$result 						= array( );
		$temp 							= array();
		array_push($temp, "Quiz", "Total Questions", "Best Score");
		array_push($result, $temp);
		foreach ($userPerformance as $d) {
			$temp=array();
			array_push($temp,$d->name, $d->total_questions, $d->score);
			array_push($result, $temp);
		}
		$str = "";
		$cnt = 0;
		foreach ($result as $r) {
			if ($cnt++ == 0) {
				$str = $str . "['".$r[0]."','".$r[1]."','".$r[2]."'],";
			}
			else {
				$str = $str . "['".$r[0]."',".$r[1].",".$r[2]."],";
			}
		}
		if(count($userPerformance)>0)
			$this->data['result'] 			= $str;
		else
			$this->data['result'] 			= "";
		
		$records 						= $this->base_model->fetch_records_from(
		$table, 
		$condition 	= '',
		$select 	= 'quizid,quiztype,name,difficultylevel,deauration', 
		$order_by 	= 'quizid DESC', 
		$limit 		= '5'
		);
		
		//Top Rankers
		$topRankers = $this->base_model->run_query(
		"select qr.*,u.image,q.name from ".$this->db->dbprefix('user_quiz_results')
		." qr,".$this->db->dbprefix('users')." u,".$this->db->dbprefix('quiz')
		." q where u.id=qr.userid and q.quizid=qr.quiz_id ORDER BY (qr.score*100/qr.total_questions) 
		DESC LIMIT 5"
		);
		
		//Recent User Quizzes
		$recentUserQuizzes = $this->base_model->run_query(
		"SELECT * FROM( SELECT qh.*,q.name,u.image FROM "
		.$this->db->dbprefix('user_quiz_results_history')." qh,"
		.$this->db->dbprefix('quiz')." q, ".$this->db->dbprefix('users')
		." u where q.quizid=qh.quiz_id and u.id=qh.userid ORDER BY 
		qh.dateoftest DESC ) as recent GROUP BY quiz_id LIMIT 10"
		);
		
		$this->data['exams'] 				= $records;
		$this->data['topRankers'] 			= $topRankers;
		$this->data['recentUserQuizzes'] 	= $recentUserQuizzes;
		$this->_render_page('temp/usertemplate', $this->data);
	}
	
	//User Profile
	function profile()
	{
		$userid 						= $this->session->userdata('user_id');
		if (isset($userid) && $userid!='') {
			$table 						= $this->db->dbprefix('users');
			$condition['id'] 			= $userid;
			$records 					= $this->base_model->fetch_records_from(
			$table, 
			$condition, 
			$select = '*', 
			$order_by = ''
			);
			
			//Options for Groups For
		
		$groupsoptions['0']='Select Group'; 
		$groupsRecords = $this->base_model->fetch_records_from(
		$this->db->dbprefix('group_settings')
		);
		
		foreach ($groupsRecords as $key=>$val) {
		    $groupsoptions[$val->id]	= $val->group_name;	
		}
		$this->data['groups'] 		= $groupsoptions;
			
			
			$this->data['details'] 		= $records;
			$this->data['content'] 		= 'user/profile';
			$this->data['active_menu'] 	= 'profile';
			$this->data['title'] 		= 'Porifilim';
			$this->_render_page('temp/usertemplate', $this->data);
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
		
		if (!in_array($ext, $allowed_types))
		{			
			
			$this->form_validation->set_message('_image_check', 'Only jpg / jpeg / png images are accepted.');
			
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	//Update Profile
	function update_profile()
	{
		$this->form_validation->set_rules(
		'first_name', 
		'First Name', 
		'trim|required|xss_clean'
		);
		$this->form_validation->set_rules(
		'last_name', 
		'Last Name', 
		'trim|required|xss_clean'
		);
		$this->form_validation->set_rules(
		'phone', 
		'Phone', 
		'required|xss_clean|integer'
		);
		
		if(!empty($_FILES['image']['name'])) {

			$this->form_validation->set_rules('image',"Image", 'callback__image_check['.$_FILES['image']['name'].']');			

		}
		
		if ($this->form_validation->run() == true) {
			$userid = $this->input->post('user');
			if ($this->input->post('submit') !='' && 
			isset($userid) && $userid!='') {				
				$data['first_name'] 	= $this->input->post('first_name');
				$data['last_name'] 		= $this->input->post('last_name');
				$data['username'] 		= $this->input->post('first_name')
				." ".$this->input->post('last_name');
				$data['phone'] 			= $this->input->post('phone');
				
				$data['group'] 			= $this->input->post('group');
				
				//Unset User Name
				$this->session->unset_userdata('username');
				//Set User Name
				$this->session->set_userdata('username', $data['username']);
				$image 					= $_FILES['image']['name'];
				
				//Upload User Photo
				if (!empty($image)) {	
					$r 					= $this->base_model->run_query(
					'select image from '.$this->db->dbprefix('users')
					.' where image !="" and id='.$userid
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
					
					$data['image'] 		= $img;
					move_uploaded_file(
					$_FILES['image']['tmp_name'], 
					'assets/uploads/images/'.$img
					);
					$this->create_thumbnail(
					'assets/uploads/images/'. $img, 
					'assets/uploads/images(200x200)/'. $img,
					200,
					200
					);
					$this->create_thumbnail(
					'assets/uploads/images/'. $img, 
					'assets/uploads/images(50x50)/'. $img,
					50,
					50
					);
					
					//Set User Image
					$this->session->set_userdata('image', $img);
					
					
				}
				
				$table 					= $this->db->dbprefix('users');
				$where['id'] 			= $userid;
				$this->base_model->update_operation($data, $table, $where);
				$this->prepare_flashmessage(
				'Profiliniz başarıyla güncellendi.', 
				0
				);
				redirect('user/profile', 'refresh');
			}
			else {
				$this->prepare_flashmessage('Session Expired!', 2);
				redirect('auth/login', 'refresh');
			}
		}
		else {
			$this->prepare_flashmessage(validation_errors(), 1);
			redirect('user/profile', 'refresh');
		}
	}
	//Fetch Sub Categories for Category id
	function get_subcategories()
		{
			$id=$this->input->post('catid');
			$sub=$this->base_model->run_query(
			"select subcatid,name from ".$this->db->dbprefix('subcategories')
			." where catid=".$id
			);
			echo json_encode($sub); 
		}
	public function instructions()
	{	
		$check = $this->base_model->run_query("SELECT quizzes_for from general_settings");
		$this->data['records_for_all']=array(); 
		if($check[0]->quizzes_for == "groupquizzes") {
		$userid = $this->ion_auth->get_user_id();
		
		$check_user_group = $this->base_model->run_query("SELECT * FROM users WHERE id= ".$userid);
		

		$this->data['records'] 			= $this->base_model->run_query(
		"select q.*,c.name as catname,s.name as subcatname from "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
		." c,".$this->db->dbprefix('subcategories')." s,  ".$this->db->dbprefix('quiz_for')." qf 
		where c.catid=q.catid AND s.subcatid=q.subcatid 
		AND (qf.groupid = ".$check_user_group[0]->group." and qf.quizid = q.quizid ) 
		AND q.status='Active' group by q.quizid"
		);
		
		
		$this->data['records_for_all'] 	= $this->base_model->run_query(
		"select q.*,c.name as catname,s.name as subcatname from "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
		." c,".$this->db->dbprefix('subcategories')." s  where c.catid=q.catid AND s.subcatid=q.subcatid 
		AND q.quiz_for != '*' and q.status = 'Active'  
		AND q.status='Active' group by q.quizid"
		);
		//echo "<pre>"; print_r("hello"); 
		
		} else {
		
		
		$this->data['records'] 			= $this->base_model->run_query(
		"select q.*,c.name as catname,s.name as subcatname from "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
		." c,".$this->db->dbprefix('subcategories')." s where c.catid=q.catid 
		and s.subcatid=q.subcatid"
		);
		
		}
		// Code written for fetching quizzes based on admin restrictions END
		
		$options_for_all = array();
		$i=0;
		foreach($this->data['records'] as $key=> $val) {
			
			$options[$i]	= $val->quizid;
			$i++;
		}
		$this->data['quiz_ids'] = $options;
		$j=0;
		
		foreach($this->data['records_for_all'] as $key=> $val) {
			
			$options_for_all[$j]	= $val->quizid;
			$j++;
		}
		$records = array();
		$this->data['quiz_ids_for_all'] = $options_for_all;
		$id = $this->uri->segment(3);
		if (in_array($id, $options) || in_array($id,$options_for_all)) {
			$this->data['title'] 			= 'Sınav/Sınav Talimatı';
			$this->data['active_menu'] 		= 'exams';
			$this->data['content'] 			= 'user/exam/examinstructions';
			$table 							= $this->db->dbprefix('quiz');
			$condition['quizid'] 			= $id;
			$records 						= $this->base_model->fetch_records_from(
			$table, 
			$condition, 
			$select 						= '*', 
			$order_by 						= ''
			);
			$this->data['exams'] = $records;
			$payment_info = $this->base_model->run_query("select * from quizsubscriptions where quizid = ".$id." and user_id=".$this->ion_auth->user()->row()->id." and status='Active' and (remainingattempts > 0 or expirydate > '".date('Y-m-d')."')");
			$this->data['is_authorized'] = FALSE;
			if ((isset($payment_info) && count($payment_info)>0) || $records[0]->quiztype=='Free') {
					$this->data['is_authorized'] = TRUE;
					$this->data['payment_info'] = $payment_info;
			
				/**THIS BELOW INFORMATION WILL BE FETCHED BACK AT THE TIME OF STARTING THE EXAM(exam/startexam)
				** DESTROYED AFTER FINISHING EXAM
				**/
				$validity_type  = ''; 
				$account_id 	= '';
				if ($records[0]->quiztype=='Paid') {
					$validity_type 	= $payment_info[0]->remainingattempts;
					$account_id 	= $payment_info[0]->id;
				}
				$account_validation = array(
										'is_authorized'		=> $this->data['is_authorized'],
										'quiz_type'			=> $records[0]->quiztype,
										'validitytype'		=> $records[0]->validitytype,
										'validityvalue'		=> $validity_type,
										'account_id'		=> $account_id
										);
				$this->session->set_userdata('account_validation',$account_validation);
				$this->session->set_userdata('is_user_account_modified',0);
				//UNSET SESSION QUESTIONS. AND SET THE isExamStarted BIT TO 1. 
				//So that for every request (quiz/exam) new questions will be created.
				$this->session->unset_userdata('questions');
				$this->session->set_userdata('isExamStarted', 1);
			}
			$this->_render_page('temp/usertemplate', $this->data);
		}
		else {
			$this->prepare_flashmessage("Geçersiz sınav girişimi...", 1);
			redirect('user/quizzes', 'refresh');
		}
		
	}
	
	//User Quiz History
	function quiz_history()
	{
		$userid = $this->session->userdata('user_id');
		$today = date('Y-m-d');
		$commontable = "quizsubscriptions";
		$status = FALSE;
		
		$is_performance_report_for = $this->base_model->run_query("SELECT is_performance_report_for FROM general_settings");
		
		if($is_performance_report_for[0]->is_performance_report_for == "Paidusers") {
		$query = $this->db->query("SELECT * FROM ".$commontable." WHERE user_id=".$userid);
			if($query->num_rows()>0)
				$status = TRUE;
			else
				$status = FALSE;
		} 
		else {
			$status = TRUE;
		}
		if (isset($userid) && $userid != '' && is_numeric($userid)) {
		
			if($status) {
			
				$records = $this->base_model->run_query(
				"select qr.*,q.* from ".$this->db->dbprefix('user_quiz_results')
				." qr,".$this->db->dbprefix('quiz')." q where q.quizid=qr.quiz_id 
				and qr.userid=".$userid
				);
				$index = array();
				for($i=0,$j=0;$i<count($records);$i++) {
					
					if($records[$i]->quiztype == "Paid")
					$query = $this->base_model->run_query("SELECT * FROM quizsubscriptions WHERE quizid =".$records[$i]->quiz_id);
					elseif($records[$i]->quiztype == "Free")
						continue;
					
					if(!count($query)>0) {
					   $index[$j] = $i; 
					   $j++;
					}
					
				}
				for($i=0;$i<count($index);$i++)
					unset($records[$index[$i]]);
				 
				$this->data['quiz_history'] 	= $records;
				$this->data['title'] 			= 'Sınav/Sınav Tarihi';
				$this->data['active_menu'] 		= 'quiz_history';
				$this->data['content'] 			= 'user/exam/examhistory';
				$this->_render_page('temp/usertemplate', $this->data);
			}
			else {
				$this->prepare_flashmessage('Üzgünüm. Sınav performans raporu premium üyeler içindir .', 2);
				redirect('user', 'refresh');
			}
		} else {
		
			$this->prepare_flashmessage('Oturum Süresi Doldu!', 2);
			redirect('user', 'refresh');
		
		}
	}
	
	
	//User Quiz wise Performance History
	function performance()
	{
		$userid 	= $this->session->userdata('user_id');
		$query 		= "SELECT * FROM ".$this->db->dbprefix('user_quiz_results_history')
		." where userid = ".$userid ." limit 10";
		
		if ($this->uri->segment(3)) {
			$quiz_id 					= $this->uri->segment(3);
			$query = "select qh.*,q.* from "
			.$this->db->dbprefix('user_quiz_results_history')." qh,"
			.$this->db->dbprefix('quiz')." q where q.quizid=qh.quiz_id 
			and qh.userid=".$userid." and qh.quiz_id=".$quiz_id." 
			ORDER BY dateoftest ASC limit 10";
		}
		$data = $this->base_model->run_query($query);
		$this->data['info'] 			= "Performance Report of ".$data[0]->username;
		if ($this->uri->segment(3)) {
			$this->data['info'] 		= "Performans Raporu "
			.$data[0]->username." in ".$data[0]->name;
		}
		$result 						= array( );
		$temp							= array();
		array_push($temp, "Date", "Score", "Total Questions");
		array_push($result, $temp);
		foreach ($data as $d) {
			$temp = array();
			array_push(
			$temp, 
			$d->dateoftest."  (".$d->score."/".$d->total_questions.")", 
			$d->score,$d->total_questions
			);
			array_push($result, $temp);
		}
		$str 							= "";
		$cnt 							= 0;
		foreach ($result as $r) {
			if ($cnt++ == 0) {
				$str = $str . "['".$r[0]."','".$r[1]."','".$r[2]."'],";
			}
			else {
				$str = $str . "['".$r[0]."',".$r[1].",".$r[2]."],";
			}
		}
		$this->data['result'] 			= $str;
		$this->data['active_menu'] 		= 'exams';
		$this->load->view('user/exam/performance', $this->data);
	}
	
	
	//View Quizzes
	  function quizzes()
    {        //echo "hello"; die();
	$this->data['records_for_all'] = array();
        //Options for Quiz Type
        $qztype['']                     = 'Sınav Türü Seç';
        $qztype['Free']                 = 'Parasız';
        $qztype['Paid']                 = 'Ücretli';
        $this->data['quiztypes']         = $qztype;
        
        //Options for Difficulty Level
        $dlevel['']                     = 'Zorluk Düzeyi Seçin';
        $dlevel['Easy']                 = 'Kolay';
        $dlevel['Medium']                 = 'Orta';
        $dlevel['High']                 = 'Zor';
        $this->data['difficultylevels'] = $dlevel;
        
        //Options for Categories
        $catOptions['']                 = 'Kategori Seç';
        $catRecords                     = $this->base_model->fetch_records_from(
        $this->db->dbprefix('categories')
        );
        foreach ($catRecords as $key=> $val) {
            $catOptions[$val->catid]    = $val->name;
        }
        $this->data['categories']         = $catOptions;
        $this->data['data']             = array();        
        $this->data['title']             = 'Sınavlar';
        $this->data['active_menu']         = 'exams';
        
        // Code written for fetching quizzes based on admin restrictions
        $check = $this->base_model->run_query("SELECT quizzes_for from general_settings");
        $today = date('Y-m-d');
        if($check[0]->quizzes_for == "groupquizzes") {
        
        
        
        $userid = $this->ion_auth->get_user_id();
    
        $check_user_group = $this->base_model->run_query("SELECT * FROM users WHERE id= ".$userid);
        
        
        $this->data['records']             = $this->base_model->run_query(
        "select q.*,c.name as catname,s.name as subcatname from "
        .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
        ." c,".$this->db->dbprefix('subcategories')." s,  ".$this->db->dbprefix('quiz_for')." qf 
        where c.catid=q.catid AND s.subcatid=q.subcatid 
        AND (qf.groupid = ".$check_user_group[0]->group." and qf.quizid = q.quizid ) 
        AND q.status='Active' AND q.enddate>='".$today."' group by q.quizid"
        );
        
        
        $this->data['records_for_all']     = $this->base_model->run_query(
        "select q.*,c.name as catname,s.name as subcatname from "
        .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
        ." c,".$this->db->dbprefix('subcategories')." s  where c.catid=q.catid AND s.subcatid=q.subcatid 
        AND q.quiz_for != '*' and q.status = 'Active'  
        AND q.status='Active' AND q.enddate>='".$today."' group by q.quizid"
        );
        
        //echo "<pre>"; print_r($this->data['records_for_all']); die();
        
        } else {        
        
        $this->data['records']             = $this->base_model->run_query(
        "select q.*,c.name as catname,s.name as subcatname from "
        .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
        ." c,".$this->db->dbprefix('subcategories')." s where c.catid=q.catid 
        AND s.subcatid=q.subcatid AND q.status='Active' AND q.enddate>='".$today."'"  
        );
        
        
        
        
        }
        
        $this->data['content']             = 'user/exam/quizzes';
        $this->_render_page('temp/usertemplate', $this->data);
    } 
	
	//Get Quizzes by user selected Options like Category, Sub Category, Quiz Type 
	//and Difficulty Level.
	function get_quizzes()
    {
        $today = date('Y-m-d');
        
        $category_id                     = $this->input->post('catid');
        $sub_category_id                 = $this->input->post('subcatid');
        $quiz_type                         = $this->input->post('quiztype');
        $difficulty_level                 = $this->input->post('difficultylevel');        
        $cond1                             = 1; 
        $cond_val1                        = 1;
        $cond2                             = 1; 
        $cond_val2                        = 1;
        $cond3                             = 1; 
        $cond_val3                        = 1;
        $cond4                             = 1; 
        $cond_val4                        = 1;
        $cond5                             = 1;
        $cond6                             = "";
        $cond7                             = 1;
        $cond8                             = "";
        $cat_table                         = '';
        $sub_cat_table                     = '';
        
        if (trim($category_id) != "") {
            $cond1                         = "q.catid"; 
            $cond_val1                    = $category_id;            
        }
        if (trim($sub_category_id) != "") {
            $cond2                         = "q.subcatid"; 
            $cond_val2                     = $sub_category_id;            
        }
        if (trim($quiz_type) != "") {
            $cond3                         = "q.quiztype"; $cond_val3= $quiz_type;
        }
        if (trim($difficulty_level) != "") {
            $cond4                         = "q.difficultylevel"; 
            $cond_val4                     = $difficulty_level;
        }
        
        if(
        trim($category_id)         !=""     || 
        trim($sub_category_id)     !=""     || 
        trim($quiz_type)         !=""     || 
        trim($difficulty_level) !=""
        ) {
            $cond5                         = "c.catid";
            $cond6                         = ", c.name as catname";
            $cat_table                     = ', '.$this->db->dbprefix('categories').' c';
            $cond7                         = "s.subcatid";
            $cond8                         = ", s.name as subcatname";
            $sub_cat_table                 = ', '.$this->db->dbprefix('subcategories').' s';
            
            $check = $this->base_model->run_query("SELECT quizzes_for from general_settings");
        
            if($check[0]->quizzes_for == "groupquizzes") {
            
                $userid = $this->ion_auth->get_user_id();
    
                $check_user_group = $this->base_model->run_query("SELECT * FROM users WHERE id= ".$userid);
                
                $query      = 'select q.*'.$cond6.$cond8.' from '
                .$this->db->dbprefix('quiz').' q'.$cat_table.$sub_cat_table.', '.$this->db->dbprefix('quiz_for').' qf
                where '.$cond1.'='.$cond_val1.' and '.$cond2.'='.$cond_val2
                .' and '.$cond3.'="'.$cond_val3.'" and '.$cond4.'="'.$cond_val4
                .'" and '.$cond5.'=q.catid and '.$cond7.'=q.subcatid 
                AND (qf.groupid = '.$check_user_group[0]->group.' and qf.quizid = q.quizid )
                AND q.status="Active" AND q.enddate>="'.$today.'" group by q.quizid';
            
            } else {
            
                $query                         = 'select q.*'.$cond6.$cond8.' from '
                .$this->db->dbprefix('quiz').' q'.$cat_table.$sub_cat_table
                .' where '.$cond1.'='.$cond_val1.' and '.$cond2.'='.$cond_val2
                .' and '.$cond3.'="'.$cond_val3.'" and '.$cond4.'="'.$cond_val4
                .'" and '.$cond5.'=q.catid and '.$cond7.'=q.subcatid AND q.status="Active" AND q.enddate>="'.$today.'"';
                        
            }        
            
        }
        else {
            
            $check = $this->base_model->run_query("SELECT quizzes_for from general_settings");
        
            if($check[0]->quizzes_for == "groupquizzes") {
            
                $userid = $this->ion_auth->get_user_id();
    
                $check_user_group = $this->base_model->run_query("SELECT * FROM users WHERE id= ".$userid);
                
                $query = "select q.*,c.name as catname,s.name as subcatname from "
                .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
                ." c,".$this->db->dbprefix('subcategories')." s, ".$this->db->dbprefix('quiz_for')." qf where c.catid=q.catid 
                and s.subcatid=q.subcatid AND (qf.groupid = ".$check_user_group[0]->group." and qf.quizid = q.quizid )
                AND q.status='Active' AND q.enddate>='".$today."' group by q.quizid";
            
            } else {
            
                $query = "select q.*,c.name as catname,s.name as subcatname from "
                .$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('categories')
                ." c,".$this->db->dbprefix('subcategories')." s where c.catid=q.catid 
                and s.subcatid=q.subcatid AND q.status='Active' AND q.enddate>='".$today."'";
            
            }            
            
        }
        $records=$this->base_model->run_query($query);
        echo json_encode($records);    
    }
	
	//Fetch Subjects according to Quiz
	function get_subjects()
	{
		$id=$this->input->post('quizid');
		$sub=$this->base_model->run_query(
		"select qq.*,s.name as subjectname from "
		.$this->db->dbprefix('quizquestions')." qq,"
		.$this->db->dbprefix('subjects')." s where s.subjectid=qq.subjectid 
		and qq.quizid=".$id
		);
		echo json_encode($sub); 
	}
	
	
	//Download the Certificate for the Quiz which consists of best score 
	// among all attempts for the quiz.
	function certificate()
	{
		if ($this->uri->segment(3)) {
			$userid 					= $this->session->userdata('user_id');
			$quizid 					= $this->uri->segment(3);
			//general_settings
			$quizinfo 					= $this->base_model->run_query(
			"SELECT r.username,r.email,r.score,r.total_questions 
			as maxscore,r.dateoftest,q.name as examname FROM "
			.$this->db->dbprefix('user_quiz_results')." r, "
			.$this->db->dbprefix('quiz')." q WHERE userid=".$userid
			." and quiz_id=".$quizid." and r.quiz_id=q.quizid"
			);
			$quizinfo 					= $quizinfo[0];
			$contentinfo 				= $this->base_model->run_query(
			"select   certificate_logo,certificate_content,
			certificate_sign,certificate_sign_text from "
			.$this->db->dbprefix('general_settings')
			);
			$contentinfo 				= $contentinfo[0];
			$this->data['content'] 		= $contentinfo->certificate_content;
			$this->data['adminsign'] 	= $contentinfo->certificate_sign_text;
			$this->data['signimage'] 	= $contentinfo->certificate_sign;
			$this->data['logo'] 		= $contentinfo->certificate_logo;
			$this->data['content']		= str_replace(
			"__USERNAME__", 
			$quizinfo->username, 
			$this->data['content']
			);
			$this->data['content']		= str_replace(
			"__USERID__",$userid, 
			$this->data['content']
			);
			$this->data['content']		= str_replace(
			"__EMAIL__", 
			$quizinfo->email, 
			$this->data['content']
			);
			$this->data['content']		= str_replace(
			"__COURSENAME__", $quizinfo->examname, 
			$this->data['content']
			);
			$this->data['content']		= str_replace(
			"__SCORE__",
			$quizinfo->score, 
			$this->data['content']
			);
			$this->data['content']		= str_replace(
			"__MAXSCORE__", 
			$quizinfo->maxscore, 
			$this->data['content']
			);
			$this->data['content']		= str_replace(
			"__DATEOFTEST__", 
			$quizinfo->dateoftest, 
			$this->data['content']
			);
			 $html = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 
			 Transitional//EN' ' http://www.w3.org/TR/xhtml1/DTD/xhtml1-
			 transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Certificate</title><style>
.certificates {
	width: 680px;
	height: 470px;
	float: left;
	background: url(". base_url()."assets/uploads/certificate/"
	.$this->data['logo'].")
}
.name {
	width: 100%;
	float: left;
	margin-top: 50px;
	text-align: center;
}
.address {
	width: 28%;
	float: right;
	font-family: 'open Sans';
	text-align: left;
	font-size: 13px;
	margin-right: 35px;
	line-height: 20px;
}
.middle-con {
	width: 100%;
	margin: 0px auto;
	margin-top: 100px;
	clear: both;
}
.hed {
	border-bottom: 3px solid;
	font-family: 'open Sans';
	font-size: 17px;
	font-style: italic;
	font-weight: bold;
	margin: 0 auto;
	text-align: center;
	width: 50%;
}
.clear {
	clear: both;
}
.certi-description {
	width: 90%;
	margin: 0px auto;
	clear: both;
	font-family: 'open Sans';
	font-size: 14px;
	text-align: center;
	line-height: 30px;
	text-decoration: underline;
	margin-top: 0px;
	font-style: oblique;
}
.dmmm {
	font-weight: bold;
}
.sgn-ture {
	width: 250px;
	margin: -110px 42px;
	clear: both; float:right;
	 
}

.facualty{ width:250px; float:left; text-align:center; 
 font-family:'open Sans'; font-size:14px; font-weight:bold;}
.director{ width:250px; float:right; text-align:center; 
 font-family:'open Sans'; font-size:14px; font-weight:bold;}
.sign{ float:left; width:250px;}
</style></head>
<body>
<div class='certificates'>
 <br> 
  <div class='middle-con'>
    <div class='hed'> This is to certify that
      <div class='clear'></div>
    </div>
    <div class='clear'></div>
    <div class='certi-description'>".
$this->data['content']
	."</div>
  </div>
  <div class='clear'></div>
  <div class='sgn-ture'>

  <div class='director'><div class='sign'><img src="
  .base_url()."assets/uploads/certificate/".$this->data['signimage']
  ." width='111' height='63' /></div>".$this->data['adminsign']." </div>
  
  <div class='clear'></div>
  </div>
</div>
</body>
</html>";
	$this->data['html'] 				= $html;	

$filename = $userid;
		$pdfFilePath 					= FCPATH."assets/downloads/reports/".$filename.".pdf";

		$data['page_title'] 			= 'Certificate'; // pass data to the view
		 unlink($pdfFilePath); 
		if (file_exists($pdfFilePath) == FALSE) {
		    ini_set('memory_limit','32M'); 
		 $this->load->library('pdf');
		    $pdf 						= $this->pdf->load();
		    $pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); 
			$pdf->WriteHTML($html); // write the HTML into the PDF
			$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		}
	redirect("assets/downloads/reports/$filename.pdf"); 
		}
		else {
			 echo "Bir sorun oluştu. Lütfen adminle iletişime geçin..";
		}
		$this->load->view('certificate', $this->data);
	}
	
	
	//Payment Process
	function payment($param1, $param2, $param3)
	{
		//IT IS A VALID REQUEST
			//EVENTHOUGH WE NEED TO GET THE COST OF THE EXAM FROM DB
			
			$table 									= $this->db->dbprefix('quiz');
			$condition['quizid']					= $param2;
			$examdetails 							= $this->base_model->fetch_records_from(
													$table, 
													$condition);
			if(count($examdetails)<= 0)
				redirect('user/payment');
			$examdetails 								= $examdetails[0];
			$subscription_info['user_id'] 				= $this->ion_auth->user()->row()->id;
			$subscription_info['quizid'] 				= $examdetails->quizid;
			$subscription_info['validitytype']			= $examdetails->validitytype;
			$subscription_info['validityvalue'] 		= $examdetails->validityvalue;
			$subscription_info['expirydate'] 			= '';
			if ($examdetails->validitytype == 'Days')
			{
				$Date 									= date('Y-m-d');
				$exp_date 								= date('Y-m-d', strtotime(
															$Date. ' + '
															.$examdetails->validityvalue
															.' days'
															));
				$subscription_info['expirydate']	 	= $exp_date;
			}
			$subscription_info['remainingattempts'] 	= $examdetails->validityvalue;
			$subscription_info['status']				= 'Active';
			$subscription_info['dateofsubscription'] 	= date('Y-m-d');
	
	
		//PAYMENT METHODS VALIDATION
		if ($param1 == "paypal" && isset($param2) && 
			$param2 != '' && is_numeric($param2)  &&
			$param3 != '' && is_numeric($param3)) {
			
			$this->session->set_userdata('subscription_data', $subscription_info);
			$this->session->set_userdata('subscription_examname', $examdetails->name);
			$payment_info = $this->base_model->fetch_records_from(
			'paypal', 
			array('status' => 'Active')
			);
			if (count($payment_info) > 0) {
				$payment_info = $payment_info[0];
				$config['business'] 			= $payment_info->paypal_email;
				//Image header url [750 pixels wide by 90 pixels high]
				$config['cpp_header_image'] 	= base_url()."assets/uploads/paypal_logo/logo.jpg";
				$config['return'] 				= base_url().'user/payment_success';
				$config['cancel_return'] 		= base_url().'user/payment_cancel';
				$config['notify_url'] 			= '';//'process_payment.php'; //IPN Post
				$config['production'] 			= FALSE;
				
				if ($payment_info->account_type != 'Sandbox')
					$config['production'] 		= TRUE; 
					
				$config['currency_code'] 		= $payment_info->currency_code; 
				$this->load->library('paypal', $config);
				$this->paypal->add($examdetails->name, $examdetails->quizcost); 	  //ADD  item
				$this->paypal->pay(); //Proccess the payment
			}
			else { 
				$this->prepare_flashmessage("Bu ödeme ağ geçidi için yönetici ile temasa geçiniz", 1);
				$quizid 						= $subscriptioninfo['quizid'];
				//remove session data
				$this->session->unset_userdata('subscription_data');
				$this->session->unset_userdata('subscription_examname');
				redirect ('user/instructions/'.$quizid, 'refresh');
			}
		}
		$this->prepare_flashmessage("Geçersiz istek", 1);
		redirect ('user/index', 'refresh');
	}

	//Payment Success	
	function payment_success()
	{
		$subscriptioninfo 						= $this->session->userdata('subscription_data');
		$subscriptioninfo['transaction_id'] 	= $this->input->post("txn_id"); 
		$subscriptioninfo['payer_id'] 			= $this->input->post("payer_id"); 
		$subscriptioninfo['payer_email'] 		= $this->input->post("payer_email"); 
		$subscriptioninfo['payer_name'] 		= $this->input->post("first_name")." "
												  .$this->input->post("last_name");
		$examname 								= $this->session->userdata('subscription_examname');
		$this->base_model->insert_operation($subscriptioninfo, 'quizsubscriptions');
		$this->prepare_flashmessage(
									"Ödeme sınavı Başarıyla Tamamlandı <strong>"
									.$examname."</strong> with Transaction ID: <strong>"
									.$subscriptioninfo['transaction_id']."</strong>" , 
									0
									);
		$quizid 						= $subscriptioninfo['quizid'];
		//remove session data
		$this->session->unset_userdata('subscription_data');
		$this->session->unset_userdata('subscription_examname');
		redirect ('user/instructions/'.$quizid, 'refresh');
	}
	
	//Payment Cancel		
	function payment_cancel()
	{
		$subscriptioninfo 				= $this->session->userdata('subscription_data');
		$this->prepare_flashmessage(
									"Sınav ödemesi iptal edildi "
									.$this->session->userdata('subscription_examname'),
									1
									);
		$quizid 						= $subscriptioninfo['quizid'];
		//remove session data
		$this->session->unset_userdata('subscription_data');
		$this->session->unset_userdata('subscription_examname');
		redirect ('user/instructions/'.$quizid, 'refresh');
	}

	//Payment History		
	function payment_history()
	{
		$this->data['title'] 			= 'Ödeme Raporları';
		$this->data['active_menu'] 		= 'payment_history'; 
		$this->data['records'] 			= $this->base_model->run_query(
		"SELECT s.transaction_id, s.payer_email, s.payer_name, 
		q.name as quizname, q.quizcost as cost, s.dateofsubscription, q.validitytype, 
		s.expirydate, q.validityvalue, s.remainingattempts FROM "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('quizsubscriptions')
		." s,".$this->db->dbprefix('users')." u  where 
		 s.quizid=q.quizid and s.user_id=u.id and s.user_id = ".$this->session->userdata('user_id')
		);
		$this->data['content'] 			= 'user/reports/payment_history';
		$this->_render_page('temp/usertemplate', $this->data);
	}
	
	
	// Function For Logout
	function logout()
	{
		
		$this->session->sess_destroy();
		$this->prepare_flashmessage("Başarıyla çıkış yapıldı.", 0);
		redirect('welcome');
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */