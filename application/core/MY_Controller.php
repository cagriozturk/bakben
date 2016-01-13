<?php ob_start();

class MY_Controller extends CI_Controller

{

	protected $data;
	protected $page;
	protected $header_data;
	protected $left_data;
	protected $footer_data;
	
	function __construct()

	{

		parent::__construct();
		
		//Fetch General Settings (Website Settings) and set them in sessions to access through out the application.
		$table = $this->db->dbprefix('general_settings');
		$site_data = $this->base_model->fetch_records_from($table);
		$this->session->set_userdata('site_data', $site_data[0]);
		$this->data['site_data'] = $this->session->userdata('site_data');	
		
		
	}
			
			//Authenticate Normal User (Applicaton User).
			function validate_normaluser()	{		
			$this->load->library('ion_auth');		
			if (!$this->ion_auth->logged_in())		
			{			
			$this->prepare_flashmessage("Devam etmek için lütfen giriş yapınız..",1);			
			redirect('auth/login', 'refresh');		
			}
			else if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
			{
				redirect('admin', 'refresh');
			}
			else if ($this->ion_auth->logged_in() && $this->ion_auth->is_moderator())
			{
				redirect('moderator', 'refresh');
			}
			return true;	
			}	
			
			//Authenticate Admin.
			function validate_admin()	{
			$this->load->library('ion_auth');		
				if($this->ion_auth->logged_in())
				{
					if(!$this->ion_auth->is_admin())		
					{					
						$this->prepare_flashmessage("Bu modüle erişim hakkınız yok",1);
						if($this->ion_auth->is_moderator())
							redirect('moderator', 'refresh');
						else
							redirect('user', 'refresh');
					}
					return true;
				}			
				else
				{
					$this->prepare_flashmessage("Devam etmek için lütfen giriş yapınız..",1);			
					redirect('auth/login', 'refresh');
				}			
			}
			
			//Authenticate Moderator.
			function validate_moderator()	{		
			$this->load->library('ion_auth');		
				if($this->ion_auth->logged_in())
				{
					if(!$this->ion_auth->is_moderator())		
					{				
						$this->prepare_flashmessage("Bu modüle erişim hakkınız yok",1);
						if($this->ion_auth->is_admin())
							redirect('admin', 'refresh');
						else
							redirect('user', 'refresh');		
					}
					return true;
				}			
				else
				{
					$this->prepare_flashmessage("Devam etmek için lütfen giriş yapınız..",1);			
					redirect('auth/login', 'refresh');
				}			
			}
			
	function is_valid($id=0)
	{
		if($id==0)
		return FALSE;
		
		$recs = $this->session->userdata('logindata');
		
		if(count($recs)>0)
		{
			if($recs->user_group_id==1)
			{
				// ADMIN
				//redirect('admin/index');
				return TRUE;
				
			}
			else if($recs->user_group_id==2)
			{
				//USER
				$this->prepare_flashmessage("Görüntülemek için izniniz yok",3);
				redirect('users/dashboard');
			}
			
		}
		
		//NOT LOGGED IN
		 		$this->prepare_flashmessage("Oturum Süresi Doldu..",1);
				redirect('users/login');
	}
	
	
	//Render Admin Pages along with the provided Data.
	function render_admin_view()
	{
		
		if($this->is_valid(1))
		{
		
			$this->load->view('admin/common/header',$this->header_data);
			$this->load->view('admin/common/left',$this->left_data);
			
			
			$this->load->view('admin/common/footer');
		}
		
		
	}
	

	//Create Thumbnail for Images according to the Source Image Path, Destination Path, Width and Height.
	function create_thumbnail($sourceimage,$newpath, $width, $height)

	{

		$this->load->library('image_lib');

		$this->image_lib->clear();

		

		$config['image_library'] = 'gd2';

		$config['source_image'] = $sourceimage;

		$config['create_thumb'] = TRUE;

		$config['new_image'] = $newpath;

		$config['dynamic_output'] = FALSE;

		$config['maintain_ratio'] = TRUE;

		$config['width'] = $width;

		$config['height'] = $height;

	    $config['thumb_marker'] = '';

		

		$this->image_lib->initialize($config); 

		return $this->image_lib->resize();

	}

	

	

	function validate_upload_image($fieldmessage,$fieldname,$filepath,$allowed_types,$thumbnailpath='',$width='',$height='')

	{

		$config['upload_path'] = $filepath;

		if( $allowed_types )

			$config['allowed_types'] = $allowed_types;

		else

			$config['allowed_types'] = 'gif|jpeg|jpg|png';

		$config['remove_spaces'] = TRUE;

		$config['overwrite'] = FALSE;

		

		$this->load->library('upload', $config);



		if(!$this->upload->do_upload($fieldname))

		{

			$this->form_validation->set_message($fieldmessage,$this->upload->display_errors());

			

			return $this->upload->display_errors();

			
		}

		else

		{

			$filedata = $this->upload->data();

			$this->uploadedimagename = $filedata['file_name'];

			if(!empty($thumbnailpath))

			{

				 $this->create_thumbnail($filedata['full_path'],$thumbnailpath,$width,$height);

			}

			return TRUE;

		}

	}

  
	//Prepare Flash Message in a certain Format.
	function prepare_flashmessage($msg,$type)
	{
		$returnmsg='';
		switch($type){
			case 0: $returnmsg = " <div class='col-md-12'>
										<div class='alert alert-success'>
											<a href='#' class='close' data-dismiss='alert'>&times;</a>
											<strong>Başarılı!</strong> ". $msg."
										</div>
									</div>";
				break;
			case 1: $returnmsg = " <div class='col-md-12'>
										<div class='alert alert-danger'>
											<a href='#' class='close' data-dismiss='alert'>&times;</a>
											<strong>Hata!</strong> ". $msg."
										</div>
									</div>";
				break;
			case 2: $returnmsg = " <div class='col-md-12'>
										<div class='alert alert-info'>
											<a href='#' class='close' data-dismiss='alert'>&times;</a>
											<strong>Bilgi!</strong> ". $msg."
										</div>
									</div>";
				break;
			case 3: $returnmsg = " <div class='col-md-12'>
										<div class='alert alert-warning'>
											<a href='#' class='close' data-dismiss='alert'>&times;</a>
											<strong>Uyarı!</strong> ". $msg."
										</div>
									</div>";
				break;
		}
		
		$this->session->set_flashdata("message",$returnmsg);
	}  
  
  	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	//Render Pages along with the provided Data.(Except Admin Pages)
	function _render_page($view, $data=null, $render=false)
	{
		//echo "hello jack"; print_r($view);die();

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $render);

		if (!$render) return $view_html;
	}

}

?>