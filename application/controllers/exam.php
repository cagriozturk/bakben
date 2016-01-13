<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exam extends MY_Controller {

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
| MODULE: 			Exam
| -----------------------------------------------------
| This is exam module controller file.
| -----------------------------------------------------
*/

	 function __construct()
    {
        parent::__construct();
		$this->validate_normaluser();
		$this->load->database();
		
    } 
	
	//Default Function which is called if no function is called in this Class.
	public function index()
	{
		redirect('user', 'refresh');
	}
	
	//Get the subjects that are set for the selected Quiz/Exam, and prepare the questions.
	public function startexam()
	{
	
		$id = $this->uri->segment(3);
		
		if ($id == '') {
		    $this->prepare_flashmessage("Geçersiz sınav girişimi id problemi...", 1);
			redirect('user/index', 'refresh');
		}
		$this->data['active_menu'] 		= 'exams';
		$this->data['content'] 			= 'user/exam/exampage';
		
		//VALIDATE FOR PAID TEST
		//IF DIRECTLY COMES TO THE LINK
		$account_validation = $this->session->userdata('account_validation');
		$is_user_account_modified = $this->session->set_userdata('is_user_account_modified');
		if(!isset($account_validation)) {
			$this->prepare_flashmessage("Geçersiz sınav girişimi ayarlı değil...", 1);
			redirect('user/index', 'refresh');
		}
		
		//IF IS AUTHORIZED TO TAKE THE EXAM
		if(!$account_validation['is_authorized']) {
			$this->prepare_flashmessage("Geçersiz sınav girişimi yetkili değilsiniz...", 1);
			redirect('user/index', 'refresh');
		}
		
		//IF IS QUIZ TYPE IS PAID AND VALIDITY TYPE IS ATTEMPTS
		// DECREMENT THE ATTEMPTS COUNT, UPDATE TO DATABASE AND MAINTAIN SESSION STATUS
		if ($account_validation['quiz_type'] == 'Paid' && 
			$account_validation['validitytype'] == 'Attempts') {
			if($account_validation['validityvalue'] != '' && $is_user_account_modified == 0) {
				$data['remainingattempts'] = $account_validation['validityvalue'] - 1;
				$where['id'] = $account_validation['account_id'];
				$this->base_model->update_operation($data, 'quizsubscriptions', $where);
				$this->session->set_userdata('is_user_account_modified',1);
			}
			
		}
		
		//QUIZ INFO
		$quizinfo 						= $this->base_model->run_query(
		"select q.*, sum(totalquestion) as totalquestion from "
		.$this->db->dbprefix('quiz')." q,".$this->db->dbprefix('quizquestions')
		." qq where q.quizid=qq.quizid and q.quizid=".$id
		);
		$quizinfo 						= $quizinfo[0];
		//TREATING AS TOTAL MARKS, CONSIDERING EACH QUESTION CARRIES 1 MARK.
		$totalQuestions 				= $quizinfo->totalquestion; 
		//Quiz Name
		$this->data['quizName'] 		= $quizinfo->name;	
		$this->data['quizTime'] 		= $quizinfo->deauration;
		if ($quizinfo->negativemarkstatus == "Active") {
			$this->data['negativeMark'] = $quizinfo->negativemark;		 			
		}
			
		if(isset($quizinfo)) {
			$this->data['title']		= $quizinfo->name;	//Quiz Name
		}
		
		//GET EXAM QUESTION DETAILS INCLUDING SUBJECTS (Subjects for the Quiz/Exam)
		$quizRecords = $this->base_model->run_query(
		"select q.*,qq.*,s.subjectid,s.name as subjectname from "
		.$this->db->dbprefix('quiz')." q, ".$this->db->dbprefix('quizquestions')
		." qq, ".$this->db->dbprefix('subjects')." s 
		where qq.quizid=q.quizid and qq.subjectid=s.subjectid and q.quizid=".$id
		);
		$questArray = array();
		foreach ($quizRecords as $r) {
			$subjectwiseQuestions = $this->base_model->run_query(
			"select * from ".$this->db->dbprefix('questions')
			." where subjectid=".$r->subjectid." and difficultylevel='"
			.$r->difficultylevel."' and answer1!='' and answer2!='' 
			and correctanswer!='' ORDER by rand() LIMIT ".$r->totalquestion
			);
			array_push($questArray, $subjectwiseQuestions);			
		}
		$this->data['quiz_info'] = $quizRecords;
		
		if ($this->session->userdata('isExamStarted') == 1) {
			$this->session->set_userdata('questions', $questArray);
			$answers = '';
			foreach ($this->session->userdata('questions') as $row) {
				foreach ($row as $q) {
					$answers[$q->questionid] = $q->correctanswer;
				}
			}
			$this->session->set_userdata('answers', $answers);
			$this->session->set_userdata('quiz_info', $quizinfo);
			//INCLUDES SUBJECTS
			$this->session->set_userdata('quizRecords', $quizRecords);
			$this->session->set_userdata('totalQuestions', $totalQuestions);
		}
		$this->_render_page('temp/usertemplate', $this->data);
	}
	
	//Validate the User Exam by comparing answers of users with correct answers and Display the Result Page.
	function validateexam()
	{
		$answers 						= '';
		$quizinfo 						= $this->session->userdata('quiz_info');
		$totalQuestions 				= $this->session->userdata('totalQuestions');
		$quizRecords 					= $this->session->userdata('quizRecords');
		$questions 						= $this->session->userdata('questions');
		$answers 						= $this->session->userdata('answers');
		$score 							= 0;
		$useroptions 					= '';
		$not_attempted 					= 0;
		if ($this->input->post('Finish') == 'Finish') {
			foreach ($this->input->post() as $key=>$value) {
				$useroptions[$key] 		= $value;	
			
				if ($key != 'Finish') {
					if (intval($value) == 0) {
						$not_attempted++;
					}
						
					if($answers[$key] == intval($value)){
						$score++;
					}
				}
			}
			$this->data['quiz_info'] 		= $quizinfo;
			$this->data['totalQuestions'] 	= $totalQuestions;
			$this->data['quizRecords'] 		= $quizRecords;
			$this->data['answers'] 			= $answers;
			$this->data['questions'] 		= $questions;
			$this->data['user_options'] 	= $useroptions;
			$attempted 						= $totalQuestions-$not_attempted;
			$wrongAnswers 					= $attempted-$score;
			
			/**
			* If any question attempted and  Negative mark status of Quiz is active, 
			* the Total Score is
			* 
			*/
			if ($quizinfo->negativemarkstatus == "Active" && $attempted!=0) {
				$negativeMark 			= floatval($quizinfo->negativemark);				
				$totalNegativeMark 		= $wrongAnswers*$negativeMark;
				$score 					-= $totalNegativeMark;
				$this->data['negativeMark'] = $negativeMark;
			}						
			$this->data['attempted'] 	= $attempted;
			$this->data['score'] 		= $score; 
			$this->data['attempted_percentage'] = 0;
			if ($attempted != 0) {
				$this->data['attempted_percentage'] = number_format(
				(($attempted/$totalQuestions)*100),2
				);
			}
				
			$this->data['score_percentage'] = 0;
			if ($score != 0) {
				$this->data['score_percentage']=number_format(
				(($score/$totalQuestions)*100),2
				);
			}
			
			$this->data['wrong_percentage'] 	= 0;
			if ($wrongAnswers != 0) {
				$this->data['wrong_percentage'] = number_format(
				(($wrongAnswers/$attempted)*100),2
				);
			}
		
			if (isset($useroptions) && count($useroptions)>0) {
				$userid = $this->session->userdata('user_id');
				unset($where);
				unset($records);
				$data['userid'] 			= $userid;
				$data['email'] 				= $this->session->userdata('email');
				$data['username'] 			= $this->session->userdata('username');
				$data['quiz_id'] 			= $quizinfo->quizid;
				$data['score'] 				= $score;
				$data['total_questions'] 	= $totalQuestions;
				$data['dateoftest'] 		= date('y-m-d');
				$data['timeoftest'] 		= date('H:i');
				
				//INSERT DATA INTO USER QUIZ RESULTS HISTORY
				$this->base_model->insert_operation(
				$data, 
				$this->db->dbprefix('user_quiz_results_history')
				);
				
				$where['userid'] 			= $userid;
				$where['quiz_id'] 			= $quizinfo->quizid;
				$records = $this->base_model->fetch_records_from(
				$this->db->dbprefix('user_quiz_results'), 
				$where
				);
				
				if (count($records) > 0) {
					$records=$records[0];
					if ($score>$records->score) {
						//NEW HIGH SCORE in this quiz UPDATE IT
						unset($where);
						$where['id'] 			= $records->id;
						$data['approx_rank'] 	= "2000";
						$data['total_attempts'] = $records->total_attempts + 1;
						$this->base_model->update_operation(
						$data,$this->db->dbprefix('user_quiz_results'), 
						$where
						);
					}
					else {
						//UPDATE THE NO. OF ATTEMPTS
						unset($where);
						$where['id'] 				= $records->id;
						$tempdata['total_attempts'] = $records->total_attempts + 1;
						$this->base_model->update_operation(
						$tempdata, 
						$this->db->dbprefix('user_quiz_results'), 
						$where
						);
					}
				}
				else {
					//IT IS NEW RECORD INSERT
					$data['approx_rank'] 		= "2000";
					$data['total_attempts'] 	= 1;
					$this->base_model->insert_operation(
					$data, 
					$this->db->dbprefix('user_quiz_results')
					);
				
				}
				unset($where); 
				unset($records);
				$records = $this->base_model->run_query(
				"select qr.*,u.image from ".$this->db->dbprefix('user_quiz_results')
				." qr,".$this->db->dbprefix('users')." u where u.id=qr.userid 
				and qr.quiz_id=".$quizinfo->quizid." ORDER BY qr.score DESC LIMIT 5"
				);
				$this->data['previous_score'] 	= $records;
				$this->data['active_menu'] 		= 'exams';
				$this->data['title'] 			= 'Exam/Quiz Result';
				$this->data['content'] 			= 'user/exam/quiz_results';
				$this->_render_page('temp/usertemplate', $this->data);
			}
					
		}		
		else {
			$this->prepare_flashmessage(
			"Geçersiz sonuç görüntüleme... <br/> Daha sonra tekrar deneyiniz...", 
			1
			);
			redirect('user', 'refresh');
		}
		
		//UNSET ALL SESSION DATA PREPARED FOR EXAM ATTEMPTION
		$this->session->unset_userdata('account_validation');
		$this->session->unset_userdata('is_user_account_modified');
	}
}

/* End of file exam.php */
/* Location: ./application/controllers/exam.php */